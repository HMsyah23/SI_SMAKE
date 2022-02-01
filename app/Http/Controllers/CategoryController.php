<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return response()->json(['data' => $data] ,200);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request['name']
        ]);
        return response()->json(['status' => 'Category Berhasil Ditambahkan']);
    }

    public function show(Category $category)
    {
        return response()->json(['data' => $category], 200);
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request['name']
        ]);
        return response()->json(['status' => 'Category Berhasil Diperbarui'], 200);
    }

    public function destroy(Category $category)
    {
        if($category->beritas()->exists()){
            return response()->json(['data' => ['status' => 'Category Gagal Dihapus'], 200]);
        }
        $category->delete();
        return response()->json(['data' => ['status' => 'Category Berhasil Dihapus'], 200]);
    }
}
