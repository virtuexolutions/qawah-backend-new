<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Users_Profile_Images;
use App\Users_Gallery_Images;
use File;
use Session;
use App\Users_subcribtion;

class UserController extends Controller
{
    public function __construct()
    {
            $this->middleware('permission:users-list', ['only' => ['showView']]);
            $this->middleware('permission:users-show', ['only' => ['show']]);
            $this->middleware('permission:users-create', ['only' => ['showUserForm','createUser']]);
            $this->middleware('permission:users-status', ['only' => ['status']]);
            $this->middleware('permission:users-delete-profile-image', ['only' => ['deleteprofileimage']]);
            $this->middleware('permission:users-delete-gallery-image', ['only' => ['deletegalleryimage']]);
            $this->middleware('permission:users-packages', ['only' => ['userspackages']]);

            
    }
    
    public $imageName = '';
    public function showView(){

    	 $homedata = User::orderBy('id','desc')->get();
        
    	return view('admin.views.showUserView',compact('homedata'));
    }


    public function showUserForm(){

    	return view('admin.views.showUserForm');	
    }
    public function show($id)
    {
$user = User::with("subscription","profile_images","gallery_images","isrealitePracticeKeeping","kingdomGifts","passions","height")->find($id);
     return view('admin.views.showUserDetail' , compact('user'));
    }

    public function createUser(Request $request){

        $user = new User;
    	
    	$imgName = "";

        request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|integer|min:10',
       ]);

    	$user->name = $request->input('name');
    	$user->lastname = $request->input('lastname');
    	$user->email = $request->input('email');
    	$user->country = $request->input('country');
    	$user->city = $request->input('city');
    	$user->address = $request->input('address');
    	$user->phone = $request->input('phone');
    	$user->zipcode = $request->input('zipcode');
    	$user->state = $request->input('state');
    	$user->password = $request->input('password');

        //dd( $request->input('image'));
      if ($image = $request->file('image')) {

                    request()->validate([
                        'image' => 'required|image|mimes:jpeg,png,jpg',
                    ]);

                   $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                   $imgName = $imageName;
                   $path = public_path().'/adminTheme/uploads/users';
                   $image->move($path, $imageName);
              //     dd($imgName);
            }
            
            $user->image = $imgName;

    	    $user->save();
    	    return back()->with('success','User Created Successfully');


    }


    public function edit($id){


        $user = User::find($id);

        return view('admin.views.useredit',compact('user'));
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);

        request()->validate([
 
        'name' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'required|min:8',
        'phone' => 'required|integer|min:10',
 
       ]);

        $oldPassword = $user->password;
        $newPassword = $request->input('password');

        if($oldPassword != $newPassword ){

            $user->password = $request->input('password');

        }


        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->zipcode = $request->input('zipcode');
        $user->state = $request->input('state');

        

        if ($image = $request->file('image')) {

                    request()->validate([
                        'image' => 'required|image|mimes:jpeg,png,jpg',
                    ]);

                   $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                   $this->imageName = $imageName;
                   $path = public_path().'/adminTheme/uploads/users';
                   $image->move($path, $imageName);
            }

        if($this->imageName != "")
        {
            $user->image = $this->imageName;
        }

        $user->save();

        //$this->cmsupdate($request, $id, $cms);

        return back()
                ->with('success','Record updated Successfully');

    }


    public function destroy($id)
    {

       $user = User::find($id);
       $user->delete();
       session::flash('success','Record has been deleted Successfully');
       return redirect('users');
        
    }
    public function status($id,$status)
    {
        $user = User::find($id);
        $user->active = $status;
        $user->save();
        session::flash('success','Status has been Updated Successfully');
        return redirect('users'); 
    }
    public function deleteprofileimage(Request $request ,$id)
    {
        $image = Users_Profile_Images::find($id);
        $imagepath = $image->url;
        if (File::exists(asset($imagepath))) {
            File::delete(asset($imagepath));
        }
        $image->delete();
        session::flash('success','Picture Deleted Successfully');
        return back();

    }
    public function deletegalleryimage( Request $request , $id)
    {
        $image = Users_Gallery_Images::find($id);
        $imagepath = $image->url;
        if (File::exists(asset($imagepath))) {
            File::delete(asset($imagepath));
        }
        $image->delete();
        session::flash('success','Picture Deleted Successfully');
        return back();

    }

    public function userspackages()
    {
        $users = Users_subcribtion::with('package')->orderby('id','DESC')->get();

        return view('admin.views.userspackageslist',compact('users'));
    }
}
