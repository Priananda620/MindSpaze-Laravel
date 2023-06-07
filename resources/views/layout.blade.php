
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MindSpaze</title>

    @include('headLinks')
    @yield('aditionalHead')
</head>


<body class="t">

    {{-- @yield('loginRegister') --}}
    {{-- @yield('addCourse') --}}
    <div id="overlay-outter" class="d-flex position-fixed align-items-start hide-scrollbar1 hide-scrollbar2">
        <div id="overlay-wrapper" class="p-4">

            <div class="xmark-button">
                <button class="float-end"><i class="fa-solid fa-xmark"></i></button>
            </div>

            @include('login')
            @include('register')

        </div>
    </div>

    <div id="full-page-container">


        @include('headerFixed')



        @yield('content')


        {{-- <section id="section-2" class="section-child py-5 mt-5 container mb-4"> --}}
            {{-- <svg width="720" height="480" viewBox="0 0 1360 578" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="illustration-01">
                        <stop stop-color="#FFF" offset="0%"></stop>
                        <stop stop-color="#EAEAEA" offset="77.402%"></stop>
                        <stop stop-color="#DFDFDF" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <g fill="url(#illustration-01)" fill-rule="evenodd">
                    <circle cx="1232" cy="128" r="128"></circle>
                    <circle cx="155" cy="443" r="64"></circle>
                </g>
            </svg> --}}
            {{-- <div class="d-flex justify-content-center">
                <h2 class="fw-bold text-center px-2">Take a look at our threads.</h2>
            </div>
            <div class="mt-1 text-center section-text">
                <p class="mb-4 text-muted-color">For more details — you can click button provided below</p>
                <a style="width: 15em; margin:auto" class="button"
                    href="https://www.linkedin.com/in/priananda-azhar/" target="_blank"
                    rel="noopener noreferrer">BROWSE</a>
            </div>
        </section> --}}
        <section id="section-2" class="section-child py-5 mt-5 container mb-4 px-5">
            <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-9">
                <div class="left-content">
                    <h2 class="fw-bold text-center text-lg-start text-md-start text-sm-center">Take a look at our threads</h2>
                    <p class="text-muted-color fw-bold text-center text-lg-start text-md-start text-sm-center">For more details — you can click button provided here.</p>
                </div>
                </div>
                <div class="col-md-2">
                <div class="right-content d-flex justify-content-center align-items-center h-100">
                    {{-- <button class="btn btn-primary">Button</button> --}}
                    <a style="width: 15em; margin:auto" class="button"
                    href="{{url('/threads')}}" target="_blank"
                    rel="noopener noreferrer">BROWSE</a>
                </div>
                </div>
            </div>
            </div>
        </section>



        @include('footer')
    </div>
    <div id="fixed-botton-right" class="p-3">
        <div id="pushToast" class="toast fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              {{-- <img src="..." class="rounded me-2" alt="..."> --}}
              <div class="me-2" id="pushIcon"></div>
              <strong class="me-auto" id="pushTitle">Bootstrap</strong>
              <small class="text-muted" id="pushAgo">11 mins ago</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="pushBody">
              Hello, world! This is a toast message.
            </div>
          </div>
    </div>
    <div id="backdrop-close-evoke">

    </div>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js'></script>
</html>
