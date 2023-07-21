@extends('admin.views.layouts.default')
@section('title')
Admin | Add Banner
@endsection
@section('content')
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            @if ($errors->any())
              @foreach ($errors->all() as $error)
                  <p class="text-danger">{{$error}}</p>
              @endforeach
             @endif
          </div>
          <div class="col-md-12">
            <form action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">page</label>
                  <select class="form-control form-select" name="page">
                    @foreach($pages as $k => $v)
                     <option value="{{$v->id}}">{{$v->page_name}}</option>
                     @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Title</label>
                  <input type="text" class="form-control" required="" name="title" id="exampleInputPassword1" placeholder="Title">
                </div>

                <div class="form-group">
                  
                  <label for="exampleInputPassword1">Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" required name="image" class="custom-file-input" id="image">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-default">submit</button>
              </div>
            </form>
          </div>
        </div>
    </div>

@endsection
