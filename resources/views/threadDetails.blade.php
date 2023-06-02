@extends('layout')
@section('content')
    <script src="//cdn.quilljs.com/1.0.0/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <section id="thread-details" class="m-5">
        <div class="d-flex flex-row my-5 justify-content-center">

            <div id="thread-contents-left">
                <div class="thread-contents-header">
                    <h2 style="line-height: 1.5em;" class="pb-3 fw-bold">Question Details<div class="divider"></div>
                    </h2>
                    <div class="user-wrapper"
                        style="background-image:url({{ asset('assets/user_images/1111111_3452fd55-fff9-4a4a-8b9b-832ba3c0e1fc.png') }})">
                        <a class="d-flex align-items-center" href="profile.php?user_id=555">
                            <div class="image-evoke-update image-form-evoke user-avatar-rounded"
                                style="background-image:url({{asset('assets/user_images/1111111_3452fd55-fff9-4a4a-8b9b-832ba3c0e1fc.png')}})">
                            </div>
                            <div class="user-data">
                                <h5><span class="unfocus-text fw-bold">by</span> jkhe.yyy</h5>
                                <p class="unfocus-text m-0 fw-bold">on November 11</p>
                            </div>
                        </a>
                        <div class="afterMenu">
                            <div class="hamburger-icon hamburgerMenu-toggler">
                                <a class="p-3 cursor-pointer">
                                    <i class="fa-solid fa-ellipsis-vertical fw-bold fs-2"></i>
                                </a>
                            </div>
                            <div class="collapse navbar-collapse position-absolute bg-lifted" id="hamburgerMenu">
                                <ul class="navbar-nav p-2">
                                    <li class="nav-item m-1">
                                        <a href="#" class="p-2"><i class="fa-solid fa-share-nodes"></i></a>
                                    </li>
                                    <li class="nav-item m-1">
                                        <a href="#" class="p-2"><i class="fa-solid fa-trash"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>

                    <div class="mb-3 d-flex flex-row">
                        <button class="btn btn-secondary" type="disabled">
                            <i class="fa-solid fa-tags"></i>
                        </button>
                        <div class="overflow-scroll d-flex hide-scrollbar1 hide-scrollbar2 tags-badge">
                            <button class="badge bg-dark">Primary</button>
                            <button class="badge bg-dark">Secondary</button>
                            <button class="badge bg-dark">Success</button>
                            <button class="badge bg-dark">Danger</button>
                            <button class="badge bg-dark">Warning</button>
                            <button class="badge bg-dark">Info</button>
                            <button class="badge bg-dark">Light</button>
                            <button class="badge bg-dark">Dark</button>
                            <button class="badge bg-dark">Primary</button>
                            <button class="badge bg-dark">Secondary</button>
                            <button class="badge bg-dark">Success</button>
                            <button class="badge bg-dark">Danger</button>
                            <button class="badge bg-dark">Warning</button>
                            <button class="badge bg-dark">Info</button>
                            <button class="badge bg-dark">Light</button>
                            <button class="badge bg-dark">Dark</button>
                            <button class="badge bg-dark">Secondary</button>
                            <button class="badge bg-dark">Success</button>
                            <button class="badge bg-dark">Danger</button>
                            <button class="badge bg-dark">Warning</button>
                            <button class="badge bg-dark">Info</button>
                            <button class="badge bg-dark">Light</button>
                            <button class="badge bg-dark">Dark</button>
                        </div>
                    </div>
                    <h2 class="lh-sm border-start border-3 ps-3">A very serious question </h2>

                    <div class="ql-snow">
                        <div class="ql-editor p-0" id="question-content" contenteditable="false">
                            <h1><strong>Heading</strong></h1><p>Lorem ipsum dolor sit amet, <em>consectetur adipiscing elit</em>, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat?</p><p><br></p><ul><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li></ul><p><br></p><blockquote>Code here</blockquote><pre spellcheck="false">function backdropCloseEvokeHide() {
                                &nbsp; &nbsp; const backdropCloseEvoke = $("#backdrop-close-evoke")
                                &nbsp; &nbsp; backdropCloseEvoke.removeClass('semi-transparent-bg')
                                &nbsp; &nbsp; setTimeout(function () {
                                &nbsp; &nbsp; &nbsp; &nbsp; backdropCloseEvoke.removeClass('visibility-visible')
                                &nbsp; &nbsp; }, 380);
                                }
                                </pre><h2><br></h2><h2>Image</h2><p><br></p><p><img src="data:image/png;base64,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"></p>
                        </div>
                    </div>
                    {{-- <img style="padding: 0 0 1.5em 0; line-height: 1.5em; width:50%;"
                        src="asset/question_images/98f51a29-df07-48af-925b-9f1ded257bee.jpeg"> --}}
                    <div id="answer-detail-wrapper" class="mt-3">
                        <div id="ans-count">2 answers</div>
                        {{-- <a class="button small-bth" id="login-to-answer-btn"
                            style="font-family:inherit; padding: 0.4em 1em; font-size: 11px; font-weight: unset; border-radius: unset; letter-spacing: unset; line-height: unset">
                            <i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;login to add answer
                        </a> --}}
                        <a class="button small-bth" id="add-answer-btn">
                            <i class="fas fa-pen-square"></i>&nbsp;&nbsp;Add Answer                                <!-- <i class="fas fa-pen-square"></i>&nbsp;&nbsp;Add Answer -->
                        </a>
                    </div>

                </div>
                <div class="thread-contents-items" id="answer-box">
                    <div class="user-wrapper my-3">
                        <div class="d-flex flex-row align-items-center justify-content-center">
                            <h6 class="fw-700 mx-2 my-0"><span class="unfocus-text">answer as&nbsp;</span>azhar620</h6>
                            <div class="image-evoke-update image-form-evoke user-avatar-rounded"
                                style="background-image:url({{asset('assets/user_images/1111111_3452fd55-fff9-4a4a-8b9b-832ba3c0e1fc.png')}});width: 2.5em;
                                height: 2.5em;">
                            </div>
                        </div>
                    </div>
                    <div id="answer-quill-container">
                        <p>     </p>
                        <p>     </p>
                        <p>     </p>
                        <p>     </p>
                        <p>     </p>
                        <p>     </p>
                    </div>
                    {{-- <textarea type="text" name="answer-payload" question-id="162" class="form-input" required=""
                        placeholder="write your answer..."></textarea> --}}
                    <div class="mt-3" id="submit-wrap">
                        <a class="button" href="">Submit</a>
                        <div class="fa-2x"><i class="fas fa-circle-notch fa-spin"></i></div>
                        <div class="form-message"></div>
                    </div>
                </div>



                <div class="thread-contents-items isTopAnswer" answer-id="41">

                    <div class="thread-contents-user-wrapper thread-border-bottom">
                        <a href="profile.php?user_id=564" class="me-auto">
                            <div class="user-wrapper">
                                <div class="image-evoke-update image-form-evoke user-avatar-rounded me-2" style="background-image:url(http://127.0.0.1:8000/assets/user_images/1111111_3452fd55-fff9-4a4a-8b9b-832ba3c0e1fc.png);border: 1px solid var(--display-font-color-2nd);">
                                </div><div class="user-data align-items-start me-2">
                                    <h7>azhar1234</h7>

                                    <p class="unfocus-text m-0 mt-1 w-90px">4 weeks ago</p>
                                </div>



                            </div>
                        </a>
                        <div class="thread-answer-right-action" style="width: 31em;">

                            <div class="answer-stats d-flex flex-row flex-wrap justify-content-end">
                                <div class="answer-stat-items swatch-teal">
                                    4 upvoted&nbsp;
                                </div>
                                <div class="answer-stat-items admin-gold">
                                    Moderated&nbsp;<i class="fa-solid fa-check-double"></i>
                                </div>
                                <div class="answer-stat-items false-red">
                                    Marked False&nbsp;<i class="fa-solid fa-circle-xmark"></i>
                                </div>
                                <div class="answer-stat-items ai-blue">
                                    AI Verified&nbsp;
                                </div>
                                <div class="answer-stat-items down-grey">
                                    1 downvoted&nbsp;
                                </div>
                                <div class="answer-stat-items down-grey">
                                    Potential False&nbsp;
                                </div>
                            </div>
                            <div class="up-down-voting d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-arrow-up up-vote-items isActive thread-answer-right-action-item"></i>
                                <i class="fas fa-arrow-down down-vote-items thread-answer-right-action-item"></i>
                            </div><div class="fa-2x"><i class="fas fa-circle-notch fa-spin"></i></div>


                        </div>

                    </div>

                    <div class="ql-snow">
                        <div class="ql-editor" contenteditable="false" id="answer-content">
                            <h1><strong>Heading</strong></h1><p>Lorem ipsum dolor sit amet, <em>consectetur adipiscing elit</em>, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat?</p><p><br></p><ul><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li></ul><p><br></p><blockquote>Code here</blockquote><pre spellcheck="false">function backdropCloseEvokeHide() {
                                &nbsp; &nbsp; const backdropCloseEvoke = $("#backdrop-close-evoke")
                                &nbsp; &nbsp; backdropCloseEvoke.removeClass('semi-transparent-bg')
                                &nbsp; &nbsp; setTimeout(function () {
                                &nbsp; &nbsp; &nbsp; &nbsp; backdropCloseEvoke.removeClass('visibility-visible')
                                &nbsp; &nbsp; }, 380);
                                }
                                </pre><h2><br></h2><h2>Image</h2><p><br></p><p><img src="data:image/png;base64,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"></p>
                        </div>
                    </div>
                    <div class="thread-reaction w-100 d-inline-flex align-items-center">
                        <div class="me-2">
                            <button id="" type="button" class="btn bg-light position-relative rounded-pill position-relative emoji-input">
                                <i class="fa-solid fa-plus"></i>
                                <input type="hidden">
                                <div id="" class="position-absolute z-index-5 d-none picmo-picker-container">

                                </div>
                            </button>
                        </div>

                        <div class="d-flex flex-row gap-3 py-3 pe-4 me-2 overflow-auto hide-scrollbar1 hide-scrollbar2 reacted-emoji-container">

                            <button type="button" class="btn bg-light position-relative rounded-pill" decodedemoji="2620">☠ <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" data-emoji-count="97">97</span></button>

                        </div>
                        <div class="ms-auto">
                            <div class="afterMenu">
                                <div class="hamburger-icon hamburgerMenuAnswer-toggler">
                                    <a class="cursor-pointer">
                                        <i class="fa-solid fa-square-caret-down fs-3"></i>
                                    </a>
                                </div>
                                <div class="collapse navbar-collapse position-absolute bg-lifted hamburgerMenuAnswer">
                                    <ul class="navbar-nav p-2">
                                        <li class="nav-item m-1">
                                            <a href="#" class="p-2 d-block"><i class="fa-solid fa-share-nodes"></i></a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a href="#" class="p-2 d-block"><i class="fa-solid fa-trash"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="thread-contents-items isTopAnswer" answer-id="41">

                    <div class="thread-contents-user-wrapper thread-border-bottom">
                        <a href="profile.php?user_id=564" class="me-auto">
                            <div class="user-wrapper">
                                <div class="image-evoke-update image-form-evoke user-avatar-rounded me-2" style="background-image:url(http://127.0.0.1:8000/assets/user_images/1111111_3452fd55-fff9-4a4a-8b9b-832ba3c0e1fc.png);border: 1px solid var(--display-font-color-2nd);">
                                </div><div class="user-data align-items-start me-2">
                                    <h7>azhar1234</h7>

                                    <p class="unfocus-text m-0 mt-1 w-90px">4 weeks ago</p>
                                </div>



                            </div>
                        </a>
                        <div class="thread-answer-right-action" style="width: 31em;">

                            <div class="answer-stats d-flex flex-row flex-wrap justify-content-end">
                                <div class="answer-stat-items swatch-teal">
                                    4 upvoted&nbsp;
                                </div>
                                <div class="answer-stat-items admin-gold">
                                    Moderated&nbsp;<i class="fa-solid fa-check-double"></i>
                                </div>
                                <div class="answer-stat-items false-red">
                                    Marked False&nbsp;<i class="fa-solid fa-circle-xmark"></i>
                                </div>
                                <div class="answer-stat-items ai-blue">
                                    AI Verified&nbsp;
                                </div>
                                <div class="answer-stat-items down-grey">
                                    1 downvoted&nbsp;
                                </div>
                                <div class="answer-stat-items down-grey">
                                    Potential False&nbsp;
                                </div>
                            </div>
                            <div class="up-down-voting d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-arrow-up up-vote-items isActive thread-answer-right-action-item"></i>
                                <i class="fas fa-arrow-down down-vote-items thread-answer-right-action-item"></i>
                            </div><div class="fa-2x"><i class="fas fa-circle-notch fa-spin"></i></div>


                        </div>

                    </div>

                    <div class="ql-snow">
                        <div class="ql-editor" contenteditable="false" id="answer-content">
                            <h1><strong>Heading</strong></h1><p>Lorem ipsum dolor sit amet, <em>consectetur adipiscing elit</em>, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat?</p><p><br></p><ul><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li></ul><p><br></p><blockquote>Code here</blockquote><pre spellcheck="false">function backdropCloseEvokeHide() {
                                &nbsp; &nbsp; const backdropCloseEvoke = $("#backdrop-close-evoke")
                                &nbsp; &nbsp; backdropCloseEvoke.removeClass('semi-transparent-bg')
                                &nbsp; &nbsp; setTimeout(function () {
                                &nbsp; &nbsp; &nbsp; &nbsp; backdropCloseEvoke.removeClass('visibility-visible')
                                &nbsp; &nbsp; }, 380);
                                }
                                </pre><h2><br></h2><h2>Image</h2><p><br></p><p><img src="data:image/png;base64,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"></p>
                        </div>
                    </div>
                    <div class="thread-reaction w-100 d-inline-flex align-items-center">
                        <div class="me-2">
                            <button id="" type="button" class="btn bg-light position-relative rounded-pill position-relative emoji-input">
                                <i class="fa-solid fa-plus"></i>
                                <input type="hidden">
                                <div id="" class="position-absolute z-index-5 d-none picmo-picker-container picmoInit">

                                </div>
                            </button>
                        </div>

                        <div class="d-flex flex-row gap-3 py-3 pe-4 me-2 overflow-auto hide-scrollbar1 hide-scrollbar2 reacted-emoji-container">

                            <button type="button" class="btn bg-light position-relative rounded-pill" decodedemoji="2620">☠ <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" data-emoji-count="97">97</span></button>

                        </div>
                        <div class="ms-auto">
                            <div class="afterMenu">
                                <div class="hamburger-icon hamburgerMenuAnswer-toggler">
                                    <a class="cursor-pointer">
                                        <i class="fa-solid fa-square-caret-down fs-3"></i>
                                    </a>
                                </div>
                                <div class="collapse navbar-collapse position-absolute bg-lifted hamburgerMenuAnswer">
                                    <ul class="navbar-nav p-2">
                                        <li class="nav-item m-1">
                                            <a href="#" class="p-2 d-block"><i class="fa-solid fa-share-nodes"></i></a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a href="#" class="p-2 d-block"><i class="fa-solid fa-trash"></i></a>
                                        </li>
                                        <li class="nav-item m-1 bg-success text-light">
                                            <a href="#" class="p-2 d-block"><i class="fa-solid fa-square-check"></i></a>
                                        </li>
                                        <li class="nav-item m-1 bg-danger text-light">
                                            <a href="#" class="p-2 d-block"><i class="fa-solid fa-square-xmark"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div id="thread-contents-right">
                <div id="side-sticky-wrapper">
                    <div class="thread-contents-header">
                        <h2 class="fw-700">Related Threads</h2>
                    </div>


                    <div class="row row-cols-1 row-cols-md-1 g-4">
                        <div class="col">
                          <div class="card h-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                </div>
                                <h5 class="card-title">Card title ard title card title ard title card title</h5>
                                <div class="d-inline-flex">

                                    <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                </div>

                                <div>
                                    <span class="badge bg-light text-dark">5 answers</span>
                                    <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="card h-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                </div>
                                <h5 class="card-title">Card title ard title card title ard title card title</h5>
                                <div class="d-inline-flex">

                                    <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                </div>

                                <div>
                                    <span class="badge bg-light text-dark">5 answers</span>
                                    <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="card h-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                </div>
                                <h5 class="card-title">Card title ard title card title ard title card title</h5>
                                <div class="d-inline-flex">

                                    <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                </div>

                                <div>
                                    <span class="badge bg-light text-dark">5 answers</span>
                                    <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="card h-100">
                            <div class="card-body">
                                <div class="d-inline-flex align-items-center mb-2">
                                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                    <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                </div>
                                <h5 class="card-title">Card title ard title card title ard title card title</h5>
                                <div class="d-inline-flex">

                                    <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                </div>

                                <div>
                                    <span class="badge bg-light text-dark">5 answers</span>
                                    <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                    <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></a>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection
