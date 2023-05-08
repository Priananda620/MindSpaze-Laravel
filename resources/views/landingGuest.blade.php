@extends('layout')
@section('content')
    <section id="hero" class="pb-0">
        {!! file_get_contents('assets/svg/svg1.svg') !!}
        {!! file_get_contents('assets/svg/svg2.svg') !!}
        <div class="position-absolute" style="height:100%">
            <div class="d-flex flex-column h4 position-sticky" style="margin-left:-1em;top:50%">
                <a href="" class="my-3" style="width:fit-content"><i class="fa-brands fa-instagram"></i></a>
                <a href="" class="my-3" style="width:fit-content"><i class="fa-brands fa-github"></i></a>
                <a href="" class="my-3" style="width:fit-content"><i class="fa-solid fa-envelope"></i></a>
            </div>
        </div>
        
        <div class="d-flex justify-content-around align-items-center">

            <div id="landing-display-text">

                <h1 class="fw-bold">
                    <span>Hello There,</span><br>
                    <span class="red-backdrop">We Are Now</span><br>
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
                <form method="GET">
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

    <section class="pb-0">
        <div id="divider_content">
            <div id="divider_transparentBg"></div>
            <div id="divider" uk-parallax="y:80%;easing:0.7;opacity:.8" style="transform: translate3d(0px, 20.08%, 0px); opacity: 0.95;">
                <div id="divider_background" style="background-position-x: 0%;background-position-y: 0%;background-repeat: repeat;background-size: auto;background: url({{ asset('assets/resource/divider_bg.png') }});">
                </div>
            </div>
        </div>
    </section>

    <section id="part2">
        <div class="d-flex flex-row align-items-center">
			<div>
				<h2>
					Work on your curiosity — we’ll <div style="display: inline-block;"><span class="red-backdrop">take&nbsp;care</span></div> of the rest.
				</h2>
				
			</div>
			<div>
				{!! file_get_contents('assets/svg/svg11.svg') !!}
			</div>
        </div>
		<div class="d-flex flex-row align-items-center">
			<div class="d-flex justify-content-end">
				{!! file_get_contents('assets/svg/svg12.svg') !!}
			</div>
			<div>
				<h2>
					There are <div style="display: inline-block;"><span class="red-backdrop">no&nbsp;limits</span></div> to how and with whom — you can ask. 
				</h2>
				<p></p>
			</div>
        </div>
		<div class="d-flex justify-content-center flex-column text-center part2-center">
			<h2>
			Ideas that can go anywhere
			</h2>
			<p>
			Knowledge isn’t static — what should your curiousity be? We provide with the tools you rely on every day to keep information and conversations up-to-date, turning curiousity into interaction.
			</p>
			
		</div>
		<div class="d-flex flex-row justify-content-center mt-5">
				<div class="part2-card" style="margin-right:1em">
					<h2>Start Using<br>Our Services</h2>
					<p>Start participating in our spaze now. You can start by exploring. And say hi to everyone if you have logged in 👋</p>
					<p onclick="location.href='questions.php?latest=true'"><strong>View Latest Question</strong>&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></p>
				</div>
				<div class="part2-card">
					<h2>Meet Our Team</h2>
					<p>How do we keep up in a modern workplace? Collaboratively building and sharing beautiful peace of work that combines design and logical thinking that outcomes indispensable things.</p>
					<p onclick="location.href='about.php'"><strong>Learn More</strong>&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></p>
				</div>
			</div>
    </section>



    <section id="heading-landing-text">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tempor, libero varius vulputate rhoncus, purus leo finibus neque, sed elementum dolor quam vel tortor.  </p>
    </section>
@endsection
