<footer class="p-5">
    <div class="logo mb-4 pb-3 border-bottom border-secondary">
      <a href="{{url('/')}}">
        <h1 class="fw-bold d-flex align-items-center">
          <span>
            {!! file_get_contents('assets/logo/svgMindspaze.svg') !!}
            </svg>
          </span>
          <span style="color:#f5bc00" class="position-relative">
            Mind
            <p style="width: max-content;">AI Integrated</p>
          </span>
          <span class="logoSpaZe">Spaze</span>
        </h1>
      </a>
    </div>
    <div class="row justify-content-between">
      <div class="col-md-4 text-center">
        <p style="text-align: justify">All contents, website design, FE, BE are fully self-made (except <span class="fw-bold">fontAwesome icons</span> and svg flat illustrations are from <span class="fw-bold">unDraw</span>). Using JQUERY, AJAX, native JS, self CSS, Bootstrap CSS framework, FontAwesome icons, unDraw svg illustrations.</p>
      </div>
      <div class="col-md-2 d-flex flex-column">
        <div class="row mb-1">
          <div class="col">
            <a href="{{url('/about')}}">About Us</a>
          </div>
        </div>
        <div class="row mb-1">
          <div class="col">
            <a href="{{url('/about#faq')}}">FAQ</a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <a href="{{url('/about#community-guidelines')}}">Community Guidelines</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <p style="margin-bottom: 1em; text-align: center; font-weight:600">Follow Us</p>
        <div class="d-flex justify-content-center">
          <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-linkedin"></i>
          </a>
          <a href="https://github.com/Priananda620/MindSpaze-Laravel" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-github mx-2"></i>
          </a>
          <a href="https://www.instagram.com/mindspaze.qa/" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
{{-- 
<footer class="p-5">
    <div class="logo mb-4 pb-3 border-bottom border-secondary">
        <a href="{{url('/')}}">
            <h1 class="fw-bold d-flex align-items-center">
                <span>{!! file_get_contents('assets/logo/svgMindspaze.svg') !!}</span>
                <span style="color:#f5bc00" class="position-relative">
                    Mind
                    <p style="width: max-content;">AI Integrated</p>
                </span>
                <span class="logoSpaZe">Spaze</span></h1>
        </a>
    </div>
    <div class="d-flex justify-content-between">
        <div style="width: 22em;">
            <p style="text-align: justify">All contents, website design, FE, BE are fully self made (except <span class="fw-bold">fontAwesome icons</span> and svg flat illustrations are from <span class="fw-bold">unDraw</span>). Using JQUERY, AJAX, native JS, self CSS, Bootstrap CSS framework, FontAwesome icons, unDraw svg illustrations.</p>
        </div>

        <div style="margin: 0 3em;">
            <p style="margin-bottom: 1em; text-align: center; font-weight:600">Follow Us</p>
            <div class="d-flex flex-wrap justify-content-center">
                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="https://github.com/Priananda620/MindSpaze-Laravel" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-github mx-2"></i>
                </a>
                <a href="https://www.instagram.com/mindspaze.qa/" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-instagram"></i>
                </a>

            </div>
        </div>
    </div>
</footer> --}}
