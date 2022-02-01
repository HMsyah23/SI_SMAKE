<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PangkatController extends Controller
{

    public function index()
    {
        $data = Pangkat::select("*", DB::raw("CONCAT(golongan,' ',ruang) as name"))->get();
        return response()->json(['data' => $data], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Pangkat $pangkat)
    {
        //
    }

    public function edit(Pangkat $pangkat)
    {
        //
    }

    public function update(Request $request, Pangkat $pangkat)
    {
        //
    }

    public function destroy(Pangkat $pangkat)
    {
        //
    }
}
