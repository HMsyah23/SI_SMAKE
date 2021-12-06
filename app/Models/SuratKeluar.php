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
        'divisi_id',
        'tujuan_surat',
        'perihal',
        'file',
        'isValid',
        'lampiran',
        'tanggal_validasi',
    ];

    protected $casts = [
        'lampiran' => 'array',
        'tanggal_validasi'  => 'date:d / m /Y',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

}
