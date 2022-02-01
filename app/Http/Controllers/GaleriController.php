<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\FileGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class GaleriController extends Controller
{
    public function home()
    {
        $data['galeri'] = Galeri::all();
        $galeri = Galeri::first();
        return view('admin.galeri.index',compact('data','galeri'));
    }

    public function list($galeri)
    {
        $data['galeri'] = Galeri::all();
        $data['id'] = Galeri::find($galeri);
        $galeri = FileGaleri::where('galeri_id',$galeri)->get();
        return view('admin.galeri.index',compact('data','galeri'));
    }

    public function index()
    {
        $data = Galeri::all();
        return response()->json(['data' => $data], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $galeri = Galeri::create([
            'nama'      => $request['nama'],
            'tipe'      => $request['tipe'],
            'deskripsi' => $request['deskripsi'],
        ]);
        return response()->json(['status' => 'Galeri Baru Berhasil Ditambahkan','data' => $galeri], 200);
    }

    public function show(Galeri $galeri)
    {
        return response()->json(['data' => $galeri], 200);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $galeri->update([
            'nama'      => $request['nama'],
            'deskripsi' => $request['deskripsi'],
        ]);
        $galeri = Galeri::where('id',$galeri->id)->first();
        return response()->json(['data' => $galeri,'status' => 'Data Galeri Berhasil Diperbarui'], 200);
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        $galeri = Galeri::take(1)->first();
        return response()->json(['data' => ['status' => 'Data Foto Galeri Berhasil Dihapus','id' => $galeri]],200);
    }
}
