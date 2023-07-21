<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageSections extends Model
{
    protected $table = 'sections';
    protected $guarded=[];
     
    public function page()
    {
        return $this->hasOne(PageCategory::class,'id','page_id');
    }
}
