@extends('layout')
@section('content')
    <section id="tutor-main" class="d-flex flex-column align-items-center justify-content-center">
        {!! file_get_contents('assets/svg/svg1.svg') !!}
        {!! file_get_contents('assets/svg/svg2.svg') !!}
        <div class="d-inline-flex">
            <div id="tutor-welcome-text" class="d-flex justify-content-center flex-wrap">
                <h1>
                    Welcome,<br>&nbsp;&nbsp;&nbsp; {{ auth()->user()->full_name }}
                </h1>
            </div>
            <div class="user-avatar-rounded me-2"
                style="background-image:url('assets/tutors/{{ auth()->user()->id }}.jpg')"></div>
        </div>

        <div id="main-body-content" class="mt-5">
            @if (session('status') == 'ok')
                <div class="form_message" style="border-color: var(--display-font-color-2nd)">
                    <strong>{{ session('msg') }}&nbsp;<i class="fa-solid fa-circle-info"></i></strong></div>
            @elseif (session('status') == 'fail' or $errors->any())
                <div class="form_message"><strong>{{ session('msg') ? session('msg') : '' }}&nbsp;<i
                            class="fas fa-times-circle"></i></strong></div>
            @endif
            <h2>Your Courses</h2>
            <div id="course-card-scroll">
                <div class="d-inline-flex" id="course-card-wrap">


                    @forelse ($subjects as $subject)
                        <div class="course-card-items d-flex flex-column justify-content-between">

                            <div>
                                <h4>
                                    {{ $subject->title }}
                                </h4>
                                <p class="text-elipsis">
                                    {{ $subject->description }}
                                </p>
                            </div>
                            <div class="d-inline-flex">
                                <div class="subject-tiny-rounded">RM{{ $subject->price }}</div>
                                <div class="subject-tiny-rounded">{{ $subject->learning_hours }} Learning Hours</div>
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
            <div id="course-statistic-wrap" class="d-inline-flex justify-content-between">
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <h3>Tutor</h3>

                    @php
                        $dateJoined = date('j M Y', strtotime(auth()->user()->created_at));
                    @endphp
                    <p>Your account <strong>{{ auth()->user()->full_name }}</strong> joined on
                        <strong>{{ $dateJoined }}</strong>
                        <br>Your registered email is <strong>{{ auth()->user()->email }}</strong>
                        <br>Your registered phone is <strong>{{ auth()->user()->phone }}</strong>
                        <br>Your registered state is <strong>{{ auth()->user()->state->stateOf }}</strong>
                    </p>

                    <a href="{{ url('/addCourse') }}">
                        <P><strong>Edit Your Account <i class="fas fa-long-arrow-alt-right"></i></strong></p>
                    </a>
                </div>
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <h3>Courses</h3>

                    <p>So far you have made a total of <strong>{{ $subjects->count() }}</strong>
                        course{{ (int) $subjects->count() > 1 ? 's' : '' }} 😊
                        @if (isset($subjects[0]->id))
                            . The last one was
                            <strong>{{ $subjects[0]->title }}</strong>

                            on <strong>{{ date('j M Y', strtotime($subjects[0]->created_at)) }}</strong>
                        @endif
                        — happy coursing tutors!
                    </p>
                    <a href="{{ url('/addCourse') }}">
                        <P><strong>Add More Course <i class="fas fa-long-arrow-alt-right"></i></strong></p>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
