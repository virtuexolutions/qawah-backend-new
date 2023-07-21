<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use Session;

class sliderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
   
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.views.sliders',compact('sliders'));
    }

   
    public function create()
    {
        //
        return view('admin.views.addsliders');
    }

  
    public function store(Request $request)
    {
        
        request()->validate([
            'greeting_text' => 'required|string', 
            'heading' => 'required|string', 
            'sub_text' => 'required|string', 
            'button_url' => 'required|url', 
            'banner_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'swiper_images' => 'required',
            'swiper_images.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
          ]);
           if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $imageName = "cms-".rand(0,99999999999) . "." . $image->getClientOriginalExtension();
                $path = public_path().'/uploads/cms/';
                $image->move($path, $imageName);
                $banner_image =  asset("uploads/cms")."/".$imageName;
          }
          if($request->hasfile('swiper_images')) {
            foreach($request->file('swiper_images') as $img)
            {
                $imageName = "cms-". rand(0,99999999999) . "." . $img->getClientOriginalExtension();
                $img->move(public_path().'/uploads/cms/', $imageName);  
                $imgData[] =  asset("uploads/cms")."/".$imageName;
            }
          }
        $saveResult = Slider::create([
            'greeting_text' => $request->greeting_text,
            'heading' => $request->heading,
            'sub_text' => $request->sub_text,
            'button_url' => $request->button_url,
            'banner_image' => $banner_image,
            'swiper_images' => json_encode($imgData),
        ]);

        session::flash('success','Record Uploaded Successfully');
        return redirect('slider')->with('success','Record Uploaded Successfully');
    }

   
    public function show($id)
    {
         $data["slider"]  = Slider::find($id);
         return view('admin.views.sliderEdit', $data);
    }

    
    // public function edit(request $request,$id)
    // {
    //     // return $request->all();
    // }

   
    public function update(Request $request, $id)
    {
        //  return $request->all();
        request()->validate([
            'greeting_text' => 'required|string', 
            'heading' => 'required|string', 
            'sub_text' => 'required|string', 
            'button_url' => 'required|url', 
          ]);
          $imgData = $request->old_swiper_images ?? array();
          $banner_image;
           if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $imageName = "cms-".rand(0,99999999999) . "." . $image->getClientOriginalExtension();
                $path = public_path().'/uploads/cms/';
                $image->move($path, $imageName);
                $banner_image =  asset("uploads/cms")."/".$imageName;
          }
          if($request->hasfile('swiper_images')) {
            foreach($request->file('swiper_images') as $img)
            {
                $imageName = "cms-". rand(0,99999999999) . "." . $img->getClientOriginalExtension();
                $img->move(public_path().'/uploads/cms/', $imageName);  
                $imgData[] =  asset("uploads/cms")."/".$imageName;
            }
          }
        $saveResult = Slider::where("id",$id)->update([
            'greeting_text' => $request->greeting_text,
            'heading' => $request->heading,
            'sub_text' => $request->sub_text,
            'button_url' => $request->button_url,
            'banner_image' => $banner_image ?? $request->old_banner_image,
            'swiper_images' => json_encode($imgData),
        ]);
        session::flash('success','Record Uploaded Successfully');
        return redirect('slider')->with('success','Record Uploaded Successfully');
    }

   
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        session::flash('success','Record has been deleted Successfully');
        return redirect('slider');
    }

    public function delete_image($id,$k)
    {
        $slider = Slider::find($id);
        $current_images = json_decode($slider->swiper_images);
        $new_images = array_values(array_except($current_images,$k));
        $slider->update([
            "swiper_images" => json_encode($new_images)
        ]);
        session::flash('success','Record has been deleted Successfully');
        return redirect()->back();
    }
}
