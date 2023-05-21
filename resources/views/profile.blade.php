@extends('layout')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-between">
            <!-- 1st column (left) -->
            <div class="col-lg-3 me-3">
                <div class="text-center">
                    <div class="d-flex justify-content-center">
                        <div class="user-avatar-rounded"
                            style="background-image:url('{{ asset('assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg') }}');width: 6.3em;height: 6.3em;">
                        </div>
                    </div>

                    <h2 class="fw-bold mt-3">azhar620</h2>
                    <p class="text-muted">Joined 11 November 2022
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="fw-bold">100</h4>
                        <p class="text-muted">Questions</p>
                    </div>
                    <div>
                        <h4 class="fw-bold">50</h4>
                        <p class="text-muted">Moderated</p>
                    </div>
                    <div>
                        <h4 class="fw-bold">20</h4>
                        <p class="text-muted">Answers</p>
                    </div>
                </div>
                <div class="d-flex flex-wrap mb-2 pb-4">
                    <span class="badge bg-light text-dark me-1 mt-1">99+ factual&nbsp;<i
                            class="fa-solid fa-circle-check"></i></span>
                    <span class="badge bg-light text-dark me-1 mt-1">99+ verified&nbsp;<i
                            class="fa-solid fa-check-double"></i></span>
                    <span class="badge bg-light text-dark me-1 mt-1">99+ misleading</span>
                    <span class="badge bg-light text-dark me-1 mt-1">99+ potential false</span>
                </div>

                <ul class="nav flex-row justify-content-between mb-4 fs-3">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#"><i class="fa-brands fa-twitter"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </li>
                </ul>

            </div>

            <!-- 2nd column -->
            <div class="col-lg-8 mt-5">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link active px-3 py-3" data-bs-toggle="tab" data-bs-target="#profile-details-tab" aria-selected="true" role="tab">Profile Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-3 py-3" data-bs-toggle="tab" data-bs-target="#current-user-questions-tab" aria-selected="false" role="tab" tabindex="-1">Your Questions</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profile-details-tab" role="tabpanel">
                        <div class="row">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-pills" role="tablist">

                                        <li class="nav-item me-2" role="presentation">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                                aria-selected="true" role="tab">Overview</button>
                                        </li>

                                        <li class="nav-item me-2" role="presentation">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                                aria-selected="false" role="tab" tabindex="-1">Edit Profile</button>
                                        </li>

                                        <li class="nav-item me-2" role="presentation">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"
                                                aria-selected="false" role="tab" tabindex="-1">Settings</button>
                                        </li>

                                        <li class="nav-item me-2" role="presentation">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"
                                                aria-selected="false" role="tab" tabindex="-1">Change Password</button>
                                        </li>

                                    </ul>
                                    <div class="tab-content mt-4">

                                        <div class="tab-pane fade profile-overview active show" id="profile-overview"
                                            role="tabpanel">
                                            <h4 class="card-title mt-2">About</h4>
                                            <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores
                                                cumque
                                                temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum
                                                quae
                                                quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                                            <h4 class="card-title mt-4">Profile Details</h4>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                                <div class="col-lg-9 col-md-8">Kevin Anderson</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Company</div>
                                                <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Job</div>
                                                <div class="col-lg-9 col-md-8">Web Designer</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Country</div>
                                                <div class="col-lg-9 col-md-8">USA</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Address</div>
                                                <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                                <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Email</div>
                                                <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                                            <!-- Profile Edit Form -->
                                            <form>
                                                <div class="row mb-3">
                                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                        Image</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <img src="assets/img/profile-img.jpg" alt="Profile">
                                                        <div class="pt-2">
                                                            <a href="#" class="btn btn-primary btn-sm"
                                                                title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm"
                                                                title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                        Name</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="fullName" type="text" class="" id="fullName"
                                                            value="Kevin Anderson">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <textarea name="about" class="" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="company" type="text" class="" id="company"
                                                            value="Lueilwitz, Wisoky and Leuschke">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="job" type="text" class="" id="Job"
                                                            value="Web Designer">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="country" type="text" class="" id="Country"
                                                            value="USA">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="address" type="text" class="" id="Address"
                                                            value="A108 Adam Street, New York, NY 535022">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="phone" type="text" class="" id="Phone"
                                                            value="(436) 486-3538 x29071">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="email" type="email" class="" id="Email"
                                                            value="k.anderson@example.com">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="twitter" type="text" class="" id="Twitter"
                                                            value="https://twitter.com/#">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="facebook" type="text" class="" id="Facebook"
                                                            value="https://facebook.com/#">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="instagram" type="text" class="" id="Instagram"
                                                            value="https://instagram.com/#">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="linkedin" type="text" class="" id="Linkedin"
                                                            value="https://linkedin.com/#">
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                                </div>
                                            </form><!-- End Profile Edit Form -->

                                        </div>

                                        <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                                            <!-- Settings Form -->
                                            <form>

                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                                        Notifications</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <div class="d-flex align-items-center py-2">
                                                            <input class="form-check-input m-0 me-2" type="checkbox"
                                                                id="changesMade" checked="">
                                                            <label class="form-check-label m-0 " for="changesMade">
                                                                Changes made to your account
                                                            </label>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <input class="form-check-input m-0 me-2" type="checkbox"
                                                                id="newProducts" checked="">
                                                            <label class="form-check-label m-0" for="newProducts">
                                                                Information on new products and services
                                                            </label>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <input class="form-check-input m-0 me-2" type="checkbox"
                                                                id="proOffers">
                                                            <label class="form-check-label m-0" for="proOffers">
                                                                Marketing and promo offers
                                                            </label>
                                                        </div>
                                                        <div class="d-flex align-items-center py-2">
                                                            <input class="form-check-input m-0 me-2" type="checkbox"
                                                                id="securityNotify" checked="" disabled="">
                                                            <label class="form-check-label m-0" for="securityNotify">
                                                                Security alerts
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                                </div>
                                            </form><!-- End settings Form -->

                                        </div>

                                        <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                            <!-- Change Password Form -->
                                            <form>

                                                <div class="row mb-3">
                                                    <div>
                                                        <label for="currentPassword">Current Password</label>
                                                        <input name="password" type="password" class=""
                                                            id="currentPassword">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div>
                                                        <label for="newPassword">New Password</label>
                                                        <input name="newpassword" type="password" class=""
                                                            id="newPassword">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div>
                                                        <label for="renewPassword">Re-enter New Password</label>
                                                        <input name="renewpassword" type="password" class=""
                                                            id="renewPassword">
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-3">Change Password</button>
                                                </div>
                                            </form><!-- End Change Password Form -->

                                        </div>

                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="current-user-questions-tab" role="tabpanel">
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
                            <div class="row row-cols-2 g-3">
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
@endsection
