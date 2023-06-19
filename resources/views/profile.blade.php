@extends('layout')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-between">
            <!-- 1st column (left) -->
            <div class="col-lg-3 me-3">
                <div class="text-center">
                    <div class="d-flex justify-content-center">
                        <div class="user-avatar-rounded"
                            style="background-image:url('{{ asset('storage/assets/user_images')}}/{{ $currentUser->user_profile_img }}');width: 6.3em;height: 6.3em;">
                        </div>
                    </div>
                    @php
                        $timestampFromDb = $currentUser->created_at; // Assuming this is the timestamp from your database
                        $formattedTimestamp = \Carbon\Carbon::parse($timestampFromDb)->formatLocalized('%e %B %Y');
                        setlocale(LC_TIME, 'en_US');
                        $formattedTimestamp = str_replace(' 0', ' ', $formattedTimestamp);
                        $formattedTimestamp = ltrim($formattedTimestamp, '0');
                    @endphp

                    <h2 class="fw-bold mt-3">{{ $currentUser->username }}</h2>
                    <p class="text-muted-color">Joined {{$formattedTimestamp}}
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="fw-bold">{{$user_stats['total_question']}}</h4>
                        <p class="text-muted-color">Questions</p>
                    </div>
                    <div>
                        <h4 class="fw-bold">{{$user_stats['total_answerModerated']}}</h4>
                        <p class="text-muted-color">Moderated</p>
                    </div>
                    <div>
                        <h4 class="fw-bold">{{$user_stats['total_answer']}}</h4>
                        <p class="text-muted-color">Answers</p>
                    </div>
                </div>
                <div class="d-flex flex-wrap mb-2 pb-4">
                    <span class="badge bg-light text-dark me-1 mt-1">{{$user_stats['total_answerModeratedTrue'] > 99 ? '99+' : $user_stats['total_answerModeratedTrue']}} factual&nbsp;<i class="fa-solid fa-circle-check"></i></span>
                    <span class="badge bg-light text-dark me-1 mt-1">{{$user_stats['total_answerAiTrue'] > 99 ? '99+' : $user_stats['total_answerAiTrue']}} verified&nbsp;<i
                            class="fa-solid fa-check-double"></i></span>
                    <span class="badge bg-light text-dark me-1 mt-1">{{$user_stats['total_answerModeratedFalse'] > 99 ? '99+' : $user_stats['total_answerModeratedFalse']}} misleading</span>
                    <span class="badge bg-light text-dark me-1 mt-1">{{$user_stats['total_answerAiFalse'] > 99 ? '99+' : $user_stats['total_answerAiFalse']}} potential false</span>
                </div>

                <ul class="nav flex-row justify-content-between mb-4 fs-3">
                    <li class="nav-item bg-lifted rounded-pill">
                        <a target="_blank" rel="noopener noreferrer" class="nav-link px-3" {{$currentUser->facebook_username ? "href=https://www.facebook.com/".$currentUser->facebook_username: ''}}><i class="fa-brands fa-facebook-f {{$currentUser->facebook_username ? $currentUser->facebook_username: 'unfocus-text'}}"></i></a>
                    </li>
                    <li class="nav-item bg-lifted rounded-pill">
                        <a target="_blank" rel="noopener noreferrer" class="nav-link px-3" {{$currentUser->twitter_username ? "href=https://www.twitter.com/".$currentUser->twitter_username: ''}}><i class="fa-brands fa-twitter {{$currentUser->twitter_username ? $currentUser->twitter_username: 'unfocus-text'}}"></i></a>
                    </li>
                    <li class="nav-item bg-lifted rounded-pill">
                        <a target="_blank" rel="noopener noreferrer" class="nav-link px-3" {{$currentUser->instagram_username ? "href=https://www.instagram.com/".$currentUser->instagram_username: ''}}><i class="fa-brands fa-instagram {{$currentUser->instagram_username ? $currentUser->instagram_username: 'unfocus-text'}}"></i></a>
                    </li>
                    <li class="nav-item bg-lifted rounded-pill">
                        <a target="_blank" rel="noopener noreferrer" class="nav-link px-3" {{$currentUser->linkedin_username ? "href=https://linkedin.com/in/".$currentUser->linkedin_username: ''}}><i class="fa-brands fa-linkedin {{$currentUser->linkedin_username ? $currentUser->linkedin_username: 'unfocus-text'}}"></i></a>
                    </li>
                </ul>

            </div>

            <!-- 2nd column -->
            <div class="col-lg-8 mt-5">
                <ul class="nav nav-pills mb-3" role="tablist">
                    

                    @if ($currentUser->id == auth()->user()->id)
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link active px-3 py-3" data-bs-toggle="tab" data-bs-target="#profile-details-tab" aria-selected="true" role="tab">Profile Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-3 py-3" data-bs-toggle="tab" data-bs-target="#current-user-questions-tab" aria-selected="false" role="tab" tabindex="-1">Your Questions</button>
                    </li>
                    @elseif($currentUser->id != auth()->user()->id)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-3 py-3 active" data-bs-toggle="tab" data-bs-target="#current-user-questions-tab" aria-selected="true" role="tab">{{$currentUser->username}}'s questions</button>
                    </li>
                    @endif

                    @if(auth()->user()->user_role == 1 && $currentUser->id != auth()->user()->id)
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link px-3 py-3" data-bs-toggle="tab" data-bs-target="#profile-details-tab" aria-selected="false" role="tab" tabindex="-1">Profile Details</button>
                    </li>
                    @endif
                    
                    
                </ul>
                <div class="tab-content">
                    @if(auth()->user()->user_role == 1 and $currentUser-> id != auth()->user()->id)

                    <div class="tab-pane fade show" id="profile-details-tab" role="tabpanel">
                        <div class="row">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-pills" role="tablist">

                                        @if(auth()->user()->user_role == 1)
                                        <li class="nav-item me-2 mt-2" role="presentation">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"
                                                aria-selected="false" role="tab" tabindex="-1">Settings</button>
                                        </li>
                                        <li class="nav-item me-2 mt-2" role="presentation">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                                aria-selected="true" role="tab">Overview</button>
                                        </li>
                                        @endif

                                    </ul>
                                    <div class="tab-content mt-4">

                                        <div class="tab-pane fade profile-overview active show" id="profile-overview"
                                            role="tabpanel">
                                            <h4 class="card-title mt-2">About</h4>
                                            <p class="small fst-italic">Your profile details should be accurate and up-to-date. 
                                                Please ensure the information you provide is true and complete. 
                                                We respect your privacy and will handle your profile details in accordance with your privacy regards.
                                            </p>

                                            <h4 class="card-title mt-4">Profile Details</h4>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Username</div>
                                                <div class="col-lg-9 col-md-8">{{ $currentUser->username }}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Job</div>
                                                <div class="col-lg-9 col-md-8">{!! $currentUser->job == null ? "{<span id='threadList-totalData' class='badge bg-secondary'>empty</span>}": $currentUser->job !!}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Country</div>
                                                <div class="col-lg-9 col-md-8">{{$country[0]['id']}}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Last Login IP</div>
                                                <div class="col-lg-9 col-md-8">{!! $currentUser->last_ip == null? "{<span id='threadList-totalData' class='badge bg-secondary'>empty</span>}": $currentUser->last_ip !!}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                                <div class="col-lg-9 col-md-8">({{$country[0]['phonecode']}}){{$currentUser->phone}}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Email</div>
                                                <div class="col-lg-9 col-md-8">{{$currentUser->email}}</div>
                                            </div>

                                        </div>

                                        @if(auth()->user()->user_role == 1)
                                        <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                                            <!-- Settings Form -->
                                            <form id="user-type-form">

                                                <div class="row mb-3">
                                                    <label for="username" class="col-md-4 col-lg-3 col-form-label">User Type</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <div class="d-flex align-items-center py-2">
                                                            <input class="form-check-input m-0 me-2" type="checkbox"
                                                                id="changesMade" checked="">
                                                            <label class="form-check-label m-0 " for="changesMade">
                                                                Basic User
                                                            </label>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <input class="form-check-input m-0 me-2" type="checkbox"
                                                                id="newProducts" checked="">
                                                            <label class="form-check-label m-0" for="newProducts">
                                                                Admin
                                                            </label>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                                </div>
                                            </form><!-- End settings Form -->

                                        </div>
                                        @endif

                                        

                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($currentUser-> id == auth()->user()->id)
                        <div class="tab-pane fade show active" id="profile-details-tab" role="tabpanel">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body pt-3">
                                        <!-- Bordered Tabs -->
                                        <ul class="nav nav-pills" role="tablist">

                                            <li class="nav-item me-2 mt-2" role="presentation">
                                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                                    aria-selected="true" role="tab">Overview</button>
                                            </li>

                                            <li class="nav-item me-2 mt-2" role="presentation">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                                    aria-selected="false" role="tab" tabindex="-1">Edit Profile</button>
                                            </li>

                                            
                                            @if(auth()->user()->user_role == 1)
                                                <li class="nav-item me-2 mt-2" role="presentation">
                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"
                                                        aria-selected="false" role="tab" tabindex="-1">Settings</button>
                                                </li>
                                            @endif
                                            

                                            <li class="nav-item me-2 mt-2" role="presentation">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"
                                                    aria-selected="false" role="tab" tabindex="-1">Change Password</button>
                                            </li>

                                        </ul>
                                        <div class="tab-content mt-4">

                                            <div class="tab-pane fade profile-overview active show" id="profile-overview"
                                                role="tabpanel">
                                                <h4 class="card-title mt-2">About</h4>
                                                <p class="small fst-italic">Your profile details should be accurate and up-to-date. 
                                                    Please ensure the information you provide is true and complete. 
                                                    We respect your privacy and will handle your profile details in accordance with your privacy regards.
                                                </p>

                                                <h4 class="card-title mt-4">Profile Details</h4>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label ">Username</div>
                                                    <div class="col-lg-9 col-md-8">{{ $currentUser->username }}</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Job</div>
                                                    <div class="col-lg-9 col-md-8">{!! $currentUser->job == null ? "{<span id='threadList-totalData' class='badge bg-secondary'>empty</span>}": $currentUser->job !!}</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                                    <div class="col-lg-9 col-md-8">{{$country[0]['id']}}</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Last Login IP</div>
                                                    <div class="col-lg-9 col-md-8">{!! $currentUser->last_ip == null? "{<span id='threadList-totalData' class='badge bg-secondary'>empty</span>}": $currentUser->last_ip !!}</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                                    <div class="col-lg-9 col-md-8">({{$country[0]['phonecode']}}){{$currentUser->phone}}</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                                    <div class="col-lg-9 col-md-8">{{$currentUser->email}}</div>
                                                </div>

                                            </div>

                                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                                                <!-- Profile Edit Form -->
                                                <form id="profile_update_data">
                                                    <div class="row mb-3">
                                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                            Image</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <img id="upload-avatar-preview" class="w-50" src="{{asset('storage/assets/user_images')}}/{{ $currentUser->user_profile_img }}" alt="Profile">
                                                            <div class="pt-2">
                                                                {{-- <a href="#" class="btn btn-danger btn-sm"
                                                                    title="Remove my profile image">
                                                                    <i class="fa-solid fa-square-minus"></i>
                                                                </a> --}}

                                                                <input style="display: none" id="user-pic-update" type="file" name="user_profile_img">
                                                                <a id="upload-avatar-btn" class="btn bg-lifted-1 btn-sm"
                                                                    title="Upload new profile image">


                                                                    <i class="fa-solid fa-images"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="username" type="text" class="" id="username"
                                                                value="{{ $currentUser->username }}">
                                                        </div>
                                                    </div>

                                                    {{-- <div class="row mb-3">
                                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <textarea name="about" class="" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                                                        </div>
                                                    </div> --}}

                                                    <div class="row mb-3">
                                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="job" type="text" class="mt-0" id="Job"
                                                                value="{{ $currentUser->job }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input type="text" class="mt-0" id="Country" disabled name="country"
                                                                value="{{ $currentUser->country_code }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <div class="input-group">
                                                                <span class="input-group-text">+{{$country[0]['phonecode']}}</span>
                                                                <input id="Phone" name="phone" type="text" style="border: none;color: var(--display-font-color);"
                                                                class="form-control w-auto mt-0" placeholder="Phone number" value="{{$currentUser->phone}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="email" type="email" class="mt-0" id="Email"
                                                                value="{{ $currentUser->email }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                            Username</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="twitter_username" type="text" class="mt-0" id="Twitter"
                                                                value="{{ $currentUser->twitter_username }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                            Username</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="facebook_username" type="text" class="mt-0" id="Facebook"
                                                                value="{{ $currentUser->facebook_username }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                            Username</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="instagram_username" type="text" class="mt-0" id="Instagram"
                                                                value="{{ $currentUser->instagram_username }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                            Username</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="linkedin_username" type="text" class="mt-0" id="Linkedin"
                                                                value="{{ $currentUser->linkedin_username }}">
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <button id="update-data-save" type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                                    </div>
                                                </form><!-- End Profile Edit Form -->

                                            </div>

                                            @if(auth()->user()->user_role == 1)
                                            <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                                                <!-- Settings Form -->
                                                <form id="user-type-form">

                                                    <div class="row mb-3">
                                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">User Type</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <div class="d-flex align-items-center py-2">
                                                                <input class="form-check-input m-0 me-2" type="checkbox"
                                                                    id="changesMade" checked="">
                                                                <label class="form-check-label m-0 " for="changesMade">
                                                                    Basic User
                                                                </label>
                                                            </div>
                                                            <div class="d-flex align-items-center py-2">
                                                                <input class="form-check-input m-0 me-2" type="checkbox"
                                                                    id="newProducts" checked="">
                                                                <label class="form-check-label m-0" for="newProducts">
                                                                    Admin
                                                                </label>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                                    </div>
                                                </form><!-- End settings Form -->

                                            </div>
                                            @endif

                                            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                                <!-- Change Password Form -->
                                                <form id="profile-change-password-form">

                                                    <div class="row mb-3">
                                                        <div>
                                                            <label for="current_password">Current Password</label>
                                                            <input name="current_password" type="password" class=""
                                                                id="current_password">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div>
                                                            <label for="new_password">New Password</label>
                                                            <input name="new_password" type="password" class=""
                                                                id="new_password">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div>
                                                            <label for="new_password_2">Re-enter New Password</label>
                                                            <input name="new_password_2" type="password" class=""
                                                                id="new_password_2">
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <button type="submit" id="change-password-submit" class="btn btn-primary mt-3">Change Password</button>
                                                    </div>
                                                </form><!-- End Change Password Form -->

                                            </div>

                                        </div><!-- End Bordered Tabs -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="tab-pane fade {{$currentUser-> id != auth()->user()->id ? 'show active' : ''}}" id="current-user-questions-tab" role="tabpanel">
                        <div class="row">
                            <!-- Left child container -->
                            {{-- <h4 class="fw-bold">Questions</h4> --}}
                            <div class="filter-header d-flex flex-row align-items-center">
                                <div class="dropdown me-3">
                                    <input type="hidden" id="selected-option">
                                    <button selected-value="Latest" class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Latest
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" data-value="Latest">Latest</a></li>
                                        <li><a class="dropdown-item" data-value="Unanswered">Oldest</a></li>
                                        <li><a class="dropdown-item" data-value="Popular">Popular</a></li>
                                    </ul>
                                </div>
                                <div id="chips-filter" class="overflow-scroll d-flex hide-scrollbar1 hide-scrollbar2">
                                    <button class="badge bg-dark">All Question</button>
                                    <button class="badge bg-dark">Question Answered</button>
                                    <button class="badge bg-dark">Unanswered</button>
                                    <button class="badge bg-dark">Verified By AI</button>
                                    <button class="badge bg-dark">Moderated</button>
                                    <button class="badge bg-dark">Misleading</button>
                                    <button class="badge bg-dark">Potential False</button>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-3">
                                <!-- Card 1 -->
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="user-avatar-rounded me-2"
                                                    style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;">
                                                </div>
                                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)"
                                                    data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                            </div>
                                            <h5 class="card-title">Card Title</h5>
                                            <div class="d-inline-flex">
                                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                            </div>
                                            <div>
                                                <span class="badge bg-light text-dark">5 answers</span>
                                                <span class="badge bg-light text-dark">answer verified <i
                                                        class="fa-solid fa-circle-check"></i></span>
                                                <a href="#" class="card-link float-end"><i
                                                        class="fa-solid fa-share-from-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="user-avatar-rounded me-2"
                                                    style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;">
                                                </div>
                                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)"
                                                    data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                            </div>
                                            <h5 class="card-title">Card Title</h5>
                                            <div class="d-inline-flex">
                                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                            </div>
                                            <div>
                                                <span class="badge bg-light text-dark">5 answers</span>
                                                <span class="badge bg-light text-dark">answer verified <i
                                                        class="fa-solid fa-circle-check"></i></span>
                                                <a href="#" class="card-link float-end"><i
                                                        class="fa-solid fa-share-from-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="user-avatar-rounded me-2"
                                                    style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;">
                                                </div>
                                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)"
                                                    data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                            </div>
                                            <h5 class="card-title">Card Title</h5>
                                            <div class="d-inline-flex">
                                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                            </div>
                                            <div>
                                                <span class="badge bg-light text-dark">5 answers</span>
                                                <span class="badge bg-light text-dark">answer verified <i
                                                        class="fa-solid fa-circle-check"></i></span>
                                                <a href="#" class="card-link float-end"><i
                                                        class="fa-solid fa-share-from-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="user-avatar-rounded me-2"
                                                    style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;">
                                                </div>
                                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)"
                                                    data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                            </div>
                                            <h5 class="card-title">Card Title</h5>
                                            <div class="d-inline-flex">
                                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                            </div>
                                            <div>
                                                <span class="badge bg-light text-dark">5 answers</span>
                                                <span class="badge bg-light text-dark">answer verified <i
                                                        class="fa-solid fa-circle-check"></i></span>
                                                <a href="#" class="card-link float-end"><i
                                                        class="fa-solid fa-share-from-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="user-avatar-rounded me-2"
                                                    style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;">
                                                </div>
                                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)"
                                                    data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                            </div>
                                            <h5 class="card-title">Card Title</h5>
                                            <div class="d-inline-flex">
                                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                            </div>
                                            <div>
                                                <span class="badge bg-light text-dark">5 answers</span>
                                                <span class="badge bg-light text-dark">answer verified <i
                                                        class="fa-solid fa-circle-check"></i></span>
                                                <a href="#" class="card-link float-end"><i
                                                        class="fa-solid fa-share-from-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="user-avatar-rounded me-2"
                                                    style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;">
                                                </div>
                                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)"
                                                    data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                                            </div>
                                            <h5 class="card-title">Card Title</h5>
                                            <div class="d-inline-flex">
                                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                                            </div>
                                            <div>
                                                <span class="badge bg-light text-dark">5 answers</span>
                                                <span class="badge bg-light text-dark">answer verified <i
                                                        class="fa-solid fa-circle-check"></i></span>
                                                <a href="#" class="card-link float-end"><i
                                                        class="fa-solid fa-share-from-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right child container -->

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-2 mt-5">
        <div>
          <h4 class="fw-bold">Biography</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque felis ac lacinia interdum.</p>
        </div>

        <div class="mt-5">
          <h4 class="fw-bold">Social Media</h4>
          <ul class="list-unstyled">
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Instagram</a></li>
          </ul>
        </div>
      </div> --}}
        </div>
    </div>
    <script>
        $(document).ready(() => {
            $('#change-password-submit').on('click', function (e) {
                e.preventDefault()

                var formData = new FormData($('#profile-change-password-form')[0])
                console.log(formData.get('current_password'))
                console.log(formData.get('new_password'))
                console.log(formData.get('new_password_2'))



                let requestHeaders = {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + $.cookie('api_plain_token')
                };

                $.ajax({
                    url: window.location.origin + "/api/" + 'user/change-password',
                    method: 'POST',
                    headers: requestHeaders,
                    data: formData,
                    processData: false,
                    contentType: false,
                    timeout: 5000,

                    success: function(response) {
                        console.log(response)
                        
                        pushToastMessage('success',
                            'success update data', 'success')
                    },
                    error: function(xhr, status, error) {
                        const response = JSON.parse(xhr.responseText);
                        // if (response.errors && response.errors.new_password_2) {
                        //     pushToastMessage('info', 'New password doesnt match.', 'info');
                        // } else {
                        //     pushToastMessage('failed', 'Failed, check console', 'fail');
                        // }

                        if (response.errors) {
                            const errorMessages = Object.values(response.errors).flat();
                            errorMessages.forEach(message => {
                                pushToastMessage('info', message, 'info');
                            });
                        } else if (response.message) {
                            pushToastMessage('info', response.message, 'info');
                        } else if (response.error) {
                            pushToastMessage('info', response.error, 'info');
                        } else {
                            pushToastMessage('failed', 'Failed, check console', 'fail');
                            console.log(response)
                        }

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
            $('#update-data-save').on('click', function (e) {
                e.preventDefault()

                var formData = new FormData($('#profile_update_data')[0])
                console.log(formData.get('user-pic-update'))
                console.log(formData.get('username'))
                


                let requestHeaders = {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + $.cookie('api_plain_token')
                };

                $.ajax({
                    url: window.location.origin + "/api/" + 'user/update-details',
                    method: 'POST',
                    headers: requestHeaders,
                    data: formData,
                    processData: false,
                    contentType: false,
                    timeout: 5000,

                    success: function(response) {
                        console.log(response)

                        $('#upload-avatar-preview').attr('src', window.location.origin + "/storage/assets/user_images/" + response.user.user_profile_img)
                        pushToastMessage('success',
                            'success update data', 'success')
                    },
                    error: function(xhr, status, error) {
                        var response = JSON.parse(xhr.responseText);
                        // if (response.errors) {
                        //     const errorMessages = Object.values(response.errors).flat();
                        //     errorMessages.forEach(message => {
                        //         pushToastMessage('info', message, 'info');
                        //     });
                        // } else {
                        //     pushToastMessage('failed', 'Failed, check console', 'fail');
                        // }
                        
                        if (response.errors) {
                            const errorMessages = Object.values(response.errors).flat();
                            errorMessages.forEach(message => {
                                pushToastMessage('info', message, 'info');
                            });
                        } else if (response.message) {
                            pushToastMessage('info', response.message, 'info');
                        } else if (response.error) {
                            pushToastMessage('info', response.error, 'info');
                        } else {
                            pushToastMessage('failed', 'Failed, check console', 'fail');
                            console.log(response)
                        }


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
