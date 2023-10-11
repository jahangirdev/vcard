@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Staffs</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Staffs</li>
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
                                        <th>Staff Name</th>
                                        <th>Company</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $staffs as $staff)
                                        <tr>
                                            <td>{{$staff->name}}</td>
                                            <td>{{$getCompany($staff->company)->name}}</td>
                                            <td>
                                                <a href="{{route('portfolio_category.edit',$staff->id)}}" class="btn btn-success">Edit Profile</a>
                                                <form method="post" action="{{route('company.destroy', $staff->id)}}" id="delete-form-{{ $staff->id }}" style="display:none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="confirmDelete({{ $staff->id }})" type="submit" class="btn btn-danger">Delete</button>
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
            if (confirm("Are you sure you want to delete this staff?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
