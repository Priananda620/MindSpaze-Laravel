<header>
    <div id="header" class="d-flex align-items-center justify-content-between">

        <div id="header-inner-left">
            <div class="logo">
                {{-- <img src="{{ asset('assets/logo/logo48.png') }}"> --}}
                <a href="{{url('/')}}">
                    <h1 class="fw-bold d-flex align-items-center">
                        <span>{!! file_get_contents('assets/logo/svgMindspaze.svg') !!}</span>
                        <span style="color:#f5bc00" class="position-relative logo-mind">
                            Mind
                            <p>AI Integrated</p>
                        </span>
                        <span class="logoSpaZe logo-spaze">Spaze</span></h1>
                </a>

            </div>
        </div>
        <div class="spacer-left mx-2"></div>
        <div id="written-by" class="d-flex align-items-center">
            <h4 class="my-0">Written In&nbsp;&nbsp;<i class="fa-brands fa-python"></i>&nbsp;<i class="fa-brands fa-laravel"></i></h4>
        </div>
        <div class="d-flex flex-row me-3 position-relative" id="header-nav">
            <form method="GET" action="{{url('/threads')}}">
                <input id="search-input" type="search" name="query" class="bg-inherit-text form-control ds-input" placeholder="search mindspaze..." value="" required="">
            </form>
            <div class="suggestion-container p-4 d-none rounded-3">
                <h5 class="start-typing-h5">Start typing to see results...</h5>
                <div id="suggestion-list" class="suggestion-list">
                </div>
            </div>
        </div>
        @auth


            <div class="d-flex flex-row me-3">
                <div class="p-1 user-avatar-wrap d-flex flex-row align-items-center justify-content-center position-relative">
                    <div class="user-avatar-rounded" style="background-image:url('{{asset('assets/user_images/'.auth()->user()->user_profile_img)}}')"></div>
                    <p id="username-header" class="mb-0 me-2 ms-2">{{ auth()->user()->username }}</p>
                    <div id="user-dropdown-wrap" class="position-absolute p-0 d-flex align-items-center justify-content-center">
                        <ul class="p-0 m-0 d-flex justify-content-start flex-column">
                            <li>
                                <a href="{{url('/profile').'/'.auth()->user()->username}}">My Profile</a>
                            </li>
                            <li>
                                <a href="{{url('/add-question')}}">Add Question</a>
                            </li>
                            <li>
                                <a href="{{url('/profile').'/'.auth()->user()->username}}">Account Settings</a>
                            </li>
                            <li>
                                <a href="{{url('/threads')}}">Browse Threads</a>

                            </li>
                            <li>
                                <a class="logout-action" href="{{url('/logout')}}">Sign Out</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="d-flex flex-row me-3">
                <a href="{{url('/add-question')}}" class="h3 m-0">
                    <i class="fa-solid fa-square-plus"></i>
                </a>
            </div>

            <a class="button me-2 logout-action" href="{{url('/logout')}}">Logout</a>
            {{-- <div class="user-avatar-rounded me-2" style="background-image:url('assets/tutors/{{auth()->user()->id}}.jpg')"></div> --}}
        @else

            <div class="d-flex flex-row me-3">
                <a class="button me-2 border-btn login-show">Login</a>
                <a class="button register-show">Register</a>
            </div>


        @endauth
        <div id="header-inner-right">
            <div class="dark-switch">
                <input id="dark-switch-input" type="checkbox" checked="true">
                <label for="dark-switch-input"></label>
            </div>
        </div>

    </div>
    <div class="progress" style="height: .5em;">
        <div class="progress-bar progress-bar-striped progress-bar-animated opacity-0" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</header>


