@extends('admin.views.layouts.default')
@section('title')
Admin | Add Offer Package
@endsection
@section('content')


<div class="card card-primary card-outline">
          <div class="card-header">
           
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Package Add Details to Package Page
            </h3>
            <!-- <a href="{{url('admin/add-content')}}">
             <div style="text-align: right;"><button class="btn btn-primary">Add Content</button></div>
            </a> -->

          </div>

          <div class="card-body">
          	@if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

          @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
          @endif

          @if($message = Session::get('error'))
            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
          @endif

            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Package Page </a>
              </li>
            </ul>
           <br>
          <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Content</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('subscription.store')}}" method="post" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Package Title</label>
                    <input type="text" class="form-control" required="" name="title" id="exampleInputPassword1" placeholder="Title">
                  </div> -->
                 <div class="row">
                  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Package</label>
                            <select class="form-control" name="pkg_id" required>
                         	@foreach($packages as $row)								
                            <option value="{{$row->id}}">{{$row->title}} {{$row->packages_categery->title}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">User</label>
                        <select class="form-control" name="user_id" required>
                            <option value=""></option>
                            @foreach($users as $row)
				
                            <option value="{{$row->id}}">{{$row->profileName}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                 </div>
                  
                  
                  
                  {{-- <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Starting</label>
                        <input type="date" class="form-control" required name="starting" placeholder="spotlights">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Expire</label>
                        <input type="date" class="form-control" required name="ending" placeholder="spotlights">
                      </div>
                    </div>
                  </div> --}}
                  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
          

          </div>
          
        </div>

            
            
          </div>
          <!-- /.card -->
        </div>

@endsection
