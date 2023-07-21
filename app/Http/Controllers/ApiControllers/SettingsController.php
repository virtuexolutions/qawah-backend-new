<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserAction;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\user_notification;
use App\Users_subcribtion;
use App\user_setting;
use App\user_report;
use Validator;
use Illuminate\Support\Str;
use Laravel\Cashier\Cashier;
use App\Package;
use Carbon\Carbon;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Hash;


class SettingsController extends Controller
{

      public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient("sk_test_51JIdZVJehHGbCsaCtO53jxO0sNp5ENohIDu08KlDU7Xh5AroEdegLfy0bnjOd3rtfsAhJA19TiE2mEspXsFwGjdr00lF3TxhRG");
    }
    public function block_user(request $request)
    {
         $user= User::find(Auth::id());
         $myuid = $user->uid;
         $match_uid = User::find($request->targetsUid)->uid;
         $user_action = $user->useractions_by_auth_user()->where("match_id",$request->targetsUid)->first();
         if(empty($user_action))
         {
             $user->useractions_by_auth_user()->create(
                [
                    "match_id" => $request->targetsUid,
                    "disliked" => false,
                    "liked" => false,
                    "fancy" => false,
                    "superlike" => false,
                    "matched" => false,
                    "is_blocked" => true,
                    "report_detail_id" => 0,
                ]);
         }else
         {
             $response["update"] =  $user_action->update(["is_blocked" => true]);
         }
         // $commet_resopnse = $this->friend_block_chat($myuid,$match_uid);
         return response()->json(["status" => true,"message" =>  "user blocked"], 200);
    }
    
    public function block_user_by_me(request $request)
    {
        $user = User::find(Auth::id());
        $response = $user->useractions_by_auth_user()->create(
        [
            "match_id" => $request->targetsUid,
            "disliked" => false,
            "liked" => false,
            "fancy" => false,
            "superlike" => false,
            "matched" => false,
            "is_blocked" => true,
            "report_detail_id" => 0,
        ]);
        UserAction::where("match_id",Auth::id())->where("user_id",$request->targetsUid);
        return response()->json(["status" => true,"message" =>  "user blocked" ], 200);
    }

    public function unblock_user(request $request)
    {
      $user= User::find(Auth::id());
      $myuid = $request->myUid;
      $match_uid = $request->targetsUid;
      $match_id = User::where("uid",$match_uid)->first();
      $user_actions = $user->useractions_by_auth_user()->where("match_id",$match_id->id)->first();
      if($user_actions->liked == true || $user_actions->fancy == true || $user_actions->superlike == true)
      {
        $user_actions->update(["is_blocked" => false]);
      }
      else
      {
        $user_actions->delete();
      }
      $commet_resopnse = $this->friend_unblock_chat($myuid,$match_uid);
      return response()->json(["status" => "true","message" => " user unblocked"], 200);
    }

    function unmatch_user(request $request)
    {
        $user = User::find(Auth::id());
        $myuid = $user->uid;
        $match_uid = User::find($request->targetsUid)->uid;
        $response[] = $user->useractions_by_auth_user()
        ->where("match_id",$request->targetsUid)
        ->delete();
        $response[] = $user->useractions()
        ->where("match_id",$user->id)
        ->delete();
        $commet_resopnse = $this->friend_delete_chat($myuid,$match_uid);
        return response()->json(["status" => "true","message" => "User removed"], 200);
    }
    function unmatch2_user(request $request)
    {
        $user = User::find(Auth::id());
        $myuid = $user->uid;
        $match_id = User::where("uid",$request->targetsUid)->first();
        $response[] = $user->useractions_by_auth_user()
        ->where("match_id",$match_id->id)
        ->delete();
        $response[] = $user->useractions()
        ->where("match_id",$user->id)
        ->delete();
        $commet_resopnse = $this->friend_delete_chat($myuid,$match_id->uid);
        return response()->json(["status" => "true","message" => "User removed"], 200);
    }
    public function get_block_profile(Request $request)
    {
        $blocked_profile = UserAction::with("who_i_blocked")->select(["id","user_id","match_id"])
        ->where(["user_id" => auth::id() , "is_blocked" => true])->get();
        return response()->json(["status" => true , "message" => "query completed","blocked_profiles" => $blocked_profile], 200);
    }
    public function get_subscription(Request $request)
    {
        $user = Users_subcribtion::where("user_id", Auth::id())->get();
        return response()->json(["status" => true , "message" => "query completed", "Subscriptions" => $user  ], 200);

    }
    public function cancel_subscription(request $request)
    {
        $user = auth::user();
        $local_subscription =  $user->subscription()->where("id","=", $request->subscription_id)->first();
        $stripe_customer = Cashier::findBillable(auth::user()->stripe_id);
        $package = Package::where("id","=",$local_subscription->pkg_id)->first();
        if($stripe_customer != null)
        {
        $stripe_subscriptions =  $stripe_customer->subscriptions()->where('stripe_plan',$package->stripe_plan)->first();  
        if(!empty($stripe_subscriptions)){
            $response= $this->stripe->subscriptions->cancel(
             $stripe_subscriptions->stripe_id,
             []
            );  
            $stripe_subscriptions->update(["ends_at" => Carbon::now() , "stripe_status" => "canceled"]);    
        }
        }
       
        $local_subscription->update(["status" => 2]);
        $user->activate_spotlights()->where(["status"=>1])->update(["status" => "2"]);
        $user->user_settings()->where(["type"=>"privacy"])->update(["value" => "public"]);
        $this->send_notifications(array("title"=> "subscription canceled" , "body" => "your subscription has been successfully canceled!"));
        return response()->json(["status" => true , "message" => "subscription Canceled", "request" => $request->all()], 200);
    }
    public function who_see_profile(request $request)
    {   
        $user = User::find(auth::id());
        $user_privacy = $user->user_settings()->where("type","privacy")->first();
        if(empty($user_privacy))
        {
           $response_setting["create"] =$user->user_settings()->create([
                    "type" => "privacy",
                    "value"=> $request->option,
                    "status"=>1
            ]);
            // $user->user_allow_profile()->delete();
        }
        else
        {
            $response_setting["update"] = $user_privacy->update([
                     "type" => "privacy",
                     "value"=> "$request->option",
                     "status"=>1
            ]);
            // $user->user_allow_profile()->delete();
        }
        if($request->option == "choose")
        {
		   $user->user_allow_profile()->delete();
            foreach($request->users  as $u_id){
                $response_setting["allow_users"][] = $user->user_allow_profile()->create([
                        "profile_id" => $u_id
                ]);
            }
        }

        return response()->json(["status" => true , "message" => "record saved","user_privacy" => $user_privacy ,"response_setting" => $response_setting], 200);   
    }
	
	public function Members_recommendations(request $request)
	{
		$user = auth::user();
        $user_privacy = $user->user_settings()->where("type","member_recommendations")->first();
        if(empty($user_privacy))
        {
		 $response_setting["create"] =$user->user_settings()->create([
                    "type" => "member_recommendations",
                    "value"=>  Str::slug($request->membersRecommendations,"_"),
                    "status"=>1
            ]);
		}
		else{
		 $response_setting["update"] = $user_privacy->update([
                     "type" => "member_recommendations",
                     "value"=>  Str::slug($request->membersRecommendations,"_"),
                     "status"=>1
            ]);
		}
	   return response()->json(["status" => true , "message" => "record saved","user_privacy" => $user_privacy ,"response_setting" => $response_setting]); 
	}
    public function chooseWhoSeeYou(request $request)
    {
        return response()->json(["status" => true , "message" => "get records"], 200);
    }
    public function report_user(request $request)
    {
        $user = Auth::user();
        $already_report = $user->user_report()->where("target_id",$request->targetuid)->first();
        if(empty($already_report))
        {
            $resp = $user->user_report()->create([
                "target_id" => $request->targetuid,
                "reason" => $request->reason,
            ]);
             $reports = user_report::where("target_id",$request->targetuid)->count();
             if($reports >= 3)
             {
                $resp["status_change"] = User::where("id",$request->targetuid)->update(["active" => 3]);
             }
             return response()->json(["status" => true , "message" => "User has been report Successfully!" , "response" => $resp], 200);
        } 
        return response()->json(["status" => false , "error" => "User already Reported" ], 200);
    }
    public function get_all_notications()
    {
        //$notification = Auth::user()->user_notification()->orderby("id","desc")
        //->where("is_remove",false)
        //->get();
		
		$notification = user_notification::with('users','target_user',"active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_image",
          )->where('target_id',Auth::id())->get();
        return response()->json(["status" => true , "notification" => $notification], 200);
    }
    public function remove_notications(request $request)
    {
        $response["update"] = Auth::user()->user_notification()
        ->where("id",$request->id)
        ->update(
            ["is_remove" => true] 
        );
        return response()->json(["status" => true,"message" => "notification removed" , "response" => $response], 200);
    }
    public function view_notications(request $request)
    {
        $response["update"] = Auth::user()->user_notification()
        ->where("id",$request->id)
        ->update(
            ["is_viewed" => true] 
        );
        return response()->json(["status" => true,"message" => "notification removed" , "response" => $response], 200);
    }

    //Saad comment these code
	public function view_notications_app(request $request)
    {
        $response = Auth::user()->user_notification_app()->get();
        return response()->json(["status" => true,"message" => "notifications" , "response" => $response], 200);
    }
	
    public function change_password(Request $request)
    {
       
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);
        
        if($validator->fails())
        {
            return response()->json(['success'=>false,'error'=> $validator->errors()->first()]);       
        }
          $user = Auth::user();
  
        if (!Hash::check($request->old_password,$user->password)) 
        {
            return response()->json(['success'=>false,'error'=> 'old password is Invalid']);
        }
            $user->password = Hash::make($request->new_password);
            $user->save();

            
        $users = User::with("Location",'prefrences')->find(Auth::id());
        return response()->json(["status" => true ,'message'=>'Password Has Been Changed Successfully',"user"=>$users], 200);         
    }
    public function change_email(request $request)
    {
        
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
            ]);
            if ($validator->fails()) 
            {    
                return response()->json(["status" => false,"message" =>  implode(", ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
            }else
            {
                $response = Auth::user()->update(["email" => $request->email ,"email_verified" => 0]);
                return response()->json(["status" => true , "message" => "Email change kindly verify your email!","response" => $response ], 200);
            }

    }
    public function feedback(request $request)
    {

          $validator = Validator::make($request->all(), [
            'email' => 'required|unique:user_feedbacks',
            'body' => 'required',
            ]);
            if ($validator->fails()) 
            {    
                return response()->json(["status" => false,"message" =>  implode(", ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
            }
            else
            {
                auth::user()->user_feedback()->create($request->all());
                \Mail::to('feedback@qavah.us')->send(new \App\Mail\FeedbacktMail($request->all()));

                 return response()->json(["status" => false,"message" => "your feedback successfully submited"], 200);
            }
   
    }














   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    private function friend_block_chat($uid,$match_uid)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST','https://'.config("commetchat.publicKey").'.api-us.cometchat.io/v3/users/'.$uid.'/blockedusers', [
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'apiKey' => config("commetchat.apiKey"),
        ],
        'body' => '{"blockedUids":["'.$match_uid.'"]}', 
        ]);
        return $response->getBody();
    }
    private function friend_unblock_chat($uid,$match_uid)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('DELETE','https://'.config("commetchat.publicKey").'.api-us.cometchat.io/v3/users/'.$uid.'/blockedusers', [
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'apiKey' => config("commetchat.apiKey"),
        ],
        'body' => '{"blockedUids":["'.$match_uid.'"]}', 
        ]);
        return $response->getBody();
    }
    private function friend_delete_chat($uid,$match_uid)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('DELETE','https://'.config("commetchat.publicKey").'.api-us.cometchat.io/v3/users/'.$uid.'/friends', [
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'apiKey' => config("commetchat.apiKey"),
        ],
        'body' => '{"friends":["'.$match_uid.'"]}', 
        ]);
        return $response->getBody();
    }




}
