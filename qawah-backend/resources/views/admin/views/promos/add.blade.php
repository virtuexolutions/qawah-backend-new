@extends('admin.views.layouts.default')

@section('title')
Admin | Add Promos
@endsection
@section('content')


<div class="card card-primary card-outline">
  <div class="card-header">

    <h3 class="card-title">
      <i class="fas fa-edit"></i>
      Promos Add Details to Promos Page
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
        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
          href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
          aria-selected="true">Promo COde Page </a>
      </li>
    </ul>
    <br>
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Promos Code </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{route('promos.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Promo Code</label>
                    <input type="text" class="form-control"  name="code" id="exampleInputPassword1"
                      placeholder="Promo COde " required>
                  </div>
                </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Percent %</label>
                    <input type="number" class="form-control" min="1" max="100" maxlength="100"  minlength="1" name="percent" id="exampleInputPassword1"
                      placeholder="Promo COde " required>
                  </div>
                </div>
              </div>
          
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>


      </div>

    </div>



  </div>
  <!-- /.card -->
</div>

@endsection