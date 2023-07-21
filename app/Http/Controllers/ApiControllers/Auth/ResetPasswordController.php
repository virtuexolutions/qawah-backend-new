<?php

namespace App\Http\Controllers\ApiControllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use App\users_verification_codes;
use Hash;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function do_reset(Request $request)
    {
        $code =users_verification_codes::firstWhere("token",$request->resetPasswordCode);
        if(!empty($code))
        {
            $user = User::find($code->user_id);
            $user->update([
                'password' => Hash::make($request->newPassword)
            ]);
          $user->varrification_code()->where("type",2)->delete();
          return response()->json(["status" => true ,"user"=>$user], 200);
        }
        else{
          return response()->json(["status" => false , "message" => "token expired"], 200);
        }
         
    }
}   
