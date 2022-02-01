<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'foto',
        'body',
        'author',
    ];

    public function tags()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            Tag::class,
            'berita_tag',
            'berita_id',
            'tag_id'
        );
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'berita_category',
            'berita_id',
            'category_id'
        );
    }
}
