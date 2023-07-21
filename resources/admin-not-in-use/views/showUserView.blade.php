@extends('layouts.default')

@section('title')
  Admin | Users
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="card card-primary card-outline">
          <div class="card-header">
           <?php 
                 $page = Request::segment(2);
                 $pg = ucfirst($page);
           ?>
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              <?=$pg?> Add Details to <?=$pg?> Page
            </h3>
            <?php //$pageLink = 'admin/'.Request::segment(2).'/add-content'; ?>
            <a href="user/add-user">
             <div style="text-align: right;"><button class="btn btn-dark btn-sm">Add User</button></div>
            </a>

          </div>

          <div class="card-body">
             @if($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ $message }}</strong>
              </div>
            @endif
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true"><?=$pg?> Page </a>
              </li>
             
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                <div class="container">
                  
                  <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">Home Page Data</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Profile Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Subscriber</th>
                    <th>Bad Review</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($homedata as $home)
           
                    
              
                   <?php $content = strip_tags($home->content); ?>
                    <tr>
                      <td>{{$home->id}}</td>
                       <td>{{$home->profileName}}</td>
                      <td>{{$home->phone}}</td>
                      <td>{{$home->email}}</td>
                      <td>   
                        @if(count($home->subscription) > 0 )
                        @foreach($home->subscription as $val)
                        <strong> Subscription Plan: </strong>{{$val->pkg_name??null}}<br />
                        <strong> Subscription Category: </strong>{{ $val->pkg_catogery??null }}<br />
                        <strong> Subscribed Date: </strong>{{ $val->staring??null }}<br />
                        <strong> Plan Expiry Date: </strong>{{ $val->ending??null }}
                        <hr>
                        @endforeach
                        @else
                        Not Package Subscribed
                        @endif
                        </td>
                        <td>
                        @if(count($home->user_report) > 0 )
                        @foreach($home->user_report as $vall)
                        <strong>Report By: </strong>{{$vall->user->email??null}}<br />
                        <strong>Review: </strong>{{$vall->reason??null}}                   
                        <hr>
                        @endforeach
                        @else
                        No Bad Review
                        @endif
                        </td>
                        <td>
                         @if(count($home->user_report) > 0 )                         
                           <i class="fa fa-flag" aria-hidden="true" title="Bad review Flag" style="color:Red"></i>
                           @else
                        @endif
                        |
                        <a href="{{route('user.show',['id' => $home->id])}}"><i style="color: #c49f47;" class="fa fa-eye"></i></a> |
                        @if($home->active == 0)
                        <a href="{{route('user_status',['id' => $home->id ,'status'=> 1 ])}}"> <i class="fa fa-check" style="color:green;" aria-hidden="true" title="Active this User"></i></a>    |
                        @else
                        <a href="{{route('user_status',['id' => $home->id ,'status'=> 0 ])}}"><i class="fa fa-close" style="color:red;" title="Deactive this User" ></i></a> |

                        @endif                        
                        <a href="{{route('user.delete' , ['id' => $home->id])}}"><i style="color: #bd0a0a;" class="fa fa-trash" aria-hidden="true"></i></a> 

                      </td>
                    </tr>
                    @endforeach
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                    
                  
                  
                </div>
              </div>
             
            </div>
            
          </div>
          <!-- /.card -->
        </div>

</script>
@endsection
