@extends('layout')
@section('content')
<div class="container my-5">
    <div class="row justify-content-between">
      <!-- 1st column (left) -->
      <div class="col-lg-3 me-3">
        <div class="text-center">
            <div class="d-flex justify-content-center">
                <div class="user-avatar-rounded" style="background-image:url('{{asset('assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg')}}');width: 6.3em;height: 6.3em;"></div>
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
            <span class="badge bg-light text-dark me-1 mt-1">99+ factual&nbsp;<i class="fa-solid fa-circle-check"></i></span>
            <span class="badge bg-light text-dark me-1 mt-1">99+ verified&nbsp;<i class="fa-solid fa-check-double"></i></span>
            <span class="badge bg-light text-dark me-1 mt-1">99+ misleading</span>
            <span class="badge bg-light text-dark me-1 mt-1">99+ potential false</span>
        </div>
  
        <ul class="nav flex-column mb-4">
          <li class="nav-item">
            <a class="nav-link px-0" href="#">All Questions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-0" href="#">Answered</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-0" href="#">Verified Answers</a>
          </li>
        </ul>
      </div>
  
      <!-- 2nd column -->
      <div class="col-lg-8 mt-5">
        <div class="row">
          <!-- Left child container -->
          <h4 class="fw-bold">Questions</h4>
          <div class="filter-header d-flex flex-row align-items-center">
            <div class="dropdown me-3">
                <input type="hidden" id="selected-option">
                <button selected-value="Latest" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                    <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                  </div>
                  <h5 class="card-title">Card Title</h5>
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
                  <div class="d-flex align-items-center mb-2">
                    <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                    <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                    <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                  </div>
                  <h5 class="card-title">Card Title</h5>
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
                    <div class="d-flex align-items-center mb-2">
                      <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                      <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                      <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                    </div>
                    <h5 class="card-title">Card Title</h5>
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
                    <div class="d-flex align-items-center mb-2">
                      <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                      <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                      <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                    </div>
                    <h5 class="card-title">Card Title</h5>
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
                    <div class="d-flex align-items-center mb-2">
                      <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                      <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                      <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                    </div>
                    <h5 class="card-title">Card Title</h5>
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
                    <div class="d-flex align-items-center mb-2">
                      <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                      <h6 class="card-subtitle text-muted me-2">azhar620</h6>
                      <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                    </div>
                    <h5 class="card-title">Card Title</h5>
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
          
          <!-- Right child container -->
  
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