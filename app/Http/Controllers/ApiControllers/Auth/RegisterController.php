<?php

namespace App\Http\Controllers\ApiControllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Users_Gallery_Images;
use Carbon\Carbon;
use Str;
use Image;
use App\PrmotionalPackage;
use App\Packages_catogeries;
use App\Package;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	
	
	// Saad comment these code
    public function add_new(request $request)
    { 
      
        $rules = [
          'profileName' => 'required|string|max:255',
          'governmentName' => 'required|string|max:255',
          'phone' => 'required|string|min:11',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|string|min:6',
          'birthday' => 'required|date|before_or_equal:today',
          'height' => 'required|array',
          'height.feet' => 'required|numeric|min:0',
          'height.inches' => 'required|numeric|min:0|max:11',
          'iAm' => 'required|string|max:5',
          'seeking' => 'required|string|max:5',
        ];
        $validator = Validator::make($request->step1, $rules);
        if ($validator->fails()) {
          return response()->json(['status' => false ,"step" => 1, 'message' => $validator->errors()->first()], 500);
        }
        $rule2 = [
          'maritalStatus' => 'required|string|max:255',
          'livingSituation' => 'required|string|max:255',
          'doYouHaveChildren' => 'required|string|max:255',
          'doYouWantMoreChildren' => 'required|string|max:255',
          'relationshipIAmSeeking' => 'required|string|max:255',
          'bodyType' => 'required|string|max:255',
          'aboutMe' => 'required',
          'doYouDrink' => 'required|string|max:255',
          'doYouSmoke' => 'required|string|max:255',
          'employmentStatus' => 'required|string|max:255',
          'willingToRelocate' => 'required|string|max:255',
          'havePets' => 'required|string|max:255',
          'howOftenDoYouExercise' => 'required|string|max:255',
          //'profileImages' => 'required',
        ];
        $validator = Validator::make($request->step2, $rule2);
        if ($validator->fails()) {
          return response()->json(['status' => false ,"step" => 2, 'message' => $validator->errors()->first()], 500);
        }
        $rule3 = [
          'iBelieveIAM' => 'required|string|max:255',
          'maritalBeliefSystem' => 'required|string|max:255',
          'spiritualValue' => 'required|string|max:255',
          'studyHabits' => 'required|string|max:255',
          'studyBible' => 'required|string|max:255',
          'anyAffiliation' => 'required|string|max:255',
          'yearsInTruth' => 'required|string|max:255',
          'isrealitePracticeKeeping' => 'required|array',
          'spiritualBackground' => 'required|string|max:255',
          'selectedkingdomGiftsTags' => 'required|array',
          'selectedPassions' => 'required|array',
        
        ];
        $validator = Validator::make($request->step3, $rule3);
        if ($validator->fails()) {
          return response()->json(['status' => false,"step" => 3, 'message' =>  $validator->errors()->first()], 500);
        }

    
        $BasicDetail = $request->except("step1.location","step2.galleryImages","step2.profileImages","step3.isrealitePracticeKeeping","step3.selectedPassions","step3.selectedkingdomGiftsTags");
        $BasicDetail = array_merge($BasicDetail["step1"],$BasicDetail["step2"],$BasicDetail["step3"]); 
        $BasicDetail["uid"] =  Str::random(15);
        $height = $BasicDetail["height"];
        $BasicDetail["height"] =  json_encode($BasicDetail["height"]);
        $BasicDetail["age"] = Carbon::parse($BasicDetail["birthday"])->age;
        $location =  $request->input("step1.location");
        // $profileImages =  $request->input("step2.profileImages");
        // $galleryImages =  $request->input("step2.galleryImages");
        $password = bcrypt($request->input("step1.password"));
        $BasicDetail["password"] = $password;
        $selectedPassions =  array();
        $selectedkingdomGiftsTags =  array();
        $isrealitePracticeKeeping = array();
        $resp = User::create($BasicDetail);
        foreach($request->input("step3.selectedPassions") as $sp)
        {
             array_push($selectedPassions,["options" => $sp]);
        }
        foreach($request->input("step3.selectedkingdomGiftsTags") as $kg)
        {
             array_push($selectedkingdomGiftsTags,["options" => $kg]);
        }
        foreach($request->input("step3.isrealitePracticeKeeping") as $irp)
        {
             array_push($isrealitePracticeKeeping,["options" => $irp]);
        }
        User::find($resp->id)->Location()->create($location);
       // User::find($resp->id)->gallery_images()->createMany($galleryImages);
        
		//User::find($resp->id)->profile_images()->create($profileImages);
		// User::find($resp->id)->profile_image()->create([
        //      "url" => $profileImages,
        //]);
        User::find($resp->id)->isrealitePracticeKeeping()->createMany($isrealitePracticeKeeping);
        User::find($resp->id)->kingdomGifts()->createMany($selectedkingdomGiftsTags);
        User::find($resp->id)->passions()->createMany($selectedPassions);
        User::find($resp->id)->height()->create([
              "feet" => $height["feet"],
              "inches" => $height["inches"]
        ]);
        User::find($resp->id)->preferences()->create(
          [
            "global" => false,
            "ageFrom" => 20,
            "ageTo" => 40,
            "radius" => 15000
          ]
        );
		    $response["promotinal_package"]=$this->user_promotional_pkg($resp->id);
        $response["notification"] = $this->send_target_notifications($resp->id,array("title"=> "Welcome In Qavah" , "body" =>  "Hello Mr/Ms Hope you Enjoy..."));     
        if(Auth::attempt(['email' => $request->input("step1.email"), 'password' => $request->input("step1.password"),'active'=>'1']))
        { 
          $user = User::with(["active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_image",
          "isrealitePracticeKeeping",
          "kingdomGifts",
          "passions"])->find(Auth::id());
          $token =  $user->createToken('MyApp')->accessToken; 
          return response()->json(["status" => true,"message" => "Profile Successfully Created","user" => $user ,"token" => $token],200); 
        } 
    }

    public function add(request $request)
    {


        $rules = [
          'profileName' => 'required|string|max:255',
          'governmentName' => 'required|string|max:255',
          'phone' => 'required|string|min:11',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|string|min:6',
          'birthday' => 'required|date|before_or_equal:today',
          'height' => 'required|array',
          'height.feet' => 'required|numeric|min:0',
          'height.inches' => 'required|numeric|min:0|max:11',
          'iAm' => 'required|string|max:5',
          'seeking' => 'required|string|max:5',
        ];
        $validator = Validator::make($request->step1, $rules);
        if ($validator->fails()) {
          return response()->json(['status' => false ,"step" => 1, 'message' => $validator->errors()->first()], 500);
        }
        $rule2 = [
          'maritalStatus' => 'required|string|max:255',
          'livingSituation' => 'required|string|max:255',
          'doYouHaveChildren' => 'required|string|max:255',
          'doYouWantMoreChildren' => 'required|string|max:255',
          'relationshipIAmSeeking' => 'required|string|max:255',
          'bodyType' => 'required|string|max:255',
          'aboutMe' => 'required',
          'doYouDrink' => 'required|string|max:255',
          'doYouSmoke' => 'required|string|max:255',
          'employmentStatus' => 'required|string|max:255',
          'willingToRelocate' => 'required|string|max:255',
          'havePets' => 'required|string|max:255',
          'howOftenDoYouExercise' => 'required|string|max:255',
          'profileImages' => 'required|array',
        ];
        $validator = Validator::make($request->step2, $rule2);
        if ($validator->fails()) {
          return response()->json(['status' => false ,"step" => 2, 'message' => $validator->errors()->first()], 500);
        }
        $rule3 = [
          'iBelieveIAM' => 'required|string|max:255',
          'maritalBeliefSystem' => 'required|string|max:255',
          'spiritualValue' => 'required|string|max:255',
          'studyHabits' => 'required|string|max:255',
          'studyBible' => 'required|string|max:255',
          'anyAffiliation' => 'required|string|max:255',
          'yearsInTruth' => 'required|string|max:255',
          'isrealitePracticeKeeping' => 'required|array',
          'spiritualBackground' => 'required|string|max:255',
          'selectedkingdomGiftsTags' => 'required|array',
          'selectedPassions' => 'required|array',
        
        ];
        $validator = Validator::make($request->step3, $rule3);
        if ($validator->fails()) {
          return response()->json(['status' => false,"step" => 3, 'message' =>  $validator->errors()->first()], 500);
        }
    
        $BasicDetail = $request->except("step1.location","step2.galleryImages","step2.profileImages","step3.isrealitePracticeKeeping","step3.selectedPassions","step3.selectedkingdomGiftsTags");
        $BasicDetail = array_merge($BasicDetail["step1"],$BasicDetail["step2"],$BasicDetail["step3"]); 
        $BasicDetail["uid"] =  Str::random(15);
        $height = $BasicDetail["height"];
        $BasicDetail["height"] =  json_encode($BasicDetail["height"]);
        $BasicDetail["age"] = Carbon::parse($BasicDetail["birthday"])->age;
        $location =  $request->input("step1.location");
        $profileImages =  $request->input("step2.profileImages");
        $galleryImages =  $request->input("step2.galleryImages");
        $password = bcrypt($request->input("step1.password"));
        $BasicDetail["password"] = $password;
        $selectedPassions =  array();
        $selectedkingdomGiftsTags =  array();
        $isrealitePracticeKeeping = array();
        $resp = User::create($BasicDetail);
        foreach($request->input("step3.selectedPassions") as $sp)
        {
             array_push($selectedPassions,["options" => $sp]);
        }
        foreach($request->input("step3.selectedkingdomGiftsTags") as $kg)
        {
             array_push($selectedkingdomGiftsTags,["options" => $kg]);
        }
        foreach($request->input("step3.isrealitePracticeKeeping") as $irp)
        {
             array_push($isrealitePracticeKeeping,["options" => $irp]);
        }
        User::find($resp->id)->Location()->create($location);
        User::find($resp->id)->gallery_images()->createMany($galleryImages);
        User::find($resp->id)->profile_images()->createMany($profileImages);
        User::find($resp->id)->isrealitePracticeKeeping()->createMany($isrealitePracticeKeeping);
        User::find($resp->id)->kingdomGifts()->createMany($selectedkingdomGiftsTags);
        User::find($resp->id)->passions()->createMany($selectedPassions);
        User::find($resp->id)->height()->create([
              "feet" => $height["feet"],
              "inches" => $height["inches"]
        ]);
        User::find($resp->id)->preferences()->create(
          [
            "global" => false,
            "ageFrom" => 20,
            "ageTo" => 40,
            "radius" => 15000
          ]
        );
		    $response["promotinal_package"]=$this->user_promotional_pkg($resp->id);
        $response["notification"] = $this->send_target_notifications($resp->id,array("title"=> "Welcome In Qavah" , "body" =>  "Hello Mr/Ms Hope you Enjoy..."));     
        if(Auth::attempt(['email' => $request->input("step1.email"), 'password' => $request->input("step1.password"),'active'=>'1']))
        { 
          $user = User::with(["active_spotlights",
          "useractions",
          "Location",
          "gallery_images",
          "profile_images",
          "isrealitePracticeKeeping",
          "kingdomGifts",
          "passions"])->find(Auth::id());
          $token =  $user->createToken('MyApp')->accessToken; 
          return response()->json(["status" => true,"message" => "Profile Successfully Created","user" => $user ,"token" => $token],200); 
        } 
    }

	
    public function email_check(request $request)
    {

      // print_r($request->all());die;
        $user = User::where('email', '=', $request->email)->first();
        if ($user === null) {
          $array = ["status" => true , "message" => "available!"];
        }
        else
        {
          $array = ["status" => false , "message" => "not available!"];
        }
        return response()->json($array);
    }

	
	
	 
	
    public function upload_profile_files(request $request)
    {
      $image = ['image/jpeg','image/gif','image/png'];
      $contentType = $request->file->getClientMimeType();
      if(in_array($contentType, $image))
      {
        $validator = Validator::make($request->all(), [
          'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) 
        {     
            return response()->json(["status" => false,"message" =>  implode(", <br/> ",$validator->messages()->all()),"validation_errors" =>  				$validator->errors()], 200);
        }
        $image = $request->file('file');
        $input['imagename'] = 'qavah-'.time().uniqid().'.'.$image->extension();
        $filePath = public_path('images/profile_images/thumbnails');
        $img = Image::make($image->path());
        $img->resize(500, 500, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$input['imagename']);
        $thumbnails = asset('images/profile_images/thumbnails/'. $input['imagename']);
        $filePath = public_path('images/profile_images');
        $image->move($filePath, $input['imagename']);
        $org_image = asset('images/profile_images/'. $input['imagename']);
        return response()->json([
        "status" => true ,
        "imagename" => $org_image ,
        "thumbnails" => $thumbnails,
        "web_url" => asset('images/profile_images/'),
        "name" => $input['imagename']
      ], 200);
      }
      else
      {
         return response()->json("Invalid File ", 500);
      }
    }

    public function upload_gallery_files(request $request)
    {



        
      $image = ['image/jpeg','image/gif','image/png'];
      $video = ['video/mp4' , 'video/x-ms-wmv']; 
      $contentType = $request->file->getClientMimeType();
      if(in_array($contentType, $image))
      {



          $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
          if ($validator->fails()) 
          {    
              return response()->json(["status" => false,"message" =>  implode(", <br/> ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
          }
          $image = $request->file('file');
          $input['imagename'] = 'qavah-'.time().uniqid().'.'.$image->extension();
          $filePath = public_path('images/gallery_Images/thumbnails');
          $img = Image::make($image->path());
          $img->resize(500, 500, function ($const) {
              $const->aspectRatio();
          })->save($filePath.'/'.$input['imagename']);
          $thumbnails = asset('images/gallery_Images/thumbnails/'. $input['imagename']);
          $filePath = public_path('images/gallery_Images');
          $image->move($filePath, $input['imagename']);
          $org_image = asset('images/gallery_Images/'. $input['imagename']);
          return response()->json([
          "status" => true ,
          'message'=>'You have successfully upload file.',
          "imagename" => $org_image ,
          "thumbnails" => $thumbnails,
          "type" => "image",
          "web_url" => asset('images/gallery_Images/'),
          "name" => $input['imagename']
        ], 200);
      }
      else if(in_array($contentType, $video))
      {
        $validator = Validator::make($request->all(), [
          'file' => 'required|video|mimes:mp4,x-ms-wmv|max:2048',
        ]);
        if ($validator->fails()) 
        {    
            return response()->json(["status" => false,"message" =>  implode(", <br/> ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
        }
        $imageName = 'qavah-'.time().uniqid().$request->file->getClientOriginalExtension();
        $result = $request->file->move(public_path('images/gallery_Images'), $imageName);
        $imagepath = asset('images/gallery_Images/'.$imageName);
        return response()->json([
          "status" => true ,
          'message'=>'You have successfully upload file.',
          "imagename" => $imagepath,
          "thumbnails" => $imagepath,
          "type" => "video",
          "web_url" => asset('images/gallery_Images/'),
          "name" => $imageName
        ]);
      }
      else
      {
               return response()->json("Invalid File ", 500);
      }
    }
	
	public function user_promotional_pkg($id)
	{
		$package = Package::where('active',1)->where('promotion','1')->get();
		$response ='';
		if(!empty($package))
		{
			foreach($package as $value)
			{
				$category = Packages_catogeries::where('id',$value->catogery_id)->first();
			$response = User::find($id)->user_subcribtion()->create(
            array(
                "pkg_id" => $value->id,
                "pkg_name" => $value->title,
                "pkg_catogery" => $category->slug,
                "spotlights" => $value->spotlights,
                "lovenotes" => $value->lovenotes,
                "staring" =>  Carbon::now(),
                "ending" => Carbon::now()->addDays($value->duration),
                "status" => 1
            )
        );  
			}
			
  
		}
		 return $response;  
	}
}