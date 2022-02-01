<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'pangkat',
        'golongan',
        'ruang',
    ];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }

}
