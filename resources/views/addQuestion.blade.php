@extends('layout')
@section('content')
<script src="//cdn.quilljs.com/1.0.0/quill.min.js"></script>
<link href="//cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
<style>
    body {
  font-family: Arial, sans-serif;
}

.container {
  position: relative;
  width: 100%;
  height: 75vh;
  overflow: hidden;
}

.step {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  background: var(--base-color-lifted-1);
  align-items: center;
  justify-content: center;
  text-align: center;
  opacity: 0;
  transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
}

.step.active {
  opacity: 1;
  transform: translateX(0);
  z-index: 10;
}

@keyframes slide-curr-step {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-100%);
  }
}

@keyframes slide-next-step {
  from {
    transform: translateX(100%);
  }
  to {
    transform: translateX(0);
  }
}

.step.slide-curr-step {
  animation: slide-curr-step 0.5s ease-in-out forwards;
}

.step.slide-next-step {
  animation: slide-next-step 0.5s ease-in-out forwards;
}

.step h2 {
  margin-bottom: 20px;
}

.step img {
  max-width: 300px;
  max-height: 200px;
}

.navigation {
  text-align: center;
  margin-top: 20px;
}

</style>
<div id="addQuestion-container" class="container mt-5">
    <div id="step1" class="step active p-4">
        <object class="mb-5" style="width: 21vw;" data="assets/svg/undraw_welcoming_re_x0qo.svg" type="image/svg+xml"></object>
        <h2 class="">Thank you for interested in a part of our community!
        </h2>
        <p class=" text-muted-color">
            We're here to help answer your questions and provide valuable insights.
        </p>
    </div>
    <div id="step2" class="step p-4">
        <object class="mb-5" style="width: 21vw;" data="assets/svg/undraw_complete_design_re_h75h.svg" type="image/svg+xml"></object>
        <h3 class="text-muted-color">Keep In Mind</h3>
        <h2 class="">You Have to Follow Our Community Guidelines</h2>
        <a target="_blank" rel="noopener noreferrer" href="/about#community-guidelines">read&nbsp;<i class="fa-solid fa-angles-right"></i></a>

    </div>
    <div id="step3" class="step p-5" style="justify-content: start;">
      <object class="mb-5 mt-3" style="width: 25vw;" data="assets/svg/undraw_text_field_htlv.svg" type="image/svg+xml"></object>
      <h2 class="mb-3 mt-4">Write Your Title</h2>
      <form method="POST" id="newTitle" class="mb-4" style="width: 52%;">
        <input type="text" name="question-title" class="bg-inherit-text p-3" placeholder="write your title..." value="" required="">
      </form>
      <div>
        <i class="fa-solid fa-ellipsis fa-beat-fade fa-2xl fs-1" style="display: none"></i>
        <i class="fa-regular fa-circle-check text-success fa-2xl fs-2" style="display: none"></i>
        <i class="fa-regular fa-circle-xmark fa-2xl fs-2 text-danger" style="display: none"></i>
      </div>

    </div>
    <div id="step4" class="step p-5" style="justify-content: start;">
        <h2>Fill Your Question Details</h2>
        {{-- <img src="placeholder3.jpg" alt="Step 3 Image"> --}}

        <div style="width: 92%;" class="mt-4">
            <div id="question-quill-container">
                <p>     </p>
                <p>     </p>
                <p>     </p>
                <p>     </p>
                <p>     </p>
                <p>     </p>
            </div>
        </div>
        <div class="mt-5">Select your tags</div>
        <div class="mb-3 d-flex flex-row mt-3" style="width: 90%;">

            <button class="btn btn-secondary" type="disabled">
                <i class="fa-solid fa-tags"></i>
            </button>
            <div id="chips-filter" class="overflow-scroll d-flex hide-scrollbar1 hide-scrollbar2 tags-badge">
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
    </div>
    <div id="step5" class="step p-5">
      <object class="mb-5" style="width: 25vw;" data="assets/svg/undraw_done_re_oak4.svg" type="image/svg+xml"></object>
      <h2 class="mb-3 mt-4 fw-bold">All Good</h2>
      <p class="w-50 lh-sm unfocus-text">Click submit below to finish — then you will be redirected to your question thread details.</p>
      <div class="mt-3">
        <i class="fa-solid fa-ellipsis fa-beat-fade fa-2xl fs-1" style="display: none"></i>
      </div>
    </div>
</div>
<div class="navigation mb-5">
    <a id="nextButton" isDisabled="false" style="width: 15em; margin:auto" class="button cursor-pointer">Next&nbsp;<i class="fa-solid fa-caret-right"></i></a>
</div>
<script>
$(document).ready(function() {
  var currentStep = 1;
  var totalSteps = $('.step').length;

  $('#nextButton').on('click', function() {
    if($("#nextButton").attr("isDisabled") === "false"){
      if((currentStep+1) === 3){
        $("#nextButton").attr("isDisabled", "true")
      }
      if((currentStep+1) === 5){
        $("#nextButton").html("SUBMIT&nbsp;<i class='fa-regular fa-circle-check'></i>")
        $('#addQuestion-container').css('height', 75 + 'vh');
        $("#nextButton").attr('id', 'add-question-submit')

        $('#add-question-submit').on('click', function() {
          
          console.log($("input[name='question-title']").val())
          console.log(quillEditor.getContents())

          let newTitle = $("input[name='question-title']").val()
          let quillData = JSON.stringify(quillEditor.getContents()); 
          let requestHeaders = {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'Authorization': 'Bearer '+$.cookie('api_plain_token')
          };

          $.ajax({
              url: window.location.origin+"/api/"+'thread/post',
              method: 'POST',
              headers: requestHeaders,
              data: JSON.stringify({
                  title: newTitle,
                  quillData: quillData
              }),

              timeout: 5000,
              success: function (response) {

                console.log(response)

              },
              error: function () {
                  pushToastMessage('failed', 'fail to request to the server', 'fail')
              },
              beforeSend: function () {
                  animateProgressBar(true)

                  $('#step5 .fa-ellipsis').show();
              },
              complete: function () {
                  $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                  $('.progress-bar').addClass('opacity-0')
                  $('.progress-bar').removeClass('opacity-100')

                  $('#step5 .fa-ellipsis').hide();
              },
          });


        })
      }
      if (currentStep < totalSteps) {
          var $currentStep = $('#step' + currentStep);
          var $nextStep = $('#step' + (currentStep + 1));

          $currentStep.removeClass('active').addClass('slide-curr-step');
          $nextStep.addClass('active').addClass('slide-next-step');

          setTimeout(function() {
              $currentStep.removeClass('slide-curr-step');
              $nextStep.removeClass('slide-next-step');
          }, 500);

          setTimeout(function() {
              $currentStep.removeClass('slide-curr-step');
              $nextStep.removeClass('slide-next-step');
          }, 500);

          currentStep++;
      }
    }

  });

  $('#newTitle > input').keypress(function(event) {
    if (event.which === 13 || event.keyCode === 13) {
      event.preventDefault(); // Prevent form submission
      $('#nextButton').click()
    }
  });

});

</script>
@endsection
