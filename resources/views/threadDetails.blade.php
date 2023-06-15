@extends('layout')
@section('content')
    <script src="//cdn.quilljs.com/1.0.0/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <section id="thread-details" class="m-5">
        {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Delete Answer
        </button> --}}
          
          <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content base-color p-3">
                    <div class="modal-header border-bottom border-secondary">
                        <h5 class="modal-title display-font-color" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn display-font-color" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body border-0">
                        <p class="display-font-color">Are you sure you want to delete this answer?</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="perform-deletion">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="moderationModal" tabindex="-1" aria-labelledby="moderationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content base-color p-3">
                    <div class="modal-header border-bottom border-secondary">
                        <h5 class="modal-title display-font-color" id="moderationModalLabel">Confirm Moderation</h5>
                        <button type="button" class="btn display-font-color" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body border-0">
                        <p class="display-font-color">Are you sure you want to mark this answer as true/false?</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="perform-moderation">Continue</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-flex flex-row my-5 justify-content-center">

            <div id="thread-contents-left">
                <div class="thread-contents-header">
                    <h2 style="line-height: 1.5em;" class="pb-3 fw-bold">Question Details<div class="divider"></div>
                    </h2>
                    <div class="user-wrapper"
                        style="background-image:url('{{asset('assets/user_images/'.$questionThread->user->user_profile_img)}}')">
                        <a class="d-flex align-items-center" href="{{url('/profile').'/'.$questionThread->user->username}}">
                            <div class="image-evoke-update image-form-evoke user-avatar-rounded"
                                style="background-image:url('{{asset('assets/user_images/'.$questionThread->user->user_profile_img)}}')">
                            </div>
                            <div class="user-data">
                                <h5><span class="unfocus-text fw-bold">by</span>&nbsp;{{$questionThread->user->username}}</h5>
                                <p class="unfocus-text m-0 fw-bold">{{$diffForHumans}}</p>
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
                                        {{-- {{$questionThread->user->id}}\\\{{auth()->user()->id}}\\\{{auth()->user()->user_role}} --}}
                                        @if($questionThread->user->id == auth()->user()->id or auth()->user()->user_role == 1)
                                            <a data-delete="question" data-bs-target="#deleteModal" data-bs-toggle="modal" class="p-2 cursor-pointer"><i class="fa-solid fa-trash"></i></a>
                                        @endif
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
                            @foreach ($tags as $tag)

                                <button class="badge bg-dark">{{$tag->tag->tag_name}}</button>
                            @endforeach
                            {{-- <button class="badge bg-dark">Primary</button> --}}

                        </div>
                    </div>
                    <h2 class="lh-sm border-start border-3 ps-3">{{$questionThread->title}}</h2>

                    <div class="ql-snow">
                        <div class="p-0 ql-snow border-0" id="question-content" contenteditable="false">
                            <h1><strong>Heading</strong></h1><p>Lorem ipsum dolor sit amet, <em>consectetur adipiscing elit</em>, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat?</p><p><br></p><ul><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li></ul><p><br></p><blockquote>Code here</blockquote><pre spellcheck="false">function backdropCloseEvokeHide() {
                                &nbsp; &nbsp; const backdropCloseEvoke = $("#backdrop-close-evoke")
                                &nbsp; &nbsp; backdropCloseEvoke.removeClass('semi-transparent-bg')
                                &nbsp; &nbsp; setTimeout(function () {
                                &nbsp; &nbsp; &nbsp; &nbsp; backdropCloseEvoke.removeClass('visibility-visible')
                                &nbsp; &nbsp; }, 380);
                                }
                                </pre><h2><br></h2><h2>Image</h2><p><br></p><p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIMAAAA5CAYAAAAVzJh1AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAFKsAABSrAVzzIdoAAAn7SURBVHhe7ZxfaFNZHse/+pKnyZP3KfdhbXZhExa2YcCE2THZYWqRaboDrQu2CpoKtg5oEWwUmvahf0DbgrXCOBa0LWgVpi04TRdNXdikiyQFSYQhFeR2XtKn+JS3uy+7v3Pvycm9SVptRGHlfOCa3JOTc8+f7/n9OW09cDBw9L+QSIgDB/1fSzFIDA7yV4lEikFSgdzEX6SbkBgc+N3h30sxSAykm5AIpBgkAikGiUCKQSKQYpAIpBgkAikGiUCKQSKQYpAI9ikGeVj5ObNPMRzgr5LPEekmJAIpBolAikEikGKQCKQYJAIpBolAikEi+EAxuBAefYJX208xyUusuLpHsJJ6idfbb/Cbcf2KV+s30e3hFcp0juDRurXeG7zOPcV8rI2e8A4672GTfSf3ABFeVGZyvdKe7apTl+Hpvom1zEtLXerv4nn+6XU8t7ZR77K1S3MTu4fnuV/F568yTzDTXWdEnpOYsY5/6yWezw0iyD+24qruozFPR/mnH0bDvwPpoQUc7u9AQHXQnYalpuMYMD/isMnrhFsvIp/OQCsBTrcfAa8CRymDkbbTmNvhVSee4nUIyGa3UNTp3tmEQMALxaFDW+pBS3TTrFfDEVrwhzjhpreszWZq0/yAaMN8Zhohp4ZkYgv0+AqlHB4OLSDDbxlB6sMsNeQoaUinzX44FA8Czhz+HL5GNToQvXUUqlndjtODUIi+m72LbzunwIZlbS+ZpOeLMZWQHv0SXeWOBmme7tI8UblG85QvAoqP5kl1Qs/P49vwuNEewxV5gH8M+eEsFaiPORShwBfwQ3WyNv9GbZZrNkYDYjiPR7kBmiR6qxdo0lQoNOG1YhjE3bkipiOz2OIljM65F5gKKbTIf6VF3qPzwR+xMX8MamEdJ4M/2BaujCv2BP/sYUpwmAKzieEM9TOGQHEZh4+xxdwDZl0mg3DmH+F8eBgpXvx+uDAUf4YebwFLXTQHRkf5sx053Gn5OybKw+TPUbRlfE192hHf1asW04Xo8jNc8LHysnA6SNw3SNx5POz4HrHypAZv0jyFoRZTuOI/h2Ve3AgNuIkmWnxScXIeF1u+QZKUXJ9x9FYJgbGc2jZ2qaK2mAW7kcqgwCo6nfCaJXZcg5g95YWeXkfWtu33iwtjEVogPYf7vfsVAkEWst3rQDE5y4XA8NAc0UtBqwiBsZwyLCQNHq1GwVmylGRZC7SQtl29g4mJFAqgsR87YxZFOuBTgGJ6oSIERuoyVrNkxsiKtYd5WYM0IIZraGn6Ei2RccSt/d83zB/sgcvNdEATtWXZ7WWOYnK+C149g+mBHC+rxlyQUrFajlW4LtKCUL1s3L5w7wW5qT4mpDxWYyu8jEFuxhCygk6zwKQ8pmIBCaPgC7Jp9OxCTrgCQcbcDE61meQK+P0ukoaOQt76HJMJrUD/KlDrBRn74JNnE53BJmNQWuoxL6nGg2DfdaysdNBik/uZGOflFYITg2h3kwm9dbUSd+yCMxATwdbr3Aus3TpJT7DQ7TbigIL2FmPLLygY5oHZ9ktsLA4ivFcE29kLChWM3Tpq68cC7iQ06EoQw8tmGy7/Gdx9RGMiu5heZC6iQnnB7aimcEhQzIp4TRWBvEEtW2+5tT1p3jfIJxUDC4CGKV7QtTimf+KFZSjgMhfhFyxEKaAqrWOwg3xw1eBZG7cpMNPTM1WmtQr/FtKrcazyK5HWUHIo8LaP4vHimcrkK2x3lqC03sApElg+weqnKJBzQA2cxdT8dfh5VTvk7yN+2o95JGxWwSQVPYfBBBl631nc3niDfz+KoVXVkb1zuhI8YgV5tqlpS09FrHKgTOSnFpt79Bp+R2dx8h4wO9M4n0gMLM362YyEixncOHut1jdnnouFS2ZpV6lhjK+9wIo1baLIeyHqh4MCsIvdC7Wm1UqGfGv/ZVziV2/3cRxpGUOamd5AL8a5/Y6o5IjJVikU7I20fYOuPlb/HNr8F7BKC+Vwh3G1z6xrw38FreTv9ewaYjUdcSGy+DOmWlWUtAwSxrhMgfkuPMDaaHlMm7gxlyEpOhEYeobN+D3M3LpH6fgvuB1yosQ8qa6TPfg0fHwxuNowFqfB9TTTxFHQ2WFJKa0sT4mFO9tZXjhKnXoGMcm2posi9BmWqu4ipvdhZwFdD3O0v8hChNuMoiJNNqOQrHY5G7i0yuqShfCbda2E+yilo2XMxmd5iYW+aVwNKBRUDuG7Y6fRa4zLFNiS5oD31AhmuLnZmTuN72JxM6X0BtHeHiSXUMTq6AzyrGulIuL0UjSUQVnTHm5L19/yd43xccXgoTR0Zdowv+n7PTjSuY+gkxbuSpLZUDd8bBf3d5nprNOPYTK75Tjgt21K4crl7H79Ot3swVudFpim1XHIuI0bkR6byDodq6pboQMnvCy0z2GpNrpF9JiHlq2AdOxxlfXawEBii9pU4bMcPu0sXiah/AmHm/5gXH9sPo5LGjs/oEcUNow6BUO0ZMHMNMSO5xB9QnW1NfO+QT6iGCgvnh+gXJvy4t6v0DVmDqoRdLZeFjdivyhdY/NEwWaS3Sd2O6AycTV9YUxcqcSzjNSOYYYVladwVg7RTqSXUvG5eV+GrIqhhfxa3bze4TB9t6PuCZWJw9nM39UnGPGQZIrIL5sLvJjdJhE5yUodMe6tRN1GCAxt3bxvlI8mBtfoGYQUCsiWfkCsEZtObmEqxAaZR5btPosbsV8p89SSTGSS3U/WBnMC1mY7C8sK1CYXTfwu0mSAnL4uTNpSs6OYaW82dnh20b6//eEmcjQlyojqPythpHoqAv2WQNWg3CaliJndd7Gr+0eMU7yhk9gGmY9gTK4bbkMNDSBqbTR4E+0+El9+Azf2DC7fzQf/ST47/z/hrj2BjCy+xHCAoudVypd5mZ0dWrwp2lkUC2QuQS1uIa8VTbOseODzuflx9AW0RPeyKvy0D1UnkBNP8CrkQL7uEbe9TXHMK47OnXAH/Mbur32+i8b8LxpzHvebvscoL7VDaWRmAK0KLXtRM4/ZyUz4fM2G6S/l53E+PG6eqrJ+Bv5DdQokLwfFDc3wuesc2RN+yrgWrEfmzN2EqE3244De2sxrv3w0MZjl/KYu5e8cQXRuBKcCbjhFZkQplJZDYm4cA4vvODTaTQx997BJQZ4iGqU2aWGSt67hUp022Q+AZvspeDNSOOaaaMKXbmNwbK3K7/Pn6Slc9J8zgru6UOA8NHYRJyzj0ikY1JKUEvc/rpzMVveTfKKWXsF0rH58FYw9wPgJM55glAoZLE1cxeiHnQAayP+sQyL4ROcMkv8HpBgkAikGiUCKQSKQYpAIpBgkAikGiWCfYpBHEp8z+xSD/JP8zxnpJiQCKQaJQIpBIpBikAikGCQCKQaJQIpBIjjgD3wlT5IkBtIySDjA/wBZfFJSrIeOnAAAAABJRU5ErkJggg=="></p>
                        </div>
                    </div>
                    {{-- <img style="padding: 0 0 1.5em 0; line-height: 1.5em; width:50%;"
                        src="asset/question_images/98f51a29-df07-48af-925b-9f1ded257bee.jpeg"> --}}
                    <div id="answer-detail-wrapper" class="mt-3">
                        <div id="ans-count">{{$questionThread->answer_count}} answer{{$questionThread->answer_count > 1 ? 's' : ''}}</div>
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
                            <h6 class="fw-700 mx-2 my-0"><span class="unfocus-text">answer as&nbsp;</span>{{auth()->user()->username}}</h6>
                            <div class="image-evoke-update image-form-evoke user-avatar-rounded"
                                style="background-image:url('{{asset('assets/user_images/'.auth()->user()->user_profile_img)}}');width: 2.5em;
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
                        <input type="text" name="imageUpload" class="d-none">
                        <input type="text" name="answerID" class="d-none">
                        <meta name="csrf-token" content="{{ csrf_token() }}" class="d-none">
                        <a class="button">Submit</a>
                        <div class="fa-2x"><i class="fas fa-circle-notch fa-spin"></i></div>
                        <div class="form-message"></div>
                    </div>
                </div>
                <div id="no-answer" class="mt-3">
                    <div>No Answer Added Yet!</div>
                </div>

                {{-- <div class="skeleton-row p-4 skeleton w-50 me-auto"></div>
                <div class="skeleton-row p-4 skeleton w-100"></div>
                <div class="skeleton-row p-4 skeleton w-100"></div>

                <div class="skeleton-row p-4 skeleton w-50 me-auto mt-3"></div>
                <div class="skeleton-row p-4 skeleton w-100"></div>
                <div class="skeleton-row p-4 skeleton w-100"></div> --}}

                {{-- <div class="thread-contents-items isTopAnswer" answer-id="41">

                    <div class="thread-contents-user-wrapper thread-border-bottom">
                        <a href="profile.php?user_id=564" class="me-auto">
                            <div class="user-wrapper">
                                <div class="image-evoke-update image-form-evoke user-avatar-rounded me-2" style="background-image:url(http://127.0.0.1:8000/assets/user_images/1111111_3452fd55-fff9-4a4a-8b9b-832ba3c0e1fc.png);border: 1px solid var(--display-font-color-2nd);">
                                </div>
                                <div class="user-data align-items-start me-2">
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
                            </div>
                            <div class="fa-2x">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </div>

                        </div>

                    </div>

                    <div class="ql-snow">
                        <div class="ql-editor" contenteditable="false" id="answer-content">

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
                </div> --}}


            </div>

            <div id="thread-contents-right">
                <div id="side-sticky-wrapper">
                    <div class="thread-contents-header">
                        <h2 class="fw-700">Related Threads</h2>
                    </div>

                    <div class="row row-cols-1 row-cols-md-1 g-4 w-100">
                        @php
                            // $relatedThreads=[]
                        @endphp
                        @forelse ($relatedThreads as $relatedThread)
                        <div class="col" href-thread-id="{{$relatedThread->encrypted_id}}">
                            <div class="card h-100">
                              <div class="card-body">
                                  <div class="d-inline-flex align-items-center mb-2">
                                      <div class="user-avatar-rounded me-2" style="background-image:url('{{asset('assets/user_images/'.$relatedThread->user->user_profile_img)}}');width: 2em;height: 2em;"></div>
                                      <h6 class="card-subtitle text-muted me-2">{{$relatedThread->user->username}}</h6>
                                      @if ($relatedThread->user->is_bolt_user)
                                        <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                      @endif

                                  </div>
                                  <h5 class="card-title">{{$relatedThread->title}}</h5>
                                  <div class="d-inline-flex">

                                      <h6 class="card-subtitle text-muted mb-3">{{$relatedThread->elapsed_time}}</h6>
                                  </div>

                                  <div>
                                        <span class="badge bg-light text-dark">{{$relatedThread->answer_count}} answer{{$relatedThread->answer_count > 1 ? 's' : ''}}</span>
                                        @if ($relatedThread->hasAnswerVerified)
                                            <span class="badge bg-light text-dark answer-verified">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                        @else
                                            <span class="badge bg-light text-dark">no verified answer <i class="fa-solid fa-triangle-exclamation"></i></span>
                                        @endif

                                        @if($relatedThread->isHotThread == 1)
                                            <span class="ms-2 badge bg-light text-dark me-1 mb-1 border border-warning">Hot</span>
                                        @endif

                                        <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></a>
                                  </div>
                              </div>
                            </div>
                          </div>
                        @empty
                        <h4 class="mb-0">EMPTY</h4>
                        <p class="mt-2 text-muted-color">the data available may be insufficient</p>
                        @endforelse

                    </div>

                </div>
            </div>
        </div>
        <div class="picmoInit d-none">

        </div>
    </section>
    <script>
        var contentJson = {!! json_encode($questionThread->question_synopsis) !!};
        var parsedJson = JSON.parse(contentJson);
        var currentThreadID = "{{$questionIdEncrypted}}"

        console.log(currentThreadID)

        // var htmlContent = '';
        // parsedJson.ops.forEach(function(op) {
        //     if (typeof op.insert === 'string') {
        //         htmlContent += op.insert;
        //     } else if (op.insert.image) {
        //         htmlContent += '<img src="' + op.insert.image + '" alt="Quill Image">';
        //     }
        // });

        $(document).ready(function() {

            var tempQuill = new Quill('#question-content', { readOnly: true });

            tempQuill.setContents(parsedJson);

            $('div[href-thread-id]').click(function () {
                let questionId = $(this).attr('href-thread-id');
                let href = '/thread/details?question_id=' + questionId;
                window.location.href = window.location.origin+href;

                console.log($(this).attr('href-thread-id'))
                console.log("fdfsfdsfdfds")
            });



            // setTimeout(function() {


            // }, 2000);
            loadAnswerItems()

        });

        function loadAnswerItems() {
            var skeletonHtml =
            `<div class="skeleton-row p-4 skeleton w-50 me-auto"></div>
            <div class="skeleton-row p-4 skeleton w-100"></div>
            <div class="skeleton-row p-4 skeleton w-100"></div>
            <div class="skeleton-row p-4 skeleton w-50 me-auto mt-3"></div>
            <div class="skeleton-row p-4 skeleton w-100"></div>
            <div class="skeleton-row p-4 skeleton w-100"></div>`;

            $('#answer-box').after(skeletonHtml);

            $('.answer-item').remove();


            let requestHeaders = {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + $.cookie('api_plain_token')
            };

            $.ajax({
                url: window.location.origin + "/api/" + 'thread/answers',
                method: 'GET',
                headers: requestHeaders,
                data: {
                    question_id: currentThreadID
                },

                timeout: 5000,
                success: function(response) {

                    console.log(response)
                    pushToastMessage('success',
                        'success load data', 'success')

                    if(response.answers.length > 0){
                        $('#no-answer').hide()
                    }else{
                        $('#no-answer').show()
                    }

                    $('#ans-count').html(response.answers.length+' answers')

                    for (let i = 0; i < response.answers.length; i++) {
                        var emojiCountMap = new Map();

                        let currReactions = response.answers[i].reaction

                        currReactions.forEach(function(reaction) {
                            let emoji = reaction.reaction_emoji;
                            if (emojiCountMap.has(emoji)) {
                                emojiCountMap.set(emoji, emojiCountMap.get(emoji) + 1);
                            } else {
                                emojiCountMap.set(emoji, 1);
                            }
                        });

                        emojiCountMap.forEach(function(count, emoji) {
                            console.log(emoji + " -> count: " + count);
                        });



                        var item = response.answers[i];
                        // console.log(item);

                        let newAnswerItem = addAnswerItem(response.answers[i].encrypted_id, response.answers[i].user.username,
                        response.answers[i].elapsed_time,
                        response.answers[i].user.user_profile_img,
                        response.answers[i].downvote.length,response.answers[i].upvote.length,
                        response.answers[i].answer_synopsis,
                        response.answers[i].ai_classification_status, response.answers[i].moderated_as,
                        response.answers[i].curr_downvote, response.answers[i].curr_upvote,
                        emojiCountMap,
                        response.answers[i].curr_user_owner,
                        response.answers[i].curr_user_auth_is_admin)
                        $('#answer-box').after(newAnswerItem);

                    }


                },
                error: function(errors) {
                    pushToastMessage('failed',
                        'failed, check console', 'fail')
                        console.log(errors)
                },
                beforeSend: function() {
                    animateProgressBar(true)

                    $('#thread-contents-left').find('.answer-item').remove();

                    // $('.thread-contents-items').after(skeletonHtml);
                },
                complete: function() {
                    $('#thread-contents-left').find('.skeleton-row').remove();

                    $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                    $('.progress-bar').addClass('opacity-0')
                    $('.progress-bar').removeClass('opacity-100')
                },
            });
        }

        function addAnswerItem(_encrypted_id, _username, _elapsed_time, _avatar_img, _total_down, _total_up, _answer_synopsis, _ai_classification_status, _moderated_as, _curr_downvote, _curr_upvote, _emojiCountMap, _curr_user_owner, _curr_user_auth_is_admin) {
            var threadContents = $('<div>').addClass('thread-contents-items answer-item').attr('answer-id', _encrypted_id);

            var userWrapper = $('<div>').addClass('thread-contents-user-wrapper thread-border-bottom');
            var userLink = $('<a>').attr('href', "/profile/"+_username).addClass('me-auto');
            var userDiv = $('<div>').addClass('user-wrapper');
            var userAvatar = $('<div>')
                .addClass('image-evoke-update image-form-evoke user-avatar-rounded me-2')
                .css('background-image', 'url('+window.location.origin+'/assets/user_images/' + _avatar_img + ')')
                .css('border', '1px solid var(--display-font-color-2nd)');

            var userData = $('<div>').addClass('user-data align-items-start me-2');
            var username = $('<h7>').text(_username);
            var timestamp = $('<p>').addClass('unfocus-text m-0 mt-1 w-100px').text(_elapsed_time);

            userData.append(username, timestamp);
            userDiv.append(userAvatar, userData);
            userLink.append(userDiv);
            userWrapper.append(userLink);

            var answerRightAction = $('<div>').addClass('thread-answer-right-action justify-content-end').css('width', '31em');
            var answerStats = $('<div>').addClass('answer-stats d-flex flex-row flex-wrap justify-content-end');
            // var upvotedStat = $('<div>').addClass('answer-stat-items swatch-teal').text('4 upvoted');
            // var downvotedStat = $('<div>').addClass('answer-stat-items down-grey').text('1 downvoted');

            var moderate_flag = false
            if(_moderated_as !== null && _moderated_as){
                var moderatedStat = $('<div>').addClass('answer-stat-items admin-gold').text('Moderated True ').append($('<i>').addClass('fa-solid fa-check-double'));
                answerStats.append(moderatedStat);
                threadContents.addClass('isModeratedTrue')
                moderate_flag = true
            }else if(_moderated_as !== null && !_moderated_as){
                var markedFalseStat = $('<div>').addClass('answer-stat-items false-red').text('Marked False ').append($('<i>').addClass('fa-solid fa-circle-xmark'));
                    answerStats.append(markedFalseStat);
                threadContents.addClass('isModeratedFalse')
                moderate_flag = true
            }

            if(_ai_classification_status !== null && _ai_classification_status){
                var aiVerifiedStat = $('<div>').addClass('answer-stat-items ai-blue').text('Potential True');
                answerStats.append(aiVerifiedStat);
                if(!moderate_flag){
                    threadContents.addClass('isAITrue')
                }

            }else if(_ai_classification_status !== null && !_ai_classification_status){
                var potentialFalseStat = $('<div>').addClass('answer-stat-items down-grey').text('Potential False');
                    answerStats.append(potentialFalseStat);
                if(!moderate_flag){
                    threadContents.addClass('isAIFalse')
                }
            }else{
                var unclassified = $('<div>').addClass('answer-stat-items unclassified-grey').text('Unclassified');
                    answerStats.append(unclassified);
            }






            // answerStats.append(upvotedStat, moderatedStat, markedFalseStat, aiVerifiedStat, downvotedStat, potentialFalseStat);

            var votingDiv = $('<div>').addClass('up-down-voting d-flex flex-column align-items-center justify-content-center');
            var upVoteIcon = $('<i>').addClass('fas fa-arrow-up up-vote-items thread-answer-right-action-item d-inline-flex up-vote-toggle'); //isActive
            if(_curr_upvote){
                upVoteIcon.addClass('isActive')
            }
            var upvoteNumber = $('<p>').addClass('ms-1 mb-0').text(' '+_total_up)
            var downvoteNumber = $('<p>').addClass('ms-1 mb-0').text(' '+_total_down)
            var downVoteIcon = $('<i>').addClass('fas fa-arrow-down down-vote-items thread-answer-right-action-item d-inline-flex down-vote-toggle');
            if(_curr_downvote){
                downVoteIcon.addClass('isActive')
            }
            upVoteIcon.append(upvoteNumber)
            downVoteIcon.append(downvoteNumber)

            votingDiv.append(upVoteIcon, downVoteIcon);

            var faDiv = $('<div>').addClass('fa-2x');
            var loadingIcon = $('<i>').addClass('fas fa-circle-notch fa-spin');

            faDiv.append(loadingIcon);

            answerRightAction.append(answerStats, votingDiv, faDiv);

            var qlDiv = $('<div>').addClass('ql-snow');
            var qlEditor = $('<div>').addClass('ql-editor '+_encrypted_id).attr('contenteditable', 'false').attr('id', 'answer-content');

            qlDiv.append(qlEditor);

            var reactionDiv = $('<div>').addClass('thread-reaction w-100 d-inline-flex align-items-center');
            var emojiButtonDiv = $('<div>').addClass('me-2 py-3');
            var emojiButton = $('<button>').attr('type', 'button').addClass('btn bg-light position-relative rounded-pill position-relative emoji-input');
            var plusIcon = $('<i>').addClass('fa-solid fa-plus');
            var emojiInput = $('<input>').attr('type', 'hidden');
            emojiInput.attr('data-answer-id', _encrypted_id)
            emojiInput.attr('name', 'add-emoji-data')

            var pickerContainer = $('<div>').attr('id', '').addClass('position-absolute z-index-5 d-none picmo-picker-container');

            emojiButton.append(plusIcon, emojiInput, pickerContainer);
            emojiButtonDiv.append(emojiButton);

            var reactedEmojiDiv = $('<div>').addClass('d-flex flex-row gap-3 py-3 pe-4 me-2 overflow-auto hide-scrollbar1 hide-scrollbar2 reacted-emoji-container');

                ////////////////////
            _emojiCountMap.forEach(function(count, emoji) {
                let escapeSequence = '\\u' + emoji.codePointAt(0).toString(16);
                let withoutPrefix = escapeSequence.substring(2);

                console.log(emoji + " -> count: " + count);
                var emojiButton2 = $('<button>').attr('type', 'button').addClass('btn bg-light position-relative rounded-pill').attr('decodedemoji', withoutPrefix).text(emoji);
                var emojiCount = $('<span>').addClass('position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger').attr('data-emoji-count', count).text(count);
                emojiButton2.append(emojiCount);
                reactedEmojiDiv.append(emojiButton2);
            });

            ///////////////////////

            var msAutoDiv = $('<div>').addClass('ms-auto');
            var afterMenuDiv = $('<div>').addClass('afterMenu');
            var hamburgerIconDiv = $('<div>').addClass('hamburger-icon hamburgerMenuAnswer-toggler');
            var hamburgerLink = $('<a>').addClass('cursor-pointer');
            var caretIcon = $('<i>').addClass('fa-solid fa-square-caret-down fs-3');

            hamburgerLink.append(caretIcon);
            hamburgerIconDiv.append(hamburgerLink);

            var collapseDiv = $('<div>').addClass('collapse navbar-collapse position-absolute bg-lifted hamburgerMenuAnswer');
            var navbarNav = $('<ul>').addClass('navbar-nav p-2');
            var navItem1 = $('<li>').addClass('nav-item m-1');
            var navItemLink1 = $('<a>').attr('href', '#').addClass('p-2 d-block').html($('<i>').addClass('fa-solid fa-share-nodes'));
            var navItem2 = $('<li>').addClass('nav-item m-1');
            var navItemLink2 = $('<a>').addClass('p-2 d-block cursor-pointer').html($('<i>').addClass('fa-solid fa-trash'));
            navItemLink2.attr('data-bs-toggle', 'modal')
            navItemLink2.attr('data-bs-target', '#deleteModal')
            navItemLink2.attr('data-delete', 'answer')

            var navItem3 = $('<li>').addClass('nav-item m-1 bg-success text-light');
            var navItemLink3 = $('<a>').addClass('p-2 d-block cursor-pointer').html($('<i>').addClass('fa-solid fa-square-check'));
            navItemLink3.attr('data-bs-toggle', 'modal')
            navItemLink3.attr('data-bs-target', '#moderationModal')
            navItemLink3.attr('data-moderation', 'true')

            var navItem4 = $('<li>').addClass('nav-item m-1 bg-danger text-light');
            var navItemLink4 = $('<a>').addClass('p-2 d-block cursor-pointer').html($('<i>').addClass('fa-solid fa-square-xmark'));
            navItemLink4.attr('data-bs-toggle', 'modal')
            navItemLink4.attr('data-bs-target', '#moderationModal')
            navItemLink4.attr('data-moderation', 'false')

            navItem1.append(navItemLink1);

            
            

            if(_curr_user_owner){
                navItem2.append(navItemLink2);
                navbarNav.append(navItem2);

            }
            
            if(_curr_user_auth_is_admin){
                navItem3.append(navItemLink3)
                navItem4.append(navItemLink4)
                navItem2.append(navItemLink2);
                navbarNav.append(navItem2);

                navbarNav.append(navItem3);
                navbarNav.append(navItem4);
            }
            
            navbarNav.append(navItem1);
            
            collapseDiv.append(navbarNav);

            afterMenuDiv.append(hamburgerIconDiv, collapseDiv);
            msAutoDiv.append(afterMenuDiv);

            reactionDiv.append(emojiButtonDiv, reactedEmojiDiv, msAutoDiv);

            userWrapper.append(answerRightAction)
            threadContents.append(userWrapper, qlDiv, reactionDiv);


            let parsedJson = JSON.parse(_answer_synopsis);
            console.log(parsedJson)

            let tempQuill2 = new Quill(qlEditor[0], { readOnly: true });

            tempQuill2.setContents(parsedJson);

            return threadContents;

        }

        $(document).on('click', '.up-vote-toggle', function() {
            console.log($(this).closest('.answer-item ').attr('answer-id'))

            var thisVote = $(this)
            var currAnswerIdUpVote = $(this).closest('.answer-item ').attr('answer-id')

            let requestHeaders = {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + $.cookie('api_plain_token')
            };

            $.ajax({
                url: window.location.origin + "/api/" + 'thread/up-vote',
                method: 'POST',
                headers: requestHeaders,
                data: JSON.stringify({
                    answer_id: currAnswerIdUpVote
                }),

                timeout: 5000,
                success: function(response) {

                    console.log(response.upvote_is_active)
                    pushToastMessage('success',
                        'success load data', 'success')

                    var downvoteCount = parseInt(thisVote.siblings('.down-vote-toggle').find('p').html());
                    var upvoteCount = parseInt(thisVote.find('p').html());
                    console.log(downvoteCount)
                    console.log(upvoteCount)
                    if(response.upvote_is_active){
                        thisVote.addClass('isActive')

                        if(thisVote.siblings('.down-vote-toggle').hasClass('isActive')){
                            thisVote.siblings('.down-vote-toggle').removeClass('isActive')

                            thisVote.siblings('.down-vote-toggle').find('p').html(--downvoteCount);
                        }

                        thisVote.find('p').html(++upvoteCount);
                    }else if(!response.upvote_is_active){
                        thisVote.removeClass('isActive')
                        thisVote.siblings('.down-vote-toggle').removeClass('isActive')


                        thisVote.find('p').html(--upvoteCount);
                    }

                },
                error: function(errors) {
                    pushToastMessage('failed',
                        'failed, check console', 'fail')
                        console.log(errors)
                },
                beforeSend: function() {
                    animateProgressBar(true)

                    // $('.thread-contents-items').after(skeletonHtml);
                },
                complete: function() {

                    $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                    $('.progress-bar').addClass('opacity-0')
                    $('.progress-bar').removeClass('opacity-100')
                },
            });
        })

        $(document).on('click', '.down-vote-toggle', function() {
            console.log($(this).closest('.answer-item ').attr('answer-id'))
            console.log('-----'+$(this).siblings('.up-vote-toggle').find('p').html())
            console.log('-----'+$(this).find('p').html())

            var thisVote = $(this)

            var currAnswerIdDownVote = $(this).closest('.answer-item ').attr('answer-id')

            let requestHeaders = {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + $.cookie('api_plain_token')
            };

            $.ajax({
                url: window.location.origin + "/api/" + 'thread/down-vote',
                method: 'POST',
                headers: requestHeaders,
                data: JSON.stringify({
                    answer_id: currAnswerIdDownVote
                }),

                timeout: 5000,
                success: function(response) {

                    console.log(response.downvote_is_active)
                    pushToastMessage('success',
                        'success load data', 'success')

                    var downvoteCount = parseInt(thisVote.find('p').html());
                    var upvoteCount = parseInt(thisVote.siblings('.up-vote-toggle').find('p').html());
                    console.log(downvoteCount)
                    console.log(upvoteCount)
                    if(response.downvote_is_active){
                        thisVote.addClass('isActive')
                        if(thisVote.siblings('.up-vote-toggle').hasClass('isActive')){
                            thisVote.siblings('.up-vote-toggle').removeClass('isActive')

                            thisVote.siblings('.up-vote-toggle').find('p').html(--upvoteCount);
                        }
                        thisVote.find('p').html(++downvoteCount);
                    }else if(!response.downvote_is_active){
                        thisVote.removeClass('isActive')
                        thisVote.siblings('.up-vote-toggle').removeClass('isActive')
                        thisVote.find('p').html(--downvoteCount);
                    }
                },
                error: function(errors) {
                    pushToastMessage('failed',
                        'failed, check console', 'fail')
                        console.log(errors)
                },
                beforeSend: function() {
                    animateProgressBar(true)

                    // $('.thread-contents-items').after(skeletonHtml);
                },
                complete: function() {

                    $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                    $('.progress-bar').addClass('opacity-0')
                    $('.progress-bar').removeClass('opacity-100')
                },
            });
        })

        function imageUpload() {

            var base64_imageTempQuill = $('input[name="imageUpload"]').val()
            var csrfToken = $("meta[name='csrf-token']").attr('content')

            if ($('input[name="answerID"]').val() !== "") {

                // console.log(base64_imageTempQuill)
                // console.log($('input[name="questionID"]').val() + "  -----------------------------------------------")
                let formData = new FormData();

                formData.append('_token', csrfToken);
                formData.append('image_upload', base64_imageTempQuill);
                formData.append('answer_id', $('input[name="answerID"]').val());

                console.log(formData)

                let requestHeaders = {
                    'X-CSRF-TOKEN': csrfToken
                };

                $.ajax({
                    // url: window.location.origin + "/api/" + 'thread/upload-image',
                    url: window.location.origin + "/" +'thread/upload-image-answer',
                    method: 'POST',
                    headers: requestHeaders,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log("SUCCESS IMAGE")
                        loadAnswerItems()
                        $("#backdrop-close-evoke").click()
                        quillEditor.setText('');

                    },
                    error: function(xhr, status, error) {
                        pushToastMessage('failed',
                            'failed, check console (image)', 'fail')
                    },
                    beforeSend: function() {

                    },
                    complete: function() {
                        $('.progress-bar').css('width', '100%').attr(
                            'aria-valuenow', 100);
                        $('.progress-bar').addClass('opacity-0')
                        $('.progress-bar').removeClass('opacity-100')

                        // $('#step5 .fa-ellipsis').hide();
                    },
                });
            }
        }

        $(document).on('click', '#submit-wrap > a', function() {
            let quillRemoveImage = JSON.parse(JSON.stringify(quillEditor.getContents()));

            quillRemoveImage.ops.forEach(function(item) {
                if (item.insert && item.insert.image) {
                    $('input[name="imageUpload"]').val(String(item.insert
                        .image))
                    item.insert.image = "<<IMAGE MOVED>>";
                }
            })

            let quillData = JSON.stringify(quillRemoveImage);

            console.log(quillData)

            let requestHeaders = {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + $.cookie('api_plain_token')
            };

            $.ajax({
                url: window.location.origin + "/api/" + 'thread/post-answer',
                method: 'POST',
                headers: requestHeaders,
                data: JSON.stringify({
                    question_id: currentThreadID,
                    quillData: quillData
                }),

                timeout: 5000,
                success: function(response) {

                    $('input[name="answerID"]').val(String(JSON
                        .parse(JSON.stringify(response
                            .answer_id))))

                    if (response.answer_id !== null && $('input[name="imageUpload"]').val() !== "") {
                        imageUpload()
                    }else{
                        console.log("DONE NO IMAGE")
                        loadAnswerItems()
                        $("#backdrop-close-evoke").click()
                        quillEditor.setText('');
                    }

                },
                error: function() {
                    pushToastMessage('failed',
                        'failed, check console', 'fail')
                },
                beforeSend: function() {
                    animateProgressBar(true)

                    $('#step5 .fa-ellipsis').show();
                },
                complete: function() {
                    if ($('input[name="imageUpload"]').val() == "") {

                        $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                        $('.progress-bar').addClass('opacity-0')
                        $('.progress-bar').removeClass('opacity-100')

                        $('#step5 .fa-ellipsis').hide();
                    }
                },
            });

        })



        // $.ajax({
        //     url: window.location.origin + "/api/" + 'thread/post',
        //     method: 'POST',
        //     headers: requestHeaders,
        //     data: JSON.stringify({
        //         title: newTitle,
        //         quillData: quillData,
        //         tags: tagsSelectedEncIDJSON
        //     }),

        //     timeout: 5000,
        //     success: function(response) {

        //         // currentNewQuestionID = response.question_id
        //         $('input[name="questionID"]').val(String(JSON
        //             .parse(JSON.stringify(response
        //                 .question_id))))

        //         if (response.question_id !== null && $(
        //                 'input[name="imageUpload"]').val() !== "") {
        //             imageUpload()
        //         }else{
        //             window.location.href = window.location.origin + '/thread/details?question_id='+response.question_id;
        //         }

        //     },
        //     error: function() {
        //         pushToastMessage('failed',
        //             'failed, check console', 'fail')
        //     },
        //     beforeSend: function() {
        //         animateProgressBar(true)

        //         $('#step5 .fa-ellipsis').show();
        //     },
        //     complete: function() {
        //         if ($('input[name="imageUpload"]').val() == "") {

        //             $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
        //             $('.progress-bar').addClass('opacity-0')
        //             $('.progress-bar').removeClass('opacity-100')

        //             $('#step5 .fa-ellipsis').hide();
        //         }
        //     },
        // });

        $(document).on('input', "input[name='add-emoji-data']", function() {
            console.log($(this).val())

            const escapeSequence = '\\u' + $(this).val().codePointAt(0).toString(16)

            let requestHeaders = {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + $.cookie('api_plain_token')
            };

            $.ajax({
                url: window.location.origin + "/api/" + 'thread/add-reaction',
                method: 'POST',
                headers: requestHeaders,
                data: JSON.stringify({
                    answer_id: $(this).attr('data-answer-id'),
                    reaction_emoji: $(this).val()
                }),

                timeout: 5000,
                success: function(response) {
                    console.log(response)
                    appendNewReaction(escapeSequence, 1)
                },
                error: function() {
                    pushToastMessage('failed',
                        'failed, check console', 'fail')
                },
                beforeSend: function() {
                    animateProgressBar(true)
                },
                complete: function() {
                    $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                    $('.progress-bar').addClass('opacity-0')
                    $('.progress-bar').removeClass('opacity-100')

                    $('#step5 .fa-ellipsis').hide();
                },
            });



        })

        $(document).on('click', "a[data-bs-target='#deleteModal'][data-delete='question']", function() {
            console.log(currentThreadID)
            $('#deleteModal .modal-body > p').html('Are you sure you want to delete this question (whole threads)?')

            $('#perform-deletion').off('click')

            $('#perform-deletion').on('click', function () {

                $('#deleteModal').modal('hide');
                $("#backdrop-close-evoke").click();

                let requestHeaders = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + $.cookie('api_plain_token')
                };
                $.ajax({
                    url: window.location.origin + "/api/" + 'thread/delete-question',
                    method: 'DELETE',
                    headers: requestHeaders,
                    data: JSON.stringify({
                        question_id: currentThreadID
                    }),

                    timeout: 5000,
                    success: function(response) {
                        console.log(response)
                        if(response.message === "success"){
                            window.location.href = window.location.origin + "/threads/";
                        }

                    },
                    error: function() {
                        pushToastMessage('failed',
                            'failed, check console', 'fail')
                    },
                    beforeSend: function() {
                        animateProgressBar(true)
                    },
                    complete: function() {
                        $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                        $('.progress-bar').addClass('opacity-0')
                        $('.progress-bar').removeClass('opacity-100')
                    },
                });
            })
        })

        $(document).on('click', "a[data-bs-target='#deleteModal'][data-delete='answer']", function() {
            var currentAnswerDeletion = $(this).closest('.answer-item').attr('answer-id')

            $('#deleteModal .modal-body > p').html('Are you sure you want to delete this answer?')

            $('#perform-deletion').off('click')

            $('#perform-deletion').on('click', function () {
                console.log(currentAnswerDeletion)

                $('#deleteModal').modal('hide');
                $("#backdrop-close-evoke").click();

                let requestHeaders = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + $.cookie('api_plain_token')
                };
                $.ajax({
                    url: window.location.origin + "/api/" + 'thread/delete-answer',
                    method: 'DELETE',
                    headers: requestHeaders,
                    data: JSON.stringify({
                        answer_id: currentAnswerDeletion
                    }),

                    timeout: 5000,
                    success: function(response) {
                        console.log(response)
                        // location.reload();
                        loadAnswerItems()

                    },
                    error: function() {
                        pushToastMessage('failed',
                            'failed, check console', 'fail')
                    },
                    beforeSend: function() {
                        animateProgressBar(true)
                    },
                    complete: function() {
                        $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                        $('.progress-bar').addClass('opacity-0')
                        $('.progress-bar').removeClass('opacity-100')
                    },
                });
            })
        })


        $(document).on('click', "a[data-bs-target='#moderationModal'][data-moderation='true']", function() {
            var currentModeration = $(this).closest('.answer-item').attr('answer-id')

            $('#moderationModal .modal-body > p').html('Are you sure you want to moderate this answer as true?')

            $('#perform-moderation').off('click')

            $('#perform-moderation').on('click', function () {
                console.log(currentModeration)

                $('#moderationModal').modal('hide');
                $("#backdrop-close-evoke").click();

                let requestHeaders = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + $.cookie('api_plain_token')
                };
                $.ajax({
                    url: window.location.origin + "/api/" + 'thread/moderate-true',
                    method: 'POST',
                    headers: requestHeaders,
                    data: JSON.stringify({
                        answer_id: currentModeration
                    }),

                    timeout: 5000,
                    success: function(response) {
                        console.log(response)

                        pushToastMessage('success',
                            'success true moderation', 'success')

                        loadAnswerItems()

                    },
                    error: function() {
                        pushToastMessage('failed',
                            'failed, check console', 'fail')
                    },
                    beforeSend: function() {
                        animateProgressBar(true)
                    },
                    complete: function() {
                        $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                        $('.progress-bar').addClass('opacity-0')
                        $('.progress-bar').removeClass('opacity-100')
                    },
                });
            })
        })

        $(document).on('click', "a[data-bs-target='#moderationModal'][data-moderation='false']", function() {
            var currentModeration = $(this).closest('.answer-item').attr('answer-id')

            $('#moderationModal .modal-body > p').html('Are you sure you want to moderate this answer as false?')

            $('#perform-moderation').off('click')

            $('#perform-moderation').on('click', function () {
                console.log(currentModeration)

                $('#moderationModal').modal('hide');
                $("#backdrop-close-evoke").click();

                let requestHeaders = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + $.cookie('api_plain_token')
                };
                $.ajax({
                    url: window.location.origin + "/api/" + 'thread/moderate-false',
                    method: 'POST',
                    headers: requestHeaders,
                    data: JSON.stringify({
                        answer_id: currentModeration
                    }),

                    timeout: 5000,
                    success: function(response) {
                        console.log(response)
                        pushToastMessage('success',
                            'success false moderation', 'success')
                        
                        loadAnswerItems()

                    },
                    error: function() {
                        pushToastMessage('failed',
                            'failed, check console', 'fail')
                    },
                    beforeSend: function() {
                        animateProgressBar(true)
                    },
                    complete: function() {
                        $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                        $('.progress-bar').addClass('opacity-0')
                        $('.progress-bar').removeClass('opacity-100')
                    },
                });
            })
        })


    </script>

@endsection
