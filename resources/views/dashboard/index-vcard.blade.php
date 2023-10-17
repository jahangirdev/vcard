@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$vcard ? 'Vcard Information': 'Create Vcard'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{$vcard ? 'Edit Vcard': 'Create Vcard'}}</li>
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
                @if($vcard)
                    <a class="btn btn-info" href="{{route('vcard.edit', $vcard->id)}}">Edit Vcard</a>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if($vcard)
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="cover" style="background:url({{asset($vcard->cover ? : 'https://loremflickr.com/640/360')}}); background-size:cover;height:150px" class="card-img-top">
                                    </div>
                                    <img src="{{asset($vcard->profile_img ? : 'public/front-end/templates/images/avatar7.png')}}" alt="Admin" class="rounded-circle" width="150" style="border: 5px solid green;background:white;margin-top:-75px">
                                    <div class="mt-3">
                                        <h4>{{$vcard->name}}</h4>
                                        <p class="text-secondary mb-1">{{$vcard->designation}}</p>
                                        @php
                                            $company = $getCompany($vcard->user->company);
                                        @endphp
                                        @if($company)<p class="text-secondary mb-1">Works at {{$company->name}}</p>@endif
                                        <p class="text-muted font-size-sm">{{$vcard->address}}</p>
                                        <a href="tel:{{$vcard->phone}}" class="btn btn-primary"><i class="fa fa-phone-alt"></i> Call</a>
                                        <a href="mailto:{{$vcard->contact_email ? : $vcard->user->email}}" class="btn btn-outline-primary"><i class="fa fa-envelope"></i> Email</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <ul class="list-group list-group-flush">
                                    @if($vcard->website)
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fa fa-globe mr-2"></i> Website</h6>
                                        <span class="text-secondary">{{$vcard->website}}</span>
                                    </li>
                                    @endif
                                    @if($vcard->socialLinks()->exists())
                                            {{-- Facebook --}}
                                            @if($vcard->socialLinks->facebook_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-facebook mr-2"></i>Facebook</h6>
                                                    <a href="{{$vcard->socialLinks->facebook_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->facebook ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- YouTube --}}
                                            @if($vcard->socialLinks->youtube_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-youtube mr-2"></i>YouTube</h6>
                                                    <a href="{{$vcard->socialLinks->youtube_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->youtube ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- WhatsApp --}}
                                            @if($vcard->socialLinks->whatsapp_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-whatsapp mr-2"></i>WhatsApp</h6>
                                                    <a href="{{$vcard->socialLinks->whatsapp_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->whatsapp ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- Instagram --}}
                                            @if($vcard->socialLinks->instagram_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-instagram mr-2"></i>Instagram</h6>
                                                    <a href="{{$vcard->socialLinks->instagram_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->instagram ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- TikTok --}}
                                            @if($vcard->socialLinks->tiktok_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-tiktok mr-2"></i>TikTok</h6>
                                                    <a href="{{$vcard->socialLinks->tiktok_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->tiktok ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- Snapchat --}}
                                            @if($vcard->socialLinks->snapchat_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-snapchat-ghost mr-2"></i>Snapchat</h6>
                                                    <a href="{{$vcard->socialLinks->snapchat_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->snapchat ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- Pinterest --}}
                                            @if($vcard->socialLinks->pinterest_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-pinterest mr-2"></i>Pinterest</h6>
                                                    <a href="{{$vcard->socialLinks->pinterest_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->pinterest ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- Reddit --}}
                                            @if($vcard->socialLinks->reddit_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-reddit mr-2"></i>Reddit</h6>
                                                    <a href="{{$vcard->socialLinks->reddit_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->reddit ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- LinkedIn --}}
                                            @if($vcard->socialLinks->linkedin_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-linkedin mr-2"></i>LinkedIn</h6>
                                                    <a href="{{$vcard->socialLinks->linkedin_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->linkedin ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- Twitter --}}
                                            @if($vcard->socialLinks->twitter_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-twitter mr-2"></i>Twitter</h6>
                                                    <a href="{{$vcard->socialLinks->twitter_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->twitter ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- GitHub --}}
                                            @if($vcard->socialLinks->github_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-github mr-2"></i>GitHub</h6>
                                                    <a href="{{$vcard->socialLinks->github_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->github ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- Behance --}}
                                            @if($vcard->socialLinks->behance_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-behance mr-2"></i>Behance</h6>
                                                    <a href="{{$vcard->socialLinks->behance_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->behance ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif

                                            {{-- Dribbble --}}
                                            @if($vcard->socialLinks->dribbble_link)
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0"><i class="fab fa-dribbble mr-2"></i>Dribbble</h6>
                                                    <a href="{{$vcard->socialLinks->dribbble_link}}" target="_blank"><span class="text-secondary">{{$vcard->socialLinks->dribbble ?: "Visit profile"}}</span></a>
                                                </li>
                                            @endif
                                    @endif
                                </ul>
                            </div>
                            <!--About -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <h3>About {{$vcard->name}}</h3>
                                        <div class="mt-3">
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aperiam atque blanditiis commodi debitis deserunt distinctio dolor esse, facilis labore magnam nam natus nemo nulla porro quasi quia quis quisquam quod repudiandae similique tempora ullam! Amet at beatae commodi dicta dolorem doloribus eius expedita facilis hic inventore, iure laudantium, magni nostrum officiis quibusdam, ratione sed sint sunt tempora unde. Consequuntur, distinctio doloremque eligendi est ex ipsa, libero nobis, obcaecati odio repellat velit voluptatum! Aliquid aspernatur autem, delectus possimus quis ratione reiciendis temporibus! Iure laudantium libero praesentium quam quibusdam. Beatae dolorem molestias possimus quibusdam, sapiente voluptas voluptates. Blanditiis dolorum maxime odio!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{$vcard->name}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vcard URL</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{config('app.url').'vcard/'.$vcard->slug}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Account email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{$vcard->email}}
                                        </div>
                                    </div>
                                    <hr>
                                    @if($vcard->contact_email)
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Contact email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{$vcard->contact_email}}
                                        </div>
                                    </div>
                                    <hr>
                                    @endif
                                    @if($vcard->phone)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$vcard->phone}}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if($vcard->phone2)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone 2</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$vcard->phone2}}
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    @if($vcard->address)
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{$vcard->address}}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!--Services -->
                            <div class="row gutters-sm">
                                <div class="col-12 mb-3">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h4>Services</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($services as $service)
                                                <div class="col-md-4">
                                                    <div class="card text-center">
                                                        <img src="{{asset($service->icon)}}" alt="{{$service->title}}" class="card-img-top">
                                                        <div class="card-body">
                                                            <h5 class="">{{$service->title}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{route('service.index')}}" class="btn btn-primary">Manage All Service</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Portfolios -->
                            <div class="row gutters-sm">
                                <div class="col-12 mb-3">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h4>Portfolios</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($portfolios as $portfolio)
                                                    <div class="col-md-4">
                                                        <div class="card text-center">
                                                            <img src="{{asset($portfolio->thumbnail)}}" alt="{{$portfolio->title}}" class="card-img-top">
                                                            <div class="card-body">
                                                                <h5 class="">{{$portfolio->title}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{route('portfolio.index')}}" class="btn btn-primary">Manage All Portfolio</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonials -->
                            <div class="row gutters-sm">
                                <div class="col-12 mb-3">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h4>Testimonials</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($testimonials as $testimonial)
                                                    <div class="col-md-4">
                                                        <div class="card text-center">
                                                            <img src="{{asset($testimonial->image)}}" alt="{{$testimonial->name}}" class="card-img-top">
                                                            <div class="card-body">
                                                                <h5 class="">{{$testimonial->name}}</h5>
                                                                <p class="text-muted">{{$testimonial->designation}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{route('testimonial.index')}}" class="btn btn-primary">Manage All Testimonial</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                @else
                    <a href="{{route('vcard.create', $id)}}" class="btn btn-primary">Create Vcard</a>
                @endif
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
