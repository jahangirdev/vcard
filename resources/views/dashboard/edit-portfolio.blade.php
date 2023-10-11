@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit "{{$portfolio->title}}"</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Portfolio</li>
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
                                <h3 class="card-title">Edit Portfolio</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('portfolio.update', $portfolio->id)}}" enctype="multipart/form-data">
                                <div class="card-body">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label for="PortfolioTitle">Portfolio Title</label>
                                        <input type="text" name="title" class="form-control" id="PortfolioTitle" placeholder="Portfolio title" value="{{$portfolio->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="portfolioSlug">Portfolio Slug</label>
                                        <input type="text" name="slug" class="form-control" id="portfolioSlug" placeholder="Portfolio slug"  value="{{$portfolio->slug}}" onkeyup="slugify(this, this)">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Portfolio Category</label>
                                        <select name="category" class="form-control" id="category">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" @if($category->id == $portfolio->category) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(Auth::user()->role < 3)
                                        <div class="form-group">
                                            <label for="AssignTo">Assign To</label>
                                            <select name="user_id" class="form-control" id="AssignTo">
                                                <option value="{{Auth::user()->id}}"><--Myself--></option>
                                                @foreach($staffs as $staff)
                                                    <option value="{{$staff->id}}" @if($staff->id == old('user_id') || (old('user_id') == null && $portfolio->user_id == $staff->id)) selected @endif> @if($staff->role == 3){{$getCompany($staff->company)->name}} => @endif {{$staff->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="portfolioDesc">Portfolio Description</label>
                                        <textarea rows="8" name="description" class="form-control" id="portfolioDesc" placeholder="Write portfolio descripton here...">{{$portfolio->title}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="thumbnailImage">Portfolio Thumbnail</label>
                                        <img style="max-height: 50px; max-width: 100%;display:block;margin-bottom: 10px" src="{{asset($portfolio->thumbnail)}}" alt="">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="thumbnail" type="file" class="custom-file-input" id="thumbnailImage">
                                                <label class="custom-file-label" for="thumbnailImage">Change Image</label>
                                            </div>
{{--                                            <div class="input-group-append">--}}
{{--                                                <span class="input-group-text">Upload</span>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="portfolioLink">Portfolio Link (Optional)</label>
                                        <input type="text" name="link" class="form-control" id="portfolioLink" placeholder="https://"  value="{{$portfolio->link}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Portfolio</button>
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
