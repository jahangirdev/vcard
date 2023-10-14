@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Testimonials</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Testimonials</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom:0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif(session('notice'))
                    <div class="alert alert-{{session('notice')['type']}}">
                        {{session('notice')['message']}}
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">Portfolio Categories</h3>--}}

{{--                                <div class="card-tools">--}}
{{--                                    <div class="input-group input-group-sm" style="width: 150px;">--}}
{{--                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">--}}

{{--                                        <div class="input-group-append">--}}
{{--                                            <button type="submit" class="btn btn-default">--}}
{{--                                                <i class="fas fa-search"></i>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        @if(Auth::user()->role < 3 )<th>Assigned To</th>@endif
                                        <th>Comment</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $testimonials as $testimonial)
                                        <tr>
                                            <td>{{$testimonial->name}}</td>
                                            <td>{{$testimonial->designation}}</td>
                                            @if(Auth::user()->role < 3)
                                            <td>@if(Auth::user()->role == 1 && $getCompany($testimonial->staff->company) != null ){{$getCompany($testimonial->staff->company)->name}} => @endif{{$testimonial->staff->name}}</td>
                                            @endif
                                            <td><p>{{Str::limit($testimonial->comment, 30)}}</p></td>
                                            <td><img style="max-width:100%; max-height: 50px" src="{{asset($testimonial->image)}}" alt="Thumbnail"></td>
                                            <td>
                                                <a href="{{route('testimonial.edit',$testimonial->id)}}" class="btn btn-success">Edit</a>
                                                <form method="post" action="{{route('testimonial.destroy', $testimonial->id)}}" id="delete-form-{{ $testimonial->id }}" style="display:none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="confirmDelete({{ $testimonial->id }})" type="submit" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this portfolio?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
