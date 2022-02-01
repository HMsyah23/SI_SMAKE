<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\SuratKeluar;
use App\Models\LampiranSuratKeluar;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class SuratKeluarController extends Controller
{
    public function index()
    {
        $data = SuratKeluar::all();
        return response()->json(['data' => $data], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request['tanggal_validasi']) {
            $tanggal =  now();    
        } else {
            $tanggal =  null;    
        }
            
        $request->validate([
            'file' => 'required|mimes:docx,pdf,doc|max:2048'
        ]);

        if($request->file('file') == null){
            $file = null;
        } else {
            $fileName = md5(time()).'.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('surat/keluar', $fileName, 'public');
            $file = $filePath;
        }

        $surat = SuratKeluar::create([
            'nomor_surat'     => $request['nomor_surat'],
            'tujuan_surat'     => $request['tujuan_surat'],
            'divisi_id'  => $request['divisi_id'],
            'perihal'  => $request['perihal'],
            'file'  => $file,
            'isValid'  => $request['isValid'],
            'tanggal_validasi' => $tanggal
        ]);
        
        if ($request->lampiran[0] !== 'undefined') {
            $sum = count($request->lampiran);
            for ($i=0; $i < $sum ; $i++) { 
                $image = $request->lampiran[$i];
                $name= md5(time()).$i.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('lampiran/surat/keluar/');
                $image->move($destinationPath, $name);
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
                LampiranSuratKeluar::create([
                    'surat_keluar_id' => $surat->id,
                    'lampiran'       => 'lampiran/surat/keluar/'.$name,
                ]);
            }
        }
        return response()->json(['status' => 'Data Surat Keluar Berhasil Diunggah'], 200);    
    }

    public function show($suratKeluar)
    {
        $suratKeluar = SuratKeluar::where('id',$suratKeluar)->with(['divisi','lampirans'])->first();
        return response()->json(['data' => $suratKeluar], 200);
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        return view('admin.suratKeluar.show',compact('suratKeluar'));  
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $suratKeluar->update([
            'tujuan_surat'   => $request['tujuan_surat'],
            'perihal'        => $request['perihal'],
        ]);

        return response()->json(['data' => $suratKeluar,'status' => 'Data Berhasil Diperbarui'], 200);
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        if ($suratKeluar->lampirans->count() > 0) {
            foreach ($suratKeluar->lampirans as $lampiran) {
                File::delete($lampiran->lampiran);
                $lampiran->delete();
            }
        }
        File::delete($suratKeluar->file);
        $suratKeluar->delete();
        return response()->json(['data' => ['status' => "Surat Keluar Berhasil Dihapus"]],200);
    }

    public function filter($year){
        $data = SuratKeluar::whereYear('tanggal_keluar', '=', date($year))
                    ->selectRaw('month(tanggal_keluar) month, count(*) total')
                    ->groupBy('month')
                    ->get();
        $result = [];

        for ($i=1; $i <= 12 ; $i++) { 
            foreach ($data as $k => $v) {
                if($i == $v['month']){
                    $jumlah = $v['total'];
                    break;
                } else {
                    $jumlah =  0;
                }
            }
            array_push($result, $jumlah);
        }

        return response()->json(['data' => $result], 200);
    }

    public function divisi(Divisi $divisi){
        $data = SuratKeluar::where('divisi_id',$divisi->id)->with('divisi')->get();
        return response()->json(['data' => $data], 200);
    }

    public function validasi(SuratKeluar $suratKeluar,Request $request)
    {
        $suratKeluar->update([
            'nomor_surat'  => $request->nomor_surat,
            'isValid' => 1,
            'tanggal_validasi' => now()
        ]);
        $suratKeluar = SuratKeluar::find($suratKeluar->id)->first();
        return response()->json(['data' => $suratKeluar,'status' => 'Surat berhasil divalidasi'], 200);
    }

    public function needValidation()
    {
        $data = SuratKeluar::where('isValid',0)->get();
        return response()->json(['data' => $data], 200);
    }

    public function fileSuratKeluar(SuratKeluar $suratKeluar,Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:docx,pdf,doc|max:2048'
        ]);

        if($request->file('file') == null){
            $file = null;
        } else {
            $fileName = md5(time()).'.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('surat/keluar', $fileName, 'public');
            $file = $filePath;
        }

        File::delete($suratKeluar->file);
        $suratKeluar->update([
            'file'  => $file,
        ]);
        return response()->json(['data' => $suratKeluar,'status' => 'File Surat Keluar Berhasil Diperbarui'], 200);    
    }

    public function perbarui(Request $request, SuratKeluar $suratKeluar)
    {
        $suratKeluar->update([
            'nomor_surat'    => $request['nomor_surat'],
            'tujuan_surat'   => $request['tujuan_surat'],
            'divisi_id'      => $request['divisi_id'],
            'perihal'        => $request['perihal'],
        ]);
        $suratKeluar = SuratKeluar::where('id',$suratKeluar->id)->with('divisi')->first();
        return response()->json(['data' => $suratKeluar,'status' => 'Data Berhasil Diperbarui'], 200);
    }
}
