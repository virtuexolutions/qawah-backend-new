<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user_profile_verified;
class UserVerificationController extends Controller
{
     public function index()
    {
        $verify = user_profile_verified::with('User')->get();
        return view('admin.views.showuserverficationlist',compact('verify'));
    }
    public function delete($id)
    {
        $verify = user_profile_verified::find($id);
        $verify->delete();
        return redirect()->back()->with(['success'=>'Record Deleted successfully']);
    }
    public function status($id,$status)
    {
        $verify = user_profile_verified::find($id);
        $verify->status = $status;
        $verify->save();
         return redirect()->back()->with(['success'=>'Record Updated successfully']);

    }
    
}
