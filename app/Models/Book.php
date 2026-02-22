<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = 
    [
        'designation', 
        'description', 
        'prix', 
        'auteur', 
        'cover', 
        'type_id',
        'langue', 
        'editeur', 
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type() 
    {
        return $this->belongsTo(Type::class);
    }

    public function tags() 
    {
        return $this->belongsToMany(Tag::class);
    }
}
