<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PageSections;

class CmsController extends Controller
{
    
	public function logo()
	{
		try{
		$data['logo']= PageSections::where(['section_name'=>'logo','page_id'=>'1'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
	public function home()
	{
		try{
		$data['logo']= PageSections::where(['section_name'=>'logo','page_id'=>'1'])->first();
		$data['slider']= PageSections::where(['section_name'=>'slider','page_id'=>'1'])->first();
		$data['video']= PageSections::where(['section_name'=>'video','page_id'=>'1'])->first();
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'1'])->first();
		$data['bottom']= PageSections::where(['section_name'=>'bottom','page_id'=>'1'])->first();
		$data['footer']= PageSections::where(['section_name'=>'footer','page_id'=>'1'])->first();
	    $data['popup']= PageSections::where(['section_name'=>'popup','page_id'=>'1'])->first();	
		
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
	public function product_premimum_features()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'3'])->first();
		$data['bottom']= PageSections::where(['section_name'=>'bottom','page_id'=>'3'])->first();
		$data['footer']= PageSections::where(['section_name'=>'footer','page_id'=>'3'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
		public function product_pricing_gold()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'4'])->first();
		$data['bottom']= PageSections::where(['section_name'=>'bottom','page_id'=>'4'])->first();
		$data['footer']= PageSections::where(['section_name'=>'footer','page_id'=>'4'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
		public function product_pricing_platinium()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'5'])->first();
		$data['slider']= PageSections::where(['section_name'=>'slider','page_id'=>'5'])->first();
		$data['video']= PageSections::where(['section_name'=>'video','page_id'=>'5'])->first();
		$data['bottom']= PageSections::where(['section_name'=>'bottom','page_id'=>'5'])->first();
		$data['footer']= PageSections::where(['section_name'=>'footer ','page_id'=>'5'])->first();

		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
	public function qavah_live()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'6'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
	public function qavah_court()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'7'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
	public function saftey()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'8'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
		public function support()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'9'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
		public function about()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'10'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
	public function termsandconditions()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'11'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
		public function privacy()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'12'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
	public function contact_us()
	{
		try{	
		$data['middel']= PageSections::where(['section_name'=>'middel','page_id'=>'13'])->first();
		}catch(\Exception $e){
			return response()->json(['error'=>true,'message'=>$e->getMessage()]);
		}
		return response()->json(['success'=>true,'content'=>$data]);
	}
}
