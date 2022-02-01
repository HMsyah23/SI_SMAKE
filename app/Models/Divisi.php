<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Divisi extends Model
{
    use HasFactory,Uuid;

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'divisi',
    ];

    public function suratMasuks()
    {
        return $this->belongsToMany(
            SuratMasuk::class,
            'divisi_surat_masuks',
            'divisi_id',
            'surat_masuk_id'
        );
    }

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
