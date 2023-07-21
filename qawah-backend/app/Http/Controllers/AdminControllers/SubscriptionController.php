<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users_subcribtion;
use App\Package;
use App\User;
use Carbon\Carbon;
use App\user_addons_subscriptions;
use App\User_spotlight;
class SubscriptionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:subscriptions-list|subscriptions-create|subscriptions-edit|subscriptions-delete', ['only' => ['index','store']]);
        $this->middleware('permission:subscriptions-create', ['only' => ['create','store']]);
        $this->middleware('permission:subscriptions-delete', ['only' => ['destroy']]);
        $this->middleware('permission:subscriptions-show', ['only' => ['show']]);
        $this->middleware('permission:subscriptions-status', ['only' => ['status']]);

    }

    public function index()
    {
        $subscriptions = Users_subcribtion::with('User')->get();
        return view('admin.views.showSubscription',compact('subscriptions'));
    }
    public function create()
    {
       $data['packages'] = Package::with("packages_categery")->where([["promotion", "=","1"],["active", "=","1"]])->get();
		$data['users'] = User::all();
        return view('admin.views.add_offer_package',$data);
    }
    
    
    public function store(Request $request)
    {
        $date = Carbon::now();
        $package = Package::find($request->pkg_id);
        $pkg_addons = json_decode($package["options"]);
        $start_date = Carbon::now();
        $expire_date = $date->addDays($package["duration"]);
        $response = Users_subcribtion::create([
            'user_id' => $request->user_id,
            'pkg_id' => $request->pkg_id,
            'pkg_name' => $package->title,
            'pkg_catogery' => $package->type,
            'spotlights' => $package->spotlights,
            'lovenotes' => $package->lovenotes,
            'staring' =>  $start_date,
            'ending' => $expire_date,
            'status' => 1,
        ]);
        if(!empty($response)){
            if(!empty($pkg_addons)){
                foreach($pkg_addons as $pkg)
                {
                $addon_repsonse[] = user_addons_subscriptions::create(
                    array(
                            "subscribe_id" => $response->id,
                            "addon_name" => $pkg,
                            "status" => true
                        )
                );
                }
            }
        }
         if(!empty($response)  && $response->spotlights > 0 ){
           $spotlight_months =  $response->spotlights/4;
           $month = 0;
           $endmonth = 0;
           for($i = 0; $i<$spotlight_months; $i++)
           {
                $endmonth += 1;
                User_spotlight::create([
                    "subsciption_id" => $response->id,
                    "spotlight" => 4,
                    "assign_date" =>  Carbon::now()->addmonths($month),
                    "end_date" =>  Carbon::now()->addmonths($endmonth),
                ]);
                $month += 1;
            } 
         }
        // else if(!empty($response)  && $package->spotlights > 0)
        // {
        //        User_spotlight::create([
        //             "subsciption_id" => $response->id,
        //             "spotlight" => $package->spotlights,
        //             "assign_date" =>  $starting,
        //             "end_date" =>  $starting->addYear(1),
        //         ]);
        // }
        \Session::flash('success','Record Uploaded Successfully');
        return redirect('subscription')->with('success','Record Uploaded Successfully');
        // $response = User::find($user->id)->user_subcribtion()->create(
        //     array(
        //         "pkg_id" => $package["id"],
        //         "pkg_name" => $package["title"],
        //         "stripe_sub_id" => $user["sub_id"],
        //         "pkg_catogery" => $package["packages_categery"]["slug"],
        //         "spotlights" => $package["spotlights"],
        //         "lovenotes" => $package["lovenotes"],
        //         "staring" =>  $start_date,
        //         "ending" => $expire_date,
        //         "status" => 1,
        //         "auto_renew" =>$user['auto_renew'],
        //     )
        // );
        // if(!empty($response)){
        //     if(!empty($pkg_addons)){
        //         foreach($pkg_addons as $pkg)
        //         {
        //         $addon_repsonse[] = user_addons_subscriptions::create(
        //             array(
        //                     "subscribe_id" => $response->id,
        //                     "addon_name" => $pkg,
        //                     "status" => true
        //                 )
        //         );
        //         }
        //     }
        // }
        // if(!empty($response)  && $response->spotlights > 0 ){
        //    $spotlight_months =  $response->spotlights/4;
        //    $month = 0;
        //    $endmonth = 0;
        //    for($i = 0; $i<$spotlight_months; $i++)
        //    {
        //         $endmonth += 1;
        //         User_spotlight::create([
        //             "subsciption_id" => $response->id,
        //             "spotlight" => 4,
        //             "assign_date" =>  Carbon::now()->addmonths($month),
        //             "end_date" =>  Carbon::now()->addmonths($endmonth),
        //         ]);
        //         $month += 1;
        //     } 
        //  }
        //  else if(!empty($response)  && $response->spotlights > 0)
        //  {
        //        User_spotlight::create([
        //            "subsciption_id" => $response->id,
        //             "spotlight" => $response->spotlights,
        //             "assign_date" =>  Carbon::now(),
        //             "end_date" =>  Carbon::now()->addYear(1),
        //         ]);
        //  }
        // return array($user,$response);
       
    }

    public function destroy($id)
    {
        $p = Users_subcribtion::find($id);
        $p->delete();
        \Session::flash('success','Record has been deleted Successfully');
        return redirect()->back();
    }
    public function status($id,$status)
    {
        $p = Users_subcribtion::find($id);
        $p->update(['status'=> $status]);
        \Session::flash('success','Record Updated Successfully');
        return redirect()->back();
    }
    
    
}
