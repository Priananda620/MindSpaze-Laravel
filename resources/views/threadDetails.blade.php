@extends('layout')
@section('content')
    <script src="//cdn.quilljs.com/1.0.0/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <section id="thread-details" class="m-5">
        <div class="d-flex flex-row m-5">

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
                    <img style="padding: 0 0 1.5em 0; line-height: 1.5em; width:50%;"
                        src="asset/question_images/98f51a29-df07-48af-925b-9f1ded257bee.jpeg">
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

                        <div class="thread-answer-right-action">
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

                    <div>
                        <p>testttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttttestttttttttttttttttttttttttttttttt
                        </p>
                    </div>
                </div>


            </div>

            <div id="thread-contents-right">
                <div id="side-sticky-wrapper">
                    <div class="thread-contents-header">
                        <h2>Related Threads</h2>
                    </div>


                    <div class="thread-side-contents-items">
                        <!--------------------------------------------------------------------------------------------------------->
                        <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9388200037698113" crossorigin="anonymous"></script> -->

                        <ins class="adsbygoogle" style="display: block; height: 159px;" data-ad-format="fluid"
                            data-ad-layout-key="-fb+5k+67-cb+t" data-ad-client="ca-pub-9388200037698113"
                            data-ad-slot="9583102781" data-adsbygoogle-status="done" data-ad-status="unfilled">
                            <div id="aswift_1_host"
                                style="border: medium none; height: 159px; width: 399px; margin: 0px; padding: 0px; position: relative; visibility: visible; background-color: transparent; display: inline-block;"
                                tabindex="0" title="Advertisement" aria-label="Advertisement"><iframe id="aswift_1"
                                    name="aswift_1"
                                    style="left:0;position:absolute;top:0;border:0;width:399px;height:159px;"
                                    sandbox="allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation"
                                    marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true"
                                    scrolling="no"
                                    src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-9388200037698113&amp;output=html&amp;h=159&amp;slotname=9583102781&amp;adk=246713997&amp;adf=520875591&amp;pi=t.ma~as.9583102781&amp;w=399&amp;lmt=1683606578&amp;rafmt=11&amp;format=399x159&amp;url=http%3A%2F%2Fmindspaze.000webhostapp.com%2Fthread.php%3Fquestion_id%3D162&amp;wgl=1&amp;dt=1683606576932&amp;bpp=6&amp;bdt=2458&amp;idt=1316&amp;shv=r20230504&amp;mjsv=m202305040101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D86450c69fae9a9db-22aeef9389e00005%3AT%3D1682753424%3ART%3D1682753424%3AS%3DALNI_MbMBDwZP5XTDMOIDLNbk2nEfvacWg&amp;gpic=UID%3D00000bff44d3c010%3AT%3D1682753424%3ART%3D1683606576%3AS%3DALNI_MaV9LXaNDBg_47FPek2NqFOKdWDkA&amp;prev_fmts=0x0&amp;nras=1&amp;correlator=4239553204618&amp;frm=20&amp;pv=1&amp;ga_vid=1967584361.1683606578&amp;ga_sid=1683606578&amp;ga_hid=995032859&amp;ga_fc=0&amp;u_tz=420&amp;u_his=2&amp;u_h=774&amp;u_w=1376&amp;u_ah=774&amp;u_aw=1376&amp;u_cd=24&amp;u_sd=1.395&amp;adx=756&amp;ady=245&amp;biw=1359&amp;bih=661&amp;scr_x=0&amp;scr_y=0&amp;eid=44759876%2C44773809%2C44759842%2C44759927%2C31071755%2C31074432%2C44788441%2C44789924%2C31074438&amp;oid=2&amp;pvsid=817445565051193&amp;tmod=1226386856&amp;nvt=1&amp;fc=1920&amp;brdim=-7%2C-7%2C-7%2C-7%2C1376%2C0%2C1390%2C788%2C1376%2C661&amp;vis=2&amp;rsz=%7C%7CEer%7C&amp;abl=CS&amp;pfx=0&amp;fu=128&amp;bc=23&amp;ifi=2&amp;uci=a!2&amp;fsb=1&amp;xpc=5WvlP8EgsP&amp;p=http%3A//mindspaze.000webhostapp.com&amp;dtd=1377"
                                    data-google-container-id="a!2" data-load-complete="true" width="399" height="159"
                                    frameborder="0"></iframe></div>
                        </ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>

                    </div>

                    <a class="thread-side-contents-items non-ads" href="thread.php?question_id=141">
                        <div class="side-inner-left">
                            <img src="asset/question_images/default_question_MindSpace.jpg">
                        </div>
                        <div class="side-inner-right">
                            <h3>
                                BIND PARAM SQLBIND P... </h3>
                            <p>
                                BIND PARAM SQLBIND PARAM SQLBIND PARAM SQLBIND PARAM SQL </p>
                        </div>

                    </a>

                    <a class="thread-side-contents-items non-ads" href="thread.php?question_id=144">
                        <div class="side-inner-left">
                            <img src="asset/question_images/315881a9-5d7e-474e-8cbe-307a7cb49528.ico">
                        </div>
                        <div class="side-inner-right">
                            <h3>
                                test SQL BIND PARAM ... </h3>
                            <p>
                                test SQL BIND PARAM IMG NAMEtest SQL BIND PARAM IMG NAME </p>
                        </div>

                    </a>

                    <a class="thread-side-contents-items non-ads" href="thread.php?question_id=162">
                        <div class="side-inner-left">
                            <img src="asset/question_images/98f51a29-df07-48af-925b-9f1ded257bee.jpeg">
                        </div>
                        <div class="side-inner-right">
                            <h3>
                                A very serious quest... </h3>
                            <p>
                                Does Priananda Azhar loves me? because I love him soooo much </p>
                        </div>

                    </a>

                </div>
            </div>
        </div>
    </section>

@endsection
