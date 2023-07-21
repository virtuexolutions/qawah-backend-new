<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\PageCategory;
use App\PageSections;
use Carbon\Carbon;
use Image;
use File;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class SectionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pages-list|pages-create|pages-edit|pages-delete', ['only' => ['index','store']]);
        $this->middleware('permission:pages-create', ['only' => ['create','store']]);
        $this->middleware('permission:pages-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pages-delete', ['only' => ['destroy']]);
        $this->middleware('permission:pages-show', ['only' => ['show']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $pages = PageCategory::get();
        $sections = PageSections::get();
        return view('admin.views.sections',compact('pages','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
      $pages = PageCategory::get();
      return view('admin.views.sections_create',compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		try{
        $logo ='';
        $slider_image ='';
        $right_image ='';
        $left_image ='';
        $icon_image_1 = '';
        $icon_image_2 = '';
        $icon_image_3 = '';

       	    $destinationPath = public_path('uploads/cms/'); 
				if($request->hasFile('logo')) 
        	{
				$logoimage = $request->file('logo');
                $logoext = 'qavah-'.time().'.'.$logoimage->extension();
                $img = Image::make($logoimage->path());
                $img->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$logoext);
				$logoimage->move($destinationPath, $logoext);
				$logo = asset('uploads/cms/'. $logoext);
			}
		
		  if($request->hasFile('slider_image')) 
        {
            	$sliderimage = $request->file('slider_image');
                $sliderext = 'qavah-'.time().'.'.$sliderimage->extension();
                $img1 = Image::make($sliderimage->path());
                $img1->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'. $sliderext);
				 $sliderimage->move($destinationPath,  $sliderext);
				$slider_image = asset('uploads/cms/'.  $sliderext);
        }
		    if($request->hasFile('right_image')) 
        {
          		$rightimage = $request->file('right_image');
                $rightext = 'qavah-'.time().'.'.$rightimage->extension();
                $img2 = Image::make($rightimage->path());
                $img2->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$rightext);
				$rightimage->move($destinationPath, $rightext);
				$right_image = asset('uploads/cms/'. $rightext);
        }
		    if($request->hasFile('left_image')) 
        {
             	$leftimage = $request->file('left_image');
                $lefttext = 'qavah-'.time().'.'.$leftimage->extension();
                $img3 = Image::make($leftimage->path());
                $img3->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$lefttext);
				$leftimage->move($destinationPath, $lefttext);
				$left_image = asset('uploads/cms/'. $lefttext);
        }
		
		   if($request->hasFile('icon_image_1')) 
        {
                $iconimage1= $request->file('icon_image_1');
                $iconimage1ext = 'qavah-icon_image_1'.time().'.'.$iconimage1->extension();
                $img4 = Image::make($iconimage1->path());
                $img4->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$iconimage1ext);
				$iconimage1->move($destinationPath, $iconimage1ext);
				$icon_image_1 = asset('uploads/cms/'. $iconimage1ext);
        }
		    if($request->hasFile('icon_image_2')) 
        {
           		$iconimage2= $request->file('icon_image_2');
                $iconimage2ext = 'qavah-icon_image_2'.time().'.'.$iconimage2->extension();
                $img5 = Image::make($iconimage2->path());
                $img5->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$iconimage2ext);
				$iconimage2->move($destinationPath, $iconimage2ext);
				$icon_image_2 = asset('uploads/cms/'. $iconimage2ext);
        }
		   if($request->hasFile('icon_image_3')) 
        {
  				$iconimage3= $request->file('icon_image_3');
                $iconimage3ext = 'qavah-icon_image_3'.time().'.'.$iconimage3->extension();
                $img6 = Image::make($iconimage3->path());
                $img6->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$iconimage3ext);
				$iconimage3->move($destinationPath, $iconimage3ext);
				$icon_image_3 = asset('uploads/cms/'. $iconimage3ext);
        }
	
        $data = [
            'page_id' => $request->page_id,
            'section_name' => $request->section_name,
            'slider_content_1' => $request->slider_content_1,
            'slider_content_2' => $request->slider_content_2,
            'video_url' => $request->video_url,
            'icon_title_1' => $request->icon_title_1,
            'icon_title_2' => $request->icon_title_2,
            'icon_title_3' => $request->icon_title_3,
            'icon_text_1' => $request->icon_text_1,
            'icon_text_2' => $request->icon_text_2,
            'icon_text_3' => $request->icon_text_3,
            'section_title' => $request->section_title,
            'bullet_heading_1' => $request->bullet_heading_1,
            'bullet_heading_3' => $request->bullet_heading_3,
            'bullet_heading_2' => $request->bullet_heading_2,
            'bullet_text_1' => $request->bullet_text_1,
            'bullet_text_2' => $request->bullet_text_2,
            'bullet_text_3' => $request->bullet_text_3,
            'bottam_para' => $request->bottam_para,
            'copyright_text' => $request->copyright_text,
            'logo' => $logo,
            'slider_image' => $slider_image,
            'right_image' =>$right_image,
            'left_image' =>$left_image,
            'icon_image_1' =>$icon_image_1,
            'icon_image_2' =>$icon_image_2,
            'icon_image_3' =>$icon_image_3,
			'description'=>$request->description,
            'created_at' =>Carbon::now(),

         
        ];
        PageSections::create($data);
		}catch(\Exception $e){
			return redirect()->back()->with(['error'=>$e->getMessage()]);
		}
        return redirect()->back()->with('success', 'Created Successfull');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $val =  PageSections::find($id);
        $pages = PageCategory::get();
      return view('admin.views.sections_edit',compact('pages','val'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // echo "<pre>";
        // print_r($request->all());
        // echo"</pre>";
        // die;
		try{
       $section =  PageSections::find($id);

        $logo =$section->logo;
        $slider_image =$section->slider_image;
        $right_image =$section->right_image;
        $left_image =$section->left_image;
        $icon_image_1 = $section->icon_image_1;
        $icon_image_2 = $section->icon_image_2;
        $icon_image_3 = $section->icon_image_3;

          $destinationPath = public_path('uploads/cms/'); 
				if($request->hasFile('logo')) 
        	{
				$logoimage = $request->file('logo');
                $logoext = 'qavah-'.time().'.'.$logoimage->extension();
                $img = Image::make($logoimage->path());
                $img->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$logoext);
				$logoimage->move($destinationPath, $logoext);
				$logo = asset('uploads/cms/'. $logoext);
			}
		
		  if($request->hasFile('slider_image')) 
        {
            	$sliderimage = $request->file('slider_image');
                $sliderext = 'qavah-'.time().'.'.$sliderimage->extension();
                $img1 = Image::make($sliderimage->path());
                $img1->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'. $sliderext);
				 $sliderimage->move($destinationPath,  $sliderext);
				$slider_image = asset('uploads/cms/'.  $sliderext);
        }
		    if($request->hasFile('right_image')) 
        {
          		$rightimage = $request->file('right_image');
                $rightext = 'qavah-'.time().'.'.$rightimage->extension();
                $img2 = Image::make($rightimage->path());
                $img2->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$rightext);
				$rightimage->move($destinationPath, $rightext);
				$right_image = asset('uploads/cms/'. $rightext);
        }
		    if($request->hasFile('left_image')) 
        {
             	$leftimage = $request->file('left_image');
                $lefttext = 'qavah-'.time().'.'.$leftimage->extension();
                $img3 = Image::make($leftimage->path());
                $img3->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$lefttext);
				$leftimage->move($destinationPath, $lefttext);
				$left_image = asset('uploads/cms/'. $lefttext);
        }
		
		   if($request->hasFile('icon_image_1')) 
        {
                $iconimage1= $request->file('icon_image_1');
                $iconimage1ext = 'qavah-icon_image_1'.time().'.'.$iconimage1->extension();
                $img4 = Image::make($iconimage1->path());
                $img4->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$iconimage1ext);
				$iconimage1->move($destinationPath, $iconimage1ext);
				$icon_image_1 = asset('uploads/cms/'. $iconimage1ext);
        }
		    if($request->hasFile('icon_image_2')) 
        {
           		$iconimage2= $request->file('icon_image_2');
                $iconimage2ext = 'qavah-icon_image_2'.time().'.'.$iconimage2->extension();
                $img5 = Image::make($iconimage2->path());
                $img5->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$iconimage2ext);
				$iconimage2->move($destinationPath, $iconimage2ext);
				$icon_image_2 = asset('uploads/cms/'. $iconimage2ext);
        }
		   if($request->hasFile('icon_image_3')) 
        {
  				$iconimage3= $request->file('icon_image_3');
                $iconimage3ext = 'qavah-icon_image_3'.time().'.'.$iconimage3->extension();
                $img6 = Image::make($iconimage3->path());
                $img6->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($destinationPath.'/'.$iconimage3ext);
				$iconimage3->move($destinationPath, $iconimage3ext);
				$icon_image_3 = asset('uploads/cms/'. $iconimage3ext);
        }
		
	
        $data = [
            'page_id' => $request->page_id,
            'section_name' => $request->section_name,
            'slider_content_1' => $request->slider_content_1,
            'slider_content_2' => $request->slider_content_2,
            'video_url' => $request->video_url,
            'icon_title_1' => $request->icon_title_1,
            'icon_title_2' => $request->icon_title_2,
            'icon_title_3' => $request->icon_title_3,
            'icon_text_1' => $request->icon_text_1,
            'icon_text_2' => $request->icon_text_2,
            'icon_text_3' => $request->icon_text_3,
            'section_title' => $request->section_title,
            'bullet_heading_1' => $request->bullet_heading_1,
            'bullet_heading_3' => $request->bullet_heading_3,
            'bullet_heading_2' => $request->bullet_heading_2,
            'bullet_text_1' => $request->bullet_text_1,
            'bullet_text_2' => $request->bullet_text_2,
            'bullet_text_3' => $request->bullet_text_3,
            'bottam_para' => $request->bottam_para,
			'description'=>$request->description,
            'copyright_text' => $request->copyright_text,
            'logo' => $logo,
            'slider_image' => $slider_image,
            'right_image' =>$right_image,
            'left_image' =>$left_image,
            'icon_image_1' =>$icon_image_1,
            'icon_image_2' =>$icon_image_2,
            'icon_image_3' =>$icon_image_3,
            'updated_at'=>Carbon::now(),
        ];
        $section->update($data);
		}catch(\Exception $e){
			return redirect()->back()->with(['error'=>$e->getMessage()]);
		}
        return redirect()->back()->with('success', 'Updated Successfull');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PageSections::find($id);
        $imagepath1 = asset( $data->logo);
        $imagepath2 = asset( $data->slider_image);
        $imagepath3 = asset( $data->right_image);
        $imagepath4 = asset($data->left_image);
        $imagepath5 = asset($data->icon_image_1);
        $imagepath6 = asset( $data->icon_image_2);
        $imagepath7 = asset( $data->icon_image_3);

        File::delete($imagepath1);
        File::delete($imagepath2);
        File::delete($imagepath3);
        File::delete($imagepath4);
        File::delete($imagepath5);
        File::delete($imagepath6);
        File::delete($imagepath7);
       

        $data->delete();
        return redirect()->back()->with('success', 'Delete Successfull');
    }
}
