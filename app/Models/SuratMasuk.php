<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class SuratMasuk extends Model
{
    use HasFactory,Uuid;

    public $incrementing = false;

    protected $fillable = [
        'divisi_id',
        'nomor_surat',
        'asal_surat',
        'tanggal_surat',
        'tanggal_terima',
        'perihal',
        'file'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
