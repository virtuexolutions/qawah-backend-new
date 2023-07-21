<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Image;
use Validator;
class EventController extends Controller
{
    //

    public function add(request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'link' => 'required',
            'date' => 'required',
            'end_date' => 'required',
            "description" => "required", 
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                
            ]);
            if ($validator->fails()) 
            {    
                return response()->json(["status" => false,"message" =>  implode(", <br/> ",$validator->messages()->all()),"validation_errors" =>   $validator->errors()], 200);
            }else{
                $image = $request->file('banner');
                $input['imagename'] = 'qavah-'.time().'.'.$image->extension();
                $filePath = public_path('images/events/thumbnails');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$input['imagename']);
                $thumbnails = asset('images/events/thumbnails/'. $input['imagename']);
                $filePath = public_path('images/events');
                $image->move($filePath, $input['imagename']);
                $org_image = asset('images/events/'. $input['imagename']);
                $user_event = Auth::user()->user_event()->create([
                        "title" => $request->title,
                        "link" => $request->link, 
                        "date" => $request->date, 
                        "end_date" => $request->end_date, 
                        "description" => $request->description, 
                        "url" => $org_image, 
                        "thumbnail" => $thumbnails, 
                        "image_name" => $input['imagename'] , 
                        "web_url" => asset('/') , 
                        "status" => "2",    
                ]);
                return response()->json(["status" => true , "message" => "Event upload wait for admin approval","response" => $request->all()], 200);
        }
    }
    public function get_upcoming_events()
    {
            $events = Auth::user()->user_event()->where("status",1)->get();
            return response()->json(["status"=> true ,"events" => $events], 200);
    }
}
