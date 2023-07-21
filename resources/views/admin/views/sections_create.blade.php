
@extends('admin.views.layouts.default')
@section('title')
  Admin | Cms sections
@endsection

@section('content')

<link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">
  <form action="{{ route('sections.store') }}" enctype="multipart/form-data"
                                    id="form" method="post">
                                    @csrf
                                    <div class="card card-warning">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Page Title </label>
                                                        <select name="page_id" class="form-control" required>
                                                            @foreach($pages as $page)
                                                            <option value="{{$page->id}}">{{$page->page_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Section Name </label>
                                                    <input name="section_name" class="form-control"/>
                                                </div>
                                            </div>
                                            
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Logo </label>
                                                       <input type="file" name="logo" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Slider Image </label>
                                                       <input type="file" name="slider_image" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Right image </label>
                                                       <input type="file" name="right_image" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Left iamge </label>
                                                       <input type="file" name="left_image" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Slider content 1 </label>
                                                       <input type="text" name="slider_content_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Slider content 2 </label>
                                                       <input type="text" name="slider_content_2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Video Url </label>
                                                       <input type="text" name="video_url" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon image 1</label>
                                                       <input type="file" name="icon_image_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon image 2</label>
                                                       <input type="file" name="icon_image_2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon image 3</label>
                                                       <input type="file" name="icon_image_3" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon Title 1</label>
                                                       <input type="text" name="icon_title_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon Title 2</label>
                                                       <input type="text" name="icon_title_2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon Title 3</label>
                                                       <input type="text" name="icon_title_3" class="form-control">
                                                    </div>
                                                </div>
												  <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon Text 1</label>
                                                       <input type="text" name="icon_text_1" class="form-control">
                                                    </div>
                                                </div>   
												  <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon Text 2</label>
                                                       <input type="text" name="icon_text_2" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Icon Text 3</label>
                                                       <input type="text" name="icon_text_3" class="form-control">
                                                    </div>
                                                </div>                                
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Section </label>
                                                       <input type="text" name="section_title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Bullet Heading 1 </label>
                                                       <input type="text" name="bullet_heading_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Bullet Text 1 </label>
                                                       <input type="text" name="bullet_text_1" class="form-control">
                                                    </div>
                                                </div>
                                                    <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Bullet Heading 2 </label>
                                                       <input type="text" name="bullet_heading_2" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Bullet Text 2 </label>
                                                       <input type="text" name="bullet_text_2" class="form-control">
                                                    </div>
                                                </div>
                                                    <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Bullet Heading 3</label>
                                                       <input type="text" name="bullet_heading_3" class="form-control">
                                                    </div>
                                                </div> 
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Bullet Text 3 </label>
                                                       <input type="text" name="bullet_text_3" class="form-control">
                                                    </div>
                                                </div>
                                                    <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Bottom Para</label>
                                                       <input type="text" name="bottam_para" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Copyright Text </label>
                                                       <input type="text" name="copyright_text" class="form-control">
                                                    </div>
                                                </div>     
												   <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Page Description</label>
														<textarea name="description" class="form-control summernoteee"></textarea>

                                                    </div>
                                                </div> 
                                              
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-default"
                                           href="{{route('sections.index')}}">Close</a>
                                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>

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