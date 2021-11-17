<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class SuratMasukController extends Controller
{
    public function index()
    {
        $data = SuratMasuk::with(['divisi'])->get();
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
            'divisi_id'       => $request['divisi'],
            'nomor_surat'     => $request['nomor'],
            'asal_surat'      => $request['asal'],
            'tanggal_surat'   => $request['tanggal_surat'],
            'tanggal_terima'  => $request['tanggal_terima'],
            'perihal'  => $request['perihal'],
            'file'  => $file 
        ]);
        return response()->json(['status' => 'Surat Masuk Berhasil Ditambahkan'], 200);
    }


    public function show(SuratMasuk $suratMasuk)
    {
        //
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

    public function divisi($divisi){
        $data = SuratMasuk::where('divisi_id',$divisi)->get();
        return response()->json(['data' => $data], 200);
    }
}
