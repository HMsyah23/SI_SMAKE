<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function home()
    {
        $data = Role::all();
        return view('admin.Role.index',compact('data'));      
    }

    public function index()
    {
        $data = Role::all();
        return response()->json(['data' => $data], 200);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        Role::create([
            'name' => $request['name'],
            'role' => $request['role']
        ]);
        return response()->json(['status' => 'Role Berhasil Ditambahkan'], 200);
    }

    public function show(Role $role)
    {
        return response()->json(['data' => $role]);
    }

    public function edit(Role $role)
    {
        //
    }

    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request['name'],
            'role' => $request['role']
        ]);
        return response()->json(['status' => 'Role Berhasil Diperbarui'], 200);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['data' => ['status' => 'Role Berhasil Dihapus']], 200);
    }
}
