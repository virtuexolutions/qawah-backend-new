<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserAction;
use App\user_allow_profile;
use App\Users_Profile_Images;
use App\Users_Gallery_Images;

use Image;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;
class UsersController extends Controller
{
    //
    public function get_user_profile()
    {
        
        $user_id =  Auth::user()->id;
        $user = User::with("login_status","user_profile_verified","subscription","active_spotlights","user_settings","height","preferences","Location","profile_images","gallery_images","isrealitePracticeKeeping","kingdomGifts","passions")
        ->find($user_id);    
        $user["selected_isrealitePracticeKeeping"]  = $user->isrealitePracticeKeeping->pluck("options");
        return response()->json($user,200);
    }
    
    public function get_profile_detail(request $request)
    {   
        $user = User::with("user_profile_verified","location",
        "height","subscription",
        "profile_images",
        "user_privacy",
        "allowed_profile",
        "gallery_images","isrealitePracticeKeeping",
        "kingdomGifts","passions")
        ->select("users.*","users_location.city","latitude","longitude","height","state","state_abbr",DB::raw("6371 * acos(cos(radians(" . $request->lat . ")) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(" . $request->lng . ")) 
                        + sin(radians(" .$request->lat. ")) 
                        * sin(radians(latitude))) AS distance"
        )) 
        ->join("users_location","users_location.user_id","=","users.id")
        ->where("users.id",$request->targetUid)->first();
        $user["useractions"] = UserAction::where("user_id", auth::id())->where("match_id", $request->targetUid)->first();
        $user["target_useractions"] = UserAction::where("match_id", auth::id())->where("user_id", $request->targetUid)->first();
        return response()->json(["success" => true ,"user_detail" => $user,"request" => $request->all(),"message" => "retrived user"], 200);
    }
	
	
		
    public function update_profile(request $request)
    {
        
        $isrealitePracticeKeeping = array();
        $user = USER::with("location","height","kingdomGifts","passions","isrealitePracticeKeeping")->where("id",$request->id)->first();
        $user_detail = $request->except("preferences","height","city","created_at","updated_at","profile_images","isrealite_practice_keeping","passions","gallery_images","selected_isrealitePracticeKeeping","subscription","kingdom_gifts","location");
        $resp["Basic_update_status"] = $user->update($user_detail);
        $resp["location_update_status"] =  $user->location()->update(
            $request->location
        );
        $resp["preferances_update_status"] =  $user->preferences()->update(
            $request->preferences
        );
        $resp["height_update_status"] =  $user->height()->update(
            $request->height
        );


        $resp["kingdom_delete_status"] = $user->kingdomGifts()->delete();
        $resp["kingdom_update_status"] = $user->kingdomGifts()->createMany(
            $request->kingdom_gifts
        );
        $resp["passion_delete_status"] = $user->passions()->delete();
        $resp["passion_update_status"] = $user->passions()->createMany(
            $request->passions
        );
        $resp["isrealite_delete_status"] = $user->isrealitePracticeKeeping()->delete();
       foreach($request->selected_isrealitePracticeKeeping as $irp)
        {
             array_push($isrealitePracticeKeeping,["options" => $irp]);
        }
        $resp["isrealite_update_status"] = $user->isrealitePracticeKeeping()->createMany(
            $isrealitePracticeKeeping
        );
        return response()->json(["status" => true,"request" => $resp], 200);
    }


    // Saad start these code
	public function update_profile_app(request $request)
    {
        // return 'asd';
        $isrealitePracticeKeeping = array();
		$passions = array();
		$kingdomGifts = array();
        $id = Auth::user()->id;
        $user = USER::with("active_spotlights",
            "useractions",
            "Location",
            "gallery_images",
            "profile_images",
            "isrealitePracticeKeeping",
            "kingdomGifts",
            "passions",'prefrences')->where("id",$id)->first();
        
        // $user->prefrences->global = $user->prefrences->global == 1 ? 0 : 1;
        $user->prefrences->global = $user->prefrences->global == 0 ? 1 : 0;
        $user->prefrences->update();
     
       
        return response()->json(["status" => true,"user" => $user], 200);
    }
	
	public function update_gallery_image(request $request)
    {
		Users_Gallery_Images::where('user_id',Auth::id())->delete();
		 $galleryfiles = $request->file('galleryImages');
		 if($galleryfiles)
		 { 
			// $galleryImages = [];
			foreach($galleryfiles as $key => $file)
			{
			  $galleryfileName = time().rand(1,99).'.'.$file->extension();  
			  $file->move(public_path('images/gallery_Images/'), $galleryfileName);

			  $galleryImages = asset('images/gallery_Images/'. $galleryfileName);
				
				Users_Gallery_Images::create([
					'user_id' => Auth::id(),
					'url' => $galleryImages,
					'name' => $galleryfileName
				]);
			}

		 }
//		return $galleryImages;

	//				User::find(Auth::id())->gallery_images()->createMany($galleryImages);
		$profileImages = '';
        $file = $request->file('profileImages');
        if($file)
        { 
            $fileName = time().rand(1,99).'.'.$file->extension();  
            $file->move(public_path('images/profile_images/thumbnails/'), $fileName);
            $profileImages = asset('images/profile_images/thumbnails/'. $fileName);
        }
		
        Users_Profile_Images::create([
            'user_id' => Auth::id(),
            'url' => $profileImages
        ]);

		

        $user = User::with(["active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_images",
          "isrealitePracticeKeeping",
          "kingdomGifts",
          "passions"])->find(Auth::id());
        return response()->json(["status" => true,"user" => $user], 200);
    }
	
	public function post_gallery_image(request $request)
    {
		 $galleryfiles = $request->file('galleryImage');
		 if($galleryfiles)
		 { 
            $galleryfileName = time().rand(1,99).'.'.$galleryfiles->extension();  
            $galleryfiles->move(public_path('images/gallery_Images/'), $galleryfileName);

            $galleryImages = asset('images/gallery_Images/'. $galleryfileName);
            
            Users_Gallery_Images::create([
                'user_id' => Auth::id(),
                'url' => $galleryImages,
                'name' => $galleryfileName
            ]);
		 }
		
        $user = User::with(["active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_images",
          "isrealitePracticeKeeping",
          "kingdomGifts",
          "passions"])->find(Auth::id());
        return response()->json(["status" => true,"user" => $user], 200);
    }
	
	//end code
	
	public function update_profile_image(request $request)
    {
        Users_Profile_Images::where('user_id',Auth::id())->delete();
        $rules = [
            'profileImages' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false ,"step" => 1, 'message' => $validator->errors()->first()], 500);
        }
		$profileImages = '';
        $file = $request->file('profileImages');
        if($file)
        { 
            $fileName = time().rand(1,99).'.'.$file->extension();  
            $file->move(public_path('images/profile_images/thumbnails/'), $fileName);
            $profileImages = asset('images/profile_images/thumbnails/'. $fileName);
        }
		
        Users_Profile_Images::create([
            'user_id' => Auth::id(),
            'url' => $profileImages
        ]);
		




        $user = User::with(["active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_images",
          "isrealitePracticeKeeping",
          "kingdomGifts",
          "passions"])->find(Auth::id());
        return response()->json(["status" => true,"user" => $user], 200);
    }
	
	//END code
    public function isralite_info(request $request)
    {
        
        $isrealitePracticeKeeping = array();


        $id = Auth::id();
        $user = USER::with("kingdomGifts",'passions','isrealitePracticeKeeping')->where("id",$id)->first();
        $user_detail = [
            'iBelieveIAM' => $request['iBelieveIAm'],
            'yearsInTruth' => $request['yearsInTruth'],
            'studyHabits' => $request['StudyHabits'],
            'anyAffiliation' => $request['anyAffiliation'],
            'spiritualValue' => $request['SpiritualValues'],
            'maritalBeliefSystem' => $request['MaritalBeliefSystem'],
            'studyBible' => $request['studyBible'],
            'spiritualBackground' => $request['SpiritualBg'],
        ];
        // return $user_detail;

        //  print_r($user_detail);die;

        $user->update($user_detail);
        

        $resp["kingdom_delete_status"] = $user->kingdomGifts()->delete();
        
        $selectedkingdomGiftsTags =  array();
        $isrealitePracticeKeeping =  array();
        $selectedPassions =  array();
        foreach($request->KingomGifts as $kg)
        {
             array_push($selectedkingdomGiftsTags,["options" => $kg]);
        }
        User::find($id)->kingdomGifts()->createMany($selectedkingdomGiftsTags);
        
       
        
        $resp["passion_delete_status"] = $user->passions()->delete();
        foreach($request->Passions as $kg)
        {
            array_push($selectedPassions,["options" => $kg]);
        }
        User::find($id)->passions()->createMany($selectedPassions);
        
        $resp["isrealite_delete_status"] = $user->isrealitePracticeKeeping()->delete();
        foreach($request->isrealite_practice_keeping as $kg)
        {
            array_push($isrealitePracticeKeeping,["options" => $kg]);
        }
        User::find($id)->isrealitePracticeKeeping()->createMany($isrealitePracticeKeeping);

        // $resp["kingdom_update_status"] = $user->kingdomGifts()->createMany(
        //     $request->KingomGifts
        // );
        // $resp["passion_update_status"] = $user->passions()->createMany(
        //     $request->Passions
        // );
        // $resp["isrealite_delete_status"] = $user->isrealitePracticeKeeping()->createMany(
        //     $request->isrealite_practice_keeping
        // );

        // $users = USER::with("Location",'preferences','passions','kingdomGifts','isrealitePracticeKeeping')->where("id",$id)->first();
        $users = User::with(["active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_images",
          "isrealitePracticeKeeping",
          "kingdomGifts",
          "passions"])->find(Auth::id());
        return response()->json(["status" => true,"user" => $users], 200);
    }
    
    public function portfolio(request $request)
    {
        
        $id = Auth::id();
        $user = USER::with("kingdomGifts",'passions','isrealitePracticeKeeping')->where("id",$id)->first();
        $user_detail = [
            'profileName' => $request->profileName,
       //     'birthday' => $request->Birthday,
       //     'iAm' => $request->Gender,
        ];
        // return $user_detail;
        $user->update($user_detail);
		$galeries = Users_Gallery_Images::where('user_id',Auth::id())->get();
		//return $galeries;
		//$user = USER::with("gallery_images")->where("id",Auth::id())->first();
		
        
        // $users = USER::with("Location",'preferences')->where("id",$id)->first();
        $users = User::with(["active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_images",
          "isrealitePracticeKeeping",
          "kingdomGifts",
          "passions"])->find(Auth::id());
        return response()->json(["status" => true,"user" => $users], 200);
    }
    
    public function more_about_me(request $request)
    {
        
        $id = Auth::id();
        $user = USER::with("kingdomGifts",'passions','isrealitePracticeKeeping')->where("id",$id)->first();
        $user_detail = [
            'aboutMe' => $request->AboutMe,
            'maritalStatus' => $request->MaritialStatus,
            'livingSituation' => $request->LivingSituation,
            'doYouHaveChildren' => $request->DoyouhaveChildren,
            'doYouWantMoreChildren' => $request->DoyouWantMoreChildren,
            'relationshipIAmSeeking' => $request->RelationshipYouAreSeeking,
            'bodyType' => $request->BodyType,
            'howOftenDoYouExercise' => $request->HowOftenDoyouExercise,
            'havePets' => $request->HavePets,
            'doYouDrink' => $request->DoYouDrink,
            'doYouSmoke' => $request->DoYouSmoke,
            'employmentStatus' => $request->EmploymentStatus,
            'willingToRelocate' => $request->WillingToRelocate,
        ];
        $user->update($user_detail);
        
        // $users = USER::with("Location",'preferences')->where("id",$id)->first();
        $users = User::with(["active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_images",
          "isrealitePracticeKeeping",
          "kingdomGifts",
          "passions"])->find(Auth::id());
        return response()->json(["status" => true,"user" => $users], 200);
    }
    // Saad end code
    public function upload_new_profile_image(request $request)
    {
         $user = Auth::user();
         if($request->type == "profileImage"){
            $image = ['image/jpeg','image/gif','image/png'];
            $contentType = $request->file->getClientMimeType();
            if(in_array($contentType, $image))
            {
                $index = $user->profile_images()->get()->count();
                $image = $request->file('file');
                $input['imagename'] = 'qavah-'.time().'.'.$image->extension();
                $filePath = public_path('images/profile_images/thumbnails');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$input['imagename']);
                $thumbnails = asset('images/profile_images/thumbnails/'. $input['imagename']);
                $filePath = public_path('images/profile_images');
                $image->move($filePath, $input['imagename']);
                $org_image = asset('images/profile_images/'. $input['imagename']);
                $user->profile_images()->create(
                    [
                        "index" =>   $index,
                        "url" => $org_image ,
                        "thumbnails" => $thumbnails,
                        "web_url" => asset('images/profile_images/'),
                        "name" => $input['imagename']
                    ]
                );
                return response()->json([
                "status" => true,
                'message'=>'You have successfully upload file.',
                ], 200);
            }
            else
            {
                return response()->json(["status" => false ,"message" => "only images allowed"], 500);
            }
         }
        else
        {
            $image = ['image/jpeg','image/gif','image/png'];
            $video = ['video/mp4' , 'video/x-ms-wmv']; 
            $contentType = $request->file->getClientMimeType();
            $index = $user->gallery_images()->get()->count();
            if(in_array($contentType, $image))
            {
                $image = $request->file('file');
                $input['imagename'] = 'qavah-'.time().'.'.$image->extension();
                $filePath = public_path('images/gallery_Images/thumbnails');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$input['imagename']);
                $thumbnails = asset('images/gallery_Images/thumbnails/'. $input['imagename']);
                $filePath = public_path('images/gallery_Images');
                $image->move($filePath, $input['imagename']);
                $org_image = asset('images/gallery_Images/'. $input['imagename']);
                $gallery_image_upload_status = $user->gallery_images()->create([
                    "index" =>  $index,
                    "url" => $org_image ,
                    "thumbnails" => $thumbnails,
                    "type" => "image",
                    "web_url" => asset('images/gallery_Images/'),
                    "name" => $input['imagename']
                ]);
                return response()->json([
                "status" => true ,
                'message'=>'You have successfully upload file.',
                "imagename" => $org_image ,
                "thumbnails" => $thumbnails,
                "type" => "image",
                "gallery_image_upload_status" => $gallery_image_upload_status,
                "web_url" => asset('images/gallery_Images/'),
                "name" => $input['imagename']
                ], 200);
            }
            else if(in_array($contentType, $video))
            {
                $imageName = "qavah-".time().'.'.$request->file->getClientOriginalExtension();
                $result = $request->file->move(public_path('images/gallery_Images'), $imageName);
                $imagepath = asset('images/gallery_Images/'.$imageName);
                $gallery_image_upload_status = $user->gallery_images()->create([
                   "index" =>  $index+1,
                    "url" => $imagepath ,
                    "thumbnails" => $imagepath,
                    "type" => "video",
                    "web_url" => asset('images/gallery_Images/'),
                    "name" => $imageName
                ], 200);
                return response()->json([
                "status" => true ,
                'message'=>'You have successfully upload file.',
                "imagename" => $imagepath,
                "thumbnails" => $imagepath,
                "gallery_image_upload_status" => $gallery_image_upload_status,
                "type" => "video",
                "web_url" => asset('images/gallery_Images/'),
                "name" => $imageName
                ]);
            }
            else
            {
                return response()->json(["status" => false ,"message" => "only images allowed"], 500);
            } 
        }
    }

    public function reorder_gallery_images(request $request)
    {
        $gallery_images = $request->newGalleryImages;
        foreach($gallery_images as $k => $img)
        {
          Auth::user()->gallery_images()->where("id",$img["id"])->update([
                "index" => $k,
          ]); 
        }
        return response()->json(['status'=>true, 'message'=>'You have successfully upload file.',"request" => $request->all()]);
    }

    public function reorder_profile_images(request $request)
    {
        $profile_images = $request->newProfileImages;
        foreach($profile_images as $k => $img)
        {
          Auth::user()->profile_images()->where("id",$img["id"])->update([
                "index" => $k,
          ]); 
        }
        return response()->json(['status'=>true, 'message'=>'You have successfully upload file.',"request" => $request->all()]);
    }
    
    public function remove_profile_image(request $request)
    {
        $user = USER::with("profile_images")->where("id",Auth::id())->first();
        $image_path = $request->link;  // Value is not URL but directory file path
        $image_path = public_path("images/profile_images/").basename($image_path);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $user->profile_images()->where("id",$request->index)->delete();
        return response()->json(['status'=>true, 'message'=>'You have successfully upload file.',"request" => $request->all()]);
   
    }
    public function remove_gallery_image(request $request)
    {
        $user = USER::with("gallery_images")->where("id",Auth::id())->first();
        $image_path = $request->link;  // Value is not URL but directory file path
        $image_path = public_path("images/gallery_Images/").basename($image_path);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $user->gallery_images()->where("id",$request->index)->delete();
        return response()->json(['status'=>true, 'message'=>'You have successfully delete file from gallery.',"request" => $request->all()]);
    }
    public function logout(request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'status' => true,
            'msg' => 'Logged out Successfull.',
         ], 200);
    }
    public function search_user(request $request)
    {
        $already_block_user = user_allow_profile::where("user_id",Auth::id())->pluck("profile_id");
        $users = User::with("profile_images")->select(["id","profileName"])
        ->orWhere('profileName', 'like', '%' . $request->search . '%')
        ->whereNotIn("id",$already_block_user)
        ->get();
        return response()->json(["status" => "true" , "data" =>$users], 200);
    }
    function search_hide_user()
    {
        $already_block_user = user_allow_profile::where("user_id",Auth::id())->pluck("profile_id");
        $users = User::with("profile_images")->select(["id","profileName"])
        ->whereIn("id",$already_block_user)
        ->get();
        return response()->json(["status" => "true" , "hide_users" =>$users], 200);

    }

    public function online_status(request $request)
    {
        $user = Auth::user();
        $user_login_log = $user->user_login_log;
        if(empty($user_login_log))
        {
            $user->user_login_log()->create([
                "last_activity" => Carbon::now(),
                "ip_address" => $request->ip()
            ]);
        }
        else
        {
              $user->user_login_log()->update([
                 "last_activity" => Carbon::now(),
              ]);
        }
        return response()->json(["status"=>"true"], 200);
    }

    public function verification_image_upload(request $request)
    {
        $valid = Validator::make($request->all(),[
            'file' => 'required|image|mimes:jpg|max:2048'
        ]);
            if($valid->fails())
            {
                return response()->json(['error'=>$valid->errors()->first()]);
            }
                if($request->has('file')){
                $user = Auth::user();
                $exists = $user->user_profile_verified()->firstWhere('user_id',Auth::id());
                if(empty($exists))
                {
                $image = $request->file('file');
                $input['imagename'] = 'qavah-'.time().'.'.$image->extension();
                $filePath = public_path('images/verification_images/thumbnails');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$input['imagename']);
                $thumbnails = asset('images/verification_images/thumbnails/'. $input['imagename']);
                $filePath = public_path('images/verification_images');
                $image->move($filePath, $input['imagename']);
                $org_image = asset('images/verification_images/'. $input['imagename']);
                $response['data'] = $user->user_profile_verified()->create([
                    'url' => $org_image,
                    'image_name'=> $input['imagename'],
                    'web_url' =>asset('images/verification_images/'),
                    'thumbnail'=> $thumbnails,
                    'status' => '2',
                  ]);
                return response()->json(["status" => true ,"message" =>" your request has been submited...!",'response'=>$response], 200 );
            }
            else{
                return response()->json(["status" => false, "message"=>"You have already submitted the request be petient"], 200);
            }                
            }else{
                return response()->json(["status" => false, "message"=>"No Image Found"], 200);

            }
      
    }
	
		public function update_profile_files(request $request)
		{
			$user = Auth::user();
            $image = ['image/jpeg','image/gif','image/png'];
            $contentType = $request->file->getClientMimeType();
            if(in_array($contentType, $image))
            {
                $total = $user->profile_images()->get()->count();
                $image = $request->file('file');
                $input['imagename'] = 'qavah-'.time().'.'.$image->extension();
                $filePath = public_path('images/profile_images/thumbnails');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$input['imagename']);
                $thumbnails = asset('images/profile_images/thumbnails/'. $input['imagename']);
                $filePath = public_path('images/profile_images');
                $image->move($filePath, $input['imagename']);
                $org_image = asset('images/profile_images/'. $input['imagename']);
				$user->profile_images()->where('index','=','0')->update(['index'=>$total]);
                $user->profile_images()->create(
                    [
                        "index" =>   0,
                        "url" => $org_image ,
                        "thumbnails" => $thumbnails,
                        "web_url" => asset('images/profile_images/'),
                        "name" => $input['imagename']
                    ]
                );
                return response()->json([
                "status" => true,
                'message'=>'You have successfully upload file.',
                ], 200);
            }
            else
            {
                return response()->json(["status" => false ,"message" => "only images allowed"], 500);
            }
		  
		}
        public function get_counts()
        {
           $data["notications"] =  auth::user()
           ->user_notification()
           ->where([["is_viewed","=",0],["is_remove","=",0]])
           ->count();

            return response()->json($data, 200);
        }
}
