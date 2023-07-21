<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Activate_Spotlight extends Model
{
    //
    protected $guarded = [];


    public function user()        
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    
    // public function Users_Profile_Images()        
    // {
    //     return $this->hasOne(Users_Profile_Images::class, 'id','user_id');
    // }

    public function profile_images()
    {
        return $this->hasMany(Users_Profile_Images::class,'id','user_id')->orderBy("index");
    }

    public function user_profile_verified()
    {
           return $this->hasOne(user_profile_verified::class, 'user_id');
    }

    public function useractions()
    {
        return $this->hasOne(UserAction::class, 'match_id');
    }

    public function Location()
    {
        return $this->hasOne(Users_Location::class, 'user_id', 'id')->select(["user_id","city","latitude","longitude","state","state_abbr","zipcode"]);
    }

    public function gallery_images()
    {
        return $this->hasMany(Users_Gallery_Images::class, 'user_id')
        ->orderBy("index");
    }

    public function isrealitePracticeKeeping()
    {
        return $this->hasMany(Users_israelites_practice::class, 'user_id')->select(["user_id","options"]);
    }

    public function kingdomGifts()
    {
        return $this->hasMany(Users_kingdom_gifts::class, 'user_id')->select(["user_id","options"]);
    }

    public function passions()
    {
        return $this->hasMany(Users_passions::class, 'user_id')->select(["user_id","options"]);
    }
}
