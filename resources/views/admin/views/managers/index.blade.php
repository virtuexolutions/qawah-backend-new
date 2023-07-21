@extends('admin.views.layouts.default')
@section('title')
  Admin | Employee
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="card card-primary card-outline">
          <div class="card-header">
  
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Employee Management
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
              <a class="btn btn-success" href="{{ route('managers.create') }}"> Create New Employee</a>

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
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th>Action</th>
                </tr>
                  </thead>
                  <tbody>
                  @if($data)
                    @php
                    $id =1;
                    @endphp
                    @foreach($data as $key => $user)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                        @endif
                      </td>
                      <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('managers.edit',$user->id) }}">Edit</a>    
                   
                      {{--   <form method="post" action="{{route('managers.destroy',$user->id)}}">
                          @csrf
                          @method('delete')
                          <button type="submit" onclick="return confirm('Are You Sure Want To Delete This.??')" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button> --}}
                        </form>
                      </div>
                    </td>
                    </td>
                  </tr>
                  @endforeach
                  @endif

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
