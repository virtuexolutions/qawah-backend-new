@extends('layouts.default')

@section('title')
Admin | Edit Package
@endsection
@section('content')


<div class="card card-primary card-outline">
          <div class="card-header">
           
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Package Add Details to Package Page
            </h3>
            <!-- <a href="{{url('admin/add-content')}}">
             <div style="text-align: right;"><button class="btn btn-primary">Add Content</button></div>
            </a> -->

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
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Home Page </a>
              </li>
             
            </ul>

           <br>

            <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Package Content</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form action="{{route('package.update',['id' => $package->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$package->id}}" /> 
               <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Title</label>
                    <input type="text" class="form-control" value="{{($package->title) ?:''}}" name="title" id="exampleInputPassword1"
                      placeholder="Title">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Catogery</label>
                    <select id="packages" class="form-control" name="catogery_id">
                      <option>Select Package Head</option>
                      @foreach($pc as $pc_row)
                      <option value="{{ $pc_row->id }}" {{($package->catogery_id == $pc_row->id ) ?'selected':''}} data-slug="{{$pc_row->slug}}">{{ $pc_row->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6" id="">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="text" class="form-control"  value="{{($package->price) ?:0}}"  name="price" placeholder="Price">
                  </div>
                </div>
                <div class="col-md-6" id="Duration">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Duration</label>
                    <!-- <input type="text" class="form-control" required name="duration"  placeholder="Duration"> -->
                    <select class="form-control"  name="duration">
                      <option>Select Duaration</option>
                      <option value="1"  {{( $package->duration == "1") ?'selected':''}}>1 month</option>
                      <option value="2" {{( $package->duration == "2") ?'selected':''}}>2 month</option>
                      <option value="3" {{($package->duration == "3" ) ?'selected':''}}>3 month</option>
                      <option value="4"{{( $package->duration == "4") ?'selected':''}}>4 month</option>
                      <option value="5"{{($package->duration == "5" ) ?'selected':''}}>5 month</option>
                      <option value="6"{{( $package->duration == "6" ) ?'selected':''}}>6 month</option>
                      <option value="7"{{( $package->duration == "7" ) ?'selected':''}}>7 month</option>
                      <option value="8"{{($package->duration == "8" ) ?'selected':''}}>8 month</option>
                      <option value="9"{{( $package->duration == "9") ?'selected':''}}>9 month</option>
                      <option value="10"{{($package->duration == "10" ) ?'selected':''}}>10 month</option>
                      <option value="11"{{( $package->duration == "11" ) ?'selected':''}}>11 month</option>
                      <option value="12"{{($package->duration == "12") ?'selected':''}}>1 year</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6" id="premium_options">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Options</label>
                    <select class="form-control" id="" name="type">
                      <option>Select Permimum Options</option>
                      <option value="spotlight"  {{( $package->type == "spotlight") ?'selected':''}}>Spotlight</option>
                      <option value="love-notes" {{( $package->type =="love-notes") ?'selected':''}}>Love Notes</option>
                      <option value="discrete-mode" {{($package->type == "discrete-mode" ) ?'selected':''}}>Discrete Mode</option>
                    </select>
                  </div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-md-6" id="spotlights">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Spotlights</label>
                    <input type="number" class="form-control" value="{{($package->spotlights) ?:0}}" name="spotlights" value="0"
                      placeholder="spotlights">
                  </div>
                </div>
                <div class="col-md-6" id="lovenotes">
                  <div class="form-group">
                    <label for="exampleInputPassword1">love Notes</label>
                    <input type="number" class="form-control" value="{{($package->lovenotes) ?:0}}"  name="lovenotes" value="0"
                      placeholder="spotlights">
                  </div>
                </div>
              </div>
              @php
              if(!empty(json_decode($package->options))){
                 $options;
                foreach(json_decode($package->options) as $opt)
                {
                  $options[$opt] =$opt; 
                }
              }
              @endphp
              
              <div class="form-group" id="add_on">
                <h3>Allow Options</h3>
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input" name="options[]"  type="checkbox" id="inlineCheckbox1" value="fancy"
                    {{(isset($options['fancy'])=='fancy')?'checked':''}}
                  >
                  <label class="form-check-label" for="inlineCheckbox1">Fancy</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox2" value="sojourn" 
                  {{(isset($options['sojourn'])=='sojourn')?'checked':''}}>
                  <label class="form-check-label" for="inlineCheckbox2">Sojourn</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox3"
                    value="prestige" {{(isset($options['prestige'])=='prestige')?'checked':''}}>
                  <label class="form-check-label" for="inlineCheckbox3">Prestige</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox4"
                    value="super-fancy" {{(isset($options['super-fancy'])=='super-fancy')?'checked':''}}>
                  <label class="form-check-label" for="inlineCheckbox4">Super Fancy</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox5"
                    value="exclusive" {{(isset($options['exclusive'])=='exclusive')?'checked':''}}>
                  <label class="form-check-label" for="inlineCheckbox5">Exclusive</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox6"
                    value="discrete-mode" {{(isset($options['discrete-mode'])=='discrete-mode')?'checked':''}}>
                  <label class="form-check-label" for="inlineCheckbox6">Discrete Mode</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox7"
                    value="say-what" {{(isset($options['say-what'])=='say-what')?'checked':''}}>
                  <label class="form-check-label" for="inlineCheckbox7">Say What?</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox8"
                    value="read-receipts" {{(isset($options['read-receipts'])=='read-receipts')?'checked':''}}>
                  <label class="form-check-label" for="inlineCheckbox8">Read Receipts</label>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea class="ckeditor"  name="description">{{($package->description) ?:''}}</textarea>
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
<script>
  $(document).ready(function () {
    $('#add_on').hide();
    $('#premium_options').hide();
    $('#spotlights').hide();
    $('#lovenotes').hide();
    $('#Duration').hide();
   

    $('#packages').on('change', function () {

      var selected = $('option:selected', this).attr('data-slug');
      if (selected === "platinum") {
        $('#add_on').hide();
        $('#spotlights').show();
        $('#lovenotes').show();
        $('#add_on').show();
        $('#Duration').show();
      }
      else if(selected === "gold")
      {
        $('#spotlights').hide();
        $('#lovenotes').hide();
        $('#premium_options').hide();
        $('#add_on').show();
        $('#Duration').show();
      }
      else if(selected === "premium")
      {
        $('#add_on').hide();
        $('#premium_options').show();
        $('#spotlights').hide();
        $('#lovenotes').hide();
        $('#Duration').hide();
      }
      else if(selected === "month_to_month")
      {
        $('#add_on').show();
        $('#spotlights').show();
        $('#lovenotes').show();
        $('#Duration').show();
      }
      else {
        $('#spotlights').hide();
        $('#lovenotes').hide();
        $('#add_on').hide();
        $('#Duration').hide();
      }
    });
    $('#premium_options select').on("change", function () {
       var selected = $(this).val();
      if (selected === "spotlight") {
        $('#spotlights').show();
        $('#lovenotes').hide();
      }
      else if(selected === "love-notes")
      {
        $('#spotlights').hide();
        $('#lovenotes').show();
      }
      else if(selected === "discrete-mode")
      {
        $('#add_on').show();
        $('#spotlights').hide();  
        $('#lovenotes').hide();
        $("#add_on #inlineCheckbox6").prop("checked",true);
        $("#add_on input:checkbox").not(":checked").parent().hide();
      }
    })
     $('#packages').trigger('change');
    $('#premium_options select').trigger('change');
  });
</script>
@endsection
