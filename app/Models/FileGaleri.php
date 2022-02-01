<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileGaleri extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function galeris()
    {
        return $this->belongsTo(Galeri::class, 'galeri_id');
    }

}
