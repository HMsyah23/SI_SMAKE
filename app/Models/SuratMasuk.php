<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

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
        'tanggal_dibaca',
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
        'isDibaca',
    ];

    protected $casts = [
        'tipe' => 'array',
        'catatan' => 'array',
        'divisi' => 'array',
        'noted' => 'array',
        'tanggal_surat'  => 'date:d / m /Y',
        'tanggal_terima'  => 'date:d / m /Y',
        'tanggal_validasi'  => 'date:d / m /Y',
        'tanggal_disposisi'  => 'date:d / m /Y',
        'tanggal_dibaca'  => 'date:d / m /Y',
    ];

    // public function getDivisiAttribute($value)
    // {
    //     $data = explode(',', substr($value,1,-1));
    //     foreach ($data as $key => $value) {
    //         $data[$key] = Divisi::find($value)->divisi;
    //     }
    //     return $data;
    // }

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

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
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
