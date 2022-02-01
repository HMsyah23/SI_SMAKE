<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EselonController extends Controller
{

    public function index()
    {
        $data = Eselon::select("*", DB::raw("CONCAT(pangkat,' ',ruang) as name"))->get();
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

    public function show(Eselon $eselon)
    {
        //
    }

    public function edit(Eselon $eselon)
    {
        //
    }

    public function update(Request $request, Eselon $eselon)
    {
        //
    }

    public function destroy(Eselon $eselon)
    {
        //
    }
}
