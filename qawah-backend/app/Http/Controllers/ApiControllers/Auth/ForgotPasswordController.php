<?php

namespace App\Http\Controllers\ApiControllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Mail; 
use Hash;
use Illuminate\Support\Str;
use App\Mail\SendCodeResetPassword;

//use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    //use SendsPasswordResetEmails;

    public function send_mail(request $request)
    {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
            ]);

            if ($validator->fails()) 
            {    
                return response()->json(["status" => false,"message" => "something went wrong...!","validation_errors" =>   $validator->errors()], 200);
            } 
            $user = User::where("email",$request->email)->first();
            $user->varrification_code()->where("type",2)->delete();
            // Generate random code
            $data['code'] = mt_rand(1000, 9999);
            $data['type'] = 2;
            $data['token'] =  Str::random(20);
            $data['status'] = 1;
            $user->varrification_code()->create($data);
            Mail::to($request->email)->send(new SendCodeResetPassword($data['token']));

            return response(['status' => true, 'message' => 'We have emailed your password reset link!'], 200);
    }


}
