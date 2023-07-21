@extends('admin.views.layouts.default')
@section('title')
Admin | Change Passowrd
@endsection
@section('content')


<div class="card card-primary card-outline">
          <div class="card-header">
           
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Create Change Passowrd
            </h3>
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
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Role Page </a>
              </li>
            </ul>
           <br>
          <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('store_change_password')}}" method="post" class="validatedForm" enctype="multipart/form-data">
    		      	@csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">

                    	<div class="form-group">
	                        <label>Old Password</label>
	                        <code>*</code>
	                        <input name="oldpassword" type="password" class="form-control" required>
	                    </div>

                        <div class="form-group">
	                        <label>New Password</label>
	                        <code>*</code>
	                        <input name="newpassword" id="password" minlength="8" type="password" class="form-control" required>
	                    </div>
                        <div class="form-group">
	                        <label>Confirm Password</label>
	                        <code>*</code>
	                        <input name="password_confirmation" data-rule-equalTo="#password" type="password" class="form-control" required>
	                    </div>
                	</div>
                  </div>
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
