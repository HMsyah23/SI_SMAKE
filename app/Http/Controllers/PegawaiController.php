<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class PegawaiController extends Controller
{
    public function home()
    {
        $pegawais = Pegawai::all();
        return view('admin.pegawai.index',compact('pegawais'));      
    }

    public function index()
    {
        $data = Pegawai::with('jabatan')->orderBy('nama_depan','ASC')->get();
        return response()->json(['data' => $data], 200);
    }

    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if($request->file('picture') == null){
            $file = null;
        } else {
            $fileName = md5(time()).'.'.$request->picture->getClientOriginalExtension();
            $filePath = $request->file('picture')->storeAs('pegawai', $fileName, 'public');
            $file = $filePath;
        }

        Pegawai::create([
            'gelar_depan'     => $request['gelar_depan'],
            'nama_depan'      => $request['nama_depan'],
            'nama_belakang'   => $request['nama_belakang'],
            'gelar_belakang'  => $request['gelar_belakang'],
            'status'          => $request['status'],
            'nip'             => $request['nip'],
            'pangkat_id'      => $request['pangkat'],
            'jabatan_id'      => $request['jabatan'],
            'eselon_id'       => $request['eselon'],
            'divisi_id'       => $request['divisi'],
            'email'           => $request['email'],
            'picture'         => $file 
        ]);

        return response()->json(['status' => 'Data Pegawai Berhasil Ditambahkan'], 200);
    }


    public function show(Pegawai $pegawai)
    {
        return response()->json(['data' => $pegawai], 200);
    }

    public function edit(Pegawai $pegawai)
    {
        return view('admin.suratMasuk.show',compact('suratMasuk'));  
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        if($request->file('file') == null){
            $file =  $pegawai->file;
        } else {
            $request->validate([
                'file' => 'mimes:pdf|max:2048'
            ]);
            File::delete($pegawai->file);
            $fileName = md5(time()).'.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('surat/masuk', $fileName, 'public');
            $file = $filePath;
        }

        $pegawai->update([
            'divisi_id'       => $request['divisi'],
            'nomor_surat'     => $request['nomor'],
            'asal_surat'      => $request['asal'],
            'tanggal_surat'   => $request['tanggal_surat'],
            'tanggal_terima'  => $request['tanggal_terima'],
            'perihal'  => $request['perihal'],
            'file'  => $file 
        ]);
        $pegawai = Pegawai::find($pegawai->id)->with(['divisi'])->first();
        return response()->json(['data' => $pegawai,'status' => 'Data Berhasil Diperbarui'], 200);
    }

    public function destroy(Pegawai $pegawai)
    {
        File::delete($pegawai->file);
        $pegawai->delete();
        return response()->json(['data' => ['status' => 'Data Surat Masuk Berhasil Dihapus']],200);
    }
}
