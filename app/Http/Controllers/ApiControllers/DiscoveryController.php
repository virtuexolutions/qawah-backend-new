<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Rules\Useractionrule;
use Validator;

class DiscoveryController extends Controller
{
    //
    public function get_peoples(request $request)
    {
		
      $current_time  = Carbon::now();
       $user = Auth::user();
		$user->seeking;
      $peoples =  
      User::with([
      "user_profile_verified",
      "useractions",
      "Location",
	  "fetch_user_report",
      "gallery_images",
      "profile_images",
      "isrealitePracticeKeeping",
      "kingdomGifts",
      "passions"])
      ->select("users.*","users_location.city","latitude","longitude","state","state_abbr",DB::raw("6371 * acos(cos(radians(" . $request->lat . ")) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(" . $request->lng . ")) 
                        + sin(radians(" .$request->lat. ")) 
                        * sin(radians(latitude))) AS distance"
      ),
      DB::raw("(select count(*) from user__activate__spotlights where users.id = user__activate__spotlights.user_id AND expire_time > '".$current_time."' AND  user__activate__spotlights.status = 1) as spotlight_status")
      ) 
      ->join("users_location","users_location.user_id","=","users.id")
      ->whereHas("Location",function($query) {
        $query->select(["id"]);
       })
      ->whereDoesntHave('useractions', function ($query) use($user)  {
        $query->where('user_id','=',$user->id);
        })
       ->whereDoesntHave('useractions_by_auth_user', function ($query) use($user) {
          $query->where('match_id','=',$user->id);
        })
 //     ->where('users.iAm', '=',$user->seeking)
      ->where('users.id', '!=',$user->id)
      ->where('mobile_verified', '=', true)
      ->where('email_verified', '=', true)
      ->orderby("spotlight_status","desc")
      ->orderby("distance","asc")
      ->get();
      return response()->json(["status" => true ,"peoples" => $peoples ],200);
    }


    // Saad Commit this code
    public function users_spotlight(request $request)
    {
      
      
      //  $users = User_Activate_Spotlight::with('user','profile_images')->get();
      $users = User::with(
        "user_spotlights",
        "user_profile_verified",
      "useractions",
		  "fetch_user_report",
      "Location",
      "gallery_images",
      "profile_images",
      "isrealitePracticeKeeping",
      "kingdomGifts",
      "passions"
      )->get();

      return response()->json(["status" => true, "message" => "spotlight activate users","users" => $users], 200);
    }
    
    public function liked(request $request)
    {

      $validator = Validator::make($request->all(), [
      'targetsUid' => ['required',new Useractionrule],
      ]);
      if ($validator->fails()) 
      {    
          return response()->json(["status" => false,"error" =>  implode(", <br/> ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
      } 
      $user = Auth::user();
      $match_user = User::find($request->targetsUid);
      $matched = false;
      $r2 = UserAction::where("match_id","=",$user->id)
      ->where("user_id","=",$request->targetsUid)
      ->where("matched","=",false)
      ->first();
      $myuid = $user->uid;
      $match_uid = $match_user->uid;  
      $match_uid = User::find($request->targetsUid)->uid;  
      if(empty($r2)){
        
        $user = User::find(Auth::id());
        $response = $user->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetsUid,
              "disliked" => false,
              "liked" => true,
              "fancy" => false,
              "superlike" => false,
              "matched" => false,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        $this->send_notifications(array("title"=> $match_user->profileName." Kan by you" , "body" =>  $match_user->profileName." Kan by you" ));
       // $this->send_target_notifications($match_user->id,array("title"=> $user->profileName." Kan You " , "body" =>  $user->profileName." Kan You "));
		  
		  //saad code
		  $this->send_target_notifications_app(Auth::id(),$match_user->id,array("type"=> 'invitation',"title"=> $user->profileName." invites you for a match" , "body" =>  $user->profileName." invites you for a match "));
      }
      else
      {
        $response["second"] = $user->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetsUid,
              "disliked" => false,
              "liked" => true,
              "fancy" => false,
              "superlike" => false,
              "matched" => true,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        if(!empty($r2))
        {
           $response["r2_response"] = $r2->update(["matched" => true]);
           $matched = true;
           $response["chatbot_status_response"] = $this->friend_match_chat($myuid,$match_uid);
           $response["notification_1"] = $this->send_notifications(array("title"=> "Matched" , "body" =>  "Congrats You Match With "." $match_user->profileName "));
			
           //$response["notification_2"] =  $this->send_target_notifications($match_user->id,array("title"=> "Matched" , "body" =>  "Congrats You Match With "." $user->profileName "));
			$response["notification_2"]=$this->send_target_notifications_app_update(Auth::id(),$match_user->id,array("title"=> $user->profileName." invites you for a match" , "body" =>  $user->profileName." Congrats You Match With"));
          
        } 
      }
      return response()->json(["status" => true,"matched" => $matched ,"peoples" => $response],200);
    }
    public function fancy(request $request)
    {
      $validator = Validator::make($request->all(), [
      'targetsUid' => ['required',new Useractionrule],
      ]);
      if ($validator->fails()) 
      {    
          return response()->json(["status" => false,"error" =>  implode(", <br/> ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
      }
      
      $matched = false;
      $user = User::find(Auth::id());
      $match_user = User::find($request->targetsUid);
      $r2 = UserAction::where("match_id","=",$user->id)
      ->where("user_id","=",$request->targetsUid)
      ->where("matched","=",false)
      ->first();
      $myuid = $user->uid;
      $match_uid = $match_user->uid;  
      if(empty($r2)){
        $user = User::find(Auth::id());
        $response = $user->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetsUid,
              "disliked" => false,
              "liked" => false,
              "fancy" => true,
              "superlike" => false,
              "matched" => false,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        $response["notification_1"] = $this->send_notifications(array("title"=> $match_user->profileName." fancy by you" , "body" =>  $match_user->profileName." fancy by you" ));
        $response["notification_2"] =  $this->send_target_notifications($match_user->id,array("title"=> $user->profileName." fancy You " , "body" =>  $user->profileName." fancy You "));
      
      }
      else
      {
        $response["second"] = $user->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetsUid,
              "disliked" => false,
              "liked" => false,
              "fancy" => true,
              "superlike" => false,
              "matched" => true,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        if(!empty($r2))
        {
           $response["r2_response"] = $r2->update(["matched" => true]);
           $matched = true;
           $response["chatbot_status_response"] = $this->friend_match_chat($myuid,$match_uid);
           $response["notification_1"] = $this->send_notifications(array("title"=> "Matched" , "body" =>  "Congrats You Match With "." $match_user->profileName "));
           $response["notification_2"] =  $this->send_target_notifications($match_user->id,array("title"=> "Matched" , "body" =>  "Congrats You Match With "." $user->profileName "));
        } 
      }
      return response()->json(["status" => true,"matched" => $matched ,"peoples" => $response],200);

    }
    public function superliked(request $request)
    {
      $validator = Validator::make($request->all(), [
      'targetsUid' => ['required',new Useractionrule],
      ]);
      if ($validator->fails()) 
      {    
          return response()->json(["status" => false,"error" =>  implode(", <br/> ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
      }
      $matched = false;
      $user = User::find(Auth::id());
      $match_user = User::find($request->targetsUid);
      $r2 = UserAction::where("match_id","=",$user->id)
      ->where("user_id","=",$request->targetsUid)
      ->where("matched","=",false)
      ->first();
      $myuid = $user->uid;
      $match_uid = $match_user->uid;  
      if(empty($r2)){
        
        $user = User::find(Auth::id());
        $response = $user->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetsUid,
              "disliked" => false,
              "liked" => false,
              "fancy" => false,
              "superlike" => true,
              "matched" => false,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        $response["notification_1"] = $this->send_notifications(array("title"=> $match_user->profileName." Superfancy by you" , "body" =>  $match_user->profileName." Superfancy by you" ));
        $response["notification_2"] =  $this->send_target_notifications($match_user->id,array("title"=> $user->profileName." Superfancy You " , "body" =>  $user->profileName." Superfancy You "));
      }
      else
      {
        $response["second"] = $user->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetsUid,
              "disliked" => false,
              "liked" => true,
              "fancy" => false,
              "superlike" => true,
              "matched" => true,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        if(!empty($r2))
        {
           $response["r2_response"] = $r2->update(["matched" => true]);
           $matched = true;
           $response["chatbot_status_response"] = $this->friend_match_chat($myuid,$match_uid);
           $response["notification_1"] = $this->send_notifications(array("title"=> "Matched" , "body" =>  "Congrats You Match With "." $match_user->profileName "));
           $response["notification_2"] =  $this->send_target_notifications($match_user->id,array("title"=> "Matched" , "body" =>  "Congrats You Match With "." $user->profileName "));
        } 
      }
      return response()->json(["status" => true,"matched" => $matched ,"peoples" => $response],200);

    }
    public function disliked(request $request)
    {
      $validator = Validator::make($request->all(), [
       'targetsUid' => ['required',new Useractionrule],
      ]);
      if ($validator->fails()) 
      {    
          return response()->json(["status" => false,"error" =>  implode(", <br/> ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
      }
      $reponse = User::find(Auth::id())->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetsUid,
              "disliked" => true,
              "liked" => false,
              "superlike" => false,
              "matched" => false,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        return response()->json(["status" => true ,"peoples" => $reponse],200);
    }
    public function rewind(request $request)
    {
         $user = User::find(Auth::id());
         $user->useractions_by_auth_user()->where("match_id",$request->targetsUid)->delete();
         $reponse["user"] = $user->useractions_by_auth_user()->where("match_id",$request->targetsUid)->delete();
         $reponse["target_user"] = User::find($request->targetsUid); //saad commit these code
         $myuid = $user->uid;
         $target_id =  User::find($request->targetsUid)->uid;
         $reponse["chat"] =''; //$this->friend_delete_chat($myuid,$target_id);
         return response()->json(["status"=>true , "message" => "rewind completed","response" => $reponse], 200);
    }
    public function removed(request $request)
    {
     $reponse = User::find(Auth::id())->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetsUid,
              "disliked" => true,
              "liked" => false,
              "superlike" => false,
              "matched" => false,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        return response()->json(["status" => true ,"peoples" => $reponse],200);
    }
    public function activate_spotlight(request $request)
    {
      
        $Remain_spotlight = 0;
        $subscribe_id = 0;
        $user =Auth::user(); 
        $subscriptions = $user->subscription();
        $platinum_spotlights = $subscriptions->leftjoin("user_spotlights","user_spotlights.subsciption_id","=","user_subscriptions.id")
        ->select(["user_subscriptions.id","user_subscriptions.pkg_catogery",
         DB::raw("
            (sum(user_spotlights.spotlight) - IFNULL((select SUM(1) as spotlight from user__activate__spotlights where subscription_id = user_subscriptions.id),0)) as total_spotlights
          ")
         ])
        ->where("user_spotlights.end_date","<=", Carbon::now()->addmonths(1))
        ->where("pkg_catogery","=", "platinum")
        ->where("pkg_catogery","=", "month_to_month")
        ->where("status","=", "1")
        ->groupBy("user_subscriptions.id","user_subscriptions.pkg_catogery")
        ->first();
        $Remain_spotlight = $platinum_spotlights->total_spotlights ?? "0";
        if($Remain_spotlight === "0")
        {
          $spotlights_addons = $user->subscription()->leftjoin("user_spotlights as b","b.subsciption_id","=","user_subscriptions.id")
          ->select(["user_subscriptions.id","user_subscriptions.pkg_catogery",
            DB::raw("
               (SUM(b.spotlight) -  IFNULL((select SUM(1) as spotlight from user__activate__spotlights where subscription_id = user_subscriptions.id ),0)) as total_spotlights
            ")
          ])
          ->where("b.end_date","<=", Carbon::now()->addYear(1))
         ->groupBy(["user_subscriptions.id","user_subscriptions.pkg_catogery"])
          ->get();
          if(!empty($spotlights_addons ))
          {
              foreach($spotlights_addons as $rs)
              {
                  if($rs["total_spotlights"] > 0 &&  $subscribe_id == 0 )
                  {
                    $subscribe_id =  $rs["id"];
                  }
                  $Remain_spotlight += $rs["total_spotlights"];
              }
          }
          else
          {
            $Remain_spotlight = "0";
          }
        }
        else
        {
            $subscribe_id = $platinum_spotlights->id;
        }
        if($Remain_spotlight > 0)
        {
          $datetime =  Carbon::now();
          $exist_spotlight = $user->activate_spotlights()
          ->where("expire_time",">=", $datetime)
          ->where("status","=",1)->first();
          if(!empty($exist_spotlight))
          {
             return response()->json(["status" => true, "message" => "spotlight already activated"], 200);
          }
          else
          {
              $resp =  $user->activate_spotlights()->create([
                "subscription_id" => $subscribe_id,
                "expire_time" => $datetime->addMinutes(60),
              ]);
             return response()->json(["status" => true, "message" => "spotlight activated","resp" => $resp], 200);
          }
        }
        else
        {
         return response()->json(["status" => false, "error" => "you not have not enough spotlights kindly purchase package"], 200);
        }

    } 
    public function love_note(request $request)
    {
      $user = Auth::user();
      $target_user = User::find($request->targetUid);
      $exist = $user->user_lovenote()
      ->where("match_id","=",$request->targetUid)
      ->where("status","=",1)
      ->first();
      $target_exist = $user->love_note_by_user()
      ->where("user_id","=",$request->targetUid)
      ->where("status","=",1)
      ->first();
      $user_action = $user->useractions_by_auth_user()->where("match_id","=",$request->targetUid)->first();;
      $target_user_action = $user->useractions()->where("user_id","=",$request->targetUid)->first();;
      
      if(empty($exist))
      {
       $current_create = $user->user_lovenote()->create([
             "match_id" => $request->targetUid,
             "love_notes" => $request->love_note
       ]);
       $current_action =  $user->useractions_by_auth_user()->create(
          [
              "match_id" => $request->targetUid,
              "disliked" => false,
              "liked" => false,
              "fancy" => true,
              "superlike" => false,
              "matched" => false,
              "is_blocked" => false,
              "report_detail_id" => 0,
          ]
        );
        $this->send_lovenotes($user->uid,$target_user->uid,$request->love_note);
        if(empty($exist)  && empty($target_exist))
        {
          return response()->json(["status"=> true, "message" => "Lovenote has been send"], 200);
        }
        else if(empty($exist)  && !empty($target_exist) && !empty( $target_user_action))
        {
          $target_exist->update(["status" => 0]);
          $current_create->update(["status" => 0]);
          $current_action->update(["matched" => 1]);
          $target_user_action->update(["matched" => 1]);
          $this->friend_match_chat($user->uid,$target_user->uid);
          return response()->json(["status"=> true, "message" => "Hurrah you both are freinds enjoy!"], 200);
  
        }
      }
      else
      {
          return response()->json(["status"=> false, "message" => "you already send lovenote wait for a response"], 200);
      }
    }
    
    private function send_lovenotes($uid,$match_uid,$message)
    {
          $client = new \GuzzleHttp\Client();
          $response = $client->request('POST','https://'.config("commetchat.publicKey").'.api-us.cometchat.io/v3/messages', [
          'body' => '{"category":"message","type":"text","data":{"text":"'.$message.'"},"receiverType":"user","receiver":"'.$match_uid.'"}',
          'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'apiKey' =>  config("commetchat.apiKey"),
            'onBehalfOf' => $uid,
          ],
        ]);
        return $response->getBody();
    }
  
    private function friend_match_chat($uid,$match_uid)
    {
      $client = new \GuzzleHttp\Client();
      $response = $client->request('POST','https://'.config("commetchat.publicKey").'.api-us.cometchat.io/v3/users/'.$uid.'/friends', [
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json',
          'apiKey' =>  config("commetchat.apiKey"),
        ],
        'body' => '{"accepted":["'.$match_uid.'"]}', 
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

    
