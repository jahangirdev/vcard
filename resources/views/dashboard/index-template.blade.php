@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Templates</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Templates</li>
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
                            <div class="card-body table-responsive">
                                <div class="row">
                                    @foreach($templates as $template)
                                    <div class="col-md-4">
                                        <div class="card" style="opacity:{{$template->status == 0 ? 0.5 : 1}}">
                                            <img class="card-img-top" src="{{asset($template->thumbnail)}}" alt="Card image cap">
                                            <div class="card-body d-flex justify-content-center">
                                                <h4 class="card-title">{{$template->name}}{{$template->status == 2 ? ' (Default)': ''}}</h4>
                                            </div>
                                            <div class="card-footer text-center">
                                                @if($template->status != 2)
                                                    <a href="{{$template->status ? route('template.disable', $template->id) : route('template.enable', $template->id)}}" class="btn btn-{{$template->status ? 'danger': 'success'}}">{{$template->status ? 'Disable': 'Enable'}}</a>
                                                @endif
                                                @if($template->status == 1)
                                                        <a href="{{route('template.default', $template->id)}}" class="btn btn-primary">Set As Default</a>
                                                @endif
                                                <a href="{{route('template.preview', $template->id)}}" target="_blank" class="btn btn-info">Preview</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
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
