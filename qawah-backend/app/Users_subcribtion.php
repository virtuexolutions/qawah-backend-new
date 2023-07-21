<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_subcribtion extends Model
{
    //
    protected $table = "user_subscriptions";
    protected $guarded =[
        'id'
    ];

    /**
     * Get all of the comments for the Users_subcribtion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_addons_subscriptions()
    {
        return $this->hasMany(user_addons_subscriptions::class, 'subscribe_id')
        ->select(['subscribe_id', 'addon_name']);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class,'user_id', 'id');
    }
    public function user_spotlights()
    {
        return $this->hasMany(User_spotlight::class,'subsciption_id');
    }
}
