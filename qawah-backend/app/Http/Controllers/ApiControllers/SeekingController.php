<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\UserAction;
use App\User;
use App\user_saved_filter;
use App\user_filter;
class SeekingController extends Controller
{
    //

    public function get_users(request $request)
    {
        $date =  Carbon::now();
        $user = Auth::user();
        $preferences = $user->preferences()->first();
        

        $current_time  = Carbon::now()->format('H:i:s');
        $format_filter = array();
        foreach($request->filters as $flt)
        {
          $format_filter[$flt['key']] =   $flt['values'];
        }
        $peoples = User::with(["active_spotlights",
        "useractions",
        "login_status",
        "Location",
        "gallery_images",
        "profile_images",
        "isrealitePracticeKeeping",
		"user_login_log",
        "kingdomGifts",
        "passions"])
        ->select("users.*","users_location.city","latitude","longitude","state","state_abbr",
        DB::raw("(6371 * acos(cos(radians(" . $request->lat . ")) 
                          * cos(radians(latitude)) 
                          * cos(radians(longitude) - radians(" . $request->lng . ")) 
                          + sin(radians(" .$request->lat. ")) 
                          * sin(radians(latitude))))
                          AS distance"
        ),
        DB::raw("(select count(*) from user__activate__spotlights where users.id = user__activate__spotlights.user_id AND expire_time > '".$current_time."' AND  user__activate__spotlights.status = 1) as spotlight_status")
        ) 
        ->join("users_location","users_location.user_id","=","users.id")
        ->where("iAm",$format_filter["seeking"][0])
        ->whereBetween("age",$format_filter["age"])
        ->whereDoesntHave('useractions', function ($query) {
          $query->where('user_id','=',Auth::id());
        })
        ->whereDoesntHave('useractions_by_auth_user', function ($query) {
          $query->where('match_id','=',Auth::id());
        });
        if($preferences->global == false){
          $peoples->wherehas('Location', function ($query) use($format_filter) {
            $query->where('zipcode',$format_filter["zipcode"][0]);
          });
        }
        if(!empty($format_filter["isrealitePracticeKeeping"])){
          $peoples->wherehas('isrealitePracticeKeeping', function ($query) use($format_filter) {
            $query->whereIn('options',$format_filter["isrealitePracticeKeeping"]);
          });
        }
        if(!empty($format_filter["kingdomGiftsTags"])){
          $peoples->wherehas('kingdomGifts', function ($query) use($format_filter) {
            $query->whereIn('options',$format_filter["kingdomGiftsTags"]);
          });
        }
        if(!empty($format_filter["passionsTags"])){
          $peoples->wherehas('passions', function ($query) use($format_filter) {
            $query->whereIn('options',$format_filter["passionsTags"]);
          });
        }
		  if(!empty($format_filter["visibility"]) && $format_filter["visibility"][0] == 'online_now')  
          {
            $peoples->wherehas('user_login_log', function ($query) use($date) {
           			 $query->where('last_activity','>',$date->subSecond(60));
			  });
          }
			if(!empty($format_filter["visibility"]) && $format_filter["visibility"][0] == 'last30days')  
          {
            $peoples->wherehas('user_login_log', function ($query) use($date) {
           			 $query->where('last_activity','>',$date->subDays(30));
			  });
          }
		if(!empty($format_filter["visibility"]) && $format_filter["visibility"][0] == 'last24hours')  
          {
            $peoples->wherehas('user_login_log', function ($query) use($date) {
           			 $query->where('last_activity','>',$date->subDays(1));
			  });
          }
			if(!empty($format_filter["visibility"]) && $format_filter["visibility"][0] == 'have_photos')  
          {
            $peoples->wherehas('profile_images', function ($query) {
           			 $query->where('url','!=',null);
			  });
          }
          if(!empty($format_filter["doYouWantMoreChildren"]))
          {
            $peoples->WhereIn("doYouWantMoreChildren",$format_filter["doYouWantMoreChildren"]);
          }
		  if(!empty($format_filter["visibility.search"]))
          {
            $peoples->where("aboutMe",'like', '%' .$format_filter["visibility.search"][0]. '%');
          }
		
		
          if(!empty($format_filter["doYouHaveChildren"]))
          {
            $peoples->WhereIn("doYouHaveChildren",$format_filter["doYouHaveChildren"]);
          }
          if(!empty($format_filter["howOftenDoYouExercise"]))
          {
            $peoples->WhereIn("howOftenDoYouExercise",$format_filter["howOftenDoYouExercise"]);
          }
          if(!empty($format_filter["doYouDrink"]))
          {
            $peoples->WhereIn("doYouDrink",$format_filter["doYouDrink"]);
          }
          if(!empty($format_filter["doYouSmoke"]))
          {
            $peoples->WhereIn("doYouSmoke",$format_filter["doYouSmoke"]);
          }
          if(!empty($format_filter["havePets"]))
          {
            $peoples->WhereIn("havePets",$format_filter["havePets"]);
          }
          if(!empty($format_filter["relationshipIAmSeeking"]))
          {
            $peoples->WhereIn("relationshipIAmSeeking",$format_filter["relationshipIAmSeeking"]);
          }
          if(!empty($format_filter["bodyType"]))
          {
            $peoples->WhereIn("bodyType",$format_filter["bodyType"]);
          }
          if(!empty($format_filter["bodyType"]))
          {
            $peoples->WhereIn("bodyType",$format_filter["bodyType"]);
          }
          if(!empty($format_filter["maritalStatus"]))  
          {
            $peoples->WhereIn("maritalStatus",$format_filter["maritalStatus"]);
          }
          if(!empty($format_filter["livingSituation"]))
          {
            $peoples->WhereIn("livingSituation",$format_filter["livingSituation"]);
          }
          if(!empty($format_filter["employmentStatus"]))
          {
            $peoples->WhereIn("employmentStatus",$format_filter["employmentStatus"]);
          }
            if(!empty($format_filter["willingToRelocate"]))
          {
            $peoples->WhereIn("willingToRelocate",$format_filter["willingToRelocate"]);
          }
          if(!empty($format_filter["iBelieveIAM"]))
          {
            $peoples->WhereIn("iBelieveIAM",$format_filter["iBelieveIAM"]);
          }
          if(!empty($format_filter["maritalBeliefSystem"])) 
          {
            $peoples->WhereIn("maritalBeliefSystem",$format_filter["maritalBeliefSystem"]);
          }
          if(!empty($format_filter["studyHabits"])) 
          {
            $peoples->WhereIn("studyHabits",$format_filter["studyHabits"]);
          }
          if(!empty($format_filter["anyAffiliation"])) 
          {
            $peoples->WhereIn("anyAffiliation",$format_filter["anyAffiliation"]);
          }
          if(!empty($format_filter["yearsInTruth"]))  
          {
            $peoples->WhereIn("yearsInTruth",$format_filter["yearsInTruth"]);
          }
          if(!empty($format_filter["spiritualBackground"]))  
          {
            $peoples->WhereIn("spiritualBackground",$format_filter["spiritualBackground"]);
          }
	
          $peoples->where("users.id","!=",Auth::id())
          ->where('users.id', '!=', Auth::id())
          ->where('mobile_verified', '=', true)
          ->where('email_verified', '=', true)
          ->having("distance","<=", $format_filter["miles"][0])
          ->orderby("spotlight_status","desc")
          ->orderby("distance","asc");  
          $data = $peoples->get();
          return response()->json(["status" => true , "message" => "query Execute", "peoples" => $data ], 200);
      }



    // Saad Commit these code
    public function get_users_app(request $request)
    {
        $date =  Carbon::now();
        $user = Auth::user();
        $preferences = $user->preferences()->first();
        // $seeking = ($user->seeking == 'men') ? 'women' : 'men' ;

        $current_time  = Carbon::now()->format('Y-m-d H:i:s');
        $format_filter = array();
        foreach($request->filters as $flt)
        {
          $format_filter[$flt['key']] =   $flt['values'];
        }
        $peoples = User::with(["active_spotlights",
        "useractions",
        "login_status",
        "Location",
        "gallery_images",
        "profile_images",
        "isrealitePracticeKeeping",
		    "user_login_log",
        "kingdomGifts",
        "passions"])
        ->select("users.*","users_location.city","latitude","longitude","state","state_abbr",
        DB::raw("(6371 * acos(cos(radians(" . $request->lat . ")) 
                          * cos(radians(latitude)) 
                          * cos(radians(longitude) - radians(" . $request->lng . ")) 
                          + sin(radians(" .$request->lat. ")) 
                          * sin(radians(latitude))))
                          AS distance"
        ),
        DB::raw("(select count(*) from user__activate__spotlights where users.id = user__activate__spotlights.user_id AND expire_time > '".$current_time."' AND  user__activate__spotlights.status = 1) as spotlight_status")
        ) 
        ->join("users_location","users_location.user_id","=","users.id")
        ->where("iAm",$format_filter["seeking"][0])
        ->whereBetween("age",$format_filter["age"])
        ->whereDoesntHave('useractions', function ($query) {
          $query->where('user_id','=',Auth::id());
        })
        ->whereDoesntHave('useractions_by_auth_user', function ($query) {
          $query->where('match_id','=',Auth::id());
        });
        if($preferences->global == false){
          $peoples->wherehas('Location', function ($query) use($format_filter) {
            $query->where('zipcode',$format_filter["zipcode"][0]);
          });
        }
        if(!empty($format_filter["isrealitePracticeKeeping"])){
          $peoples->wherehas('isrealitePracticeKeeping', function ($query) use($format_filter) {
            $query->whereIn('options',$format_filter["isrealitePracticeKeeping"]);
          });
        }
        if(!empty($format_filter["kingdomGiftsTags"])){
          $peoples->wherehas('kingdomGifts', function ($query) use($format_filter) {
            $query->whereIn('options',$format_filter["kingdomGiftsTags"]);
          });
        }
        if(!empty($format_filter["passionsTags"])){
          $peoples->wherehas('passions', function ($query) use($format_filter) {
            $query->whereIn('options',$format_filter["passionsTags"]);
          });
        }
		  if(!empty($format_filter["visibility"]) && $format_filter["visibility"][0] == 'online_now')  
          {
            $peoples->wherehas('user_login_log', function ($query) use($date) {
           			 $query->where('last_activity','>',$date->subSecond(60));
			  });
          }
			if(!empty($format_filter["visibility"]) && $format_filter["visibility"][0] == 'last30days')  
          {
            $peoples->wherehas('user_login_log', function ($query) use($date) {
           			 $query->where('last_activity','>',$date->subDays(30));
			  });
          }
		if(!empty($format_filter["visibility"]) && $format_filter["visibility"][0] == 'last24hours')  
          {
            $peoples->wherehas('user_login_log', function ($query) use($date) {
           			 $query->where('last_activity','>',$date->subDays(1));
			  });
          }
			if(!empty($format_filter["visibility"]) && $format_filter["visibility"][0] == 'have_photos')  
          {
            $peoples->wherehas('profile_images', function ($query) {
           			 $query->where('url','!=',null);
			  });
          }
          if(!empty($format_filter["doYouWantMoreChildren"]))
          {
            $peoples->WhereIn("doYouWantMoreChildren",$format_filter["doYouWantMoreChildren"]);
          }
		  if(!empty($format_filter["visibility.search"]))
          {
            $peoples->where("aboutMe",'like', '%' .$format_filter["visibility.search"][0]. '%');
          }
		
		
          if(!empty($format_filter["doYouHaveChildren"]))
          {
            $peoples->WhereIn("doYouHaveChildren",$format_filter["doYouHaveChildren"]);
          }
          if(!empty($format_filter["howOftenDoYouExercise"]))
          {
            $peoples->WhereIn("howOftenDoYouExercise",$format_filter["howOftenDoYouExercise"]);
          }
          if(!empty($format_filter["doYouDrink"]))
          {
            $peoples->WhereIn("doYouDrink",$format_filter["doYouDrink"]);
          }
          if(!empty($format_filter["doYouSmoke"]))
          {
            $peoples->WhereIn("doYouSmoke",$format_filter["doYouSmoke"]);
          }
          if(!empty($format_filter["havePets"]))
          {
            $peoples->WhereIn("havePets",$format_filter["havePets"]);
          }
          if(!empty($format_filter["relationshipIAmSeeking"]))
          {
            $peoples->WhereIn("relationshipIAmSeeking",$format_filter["relationshipIAmSeeking"]);
          }
          if(!empty($format_filter["bodyType"]))
          {
            $peoples->WhereIn("bodyType",$format_filter["bodyType"]);
          }
          if(!empty($format_filter["bodyType"]))
          {
            $peoples->WhereIn("bodyType",$format_filter["bodyType"]);
          }
          if(!empty($format_filter["maritalStatus"]))  
          {
            $peoples->WhereIn("maritalStatus",$format_filter["maritalStatus"]);
          }
          if(!empty($format_filter["livingSituation"]))
          {
            $peoples->WhereIn("livingSituation",$format_filter["livingSituation"]);
          }
          if(!empty($format_filter["employmentStatus"]))
          {
            $peoples->WhereIn("employmentStatus",$format_filter["employmentStatus"]);
          }
            if(!empty($format_filter["willingToRelocate"]))
          {
            $peoples->WhereIn("willingToRelocate",$format_filter["willingToRelocate"]);
          }
          if(!empty($format_filter["iBelieveIAM"]))
          {
            $peoples->WhereIn("iBelieveIAM",$format_filter["iBelieveIAM"]);
          }
          if(!empty($format_filter["maritalBeliefSystem"])) 
          {
            $peoples->WhereIn("maritalBeliefSystem",$format_filter["maritalBeliefSystem"]);
          }
          if(!empty($format_filter["studyHabits"])) 
          {
            $peoples->WhereIn("studyHabits",$format_filter["studyHabits"]);
          }
          if(!empty($format_filter["anyAffiliation"])) 
          {
            $peoples->WhereIn("anyAffiliation",$format_filter["anyAffiliation"]);
          }
          if(!empty($format_filter["yearsInTruth"]))  
          {
            $peoples->WhereIn("yearsInTruth",$format_filter["yearsInTruth"]);
          }
          if(!empty($format_filter["spiritualBackground"]))  
          {
            $peoples->WhereIn("spiritualBackground",$format_filter["spiritualBackground"]);
          }
	
          $peoples->where("users.id","!=",Auth::id())
          ->where('users.id', '!=', Auth::id())
          ->where('mobile_verified', '=', true)
          ->where('email_verified', '=', true)
          ->having("distance","<=", $format_filter["miles"][0])
          ->orderby("spotlight_status","desc")
          ->orderby("distance","asc");  
          $data = $peoples->get();
          return response()->json(["status" => true , "message" => "query Execute", "peoples" => $data ], 200);
      }



    public function get_mutual_users(request $request)
    {
      $date =  Carbon::now();
      $current_time  = Carbon::now()->format('H:i:s');
      $format_filter = array();
      $user = Auth::user(); 
      $Location = $user->Location()->first();
      $preferences = $user->preferences()->first(); 
      $peoples =  
      User::with(["active_spotlights",
      "useractions",
      "Location",
      "gallery_images",
      "profile_images",
      "isrealitePracticeKeeping",
      "kingdomGifts",
      "passions"])
      ->select("users.*","users_location.city","latitude","longitude","state","state_abbr",
      DB::raw("6371 * acos(cos(radians(" . $Location->latitude . ")) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(" .  $Location->longitude . ")) 
                        + sin(radians(" . $Location->latitude. ")) 
                        * sin(radians(latitude))) AS distance"
      ),
      DB::raw("(select count(*) from user__activate__spotlights where users.id = user__activate__spotlights.user_id AND expire_time > '".$current_time."' AND  user__activate__spotlights.status = 1) as spotlight_status")
      )
      ->join("users_location","users_location.user_id","=","users.id")
      ->whereDoesntHave('useractions', function ($query) use( $user) {
        $query->where('user_id','=',$user->id);
      })
      ->whereDoesntHave('useractions_by_auth_user', function ($query) use( $user) {
        $query->where('match_id','=',$user->id);
      })
      ->where('users.iAm', '=',$user->seeking)
      ->where('mobile_verified', '=', true)
      ->where('email_verified', '=', true)
        ->Where('users.maritalBeliefSystem', 'like',  '%'.$user->maritalBeliefSystem .'%')
	   ->Where('users.spiritualValue', 'like',  '%'.$user->spiritualValue .'%')
     
       ->where('users.id', '!=', $user->id);
        if($preferences->global == false){
          $peoples->where('users_location.zipcode', '=',$user->zipcode);
       }
      $peoples->having("distance","<=",  $preferences->radius);
      $data = $peoples->orderby("distance","asc")->get();
      return response()->json(["status" => true , "message" => "query Execute", "peoples" => $data ,"request" =>  $request->all() ], 200);
    }
    public function get_reversed_users(request $request)
    {
        $date =  Carbon::now();
      $current_time  = Carbon::now()->format('H:i:s');
      $format_filter = array();
      $user = Auth::user(); 
      $Location = $user->Location()->first();
      $preferences = $user->preferences()->first(); 
      $peoples =  
      User::with(["active_spotlights",
      "useractions",
      "Location",
      "gallery_images",
      "profile_images",
      "isrealitePracticeKeeping",
      "kingdomGifts",
      "passions"])
      ->select("users.*","users_location.city","latitude","longitude","state","state_abbr",
      DB::raw("6371 * acos(cos(radians(" . $Location->latitude . ")) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(" .  $Location->longitude . ")) 
                        + sin(radians(" . $Location->latitude. ")) 
                        * sin(radians(latitude))) AS distance"
      ),
      DB::raw("(select count(*) from user__activate__spotlights where users.id = user__activate__spotlights.user_id AND expire_time > '".$current_time."' AND  user__activate__spotlights.status = 1) as spotlight_status")
      )
      ->join("users_location","users_location.user_id","=","users.id")
      ->whereDoesntHave('useractions', function ($query) use( $user) {
        $query->where('user_id','=',$user->id);
      })
      ->whereDoesntHave('useractions_by_auth_user', function ($query) use( $user) {
        $query->where('match_id','=',$user->id);
      })
      ->where('users.iAm', '=',$user->seeking)
      ->where('mobile_verified', '=', true)
      ->where('email_verified', '=', true)
       ->Where('users.maritalBeliefSystem', 'like',  '%'.$user->maritalBeliefSystem .'%')
	   ->Where('users.spiritualValue', 'like',  '%'.$user->spiritualValue .'%')
     
       ->where('users.id', '!=', $user->id);
       if($preferences->global == false){
          $peoples->where('users_location.zipcode', '=',$user->zipcode);
       }
      $peoples->having("distance","<=",  $preferences->radius);
      $data = $peoples->orderby("distance","asc")->get();
      return response()->json(["status" => true , "message" => "query Execute", "peoples" => $data ,"request" =>  $request->all() ], 200);

    }
    public function get_users_my_type(request $request)
    {
      $user = Auth::user(); 
      $Location = $user->Location()->first();
      $preferences = $user->preferences()->first();
      $peoples = User::with([
        "Location",
        "profile_images",
        "location"
      ])
      ->select("users.id","users.profileName","users_location.city","latitude","longitude","state","state_abbr",DB::raw("6371 * acos(cos(radians(" . $Location->latitude . ")) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(" .  $Location->longitude . ")) 
                        + sin(radians(" . $Location->latitude. ")) 
                        * sin(radians(latitude))) AS distance"
      )) 
      ->join("users_location","users_location.user_id","=","users.id")
       ->whereDoesntHave('useractions', function ($query) use( $user) {
          $query->where('user_id','=',$user->id);
        })
        ->whereDoesntHave('useractions_by_auth_user', function ($query) use( $user) {
          $query->where('match_id','=',$user->id);
       })
       
      ->where('mobile_verified', '=', true)
      ->where('email_verified', '=', true)
       ->Where('users.maritalBeliefSystem', 'like',  '%'.$user->maritalBeliefSystem .'%')
	   ->Where('users.spiritualValue', 'like',  '%'.$user->spiritualValue .'%')
      
       ->where('users.id', '!=', $user->id)
	   ->where('users.iAm', '=',$user->seeking);
      
      if($preferences->global == false){
          $peoples->where('users_location.zipcode', '=',$Location->zipcode);
      }
      $data = $peoples->orderby("distance","asc")->get();
      return response()->json(["status" => true , "message" => "query Execute", "peoples" => $data ,"request" =>  $request->all() ], 200);
    }
    public function save_search(request $request)
    {
      $master = user_saved_filter::create([
          "user_id" => Auth::id(),
          "filter_name" => $request->name,
      ]);
      foreach($request->filters as $flt)
      {
          user_filter::create([
            "filter_id" => $master->id,
            "filter_key" => $flt["key"],
            "filter_values" => json_encode($flt["values"]),
          ]);
      }
      return response()->json(["status" => true], 200);
    }
    public function get_saved_all_searches(request $request)
    {

      $filters = user_saved_filter::with("user_filter")->where("user_id",Auth::id())->get();
      return response()->json(["status" => true,"filters" => $filters], 200);
    }
}
