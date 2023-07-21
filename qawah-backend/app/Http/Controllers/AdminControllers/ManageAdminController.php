<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Auth;
use Validator;
class ManageAdminController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index','store']]);
        $this->middleware('permission:employee-create', ['only' => ['create','store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
        $this->middleware('permission:employee-show', ['only' => ['show']]);

    }
    public function index(Request $request)
    { 
        $data = Admin::where('id','!=', Auth::guard('admin')->user()->id)->orderBy('id','DESC')->paginate(10);
        return view('admin.views.managers.index',compact('data'));
    }
    public function create()
    {
         $roles = Role::select(['id','name'])->get();
        return view('admin.views.managers.create',compact('roles'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[  
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'roles' => 'required'
        ]);
   
    
        $input = $request->except(['_token'],$request->all());
        $input['password'] = Hash::make($input['password']);
    
        $user = Admin::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('managers.index')
                        ->with('success','User created successfully');
    }
    public function show($id)
    {
        $user = Admin::find($id);
        return view('admin.views.managers.show',compact('user'));
    }
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::select('id','name')->get();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.views.managers.edit',compact('user','roles','userRole'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email,'.$id.',id',
			'roles'=> 'required',
        ]);
        $input = $request->all();
	
		if(empty($request->input('roles')))
		{
		 return redirect()->back()->with('error','role is required');
		}
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = Admin::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('managers.index')
                        ->with('success','User updated successfully');
    }
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('managers.index')
                        ->with('success','User deleted successfully');
    }
}
