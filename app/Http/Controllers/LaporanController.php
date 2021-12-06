<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Divisi;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function lembarDisposisi(SuratMasuk $suratMasuk){
        $logo = public_path('picture/logo/logoSurat.png');
        if ($suratMasuk->tanda_tangan == NULL) {
            $ttd = NULL;
        } else {
            $ttd = public_path($suratMasuk->tanda_tangan);
        }
        if ($suratMasuk->divisi !== NULL) {
            $divisi = explode(',', substr($suratMasuk->divisi,0));
            $data = [];
            foreach ($divisi as $key => $value) {
                $data[$key] = Divisi::find($value)->divisi;
            }
            $suratMasuk->divisi = $data;
        }
        $pdf = PDF::loadView('pdf.lembarDisposisi',compact('ttd','logo','suratMasuk'))->setPaper('a5', 'portrait');
        return $pdf->stream('lembarDisposisi-'.$suratMasuk->nomor_surat.'.pdf');
    }
}
