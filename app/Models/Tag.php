<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function beritas()
    {
        return $this->belongsToMany(
            Berita::class,
            'berita_tag',
            'tag_id',
            'berita_id'
        );
    }

    public function galeris()
    {
        return $this->belongsToMany(
            Galeri::class,
            'galeri_tag',
            'tag_id',
            'galeri_id'
        );
    }
}
