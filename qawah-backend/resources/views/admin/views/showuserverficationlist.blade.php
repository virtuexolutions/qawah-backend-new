@extends('admin.views.layouts.default')
@section('title')
  Admin | Verification
@endsection

@section('content')

<div class="card card-primary card-outline">
          <div class="card-header">
           <?php 
                 $page = Request::segment(2);
                 $pg = ucfirst($page);
           ?>
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              <?=$pg?>  Page
            </h3>

            <?php $pageLink = 'admin/'.Request::segment(2).'/add-content'; ?>
     

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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>User Name</th>
                    <th>User email</th>
                    <th>Image</th>
                    <th>Status</th>

                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($verify as $val)
                    <tr>
                      <td>{{$val->id}}</td>
                      <td>{{($val->user)?$val->user->profileName:null}}</td>
                      <td>{{($val->user)?$val->user->email:null}}</td>
                      <td><button type="button" data-toggle="modal" href='#edit-secss1-{{$val->id}}' class="btn btn-primary"> Show Image</button>
                          <div class="modal fade" id="edit-secss1-{{$val->id}}" style="padding: 0px 0px;">
                                            <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">

                                                                <div class="col-lg-12 d-flex justify-content-center">
                                                                        <a href="{{$val->url}}" target="_blank">
                                                                        <img src="{{$val->url}}"  >
                                                                        </a>
                                                                </div>                                            
                                                            </div>

                                                        </div>
                                                      
                                                    </div>
                                            </div>
                          </div>
                    </td>
                 
                      <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if($val->status == '2')
                          Pending
                          @elseif($val->status == '1')
                          Approved
                          @else
                          Cancel
                          @endif      
                      </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('verification_status',['id'=> $val->id,'status'=>2])}}">Pending</a>
                            <a class="dropdown-item" href="{{route('verification_status',['id'=> $val->id,'status'=>1])}}">Approved</a>
                            <a class="dropdown-item" href="{{route('verification_status',['id'=> $val->id,'status'=>0])}}">Cancel</a>  
                          </div>
                      </div>
                       


                      </td>
                      <td> <a href="{{route('verification_delete',['id'=>$val->id])}}" onclick="return confirm('Are You Sure Want To Delete This..!!')"><i style="color: #bd0a0a;" class="fa fa-trash" aria-hidden="true">
                        </i></a> </td>
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


    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sg">
      <div class="modal-content">
        <div class="modal-header">
          
          <h5 class="modal-title">Detail</h5>
        </div>
        <div class="modal-body">
        <div class="table">
        <table class="table table-hover Inquiries">
        <!-- <tbody class="Inquiries"> -->
        <!-- <tr><th>id #</th><td>4</td></tr>
        <tr>
        <th>Name</th>
        <td>Conse</td>
        </tr>
        <tr><th>Email</th>
        <td>pisowusav@mailinator.com</td>
        </tr>
        <tr><th>Phone</th>
        <td>132123123</td>
        </tr>
        <tr>
        <th>Message</th>
        <td>Labor</td>
        </tr>
        <tr>
        <th>Created</th>
        <td>2020-12-28 20:00:31</td>
        </tr> -->

        <!-- </tbody> -->
    </table>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  

@endsection

@push('footer-scripts')
<script type="text/javascript">
   $(document).on('click','.showDetail',function(){
      var recordId = $(this).attr('id');
      $.ajax({
          url:'get/Inquiry',
          dataType:'json',
          data: { "id": recordId,"_token": "{{ csrf_token() }}"},
          method:'post',
          success: function(response){

            $.each(response, function (key, value) 
                {
                    $('.Inquiries').html(
                        '<tr><th>Id</th> <td>' + value.id + '</td></tr><tr><th>Name</th><td>' + value.name + '</td></tr><tr><th>Email</th> <td>' + value.email + '</td></tr><tr><th>Phone</th> <td>' + value.phone +'</td></tr><tr><th>Message</th><td>'+value.message+'</td></tr>');
                })

                $('#myModal').modal('show');

          }

      });
   });
 </script>

 @endpush
