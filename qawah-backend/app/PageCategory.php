<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    protected $table ='page_category';
    protected $guarded = [];
    public function page_sections(){
        return $this->hasMany(PageSections::class,'page_id','id');
    }
}
