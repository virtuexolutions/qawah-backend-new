<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_profile_verified extends Model
{
    protected $table ='user_profile_verifieds';
    protected $guarded=[];
    
     public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
