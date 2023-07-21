<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:category|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:product-create', ['only' => ['create','store']]);
        // $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:category', ['only' => ['index']]);

        // $this->middleware('auth:admin');
    }

    
    public function index(){
        $category = Category::all();
        return view('showCategory',compact('category'));
    }
    
    
    public function fetch_package_category(Request $request){
        $category = \DB::table('package_sub_category')->where('pkg_cat_id',$request->id)->get();
        return response()->json(['data'=>$category]);
        // return view('showCategory',compact('category'));
    }


    public function show(){
        return view('addCategory');
    }





    public function edit($id)
    {
        $category = Category::find($id);
        return view('categoryedit',compact('category'));
    }



    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->category_name = $request->input('category_name');
       // dd($category);
        $category->save();
        session::flash('success','Record Updated Successfully');
        return redirect('admin/category');
    }




    public function create(Request $request){

        request()->validate([
            'category_name' => 'required|min:3',
        ]);

        $category = Category::create( $request->all());
        if($category){
            session::flash('success','Category has been successfully added');
            return redirect('admin/category');
        }
        // return back()->with('success','Category successfully added');
    }


        public function destroy($id)
    {
       $category = Category::find($id);
       $category->delete();
       session::flash('success','Record has been deleted Successfully');
       return redirect('admin/category');
        
    }
    
}
