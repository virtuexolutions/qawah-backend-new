
@extends('admin.views.layouts.default')
@section('title')
  Admin | Cms sections
@endsection

@section('content')

<link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">
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
                                                             <input type="hidden" name="page_id" value="{{$val->page_id}}">
                                                             <input type="hidden" name="section_name" value="{{$val->section_name}}">

                                                                    {{--<div class="col-sm-6">
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
																				                                                           <option value="popup" @if($val->section_name == 'popup')selected @endif>PopUp Modal</option>

                                                                            <option value="bottom"@if($val->section_name == 'bottom')selected @endif>Bottom Section</option>
                                                                                <option value="footer"@if($val->section_name == 'footer')selected @endif>Footer Section</option>
                                                                            </select>                                                                        </div>
                                                                    </div>--}}
                                                                    @if($val->logo)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Logo </label>
                                                                        <input type="file" name="logo" class="form-control" >
                                                                       
                                                                        <img src="{{asset($val->logo)}}" width="100px" height="60px" >
                                                                      
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                   @if($val->slider_image)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Slider Image </label>
                                                                        <input type="file" name="slider_image" class="form-control">
                                                                       
                                                                        <img src="{{asset($val->slider_image)}}"  width="100px" height="60px" >
                                                                       
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->right_image)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Right image </label>
                                                                        <input type="file" name="right_image" class="form-control">
                                                                      
                                                                        <img src="{{asset($val->right_image)}}"  width="100px" height="60px">
                                                                     
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->left_image)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Left iamge </label>
                                                                        <input type="file" name="left_image" class="form-control">
                                                                       
                                                                        <img src="{{asset($val->left_image)}}"  width="100px" height="60px">
                                                                       
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->slider_content_1)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Slider content 1 </label>
                                                                        <input type="text" name="slider_content_1" class="form-control"  value="{{$val->slider_content_1}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->slider_content_2)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Slider content 2 </label>
                                                                        <input type="text" name="slider_content_2" class="form-control" value="{{$val->slider_content_2}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->video_url)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Video Url </label>
                                                                        <input type="text" name="video_url" class="form-control" value="{{$val->video_url}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_image_1)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon image 1 </label>
                                                                        <input type="file" name="icon_image_1" class="form-control">                                                                       
                                                                        @if($val->icon_image_1)
                                                                        <img src="{{asset($val->icon_image_1)}}"  width="100px" height="60px" >                                                                      
                                                                          @endif
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_image_2)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon image 2 </label>
                                                                        <input type="file" name="icon_image_2" class="form-control">
                                                                        @if($val->icon_image_2)
                                                                        <img src="{{asset($val->icon_image_2)}}"  width="100px" height="60px" >
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_image_3)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon image 3</label>
                                                                        <input type="file" name="icon_image_3" class="form-control">
                                                                        @if($val->icon_image_3)
                                                                        <img src="{{asset($val->icon_image_3)}}"  width="100px" height="60px" >
                                                                      @endif
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_title_1)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Title 1</label>
                                                                        <input type="text" name="icon_title_1" class="form-control" value="{{$val->icon_title_1}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_title_2)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Title 2</label>
                                                                        <input type="text" name="icon_title_2" class="form-control" value="{{$val->icon_title_2}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_title_3)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Title 3</label>
                                                                        <input type="text" name="icon_title_3" class="form-control" value="{{$val->icon_title_3}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_text_1)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Text 1</label>
                                                                        <input type="text" name="icon_text_1" class="form-control" value="{{$val->icon_text_1}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_text_2)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Text 2</label>
                                                                        <input type="text" name="icon_text_2" class="form-control" value="{{$val->icon_text_2}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->icon_text_3)
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Icon Text 3</label>
                                                                        <input type="text" name="icon_text_3" class="form-control" value="{{$val->icon_text_3}}">
                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                   @if($val->section_title)
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Section </label>
                                                                    <input type="text" name="section_title" value="{{$val->section_title}}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                 @endif
                                                                   @if($val->bullet_heading_1)
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Bullet Heading 1 </label>
                                                                    <input type="text" name="bullet_heading_1" value="{{$val->bullet_heading_1}}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                 @endif
                                                                   @if($val->bullet_text_1)
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Bullet Text 1 </label>
                                                                    <input type="text" name="bullet_text_1"  value="{{$val->bullet_text_1}}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                 @endif
                                                                   @if($val->bullet_heading_2)
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Bullet Heading 2 </label>
                                                                    <input type="text" name="bullet_heading_2" value="{{$val->bullet_heading_2}}" class="form-control">
                                                                    </div>
                                                                </div>   
                                                                 @endif
                                                                   @if($val->bullet_text_2)
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Bullet Text 2 </label>
                                                                    <input type="text" name="bullet_text_2"value="{{$val->bullet_text_2}}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                 @endif
                                                                   @if($val->bullet_heading_3)
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Bullet Heading 3</label>
                                                                    <input type="text" name="bullet_heading_3" value="{{$val->bullet_heading_3}}" class="form-control">
                                                                    </div>
                                                                </div> 
                                                                 @endif
                                                                   @if($val->bullet_text_3)
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Bullet Text 3 </label>
                                                                                <input type="text" name="bullet_text_3" value="{{$val->bullet_text_3}}" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                    @endif
                                                                @if($val->bottam_para)
                                                                            <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label>Bottom Para</label>
                                                                            <input type="text" name="bottam_para" value="{{$val->bottam_para}}" class="form-control">
                                                                            </div>
                                                                        </div>  
                                                                 @endif
                                                                   @if($val->copyright_text)
                                                                        <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Copyright Text </label>
                                                                                <input type="text" name="copyright_text" class="form-control" value="{{$val->copyright_text}}">
                                                                                </div>
                                                                            </div>   
                                                                     @endif
                                                                   @if($val->description)
																   <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Page Description</label>
                                                                        <textarea name="description" class="form-control summernoteee">{{$val->description}}</textarea>
                                                                        </div>
                                                                   </div> 
                                                                    @endif                                                                 
                                                                    </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
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