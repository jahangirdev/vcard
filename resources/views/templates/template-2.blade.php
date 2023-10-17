
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link rel="stylesheet" href="{{asset('public/front-end/templates/css/vcard2.css')}}">


    <link rel="stylesheet" href="{{asset('public/front-end/templates/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('public/front-end/templates/css/slick-theme.min.css')}}">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <title>Vcard2 Theme</title>
</head>
<body>
<div class="container">
    <div class="vcard-three main-content w-100 mx-auto overflow-hidden">

        <div class="vcard-three__banner w-100 position-relative">
            <img src="{{asset($vcard->cover)}}" class="img-fluid banner-image" alt="banner"/>

{{--            <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3">--}}
{{--                <div class="language pt-3 me-2">--}}
{{--                    <ul class="text-decoration-none">--}}
{{--                        <li class="dropdown1 dropdown lang-list">--}}
{{--                            <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown"--}}
{{--                               role="button"--}}
{{--                               aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="fa-solid fa-language me-2"></i>Language</a>--}}
{{--                            <ul class="dropdown-menu start-0 lang-hover-list top-100">--}}
{{--                                <li>--}}
{{--                                    <img src="https://vcards.infyom.com/assets/img/vcard1/english.png" width="25px" height="20px"--}}
{{--                                         class="me-3"><a href="#">English</a></li>--}}
{{--                                <li>--}}
{{--                                    <img src="https://vcards.infyom.com/assets/img/vcard1/spain.png" width="25px" height="20px"--}}
{{--                                         class="me-3"><a href="#">Spanish</a></li>--}}
{{--                                <li>--}}
{{--                                    <img src="https://vcards.infyom.com/assets/img/vcard1/france.png" width="25px" height="20px"--}}
{{--                                         class="me-3"><a href="#">Franch</a></li>--}}
{{--                                <li>--}}
{{--                                    <img src="https://vcards.infyom.com/assets/img/vcard1/arabic.svg" width="25px" height="20px"--}}
{{--                                         class="me-3"><a href="#">Arabic</a></li>--}}
{{--                                <li>--}}
{{--                                    <img src="https://vcards.infyom.com/assets/img/vcard1/german.png" width="25px" height="20px"--}}
{{--                                         class="me-3"><a href="#">German</a></li>--}}
{{--                                <li>--}}
{{--                                    <img src="https://vcards.infyom.com/assets/img/vcard1/russian.jpeg" width="25px" height="20px"--}}
{{--                                         class="me-3"><a href="#">russian</a></li>--}}
{{--                                <li>--}}
{{--                                    <img src="https://vcards.infyom.com/assets/img/vcard1/turkish.png" width="25px" height="20px"--}}
{{--                                         class="me-3"><a href="#">Turkish</a></li>--}}

{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

        <div class="vcard-three__profile position-relative">
            <div class="avatar position-absolute top-0 start-50 translate-middle">
                <img src="{{asset($vcard->profile_img)}}" alt="profile-img" class="rounded-circle"/>
            </div>
        </div>

        <div class="vcard-three__profile-details py-3 px-3">
            <h4 class="vcard-three-heading text-center">{{$vcard->user->name}}</h4>
            <span class="profile-designation text-center d-block text-white">{{$vcard->designation}}</span>
            <div class="mt-5">
                <span class="profile-description" >{{$vcard->about}}</span>
            </div>
            @if($vcard->show_social_icons == 1)
            <div class="social-icons d-flex justify-content-center pt-4">
                @if($vcard->socialLinks->facebook || $vcard->socialLinks->facebook_link)
                    <a target="_blank" href="{{$vcard->socialLinks->facebook_link}}">
                        <i class="fab fa-facebook facebook-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->youtube || $vcard->socialLinks->youtube_link)
                    <a target="_blank" href="{{$vcard->socialLinks->youtube_link}}">
                        <i class="fab fa-youtube youtube-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->whatsapp || $vcard->socialLinks->whatsapp_link)
                    <a target="_blank" href="{{$vcard->socialLinks->whatsapp_link}}">
                        <i class="fab fa-whatsapp whatsapp-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->instagram || $vcard->socialLinks->instagram_link)
                    <a target="_blank" href="{{$vcard->socialLinks->instagram_link}}">
                        <i class="fab fa-instagram instagram-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->tiktok || $vcard->socialLinks->tiktok_link)
                    <a target="_blank" href="{{$vcard->socialLinks->tiktok_link}}">
                        <i class="fab fa-tiktok tiktok-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->snapchat || $vcard->socialLinks->snapchat_link)
                    <a target="_blank" href="{{$vcard->socialLinks->snapchat_link}}">
                        <i class="fab fa-snapchat snapchat-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->pinterest || $vcard->socialLinks->pinterest_link)
                    <a target="_blank" href="{{$vcard->socialLinks->pinterest_link}}">
                        <i class="fab fa-pinterest pinterest-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->reddit || $vcard->socialLinks->reddit_link)
                    <a target="_blank" href="{{$vcard->socialLinks->reddit_link}}">
                        <i class="fab fa-reddit reddit-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->linkedin || $vcard->socialLinks->linkedin_link)
                    <a target="_blank" href="{{$vcard->socialLinks->linkedin_link}}">
                        <i class="fab fa-linkedin linkedin-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->twitter || $vcard->socialLinks->twitter_link)
                    <a target="_blank" href="{{$vcard->socialLinks->twitter_link}}">
                        <i class="fab fa-twitter twitter-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->github || $vcard->socialLinks->github_link)
                    <a target="_blank" href="{{$vcard->socialLinks->github_link}}">
                        <i class="fab fa-github github-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->behance || $vcard->socialLinks->behance_link)
                    <a target="_blank" href="{{$vcard->socialLinks->behance_link}}">
                        <i class="fab fa-behance behance-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

                @if($vcard->socialLinks->dribbble || $vcard->socialLinks->dribbble_link)
                    <a target="_blank" href="{{$vcard->socialLinks->dribbble_link}}">
                        <i class="fab fa-dribbble dribbble-icon icon me-sm-4 me-2 fa-2x"></i>
                    </a>
                @endif

            </div>
            @endif
        </div>
        @if($vcard->show_contact_info == 1)
        <div class="vcard-three__event py-3 px-3 mt-2 position-relative">
            <img src="{{asset('/public/front-end/templates/images/vcard3-shape.png')}}" alt="shape" class="position-absolute end-0 shape-one"/>
            <div class="container">
                <div class="row g-3">
                    <div class="col-sm-6 col-12">
                        <div class="card event-card p-2 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('/public/front-end/templates/images/vcard3-email.png')}}" alt="email"/>
                            </span>
                            <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                <h6 class="text-white text-sm-start text-center">E-mail address</h6>
                                <h5 class="event-name text-sm-start text-center mb-0 text-white">{{$vcard->contact_email ? : $vcard->user->email}}</h5>
                            </div>
                        </div>
                    </div>
                    @if($vcard->phone || $vcard->phone2)
                    <div class="col-sm-6 col-12">
                        <div class="card event-card p-2 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('/public/front-end/templates/images/vcard3-phone.png')}}" alt="phone"/>
                            </span>
                            <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                <h6 class="text-white text-sm-start text-center">Mobile Number</h6>
                                <h5 class="event-name text-center mb-0 text-white">{{$vcard->phone ? : $vcard->phone2 ? : ''}}</h5>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($vcard->website)
                    <div class="col-sm-6 col-12">
                        <div class="card event-card p-2 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('/public/front-end/templates/images/vcard3-web.png')}}" alt="birthday"/>
                            </span>
                            <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                <h6 class="text-white text-sm-start text-center">Website</h6>
                                <h5 class="event-name text-center mb-0 text-white">{{$vcard->website}}</h5>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(!empty($vcard->address))
                    <div class="col-sm-6 col-12">
                        <div class="card event-card p-2 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('/public/front-end/templates/images/vcard3-location.png')}}" alt="location"/>
                            </span>
                            <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                <h6 class="text-white text-sm-start text-center">Location</h6>
                                <h5 class="event-name text-center mb-0 text-white">{{$vcard->address}}</h5>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

{{--        <div class="vcard-three__appointment py-3">--}}
{{--            <h4 class="vcard-three-heading heading-line text-center pb-4 text-white position-relative">Make an--}}
{{--                Appointment</h4>--}}
{{--            <div class="container px-4">--}}
{{--                <div class="row d-flex align-items-center justify-content-center mb-3">--}}
{{--                    <div class="col-md-2">--}}
{{--                        <label for="date" class="me-4 appoint-date mb-2">Date</label>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-10">--}}
{{--                        <input id="myID" type="text" class="appoint-input" placeholder="Pick a Date"/>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row d-flex align-items-center justify-content-center mb-md-3">--}}
{{--                    <div class="col-md-2">--}}
{{--                        <label for="text" class="me-4 appoint-date mb-2">Hour</label>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-5 mb-md-0 mb-3">--}}
{{--                        <div class="card appoint-input flex-row">--}}
{{--                            <span>08:10 - 20:00</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-5 mb-md-0 mb-3">--}}
{{--                        <div class="card appoint-input flex-row">--}}
{{--                            <span>08:10 - 20:00</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row d-flex align-items-center justify-content-center">--}}
{{--                    <div class="col-md-2">--}}
{{--                    </div>--}}
{{--                    <div class="col-md-5 mb-md-0 mb-3">--}}
{{--                        <div class="card appoint-input flex-row">--}}
{{--                            <span>08:10 - 20:00</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-5 mb-md-0 mb-3">--}}
{{--                        <div class="card appoint-input flex-row">--}}
{{--                            <span>08:10 - 20:00</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button type="button" class="appoint-btn text-white mt-4 d-block mx-auto ">Make an Appointment</button>--}}
{{--            </div>--}}
{{--        </div>--}}

        @if($vcard->show_services == 1 && $vcard->services != null)
        <div class="vcard-three__service py-4 position-relative px-sm-3">
            <img src="{{asset('/public/front-end/templates/images/vcard3-shape2.png')}}" alt="shape" class="position-absolute start-0 shape-two"/>
            <img src="{{asset('/public/front-end/templates/images/vcard3-shape3.png')}}" alt="shape" class="position-absolute end-0 bottom-0 shape-three"/>
            <div class="container">
                <h4 class="vcard-three-heading heading-line position-relative text-center">{{$vcard->user->role == 2 ? 'Our': 'My'}} Services</h4>
                <div class="row mt-3 g-3">
                    @foreach($vcard->services as $service)
                    <div class="col-sm-6 col-12">
                        <div class="card service-card p-3 h-100 d-flex align-items-center bg-white">
                            <div class="service-image d-flex justify-content-center align-items-center">
                                <img src="{{asset($service->icon)}}" alt="{{$service->title}}"/>
                            </div>
                            <div class="service-details mt-3">
                                <h4 class="service-title text-center">{{$service->title}}</h4>
                                <p class="service-paragraph mb-0 text-center">
                                    {{$service->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

{{--        <div class="vcard-three__product mt-3 py-3 position-relative px-3">--}}
{{--            <h4 class="vcard-three-heading heading-line text-center pb-4 text-white">Gallery</h4>--}}
{{--            <div class="container">--}}
{{--                <div class="row g-3 gallery-slider">--}}
{{--                    <div class="col-6 p-2">--}}
{{--                        <div class="card product-card p-3 border-0 w-100 h-100">--}}
{{--                            <div class="gallery-profile">--}}
{{--                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal"--}}
{{--                                   class="gallery-link">--}}
{{--                                    <img src="https://vcard.waptechy.com/assets/img/video-thumbnail.png" alt="profile"--}}
{{--                                         class="w-100"/>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 p-2">--}}
{{--                        <div class="card product-card p-3 border-0 w-100 h-100">--}}
{{--                            <div class="gallery-profile">--}}
{{--                                <img src="https://vcards.infyom.com/assets/img/vcard1/v2.jpg" alt="profile" class="w-100"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--            <div class="modal-dialog modal-dialog-centered">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-body">--}}
{{--                        <iframe src="//www.youtube.com/embed/Q1NKMPhP8PY"--}}
{{--                                class="w-100" height="315">--}}
{{--                        </iframe>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        @if($vcard->show_portfolios == 1 && $vcard->portfolios()->exists())
        <div class="vcard-three__product mt-3 py-3 position-relative px-3">
            <h4 class="vcard-three-heading heading-line text-center pb-4 text-white">Portfolios</h4>
            <div class="container">
                <div class="row g-3 product-slider">
                    @foreach($vcard->portfolios as $portfolio)
                    <div class="col-6 p-2">
                        <div class="card product-card p-3 border-0 w-100 h-100">
                            <div class="product-profile">
                                <img src="{{asset($portfolio->thumbnail)}}" alt="{{$portfolio->title}}" class="w-100"/>
                            </div>
                            <div class="product-details mt-3">
                                <h4 class="text-white">{{$portfolio->title}}</h4>
                                <h6 class="text-dark">{{$portfolio->getCategory->name}}</h6>
                                <p class="mb-2 text-white">
                                    {{$portfolio->description}}
                                </p>
                                @if($portfolio->link)<a href="{{$portfolio->link}}" class="text-white">Live link</a>@endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if($vcard->show_testimonials == 1 && $vcard->testimonials()->exists())
        <div class="vcard-three__testimonial py-4 position-relative px-sm-3">
            <div class="container">
                <h4 class="vcard-three-heading heading-line position-relative text-center">Testimonial</h4>
                <div class="row g-3 testimonial-slider mt-4">
                    @foreach($vcard->testimonials as $testimonial)
                    <div class="col-12">
                        <div class="card testimonial-card p-3 border-0 w-100">
                            <div
                                class="testimonial-user d-flex flex-sm-row flex-column align-items-center justify-content-sm-start justify-content-center">
                                <img src="{{asset($testimonial->image)}}" alt="profile"
                                     class="rounded-circle"/>
                                <div class="user-details d-flex flex-column ms-sm-3 mt-sm-0 mt-2">
                                    <span class="user-name text-white text-sm-start text-center">{{$testimonial->name}}</span>
                                    <span class="user-designation text-white text-sm-start text-center">- {{$testimonial->designation}}</span>
                                </div>
                            </div>
                            <p class="review-message mb-2 text-sm-start text-center mt-2">
                                {{$testimonial->comment}}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

{{--        <div class="vcard-three__blog py-3">--}}
{{--            <h4 class="vcard-three-heading heading-line position-relative text-center pb-4">Blog</h4>--}}
{{--            <div class="container">--}}
{{--                <div class="row g-4 blog-slider overflow-hidden">--}}
{{--                    <div class="col-6 mb-2">--}}
{{--                        <div class="card blog-card p-4 border-0 w-100 h-100 flex-sm-row">--}}
{{--                            <div class="blog-image">--}}
{{--                                <img src="https://vcards.infyom.com/assets/img/vcard1/v1.jpg" alt="profile" class="w-100"/>--}}
{{--                            </div>--}}
{{--                            <div class="blog-details ms-sm-5 ms-0 mt-sm-0 mt-5">--}}
{{--                                <h5 class="text-sm-start text-center">men's Wear</h5>--}}
{{--                                <p class="mt-2 mb-0 text-sm-start text-center">--}}
{{--                                    Men Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal Suit--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 mb-2">--}}
{{--                        <div class="card blog-card p-4 border-0 w-100 h-100 flex-sm-row">--}}
{{--                            <div class="blog-image">--}}
{{--                                <img src="https://vcards.infyom.com/assets/img/vcard1/v1.jpg" alt="profile" class="w-100"/>--}}
{{--                            </div>--}}
{{--                            <div class="blog-details ms-sm-5 ms-0 mt-sm-0 mt-5">--}}
{{--                                <h5 class="text-sm-start text-center">men's Wear</h5>--}}
{{--                                <p class="mt-2 mb-0 text-sm-start text-center">--}}
{{--                                    Men Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal Suit--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 mb-2">--}}
{{--                        <div class="card blog-card p-4 border-0 w-100 h-100 flex-sm-row">--}}
{{--                            <div class="blog-image">--}}
{{--                                <img src="https://vcards.infyom.com/assets/img/vcard1/v1.jpg" alt="profile" class="w-100"/>--}}
{{--                            </div>--}}
{{--                            <div class="blog-details ms-sm-5 ms-0 mt-sm-0 mt-5">--}}
{{--                                <h5 class="text-sm-start text-center">men's Wear</h5>--}}
{{--                                <p class="mt-2 mb-0 text-sm-start text-center">--}}
{{--                                    Men Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal SuitMen Regular Formal Suit--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        <div class="vcard-three__qr-code py-4 position-relative px-sm-3">
            <img src="https://vcards.infyom.com/assets/img/vcard3/vcard3-shape3.png" alt="shape" class="position-absolute start-0 top-0"/>
            <div class="container">
                <h4 class="vcard-three-heading heading-line position-relative text-center">QR Code</h4>
                <div class="card qr-code-card flex-sm-row flex-column justify-content-center align-items-center px-sm-3 px-4 py-md-5 py-4 mt-3">
                    <div class="qr-profile mb-3 d-flex justify-content-center d-sm-none d-block">
                        <img src="https://vcards.infyom.com/assets/img/vcard3/testimonial-profile.png" alt="qr profile" class="rounded-circle"/>
                    </div>
                    <div class="qr-code-scanner mx-md-4 mx-2 p-4 bg-white">
                        {!! QrCode::size(200)->generate(config('app.url').'vcard/'.$vcard->slug) !!}
                    </div>
                    <div class="mx-2">
                        <div class="qr-profile mb-3 d-flex justify-content-center d-sm-block d-none">
                            <img src="{{asset($vcard->profile_img)}}" alt="qr profile"
                                 class="mx-auto d-block rounded-circle"/>
                        </div>
                        <button onclick="download()" type="button" class="qr-code-btn text-white mt-4 mx-auto">Download My QR Code</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="vcard-three__timing py-4 position-relative px-sm-3">
            <img src="https://vcards.infyom.com/assets/img/vcard3/vcard3-shape.png" alt="shape"
                 class="position-absolute end-0 shape-four"/>
            <div class="container">
                <h4 class="vcard-three-heading heading-line position-relative text-center">Business Hours</h4>
                <div class="row mt-5 justify-content-center">
                    <div class="col-sm-8 col-12 time-section">
                        <div class="d-flex justify-content-center time-zone">
                            <span class="me-2">Sunday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="d-flex justify-content-center time-zone">
                            <span class="me-2">Monday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="d-flex justify-content-center time-zone">
                            <span class="me-2">Tuesday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="d-flex justify-content-center time-zone">
                            <span class="me-2">Wednesday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="d-flex justify-content-center time-zone">
                            <span class="me-2">Thursday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="d-flex justify-content-center time-zone">
                            <span class="me-2">Friday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="d-flex justify-content-center time-zone">
                            <span class="me-2">Saturday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="vcard-three__contact py-4 position-relative">
            <img src="https://vcards.infyom.com/assets/img/vcard3/vcard3-shape3.png" alt="shape" class="position-absolute start-0 bottom-0"/>
            <div class="container">
                <h4 class="vcard-three-heading heading-line position-relative text-center">Contact Us</h4>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="contact-form px-sm-5">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" placeholder="Full Name">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" placeholder="E-mail Address">
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control" id="mobile" placeholder="Mobile Number">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Type a message here..." id="message"
                                          rows="5"></textarea>
                            </div>
                            <button type="button" class="contact-btn text-white mt-4 d-block mx-auto">Send Message
                            </button>
                        </div>
                        <div class="d-sm-flex justify-content-center my-5">
                            <button type="submit" class="vcard-three-btn text-white mt-4 d-block">
                                <i class="fas fa-download me-2"></i> Download Vcard
                            </button>

                            <button type="button" class="share-btn text-white d-block btn mt-4">
                                <a href="#" class="text-white text-decoration-none">
                                    <i class="fas fa-share-alt me-2"></i> Share</a>
                            </button>
                        </div>
                        <br>
                        <div class="m-2 ">
                            <iframe width="100%" height="300px"
                                    src='https://maps.google.de/maps?q=White+House,+TN,+USA/&output=embed'
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                    style="border-radius: 10px;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://vcards.infyom.com/front/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://vcards.infyom.com/assets/js/front-third-party.js"></script>
<script src="https://vcards.infyom.com/assets/js/slider/js/slick.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    $('.testimonial-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        autoplay: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1
    });
</script>

<script>
    $('.product-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 2,
        autoplay: true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }
        ]
    });

    $('.blog-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1,
        autoplay: true,
        slidesToScroll: 1
    });
</script>
<script>
    $("#myID").flatpickr();
</script>

<script>
    $('.gallery-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 2,
        autoplay: true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }
        ]
    });
</script>

<script>
    $(document).ready(function () {
        $('.dropdown1').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
        });
    });
</script>
<script>
    const createStyleElementFromCSS = () => {
        // JSFiddle's custom CSS is defined in the second stylesheet file
        const sheet = document.styleSheets[1];

        const styleRules = [];
        for (let i = 0; i < sheet.cssRules.length; i++)
            styleRules.push(sheet.cssRules.item(i).cssText);

        const style = document.createElement('style');
        style.type = 'text/css';
        style.appendChild(document.createTextNode(styleRules.join(' ')))

        return style;
    };
    const style = createStyleElementFromCSS();

    const download = () => {
        // fetch SVG-rendered image as a blob object
        const svg = document.querySelector('.qr-code-scanner svg');
        svg.insertBefore(style, svg.firstChild); // CSS must be explicitly embedded
        const data = (new XMLSerializer()).serializeToString(svg);
        const svgBlob = new Blob([data], {
            type: 'image/svg+xml;charset=utf-8'
        });
        style.remove(); // remove temporarily injected CSS

        // convert the blob object to a dedicated URL
        const url = URL.createObjectURL(svgBlob);

        // load the SVG blob to a flesh image object
        const img = new Image();
        img.addEventListener('load', () => {
            // draw the image on an ad-hoc canvas
            const bbox = svg.getBBox();

            const canvas = document.createElement('canvas');
            canvas.width = bbox.width;
            canvas.height = bbox.height;

            const context = canvas.getContext('2d');
            context.drawImage(img, 0, 0, bbox.width, bbox.height);

            URL.revokeObjectURL(url);

            // trigger a synthetic download operation with a temporary link
            const a = document.createElement('a');
            a.download = '{{$vcard->slug}}'+'.png';
            document.body.appendChild(a);
            a.href = canvas.toDataURL();
            a.click();
            a.remove();
        });
        img.src = url;
    };

</script>
</body>
</html>
