<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;
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
    ];

    public function lampirans()
    {
        return $this->hasMany(LampiranSuratKeluar::class);
    }

    public function divisi(){
        return $this->belongsTo(Divisi::class);
    }

    public function getTanggalValidasiAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->isoFormat('dddd, D MMMM Y (H:mm:ss)');
        } else {
            return 'Belum divalidasi';
        }
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->addHours(8)->isoFormat('dddd, D MMMM Y (H:mm:ss)');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->addHours(8)->isoFormat('dddd, D MMMM Y (H:mm:ss)');
    }

}
