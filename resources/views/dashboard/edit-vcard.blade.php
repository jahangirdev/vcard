@extends('dashboard.app')
@section('content')
    <style>
        .card.selected {
            border: 10px solid green;
        }
        #profile-img{
            border: 5px solid green;
            background: white;
            margin-top: -75px;
            position: relative;
            z-index: 3;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        #profile-img::after{
            position: absolute;
            content: "Change";
            background: rgba(0, 0, 0, 0.5);
            height: 100%;
            width: 100%;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            color: white;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 4;
            border-radius: 50%;
            cursor: pointer;
        }
        #profile-img:hover::after{
            display: flex;
        }
        #profile-img img{
            height: 100%;
            width: 100%;
        }
        /** Profile cover */
        #profile-cover{
            background:url({{asset($vcard->cover ? : 'https://loremflickr.com/640/360')}});
            background-size: cover;
            height: 150px;
            position: relative;
            z-index: 1;
        }
        #profile-cover::after{
            position: absolute;
            content: "Change";
            background: rgba(0, 0, 0, 0.5);
            height: 100%;
            width: 100%;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            color: white;
            display: none;
            justify-content: center;
            align-items: start;
            padding-top: 30px;
            z-index: 2;
            cursor: pointer;
        }
        #profile-cover:hover::after{
            display: flex;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$vcard ? 'Edit Vcard': 'Create Vcard'}}</h1>
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
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                @if($vcard)
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h5 class="card-title">Profile</h5>
                                </div>
                                <div class="card-body">
                                    <div id="profile-cover" class="cover" class="card-img-top" title="Min-width=400 Min-height=300 Max-width=1200 Max-height=800">
                                    </div>
                                    <form method="POST" action="{{route('profile.cover.update', $vcard->id)}}" id="cover-form" enctype="multipart/form-data" style="display:none">
                                        @csrf
                                        <input type="file" name="cover" accept="image/*">
                                    </form>
                                    <div id="profile-img" title="Min-width=100 Min-height=100 Max-width:1000 Max-height=1000">
                                        <img src="{{asset($vcard->profile_img ? : 'public/front-end/templates/images/avatar7.png')}}" alt="Admin" class="rounded-circle" width="150">
                                    </div>
                                    <form method="POST" action="{{route('profile.image.update', $vcard->id)}}" id="profile-img-form" enctype="multipart/form-data" style="display:none">
                                        @csrf
                                        <input type="file" name="profile_img" accept="image/*">
                                    </form>
                                    <div class="mt-3">
                                        <h4>{{$vcard->user->name}}</h4>
                                        <p class="text-secondary mb-1">{{$vcard->designation}}</p>
                                        @if($vcard->user->company)<p class="text-secondary mb-1">Works at {{$getCompany($vcard->user->company)->name}}</p>@endif
                                        <p class="text-muted font-size-sm">{{$vcard->address}}</p>
                                        <a href="tel:{{$vcard->phone}}" class="btn btn-primary"><i class="fa fa-phone-alt"></i> Call</a>
                                        <a href="mailto:{{$vcard->contact_email ? : $vcard->email}}" class="btn btn-outline-primary"><i class="fa fa-envelope"></i> Email</a>
                                        <div class="row justify-content-center mt-2">
                                            <a href="{{route('profile.edit', $vcard->user->id)}}" class="btn btn-outline-success"><i class="fa fa-edit"></i> Edit Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Social links</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('social.update', $vcard->user->id)}}" method="POST">
                                        @csrf
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-facebook"></i> Facebook</h6>
                                            <div class="form-group">
                                                <input type="text" name="facebook" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && $vcard->socialLinks->facebook ? $vcard->socialLinks->facebook : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="facebook_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->facebook_link) ? $vcard->socialLinks->facebook_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-twitter"></i> Twitter</h6>
                                            <div class="form-group">
                                                <input type="text" name="twitter" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->twitter) ? $vcard->socialLinks->twitter : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="twitter_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->twitter_link) ? $vcard->socialLinks->twitter_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-youtube"></i> Youtube</h6>
                                            <div class="form-group">
                                                <input type="text" name="youtube" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->youtube) ? $vcard->socialLinks->youtube : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="youtube_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->youtube_link) ? $vcard->socialLinks->youtube_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-whatsapp"></i> Whatsapp</h6>
                                            <div class="form-group">
                                                <input type="text" name="whatsapp" class="form-control" placeholder="Number" value="{{$vcard->socialLinks && isset($vcard->socialLinks->whatsapp) ? $vcard->socialLinks->whatsapp : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="whatsapp_link" class="form-control" placeholder="Chat link (Optional)" value="{{$vcard->socialLinks && isset($vcard->socialLinks->whatsapp_link) ? $vcard->socialLinks->whatsapp_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-instagram"></i> Instagram</h6>
                                            <div class="form-group">
                                                <input type="text" name="instagram" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->instagram) ? $vcard->socialLinks->instagram : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="instagram_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->instagram_link) ? $vcard->socialLinks->instagram_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-tiktok"></i> Tiktok</h6>
                                            <div class="form-group">
                                                <input type="text" name="instagram" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->tiktok) ? $vcard->socialLinks->tiktok : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="tiktok_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->tiktok_link) ? $vcard->socialLinks->tiktok_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-snapchat"></i> Snapchat</h6>
                                            <div class="form-group">
                                                <input type="text" name="instagram" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->snapchat) ? $vcard->socialLinks->snapchat : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="snapchat_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->snapchat_link) ? $vcard->socialLinks->snapchat_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-pinterest"></i> Pinterest</h6>
                                            <div class="form-group">
                                                <input type="text" name="pinterest" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->pinterest) ? $vcard->socialLinks->pinterest : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="pinterest_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->pinterest_link) ? $vcard->socialLinks->pinterest_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-reddit"></i> Reddit</h6>
                                            <div class="form-group">
                                                <input type="text" name="reddit" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->reddit) ? $vcard->socialLinks->reddit : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="reddit_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->reddit_link) ? $vcard->socialLinks->reddit_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-linkedin"></i> Linkedin</h6>
                                            <div class="form-group">
                                                <input type="text" name="linkedin" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->linkedin) ? $vcard->socialLinks->linkedin : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="linkedin_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->linkedin_link) ? $vcard->socialLinks->linkedin_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-github"></i> Github</h6>
                                            <div class="form-group">
                                                <input type="text" name="github" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->github) ? $vcard->socialLinks->github : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="github_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->github_link) ? $vcard->socialLinks->github_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-behance"></i> Behance</h6>
                                            <div class="form-group">
                                                <input type="text" name="behance" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->behance) ? $vcard->socialLinks->behance : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="behance_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->behance_link) ? $vcard->socialLinks->behance_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class=""><i class="fab fa-dribbble"></i> Dribbble</h6>
                                            <div class="form-group">
                                                <input type="text" name="dribbble" class="form-control" placeholder="Username" value="{{$vcard->socialLinks && isset($vcard->socialLinks->dribbble) ? $vcard->socialLinks->dribbble : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="dribbble_link" class="form-control" placeholder="Profile link" value="{{$vcard->socialLinks && isset($vcard->socialLinks->dribbble_link) ? $vcard->socialLinks->dribbble_link : ''}}">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <button class="btn btn-primary">Update Social Links</button>
                                            </div>
                                        </li>

                                    </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form action="{{route('vcard.update', $vcard->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Vcard Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Designation</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="designation" class="form-control" id="inlineFormInputGroupUsername2" value="{{$vcard->designation}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0" for="inlineFormInputGroupUsername2">Vcard URL</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{config('app.url').'vcard/'}}</div>
                                                    </div>
                                                    <input type="text" name="slug" class="form-control" id="inlineFormInputGroupUsername2" value="{{$vcard->slug}}" onkeyup="slugify(this, this); checkSlug(this, {{$vcard->id}})">
                                                    <div class="valid-feedback">
                                                        Slug Available
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Already taken
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Contact Email</h6>
                                                <small>(Contact form and contact email)</small>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="contact_email" type="text" class="form-control" value="{{$vcard->contact_email}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">About</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <textarea name="about" rows="10" class="form-control" placeholder="Write a brief description about yourself...">{{$vcard->about}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="phone" type="text" class="form-control" value="{{$vcard->phone}}" placeholder="Enter phone">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone 2</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="phone2" type="text" class="form-control" value="{{$vcard->phone2}}" placeholder="Enter alternative phone">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="address" type="text" class="form-control" value="{{$vcard->address}}" value="Enter your address">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Website</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="website" type="text" class="form-control" value="{{$vcard->website}}" placeholder="https://">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Update Information">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{route("vcard.settings", $vcard->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="template" name="template" value="{{$vcard->template}}">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Vcard Settings</h5>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <h6 class="mb-4">Select a Template:</h6>
                                                <div class="row template-row">
                                                    @foreach($templates as $template)
                                                        <div class="col-md-4">
                                                            <div class="card template {{$vcard->template && $vcard->template == $template->id ? 'selected': $template->status == 2 && !$vcard->template ? 'selected' : ''}}" data-id="{{$template->id}}">
                                                                <img class="card-img-top" src="{{asset($template->thumbnail)}}" alt="Card image cap">
                                                                <div class="card-body d-flex justify-content-center">
                                                                    <h4 class="card-title">{{$template->name}}{{$template->status == 2 ? ' (Default)': ''}}</h4>
                                                                </div>
                                                                <div class="card-footer text-center">
                                                                    <a href="{{route('template.preview', $template->id)}}" target="_blank" class="btn btn-info preview-btn">Preview</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr class="mb-3">
                                                <h6 class="mb-4">Display Options:</h6>
                                                <div class="form-check form-switch">
                                                    <input name="show_services" class="form-check-input" type="checkbox" id="showServices" {{$vcard->show_services ? 'checked':''}}>
                                                    <label class="form-check-label" for="showServices">Show Services</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input name="show_portfolios" class="form-check-input" type="checkbox" id="showPortfolio" {{$vcard->show_portfolios ? 'checked':''}}>
                                                    <label class="form-check-label" for="showPortfolio">Show Portfolios</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input name="show_testimonials" class="form-check-input" type="checkbox" id="testimonials" {{$vcard->show_testimonials ? 'checked':''}}>
                                                    <label class="form-check-label" for="testimonials">Show Testimonials</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input name="show_contact_form" class="form-check-input" type="checkbox" id="contactForm" {{$vcard->show_contact_form ? 'checked':''}}>
                                                    <label class="form-check-label" for="contactForm">Show Contact Form</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input name="show_business_hours" class="form-check-input" type="checkbox" id="businessHours" {{$vcard->show_business_hours ? 'checked':''}}>
                                                    <label class="form-check-label" for="businessHours">Show Business Hours</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input name="show_social_icons" class="form-check-input" type="checkbox" id="socialIcons" {{$vcard->show_social_icons ? 'checked':''}}>
                                                    <label class="form-check-label" for="socialIcons">Show Social Icons</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input name="show_contact_info" class="form-check-input" type="checkbox" id="showContactInfo" {{$vcard->show_contact_info ? 'checked':''}}>
                                                    <label class="form-check-label" for="showContactInfo">Show Contact Info</label>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Save Settings</button>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </form>

                                    <!-- Business hours-->
                                    <form action="{{route('business.hours.update', $vcard->user->id)}}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Business Hours</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Monday</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" name="monday" class="form-control" value="{{$vcard->businessHours && $vcard->businessHours->monday ? $vcard->businessHours->monday :''}}"  placeholder="e.g. 9:00 AM - 5:PM">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Tuesday</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="tuesday" type="text" class="form-control" value="{{$vcard->businessHours && $vcard->businessHours->tuesday ? $vcard->businessHours->tuesday :''}}" placeholder="e.g. 9:00 AM - 5:PM">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Wednesday</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="wednesday" type="text" class="form-control" value="{{$vcard->businessHours && $vcard->businessHours->wednesday ? $vcard->businessHours->wednesday :''}}" placeholder="e.g. 9:00 AM - 5:PM">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Thursday</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="thursday" type="text" class="form-control" value="{{$vcard->businessHours && $vcard->businessHours->thursday ? $vcard->businessHours->thursday :''}}" placeholder="e.g. 9:00 AM - 5:PM">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Friday</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="friday" type="text" class="form-control" value="{{$vcard->businessHours && $vcard->businessHours->friday ? $vcard->businessHours->friday :''}}" placeholder="e.g. 9:00 AM - 5:PM">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Saturday</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="saturday" type="text" class="form-control" value="{{$vcard->businessHours && $vcard->businessHours->saturday ? $vcard->businessHours->saturday :''}}" placeholder="e.g. 9:00 AM - 5:PM">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Sunday</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="sunday" type="text" class="form-control" value="{{$vcard->businessHours && $vcard->businessHours->sunday ? $vcard->businessHours->sunday :''}}" placeholder="e.g. Closed">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="submit" class="btn btn-primary px-4" value="Update Business Hours">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/Business hours -->
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{route('vcard.create', Auth::user()->id)}}" class="btn btn-primary">Create Vcard</a>
                @endif
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        function checkSlug(input, id){
            fetch("{{config('app.url')}}vcard/slug-availability/"+id+'?slug='+input.value)
                .then(response => response.json())
                .then(data => {
                    if(data.type == "success"){
                        input.classList.remove("is-invalid");
                        input.classList.add("is-valid");
                        document.querySelector(".valid-feedback").innerText = data.message;
                    }
                    else{
                        input.classList.remove("is-valid");
                        input.classList.add("is-invalid");
                        document.querySelector(".invalid-feedback").innerText = data.message;
                    }
                });
        }
        document.addEventListener("DOMContentLoaded", function(){
            //select template
            const templates = document.querySelectorAll(".template-row .card.template");
            templates.forEach( template => {
                template.addEventListener("click", (e)=>{
                    templates.forEach(t => {
                        t.classList.remove("selected");
                    });
                    template.classList.add("selected");
                    document.getElementById("template").value = template.getAttribute("data-id");
                });
                template.querySelector(".preview-btn").addEventListener("click", (e) =>{
                    e.stopPropagation();
                });
            });

            //upload cover

            const cover = document.getElementById("profile-cover");
            const coverForm = document.getElementById("cover-form");
            cover.addEventListener("click", function(){
                coverForm.cover.click();
                coverForm.cover.addEventListener("change", function(){
                    coverForm.submit();
                });
            });

            //upload profile image

            const profileImg = document.getElementById("profile-img");
            const profileForm = document.getElementById("profile-img-form");
            profileImg.addEventListener("click", function(){
                profileForm.profile_img.click();
                profileForm.profile_img.addEventListener("change", function(){
                    profileForm.submit();
                });
            });
        });
    </script>
@endsection
