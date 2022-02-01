<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $data = Profil::all();
        return response()->json(['data' => $data], 200);
    }

    public function create()
    {
        return view('admin.profil.create');
    }

    public function store(Request $request)
    {
        $slug = strtolower(str_replace(' ', '-', $request->nama));

        Profil::create([
            'nama'     => $request->nama,
            'slug'      => $slug,
            'body'      => $request->body,
        ]);
    
        return response()->json(['status' => 'Data Berhasil Ditambahkan'], 200);
    }

    public function show(Profil $profil)
    {
        return response()->json(['data' => $profil], 200);
    }

    public function edit(Profil $profil)
    {
        return view('admin.profil.show',compact('profil'));  
    }

    public function update(Request $request, Profil $profil)
    {
        $slug = strtolower(str_replace(' ', '-', $request->nama));

        $profil->update([
            'nama'      => $request->nama,
            'slug'      => $slug,
            'body'      => $request->body,
        ]);
        $profil = Profil::where('id',$profil->id)->first();
        return response()->json(['data' => $profil,'status' => 'Data Berhasil Diperbarui'], 200);
    }

    public function destroy(Profil $profil)
    {
        $profil->delete();
        return response()->json(['data' => ['status' => 'Data Berhasil Dihapus']],200);
    }
}
