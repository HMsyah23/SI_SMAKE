<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{

    public function index()
    {
        $data = Jabatan::get();
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

    public function show(Jabatan $jabatan)
    {
        //
    }

    public function edit(Jabatan $jabatan)
    {
        //
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    public function destroy(Jabatan $jabatan)
    {
        //
    }
}
