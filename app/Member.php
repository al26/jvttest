<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'is_active', 'fullname', 'dob', 'address'
    ];

    public function books_out()
    {
        return $this->hasMany('App\Books_out');
    }
}
