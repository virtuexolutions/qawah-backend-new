@extends('admin.views.layouts.default')
@section('title')
  Admin | FAQ's
@endsection

@section('content')

<link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">





        <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Page Info</h3><br>
                    <button type="button" data-toggle="modal" href='#sec111-id' class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i></button>
                <div class="modal fade" id="sec111-id">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('faqs.store') }}" enctype="multipart/form-data"
                                    id="form" method="post">
                                    @csrf
                                    <div class="card card-warning">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Question</label>
														<input  class="form-control" required="" name="question" >

                                                    </div>
                                                </div>
												   <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Answer</label>
													<input class="form-control" required="" name="answer" >

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
                                <th>Question</th>   
								<th>Answer</th>                               

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                            @if ($faqs)
                            @foreach($faqs as $val)
                                <tr>
                                    <td>{{ $val->question }}</td>
                                    <td>{{ $val->answer }}</td>

                                    <td>
                                        <button type="button" data-toggle="modal" href='#edit-secss11-{{$val->id}}'
                                            class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <div class="modal fade" id="edit-secss11-{{$val->id}}" style="padding: 0px 0px;">
                                            <div class="modal-dialog modal-lg">
                                                <form method="post" action="{{ route('faqs.update', $val->id) }}"
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
                                                                        <label>Question</label>
														<input class="form-control" required=""
                                                                            value="{{ $val->question }}" name="question">

                                                                    </div>
                                                                </div>    
															    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Answer</label>	
															<input class="form-control" required=""value="{{ $val->answer }}" name="answer">

                                                                       
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
                                       {{-- <form method="post" action="{{ route('faqs.destroy', $val->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete This..??')" class="btn btn-default generalsetting_admin"><i class="fas fa-trash-alt"></i></button>
                                        </form>  --}}
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
