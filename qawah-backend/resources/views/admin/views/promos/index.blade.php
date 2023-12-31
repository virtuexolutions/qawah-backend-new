@extends('admin.views.layouts.default')

@section('title')
  Admin | Promos Code
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
            Add Details to Promos Page
            </h3>

            <?php $pageLink = 'admin/'.Request::segment(2).'/add-content'; ?>
            <a href="{{route('promos.create')}}">
             <div style="text-align: right;"><button class="btn btn-dark btn-sm">Add <?=$pg?></button></div>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Promo Code</th>
					  <th>Percent</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($promos as $pkg)
                    <tr>
                      <td>{{$pkg->id}}</td>
						<td><span class="btn btn-warning">{{$pkg->code}}</span></td>
                      <td>{{$pkg->percent}} %</td>
				
                      <td><a href="{{route('promos.edit',$pkg->id)}}"><i style="color: #c49f47;" class="fas fa-pen-square"></i></a> |
						   
						  <form method="post" action="{{route('promos.destroy',$pkg->id)}}">
							 @csrf
							  @method('DELETE')
                         <button><i style="color: #bd0a0a;" class="fa fa-trash" aria-hidden="true">
                        </i></button> 
						</form>
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
