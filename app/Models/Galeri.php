<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tipe',
        'deskripsi',
    ];

    public function files()
    {
        return $this->hasMany(FileGaleri::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'galeri_tag',
            'galeri_id',
            'tag_id'
        );
    }
}
