<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Packages_catogeries;
use DB;
class PackagesController extends Controller
{
    public function get_packages()
    {
      $packages = null;
      $packages = Packages_catogeries::with("packages")
	   ->whereHas('packages', function ($query) {
            $query->where('active', '=', '1')
				->where("promotion","=","0");
       })->get()->pluck("packages.*","slug");
       
        // Saad Commit This Code
        foreach($packages['gold'] as $key => $row){
            $row->description =  preg_replace("/\r|\n/", " ", strip_tags($row->description));
        }
        foreach($packages['platinum'] as $key => $row){
            $row->description = str_replace("&nbsp;", " ",  preg_replace("/\r|\n/", "", strip_tags($row->description)));
        }
        
        foreach($packages['premium'] as $key => $row){
            $row->description = str_replace("&nbsp;", " ",  preg_replace("/\r|\n/", "", strip_tags($row->description)));
        }
        // End Saad Commit This Code
       return response()->json(["success" => true,"packages" => $packages],200);
    }
    public function get_package_detail(request $request)
    {
        $package_detail = Package::with("packages_categery")->where("id",$request->package_id)->first();
        return response()->json(["success" => true,"package_detail" => $package_detail],200);
    }
}
