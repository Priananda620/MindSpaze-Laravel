@extends('layout')
@section('content')
    <section id="threads-with-filter">
        <div>
            <div class="filter-header d-flex flex-row align-items-center">
                <div class="dropdown me-3">
                    <input type="hidden" id="selected-option">
                    <button selected-value="Latest" class="btn btn-secondary dropdown-toggle" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                    {{-- <button class="badge bg-dark">Primary</button> --}}
                    @foreach ($tags as $tag)
                        <button data-tag-id="{{ $tag->encryptedId }}" class="badge bg-dark">{{ $tag->tag_name }}</button>
                    @endforeach
                </div>
            </div>
            <div class="row row-cols-lg-3 row-cols-1 row-cols-md-2 mt-3">
                <form class="d-flex align-items-center justify-content-center">
                    <input name="search" type="search" placeholder="search..." class="bg-lifted search-not-header mt-0">
                    <span id="threadList-totalData" class="badge bg-secondary ms-2">0</span>
                </form>

            </div>
            <div class="bd-callout bd-callout-info mt-3">
                <strong>Type above or use filter</strong> to explore our collections.
            </div>
            <div class="my-5">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="nonHeaderSearchResults">
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
                    <div class="skeleton-row p-4 skeleton"></div>
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
