<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Packages_catogeries;
use auth;
use Session;

class PackageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:packages-list|packages-create|packages-edit|packages-delete', ['only' => ['index','store']]);
        $this->middleware('permission:packages-create', ['only' => ['create','store']]);
        $this->middleware('permission:packages-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:packages-delete', ['only' => ['destroy']]);
        $this->middleware('permission:packages-status', ['only' => ['status']]);

    }
    public function index()
    {
        //  dd(auth::user()->getRoleNames());
         $Packages = Package::all();
       return view('admin.views.packages.index',compact('Packages'));
    }

   
    public function create()
    {
        $pc = Packages_catogeries::all();
        return view('admin.views.packages.add',compact("pc"));
    }
    public function store(Request $request)
    {
            $this->validate($request,[
                'title'=> 'required',
                'catogery_id' => 'required', 
                'price'=> 'required',
            ]);
            
            $saveResult = Package::create([
                'title' => $request->title,
                'price' => $request->price,
                'type' => $request->type,
                'catogery_id' => $request->catogery_id,
				'promotion'=> ($request->promotion)?$request->promotion:0,
				'most_popular'=> ($request->most_popular)?$request->most_popular:0,
                'duration' => ($request->duration)?$request->duration:null,
                'spotlights' => $request->spotlights,
                'lovenotes' => $request->lovenotes,
                'options' => json_encode($request->options),
                'description' => $request->description,
				
              ]);
            session::flash('success','Record Uploaded Successfully');
            return redirect()->route('packages.index')->with('success','Record Uploaded Successfully');
    }

   
    public function show($id)
    {
        
    }

   
    public function edit($id)
    {
        $pc = Packages_catogeries::all();
        $package = Package::find($id);
        //dd($package);
        return view('admin.views.packages.edit')->with(['package'=> $package,"pc" => $pc]);
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'catogery_id' => 'required', 
            'price'=> 'required',
        ]);
        $product = Package::find($id);
				if($product != null){
$updateProduct = Package::where('id', '=', $id)->update(
            [
                'title' => $request->title,
                'type' => $request->type,
                'price' => $request->price,
                'catogery_id' => $request->catogery_id,
				'promotion'=> ($request->promotion)?$request->promotion:0,
				'most_popular'=> ($request->most_popular)?$request->most_popular:0,
                'duration' => $request->duration?$request->duration:null,
                'spotlights' => $request->spotlights,
                'lovenotes' => $request->lovenotes,
                'options' => json_encode($request->options),
                'description' => $request->description,
            ]
        );
        
		}else{
			 return back()
                ->with('error','Record is not Updated');      
		}
        
        
        if($updateProduct){
            return redirect()->route('packages.index')
                ->with('success','Record Updated Successfully');
            }else{
            return back()
                ->with('error','Record is not Updated');         	
            }
    }

   
    public function destroy($id)
    {
        $package= Package::find($id);
        $package->delete();
        session::flash('success','Record has been deleted Successfully');
        return redirect()->route('packages.index');
    }
		public function status ($id , $status)
	{
			if($status == '1'){
		 $package= Package::find($id)->update([
		 'active' => 1
		 ]);
		}else{
			 $package= Package::find($id)->update([
		 'active' => 0
		 ]);	
		}
		session::flash('success','Status has been Updated Successfully');
        return redirect()->route('packages.index');
	}
}
