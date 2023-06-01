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


function createNewCard(title, username, dateAgo, profileImgUrl, answerCount, isGotAnsVerified, threadUrl) {
    // var col = $('.col');
    let col = $('<div>', { class: 'col' });

    let card = $('<div>', { class: 'card position-relative w-100' });

    let cardBody = $('<div>', { class: 'card-body' });

    let userAvatar = $('<div>', {
        class: 'user-avatar-rounded me-2',
        style: 'background-image:url("' + profileImgUrl + '"); width: 2em; height: 2em;'
    });

    let cardSubtitle = $('<h6>', { class: 'card-subtitle text-muted me-2' }).text(username);

    let boltIcon = $('<i>', {
        class: 'fa-solid fa-bolt mb-2 orange',
        style: 'color:var(--yellow)',
        'data-bs-toggle': 'tooltip',
        'data-bs-placement': 'right',
        title: 'Hot Thread'
    });

    let dInlineFlex = $('<div>', { class: 'd-inline-flex align-items-center mb-2' });
    dInlineFlex.append(userAvatar, cardSubtitle, boltIcon);

    let cardTitle = $('<h5>', { class: 'card-title' }).text(title);

    let cardSubtitle2 = $('<h6>', { class: 'card-subtitle text-muted mb-3' }).text(dateAgo);

    let badges = $('<div>');

    let badgeAnsVerif;

    if (isGotAnsVerified) {
        badgeAnsVerif = $('<span>', { class: 'badge bg-light text-dark' }).text('answer verified ').append($('<i>', { class: 'fa-solid fa-circle-check' }))
    } else {
        badgeAnsVerif = $('<span>', { class: 'badge bg-light text-dark' }).text('no verified answer ').append($('<i>', { class: 'fa-solid fa-triangle-exclamation' }))
    }
    let suffix = answerCount > 1 ? 's' : '';
    let ansCount = answerCount > 99 ? '99+' : answerCount
    let badgeAnsCount = $('<span>', { class: 'badge bg-light text-dark me-1' }).text(ansCount + ' answer' + suffix)
    badges.append(
        badgeAnsCount,
        badgeAnsVerif,
        $('<a>', { class: 'card-link float-end', href: threadUrl }).append($('<i>', { class: 'fa-solid fa-share-from-square' }))
    );

    cardBody.append(dInlineFlex, cardTitle, cardSubtitle2, badges);

    card.append(cardBody);

    col.append(card);

    return col
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

function onResizeActions(viewportWidth, viewportHeight) {
    let header = $('header')
    let headerHeight = header.height()
    let part2Childs = $('section#part2 > div:nth-child(1), section#part2 > div:nth-child(2)')
    let threadDetails = $('#thread-details > div')
    let threadDetailsChilds = $('#thread-details > div > div')

    console.log(headerHeight)

    if (viewportWidth < 720) {
        $('section#thread-details').removeClass('m-5')

    } else {
        $('section#thread-details').addClass('m-5')
    }

    if (viewportWidth < 1024) {
        $('.suggestion-container ').css('top', headerHeight)
        part2Childs.addClass('flex-column')
        part2Childs.removeClass('flex-row')
        threadDetails.addClass('flex-column')
        threadDetails.removeClass('flex-row')
        threadDetailsChilds.addClass('w-100')
    } else {
        $('.suggestion-container ').css('top', '');
        part2Childs.removeClass('flex-column')
        part2Childs.addClass('flex-row')
        threadDetails.removeClass('flex-column')
        threadDetails.addClass('flex-row')
        threadDetailsChilds.removeClass('w-100')
    }
}

var resizeTimeout;
var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
var viewportHeight = window.innerHeight || document.documentElement.clientHeight;

function handleResize() {
    clearTimeout(resizeTimeout);

    resizeTimeout = setTimeout(function () {


        onResizeActions(viewportWidth, viewportHeight);
    }, 100);
}

window.addEventListener('resize', handleResize);


function clearModalShown() {
    for (const methodName in activeModal) {
        if (activeModal.hasOwnProperty(methodName)) {
            activeModal[methodName]()
        }
    }
    activeModal = {}
}

function pushToastMessage(title, body, status) {
    const now = moment();

    const pastTime = now.subtract(2, 'hours'); // Replace with your desired past time

    // Calculate the duration and display the time ago
    const duration = moment.duration(now.diff(pastTime));
    let timeAgo = duration.humanize();
    timeAgo = timeAgo + ' ago'

    const icons = {
        success: '<i class="fa-solid fa-square-check text-success"></i>',
        fail: '<i class="fa-solid fa-triangle-exclamation text-danger text-warning"></i>',
        info: '<i class="fa-solid fa-circle-info"></i>'
    }
    console.log(icons.success)
    if (status === 'fail') {
        $('#pushIcon').html(icons.fail)
    } else if (status === 'success') {
        $('#pushIcon').html(icons.success)
    } else {
        $('#pushIcon').html(icons.info)
    }

    $('#pushTitle').text(title);
    $('#pushBody').text(body);
    $('#pushAgo').text(timeAgo);
    $('#pushToast').toast('show');
}

function checkQuillImage(objectRoot) {
    let editorRoot = objectRoot

    let imagesCount = editorRoot.find('img').length;
    if (imagesCount > 1) {
        pushToastMessage("warning", "Cannot add more than one image, we removed the bottom most", "info")

        // let paragraphs = editorRoot.find('p');

        // paragraphs.each(function () {
        //     let imgElements = $(this).find('img');
        //     imgElements.slice(1).remove();
        //     console.log(imgElements)
        // });

        // let p_slices = paragraphs.slice(1).filter(':has(img)');
        // p_slices.remove()
        editorRoot.find('p:has(img)').not(':first').find('img').remove();

        editorRoot.find('p:has(img)').each(function () {
            let p = $(this);
            p.find('img').slice(1).remove();
        });


        console.log("FNFONDFNNEONOEN")

        $('.ql-image').off('click').on('click', function () {
            console.log('New click event listener');
        });

    }
}

$(document).ready(() => {
    pushToastMessage('title test', 'body test test test test test test', 'success')


    onResizeActions(window.innerWidth || document.documentElement.clientWidth, window.innerHeight || document.documentElement.clientHeight)


    function setSearchInputValue(value) {
        setTimeout(function () {
            let nonHeaderSearch = $('.search-not-header')
            nonHeaderSearch.val(value)
            nonHeaderSearch.trigger('input');
        }, 10);
    }
    setSearchInputValue()

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
            checkQuillImage($('#answer-quill-container > .ql-editor'))
            // console.log(imagesCount)
            console.log(quillEditor.root.innerHTML)
            $('#answer-content').html(quillEditor.root.innerHTML)
        })

    }
    if (window.location.pathname === "/add-question") {
        quillEditor = new Quill('#question-quill-container', {
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
            placeholder: 'write your question...',
            theme: 'snow'
        })

        var insertedImages = [];
        
        
        var addQuestionContainer = $('#addQuestion-container').height()
        quillEditor.on('text-change', function (delta) {
            // var editorContent = quillEditor.getContents();

            // editorContent.ops.forEach(function (op) {
            //     if (op.insert && op.insert.image) {
            //         insertedImages.push(op.insert.image);
            //     }
            // });

            // // Remove the newest image if there are multiple images
            // if (insertedImages.length > 1) {
            //     var newestImage = insertedImages[insertedImages.length - 1];

            //     var newestImageIndex = -1;
            //     for (var i = editorContent.ops.length - 1; i >= 0; i--) {
            //         var op = editorContent.ops[i];
            //         if (op.insert && op.insert.image === newestImage) {
            //             newestImageIndex = i;
            //             break;
            //         }
            //     }

            //     if (newestImageIndex !== -1) {
            //         editorContent.ops.splice(newestImageIndex, 1);
            //         quillEditor.setContents(editorContent);
            //     }
            // }


            console.log(insertedImages)





            checkQuillImage($('#question-quill-container > .ql-editor'))
            ///////////////
            // console.log(quillEditor.root.innerHTML)
            $('#answer-content').html(quillEditor.root.innerHTML)

            
            let questionQuillHeight = $('#question-quill-container').height()
            if (questionQuillHeight > (addQuestionContainer*0.72)) {
                $('#addQuestion-container').css('height', (questionQuillHeight-70 + (viewportHeight*0.42)) + 'px');
            }else{
                $('#addQuestion-container').css('height', 75 + 'vh');
            }


        })
    }
    if (window.location.pathname === "/threads") {
        const urlParams = new URLSearchParams(window.location.search);
        const params = {};

        console.log("DSDSADNSAUODSDOANSDNSAONDNNNNN")

        for (const [param, value] of urlParams) {
            params[param] = value;
        }

        if (params.hasOwnProperty('query') && params.query !== null) {
            console.log("PARAMQUERY" + params.query)
            setSearchInputValue(params.query)
            console.log("GET PARAM HAS QUERY KEY")
        }

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

    $('.hamburgerMenu-toggler').click(function () {
        $('#hamburgerMenu').toggleClass('show');
        $('.user-wrapper').toggleClass('z-index100')

        activeModal.hamburgerMenuToggle = () => {
            $('#hamburgerMenu').toggleClass('show');
            setTimeout(function () {
                $('.user-wrapper').toggleClass('z-index100')
            }, 100);
        }
        backdropCloseEvokeShow()
    });

    $('.hamburgerMenuAnswer-toggler').click(function () {
        // $(this).child('hamburgerMenuAnswer')
        let currentAnsMenu = $(this).siblings('.hamburgerMenuAnswer')
        let currentAnsWrapper = $(this).closest('.thread-contents-items')
        currentAnsMenu.toggleClass('show')
        currentAnsWrapper.toggleClass('z-index100')

        activeModal.hamburgerMenuToggle = () => {
            currentAnsMenu.toggleClass('show');
            setTimeout(function () {
                currentAnsWrapper.toggleClass('z-index100')
            }, 100);
        }
        backdropCloseEvokeShow()
    });

    backdropCloseEvoke.click(function () {
        console.log("Backdrop click")
        clearModalShown()
        backdropCloseEvokeHide()
    })

    // var quillReadOnly = new Quill('.quill-readOnly', {
    //     readOnly: true,
    //     theme: 'snow'
    // });


    var newQuestionTitle = $("input[name='question-title']")
    function fetchNewQuestionCheck() {
        let query = newQuestionTitle.val();

        $.ajax({
            url: 'https://dummyjson.com/products/search',
            method: 'GET',
            data: { q: query },
            timeout: 5000,
            success: function (response) {


                if(Object.keys(response.products).length > 0){
                    $('#step3 .fa-circle-xmark').show();
                    $('#step3 .fa-circle-check').hide();
                    pushToastMessage('Failed', 'Title is unavailable', 'fail')
                    $("#nextButton").attr("isDisabled", "true");
                }else if(Object.keys(response.products).length <= 0){
                    $('#step3 .fa-circle-xmark').hide();
                    $('#step3 .fa-circle-check').show();
                    pushToastMessage('Success', 'Title is available', 'success')
                    $("#nextButton").attr("isDisabled", "false");
                }

            },
            error: function () {
                pushToastMessage('failed', 'fail to request to the server', 'fail')
                $('#step3 .fa-circle-check').hide();
                $('#step3 .fa-circle-xmark').hide();
            },
            beforeSend: function () {
                animateProgressBar(true)

                $('#step3 .fa-circle-check').hide();
                $('#step3 .fa-circle-xmark').hide();
                $('#step3 .fa-ellipsis').show();
            },
            complete: function () {
                $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                $('.progress-bar').addClass('opacity-0')
                $('.progress-bar').removeClass('opacity-100')

                $('#step3 .fa-ellipsis').hide();
            },
        });

    }
    newQuestionTitle.on('input', () => {
        // searchResults.empty();
        $('#step3 .fa-ellipsis').show();
        $('#step3 .fa-circle-check').hide();
        $('#step3 .fa-circle-xmark').hide();

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fetchNewQuestionCheck, debounceDelay);
        console.log("GOT DEBOUNCE")
    })




    var r = document.querySelector(':root');
    var searchSuggest


    ///////////////////////////////////////////////////////////////////////
    var searchInput = $('#search-input');
    var searchResults = $('#suggestion-list');
    var startTypingH5 = $('.start-typing-h5');

    var debounceTimer;
    var debounceDelay = 600; // Debounce delay in milliseconds


    function toggleSuggestionContainer() {
        let suggestionContainer = $('.suggestion-container')
        suggestionContainer.toggleClass('d-none')
    }

    searchInput.focus(function () {
        console.log('focus')
        clearModalShown()

        if (!activeModal.hasOwnProperty('toggleSuggestionContainer')) {
            toggleSuggestionContainer()
            activeModal.toggleSuggestionContainer = () => toggleSuggestionContainer()
            backdropCloseEvokeShow()
        }
    });

    searchInput.focusout(function () {
        console.log('focus out')
        // backdropCloseEvoke.click()
    });

    searchInput.on('input', function () {
        if (searchInput.val().length == 0) {
            searchResults.hide();
            startTypingH5.show()
            console.log("SEARCH EMPTY NO DEBOUNCE")
        } else {
            searchResults.empty();
            searchResults.show();
            startTypingH5.hide()
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(fetchSearchResults, debounceDelay);
            console.log("GOT DEBOUNCE")
        }


    });

    //////////////////////////////////////////////////////////////////////////
    var nonHeaderSearch = $('.search-not-header')
    var nonHeaderSearchResults = $('#nonHeaderSearchResults')

    nonHeaderSearch.on('input', () => {
        // searchResults.empty();
        // searchResults.show();
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fetchNonHeaderSearchResults, debounceDelay);
        console.log("GOT DEBOUNCE")
    })

    ///////////////////////////////////////////////////////////////////////////
    function fetchNonHeaderSearchResults() {
        let query = nonHeaderSearch.val();
        nonHeaderSearchResults.html('<div class="skeleton-row p-4 skeleton"></div>'.repeat(10)); // Show skeleton loading

        setUrlSearchParams(query)

        $.ajax({
            url: 'https://dummyjson.com/products/search',
            method: 'GET',
            data: { q: query },
            timeout: 5000,
            success: function (response) {
                displayNonHeaderSearchResults(response);
                pushToastMessage('success', 'data has been loaded successfully', 'success')
            },
            error: function () {
                nonHeaderSearchResults.html('<div class="alert alert-danger">Failed to fetch search results.</div>');
                pushToastMessage('failed', 'fail to request to the server', 'fail')
            },
            beforeSend: function () {
                animateProgressBar(true)
            },
            // xhr: function () {
            //     var xhr = new window.XMLHttpRequest();

            //     // Progress event handler
            //     xhr.upload.addEventListener('progress', function (event) {
            //         if (event.lengthComputable) {
            //             var progress = Math.round((event.loaded / event.total) * 100);

            //             // Update the width of the progress bar dynamically
            //             $('.progress-bar').css('width', progress + '%');
            //         }
            //     }, false);

            //     return xhr;
            // },
            complete: function () {
                $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);

                $('.progress-bar').addClass('opacity-0')
                $('.progress-bar').removeClass('opacity-100')


                // setInterval(function () {
                //     $('.progress-bar').css('width', '0%').attr('aria-valuenow', 0);
                // }, 600);
            },
        });

    }

    function animateProgressBar(isStepping) {
        var progress = 20;
        var increment = 10;
        var delay = 300;
        var progressBar = $('.progress-bar');

        progressBar.css('width', progress + '%').attr('aria-valuenow', progress);


        if (isStepping) {
            progressBar.removeClass('opacity-0')
            progressBar.addClass('opacity-100')

            var interval = setInterval(function () {
                let currProgress = parseInt(progressBar.attr('aria-valuenow'))
                currProgress += increment;
                progressBar.css('width', currProgress + '%').attr('aria-valuenow', currProgress);
                console.log(currProgress)
                if (currProgress >= 100) {

                    clearInterval(interval);
                    progressBar.css('width', '100%').attr('aria-valuenow', '100');
                }
            }, delay);
        } else {
            progressBar.css('width', '20%').attr('aria-valuenow', '20');

            progressBar.removeClass('opacity-0')
            progressBar.addClass('opacity-100')
        }


    }

    window.addEventListener('popstate', function (event) {
        // Get the query parameter from the URL
        let searchQuery = new URLSearchParams(window.location.search).get('query');
        setSearchInputValue(searchQuery)
    });

    function setUrlSearchParams(query) {
        var url = new URL(window.location.href);
        let searchQuery = new URLSearchParams(window.location.search).get('query');
        if (searchQuery !== query) {
            url.searchParams.set('query', query);
            history.pushState(null, null, url.toString());
        }

    }

    function displayNonHeaderSearchResults(results) {
        nonHeaderSearchResults.empty();

        let total = Object.keys(results.products).length

        $('#threadList-totalData').html(total)

        if (total > 0) {
            for (var i = 0; i < total; i++) {
                let result = results.products[i];

                // if(result.title === null){
                //     console.log('---------------'+i)
                // }
                try {
                    var resultItem = createNewCard(result.title, result.brand, '5 days ago', result.thumbnail, result.stock, true, result.images[0]);
                } catch (error) {
                    console.log('---------------' + i)
                    console.log(result)
                }

                // console.log(resultItem)
                nonHeaderSearchResults.append(resultItem);
            }
        } else {
            nonHeaderSearchResults.append('<div class="alert alert-info">No results found.</div>');
        }
    }

    function fetchSearchResults() {
        let query = searchInput.val();
        searchResults.html('<div class="skeleton-row skeleton"></div>'.repeat(5)); // Show skeleton loadin

        $.ajax({
            url: 'https://dummyjson.com/products/search',
            method: 'GET',
            data: { q: query },
            success: function (response) {
                displaySearchResults(response);
                pushToastMessage('success', 'data has been loaded successfully', 'success')
            },
            error: function () {
                searchResults.html('<div class="alert alert-danger">Failed to fetch search results.</div>');
                pushToastMessage('failed', 'fail to request to the server', 'fail')
            }
        });
    }

    function displaySearchResults(results) {
        searchResults.empty();

        let total = Object.keys(results.products).length

        if (total > 0) {
            for (var i = 0; i < total; i++) {
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

    const avatarInput = $('#user-pic-update');
    const avatarPreview = $('#upload-avatar-preview');

    $('#upload-avatar-btn').on('click', function () {
        avatarInput.trigger('click');
    })

    avatarInput.on('change', function (event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();

            reader.onload = function (event) {
                avatarPreview.attr('src', event.target.result);
            };

            reader.readAsDataURL(event.target.files[0]);
        }
    });

});

