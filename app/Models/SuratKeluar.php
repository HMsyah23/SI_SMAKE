<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class SuratKeluar extends Model
{
    use HasFactory,Uuid;

    public $incrementing = false;

    protected $fillable = [
        'nomor_surat',
        'tujuan_surat',
        'tanggal_keluar',
        'perihal',
        'file'
    ];

}
