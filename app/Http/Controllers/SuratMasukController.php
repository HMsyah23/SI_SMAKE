<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Illuminate\Support\Arr;
use App\Models\SuratMasuk;
use App\Models\Divisi;
use App\Models\DivisiSuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class SuratMasukController extends Controller
{
    public function index()
    {
        $data = SuratMasuk::get();
        return response()->json(['data' => $data], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        if($request->file('file') == null){
            $file = null;
        } else {
            $fileName = md5(time()).'.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('surat/masuk', $fileName, 'public');
            $file = $filePath;
        }

        SuratMasuk::create([
            'nomor_surat'     => $request['nomor'],
            'asal_surat'      => $request['asal'],
            'tanggal_surat'   => $request['tanggal_surat'],
            'tanggal_terima'  => $request['tanggal_terima'],
            'no_agenda'       => $request['no_agenda'],
            'sifat'           => $request['sifat'],
            'tipe'            => $request['tipe'],
            'perihal'         => $request['perihal'],
            'file'            => $file 
        ]);
        return response()->json(['status' => 'Surat Masuk Berhasil Ditambahkan'], 200);
    }


    public function show(SuratMasuk $suratMasuk)
    {
        return response()->json(['data' => $suratMasuk], 200);
    }

    public function edit(SuratMasuk $suratMasuk)
    {
        return view('admin.suratMasuk.show',compact('suratMasuk'));  
    }

    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        if($request->file('file') == null){
            $file =  $suratMasuk->file;
        } else {
            $request->validate([
                'file' => 'mimes:pdf|max:2048'
            ]);
            File::delete($suratMasuk->file);
            $fileName = md5(time()).'.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('surat/masuk', $fileName, 'public');
            $file = $filePath;
        }

        $suratMasuk->update([
            'divisi_id'       => $request['divisi'],
            'nomor_surat'     => $request['nomor'],
            'asal_surat'      => $request['asal'],
            'tanggal_surat'   => $request['tanggal_surat'],
            'tanggal_terima'  => $request['tanggal_terima'],
            'perihal'  => $request['perihal'],
            'file'  => $file 
        ]);
        $suratMasuk = SuratMasuk::find($suratMasuk->id)->with(['divisi'])->first();
        return response()->json(['data' => $suratMasuk,'status' => 'Data Berhasil Diperbarui'], 200);
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        File::delete($suratMasuk->file);
        $suratMasuk->delete();
        return response()->json(['data' => ['status' => 'Data Surat Masuk Berhasil Dihapus']],200);
    }

    public function filter($year){
        $data = SuratMasuk::whereYear('tanggal_terima', '=', date($year))
                    ->selectRaw('month(tanggal_terima) month, count(*) total')
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
        $data = Divisi::whereHas('suratMasuks', function ($query) use($divisi) {
            $query->where('divisi_id', $divisi->id);
        })->with('suratMasuks')->first(); 
        return response()->json(['data' => $data['suratMasuks']], 200);
    }

    public function validasi(SuratMasuk $suratMasuk)
    {
        $suratMasuk->update([
            'isValid'  => 1,
            'tanggal_validasi' => now()
        ]);
        $suratMasuk = SuratMasuk::find($suratMasuk->id)->first();
        return response()->json(['data' => $suratMasuk,'status' => 'Surat berhasil divalidasi'], 200);
    }

    public function disposisi(SuratMasuk $suratMasuk,Request $request)
    {   
        $divisi = explode(',', $request->divisi);

        $image = $request->tanda_tangan;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = $suratMasuk->id.'.'.'png';

        // use jpg format and quality of 100
        $resized_image = Image::make(base64_decode($image))->resize(300, 200)->stream('png', 100);
        // then use Illuminate\Support\Facades\Storage
        \File::put(public_path(). '/tanda_tangan/' . $imageName, $resized_image);
        $suratMasuk->update([
            'isDisposisi'  => 1,
            'noted'        => $request->noted,
            'catatan'      => $request->catatan,
            'tanda_tangan' => '/tanda_tangan/' .$imageName,
            'tanggal_disposisi' => now()
        ]);

        $suratMasuk->divisis()->attach($divisi);

        return response()->json(['data' => $suratMasuk,'status' => 'Surat berhasil di disposisi'], 200);
    }

    public function distribusi(SuratMasuk $suratMasuk)
    {
        $suratMasuk->update([
            'isDistribusi'  => 1
        ]);
        return response()->json(['status' => 'Surat berhasil dikirim ke sub bagian terkait'], 200);
    }

    public function valid()
    {
        $data = SuratMasuk::where('isValid',1)->get();
        return response()->json(['data' => $data], 200);
    }

    public function needValidation()
    {
        $data = SuratMasuk::where('isValid',0)->get();
        return response()->json(['data' => $data], 200);
    }

    public function dispos()
    {
        $data = SuratMasuk::where('isValid',1)->where('isDisposisi',0)->get();
        return response()->json(['data' => $data], 200);
    }

    public function distri()
    {
        $data = SuratMasuk::where('isDistribusi',0)->get();
        return response()->json(['data' => $data], 200);
    }

    public function terbaca($suratMasuk,Request $request)
    {
        $suratMasuk = DivisiSuratMasuk::where('surat_masuk_id',$suratMasuk)->with('suratMasuk')->first();
        if (!$suratMasuk->isDibaca) {
            $suratMasuk->update([
                'isDibaca' => 1,
                'tanggal_dibaca' => now()
            ]);
        }
        return redirect('/'.$suratMasuk->suratMasuk->file);
    }
}
