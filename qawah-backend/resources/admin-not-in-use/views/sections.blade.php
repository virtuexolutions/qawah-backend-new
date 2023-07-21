@extends('layouts.default')

@section('title')
  Admin | Cms sections
@endsection

@section('content')

<link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">





        <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Page Info</h3><br>
                    <button type="button" data-toggle="modal" href='#sec1-id' class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i></button>
                <div class="modal fade" id="sec1-id">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('sections.store') }}" enctype="multipart/form-data"
                                    id="form" method="post">
                                    @csrf
                                    <div class="card card-warning">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Page Title </label>
                                                        <select name="page_id" class="form-control" required>
                                                            @foreach($pages as $page)
                                                            <option value="{{$page->id}}">{{$page->page_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Section Name </label>
                                                    <select  name="section_name"  class="form-control" required>
                                                            <option value="slider">Slider Section</option>
                                                            <option value="video">Video Section</option>
                                                            <option value="middel">Middel Section</option>
                                                            <option value="bottom">Bottom Section</option>
                                                            <option value="footer">Footer Section</option>

                                                        </select>
                                                </div>
                                            </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Logo </label>
                                                       <input type="file" name="logo" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Slider Image </label>
                                                       <input type="file" name="slider_image" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Right image </label>
                                                       <input type="file" name="right_image" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Left iamge </label>
                                                       <input type="file" name="left_iamge" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Slider content 1 </label>
                                                       <input type="text" name="slider_content_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Slider content 2 </label>
                                                       <input type="text" name="slider_content_2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Video Url </label>
                                                       <input type="text" name="video_url" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Icon image 1</label>
                                                       <input type="file" name="icon_image_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Icon image 2</label>
                                                       <input type="file" name="icon_image_2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Icon image 3</label>
                                                       <input type="file" name="icon_image_3" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tcon Title 1</label>
                                                       <input type="text" name="icon_title_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tcon Title 2</label>
                                                       <input type="text" name="icon_title_2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tcon Title 2</label>
                                                       <input type="text" name="icon_title_2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Icon Text 3</label>
                                                       <input type="text" name="icon_text_3" class="form-control">
                                                    </div>
                                                </div>                                
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Section </label>
                                                       <input type="text" name="section_title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bullet heading </label>
                                                       <input type="text" name="bullet_heading" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bullet Text 1 </label>
                                                       <input type="text" name="bullet_text_1" class="form-control">
                                                    </div>
                                                </div>
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bottom Para </label>
                                                       <input type="text" name="bottam_para_1" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bullet Text 2 </label>
                                                       <input type="text" name="bullet_text_2" class="form-control">
                                                    </div>
                                                </div>
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bottom Para 2 </label>
                                                       <input type="text" name="bottam_para_2" class="form-control">
                                                    </div>
                                                </div> 
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bullet Text 3 </label>
                                                       <input type="text" name="bullet_text_3" class="form-control">
                                                    </div>
                                                </div>
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bottom Para 3</label>
                                                       <input type="text" name="bottam_para_3" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Copyright Text </label>
                                                       <input type="text" name="copyright_text" class="form-control">
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
                                <th>Section No </th>      
                                <th>Section Name </th>      

                                <th>Page Title</th>   
                                                         
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                            @if ($sections)
                            <?php $count =1;?>
                            @foreach($sections as $val)
                                <tr>
                                <td>{{ $count++ }}</td>
                                    <td>{{ $val->page->page_name }}</td>

                                    <td>
                                        <button type="button" data-toggle="modal" href='#edit-secssss1-{{$val->id}}'
                                            class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <div class="modal fade" id="edit-secssss1-{{$val->id}}" style="padding: 0px 0px;">
                                            <div class="modal-dialog modal-lg">
                                                <form method="post" action="{{ route('sections.update', $val->id) }}"
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
                                                                            <label>Page Title </label>
                                                                            <select name="page_id" class="form-control" required>
                                                                                @foreach($pages as $page)
                                                                                <option value="{{$page->id}}" @if($page->id == $val->page_id) selected @endif>{{$page->page_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Section Name </label>
                                                                            <select  name="section_name"  class="form-control" required>
                                                                                <option value="slider" @if($val->section_name == 'slider')selected @endif>Slider Section</option>
                                                                                <option value="video"@if($val->section_name == 'video')selected @endif>Video Section</option>
                                                                                <option value="middel"@if($val->section_name == 'middel')selected @endif>Middel Section</option>
                                                                                <option value="bottom"@if($val->section_name == 'bottom')selected @endif>Bottom Section</option>
                                                                                <option value="footer"@if($val->section_name == 'footer')selected @endif>Footer Section</option>
                                                                            </select>                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Logo </label>
                                                                        <input type="file" name="logo" class="form-control" >
                                                                        @if($val->logo)
                                                                        <img src="{{asset('uploads/home/'.$val->logo)}}"  class="form-control">
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Slider Image </label>
                                                                        <input type="file" name="slider_image" class="form-control">
                                                                        @if($val->slider_image)
                                                                        <img src="{{asset('uploads/home/'.$val->slider_image)}}"  class="form-control">
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Right image </label>
                                                                        <input type="file" name="right_image" class="form-control">
                                                                        @if($val->right_image)
                                                                        <img src="{{asset('uploads/home/'.$val->right_image)}}"  class="form-control">
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Left iamge </label>
                                                                        <input type="file" name="left_image" class="form-control">
                                                                        @if($val->left_image)
                                                                        <img src="{{asset('uploads/home/'.$val->left_image)}}"  class="form-control">
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Slider content 1 </label>
                                                                        <input type="text" name="slider_content_1" class="form-control"  value="{{$val->slider_content_1}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Slider content 2 </label>
                                                                        <input type="text" name="slider_content_2" class="form-control" value="{{$val->slider_content_2}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Video Url </label>
                                                                        <input type="text" name="video_url" class="form-control" value="{{$val->video_url}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon image 1 </label>
                                                                        <input type="file" name="icon_image_1" class="form-control">
                                                                        @if($val->icon_image_1)
                                                                        <img src="{{asset('uploads/home/'.$val->icon_image_1)}}"  class="form-control">
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon image 2 </label>
                                                                        <input type="file" name="icon_image_2" class="form-control">
                                                                        @if($val->icon_image_1)
                                                                        <img src="{{asset('uploads/home/'.$val->icon_image_1)}}"  class="form-control">
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon image 3</label>
                                                                        <input type="file" name="icon_image_3" class="form-control">
                                                                        @if($val->icon_image_3)
                                                                        <img src="{{asset('uploads/home/'.$val->icon_image_3)}}"  class="form-control">
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Tcon Title 1</label>
                                                                        <input type="text" name="icon_title_1" class="form-control" value="{{$val->icon_title_1}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Tcon Title 2</label>
                                                                        <input type="text" name="icon_title_2" class="form-control" value="{{$val->icon_title_2}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Tcon Title 3</label>
                                                                        <input type="text" name="icon_title_3" class="form-control" value="{{$val->icon_title_3}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Text 1</label>
                                                                        <input type="text" name="icon_text_1" class="form-control" value="{{$val->icon_text_1}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Text 2</label>
                                                                        <input type="text" name="icon_text_2" class="form-control" value="{{$val->icon_text_2}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Text 3</label>
                                                                        <input type="text" name="icon_text_3" class="form-control" value="{{$val->icon_text_3}}">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Section </label>
                                                                        <input type="text" name="section_title" class="form-control" value="{{$val->section_title}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Bullet heading </label>
                                                                        <input type="text" name="bullet_heading" class="form-control" value="{{$val->bullet_heading}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Bullet Text </label>
                                                                        <input type="text" name="bullet_text" class="form-control" value="{{$val->bullet_text}}">
                                                                        </div>
                                                                    </div>
                                                                        <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Bottom Para </label>
                                                                        <input type="text" name="bottam_para" class="form-control" value="{{$val->bottam_para}}">
                                                                        </div>
                                                                    </div>    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Copyright Text </label>
                                                                        <input type="text" name="copyright_text" class="form-control" value="{{$val->copyright_text}}">
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
                                        <form method="post" action="{{ route('sections.destroy', $val->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete This..??')" class="btn btn-default generalsetting_admin"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                             @endforeach   
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
