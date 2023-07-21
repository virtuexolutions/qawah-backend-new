@extends('layouts.default')

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
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Package Page </a>
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
              <form action="{{route('package.store')}}" method="post" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Title</label>
                    <input type="text" class="form-control" required="" name="title" id="exampleInputPassword1" placeholder="Title">
                  </div>
                 <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Catogery</label>
                      <select onchange="category(this.value)" class="form-control" name="catogery_id">
                        <option>Select Package Head</option>
                          @foreach($pc as $pc_row)
                            <option value="{{ $pc_row->id }}">{{ $pc_row->title }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Type</label>
                      <select onchange="package_category(this.value)" class="form-control" id="sub_cat_id" name="Type">
                        <!-- @foreach(DB::table('package_sub_category')->get() as $row)
                        <option value="{{$row->title}}">{{$row->title}}</option>
                        @endforeach -->
                      <!-- <option value="platinum">Platinum</option>
                      <option value="spotlight">Spotlight</option>
                      <option value="love-notes">Love Notes</option>
                       <option value="discrete-mode">Discrete Mode</option> -->
                    </select>
                     </div>
                   </div>
                 </div>
                  <div class="row">
                    <div class="col-md-6" id="Duration">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Duration</label>
                        <!-- <input type="text" class="form-control" required name="duration"  placeholder="Duration"> -->
                        <select class="form-control" required name="duration">
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
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6" id="new_price">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="text" class="form-control" required name="price"  placeholder="Price">
                      </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-6" id="spotlights">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Spotlights</label>
                        <input type="number" class="form-control" required name="spotlights" value="0" placeholder="spotlights">
                      </div>
                    </div>
                    <div class="col-md-6" id="lovenotes">
                      <div class="form-group">
                        <label for="exampleInputPassword1">love Notes</label>
                        <input type="number" class="form-control" required name="lovenotes" value="0"  placeholder="spotlights">
                      </div>
                    </div>
                  </div>
                  <div class="form-group" id="quotes">
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
                      <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox3" value="prestige">
                      <label class="form-check-label" for="inlineCheckbox3">Prestige</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox4" value="super-fancy">
                      <label class="form-check-label" for="inlineCheckbox4">Super Fancy</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox5" value="exclusive">
                      <label class="form-check-label" for="inlineCheckbox5">Exclusive</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox6" value="discrete-mode">
                      <label class="form-check-label" for="inlineCheckbox6">Discrete Mode</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox7" value="say-what">
                      <label class="form-check-label" for="inlineCheckbox7">Say What?</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="options[]" type="checkbox" id="inlineCheckbox8" value="read-receipts">
                      <label class="form-check-label" for="inlineCheckbox8">Read Receipts</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea class="ckeditor" required name="description" ></textarea>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // $('#Duration').hide();
    // $('#new_price').hide();
    $('#quotes').hide();
    $('#lovenotes').hide();
    $('#spotlights').hide();
    
    function package_category(category)
    {
      if(category == 'spotlight'){
        $('#spotlights').show();
      }
      else{
        $('#spotlights').hide();
      }
      
      
      if(category == 'love-notes'){
        $('#lovenotes').show();
      }
      else{
        $('#lovenotes').hide();
      }
      
      
      if(category == 'discrete-mode'){
        $('#quotes').show();
      }
      else{
        $('#quotes').hide();
      }

  }

  function category(category)
  {
    $.ajax({
        url: '{{route("fetch_package_category")}}',
        type: 'POST',
        data: { "_token": "{{ csrf_token() }}", id:category},
        success: function (data) { 
          $("#sub_cat_id").empty();
          $("#sub_cat_id").html('<option>select </option>');
          $.each(data.data, function(index, item) {
            $("#sub_cat_id").append('<option value="'+item.title+'">'+item.title+' </option>'); 
          });
   
        }
    }); 
  }
</script>
@endsection
