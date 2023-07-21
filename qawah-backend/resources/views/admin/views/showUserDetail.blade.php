@extends('admin.views.layouts.default')
@section('title')
  Admin | Users|Show
@endsection

@section('content')


<div class="card card-primary card-outline">
          <div class="card-header">
     
            <h3 class="card-title">
              <i class="fas fa-eye"></i>
              User Details
            </h3>


          </div>

          <div class="card-body">
  
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
              </li>
             
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                <div class="container">
                  
              <div class="card">
                   <div class="card-body">
                <h3 class="card-title">User Detail</h3>

                <div class="row">
                        <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                         <div class="card-body">
							 @if($user->profileName)
                            <div class="form-group">
                             <label>User  Name</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->profileName}}">
                            </div>
							 @endif
							  @if($user->email)
                               <div class="form-group">
                             <label>User Email</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->email}}">
							 </div>
							 @endif
							 @if($user->phone)
                            <div class="form-group">
                             <label>User Phone</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->phone}}">
							 </div>
							 @endif
							 @if($user->birthday)
                            <div class="form-group">
                             <label>User DOB</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->birthday}}">
							 </div>
							 @endif
                         </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                         <div class="card-body">
							 @if($user->height)
                            <div class="form-group">
                             <label>User  hieght</label>
                    
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{json_decode($user->height)->feet}} feet & {{json_decode($user->height)->inches}} inches">
							 </div>
							 @endif
							 @if($user->height)
                               <div class="form-group">
                             <label>User Sex</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->iAm}}">
                            </div>
							 @endif
							 @if($user->seeking)
                            <div class="form-group">
                             <label>User Seeking</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->seeking}}">
                            </div>
							 @endif
							 @if($user->zipcode)
                            <div class="form-group">
                             <label>User Zip</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->zipcode}}">
                            </div>
							 @endif
                         </div>
                    </div>
                    </div>
                </div>
                        <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                         <div class="card-body">
							 @if($user->aboutMe)
                            <div class="form-group">
                             <label>User  About</label>
								<textarea disabled class="form-control" id="exampleInputEmail1">{{$user->aboutMe}}</textarea>
                            </div>
							 @endif
							 @if($user->bodyType)
                               <div class="form-group">
                             <label>User Body Type</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->bodyType}}">
                            </div>
							 @endif
							 @if($user->doYouDrink)
                            <div class="form-group">
                             <label>User Drink/Not</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->doYouDrink}}">
                            </div>
							 @endif
							 @if($user->doYouHaveChildren)
                            <div class="form-group">
                             <label>User Childeren</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->doYouHaveChildren}}">
                            </div>
							 @endif
                         </div>
                    </div>
                    </div>
                </div>
                              <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                         <div class="card-body">
							 @if($user->doYouSmoke)
                            <div class="form-group">
                             <label>User Smoke</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->doYouSmoke}}">
                            </div>
							 @endif
							 @if($user->doYouWantMoreChildren)
                               <div class="form-group">
                             <label>User Want More childeren</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->doYouWantMoreChildren}}">
                            </div>
							 @endif
							 @if($user->employmentStatus)
                            <div class="form-group">
                             <label>User Employemnt Status</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->employmentStatus}}">
                            </div>
							 @endif
							 @if($user->havePets)
                            <div class="form-group">
                             <label>User have Pets</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->havePets}}">
                            </div>
							 @endif
                         </div>
                    </div>
                    </div>
                </div>
                    <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                         <div class="card-body">
							 @if($user->havePetsOthers)
                            <div class="form-group">
                             <label>User have Pets</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->havePetsOthers}}">
                            </div>
							 @endif
							 @if($user->howOftenDoYouExercise)
                               <div class="form-group">
                             <label>User Does Exercise</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->howOftenDoYouExercise}}">
                            </div>
							 @endif
							 @if($user->livingSituation)
                            <div class="form-group">
                             <label>User Living stituation</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->livingSituation}}">
                            </div>
							 @endif
							 @if($user->maritalStatus)
                            <div class="form-group">
                             <label>User Marital Status</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->maritalStatus}}">
							 </div>
							 @endif
                         </div>
                    </div>
                    </div>
                </div>
                           <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                         <div class="card-body">
							  @if($user->relationshipIAmSeeking)
                            <div class="form-group">
                             <label>User Seeking Relationship</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->relationshipIAmSeeking}}">
                            </div>
							 @endif
							  @if($user->willingToRelocate)
                               <div class="form-group">
                             <label>User Willing To Relocate</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->willingToRelocate}}">
                            </div>
							 @endif
							  @if($user->anyAffiliation)
                            <div class="form-group">
                             <label>User Affiliation</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->anyAffiliation}}">
                            </div>
							 @endif
							  @if($user->iBelieveIAM)
                            <div class="form-group">
                             <label>User Blieve</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->iBelieveIAM}}">
							 </div>
							 @endif
                         </div>
                    </div>
                    </div>
                </div>
                          <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                         <div class="card-body">
							  @if($user->maritalBeliefSystem)
                            <div class="form-group">
                             <label>User Belief System</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->maritalBeliefSystem}}">
                            </div>
							 @endif
							  @if($user->spiritualBackground)
                               <div class="form-group">
                             <label>User Spiritual Background</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->spiritualBackground}}">
                            </div>
							 @endif
							  @if($user->spiritualValue)
                            <div class="form-group">
                             <label>User Spritual Value</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->spiritualValue}}">
                            </div>
							 @endif
							  @if($user->studyBible)
                            <div class="form-group">
                             <label>User Blieve</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->studyBible}}">
                            </div>
							  @endif
                         </div>
                    </div>
                    </div>
                </div>
                  <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                         <div class="card-body">
							 @if($user->studyHabits)
                            <div class="form-group">
                             <label>User Study Habits</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->studyHabits}}">
                            </div>
							  @endif
							 @if($user->spiritualBackground)
                               <div class="form-group">
                             <label>User Spiritual Background</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->spiritualBackground}}">
                            </div>
							  @endif
							 @if($user->yearsInTruth)
                            <div class="form-group">
                             <label>User Years In Truth</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$user->yearsInTruth}}">
							 </div>
							 @endif
                         </div>
                    </div>
                    </div>
                </div>

                </div>
              </div>
       </div>

                  <div class="card">
     
              <div class="card-body">
                <div class="row">
               @if($user->subscription != '[]')
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                        <h3 class="card-title">User Subscription</h3>
						@foreach($user->subscription as $key => $subs)
							  @php
					  $category =null;
					  if($subs->pkg_id)
					  {
					  $package = \DB::table('packages')->where('id',$subs->pkg_id)->first();
					  if($package){
					  $category = \App\Packages_catogeries::findOrFail($package->catogery_id);
					  }else{
					  $category =null;
					  }
						}
					  @endphp
                         <div class="card-body">
                            <div class="form-group">
                             <label>Package Name</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$subs->pkg_name}}">
                            </div>
                               <div class="form-group">
                             <label>Package Category</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{($category)?$category->title:null}}">
                            </div>
                            <div class="form-group">
                             <label>Package Spotlights</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$subs->spotlights}}">
                            </div>
                          
						</div>
						@endforeach
                    </div>
                    </div>
                </div>
                  @endif
 @if($user->isrealitePracticeKeeping != '[]')
                  <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                        <h3 class="card-title">User Isrealite Practice Keeping</h3>
												</br>

                         <div class="card-body">
                            @foreach($user->isrealitePracticeKeeping as $key => $opt)
                            <div class="form-group">
                             <label>Option No: {{$key+1}}</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$opt->options}}">
                            </div>
                          @endforeach
                        
                        
                         </div>
                    </div>
                    </div>
                </div>
                @endif
                 @if($user->kingdomGifts != '[]')
                  <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                        <h3 class="card-title">User Kingdom Gifts</h3>
						</br>
                         <div class="card-body">
                            @foreach($user->kingdomGifts as $key => $optt)
                            <div class="form-group">
                             <label>Option No: {{$key+1}}</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$optt->options}}">
                            </div>
                          @endforeach
                        
                        
                         </div>
                    </div>
                    </div>
                </div>
                @endif
                 @if($user->passions != '[]')
                  <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                        <h3 class="card-title">User Passions</h3>
												</br>

                         <div class="card-body">
                            @foreach($user->passions as $key => $opttt)
                            <div class="form-group">
                             <label>Passion No: {{$key+1}}</label>
                             <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{$opttt->options}}">
                            </div>
                          @endforeach
                        
                        
                         </div>
                    </div>
                    </div>
                </div>
                @endif
                         @if(count($user->profile_images) > 0)
                     
                       <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                        <h3 class="card-title">User Profiles</h3>
                         <div class="card-body">
                          <div class="row">
                          @foreach($user->profile_images as $img)
                          <div class="card-body">

                          <div class="col-md-4">

                         <div class="form-group">
                               <img src="{{asset($img->url)}}" width="100px">
                               <form action="{{route('prifle_destroy',$img->id)}}" method="Post">
                                @csrf
                                
                               <button class="form-control" style="padding: 0 50px 0 50px; background-color: grey;" onclick="return confirm('are you sure?')"><i style="color: #bd0a0a; justify-content: center;" class="fa fa-trash" aria-hidden="true"></i></button>
                               </form>
                         </div>    
                         </div>    
                         </div>    

                         @endforeach
                          </div>
                
             
                         </div>
                    </div>
                    </div>
                </div>
                @endif
            @if(count($user->gallery_images) > 0)
                       <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card ">
                    <div class="card-header">
                        <h3 class="card-title">User Gallery Images</h3>
                         <div class="card-body">
                         @foreach($user->gallery_images as $imgg)
						@php
		      			$info = pathinfo(asset($imgg->url));
						$ext = $info['extension'];
						@endphp
                          <div class="card-body">

                          <div class="col-md-4">

                         <div class="form-group">
								@if($ext =='png'||$ext =='jpg'||$ext =='jpeg')
                               <img src="{{asset($imgg->url)}}" width="100px">
							 	@else
							 	<video width="100px" height="100px" controls>
								  <source src="{{asset($imgg->url)}}" type="video/mp4">
								  <source src="{{asset($imgg->url)}}" type="video/ogg">
								  Your browser does not support the video tag.
								</video>
							 	@endif
                               <form action="{{route('galley_destroy',$imgg->id)}}" method="Post">
                                @csrf                                
                               <button class="form-control" style="padding: 0 50px 0 50px; background-color: grey;" onclick="return confirm('are you sure?')"><i style="color: #bd0a0a;justify-content: center;" class="fa fa-trash" aria-hidden="true"></i></button>
                               </form>
                         </div>    
                         </div>    
                         </div>    

                         @endforeach
                        
      
                         </div>
                    </div>
                    </div>
                </div>
                @endif
             </div>

              </div>
          
            
            </div>                  
                  
                  
                </div>
              </div>
             
            </div>
            
          </div>
          <!-- /.card -->
        </div>


@endsection
