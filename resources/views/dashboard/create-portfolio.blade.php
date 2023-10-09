@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Portfolio</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">New Portfolio</li>
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
                    <!-- left column -->
                    <div class="col">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create New Portfolio</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('portfolio.store')}}" enctype="multipart/form-data">
                                <div class="card-body">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                    <div class="form-group">
                                        <label for="PortfolioTitle">Portfolio Title</label>
                                        <input type="text" name="title" class="form-control" id="PortfolioTitle" placeholder="Portfolio title">
                                    </div>
                                    <div class="form-group">
                                        <label for="portfolioSlug">Portfolio Slug</label>
                                        <input type="text" name="slug" class="form-control" id="portfolioSlug" placeholder="Portfolio slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Portfolio Category</label>
                                        <select name="category" class="form-control" id="category">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="portfolioDesc">Portfolio Description</label>
                                        <textarea rows="8" name="description" class="form-control" id="portfolioDesc" placeholder="Write portfolio descripton here..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="thumbnailImage">Portfolio Thumbnail</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="thumbnail" type="file" class="custom-file-input" id="thumbnailImage">
                                                <label class="custom-file-label" for="thumbnailImage">Choose file</label>
                                            </div>
{{--                                            <div class="input-group-append">--}}
{{--                                                <span class="input-group-text">Upload</span>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="portfolioLink">Portfolio Link (Optional)</label>
                                        <input type="text" name="link" class="form-control" id="portfolioLink" placeholder="https://">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create New</button>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col-->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
