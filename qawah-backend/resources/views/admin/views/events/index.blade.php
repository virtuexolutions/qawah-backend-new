@extends('admin.views.layouts.default')
@section('title')
  Admin | Cms Pages
@endsection

@section('content')

<link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">





        <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Event Info</h3><br>          
  

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Event Title</th>
                                <th>Event Link</th>
								<th>Start On</th>
								<th>End On</th>
							    <th>Event created by</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                            @if ($events)
                            @foreach($events as $val)
                                <tr>
                                    <td>{{ $val->title }}</td>
                                    <td>{{ $val->link }}</td>
                                    <td>{{ $val->date }}</td>
                                    <td>{{ $val->end_date }}</td>
                                    <td>{{ $val->user->email }}</td>
									<td>
							<div class="dropdown show">
							  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								@if($val->status == '0')
								 Removed
								@elseif($val->status == '1')
								  Approved
								@elseif($val->status == '2')
								  Pending
								@endif
							  </a>

							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{route('event_stu',['id'=>$val->id,'status'=>1])}}">Approve</a>
								 <a class="dropdown-item" href="{{route('event_stu',['id'=>$val->id,'status'=>2])}}">Pending</a>
								 <a class="dropdown-item" href="{{route('event_stu',['id'=>$val->id,'status'=>0])}}">Remove</a>
							
							  </div>
							</div>
									</td>
                                    <td>
                                        <button type="button" data-toggle="modal" href='#edit-secssss1-{{$val->id}}'
                                            class="btn btn-default"><i class="fa fa-eye"></i></button>
                                        <div class="modal fade" id="edit-secssss1-{{$val->id}}" style="padding: 0px 0px;">
                                            <div class="modal-dialog modal-lg">                                         
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
                                                                        <label>Event Title </label>
                                                                        <input class="form-control" readonly=""
                                                                            value="{{ $val->title }}" />
                                                                    </div>
                                                                </div>
																 <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Event link </label>
                                                                        <input class="form-control" readonly=""
                                                                            value="{{ $val->link }}"  />
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                	 <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Start On </label>
                                                                        <input class="form-control" readonly=""
                                                                            value="{{ $val->date }}"  />
                                                                    </div>
                                                                </div> 
                                                                	 <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>End On </label>
                                                                        <input class="form-control" readonly=""
                                                                            value="{{ $val->end_date }}"  />
                                                                    </div>
                                                                </div> 																
																<div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Status </label>
																		@if($val->status == '0')
																		   <input class="form-control" readonly=""
                                                                            value="Removed"  />
																			@elseif($val->status == '1')
																		   <input class="form-control" readonly=""
                                                                            value="Approved"  />
																			@else
																		   <input class="form-control" readonly=""
                                                                            value="Pending"  />
																			@endif
                                                                     
                                                                    </div>
                                                                </div> 
																<div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Event Date </label>
																		<textarea disabled class="form-control">{{$val->description}}</textarea>
                                                                    </div>
                                                                </div> 
                                                                @if(!empty($val->url))
                                                                 <div class="col-sm-6">
                                                                    <div class="form-group">
																		<img src="{{asset($val->url)}}" style="width:100%;height:120px;">                                                                       
                                                                    </div>
                                                                </div> 
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                               
                                            </div>
                                        </div>
                                       {{-- <form method="post" action="{{ route('pages.destroy', $val->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete This..??')" class="btn btn-default generalsetting_admin"><i class="fas fa-trash-alt"></i></button>
                                        </form> --}}
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
