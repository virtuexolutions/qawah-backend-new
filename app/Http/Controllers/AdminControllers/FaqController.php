<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Faq;
use Validator;

class FaqController extends Controller
{
    public function index(){
		$faqs = Faq::all();
		return view('admin.views.faqs.index',compact('faqs'));
	}
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'question' =>'required',
			'answer' =>'required',
		]);
		if($validator->fails())
		{
			return redirect()->back()->with(['error'=>$validator->errors()]);
		}
		$faq = new Faq();
		$faq->question = $request->question;
		$faq->answer = $request->answer;
		$faq->save();
		
		return redirect()->back()->with(['success'=>'Record Add successfully']);
	}
	public function update(Request $request,$id)
	{
		$faq = Faq::find($id);
		$faq->question = $request->question;
		$faq->answer = $request->answer;
		$faq->save();
	return redirect()->back()->with(['success'=>'Record Updated successfully']);
	
	}
	public function destroy($id)
	{
		$faq = Faq::find($id);
		$faq->delete();
		return redirect()->back()->with(['success'=>'Record Deleted successfully']);
	
	}
	
}
