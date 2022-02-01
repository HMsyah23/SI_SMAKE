<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $data = Tag::all();
        return response()->json(['data' => $data] ,200);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        Tag::create([
            'name' => $request['name']
        ]);
        return response()->json(['status' => 'Tag Berhasil Ditambahkan']);
    }

    public function show(Tag $tag)
    {
        return response()->json(['data' => $tag], 200);
    }

    public function edit(Tag $tag)
    {
        //
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->update([
            'name' => $request['name']
        ]);
        return response()->json(['status' => 'Tag Berhasil Diperbarui'], 200);
    }

    public function destroy(Tag $tag)
    {
        if($tag->beritas()->exists()){
            return response()->json(['data' => ['status' => 'Tag Gagal Dihapus'], 200]);
        }
        $tag->delete();
        return response()->json(['data' => ['status' => 'Tag Berhasil Dihapus'], 200]);
    }
}
