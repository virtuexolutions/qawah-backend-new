<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_event extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
}
