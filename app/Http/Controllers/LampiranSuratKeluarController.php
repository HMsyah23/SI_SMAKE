<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\LampiranSuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class LampiranSuratKeluarController extends Controller
{

    public function store(Request $request)
    {
        if ($request->lampiran[0] !== 'undefined') {
            $sum = count($request->lampiran);
            for ($i=0; $i < $sum ; $i++) { 
                $image = $request->lampiran[$i];
                $name= md5(time()).$i.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('lampiran/surat/keluar/');
                $image->move($destinationPath, $name);
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
                LampiranSuratKeluar::create([
                    'surat_keluar_id' => $request->surat_keluar_id,
                    'lampiran'       => 'lampiran/surat/keluar/'.$name,
                ]);
            }
            $surat = SuratKeluar::find($request->surat_keluar_id);
            $surat->touch();
            return response()->json(['data' => $surat,'status' => 'Lampiran Surat Keluar Berhasil Ditambahkan'], 200);    
        } else {
            $returnData = array(
                'status' => 'error',
                'message' => 'Silahkan unggah kembali berkas anda'
            );
            return response()->json($returnData, 400);    
        }
    }

    public function destroy(LampiranSuratKeluar $lampiranSuratKeluar)
    {
        File::delete($lampiranSuratKeluar->lampiran);
        $surat = SuratKeluar::find($lampiranSuratKeluar->surat_keluar_id);    
        $surat->touch();
        $lampiranSuratKeluar->delete();
        return response()->json(['data' => $surat,'status' => "Lampiran Surat Keluar Berhasil Dihapus"],200);
    }
}
