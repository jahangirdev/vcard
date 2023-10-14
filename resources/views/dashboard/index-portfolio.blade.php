@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Portfolios</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Portfolios</li>
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
                            <!-- /card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Portfolio Title</th>
                                        <th>Category</th>
                                        @if(Auth::user()->role < 3 )<th>Assigned To</th>@endif
                                        <th>Thumbnail</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $portfolios as $portfolio)
                                        <tr>
                                            <td>{{$portfolio->title}}</td>
                                            <td>{{$portfolio->getCategory->name}}</td>
                                            @if(Auth::user()->role < 3)
                                                @php
                                                $company = $getCompany($portfolio->staff->company);
                                                @endphp
                                                <td>@if(Auth::user()->role == 1 && $company != null ){{$company->name}} => @endif{{$portfolio->staff->name}}</td>
                                            @endif
                                            <td><img style="max-width:100%; max-height: 50px" src="{{asset($portfolio->thumbnail)}}" alt="Thumbnail"></td>
                                            <td>
                                                <a href="{{route('portfolio.edit',$portfolio->id)}}" class="btn btn-success">Edit</a>
                                                <form method="post" action="{{route('portfolio.destroy', $portfolio->id)}}" id="delete-form-{{ $portfolio->id }}" style="display:none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="confirmDelete({{ $portfolio->id }})" type="submit" class="btn btn-danger">Delete</button>
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
