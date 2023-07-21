@extends('admin.views.layouts.default')
@section('title')
Admin | Employee
@endsection
@section('content')


<div class="card card-primary card-outline">
          <div class="card-header">
           
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Create Employee
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
                <h3 class="card-title">Add Content</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('managers.store')}}">
                    @csrf
                <div class="card-body">                
                 <div class="row">    
                    <div class="col-md-6">
                        <div class="form-group">
                        <strong>Name:</strong>
                                <input class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <strong>Email:</strong>
                                <input class="form-control" type="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <strong>Password:</strong>
                                <input class="form-control" type="password" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <strong>Confirm Password:</strong>
                                <input class="form-control" type="password" name="confirm-password" required>
                        </div>
                    </div>
               
                    <div class="col-md-6">
                        <div class="form-group">
                        <strong>Role:</strong>
                        <select name="roles[]" class="form-control" required>
                                    <option>select role</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                 </div> 
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" type="text/javascript"></script>
@endsection
