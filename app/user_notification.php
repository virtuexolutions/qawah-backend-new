<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class user_notification extends Model
{
    //
    protected $guarded = [];
	
	public function users()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
	
	public function target_user()
    {
        return $this->hasOne(User::class, 'id','target_id');
    }
	
	public function isrealitePracticeKeeping()
    {
        return $this->hasMany(Users_israelites_practice::class, 'user_id','target_id')->select(["user_id","options"]);
    }
	public function kingdomGifts()
    {
        return $this->hasMany(Users_kingdom_gifts::class, 'user_id','target_id')->select(["user_id","options"]);
    }
    public function passions()
    {
        return $this->hasMany(Users_passions::class, 'user_id','target_id')->select(["user_id","options"]);
    }
	
	public function profile_image()
    {
        return $this->hasOne(Users_Profile_Images::class,'user_id','target_id')->select('user_id','url as uri');;
    }
	
	public function useractions()
    {
        return $this->hasOne(UserAction::class, 'user_id','target_id');
    }
	public function Location()
    {
        return $this->hasOne(Users_Location::class, 'user_id','target_id')->select(["user_id","city","latitude","longitude","state","state_abbr","zipcode"]);
    }
    public function gallery_images()
    {
        return $this->hasMany(Users_Gallery_Images::class, 'user_id','target_id')
        ->orderBy("index");
    }
 
    public function profile_images()
    {
        return $this->hasMany(Users_Profile_Images::class, 'user_id','target_id')->orderBy("index");;
    }
	public function active_spotlights()        
    {
        $date =  Carbon::now();
        return $this->hasOne(User_Activate_Spotlight::class, 'user_id','target_id')
        ->where("expire_time",">", $date)->where("status",1);
    }
}
