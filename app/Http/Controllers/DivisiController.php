<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function home()
    {
        $divisis = Divisi::all();
        return view('admin.divisi.index',compact('divisis'));      
    }

    public function index()
    {
        $data = Divisi::with('suratMasuks')->get();
        return response()->json(['data' => $data] ,200);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        Divisi::create([
            'kode' => $request['kode'],
            'divisi' => $request['nama']
        ]);
        return response()->json(['status' => 'Divisi Berhasil Ditambahkan']);
    }

    public function show(Divisi $divisi)
    {
        return response()->json(['data' => $divisi], 200);
    }

    public function edit(Divisi $divisi)
    {
        //
    }

    public function update(Request $request, Divisi $divisi)
    {
        $divisi->update([
            'kode' => $request['kode'],
            'divisi' => $request['nama']
        ]);
        return response()->json(['status' => 'Divisi Berhasil Diperbarui'], 200);
    }

    public function destroy(Divisi $divisi)
    {
        if($divisi->suratMasuks()->exists()){
            return response()->json(['data' => ['status' => 'Divisi Gagal Dihapus, Terdapat File Surat Terkait Pada Divisi Ini'], 200]);
        }
        $divisi->delete();
        return response()->json(['data' => ['status' => 'Divisi Berhasil Dihapus'], 200]);
    }
}
