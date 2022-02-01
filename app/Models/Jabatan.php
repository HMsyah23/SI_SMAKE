<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'jabatan',
    ];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
