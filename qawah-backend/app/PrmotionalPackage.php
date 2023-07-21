<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrmotionalPackage extends Model
{
	protected $table = 'prmotional_packages';
	protected $guarded=[];
        public function packages_categery()
    {
        return $this->hasOne(Packages_catogeries::class, 'id','catogery_id');
    }
     public function packages_categeries()
    {
        return $this->hasMany(Packages_catogeries::class, 'id','catogery_id');
    }
}
