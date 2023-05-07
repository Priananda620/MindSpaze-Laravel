@extends('layout')
@section('content')
    <section id="hero" class="pb-0">
        {!! file_get_contents('assets/svg/svg1.svg') !!}
        {!! file_get_contents('assets/svg/svg2.svg') !!}
        <div class="d-flex flex-column h4 position-absolute" style="margin-left:-1em;top:50%">
            <a href="" class="my-3"><i class="fa-brands fa-instagram"></i></a>
            <a href="" class="my-3"><i class="fa-brands fa-github"></i></a>
            <a href="" class="my-3"><i class="fa-solid fa-envelope"></i></a>
        </div>
        <div class="d-flex justify-content-around align-items-center">

            <div id="landing-display-text">

                <h1 class="fw-bold">
                    <span>Hello There,</span><br>
                    <span>We Are Now</span><br>
                    <!-- <span>Service</span><br> -->
                    <span>
                        AI&nbsp;
                        <span>
                            <span>E</span>
                            <span class="hero-text-double">E</span>
                        </span>
                        <span>
                            <span>q</span>
                            <span class="hero-text-double">q</span>
                        </span>
                        <span>
                            <span>u</span>
                            <span class="hero-text-double">u</span>
                        </span>
                        <span>
                            <span>i</span>
                            <span class="hero-text-double">i</span>
                        </span>
                        <span>
                            <span>p</span>
                            <span class="hero-text-double">p</span>
                        </span>
                        <span>
                            <span>p</span>
                            <span class="hero-text-double">p</span>
                        </span>
                        <span>
                            <span>e</span>
                            <span class="hero-text-double">e</span>
                        </span>
                        <span>
                            <span>d</span>
                            <span class="hero-text-double">d</span>
                        </span>
                    </span><br>
                    <div></div>

                </h1>
                <form action="questions.php" method="GET">
                    <input type="search" name="search-query" class="bg-inherit-text" placeholder="search mindspace for topics..." value="" required="">
                </form>
                <p>
                    Hello there — <span class="fw-bold">MindSpaze AI</span> is
                    a fully featured web and app platform for finding your right answer. Browse thousands of threads
                    and start expanding your knowledge to the higest.
                </p>


                @auth
                    <div id="hero-buttons-wrap" class="d-inline-flex mt-3">
                        <a href="#view-subjects" class="button me-2">View Subjects</a>
                        <a class="button me-2 logout-action" href="api/logout.php">Logout</a>
                    </div>
                @else
                    <div id="hero-buttons-wrap" class="d-inline-flex mt-3">
                        <a class="button me-2" href="{{url("login")}}">Login</a>
                        <a class="button" href="{{url("register")}}">Register</a>
                    </div>
                @endauth
            </div>

            <div class="d-flex align-items-center px-2 justify-content-center" id="hero-right">
                <object id="svg-hero" data="assets/svg/undraw_work_time_re_hdyv.svg" type="image/svg+xml"></object>

            </div>
        </div>
    </section>

    <section id="heading-landing" class="pb-0" style="padding-top: 8em;">
        <h2>Tutor course manager</h2>
    </section>



    <section id="heading-landing-text">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tempor, libero varius vulputate rhoncus, purus leo finibus neque, sed elementum dolor quam vel tortor.  </p>
    </section>
@endsection
