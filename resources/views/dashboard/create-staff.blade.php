@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">New Staff</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add New Staff</li>
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
                                <h3 class="card-title">Register a new staff</h3>
                            </div>
                            <div class="card-body register-card-body">

                                <form action="{{route('staff.store')}}" method="post">
                                    @csrf
                                    <!-- Field start -->
                                    <div class="mb-3">
                                        <div class="from-group">
                                            <label for="staffName">Staff Name</label>
                                            <input name="name" type="text" id="CompanyName" class="form-control @error('name'){{'is-invalid'}}@enderror" placeholder="Staff name">
                                        </div>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Field end -->

                                    <!-- Field start -->
                                    <div class="mb-3">
                                        <div class="from-group mb-3">
                                            <label for="CompanyEmail">Staff Email</label>
                                            <input name="email" type="email" id="CompanyEmail" class="form-control @error('email'){{'is-invalid'}}@enderror" placeholder="Staff email">
                                        </div>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Field end -->
                                    <!-- Field start -->
                                    @if(Auth::user()->role == 1)
                                    <div class="mb-3">
                                        <div class="from-group mb-3">
                                            <label for="CompanyName">Company</label>
                                            <select name="company" id="CompanyName" class="form-control @error('company'){{'is-invalid'}}@enderror">
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @endif
                                    <!-- Field end -->

                                    <!-- Field start -->
                                    <div class="mb-3">
                                        <div class="from-group mb-3">
                                            <label for="password">Password</label>
                                            <input name="password" type="password" id="password" class="form-control @error('password'){{'is-invalid'}}@enderror" placeholder="Password">
                                        </div>
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Field end -->
                                    <div class="mb-3">
                                        <div class="from-group mb-3">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <input name="password_confirmation" id="confirmPassword" type="password" class="form-control"
                                                   placeholder="Retype password">
                                        </div>
                                    </div>
                                    <!-- Field end -->
                                    <div class="row">
                                        <button id="submitButton" type="submit" class="btn btn-primary btn-block">Register Staff</button>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.form-box -->
                        </div><!-- /.card -->
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
