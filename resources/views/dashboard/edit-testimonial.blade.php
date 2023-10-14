@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit "{{$testimonial->name}}"</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Testimonial</li>
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
                                <h3 class="card-title">Edit Testimonial</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('testimonial.update', $testimonial->id)}}" enctype="multipart/form-data">
                                <div class="card-body">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label for="TestimonialName">Name</label>
                                        <input type="text" name="name" class="form-control" id="TestimonialName" placeholder="Name" value="{{$testimonial->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="designation">Service Slug</label>
                                        <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation"  value="{{$testimonial->designation}}">
                                    </div>
                                    @if(Auth::user()->role < 3)
                                        <div class="form-group">
                                            <label for="AssignTo">Assign To</label>
                                            <select name="user_id" class="form-control" id="AssignTo">
                                                <option value="{{Auth::user()->id}}"><--Myself--></option>
                                                @foreach($staffs as $staff)
                                                    <option value="{{$staff->id}}" @if($staff->id == old('user_id') || (old('user_id') == null && $testimonial->user_id == $staff->id)) selected @endif> @if($staff->role == 3){{$getCompany($staff->company)->name}} => @endif {{$staff->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="testimonialComment">Testimonial Comment</label>
                                        <textarea rows="8" name="comment" class="form-control" id="testimonialComment" placeholder="Write testimonial comment here...">{{$testimonial->comment}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="thumbnailImage">Service Icon</label>
                                        <small>(Max size: 512KB, MAX RES: 400x400)</small>
                                        <img style="max-height: 50px; max-width: 100%;display:block;margin-bottom: 10px" src="{{asset($testimonial->image)}}" alt="">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="image" type="file" class="custom-file-input" id="thumbnailImage">
                                                <label class="custom-file-label" for="thumbnailImage">Change Image</label>
                                            </div>
{{--                                            <div class="input-group-append">--}}
{{--                                                <span class="input-group-text">Upload</span>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Testimonial</button>
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