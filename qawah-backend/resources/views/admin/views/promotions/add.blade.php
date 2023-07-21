@extends('admin.views.layouts.default')

@section('title')
Admin | Add Package
@endsection
@section('content')


<div class="card card-primary card-outline">
  <div class="card-header">

    <h3 class="card-title">
      <i class="fas fa-edit"></i>
      Package Add Details to Package Page
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
          aria-selected="true">Package Page </a>
      </li>
    </ul>
    <br>
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Promotion Package </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{route('promotions.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Title</label>
                    <input type="text" class="form-control"  name="title" id="exampleInputPassword1"
                      placeholder="Title">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Catogery</label>
                    <select id="packages" class="form-control" name="catogery_id">
                      <option>Select Package Head</option>
                      @foreach($pc as $pc_row)
                      <option value="{{ $pc_row->id }}" data-slug="{{$pc_row->slug}}">{{ $pc_row->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6" id="">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="text" class="form-control"  name="price" placeholder="Price">
                  </div>
                </div>
                <div class="col-md-6" id="Duration">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Duration</label>
 <input type="number" class="form-control"  name="duration" min="1" minlength="1" max="365" maxlength="365" placeholder="Duration">
					  {{-- <select class="form-control"  name="duration">
                      <option></option>
                      <option value="1">1 month</option>
                      <option value="2">2 month</option>
                      <option value="3">3 month</option>
                      <option value="4">4 month</option>
                      <option value="5">5 month</option>
                      <option value="6">6 month</option>
                      <option value="7">7 month</option>
                      <option value="8">8 month</option>
                      <option value="9">9 month</option>
                      <option value="10">10 month</option>
                      <option value="11">11 month</option>
                      <option value="12">1 year</option>
                    </select>--}}
                  </div>
                </div>
                <div class="col-md-6" id="premium_options">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Options</label>
                    <select class="form-control" id="" name="type">
                      <option value="">Select Permimum Options</option>
                      <option value="spotlight">Spotlight</option>
                      <option value="love-notes">Love Notes</option>
                      <option value="discrete-mode">Discrete Mode</option>
                    </select>
                  </div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-md-6" id="spotlights">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Spotlights</label>
                    <input type="number" class="form-control"  name="spotlights" value="0"
                      placeholder="spotlights">
                  </div>
                </div>
                {{-- <div class="col-md-6" id="lovenotes">
                  <div class="form-group">
                    <label for="exampleInputPassword1">love Notes</label>
                    <input type="number" class="form-control"  name="lovenotes" value="0"
                      placeholder="spotlights">
                  </div>
                </div> --}}
              </div>
              <div class="form-group" id="add_on">
                <h3>Allow Options</h3>
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox1" value="fancy">
                  <label class="form-check-label" for="inlineCheckbox1">Fancy</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox2" value="sojourn">
                  <label class="form-check-label" for="inlineCheckbox2">Sojourn</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox3"
                    value="prestige">
                  <label class="form-check-label" for="inlineCheckbox3">Prestige</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox4"
                    value="super-fancy">
                  <label class="form-check-label" for="inlineCheckbox4">Super Fancy</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox5"
                    value="exclusive">
                  <label class="form-check-label" for="inlineCheckbox5">Exclusive</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox6"
                    value="discrete-mode">
                  <label class="form-check-label" for="inlineCheckbox6">Discrete Mode</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox7"
                    value="say-what">
                  <label class="form-check-label" for="inlineCheckbox7">Say What?</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox8"
                    value="read-receipts">
                  <label class="form-check-label" for="inlineCheckbox8">Read Receipts</label>
                </div>
			   <div class="form-check form-check-inline">
                  <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox9"
                    value="lovenotes">
                  <label class="form-check-label" for="inlineCheckbox9">Love Notes</label>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea class="summernoteee"  name="description"></textarea>
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
        $('#lovenotes').hide();
		 $('#add_on').show();
        $('#spotlights').hide();  
        $("#add_on #inlineCheckbox9").prop("checked",true);
        $("#add_on input:checkbox").not(":checked").parent().hide();
      }
      else if(selected === "discrete-mode")
      {
        $('#add_on').show();
        $('#spotlights').hide();  
        $('#lovenotes').hide();
        $("#add_on #inlineCheckbox6").prop("checked",true);
        $("#add_on input:checkbox").not(":checked").parent().hide();
      }else{
		  $('#add_on').hide();
        $('#spotlights').hide();  
        $('#lovenotes').hide(); 
	  }
    })
  });
</script>
@endsection