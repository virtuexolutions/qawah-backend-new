<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{     
    protected $table = "packages";
    public $fillable = array('title','stripe_plan','price','catogery_id','description', 'duration' , 'spotlights' , 'lovenotes', 'options','active' ,'promotion','most_popular');

     public function packages_categery()
    {
        return $this->hasOne(Packages_catogeries::class, 'id','catogery_id');
    }
     public function packages_categeries()
    {
        return $this->hasMany(Packages_catogeries::class, 'id','catogery_id');
    }
}
