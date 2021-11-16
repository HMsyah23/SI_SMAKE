<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

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
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        if($request->file('file') == null){
            $file = null;
        } else {
            $fileName = bcrypt(time()).'.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('surat/keluar', $fileName, 'public');
            $file = $filePath;
        }

        SuratKeluar::create([
            'nomor_surat'     => $request['nomor'],
            'tujuan_surat'     => $request['tujuan'],
            'tanggal_keluar'  => $request['tanggal_keluar'],
            'perihal'  => $request['perihal'],
            'file'  => $file 
        ]);
        return response()->json(['status' => 'Surat Keluar Berhasil Ditambahkan'], 200);
    
    }

    public function show(SuratKeluar $suratKeluar)
    {
        //
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        return view('admin.suratKeluar.show',compact('suratKeluar'));  
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        if($request->file('file') == null){
            $file =  $suratKeluar->file;
        } else {
            $request->validate([
                'file' => 'mimes:pdf|max:2048'
            ]);
    
            $fileName = bcrypt(time()).'.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('surat/keluar', $fileName, 'public');
            $file = $filePath;
        }

        $suratKeluar->update([
            'nomor_surat'    => $request['nomor'],
            'tujuan_surat'   => $request['tujuan'],
            'tanggal_keluar' => $request['tanggal_keluar'],
            'perihal'        => $request['perihal'],
            'file'           => $file 
        ]);

        return response()->json(['data' => $suratKeluar,'status' => 'Data Berhasil Diperbarui'], 200);
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        $suratKeluar->delete();
        return response()->json(['data' => ['status' => 'Data Surat Keluar Berhasil Dihapus']],200);
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
}
