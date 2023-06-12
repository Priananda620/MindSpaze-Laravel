@extends('layout')
@section('content')
    <script src="//cdn.quilljs.com/1.0.0/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #addQuestion-container{
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
        <div id="step1" class="step active p-4 rounded-3">
            <object class="mb-5" style="width: 21vw;" data="assets/svg/undraw_welcoming_re_x0qo.svg"
                type="image/svg+xml"></object>
            <h2 class="">Thank you for interested in a part of our community!
            </h2>
            <p class=" text-muted-color">
                We're here to help answer your questions and provide valuable insights.
            </p>
        </div>
        <div id="step2" class="step p-4 rounded-3">
            <object class="mb-5" style="width: 21vw;" data="assets/svg/undraw_complete_design_re_h75h.svg"
                type="image/svg+xml"></object>
            <h3 class="text-muted-color">Keep In Mind</h3>
            <h2 class="">You Have to Follow Our Community Guidelines</h2>
            <a target="_blank" rel="noopener noreferrer" href="/about#community-guidelines">read&nbsp;<i
                    class="fa-solid fa-angles-right"></i></a>

        </div>
        <div id="step3" class="step p-5 rounded-3" style="justify-content: start;">
            <object class="mb-5 mt-3" style="width: 25vw;" data="assets/svg/undraw_text_field_htlv.svg"
                type="image/svg+xml"></object>
            <h2 class="mb-3 mt-4">Write Your Title</h2>
            <form method="POST" id="newTitle" class="mb-4" style="width: 52%;">
                <input type="text" name="question-title" class="bg-inherit-text p-3" placeholder="write your title..."
                    value="" required="">
            </form>
            <div>
                <i class="fa-solid fa-ellipsis fa-beat-fade fa-2xl fs-1" style="display: none"></i>
                <i class="fa-regular fa-circle-check text-success fa-2xl fs-2" style="display: none"></i>
                <i class="fa-regular fa-circle-xmark fa-2xl fs-2 text-danger" style="display: none"></i>
            </div>

        </div>
        <div id="step4" class="step p-5 rounded-3" style="justify-content: start;">
            <h2>Fill Your Question Details</h2>
            {{-- <img src="placeholder3.jpg" alt="Step 3 Image"> --}}
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <form enctype="multipart/form-data" method="POST" class="d-none" id="imageUploadForm">
                @csrf
                <input type="text" name="imageUpload">
                <input type="text" name="questionID">
            </form>


            <div style="width: 92%;" class="mt-4">
                <div id="question-quill-container">
                    <p> </p>
                    <p> </p>
                    <p> </p>
                    <p> </p>
                    <p> </p>
                    <p> </p>
                </div>
            </div>
            <div class="mt-5">Select your tags</div>
            <div class="mb-3 d-flex flex-row mt-3" style="width: 90%;">

                <button class="btn btn-secondary" type="disabled">
                    <i class="fa-solid fa-tags"></i>
                </button>
                <div id="chips-filter" class="overflow-scroll d-flex hide-scrollbar1 hide-scrollbar2 tags-badge">
                    @foreach ($tags as $tag)
                        <button data-tag-id="{{ $tag->encryptedId }}" class="badge bg-dark">{{ $tag->tag_name }}</button>
                    @endforeach

                </div>
            </div>
        </div>
        <div id="step5" class="step p-5 rounded-3">
            <object class="mb-5" style="width: 25vw;" data="assets/svg/undraw_done_re_oak4.svg"
                type="image/svg+xml"></object>
            <h2 class="mb-3 mt-4 fw-bold">All Good</h2>
            <p class="w-50 lh-sm unfocus-text">Click submit below to finish — then you will be redirected to your question
                thread details.</p>
            <div class="mt-3">
                <i class="fa-solid fa-ellipsis fa-beat-fade fa-2xl fs-1" style="display: none"></i>
            </div>
        </div>
    </div>
    <div class="navigation mb-5 rounded-3">
        <a id="nextButton" isDisabled="false" style="width: 15em; margin:auto" class="button cursor-pointer">Next&nbsp;<i
                class="fa-solid fa-caret-right"></i></a>
    </div>
    <script>
        $(document).ready(function() {
            var currentStep = 1;
            var totalSteps = $('.step').length;

            // function getBinaryImage(base64Image, questionEncId) {
            //     let format = base64Image.substring("data:image/".length, base64Image.indexOf(";base64"));
            //     let binaryImage = atob(base64Image.split(',')[1]);
            //     let blob = new Blob([binaryImage], {
            //         type: 'image/' + format
            //     });

            //     let formData = new FormData();
            //     formData.append('imageUpload', blob, 'image.' + format);
            //     formData.append('questionID', questionEncId);
            //     formData.append('_token', $("meta[name='csrf-token']").attr('content'));
            //     return formData;
            // }

            // function getBinaryImage2(base64Image, questionEncId) {
            //     let format = base64Image.substring(base64Image.indexOf('/') + 1,
            //         base64Image.indexOf(';base64'));

            //     let byteCharacters = atob(base64Image.split(',')[1]);
            //     let byteArrays = [];
            //     for (let i = 0; i < byteCharacters.length; i++) {
            //         byteArrays.push(byteCharacters.charCodeAt(i));
            //     }
            //     let blob = new Blob([new Uint8Array(byteArrays)], {
            //         type: 'image/' + format
            //     });


            //     let formData = new FormData();
            //     formData.append('imageUpload', blob, 'image.' + format);
            //     formData.append('questionID', questionEncId);
            //     formData.append('_token', $("meta[name='csrf-token']").attr(
            //         'content'));
            //     return formData;
            // }

            // function setImgToInput(base64Image) {
            //     var base64Image = "your-base64-image-string";

            //     // Convert the base64 string to a Blob
            //     var byteCharacters = atob(base64Image.split(',')[1]);
            //     var byteArrays = [];
            //     for (var i = 0; i < byteCharacters.length; i++) {
            //         byteArrays.push(byteCharacters.charCodeAt(i));
            //     }
            //     var blob = new Blob([new Uint8Array(byteArrays)], {
            //         type: 'image/png'
            //     });

            //     // Create a File object from the Blob
            //     var file = new File([blob], 'image.png', {
            //         type: blob.type
            //     });

            //     // Find the input file element
            //     var inputFile = document.getElementById('newImageFile');

            //     // Create a DataTransfer object
            //     var dataTransfer = new DataTransfer();

            //     // Add the File object to the DataTransfer object
            //     dataTransfer.items.add(file);

            //     // Set the DataTransfer object as the files property of the input file element
            //     inputFile.files = dataTransfer.files;
            // }

            // function dataURLtoFile(dataurl, filename) {
            //     var arr = dataurl.split(','),
            //         mime = arr[0].match(/:(.*?);/)[1],
            //         bstr = atob(arr[arr.length - 1]),
            //         n = bstr.length,
            //         u8arr = new Uint8Array(n);
            //     while (n--) {
            //         u8arr[n] = bstr.charCodeAt(n);
            //     }
            //     return new File([u8arr], filename, {
            //         type: mime
            //     });
            // }

            function imageUpload() {
                var questionIdVal = $('input[name="questionID"]').val()
                var base64_imageTempQuill2 = $('input[name="imageUpload"]').val()
                var csrfToken = $("meta[name='csrf-token']").attr('content')
                if ($('input[name="questionID"]').val() !== "") {

                    // console.log(base64_imageTempQuill)
                    // console.log($('input[name="questionID"]').val() + "  -----------------------------------------------")
                    let formData = new FormData();

                    formData.append('_token', csrfToken);
                    formData.append('image_upload', base64_imageTempQuill2);
                    formData.append('question_id', questionIdVal);

                    console.log(formData)

                    let requestHeaders = {
                        'X-CSRF-TOKEN': csrfToken
                    };

                    $.ajax({
                        // url: window.location.origin + "/api/" + 'thread/upload-image',
                        url: window.location.origin + "/" +
                            'thread/upload-image',
                        method: 'POST',
                        headers: requestHeaders,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log("SUCCESS IMAGE")
                            window.location.href = window.location.origin + '/thread/details?question_id='+response.question_id;
                        },
                        error: function(xhr, status, error) {
                            pushToastMessage('failed',
                                'failed, check console (image)', 'fail')
                        },
                        beforeSend: function() {
                            // animateProgressBar(true)

                            // $('#step5 .fa-ellipsis').show();
                        },
                        complete: function() {
                            $('.progress-bar').css('width', '100%').attr(
                                'aria-valuenow', 100);
                            $('.progress-bar').addClass('opacity-0')
                            $('.progress-bar').removeClass('opacity-100')

                            $('#step5 .fa-ellipsis').hide();
                        },
                    });
                }
            }
            // var base64_imageTempQuill = ""

            $('#nextButton').on('click', function() {
                if ($("#nextButton").attr("isDisabled") === "false") {
                    if ((currentStep + 1) === 3) {
                        $("#nextButton").attr("isDisabled", "true")
                    }
                    if ((currentStep + 1) === 5) {
                        $("#nextButton").html("SUBMIT&nbsp;<i class='fa-regular fa-circle-check'></i>")
                        $('#addQuestion-container').css('height', 75 + 'vh');
                        $("#nextButton").attr('id', 'add-question-submit')

                        $('#add-question-submit').on('click', function() {

                            let quillRemoveImage = JSON.parse(JSON.stringify(quillEditor
                                .getContents()));


                            quillRemoveImage.ops.forEach(function(item) {
                                if (item.insert && item.insert.image) {

                                    // base64_imageTempQuill = item.insert.image
                                    $('input[name="imageUpload"]').val(String(item.insert
                                        .image))
                                    item.insert.image = "<<IMAGE MOVED>>";
                                }
                            })


                            let tagsSelectedEncID = [];
                            $('.chips-first-select').each(function() {
                                tagsSelectedEncID.push($(this).attr('data-tag-id'));
                            })

                            let tagsSelectedEncIDJSON = JSON.stringify(tagsSelectedEncID);

                            let newTitle = $("input[name='question-title']").val()
                            let quillData = JSON.stringify(quillRemoveImage);
                            let requestHeaders = {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': 'Bearer ' + $.cookie('api_plain_token')
                            };

                            if ($('input[name="questionID"]').val() == "") {
                                $.ajax({
                                    url: window.location.origin + "/api/" + 'thread/post',
                                    method: 'POST',
                                    headers: requestHeaders,
                                    data: JSON.stringify({
                                        title: newTitle,
                                        quillData: quillData,
                                        tags: tagsSelectedEncIDJSON
                                    }),

                                    timeout: 5000,
                                    success: function(response) {

                                        // currentNewQuestionID = response.question_id
                                        $('input[name="questionID"]').val(String(JSON
                                            .parse(JSON.stringify(response
                                                .question_id))))

                                        if (response.question_id !== null && $(
                                                'input[name="imageUpload"]').val() !== "") {
                                            imageUpload()
                                        }else{
                                            window.location.href = window.location.origin + '/thread/details?question_id='+response.question_id;
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
                            }

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

        // var data = quillEditor.getContents();

        // data.ops.forEach(function(item) {
        //   if (item.insert && item.insert.image) {
        //     item.insert.image = "new_image_value";
        // console.log(item.insert.image);
        //   }
        // })
    </script>
@endsection



{{--
    {
        "ops":
        [
            {
                "insert":"Header\n\nheader header texttttt\n\nsfefefw"
            },
            {
                "attributes":{"code-block":true},
                "insert":"\n"
            },
            {
                "insert":"\nfeefe"
            },
            {
                "attributes":{"blockquote":true},
                "insert":"\n"
            },
            {
                "insert":
                {"image":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA6sAAACQCAYAAADut/12AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAEnQAABJ0Ad5mH3gAAEJbSURBVHhe7Z0PcB3Fned/siFmQzA2hKAnyzYiS6CSgHFk5Agv0RbH1ZHVgsLpzJ8rVwWoiyt2CYPDlaLbyzmJN5UzqssajMpQzha"}
            },
            {"insert":"\n\n\n"}
        ]
    }
--}}
