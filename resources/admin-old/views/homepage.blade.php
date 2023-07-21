@extends('layouts.default')

@section('title')
  Admin | Cms Pages
@endsection

@section('content')

<link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">



    {{-- section 1 --}}
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Section 1</h3><br>
                @if (!$sec1)
                    <button type="button" data-toggle="modal" href='#sec1-id' class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i></button>
                @endif
                <div class="modal fade" id="sec1-id">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('home_sec_1.store') }}" enctype="multipart/form-data"
                                    id="form" method="post">
                                    @csrf
                                    <div class="card card-warning">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Title </label>
                                                        <input class="form-control" required="" name="title" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Sub Title </label>
                                                        <input class="form-control" required="" name="sub_title" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Cover Image </label>
                                                        <input type="file" name="cover_img" required
                                                            class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Left Image </label>
                                                        <input type="file" name="left_img" required
                                                            class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Right Image </label>
                                                        <input type="file" name="right_img" required
                                                            class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="message" id="product1"required class="form-control" placeholder="Enter ..."></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Cover Image</th>
                                <th>Left Image</th>
                                <th>Right Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            ?>
                            @if ($sec1)
                                <tr>
                                    <td>{{ $sec1->title }}</td>
                                    <td>{{ $sec1->sub_title }}</td>
                                    <td><img src="{{ asset('/uploads/home/' . $sec1->cover_img) }}" width="100"alt=""></td>
                                    <td><img src="{{ asset('/uploads/home/' . $sec1->left_img) }}" width="100"alt=""></td>
                                    <td><img src="{{ asset('/uploads/home/' . $sec1->right_img) }}" width="100"alt=""></td>
                                    <td>{{$sec1->message}}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" href='#edit-sec1'
                                            class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <div class="modal fade" id="edit-sec1" style="padding: 0px 0px;">
                                            <div class="modal-dialog modal-lg">
                                                <form method="post" action="{{ route('home_sec_1.update', $sec1->id) }}"
                                                    enctype="multipart/form-data" id="update_link">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Title </label>
                                                                        <input class="form-control" required=""
                                                                            value="{{ $sec1->title }}" name="title" />
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Sub Title </label>
                                                                        <input class="form-control" required=""
                                                                            value="{{ $sec1->sub_title }}" name="sub_title" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Cover File </label>
                                                                        <input type="file" name="cover_img"
                                                                            class="form-control" placeholder="Enter ...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Left File </label>
                                                                        <input type="file" name="left_img"
                                                                            class="form-control" placeholder="Enter ...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Right File </label>
                                                                        <input type="file" name="right_img"
                                                                            class="form-control" placeholder="Enter ...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <textarea name="message" id="productedit1" required class="form-control">{{ $sec1->message }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form method="post" action="{{ route('home_sec_1.destroy', $sec1->id) }}">
                                            @csrf
                                            @method('delete')
                                            {{-- <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete This..??')" class="btn btn-default generalsetting_admin"><i class="fas fa-trash-alt"></i></button> --}}
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="text-center" colspan="7">No Record Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <!-- Sec 2 -->

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Section 2</h3><br>
                @if (!$sec2)
                    <button type="button" data-toggle="modal" href='#sec2-id' class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i></button>
                @endif
                <div class="modal fade" id="sec2-id">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('home_sec_2.store') }}" enctype="multipart/form-data"
                                    id="form" method="post">
                                    @csrf
                                    <div class="card card-warning">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Iframe </label>
                                                        <input class="form-control" required="" name="iframe" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Iframe</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($sec2)
                                <tr>
                                    <td>{{ $sec2->iframe }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" href='#edit-sec2'
                                            class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <div class="modal fade" id="edit-sec2" style="padding: 0px 0px;">
                                            <div class="modal-dialog modal-lg">
                                                <form method="post" action="{{ route('home_sec_2.update', $sec2->id) }}"
                                                    enctype="multipart/form-data" id="update_link">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Iframe </label>
                                                                        <input class="form-control" required=""
                                                                            value="{{ $sec2->iframe }}" name="iframe" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form method="post" action="{{ route('home_sec_2.destroy', $sec2->id) }}">
                                            @csrf
                                            @method('delete')
                                            {{-- <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete This..??')" class="btn btn-default generalsetting_admin"><i class="fas fa-trash-alt"></i></button> --}}
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="text-center" colspan="7">No Record Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Sec 3 -->

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Section 3</h3><br>
                @if (!$sec3)
                    <button type="button" data-toggle="modal" href='#sec3-id' class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i></button>
                @endif
                <div class="modal fade" id="sec3-id">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('home_sec_3.store') }}" enctype="multipart/form-data"
                                    id="form" method="post">
                                    @csrf
                                    <div class="card card-warning">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Title </label>
                                                        <input class="form-control" required="" name="title1" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Image </label>
                                                        <input type="file" class="form-control" required="" name="image1" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>text </label>
                                                        <input class="form-control" required="" name="description1" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Title </label>
                                                        <input class="form-control" required="" name="title2" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Image </label>
                                                        <input type="file" class="form-control" required="" name="image2" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>text </label>
                                                        <input class="form-control" required="" name="description2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Title </label>
                                                        <input class="form-control" required="" name="title3" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Image </label>
                                                        <input type="file" class="form-control" required="" name="image3" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>text </label>
                                                        <input class="form-control" required="" name="description3" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th>Title</th>
                              <th>Image</th>
                              <th>Description</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($sec3)
                                <tr>
                                    <td>{{ $sec3->title1 }}</td>
                                    <td>{{ $sec3->description1 }}</td>
                                    <td>{{ $sec3->title1 }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" href='#edit-sec3'
                                            class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <div class="modal fade" id="edit-sec3" style="padding: 0px 0px;">
                                            <div class="modal-dialog modal-lg">
                                                <form method="post" action="{{ route('home_sec_3.update', $sec3->id) }}"
                                                    enctype="multipart/form-data" id="update_link">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                        <div class="row">
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>Title </label>
                                                                  <input class="form-control" required="" value="{{$sec3->title1}}" name="title1" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>Image </label>
                                                                  <input type="file" class="form-control" name="image1" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>text </label>
                                                                  <input class="form-control" required="" value="{{$sec3->description1}}" name="description1" />
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>Title </label>
                                                                  <input class="form-control" required="" value="{{$sec3->title2}}" name="title2" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>Image </label>
                                                                  <input type="file" class="form-control" name="image2" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>text </label>
                                                                  <input class="form-control" value="{{$sec3->description2}}" required="" name="description2" />
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>Title </label>
                                                                  <input class="form-control" required="" value="{{$sec3->title3}}" name="title3" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>Image </label>
                                                                  <input type="file" class="form-control" name="image3" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-4">
                                                              <div class="form-group">
                                                                  <label>text </label>
                                                                  <input class="form-control" required="" value="{{$sec3->description3}}" name="description3" />
                                                              </div>
                                                          </div>
                                                      </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form method="post" action="{{ route('home_sec_3.destroy', $sec3->id) }}">
                                            @csrf
                                            @method('delete')
                                            {{-- <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete This..??')" class="btn btn-default generalsetting_admin"><i class="fas fa-trash-alt"></i></button> --}}
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="text-center" colspan="7">No Record Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


     <!-- Sec 4 -->

     <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Section 4</h3><br>
                @if (!$sec4)
                    <button type="button" data-toggle="modal" href='#sec4-id' class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i></button>
                @endif
                <div class="modal fade" id="sec4-id">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('home_sec_4.store') }}" enctype="multipart/form-data"
                                    id="form" method="post">
                                    @csrf
                                    <div class="card card-warning">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Title </label>
                                                        <input class="form-control" required="" name="title" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>iframe</label>
                                                        <input class="form-control" required="" name="iframe" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Title </label>
                                                        <input class="form-control" required="" name="title1" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>text </label>
                                                        <input class="form-control" required="" name="description1" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Title </label>
                                                        <input class="form-control" required="" name="title2" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>text </label>
                                                        <input class="form-control" required="" name="description2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Title </label>
                                                        <input class="form-control" required="" name="title3" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>text </label>
                                                        <input class="form-control" required="" name="description3" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-sm-12">
                                                  <div class="form-group">
                                                      <label>Description </label>
                                                      <input class="form-control" required="" name="description" />
                                                  </div>
                                              </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th>Title</th>
                              <th>Iframe</th>
                              <th>Description</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($sec4)
                                <tr>
                                    <td>{{ $sec4->title1 }}</td>
                                    <td><iframe src="{{ $sec4->iframe }}" frameborder="0"></iframe></td>
                                    <td>{{ $sec4->title1 }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" href='#edit-sec4'
                                            class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <div class="modal fade" id="edit-sec4" style="padding: 0px 0px;">
                                            <div class="modal-dialog modal-lg">
                                                <form method="post" action="{{ route('home_sec_4.update', $sec4->id) }}"
                                                    enctype="multipart/form-data" id="update_link">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                        <div class="row">
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <label>Title </label>
                                                                  <input class="form-control" required="" value="{{$sec4->title}}" name="title" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <label>Iframe </label>
                                                                  <input class="form-control" required="" value="{{$sec4->iframe}}" name="iframe" />
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <label>Title </label>
                                                                  <input class="form-control" required="" value="{{$sec4->title1}}" name="title1" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <label>text </label>
                                                                  <input class="form-control" required="" value="{{$sec4->description1}}" name="description1" />
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <label>Title </label>
                                                                  <input class="form-control" required="" value="{{$sec4->title2}}" name="title2" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <label>text </label>
                                                                  <input class="form-control" value="{{$sec4->description2}}" required="" name="description2" />
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <label>Title </label>
                                                                  <input class="form-control" required="" value="{{$sec4->title3}}" name="title3" />
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-6">
                                                              <div class="form-group">
                                                                  <label>text </label>
                                                                  <input class="form-control" required="" value="{{$sec4->description3}}" name="description3" />
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-12">
                                                              <div class="form-group">
                                                                  <label>Description </label>
                                                                  <input class="form-control" required="" value="{{$sec4->description}}" name="description" />
                                                              </div>
                                                          </div>
                                                       </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form method="post" action="{{ route('home_sec_4.destroy', $sec4->id) }}">
                                            @csrf
                                            @method('delete')
                                            {{-- <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete This..??')" class="btn btn-default generalsetting_admin"><i class="fas fa-trash-alt"></i></button> --}}
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="text-center" colspan="7">No Record Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
@endsection
