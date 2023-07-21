<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user_event;

class EventController extends Controller
{
	public function index()
	{
		$events = user_event::with('user')->where('status','!=' ,'0')->get();
		return view('admin.views.events.index',compact('events'));
	}
	public function status($id ,$status)
	{
		$events = user_event::find($id);
		$events->status = $status;
		$events->save();
		return redirect()->back()->with(['sucess'=>'Status Chnage Successfully']);
	}
	
}