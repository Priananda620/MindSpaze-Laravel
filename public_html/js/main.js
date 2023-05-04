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



$(document).ready(() => {

    var r = document.querySelector(':root');
    var searchSuggest


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
        } else {
            console.log("bbbbb")
            toggler.setAttribute("checked", "false");
            r.style.setProperty('--base-color', '#888cb0')
            r.style.setProperty('--display-font-color', '#131c22')
            r.style.setProperty('--base-color-lifted-1', '#e0e3ff')
            r.style.setProperty('--section-bg', '#6a63ab')
            r.style.setProperty('--display-font-color-2nd', '#424c53')
        }

        // document.querySelector('input #dark-switch-input').checked = !toggler
    })

    $(".addCourseAction").on('click', (e) => {
        e.preventDefault()
        console.log("SHOOOOOWWWW")
        $("body").addClass("overlay-active")
        $("#register-body").addClass("d-none")
        $("#login-body").addClass("d-none")
        $("#addCourse-body").removeClass("d-none")
        $("#overlay-outter").removeClass("align-items-start")
        $("#overlay-outter").addClass("align-items-center")

        clearMsgOutput()
    })

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

    $("#xmark-button").on('click', (e) => {
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

    document.addEventListener('click', function (event) {
        var notContainsSearchSug = !ignoreSearchSug.contains(event.target)
        var notContainsOverlay = !ignoreOverlay.contains(event.target)
        var notContainsLoginShow

        for(i=0;i<ignoreLoginShow.length;i++){
            notContainsLoginShow = ignoreLoginShow[i].contains(event.target)
            if(notContainsLoginShow){
                break
            }
        }
        notContainsLoginShow = !notContainsLoginShow

        if (notContainsSearchSug) {
            console.log("CLOSE SEAARCH")
            $('#search-suggestion').css({ display: "none" })

        }

        if(notContainsLoginShow && notContainsOverlay && $("body").hasClass("overlay-active")){
            $('#xmark-button').click()
            console.log("CLOSE OVERYLTA")
        }
    })

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

});

