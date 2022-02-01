<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampiranSuratKeluar extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function surat_keluars()
    {
        return $this->belongsTo(SuratKeluar::class, 'surat_keluar_id');
    }
}
