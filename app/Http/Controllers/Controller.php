<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


   public function  send_notifications($content) : void
   {
      $user = Auth::user();
      $response =  $user->user_notification()->create([
        "title" => $content["title"],
        "body" => $content["body"],
        "is_remove" => false,
        "is_viewed" => false,
      ]);
      Mail::to($user->email)->send(new \App\Mail\Notifications($content));
     // return $response;
   }
   public function  send_target_notifications($id,$content) : void
   {
      $user = User::find($id);
      $response =  $user->user_notification()->create([
        "title" => $content["title"],
        "body" => $content["body"],
        "is_remove" => false,
        "is_viewed" => false,
      ]);
      Mail::to($user->email)->send(new \App\Mail\Notifications($content));  
     // return $response;
   }
	
	//saad code
	
	public function send_target_notifications_app($userid,$taergetid,$content) : void
   	{
      $user = User::find($userid);
      $response =  $user->user_notification()->create([
        "target_id" => $taergetid,
		"title" => $content["title"],
        "invitation" => ( $content["type"] == 'invitation') ? 1 : 0,
		"messaged" => ( $content["type"] == 'messaged') ? 1 : 0,
		"commented" => ( $content["type"] == 'commented') ? 1 : 0,
        "is_remove" => false,
        "is_viewed" => false,
      ]);
      //Mail::to($user->email)->send(new \App\Mail\Notifications($content));  
     // return $response;
   	}

	
	
	public function send_target_notifications_app_update($userid,$taergetid,$content) : void
   	{
      $user = User::find($userid);
      $response =  $user->user_notification()->create([
		"target_id" => $taergetid,
		"title" => $content["title"],
        "invitation" => ( $content["type"] == 'invitation') ? 1 : 0,
		"messaged" => ( $content["type"] == 'messaged') ? 1 : 0,
		"commented" => ( $content["type"] == 'commented') ? 1 : 0,
		"type" => 1 ,
        "is_remove" => false,
        "is_viewed" => false,
      ]);
      //Mail::to($user->email)->send(new \App\Mail\Notifications($content));  
     // return $response;
   	}
   public function send_users_mobile_verification_codes($user_id)
    {
      return  User::find($user_id)->varrification_code()->create(["code" => rand(1000,9999),"type" => 1,"status" => 1,]);
    }
    public function send_users_email_verification_codes($user_id)
    {
       return User::find($user_id)->varrification_code()->create(["code" => rand(1000,9999),"type" => 2,"status" => 1,]);
    }
}
