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
                            <div class="hamburger-quora">
                                <svg width="24px" height="24px" viewBox="0 0 24 24">
                                    <g id="overflow" class="icon_svg-stroke" stroke-width="1.5" stroke="#666"
                                        fill="none" fill-rule="evenodd">
                                        <path
                                            d="M5,14 C3.8954305,14 3,13.1045695 3,12 C3,10.8954305 3.8954305,10 5,10 C6.1045695,10 7,10.8954305 7,12 C7,13.1045695 6.1045695,14 5,14 Z M12,14 C10.8954305,14 10,13.1045695 10,12 C10,10.8954305 10.8954305,10 12,10 C13.1045695,10 14,10.8954305 14,12 C14,13.1045695 13.1045695,14 12,14 Z M19,14 C17.8954305,14 17,13.1045695 17,12 C17,10.8954305 17.8954305,10 19,10 C20.1045695,10 21,10.8954305 21,12 C21,13.1045695 20.1045695,14 19,14 Z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                        </div>

                    </div>


                    <h2 class="lh-sm">A very serious question </h2>

                    <p class="lh-sm mb-5">Does Priananda Azhar loves me? because I love
                        him soooo much </p>
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

                        <div class="thread-answer-right-action" style="width: 31em;">
                            <div class="up-down-voting d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-arrow-up up-vote-items isActive thread-answer-right-action-item"></i>
                                <i class="fas fa-arrow-down down-vote-items thread-answer-right-action-item"></i>
                            </div>
                            <div class="answer-stats d-flex flex-row flex-wrap justify-content-start">
                                <div class="answer-stat-items swatch-teal">
                                    4 upvoted&nbsp;
                                </div>
                                <div class="answer-stat-items admin-gold">
                                    Moderated&nbsp;<i class="fa-solid fa-check-double"></i>
                                </div>
                                <div class="answer-stat-items false-red">
                                    Marked False&nbsp;<i class="fa-solid fa-circle-xmark"></i>
                                </div>
                                <div class="answer-stat-items down-grey">
                                    1 downvoted&nbsp;
                                </div>
                                <div class="answer-stat-items ai-blue">
                                    AI Verified&nbsp;
                                </div>
                            </div>
                            <div class="fa-2x"><i class="fas fa-circle-notch fa-spin"></i></div>


                        </div>


                        <a href="profile.php?user_id=564">
                            <div class="user-wrapper">
                                <div class="user-data align-items-end me-2">
                                    <h7>azhar1234</h7>

                                    <p class="unfocus-text m-0 mt-1">4 weeks ago</p>
                                </div>
                                <div class="image-evoke-update image-form-evoke user-avatar-rounded me-2"
                                style="background-image:url({{asset('assets/user_images/1111111_3452fd55-fff9-4a4a-8b9b-832ba3c0e1fc.png')}});border: 1px solid var(--display-font-color-2nd);">
                                </div>


                            </div>
                        </a>
                        {{-- <div class="answer-stats">
                            <i class="fas fa-vote-yea" style="color:var(--yellow)"></i>
                            &nbsp;<span>1</span> approved
                        </div> --}}



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
                        <h2>Related Threads</h2>
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
