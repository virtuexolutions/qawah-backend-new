<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_Gallery_Images extends Model
{
    //
    protected $table = "users_gallery_images";
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
