<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function beritas()
    {
        return $this->belongsToMany(
            Berita::class,
            'berita_category',
            'category_id',
            'berita_id'
        );
    }
}
