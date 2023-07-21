@extends('admin.views.layouts.default')
@section('title')
  Admin | Subscription list
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="card card-primary card-outline">
          <div class="card-header">
  
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Users Subscribed Packages
            </h3>

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
                <table id="example4" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Subscribed Package Name</th>
                    <th> Subscribed Package Type</th>
                    <th>User Profile Name</th>
                    <th>User Goverment Name</th>
                    <th>User Email</th>
                    <th>Subscribed Date</th>
                    <th> Subscribed Package Amount</th>

                  </tr>
                  </thead>
                  <tbody>
              <?php $total=0;?>
                    @foreach($users as $value)         
                  <?php
					  $category=null;
					  if($value->pkg_id){
						  
					 $package = \App\Package::findOrFail($value->pkg_id);
					  if($package){
					  $category = \App\Packages_catogeries::findOrFail($package->catogery_id);
					  }else{
					  $category =null;
					  }
					 }
					  $total += $value->package->price ?? 0; ?>
                  
                    <tr>
                      <td>{{$value->id}}</td>
                       <td>{{$value->pkg_name ?? "no title"}}</td>
                       <td>{{($category != null)? $category->title : null}}</td>
                       <td>{{$value->user->profileName}}</td>                       
                      <td>{{$value->user->governmentName}}</td>
                      <td>{{$value->user->email}}</td>
                      <td>{{date('d-M-Y', strtotime($value->created_at))}}</td>
                      <td>${{$value->package->price ?? 0}}</td>

                    </tr>
                    @endforeach
                  </tbody>
                  <thead>
                  <tr>
                    <th></th>
                    <th></th>                   
                    <th> </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total:</th>
                    <th>${{$total}}</th>
                  </tr>
                  </thead>
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
      
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

        <script>
        $(document).ready(function () {

    $('#example4').DataTable({
      order:[[8,"desc"]]
    });
});
</script>
@endsection
