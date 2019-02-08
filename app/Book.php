<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'is_active', 'title', 'author', 'isbn', 'published'
    ];

    public function book_out()
    {
        return $this->hasOne('App\Books_out');
    }
}
