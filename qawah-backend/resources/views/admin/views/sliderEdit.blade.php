@extends('admin.views.layouts.default')
@section('title')
Admin | Add Home Slider
@endsection
@section('content')
<style>
  .close_button {
    position: absolute;
    right: 15px;
    color: red;
    cursor: pointer;
}
</style>
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
             <form method="POST" action="{{ route("slider.update",["slider"=>$slider->id]) }}" enctype="multipart/form-data">
              @csrf
              @method("PUT")
               <div clas="row">
                 <div class="col-md-12">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Banner Image</label>
                    <input class="form-control" name="banner_image" type="file" id="formFile">
                  </div>
                </div>
                <div class="col-md-12">
                    <img src="{{ $slider->banner_image }}" class="img-thumbnail w-50"/>
                    <input name="old_banner_image" type="hidden" value="{{ $slider->banner_image }}"  />
                </div>
               </div>
                <div class="mb-3">
                  <label for="" class="form-label">Greeting Text</label>
                  <input type="text" name="greeting_text" value="{{$slider->greeting_text}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Heading</label>
                  <input type="text" name="heading" id="" value="{{$slider->heading}}" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Sub text</label>
                  <input type="text" name="sub_text" value="{{$slider->sub_text}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Button Url</label>
                  <textarea type="url" name="button_url" id="" class="form-control" placeholder="" aria-describedby="helpId">{{$slider->button_url}}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Swiper images</label>
                        <input class="form-control" name="swiper_images[]"  type="file" id="formFileMultiple" multiple>
                      </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                          @php  $swiper_image = json_decode($slider->swiper_images) @endphp
                          @foreach($swiper_image as $k => $si)
                          <div class="col-md-4">
                            <img src="{{$si}}" class="img-thumbnail"/>
                            <a href="{{ route('slider.delete_image',["slider"=>$slider->id,"photokey"=> $k]) }}" class="close_button">
                               <i class="fa fa-window-close" aria-hidden="true"></i>
                            </a>
                            <input name="old_swiper_images[]" type="hidden" value="{{ $si }}"  />
                          </div>
                          @endforeach
                        </div>
                    </div>
                </div>
                 
                <div class="mb-3 mt-5">
                  <button class="btn btn-default btn-lg">Submit</button>
                </div>
             </form>
          </div>
        </div>
    </div>

@endsection
