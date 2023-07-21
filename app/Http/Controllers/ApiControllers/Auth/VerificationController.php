<?php

namespace App\Http\Controllers\ApiControllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\users_verification_codes;
use App\User;
use Illuminate\Support\Facades\Auth;
use Builder;
use App\Mail\Varification_code_send;
use Mail;
use Validator;
use Str;
use Twilio\Rest\Client;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    //use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }




    private function send_sms($receiverNumber ,$message)
    {
        try {
            $account_sid = config("twillio.sid");
            $auth_token = config("twillio.token");
            $twilio_number = config("twillio.from");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
                return response()->json(["status" => true , "message" => "message send successfull"], 200, );
        } 
        catch (Exception $e) {
         return response()->json(["status" => true , "message" => $e->getMessage()], 200, );
        }
    }
    public function send_mobile_otp(request $request)
    {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
            ]);
            if ($validator->fails()) 
            {    
                return response()->json(["status" => false,"message" => "something went wrong...!","validation_errors" =>   $validator->errors()], 200);
            } 
            $user = User::where("email",$request->email)->first();
            $user->varrification_code()->where("type",1)->where("token",Null)->delete();
            // Generate random code
            $data['code'] = mt_rand(1000, 9999);
            $data['type'] = 1;
            $data['token'] =  Str::random(20);
            $data['status'] = 1;
            $user->varrification_code()->create($data);
            $receiverNumber =  $user->phone;
            $message = "This is automated SMS from qavah.us Your verification PIN in ".$data['code'] ." Please enter the PIN for instant verifcation thankyou";
            $otp_response = $this->send_sms($receiverNumber ,$message);
            return response(['status' => true, 'message' => 'We have emailed your password reset link!'], 200);
    }
    public function send_email(request $request)
    {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
            ]);
            if ($validator->fails()) 
            {    
                return response()->json(["status" => false,"message" => "something went wrong...!","validation_errors" =>   $validator->errors()], 200);
            } 
            $user = User::where("email",$request->email)->first();
            $user->varrification_code()->where("type",2 )->where("token",Null)->delete();
            // Generate random code
            $data['code'] = mt_rand(1000, 9999);
            $data['type'] = 2;
            $data['token'] =  Str::random(20);
            $data['status'] = 1;
            $user->varrification_code()->create($data);
            Mail::to($request->email)->send(new Varification_code_send($data['code']));
            return response(['status' => true, 'message' => 'We have emailed your password reset link!'], 200);
    }







    public function verify_otp(request $request)
    {   
     $user_id = $request->user()->id;
     $verification = users_verification_codes::where("user_id",$user_id)
     ->where("type",1)
     ->where("status",1)
     ->where("code",$request->otp)
     ->first();
     if(!empty($verification))
     {
        $user_status_update = User::where("id",$user_id)->update(["mobile_verified" => 1]);
        $code_status = users_verification_codes::where("id",$verification->id)->update(["status" => 0]);
        $resp = array("status" =>  true , "message" => "exist" ,"update_status" => $code_status , "verification" => $verification);
    }
      else
      {
         $resp = array("status" =>  false , "message" => "not exist");
      }
      return response()->json($resp,200);
    }
    public function email_verify_otp(request $request)
    {   
     $user_id = $request->user()->id;
     $verification = users_verification_codes::where("user_id",$user_id)
     ->where("type",2)
     ->where("status",1)
     ->where("code",$request->otp)
     ->first();
     if(!empty($verification))
     {
        $user_status_update = User::where("id",$user_id)->update(["email_verified" => 1]);
        $code_status = users_verification_codes::where("id",$verification->id)->update(["status" => 0]);
        $resp = array("status" =>  true , "message" => "exist" ,"update_status" => $code_status ,"user" => $user_status_update , "verification" => $verification);
     }
     else
     {
        $resp = array("status" =>  false , "message" => "not exist");
     }
     return response()->json($resp,200);
    }



    
}
