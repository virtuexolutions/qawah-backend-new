<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InnerBanner;
use App\PageCategory;
use Session;

class BannerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
   
    public function index()
    {
        $banners  = InnerBanner::all();
        return view('admin.views.showbanners',compact('banners'));
    }

   
    public function create()
    {
        //
        $data["pages"] = PageCategory::all();
        return view('admin.views.addbanner',$data);
    }

  
    public function store(Request $request)
    {
        request()->validate([
            'page' => 'required', 
            'title' => 'required|string', 
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
          
          ]);
           if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = "banner-".rand(0,99999999999) . "." . $image->getClientOriginalExtension();
                $path = public_path().'/uploads/cms/';
                $image->move($path, $imageName);
                $banner_image =  asset("uploads/cms")."/".$imageName;
          }
          InnerBanner::create([
            "page" => $request->page,
            "title" => $request->title,
            "image" => $banner_image
          ]);
          session::flash('success','Record Uploaded Successfully');
          return redirect('banner')->with('success','Record Uploaded Successfully');
    }

    public function edit($id)
    {
        $data["pages"] = PageCategory::all();
        $data["banner"] = InnerBanner::find($id);
        return view("admin.views.bannerEdit",$data);
    }
   
    // public function show()
    // {
    //     return view('addsliders');
    // }

    
    // public function edit($id)
    // {
    //     $slider = Slider::find($id);
    //     // dd($category);
    //     return view('sliderEdit')->with('slider', $slider);
    // }

   
    public function update(Request $request, $id)
    {
         request()->validate([
            'page' => 'required', 
            'title' => 'required|string', 
          ]);
           if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = "banner-".rand(0,99999999999) . "." . $image->getClientOriginalExtension();
                $path = public_path().'/uploads/cms/';
                $image->move($path, $imageName);
                $banner_image =  asset("uploads/cms")."/".$imageName;
          }
          InnerBanner::where("id",$id)->update([
            "page" => $request->page,
            "title" => $request->title,
            "image" => $banner_image ?? $request->old_image
          ]);
          session::flash('success','Record Uploaded Successfully');
          return redirect()->back();   
    }
    public function destroy($id)
    {
           $InnerBanner = InnerBanner::find($id);
           $InnerBanner->delete();
           session::flash('success','Record has been deleted Successfully');
           return redirect('banner');
    }
}
