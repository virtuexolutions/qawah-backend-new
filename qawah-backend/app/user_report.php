<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_report extends Model
{
    protected $table = 'user_reports';
    protected $guarded=[];
     public function user()
    {
     return $this->hasOne(User::class,'id','target_id');
    }

}
