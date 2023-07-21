<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_saved_filter extends Model
{
    //
    protected $guarded = [];

    /**
     * Get all of the comments for the user_saved_filter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_filter()
    {
        return $this->hasMany(user_filter::class, 'filter_id')->select(["filter_id","filter_key as key","filter_values as values" ]);
    }
}

