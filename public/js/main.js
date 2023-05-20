function clearMsgOutput() {
    console.log("dsadsdda")
    $('#username-already-exist').css('display', 'none')
    $('#unmatch-password').css('display', 'none')
    $('#no-data').css('display', 'none')
    $('#unmatch-pass-length').css('display', 'none')
    $('button#register-action .fa-2x').css('display', 'none')

    $('#wrong_password').css('display', 'none')
    $('#email_not_registered').css('display', 'none')

    $('#SUCCESS-login').css('display', 'none')
    $('#SUCCESS-regis').css('display', 'none')
}



// function getCookie(cname) {
//     let name = cname + "=";
//     let decodedCookie = decodeURIComponent(document.cookie);
//     let ca = decodedCookie.split(';');
//     for (let i = 0; i < ca.length; i++) {
//         let c = ca[i];
//         while (c.charAt(0) == ' ') {
//             c = c.substring(1);
//         }
//         if (c.indexOf(name) == 0) {
//             return c.substring(name.length, c.length);
//         }
//     }
//     return "";
// }

// function loginRememberMeCookie() {
//     let json = getCookie("user_login")
//     if (json.length != 0) {
//         const obj = JSON.parse(json)

//         console.log("cooksie")

//         $("#login-body input[name='email']").val(obj.email)
//         $("#login-body input[name='password']").val("")
//         console.log("dasdsdada")
//         console.log(json)
//         console.log(obj.email)
//     }
// }

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function debounce(callback, delay) {
    let timeout;
    return function () {
        clearTimeout(timeout);
        timeout = setTimeout(callback, delay);
    }
}

function appendNewReaction(emoji, count) {
    let withoutPrefix = emoji.substring(2);
    let container = $('.thread-reaction > div:nth-child(2) > button')
    let isExist = false
    let existObj;
    container.each(function () {
        if ($(this).attr('decodedEmoji') == withoutPrefix) {
            isExist = true;
            existObj = $(this)
        }
    })
    console.log(isExist)
    if (isExist) {
        let currCount = existObj.find('span').html();
        currCount++

        if (currCount >= 100) {
            existObj.find('span').html('99+');
        } else {
            existObj.find('span').html(currCount);
        }
    } else {
        addNewReaction(emoji, count)
    }
}

function addNewReaction(emoji, count) {
    // let str = "\u1f92a";
    let withoutPrefix = emoji.substring(2);

    let decodedEmoji = String.fromCodePoint(parseInt(withoutPrefix, 16));
    // let decodedEmoji = unescape(emoji)
    let newReactionButton = $('<button>', {
        'type': 'button',
        'class': 'btn bg-light position-relative rounded-pill hide',
        'html': decodedEmoji + ' <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' + count + '</span>'
    });
    newReactionButton.attr('decodedEmoji', withoutPrefix);

    let container = $('.thread-reaction > div:nth-child(2)')

    container.append(newReactionButton)

    setTimeout(function () {
        newReactionButton.removeClass('hide')
    }, 50);

}
var activeModal = {};
function answerBoxToggle() {
    $("#answer-box").toggleClass("active")
    $("#answer-box").toggleClass("z-index100")
}


function backdropCloseEvokeShow() {
    const backdropCloseEvoke = $("#backdrop-close-evoke")
    backdropCloseEvoke.addClass('visibility-visible')
    backdropCloseEvoke.addClass('semi-transparent-bg')
}

function backdropCloseEvokeHide() {
    const backdropCloseEvoke = $("#backdrop-close-evoke")
    backdropCloseEvoke.removeClass('semi-transparent-bg')
    setTimeout(function () {
        backdropCloseEvoke.removeClass('visibility-visible')
    }, 380);

}


$(document).ready(() => {
    const backdropCloseEvoke = $("#backdrop-close-evoke")

    if (window.location.pathname === "/test") {
        quillEditor = new Quill('#answer-quill-container', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic'],
                    ['link', 'blockquote', 'code-block', 'image'],
                    [{ list: 'ordered' }, { list: 'bullet' }]
                ]
            },
            placeholder: 'write your answer...',
            theme: 'snow'
        })

        quillEditor.on('text-change', function () {
            console.log(quillEditor.root.innerHTML)
            $('#answer-content').html(quillEditor.root.innerHTML)
        })
    }

    const rootElement = $('#picmo-picker-container');
    const picker = picmo.createPicker({ rootElement });
    const emojiInput = $('#emoji-input > input');
    const emojiRegex = /\p{Extended_Pictographic}/u
    picker.addEventListener('emoji:select', event => {
        backdropCloseEvoke.click()
        emojiInput.val(event.emoji)
        console.log('Emoji selected:', emojiInput.val())

        const escapeSequence = '\\u' + emojiInput.val().codePointAt(0).toString(16);
        console.log(escapeSequence); // Outputs \uD83D\uDE09

        // let encodedEmoji = encodeURIComponent(emojiInput.val());
        // console.log(encodedEmoji)
        appendNewReaction(escapeSequence, 1)

        rootElement.addClass('d-none')
    });

    emojiInput.on('input', function () {
        const inputVal = $(this).val().trim();

        if (!emojiRegex.test(inputVal)) {
            $(this).val("")
            console.log("BBBBBBBBBBBBBB")
        } else {
            console.log("AAAAAAAAAAAAAA")
        }

    });

    function emojiSelectorToggle() {
        rootElement.toggleClass('d-none')
        rootElement.toggleClass("z-index100")
    }

    $('#emoji-input').on('click', (e) => {
        emojiSelectorToggle()
        activeModal.answerBoxToggle = () => emojiSelectorToggle()
        backdropCloseEvokeShow()
    })

    rootElement.on('click', (e) => {
        e.stopPropagation()
    })


    $('#chips-filter .badge').on('click', function () {
        $(this).toggleClass('bg-dark');
        $(this).toggleClass('bg-secondary');
        $(this).toggleClass('chips-first-select');
    });


    const dropdown = $('.dropdown');
    const options = dropdown.find('.dropdown-item');

    options.on('click', function () {

        const selectedValue = $(this).attr('data-value');

        // Update the button text
        const dropdownButton = dropdown.find('.dropdown-toggle');
        dropdownButton.text($(this).text());
        dropdownButton.attr("selected-value", $(this).text());

        const selectedOption = $('#selected-option');
        selectedOption.val(selectedValue);
    });



    $("#add-answer-btn").click(function () {
        answerBoxToggle()
        activeModal.answerBoxToggle = () => answerBoxToggle()
        backdropCloseEvokeShow()
    });


    backdropCloseEvoke.click(function () {
        console.log("Backdrop click")
        for (const methodName in activeModal) {
            if (activeModal.hasOwnProperty(methodName)) {
                activeModal[methodName]()
            }
        }
        activeModal = {}
        backdropCloseEvokeHide()
    })

    // var quillReadOnly = new Quill('.quill-readOnly', {
    //     readOnly: true,
    //     theme: 'snow'
    // });


    var r = document.querySelector(':root');
    var searchSuggest


    ///////////////////////////////////////////////////////////////////////
    var searchInput = $('#search-input');
    var searchResults = $('#suggestion-list');

    var debounceTimer;
    var debounceDelay = 600; // Debounce delay in milliseconds
    

    function toggleSuggestionContainer(){
        let suggestionContainer = $('.suggestion-container')
        suggestionContainer.toggleClass('d-none')
    }

    searchInput.focus( function () {
        console.log('focus')

        if(!activeModal.hasOwnProperty('toggleSuggestionContainer')){
            toggleSuggestionContainer()
            activeModal.toggleSuggestionContainer = () => toggleSuggestionContainer()
            backdropCloseEvokeShow()
        }
    });

    searchInput.focusout( function () {
        console.log('focus out')
        // backdropCloseEvoke.click()
    });

    searchInput.on('input', function () {
        if(searchInput.val().length == 0){
            searchResults.hide();
            console.log("SEARCH EMPTY NO DEBOUNCE")
        }else{
            searchResults.empty();
            searchResults.show();
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(fetchSearchResults, debounceDelay);
            console.log("GOT DEBOUNCE")
        }

        
    });

    function fetchSearchResults() {
        var query = searchInput.val();
        searchResults.html('<div class="skeleton-row skeleton"></div>'.repeat(5)); // Show skeleton loading

        $.ajax({
            url: 'https://dummyjson.com/products/search',
            method: 'GET',
            data: { q: query },
            success: function (response) {
                displaySearchResults(response);
            },
            error: function () {
                searchResults.html('<div class="alert alert-danger">Failed to fetch search results.</div>');
            }
        });
    }

    function displaySearchResults(results) {
        searchResults.empty();

        if (results.total > 0) {
            for (var i = 0; i < results.total; i++) {
                var result = results.products[i];
                var resultItem = $('<div class="card mb-3"><div class="card-body"><h5 class="card-title">' + result.title + '</h5><p class="card-text">' + result.description + '</p></div></div>');
                searchResults.append(resultItem);
            }
        } else {
            searchResults.append('<div class="alert alert-info">No results found.</div>');
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////


    // loginRememberMeCookie()
    // console.log("sdsaasd");


    const heroTextDouble = document.querySelectorAll(".hero-text-double")


    for (let i = 0; i < heroTextDouble.length; i++) {
        var delayInMilliseconds = 500

        setTimeout(function () {
            heroTextDouble[i].classList.add('logo-loaded')
        }, delayInMilliseconds);
    }




    const buttonDarkToggle = document.querySelector('#dark-switch-input')
    buttonDarkToggle.addEventListener('click', function () {
        const toggler = document.querySelector('input#dark-switch-input')
        const togglerVal = toggler.getAttribute("checked");

        console.log(togglerVal)

        if (togglerVal == "false" || togglerVal == "null") {
            console.log("aaaaaaaa")
            toggler.setAttribute("checked", "true");
            r.style.setProperty('--base-color', '#1d1d1d')
            r.style.setProperty('--display-font-color', '#eef5fa')
            r.style.setProperty('--base-color-lifted-1', '#2b2b2b')
            r.style.setProperty('--section-bg', '#27215a')
            r.style.setProperty('--display-font-color-2nd', '#c1c4c6')

            Cookies.set('dark_switch_status', true)
        } else {
            console.log("bbbbb")
            toggler.setAttribute("checked", "false");
            r.style.setProperty('--base-color', '#888cb0')
            r.style.setProperty('--display-font-color', '#131c22')
            r.style.setProperty('--base-color-lifted-1', '#e0e3ff')
            r.style.setProperty('--section-bg', '#6a63ab')
            r.style.setProperty('--display-font-color-2nd', '#424c53')

            Cookies.set('dark_switch_status', false)
        }

        // document.querySelector('input #dark-switch-input').checked = !toggler
    })

    if (Cookies.get('dark_switch_status') == 'false') {
        console.log(Cookies.get('dark_switch_status'))
        buttonDarkToggle.click()
    }

    $(".login-show").on('click', (e) => {
        e.preventDefault()
        console.log("SHOOOOOWWWW")
        $("body").addClass("overlay-active")
        $("#register-body").addClass("d-none")
        $("#login-body").removeClass("d-none")
        $("#overlay-outter").removeClass("align-items-start")
        $("#overlay-outter").addClass("align-items-center")

        clearMsgOutput()
    })


    $(".register-show").on('click', (e) => {
        e.preventDefault()
        console.log("SHOOOOOWWWW")
        $("body").addClass("overlay-active")
        $("#login-body").addClass("d-none")
        $("#register-body").removeClass("d-none")
        $("#overlay-outter").addClass("align-items-start")
        $("#overlay-outter").removeClass("align-items-center")

        clearMsgOutput()

    })

    $(".xmark-button").on('click', (e) => {
        e.preventDefault()
        console.log("CLOOOOOOSEEEEEEE")
        $("body").removeClass("overlay-active")
    })


    $(".clear-input-action").on('click', function (e) {
        e.preventDefault()
        $("#overlay-wrapper form input").val("")
        $("#overlay-wrapper textarea").val("")
        $("#overlay-wrapper select").val("")
    })

    $(".show-password").on('click', () => {
        if ($("#overlay-wrapper form input[name='password'], #overlay-wrapper form input[name='verify_pass']").attr('type') == "password") {
            $("#overlay-wrapper form input[name='password'], #overlay-wrapper form input[name='verify_pass']").attr('type', 'text');
            $(".show-password").html('hide&nbsp;<i class="fas fa-eye-slash"></i>');
        } else {
            $("#overlay-wrapper form input[name='password'], #overlay-wrapper form input[name='verify_pass']").attr('type', 'password');
            $(".show-password").html('show&nbsp;<i class="fas fa-eye"></i>');
        }
    })


    $(".show-password2").on('click', () => {
        if ($("#overlay-wrapper form input[name='verPass'], #overlay-wrapper form input[name='verify_pass']").attr('type') == "password") {
            $("#overlay-wrapper form input[name='verPass'], #overlay-wrapper form input[name='verify_pass']").attr('type', 'text');
            $(".show-password2").html('hide&nbsp;<i class="fas fa-eye-slash"></i>');
        } else {
            $("#overlay-wrapper form input[name='verPass'], #overlay-wrapper form input[name='verify_pass']").attr('type', 'password');
            $(".show-password2").html('show&nbsp;<i class="fas fa-eye"></i>');
        }
    })

    $("button#register-action").on('click', (e) => {
        console.log("REGISTEEERRRR")
        clearMsgOutput()

        let form = $("#register-body form")[0]
        let fd = new FormData(form)


        if (fd.get('email') != "" && fd.get('username') != "" && fd.get('phone') != "" && fd.get('address') != "" && fd.get('user_image64').length !== 0 && fd.get('password') != "" && fd.get('verify_pass') != "") {

            $('.fa-2x').addClass("d-block")
            e.preventDefault();

            let reader = new FileReader()
            reader.onloadend = () => {
                // console.log(reader.result)
                fd.delete("user_image64")
                fd.append("user_image64", reader.result)
                console.log(fd.get('user_image64'))
                console.log(fd.get("email"))

                $.ajax({
                    url: 'api/register.php',
                    method: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('.fa-2x').removeClass("d-block")
                        let json = response
                        console.log(json)

                        if (json.success) {
                            console.log(json.success);
                            console.log(json.account_data);
                            $('#SUCCESS-regis').css('display', 'unset')
                            // location.reload();
                        } else if (!json.success && json.no_data) {
                            console.log(json.success);
                            console.log("no_data:")
                            console.log(json.no_data)
                            $('#no-data').css('display', 'unset')
                        } else if (!json.success && json.password_verify_unmatch) {
                            console.log(json.success);
                            console.log("password_verify_unmatch:")
                            console.log(json.password_verify_unmatch)
                            $('#unmatch-password').css('display', 'unset')
                        } else if (!json.success && json.account_exist) {
                            console.log(json.success);
                            console.log("account_exist:")
                            console.log(json.account_exist);
                            $('#username-already-exist').css('display', 'unset');
                        } else if (!json.success && json.password_length_unmatch) {
                            console.log(json.success);
                            console.log("password_length_unmatch:")
                            console.log(json.password_length_unmatch);
                            $('#unmatch-pass-length').css('display', 'unset');
                        } else if (!json.success) {
                            console.log("success:")
                            console.log(json.success);
                        }
                    }
                })
            }
            reader.readAsDataURL(fd.get('user_image64'))

        } else {
            $('#no-data').css('display', 'unset')
            return
        }
    })

    $("button#login-action").on('click', (e) => {
        console.log("LOGGIIIIIN")
        clearMsgOutput()

        let form = $("#login-body form")[0]
        let fd = new FormData(form)


        if (fd.get('email') != "" && fd.get('password') != "") {

            $('.fa-2x').addClass("d-block")
            e.preventDefault();

            // if(fd.get('remember') == null){
            //     fd.set('remember') == "off"
            // }

            console.log(fd.get('remember'))

            // console.log(reader.result)
            console.log(fd.get('email'))
            console.log(fd.get("password"))

            $.ajax({
                url: 'api/login.php',
                method: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('.fa-2x').removeClass("d-block")
                    let json = response
                    console.log(json)

                    if (json.success) {
                        console.log(json.success);
                        console.log(json.account_data);
                        $('#SUCCESS-login').css('display', 'unset')
                        // location.reload();
                    } else if (!json.success && json.no_data) {

                        console.log(json.success)
                        console.log("no_data:")
                        console.log(json.no_data)

                        $('#no-data').css('display', 'unset')
                    } else if (!json.success && json.email_not_registered) {
                        console.log(json.success);
                        console.log("email_not_registered:")
                        console.log(json.email_not_registered)

                        $('#email_not_registered').css('display', 'unset')
                    } else if (!json.success && json.wrong_password) {
                        console.log(json.success);
                        console.log("wrong_password:")
                        console.log(json.wrong_password);
                        $('#wrong_password').css('display', 'unset')
                    }
                }
            })


        } else {
            $('#no-data').css('display', 'unset')
            return
        }
    })

    $('#search-box form input').focus(() => {
        $('#search-suggestion').css({ display: "unset" })
        console.log("dsadssdaas")
    })


    var ignoreSearchSug = document.getElementById('search-box')
    var ignoreOverlay = document.getElementById('overlay-wrapper')
    var ignoreLoginShow = document.getElementsByClassName('login-show')

    // document.addEventListener('click', function (event) {
    //     var notContainsSearchSug = !ignoreSearchSug.contains(event.target)
    //     var notContainsOverlay = !ignoreOverlay.contains(event.target)
    //     var notContainsLoginShow

    //     for (i = 0; i < ignoreLoginShow.length; i++) {
    //         notContainsLoginShow = ignoreLoginShow[i].contains(event.target)
    //         if (notContainsLoginShow) {
    //             break
    //         }
    //     }
    //     notContainsLoginShow = !notContainsLoginShow

    //     if (notContainsSearchSug) {
    //         console.log("CLOSE SEAARCH")
    //         $('#search-suggestion').css({ display: "none" })

    //     }

    //     if (notContainsLoginShow && notContainsOverlay && $("body").hasClass("overlay-active")) {
    //         $('#xmark-button').click()
    //         console.log("CLOSE OVERYLTA")
    //     }
    // })

    var searchSuggest
    var searchResultCount
    var searchSuggestElement = []

    $("#search-suggestion").on('click', '.search-suggestion-item', (e) => {
        let currentClicked = $(e.currentTarget).attr('subid')
        console.log(currentClicked)
        window.location.href = "http://127.0.0.1:8080/ContinuousProj/subjectDetails.php?subId=" + currentClicked
    })

    // $('#search-box form input').focusout(() => {
    // $('#search-suggestion').css({ display: "none" })
    // })



    $('#search-box form input').keyup(async (e) => {


        $('#search-suggestion').css({ display: "unset" })
        console.log("dsadssdaas")
        let skeletonItems = $('#search-box #search-suggestion .skeleton-item')

        $("div").not(".skeleton-item").remove(".search-suggestion-item")

        if ($('#search-box form input').val().trim().length != 0) {

            skeletonItems.addClass("d-inline-flex")

            $('#search-suggestion > h4').html("searching. . .")

            sleep(3000).then(() => {
                let sugInput = $('#search-box form input').val().trim().replace(/\s+/g, " ")

                if (sugInput.length !== 0 && (searchSuggest == "" || searchSuggest !== sugInput)) {
                    // console.log(sugInput)

                    searchSuggest = sugInput;
                    console.log("-------" + sugInput)

                    let fd = new FormData()
                    fd.append('string', sugInput)

                    searchSuggestElement = []

                    $.ajax({
                        url: 'api/searchSubjectSuggest.php',
                        method: 'POST',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            skeletonItems.removeClass("d-inline-flex")

                            let json = response
                            console.log(json)

                            if (json.success) {
                                console.log(json.data.length)

                                if (json.data.length !== 0) {

                                    $('#search-suggestion > h4').html("Search results (" + json.total_result + ")")

                                    searchResultCount = json.total_result

                                    for (var col in json.data) {
                                        console.log(json.data[col].subject_name)

                                        var divOutter = document.createElement("div")

                                        var pMagGlass = document.createElement("p")
                                        var iMagGlass = document.createElement("i")
                                        var divImage = document.createElement("div")
                                        var pSubjectName = document.createElement("p")

                                        $(divOutter).attr('class', 'd-inline-flex search-suggestion-item align-items-center')
                                        $(pMagGlass).attr('class', 'mb-0')
                                        $(pMagGlass).attr('style', 'margin-right: 1em')
                                        $(iMagGlass).attr('class', 'fa-solid fa-arrow-up-right-from-square')

                                        $(pSubjectName).attr('class', 'mb-0 mx-2')




                                        $(pSubjectName).html(json.data[col].subject_name)

                                        $(divImage).attr('style', "background-image:url('assets/courses/" + json.data[col].subject_id + ".png')")


                                        $(iMagGlass).appendTo(pMagGlass)
                                        $(pMagGlass).appendTo(divOutter)
                                        $(divImage).appendTo(divOutter)
                                        $(pSubjectName).appendTo(divOutter)

                                        searchSuggestElement[col] = divOutter

                                        $(divOutter).attr('subId', md5(json.data[col].subject_id))

                                        $(divOutter).appendTo("#search-suggestion")
                                    }
                                } else {
                                    $("div").not(".skeleton-item").remove(".search-suggestion-item")

                                    searchResultCount = 0

                                    $('#search-suggestion > h4').html("Not Found")
                                    // var divOutter = document.createElement("div")

                                    // // var divImage = document.createElement("div")
                                    // var pSubjectName = document.createElement("p")

                                    // $(divOutter).attr('class', 'd-inline-flex search-suggestion-item align-items-center')


                                    // $(pSubjectName).attr('class', 'mb-0 mx-2')

                                    // $(pSubjectName).html("not found")


                                    // // $(divImage).appendTo(divOutter)
                                    // $(pSubjectName).appendTo(divOutter)

                                    // $(divOutter).appendTo("#search-suggestion")

                                    searchSuggestElement = []
                                }

                                // $(heroNameH1).html(heroes[i]["heroName"])

                                // $('#SUCCESS-login').css('display', 'unset')
                                // location.reload();
                            }
                        }
                    })
                } else if (searchSuggest == sugInput && searchSuggestElement != null) {
                    // console.log(searchSuggestElement)
                    if (searchResultCount === 0) {
                        $('#search-suggestion > h4').html("Not Found")
                    } else {
                        $('#search-suggestion > h4').html("Search results (" + searchResultCount + ")")
                    }

                    skeletonItems.removeClass("d-inline-flex")
                    for (var i in searchSuggestElement) {
                        document.getElementById("search-suggestion").appendChild(searchSuggestElement[i]);
                    }


                    // searchSuggestElement.appendTo("#search-suggestion")
                } else {

                    $('#search-suggestion > h4').html("Type something. . .")
                    skeletonItems.removeClass("d-inline-flex")
                }


            })
        } else {

            $('#search-suggestion > h4').html("Type something. . .")
            skeletonItems.removeClass("d-inline-flex")
        }



        console.log("2222222222222")

        // skeletonItems.css({ display: "inline-flex" })

    })


    // $('#search-box form input').keyup((e) => {
    //     let skeletonItems = $('#search-box #search-suggestion .skeleton-item')

    //     // $.debounce( 1000, () => {
    //     //     let sugInput = $('#search-box form input').val().trim()
    //     //     if (sugInput.length !== 0) {
    //     //         console.log(sugInput)
    //     //         skeletonItems.css({ display: "none" })
    //     //     }
    //     // })
    //     console.log("22222");
    //     debounce(() => {
    //         let sugInput = $('#search-box form input').val().trim()
    //         if (sugInput.length !== 0) {
    //             console.log(sugInput)
    //             console.log("4444444444")
    //             skeletonItems.css({ display: "none" })
    //         }
    //     }, 250 )
    // })


    // $("#login-to-answer-btn").click(function(){
    //     $("body").addClass("overlay-active");
    //     $("#fixed-login-container").toggleClass("isActivated");
    //     $("#fixed-register-container").removeClass("isActivated");
    //     $("#fixed-full-content-wrapper").css('height', 'auto');
    //     $("#fixed-full-content-wrapper").css('width', 'auto');
    //     $("#fixed-full-content-wrapper h3").attr('style', '');
    //     $('.fa-2x').css('display', 'none');
    // });


    // $("#add-answer-btn").click(function () {
    //     $("#answer-box").toggleClass("active");
    // });

});

