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
        return $this->hasMany(SuratMasuk::class);
    }
}
