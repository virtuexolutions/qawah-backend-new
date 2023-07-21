<?php

namespace App\Http\Controllers\ApiControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminInfo;
use App\ContactInfo;
use Validator;
use App\Mail\Support;


class CmsController extends Controller
{
    public function contact_info(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'phone' => 'required|numeric',
                'email' =>'required|email',
                'subject'=>'required|string',
                'description'=>'required|string'
            ]); 
            if($validator->fails())
            {
                return response()->json(['success'=>false,'error'=>$validator->errors()->first()],500);
            }
            $input = $request->except(['_token'],$request->all());
            \Mail::to($request->email)->send(new Support($input));
        //    print_r($d);die;
        // $data = ContactInfo::create($input);
        $data = 'hello';
        return response()->json(['success'=>true,'message'=>'Your Request has been Sent','data'=>$data]);

        }
        catch(\Eception $e){
            return response()->json(['error'=>$e->getMessage()],500);

        }
    }
    public function admininfo()
    {
       
        try{
            $admin =AdminInfo::first();
            return response()->json(['success'=>true,'data'=>$admin]);

        }catch(\Eception $e){
            return $this->sendError($e->getMessage());

        }
    }
}