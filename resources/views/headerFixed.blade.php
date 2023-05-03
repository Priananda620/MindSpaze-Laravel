<header class="d-flex align-items-center justify-content-between">
    <div id="header-inner-left">
        <div class="logo">
            <a href="{{url('/')}}">
                <h1 class="fw-bold d-flex align-items-center"><span><img src="{{ asset('assets/logo/logo48.png') }}"></span>My Tutor</h1>
            </a>
            <p>by Priananda</p>
        </div>
    </div>
    <div class="spacer-left mx-3"></div>
    <div id="search-box" class="d-flex align-items-center">
        <h4 class="my-0">For Tutors&nbsp;&nbsp;<i class="fa-brands fa-laravel"></i></h4>
    </div>

    @auth

        <div id="header-nav">
            <ul class="d-inline-flex" style="visibility: collapse">
                <li><a href="index.php#view-subjects">courses</a></li>
                <li><a href="tutor.php#view-tutors">tutors</a></li>
                <li><a>subscription</a></li>
                <li><a>profile</a></li>
            </ul>
        </div>

        <a class="button me-2" href="{{url('/logout')}}">Logout</a>
        {{-- <div class="user-avatar-rounded me-2" style="background-image:url('assets/tutors/{{auth()->user()->id}}.jpg')"></div> --}}
    @else

        <div id="header-nav" class="d-inline-flex align-items-center">
            <p class="mb-0 me-2">Not Logged In</p>
            <a class="button me-2 login-show" style="visibility: collapse">Login</a>
            <a class="button me-2 register-show" style="visibility: collapse">Register</a>
        </div>

    @endauth
    <div id="header-inner-right">
        <div class="dark-switch">
            <input id="dark-switch-input" type="checkbox" checked="">
            <label for="dark-switch-input"></label>
        </div>
    </div>
</header>


