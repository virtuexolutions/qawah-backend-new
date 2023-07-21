<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Auth;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens , Notifiable ,Billable,SoftDeletes;
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }
    protected $fillable = [
        'id','uid', 'profileName', 'governmentName', 'phone', 'email', 'password', 'birthday','age', 'height', 'iAm', 'seeking', 'zipcode', 'aboutMe', 'bodyType', 'doYouDrink', 'doYouHaveChildren', 'doYouSmoke', 'doYouWantMoreChildren', 'employmentStatus', 'havePets', 'havePetsOthers', 'howOftenDoYouExercise', 'livingSituation', 'maritalStatus', 'relationshipIAmSeeking', 'willingToRelocate', 'anyAffiliation', 'iBelieveIAM', 'maritalBeliefSystem', 'spiritualBackground', 'spiritualValue', 'studyBible', 'studyHabits', 'yearsInTruth','email_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $dates = ['deleted_at'];

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */ 

     public function prefrences()
    {
        return $this->hasOne(user_prefrence::class, 'user_id', 'id')->select(["*"]);
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
 
    public function profile_images()
    {
        return $this->hasMany(Users_Profile_Images::class, 'user_id')->orderBy("index");;
    }
	
	
	public function profile_image()
    {
		 return $this->hasOne(Users_Profile_Images::class, 'user_id')->select('user_id','url as uri');
    }

    // Saad Commit This code
    public function user_spotlights()        
    {
        return $this->hasMany(User_Activate_Spotlight::class, 'user_id');
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
    public function height()
    {
        return $this->hasone(user_height::class, 'user_id')->select(["user_id","feet","inches"]);
    }
    
    public function subscription()
    {
        return $this->hasMany(Users_subcribtion::class,'user_id')->with("user_addons_subscriptions")
        ->where("status" , 1);
    }

    public function user_subcribtion()
    {
        return $this->hasOne(Users_subcribtion::class, 'user_id');
    }
    public function User_payments()
    {
        return $this->hasOne(User_payments::class, 'user_id');
    }
    public function useractions_by_auth_user()
    {
        // print_r($id);die;
        return $this->hasOne(UserAction::class, 'user_id');
    }
    public function who_likes_me_status()
    {
        return $this->hasone(UserAction::class, 'user_id')->where('match_id',Auth::id())
        ->whereOr('liked',true)
        ->whereOr('superlike',true)
        ->whereOr('superfancy',true)
        ->where('is_blocked',false)
        ->where('disliked',false)
        ->where('matched',false);
        
    }
    public function useractions()
    {
        return $this->hasOne(UserAction::class, 'match_id');
    }
    public function target_useractions()
    {
        return $this->hasOne(UserAction::class, 'user_id');
    }
    public function user_settings()
    {
        return $this->hasmany(user_setting::class, 'user_id');
    }
    public function allowed_profile()
    {
       return $this->hasone(user_allow_profile::class, 'user_id')->select(["user_id","profile_id"]);
    }
    public function user_privacy()
    {
        return $this->hasOne(user_setting::class, 'user_id')->select(["user_id","type","value"])->where("type","privacy");
    }
    public function user_allow_profile()
    {
        return $this->hasOne(user_allow_profile::class, 'user_id');
    }
    public function user_match()
    {
        return $this->hasOne(user_matched::class, 'user_id');
    }
    public function varrification_code()        
    {
        return $this->hasOne(users_verification_codes::class, 'user_id');
    }
    public function preferences()        
    {
        return $this->hasOne(user_prefrence::class, 'user_id')->select(["user_id","global","ageFrom","ageTo","Zipcode","radius"]);
    }
    public function user_profile_view()
    {
        return $this->hasOne(user_profile_view::class, 'user_id');
    }
    public function who_view_my_profile()
    {
        return $this->hasOne(user_profile_view::class, 'user_id');
    }
    public function activate_spotlights()        
    {
        return $this->hasOne(User_Activate_Spotlight::class, 'user_id');
    }
    public function active_spotlights()        
    {
        $date =  Carbon::now();
        return $this->hasOne(User_Activate_Spotlight::class, 'user_id')
        ->where("expire_time",">", $date)->where("status",1);
    }
     public function user_report()
    {
        return $this->hasMany(user_report::class, 'user_id');
    }
	
	public function fetch_user_report()
    {
		//dd('asd');
        //return $this->hasMany(user_report::class, 'user_id')->select('target_id','user_id');
		return $this->hasMany(user_report::class, 'target_id')->select('target_id','user_id');
    }
    public function user_notification()
    {
        return $this->hasMany(user_notification::class, 'user_id');
    }
	
	
	public function user_notification_app()
    {
        return $this->hasMany(user_notification_app::class, 'user_id');
    }
	
    public function user_feedback()
    {
        return $this->hasMany(user_feedback::class, 'user_id');
    }
    public function user_event()
    {
        return $this->hasMany(user_event::class, 'user_id');
    }
    public function user_lovenote()
    {
        return $this->hasOne(user_lovenote::class, 'user_id');
    }
    public function love_note_by_user()
    {
        return $this->hasOne(user_lovenote::class, 'match_id');
    }
     public function login_status()
    {
        return $this->hasOne(user_login_log::class, 'user_id')
        ->select("user_id","status")
        ->where("last_activity",">=",Carbon::now()->subSecond(30))
        ->where("last_activity","<",Carbon::now());
    }
    public function user_login_log()
    {
        return $this->hasOne(user_login_log::class, 'user_id');
    }
    public function user_profile_verified()
    {
           return $this->hasOne(user_profile_verified::class, 'user_id');
    }
    
    
}
