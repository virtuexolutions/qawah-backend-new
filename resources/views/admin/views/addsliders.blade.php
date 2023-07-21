@extends('admin.views.layouts.default')
@section('title')
Admin | Add Home Slider
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
             <form method="POST" action="{{ route("slider.store") }}" enctype="multipart/form-data">
              @csrf
               <div clas="row">
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Banner Image</label>
                      <input class="form-control" name="banner_image" type="file" id="formFile">
                    </div>
               </div>
                <div class="mb-3">
                  <label for="" class="form-label">Greeting Text</label>
                  <input type="text" name="greeting_text" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Heading</label>
                  <input type="text" name="heading" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Sub text</label>
                  <input type="text" name="sub_text" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Button Url</label>
                  <textarea type="url" name="button_url" id="" class="form-control" placeholder="" aria-describedby="helpId"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Swiper images</label>
                        <input class="form-control" name="swiper_images[]"  type="file" id="formFileMultiple" multiple>
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
