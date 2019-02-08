<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books_out extends Model
{
    protected $fillable = [
        'member_id', 'user_id', 'book_id', 'date_out', 'date_in', 'date_in_actual'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
