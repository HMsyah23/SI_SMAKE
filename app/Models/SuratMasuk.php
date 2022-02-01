<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;
class SuratMasuk extends Model
{
    use HasFactory,Uuid;

    public $incrementing = false;

    protected $fillable = [
        'divisi_id',
        'divisi',
        'nomor_surat',
        'asal_surat',
        'tanggal_surat',
        'tanggal_disposisi',
        'tanggal_validasi',
        'tanggal_terima',
        'no_agenda',
        'sifat',
        'tipe',
        'perihal',
        'noted',
        'catatan',
        'tanda_tangan',
        'file',
        'isValid',
        'isDisposisi',
        'isDistribusi',
    ];

    protected $casts = [
        'tipe' => 'array',
        'catatan' => 'array',
        'divisi' => 'array',
        'noted' => 'array',
    ];

    public function divisis()
    {
        return $this->belongsToMany(
            Divisi::class,
            'divisi_surat_masuks',
            'surat_masuk_id',
            'divisi_id'
        );
    }

    public function getTanggalValidasiAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->isoFormat('dddd, D MMMM Y (H:mm:ss)');
        } else {
            return 'Belum divalidasi';
        }
    }

    public function getTanggalSuratAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->isoFormat('dddd, D MMMM Y');
        } else {
            return 'Belum ditemukan';
        }
    }

    public function getTanggalTerimaAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->isoFormat('dddd, D MMMM Y (H:mm:ss)');
        } else {
            return 'Belum diterima';
        }
    }

    public function getTanggalDisposisiAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->isoFormat('dddd, D MMMM Y (H:mm:ss)');
        } else {
            return 'Belum divalidasi';
        }
    }

    public function getTipeAttribute($value)
    {
        $data = explode(',', substr($value,1,-1));
        return $data;
    }

    public function getCatatanAttribute($value)
    {
        $data = explode(',', substr($value,1,-1));
        return $data;
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->addHours(8)->isoFormat('dddd, D MMMM Y (H:mm:ss)');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->addHours(8)->isoFormat('dddd, D MMMM Y (H:mm:ss)');
    }

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%'.$value.'%');
    }
}
