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


                    <h2 class="lh-sm border-start border-3 ps-3">A very serious question </h2>

                    <div class="ql-snow">
                        <div class="ql-editor p-0" id="question-content" contenteditable="false">

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

                        </div>
                    </div>
                    <div class="thread-reaction w-100 d-inline-flex align-items-center">
                        <div class="me-2">
                            <button id="emoji-input" type="button" class="btn bg-light position-relative rounded-pill position-relative">
                                <i class="fa-solid fa-plus"></i>
                                <input type="hidden">
                                <div id="picmo-picker-container" class="position-absolute z-index-5 d-none">

                                </div>
                            </button>
                        </div>

                        <div class="d-flex flex-row gap-3 py-3 pe-4 overflow-auto hide-scrollbar1 hide-scrollbar2">

                            <button type="button" class="btn bg-light position-relative rounded-pill" decodedemoji="2620">☠ <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">97</span></button>

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
