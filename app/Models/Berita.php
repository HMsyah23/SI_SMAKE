<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Berita extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $fillable = [
        'title',
        'slug',
        'foto',
        'category',
        'body',
        'author',
    ];

    protected $casts = [
        'category' => 'array',
    ];
}
