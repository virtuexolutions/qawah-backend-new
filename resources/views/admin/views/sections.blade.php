@extends('admin.views.layouts.default')
@section('title')
  Admin | Cms sections
@endsection

@section('content')

<link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">
        <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Sections Info</h3><br>
                    {{-- <button type="button" onclick="window.location.href='{{route('sections.create')}}'" class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i></button> --}}
       

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Section No </th>      
                         
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
                                        <a href="{{route('sections.edit',$val->id)}}"
                                            class="btn btn-default"><i class="fa fa-edit"></i></a>
                              
                             
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
