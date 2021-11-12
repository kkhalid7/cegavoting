<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('images/avatar.png')}}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <!-- Menu Footer-->
                <li class="dropdown-item">
{{--                <li class="fas fa-key ml-4"></li>--}}
{{--                <a class="btn" href="">--}}
{{--                    {{ __('Change Password') }}--}}
{{--                </a>--}}
{{--                </li>--}}
{{--                <li class="dropdown-divider"></li>--}}
                <li class="dropdown-item">
{{--                <li class="fas fa-user-circle ml-4"></li>--}}
{{--                <a class="btn" href="">--}}
{{--                    {{ __('Profile') }}--}}
{{--                </a>--}}
{{--                </li>--}}
{{--                <li class="dropdown-divider"></li>--}}
                <li class="dropdown-item">
                <li class="fas fa-sign-out-alt ml-4"></li>
                <a class="btn" href="{{ route('admin::logout') }}">
                    {{ __('Logout') }}
                </a>
                </li>
                <li class="dropdown-divider"></li>
            </ul>
        </li>
    </ul>
</nav>
