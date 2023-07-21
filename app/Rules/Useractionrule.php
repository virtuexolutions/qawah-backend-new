<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;

class Useractionrule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        $user = Auth::user();
        $user_action = $user->useractions_by_auth_user()->where("match_id","=",$value);
        $target_user_action = $user->useractions()->where("user_id","=",$value);
        
        
        if($user_action->exists() && $target_user_action->exists())
        {
            return false;
        }
        else if($user_action->exists())
        {
           return false;
        }
        else
        {
            return true;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Already request Sent waiting for a matched';
    }
}
