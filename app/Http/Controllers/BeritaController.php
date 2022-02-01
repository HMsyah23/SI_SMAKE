<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::all();
        return response()->json(['data' => $data], 200);
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        $slug = strtolower(str_replace(' ', '_', $request->title));

        if($request->file('foto') == null){
            $pic = null;
        } else {
            $fileName = md5(time()).'.'.$request->foto->getClientOriginalExtension();
            $filePath = $request->file('foto')->storeAs('berita', $fileName, 'public');
            $pic = $filePath;
        }

        $tags = $request->input('tags');
        $tags_berita = explode(',', $tags);

        $berita = Berita::create([
            'title'     => $request->title,
            'slug'      => $slug,
            'foto'      => $pic,
            'body'      => $request->body,
            'author'    => $request->author, 
        ])->id;

        if (!(Category::where('name', $request->category)->count() > 0) && !(Category::where('id', $request->category)->count() > 0)) {
            $category = Category::create([
                'name' => $request->category,
            ])->id;
            $category = $category;
        } else {
            $category = $request->category;
        }

        foreach ($tags_berita as $value) {
            if (!(Tag::where('name', $value)->count() > 0) && !(Tag::where('id', $value)->count() > 0)) {
                $tag = Tag::create([
                    'name' => $value,
                ])->id;
                $tagss[] = $tag;
            } else {
                $tagss[] = $value;
            }
        }
        
        $berita = Berita::find($berita);

        $berita->categories()->attach($category);
        $berita->tags()->attach($tagss);
        
        return response()->json(['status' => 'Berita Berhasil Ditambahkan'], 200);
    }

    public function show(Berita $berita)
    {
        //
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.show',compact('berita'));  
    }

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

        $slug = strtolower(str_replace(' ', '_', $request->title));
        $tags = $request->input('tags');
        $tags_berita = explode(',', $tags);
        $berita->update([
            'title'     => $request->title,
            'slug'      => $slug,
            'foto'      => $pic,
            'body'      => $request->body,
            'author'    => $request->author,
        ]);

        if (!(Category::where('name', $request->category)->count() > 0) && !(Category::where('id', $request->category)->count() > 0)) {
            $category = Category::create([
                'name' => $request->category,
            ])->id;
            $category = $category;
        } else {
            $category = $request->category;
        }

        foreach ($tags_berita as $value) {
            if (!(Tag::where('name', $value)->count() > 0) && !(Tag::where('id', $value)->count() > 0)) {
                $tag = Tag::create([
                    'name' => $value,
                ])->id;
                $tagss[] = $tag;
            } else {
                $tagss[] = $value;
            }
        }
        
        $berita->categories()->sync($category);
        $berita->tags()->sync($tagss);

        $berita = Berita::where('id',$berita->id)->with(['categories','tags'])->first();
        return response()->json(['data' => $berita,'status' => 'Data Berita Berhasil Diperbarui'], 200);
    }

    public function destroy(Berita $berita)
    {
        File::delete($berita->foto);
        $berita->delete();
        return response()->json(['data' => ['status' => 'Data Berita Berhasil Dihapus']],200);
    }
}
