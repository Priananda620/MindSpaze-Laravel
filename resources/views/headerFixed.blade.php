<header>
    <div id="header" class="d-flex align-items-center justify-content-between">

        <div id="header-inner-left">
            <div class="logo">
                {{-- <img src="{{ asset('assets/logo/logo48.png') }}"> --}}
                <a href="{{url('/')}}">
                    <h1 class="fw-bold d-flex align-items-center">
                        <span>{!! file_get_contents('assets/logo/svgMindspaze.svg') !!}</span>
                        <span style="color:#f5bc00" class="position-relative">
                            Mind
                            <p>AI Integrated</p>
                        </span>
                        <span class="logoSpaZe">Spaze</span></h1>
                </a>

            </div>
        </div>
        <div class="spacer-left mx-2"></div>
        <div id="search-box" class="d-flex align-items-center">
            <h4 class="my-0">Written In&nbsp;&nbsp;<i class="fa-brands fa-python"></i>&nbsp;<i class="fa-brands fa-laravel"></i></h4>
        </div>
        <div class="d-flex flex-row me-3 position-relative" id="header-nav">
            <form method="GET">
                <input id="search-input" type="search" name="search-query" class="bg-inherit-text form-control ds-input" placeholder="search mindspaze..." value="" required="">
            </form>
            <div class="suggestion-container p-4 d-none rounded-3">
                <div id="suggestion-list" class="suggestion-list"></div>
            </div>
        </div>
        @auth

            <div>
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

            {{-- <div class="d-flex flex-row me-3">
                <a class="button me-2 border-btn" href="{{url("login")}}">Login</a>
                <a class="button" href="{{url("register")}}">Register</a>
            </div> --}}

            <div class="d-flex flex-row me-3">
                <div class="p-1 user-avatar-wrap d-flex flex-row align-items-center justify-content-center position-relative">
                    <div class="user-avatar-rounded me-2" style="background-image:url('{{asset('assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg')}}')"></div>
                    <p class="mb-0 me-2">azhar620</p>
                    <div id="user-dropdown-wrap" class="position-absolute p-0 d-flex align-items-center justify-content-center">
                        <ul class="p-0 m-0 d-flex justify-content-start flex-column">
                            <li>
                                My Profile
                            </li>
                            <li>
                                Add Question 
                            </li>
                            <li>
                                Account Settings
                            </li>
                            <li>
                                Help Answer Questions
                            </li>
                            <li>
                                Sign Out
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="d-flex flex-row me-3">
                <a href="" class="h3 m-0">
                    <i class="fa-solid fa-square-plus"></i>
                </a>
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
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</header>


