<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The categories that belong to the user.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    /**
     * The authors that belong to the user.
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }
}
