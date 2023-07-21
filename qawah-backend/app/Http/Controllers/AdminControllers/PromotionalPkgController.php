<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PrmotionalPackage;
use App\Packages_catogeries;
use auth;
use Session;

class PromotionalPkgController extends Controller
{
	
	function __construct()
    {
        $this->middleware('permission:promotions-list|promotions-create|promotions-edit|promotions-delete', ['only' => ['index','store']]);
        $this->middleware('permission:promotions-create', ['only' => ['create','store']]);
        $this->middleware('permission:promotions-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:promotions-delete', ['only' => ['destroy']]);
        $this->middleware('permission:promotions-status', ['only' => ['status']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Packages = PrmotionalPackage::all();
       return view('admin.views.promotions.index',compact('Packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       		$pc = Packages_catogeries::all();
        return view('admin.views.promotions.add',compact("pc"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             $this->validate($request,[
                'title'=> 'required',
                'catogery_id' => 'required', 
                'price'=> 'required',
            ]);
            
            $saveResult = PrmotionalPackage::create([
                'title' => $request->title,
                'price' => $request->price,
                'type' => $request->type,
                'catogery_id' => $request->catogery_id,
                'duration' => $request->duration?$request->duration:null,
                'spotlights' => $request->spotlights,
                'lovenotes' => $request->lovenotes,
                'options' => json_encode($request->options),
                'description' => $request->description,
              ]);
            session::flash('success','Record Uploaded Successfully');
            return redirect()->route('promotions.index')->with('success','Record Uploaded Successfully');
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
        $pc = Packages_catogeries::all();
        $package = PrmotionalPackage::find($id);
        //dd($package);
        return view('admin.views.promotions.edit')->with(['package'=> $package,"pc" => $pc]);
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
       $this->validate($request,[
            'catogery_id' => 'required', 
            'price'=> 'required',
        ]);
        $product = PrmotionalPackage::find($id);
		if($product != null){
			      $updateProduct = PrmotionalPackage::where('id', '=', $id)->update(
            [
                'title' => $request->title,
                'type' => $request->type,
                'price' => $request->price,
                'catogery_id' => $request->catogery_id,
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
            return redirect()->route('promotions.index')
                ->with('success','Record Updated Successfully');
            }else{
            return back()
                ->with('error','Record is not Updated');         	
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package= PrmotionalPackage::find($id);
        $package->delete();
        session::flash('success','Record has been deleted Successfully');
        return redirect()->route('promotions.index');
    }
	public function status($id,$status)
	{
		if($status == '1'){
		 $package= PrmotionalPackage::find($id)->update([
		 'active' => 1
		 ]);
		}else{
			 $package= PrmotionalPackage::find($id)->update([
		 'active' => 0
		 ]);	
		}	
		session::flash('success','Status has been Updated Successfully');
        return redirect()->route('promotions.index');
	}
}
