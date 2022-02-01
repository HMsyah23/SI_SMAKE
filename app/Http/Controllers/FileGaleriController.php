<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\FileGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileGaleriController extends Controller
{

    public function show(FileGaleri $fileGaleri)
    {
        return response()->json(['data' => $fileGaleri], 200);
    }

    public function showAll($galeri)
    {
        $galeri = FileGaleri::with('galeris')->where('galeri_id',$galeri)->get();
        return response()->json(['data' => $galeri], 200);
    }

    public function update(Request $request, $galeri)
    {
        $parentGaleri = Galeri::where('id', $galeri)->first();
        $galeri = FileGaleri::where('galeri_id', $galeri)->first();
        if ($parentGaleri->tipe == 1) {
            $msg = 'Foto Berhasil Ditambahkan';
            foreach ($request->deskripsi as $key => $value) { 
                $image = $request->url[$key];
                $name= md5(time()).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('galeri/foto/'.str_replace(' ', '_',$parentGaleri->nama));
                $image->move($destinationPath, $name);
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
                FileGaleri::create([
                    'galeri_id' => $request['galeri_id'],
                    'url'       => 'galeri/foto/'.str_replace(' ', '_',$parentGaleri->nama).'/'.$name,
                    'deskripsi' => $value,
                ]);
            }
            $data = FileGaleri::where('galeri_id', $parentGaleri->id)->get();
        } else {
            if ($galeri) {
                $galeri->update([
                    'galeri_id' => $request['galeri_id'],
                    'url'      => $request['url'],
                ]);
                $msg = 'Link Video Berhasil Diperbarui';
                $data['video'] = $galeri;
            } else {
                $galeri = FileGaleri::create([
                    'galeri_id' => $request['galeri_id'],
                    'url'      => $request['url'],
                ]);
                $msg = 'Link Video Berhasil Ditambahkan';
                $data['video'] = $galeri;
            }
        }

        return response()->json(['status' => $msg, 'data' => $data], 200);
    }

    public function destroy(FileGaleri $fileGaleri)
    {
        $id = $fileGaleri->galeri_id;
        File::delete(public_path().'/'.$fileGaleri->url);
        $fileGaleri->delete();
        $data = FileGaleri::where('galeri_id', $id)->get();
        return response()->json(['data' => ['status' => 'Foto Berhasil Dihapus','data' => $data]],200);
    }
}
