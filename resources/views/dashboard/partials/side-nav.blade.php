@php
$currentRoute = Route::currentRouteName();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.welcome')}}" class="brand-link">
      <img src="{{asset('public/back-end')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset(Vcards::getVcard(Auth::user()->id)->profile_img  ? : 'public/front-end/templates/images/avatar7.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
{{--      <div class="form-inline">--}}
{{--        <div class="input-group" data-widget="sidebar-search">--}}
{{--          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--          <div class="input-group-append">--}}
{{--            <button class="btn btn-sidebar">--}}
{{--              <i class="fas fa-search fa-fw"></i>--}}
{{--            </button>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard.welcome')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
{{--          <li class="nav-item">--}}
{{--            <a href="pages/widgets.html" class="nav-link">--}}
{{--              <i class="nav-icon fas fa-th"></i>--}}
{{--              <p>--}}
{{--                Widgets--}}
{{--                <span class="right badge badge-danger">New</span>--}}
{{--              </p>--}}
{{--            </a>--}}
{{--          </li>--}}
            @if(Auth::user()->role == 1)
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-sitemap "></i>
              <p>
                Portfolio Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('portfolio_category.index')}}" class="nav-link {{ $currentRoute == 'portfolio_category.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("portfolio_category.create")}}" class="nav-link {{ $currentRoute == 'portfolio_category.create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
            @endif
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa fa-plus-square nav-icon"></i>
              <p>
                Portfolios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('portfolio.index')}}" class="nav-link {{ $currentRoute == 'portfolio.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Portfolio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("portfolio.create")}}" class="nav-link {{ $currentRoute == 'portfolio.create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa fa-briefcase nav-icon" aria-hidden="true"></i>
              <p>
                Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('service.index')}}" class="nav-link {{ $currentRoute == 'service.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("service.create")}}" class="nav-link {{ $currentRoute == 'service.create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Service</p>
                </a>
              </li>
            </ul>
          </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa fa-comments nav-icon" aria-hidden="true"></i>
              <p>
                Testimonials
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('testimonial.index')}}" class="nav-link {{ $currentRoute == 'testimonial.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Testimonial</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("testimonial.create")}}" class="nav-link {{ $currentRoute == 'testimonial.create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Testimonial</p>
                </a>
              </li>
            </ul>
          </li>
            @if(Auth::user()->role == 1)
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa fa-building nav-icon" aria-hidden="true"></i>
              <p>
                Companies
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('company.index')}}" class="nav-link {{ $currentRoute == 'company.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Company</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("company.create")}}" class="nav-link {{ $currentRoute == 'company.create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Company</p>
                </a>
              </li>
            </ul>
          </li>
            @endif
            @if(Auth::user()->role <= 2)
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa fa-users nav-icon" aria-hidden="true"></i>
              <p>
                Staffs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('staff.index')}}" class="nav-link {{ $currentRoute == 'staff.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("staff.create")}}" class="nav-link {{ $currentRoute == 'staff.create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Staff</p>
                </a>
              </li>
            </ul>
          </li>
            @endif
            @if(Auth::user()->role == 1)
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa fa-paint-brush nav-icon" aria-hidden="true"></i>
              <p>
                Templates
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('template.index')}}" class="nav-link {{ $currentRoute == 'template.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Template</p>
                </a>
              </li>
            </ul>
          </li>
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa fa-address-card nav-icon" aria-hidden="true"></i>
                    <p>
                        Vcard Profile
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('profile.index')}}" class="nav-link {{ $currentRoute == 'profile.index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('vcard.index', Auth::user()->id)}}" class="nav-link {{ $currentRoute == 'vcard.index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vcard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a target="_blank" href="{{route("vcard.preview")}}" class="nav-link {{ $currentRoute == 'vcard.preview' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Preview Vcard</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<script>
    document.addEventListener("DOMContentLoaded", ()=> {
        const activeItem = document.querySelector(".nav-link.active");
        if(activeItem != null){
            activeItem.parentElement.parentElement.parentElement.classList.add("menu-open");
        }
    });
</script>
