<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Berita::all();
        return response()->json(['data' => $data], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.berita.create');
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

        $slug = str_replace(' ', '_', $request->title);

        if($request->file('foto') == null){
            $pic = null;
        } else {
            $fileName = md5(time()).'.'.$request->foto->getClientOriginalExtension();
            $filePath = $request->file('foto')->storeAs('berita', $fileName, 'public');
            $pic = $filePath;
        }

        $category = $request->input('category');
        $category = explode(',', $category);

        Berita::create([
            'title'     => $request->title,
            'slug'      => $slug,
            'foto'      => $pic,
            'body'      => $request->body,
            'category'  => $category, 
            'author'    => $request->author, 
        ]);
        return response()->json(['status' => 'Berita Berhasil Ditambahkan'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.show',compact('berita'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        if($request->file('foto') == null){
            $pic = $berita->foto;
        } else {
            File::delete($berita->foto); 
            $fileName = md5(time()).'.'.$request->foto->getClientOriginalExtension();
            $filePath = $request->file('foto')->storeAs('berita', $fileName, 'public');
            $pic = $filePath;
        }

        $slug = str_replace(' ', '_', $request->title);
        $category = $request->category;
        $category = explode(',', $category);
        $berita->update([
            'title'     => $request->title,
            'slug'      => $slug,
            'foto'      => $pic,
            'body'      => $request->body,
            'category'  => $category, 
            'author'    => $request->author,
        ]);
        $berita = Berita::where('id',$berita->id)->first();
        return response()->json(['data' => $berita,'status' => 'Data Berita Berhasil Diperbarui'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        File::delete($berita->foto);
        $berita->delete();
        return response()->json(['data' => ['status' => 'Data Berita Berhasil Dihapus']],200);
    }

    public function filter()
    {
        $category = Berita::get('category');

        $data = array();
        
        foreach ($category as $key => $category) {
            foreach ($category['category'] as $c) {
                if($c != "") {
                if(!in_array($c, $data))
                    {
                        array_push($data, $c);
                    }
                }
            }
        }

        return response()->json(['data' => $data], 200);
    }
}
