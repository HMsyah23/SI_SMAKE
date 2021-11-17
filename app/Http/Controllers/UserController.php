<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class UserController extends Controller
{
    public function index()
    {
        $data = User::with(['role','divisi'])->get();
        return response()->json(['data' => $data], 200);
    }  

    public function show()
    {

    }

    public function create()
    {   
        if (Auth::user()->role->name == 'Admin') {
            return view('admin.user.index');
        } else {
            return redirect()->route('user.edit',Auth::user()->id); 
        }
    }

    public function edit(User $user)
    {
        return view('admin.user.show',compact('user'));  
    }

    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($request->file('picture') == null){
            $pic = null;
        } else {
            $fileName = md5(time()).'.'.$request->picture->getClientOriginalExtension();
            $filePath = $request->file('picture')->storeAs('picture', $fileName, 'public');
            $pic = $filePath;
        }

        User::create([
            'nama'      => $request['nama'],
            'email'     => $request['email'],
            'role_id'   => $request['peran'],
            'divisi_id' => $request['divisi'],
            'password'  => bcrypt('password'), 
            'picture'  => $pic 
        ]);
        return response()->json(['status' => 'Pengguna Baru Berhasil Ditambahkan'], 200);
    }

    public function update(Request $request, User $user){
        if($request->file('picture') == null){
            $file = $user->picture;
        } else {
            File::delete($user->picture); 
            $fileName = md5(time()).'.'.$request->picture->getClientOriginalExtension();
            $filePath = $request->file('picture')->storeAs('picture', $fileName, 'public');
            $file = $filePath;
        }

        $user->update([
            'nama'      => $request['nama'],
            'email'     => $request['email'],
            'role_id'   => $request['peran'],
            'divisi_id' => $request['divisi'],
            'picture'  => $file 
        ]);
        $user = User::find($user->id)->with(['divisi','role'])->first();
        return response()->json(['data' => $user,'status' => 'Data Pengguna Berhasil Diperbarui'], 200);
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);       
        File::delete($data->picture); 
        $data->delete();

        return response()->json(['data' => ['status' => 'Data Berhasil Dihapus']]);
    }

    public function changePassword(Request $request,User $user)
    {
        if(Hash::check($request->old,$user->password)){
            $user->update([
                'password' => bcrypt($request->new), 
            ]);
            return response()->json(['data' => ['status' => 'Password Berhasil Diperbarui']]);
        }
        return response()->json(['data' => ['status' => 'Kata Sandi Lama Tidak Cocok']]);
    }
}
