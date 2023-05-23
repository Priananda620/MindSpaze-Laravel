@extends('layout')
@section('content')
<section id="threads-with-filter">
    <div>
        <div class="filter-header d-flex flex-row align-items-center">
            <div class="dropdown me-3">
                <input type="hidden" id="selected-option">
                <button selected-value="Latest" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Latest
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" data-value="Latest">Latest</a></li>
                    <li><a class="dropdown-item" data-value="Unanswered">Unanswered</a></li>
                    <li><a class="dropdown-item" data-value="Popular">Popular</a></li>
                    <li><a class="dropdown-item" data-value="Answered">Answered</a></li>
                    <li><a class="dropdown-item" data-value="Featured">Featured</a></li>
                    <li><a class="dropdown-item" data-value="Flagged">Flagged</a></li>
                </ul>
            </div>
            <div id="chips-filter" class="overflow-scroll d-flex hide-scrollbar1 hide-scrollbar2">
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
        <div class="row row-cols-lg-3 row-cols-1 row-cols-md-2 mt-3">
            <form class="d-flex align-items-center justify-content-center">
                <input name="search" type="text" placeholder="search..." class="bg-lifted search-not-header mt-0">
                <span id="threadList-totalData" class="badge bg-secondary ms-2">5</span>
            </form>
            
        </div>
        <div class="bd-callout bd-callout-info mt-3">
            <strong>Type above or use our filter</strong> to explore our collections.
        </div>
        <div class="my-5">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="nonHeaderSearchResults">
                <div class="col">
                    <div class="card position-relative w-100">
                        <div class="card-body">
                            <div class="d-inline-flex align-items-center mb-2">
                                <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>    
                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                            </div>
                            <h5 class="card-title">Card title ard title card title ard title card title</h5>            
                            <div class="d-inline-flex">
                                {{-- <h6 class="card-subtitle text-muted mb-2">azhar620</h6> --}}
                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                            </div>                      
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <div>
                                <span class="badge bg-light text-dark">5 answers</span>
                                <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>                       
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card position-relative w-100">
                        <div class="card-body">
                            <div class="d-inline-flex align-items-center mb-2">
                                <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>    
                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                            </div>
                            <h5 class="card-title">Card title ard title card title ard title card title</h5>            
                            <div class="d-inline-flex">
                                {{-- <h6 class="card-subtitle text-muted mb-2">azhar620</h6> --}}
                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                            </div>                      
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <div>
                                <span class="badge bg-light text-dark">5 answers</span>
                                <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>                       
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card position-relative w-100">
                        <div class="card-body">
                            <div class="d-inline-flex align-items-center mb-2">
                                <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>    
                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                            </div>
                            <h5 class="card-title">Card title ard title card title ard title card title</h5>            
                            <div class="d-inline-flex">
                                {{-- <h6 class="card-subtitle text-muted mb-2">azhar620</h6> --}}
                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                            </div>                      
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <div>
                                <span class="badge bg-light text-dark">5 answers</span>
                                <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>                       
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card position-relative w-100">
                        <div class="card-body">
                            <div class="d-inline-flex align-items-center mb-2">
                                <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>    
                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                            </div>
                            <h5 class="card-title">Card title ard title card title ard title card title</h5>            
                            <div class="d-inline-flex">
                                {{-- <h6 class="card-subtitle text-muted mb-2">azhar620</h6> --}}
                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                            </div>                      
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <div>
                                <span class="badge bg-light text-dark">5 answers</span>
                                <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>                       
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card position-relative w-100">
                        <div class="card-body">
                            <div class="d-inline-flex align-items-center mb-2">
                                <div class="user-avatar-rounded me-2" style="background-image:url('http://127.0.0.1:8000/assets/user_images/33324234234_dc6eb3bc-89e9-43a1-b96b-183e01932828.jpeg');width: 2em;height: 2em;"></div>
                                <h6 class="card-subtitle text-muted me-2">azhar620</h6>    
                                <i class="fa-solid fa-bolt mb-2 orange" style="color:var(--yellow)" data-bs-toggle="tooltip" data-bs-placement="right" title="Hot Thread"></i>
                            </div>
                            <h5 class="card-title">Card title ard title card title ard title card title</h5>            
                            <div class="d-inline-flex">
                                {{-- <h6 class="card-subtitle text-muted mb-2">azhar620</h6> --}}
                                <h6 class="card-subtitle text-muted mb-3">5 months ago</h6>
                            </div>                      
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <div>
                                <span class="badge bg-light text-dark">5 answers</span>
                                <span class="badge bg-light text-dark">answer verified <i class="fa-solid fa-circle-check"></i></span>
                                <a href="#" class="card-link float-end"><i class="fa-solid fa-share-from-square"></i></i></a>                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <nav aria-label="...">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</section>

@endsection