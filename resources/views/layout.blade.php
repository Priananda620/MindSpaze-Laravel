
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tutor | Priananda </title>

    @include('headLinks')
</head>


<body>

    @yield('loginRegister')
    @yield('addCourse')


    <div id="full-page-container">


        @include('headerFixed')



        @yield('content')


        <section id="section-2" class="section-child py-5">
            <svg width="720" height="480" viewBox="0 0 1360 578" xmlns="http://www.w3.org/2000/svg">
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
            </svg>
            <div class="d-flex justify-content-center">
                <h2 class="fw-bold text-center px-2">More Details?</h2>
            </div>
            <div class="mt-5 text-center section-text">
                <p>For more details you can visit my linkedin links — provided below</p>
                <a style="width: 15em; margin:auto" class="button"
                    href="https://www.linkedin.com/in/priananda-azhar/" target="_blank"
                    rel="noopener noreferrer">Linkedin</a>
            </div>
        </section>



        @include('footer')
    </div>
</body>

</html>
