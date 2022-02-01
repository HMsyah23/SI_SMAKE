<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pegawai extends Model
{
    use HasFactory,Uuid;
    public $timestamps = false;

    protected $fillable = [
        'gelar_depan',
        'nama_depan',
        'nama_belakang',
        'gelar_belakang',
        'status',
        'nip',
        'pangkat_id',
        'jabatan_id',
        'eselon_id',
        'divisi_id',
        'email',
        'picture',
        'keterangan',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class);
    }

    public function eselon()
    {
        return $this->belongsTo(Pangkat::class);
    }

}
