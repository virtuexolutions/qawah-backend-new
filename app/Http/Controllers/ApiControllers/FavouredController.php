<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserAction;
use App\user_profile_view;

use Illuminate\Support\Facades\Auth;

class FavouredController extends Controller
{
    //
    public function who_likes_me()
    {
        
        $peoples =  User::with("who_likes_me_status","fetch_user_report","profile_images")
        ->wherehas('who_likes_me_status', function ($query) {
            $query->where('match_id','=',Auth::id());
        })
         ->where('id', '!=', Auth::id())
        ->get();
        return response()->json(["success" => true , "message" => "retrived user","peoples" => $peoples], 200);
    }
    public function whi_i_like()
    {
         $peoples =  User::with("useractions","fetch_user_report","profile_images")
        ->wherehas('useractions', function ($query) {
            $query->where('user_id','=',Auth::id())
            ->where('disliked','=',false)
            ->where('is_blocked','=',false);
        })
        ->where('id', '!=', Auth::id())
        ->get() ;
        return response()->json(["success" => true , "message" => "retrived user","peoples" => $peoples], 200);
    }
    public function matched_users()
    {

        $peoples = [];
        //  $peoples =  User::with("useractions","profile_images")
        // ->wherehas('useractions', function ($query) {
        //     $query->where('user_id','=',Auth::id())->where("matched","=",false);
        // })
        // ->where('id', '!=', Auth::id())
        // ->get() ;
        return response()->json(["success" => true , "message" => "retrived user","peoples" => $peoples], 200);
    }

    public function who_view_my_profile()
    {
        $peoples = User::with("who_view_my_profile","profile_images")
        ->wherehas('who_view_my_profile', function ($query) {
            $query->where('match_id',Auth::id());
        })
        ->whereDoesntHave('useractions', function ($query) {
             $query->where('user_id','=',Auth::id());
         })
        ->where('id', '!=', Auth::id())
        ->get() ;
        return response()->json(["success" => true , "message" => "retrived user","peoples" => $peoples], 200);
    }

    public function profile_viewed(request $request)
    {
        $user = User::find(Auth::id());
        $userviews = $user->user_profile_view()->where("match_id" , $request->targetuid)->first();
        if(!$userviews)
        {
            $user->user_profile_view()->create([
                "user_id" => Auth::Id(),
                "match_id" => $request->targetuid
            ]);
            return response()->json(["status" => true, "user" => $userviews ], 200);  
        } 
        return response()->json(["status" => false, "error" => "you are already view this profile" ], 500);  
    }
    public function get_lovenotes()
    {
        $data = User::with("user_lovenote","profile_images")
         ->wherehas('user_lovenote', function ($query) {
            $query
            ->where('match_id',Auth::id())
            ->where('status', 1);
         })->get();
        return response()->json(["status" => true , "peoples" => $data], 200);
    }
}
