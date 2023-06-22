@extends('layout')
@section('content')
    <section id="tutor-main" class="d-flex flex-column align-items-center justify-content-center">
      {!! file_get_contents('assets/svg/svg_adminBackdrop.svg') !!}


        <div class="d-inline-flex">
            <div id="tutor-welcome-text" class="d-flex justify-content-center flex-wrap">
                <h1>
                    Welcome,<br>&nbsp;&nbsp;&nbsp; {{ auth()->user()->username }}
                </h1>
            </div>
            {{-- <div class="user-avatar-rounded me-2"
                style="background-image:url('assets/tutors/{{ auth()->user()->id }}.jpg')"></div> --}}
        </div>

        <div id="main-body-content" class="mt-5">
            @if (session('status') == 'ok')
                <div class="form_message" style="border-color: var(--display-font-color-2nd)">
                    <strong>{{ session('msg') }}&nbsp;<i class="fs-1 fa-solid fa-circle-info"></i></strong></div>
            @elseif (session('status') == 'fail' or $errors->any())
                <div class="form_message"><strong>{{ session('msg') ? session('msg') : '' }}&nbsp;<i
                            class="fas fa-times-circle"></i></strong></div>
            @endif
            <h2>Answers To Moderate [ {{$total_not_moderated}} ]</h2>
            <div id="course-card-scroll" class="hide-scrollbar1">
                <div class="d-inline-flex hide-scrollbar1 hide-scrollbar2" id="course-card-wrap">


                    @forelse ($answers as $answer)
                      @php
                        $quillJSON = $answer->answer_synopsis;
                        $quillData = json_decode($quillJSON, true);
                        $textQuill = '';
                    
                        foreach ($quillData['ops'] as $op) {
                            if (isset($op['insert']) && is_string($op['insert']) && !isset($op['attributes'])) {
                                $textQuill .= strip_tags($op['insert']);
                            }
                        }
                      @endphp

                        <div class="course-card-items d-flex flex-column justify-content-between cursor-pointer custom-link" data-href="/thread/details?question_id={{$answer->encrypted_question_id}}">
                          <div class="h-100">
                            {{-- {{$answer->encrypted_question_id}}
                            {{$answer->question->id}} --}}
                              <div class="d-inline-flex w-100">
                                <h4 data-bs-toggle="tooltip" data-bs-placement="top" title="Answer By" class="badge bg-light text-dark me-1 text-truncate">
                                  {{$answer->user->username}}
                              </h4>
                              <h4 data-bs-toggle="tooltip" data-bs-placement="top" title="Question Title" class="badge bg-light text-dark me-1 text-truncate w-50">
                                {{$answer->question->title}}
                              </h4>
                              </div>
                              
                              <div class="d-flex align-items-center">
                                <p class="m-0 flex-fill overflow-hidden custom-truncate mt-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Answer Body">
                                      {{ $textQuill }}
                                  </p>
                              </div>
                          </div>
                          <div class="d-flex flex-column">
                              @if($answer->ai_classification_status !== 0 && $answer->ai_classification_status !== null)
                                  @if($answer->ai_classification_status == 1)
                                      <div class="answer-tiny-rounded badge bg-light border-success border m-0 border-2 text-dark me-1 w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="AI Classification Potential True">Potential True</div>
                                  @else
                                      <div class="answer-tiny-rounded badge bg-light border-danger border m-0 border-2 text-dark me-1 w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="AI Classification Potential False">Potential False</div>
                                  @endif
                              @else
                                  <div class="answer-tiny-rounded badge bg-light border-dark border m-0 border-2 text-dark me-1 w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="AI Classification Not Classified">Not Classified</div>
                              @endif
                          </div>
                      </div>
                      
                    @empty
                        <div class="course-card-items">
                            <h4>
                                {{ 'empty' }}
                            </h4>
                        </div>
                    @endforelse



                </div>
            </div>
            <h2 class="mt-4 mb-4">Review</h2>
            <div id="statistic-wrap" class="">
                {{-- <div class="d-flex flex-column justify-content-between align-items-start">
                    <h5>Questions</h5>

                    @php
                        $dateJoined = date('j M Y', strtotime(auth()->user()->created_at));
                    @endphp
                    <p>Your account <strong>{{ auth()->user()->username }}</strong> joined on
                        <strong>{{ auth()->user()->created_at }}</strong>
                        <br>Your registered email is <strong>{{ auth()->user()->email }}</strong>
                        <br>Your registered phone is <strong>{{ auth()->user()->phone }}</strong>
                        <br>Your registered country is <strong>{{ auth()->user()->country_code }}</strong>
                    </p>

                    <a href="{{ url('/addCourse') }}">
                        <P><strong>Edit Your Account <i class="fas fa-long-arrow-alt-right"></i></strong></p>
                    </a>
                </div>
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <h5>Answers</h5>

                    <p>So far, on the platform there are <strong>{{ $total_is_moderated }}</strong> had been moderated 😊</p>
                    <p>And there are {{ $total_not_moderated }} had not moderated</p>

                    <a href="{{ url('/addCourse') }}">
                        <P><strong>Add More Course <i class="fas fa-long-arrow-alt-right"></i></strong></p>
                    </a>
                </div> --}}
                
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <div class="media d-flex">
                              <div class="align-self-center">
                                <i class="fs-1 fa-solid fa-users"></i>
                              </div>
                              <div class="media-body text-right w-100 ms-3 d-inline-flex align-items-center">
                                <h5 class="mb-0 me-auto">Total Users</h5>
                                <span class="fs-4 fw-bold">{{$allBasicUser}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <div class="media d-flex">
                              <div class="align-self-center">
                                <i class="fs-1 fa-solid fa-user-shield"></i>
                              </div>
                              <div class="media-body text-right w-100 ms-3 d-inline-flex align-items-center">
                                <h5 class="mb-0 me-auto">Total Admins</h5>
                                <span class="fs-4 fw-bold">{{$allAdmin}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <div class="media d-flex">
                              <div class="align-self-center">
                                <i class="fs-1 fa-solid fa-file-circle-question"></i>
                              </div>
                              <div class="media-body text-right w-100 ms-3 d-inline-flex align-items-center">
                                <h5 class="mb-0 me-auto">Total Questions</h5>
                                <span class="fs-4 fw-bold">{{$allQuestion}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <div class="media d-flex">
                              <div class="align-self-center">
                                <i class="fs-1 fa-solid fa-file-circle-plus"></i>
                              </div>
                              <div class="media-body text-right w-100 ms-3 d-inline-flex align-items-center">
                                <h5 class="mb-0 me-auto">Total Answers</h5>
                                <span class="fs-4 fw-bold">{{$allAnswers}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <div class="media d-flex">
                              <div class="align-self-center">
                                <i class="fs-1 fa-solid fa-file-circle-check"></i>
                              </div>
                              <div class="media-body text-right w-100 ms-3 d-inline-flex align-items-center">
                                <h5 class="mb-0 me-auto">Moderated Answers</h5>
                                <span class="fs-4 fw-bold">{{$total_is_moderated}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <div class="media d-flex">
                              <div class="align-self-center">
                                <i class="fs-1 fa-solid fa-file-circle-exclamation"></i>
                              </div>
                              <div class="media-body text-right w-100 ms-3 d-inline-flex align-items-center">
                                <h5 class="mb-0 me-auto">Unmoderated Answers</h5>
                                <span class="fs-4 fw-bold">{{$total_not_moderated}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fs-1 fa-solid fa-thumbs-up"></i>
                                </div>
                                <div class="media-body text-right w-100 ms-3 d-inline-flex align-items-center">
                                  <h5 class="mb-0 me-auto">AI Potential True</h5>
                                  <span class="fs-4 fw-bold">{{$total_ai_true}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-12">
                        <div class="card">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fs-1 fa-regular fa-thumbs-down"></i>
                                </div>
                                <div class="media-body text-right w-100 ms-3 d-inline-flex align-items-center">
                                  <h5 class="mb-0 me-auto">AI Potential False</h5>
                                  <span class="fs-4 fw-bold">{{$total_ai_false}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  
                  
                  
                  
                {{-- <div class="row">
                    
                </div> --}}
                  
            </div>

        </div>
    </section>

    <script>
      $(document).ready(function() {
        var baseUrl = window.location.protocol + "//" + window.location.host;

        $('.custom-link').on('click', function() {
          var href = $(this).data('href');
          var redirectTo = baseUrl + href;
          window.location.href = redirectTo;
        });

        // $(document).on('click', '.copy-admin-link', function() {
        //     var href = $(this).data('href');
        //     var redirectTo = baseUrl + href;

        //     copyToClipboard(redirectTo);

        //     backdropCloseEvoke.click()

        //     console.log('COPYY CLIPBOARD ADMINNNNNNNN')
        // });
      });

    </script>
@endsection