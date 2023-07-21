<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Logo;
use App\User;
use App\Inquiry;
use App\Users_subcribtion;
use DB;
use Auth;
use Validator;
use Hash;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function initContent(){
    
        $users = User::all();
        $totalUsers = count($users);

        $products = \App\Users_subcribtion::all();
        $totalsubscriptions = count($products);

        // $inquiries = Inquiry::all();
        // $totalInquiries = count($inquiries);

        $inquiries = \App\Package::get();
        $totalpackages = count($inquiries);

        $amount= 0;
        foreach($products as $val)
        {
          $amount += $val->package->price ?? 0;
 	    }


	

    	return view('admin.views.dashboard')
        ->with('totalUsers',$totalUsers)
        ->with('totalpackages',$totalpackages)
        ->with('totalamount',$amount)
        ->with('totalsubscriptions',$totalsubscriptions);
    }



    function upload(Request $request)
    {
     $image = $request->file('file');

     $imageName = time() . '.' . $image->extension();

     $image->move(public_path('images'), $imageName);

     return response()->json(['success' => $imageName]);
    }

    function fetch()
    {
     $images = \File::allFiles(public_path('images'));
     $output = '<div class="row">';
     foreach($images as $image)
     {
      $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.asset('images/' . $image->getFilename()).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
            </div>
      ';
     }
     $output .= '</div>';
     echo $output;
    }

    function delete(Request $request)
    {
     if($request->get('name'))
     {
      \File::delete(public_path('images/' . $request->get('name')));
     }
    }
    public function change_password()
    {
        return view('admin.views.change-password');
    }
    public function store_change_password(Request $request)
    {
        $user =  Auth::guard('admin')->user();
        $userPassword = $user->password;
        $validator =Validator::make($request->all(),[
          'oldpassword' => 'required',
          'newpassword' => 'required|same:password_confirmation|min:8',
          'password_confirmation' => 'required',
        ]);
        if($validator->fails())
        {
            return back()->with(['error'=>$validator->errors()]);
 
        }
        if(!Hash::check($request->oldpassword, $userPassword)) 
        {
            return back()->with(['error'=>'Current Password not match']);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }
}
