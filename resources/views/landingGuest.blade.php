@extends('layout')
@section('content')
    <section id="hero" class="pb-0">
        {{-- <object id="svg-hero" data="assets/svg/undraw_work_time_re_hdyv.svg" type="image/svg+xml"></object> --}}
        {!! file_get_contents('assets/svg/svg1.svg') !!}
        {!! file_get_contents('assets/svg/svg2.svg') !!}
        <div class="position-absolute" style="height:100%">
            <div class="d-flex flex-column h4 position-sticky" style="margin-left:-1em;top:50%">
                <a href="https://www.instagram.com/mindspaze.qa/" class="my-3" style="width:fit-content"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://github.com/Priananda620/MindSpaze-Laravel" class="my-3" style="width:fit-content"><i class="fa-brands fa-github"></i></a>
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
                @auth
                    <form method="GET" action="{{url('/threads')}}">
                        <input type="search" name="query" class="bg-inherit-text" placeholder="search mindspaze for topics..." value="" required="">
                    </form>
                @endauth
                
                <p>
                    Hello there — <span class="fw-bold">MindSpaze AI</span> is
                    a fully featured web and app platform for finding your right answer. Browse thousands of threads
                    and start expanding your knowledge to the higest.
                </p>


                @auth
                    <div id="hero-buttons-wrap" class="d-inline-flex mt-3">
                        <a href="{{url('/threads')}}" class="button me-2">Explore Threads</a>
                        <a class="button me-2 logout-action" href="{{url('/about')}}">About</a>
                    </div>
                @else
                    <div id="hero-buttons-wrap" class="d-inline-flex mt-3">
                        <a id="login-hero-btn" class="button me-2 login-show">Login</a>
                        <a id="register-hero-btn" class="button register-show">Register</a>
                        {{-- {{url("register")}} --}}
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
		<div class="d-flex justify-content-center flex-column text-center part2-center pb-5">
			<h2 class="display-font-color">
			Ideas that can go anywhere
			</h2>
			<p class="display-font-color">
			Knowledge isn’t static — what should your curiousity be? We provide with the tools you rely on every day to keep information and conversations up-to-date, turning curiousity into interaction.
			</p>

		</div>
		<div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 g-6">
            <div class="col mt-5">
				<div class="part2-card" style="margin-right:1em">
					<h2>Start Using<br>Our Services</h2>
					<p class="display-font-color">Start participating in our spaze now. You can start by exploring. And say hi to everyone if you have logged in 👋</p>
					<p class="display-font-color" onclick="location.href='{{url('/threads')}}'"><strong>View Threads</strong>&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></p>
				</div>
            </div>
            <div class="col mt-5">
				<div class="part2-card">
					<h2>Meet Our Team</h2>
					<p class="display-font-color">How do we keep up in a modern workplace? Collaboratively building and sharing beautiful peace of work that combines design and logical thinking that outcomes indispensable things.</p>
					<p class="display-font-color" onclick="location.href='about'"><strong>Learn More</strong>&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-right"></i></p>
				</div>
            </div>
		</div>
    </section>
    <section id="heading-landing-text" >
        <p class="pb-2 display-font-color">Take a look of our cards design.</p>
    </section>
    <section id="threads-with-filter">
        <div>
            <div class="filter-header d-flex flex-row align-items-center">
                <div class="dropdown me-3">
                    <input type="hidden" id="selected-option">
                    <button selected-value="Latest" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Latest
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" data-value="Latest">Latest</a></li>
                        <li><a class="dropdown-item" data-value="Unanswered">Unanswered</a></li>
                        <li><a class="dropdown-item" data-value="Popular">Popular</a></li>
                        <li><a class="dropdown-item" data-value="Answered">Answered</a></li>
                        <li><a class="dropdown-item" data-value="Featured">Featured</a></li>
                        <li><a class="dropdown-item" data-value="Flagged">Flagged</a></li>
                    </ul>
                </div>
                <div id="chips-filter" class="overflow-scroll d-flex hide-scrollbar1 hide-scrollbar2">
                    <button class="badge bg-dark">Celebrities</button>
                    <button class="badge bg-dark">World</button>
                    <button class="badge bg-dark">Finance</button>
                    <button class="badge bg-dark">Automotive</button>
                    <button class="badge bg-dark">Business</button>
                    <button class="badge bg-dark">Animals</button>
                    <button class="badge bg-dark">Technology</button>
                    <button class="badge bg-dark">Sports</button>
                    <button class="badge bg-dark">Politics</button>
                    <button class="badge bg-dark">Health</button>
                    <button class="badge bg-dark">Science</button>
                    <button class="badge bg-dark">Entertainment</button>
                    <button class="badge bg-dark">Travel</button>
                    <button class="badge bg-dark">Food</button>
                    <button class="badge bg-dark">Fashion</button>

                </div>
            </div>
            <div class="my-5">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col">
                        <div class="card position-relative w-100">
                            <div class="card-body">
                                {{-- background-image:url('{{asset('storage/assets/user_images/')}}/{{'default.jpg'}}') --}}
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">John Doe</h6>
                                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                </div>
                                <h5 class="card-title">Is the moon landing a hoax perpetrated by NASA?</h5>
                                <div class="d-inline-flex">
                                    <h6 class="card-subtitle text-muted mb-2">2 days ago</h6>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">5 answers</span>
                                    <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card position-relative w-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">Jane Smith</h6>
                                </div>
                                <h5 class="card-title">Did the government fake the 9/11 terrorist attacks?</h5>
                                <div class="d-inline-flex">
                                    <h6 class="card-subtitle text-muted mb-2">1 day ago</h6>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">3 answers</span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card position-relative w-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">Robert Johnson</h6>
                                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                </div>
                                <h5 class="card-title">Was the Sandy Hook school shooting a staged event with actors?</h5>
                                <div class="d-inline-flex">
                                    <h6 class="card-subtitle text-muted mb-2">3 hours ago</h6>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">8 answers</span>
                                    <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card position-relative w-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">Sarah Thompson</h6>
                                </div>
                                <h5 class="card-title">Are chemtrails sprayed by airplanes part of a secret government mind-control experiment?</h5>
                                <div class="d-inline-flex">
                                    <h6 class="card-subtitle text-muted mb-2">6 hours ago</h6>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">2 answers</span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card position-relative w-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">David Wilson</h6>
                                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                </div>
                                <h5 class="card-title">Is climate change a conspiracy created by scientists for personal gain?</h5>
                                <div class="d-inline-flex">
                                    <h6 class="card-subtitle text-muted mb-2">4 days ago</h6>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">7 answers</span>
                                    <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card position-relative w-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">Emily Davis</h6>
                                </div>
                                <h5 class="card-title">Did a secret society control the outcome of the 2020 presidential election?</h5>
                                <div class="d-inline-flex">
                                    <h6 class="card-subtitle text-muted mb-2">1 week ago</h6>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">4 answers</span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card position-relative w-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">Michael Johnson</h6>
                                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                </div>
                                <h5 class="card-title">Is the COVID-19 vaccine secretly implanting microchips in people?</h5>
                                <div class="d-inline-flex">
                                    <h6 class="card-subtitle text-muted mb-2">2 weeks ago</h6>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">6 answers</span>
                                    <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card position-relative w-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">Olivia Anderson</h6>
                                </div>
                                <h5 class="card-title">Was the death of Princess Diana a planned assassination by the British royal family?</h5>
                                <div class="d-inline-flex">
                                    <h6 class="card-subtitle text-muted mb-2">3 weeks ago</h6>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">9 answers</span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                                                                                                                        

            {{-- <nav aria-label="...">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav> --}}
        </div>
    </section>


    

    <section id="heading-landing-text" class="display-font-color">
        <p>Interested? To view more existing threads you can proceed registering into our platform first.</p>
    </section>

@endsection
