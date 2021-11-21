<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Informasi extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
    ];
}
