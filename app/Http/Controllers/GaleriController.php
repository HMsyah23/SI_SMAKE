<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Galeri::all();
        return response()->json(['data' => $data], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($request->file('foto') == null){
            $pic = null;
        } else {
            $fileName = md5(time()).'.'.$request->foto->getClientOriginalExtension();
            $filePath = $request->file('foto')->storeAs('galeri', $fileName, 'public');
            $pic = $filePath;
        }

        Galeri::create([
            'nama'      => $request['nama'],
            'deskripsi' => $request['deskripsi'],
            'foto'      => $pic 
        ]);
        return response()->json(['status' => 'Foto Baru Berhasil Ditambahkan'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.show',compact('galeri'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        if($request->file('foto') == null){
            $file = $galeri->foto;
        } else {
            File::delete($galeri->foto); 
            $fileName = md5(time()).'.'.$request->foto->getClientOriginalExtension();
            $filePath = $request->file('foto')->storeAs('galeri', $fileName, 'public');
            $file = $filePath;
        }

        $galeri->update([
            'nama'      => $request['nama'],
            'deskripsi' => $request['deskripsi'],
            'foto'      => $file
        ]);
        $galeri = Galeri::where('id',$galeri->id)->first();
        return response()->json(['data' => $galeri,'status' => 'Data Foto Berhasil Diperbarui'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        File::delete($galeri->file);
        $galeri->delete();
        return response()->json(['data' => ['status' => 'Data Foto Galeri Berhasil Dihapus']],200);
    }
}
