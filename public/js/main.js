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
var urlHash = window.location.hash;

function animateProgressBar(isStepping) {
    let progress = 20;
    let increment = 10;
    let delay = 300;
    let progressBar = $('.progress-bar');

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


function createNewCard(title, username, dateAgo, profileImgUrl, answerCount, hasAnswerVerified, threadUrl, isBoltUser, isHotThread) {
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
        class: 'fa-solid fa-bolt mb-1 orange',
        style: 'color:var(--yellow)',
        'data-bs-toggle': 'tooltip',
        'data-bs-placement': 'right',
        title: 'Bolt User'
    });

    var hotBadge = $('<span></span>').addClass('ms-2 badge bg-light text-dark me-1 mb-1 border border-warning').text('Hot');


    let dInlineFlex = $('<div>', { class: 'd-inline-flex align-items-center mb-2' });
    dInlineFlex.append(userAvatar, cardSubtitle, isBoltUser ? boltIcon : '', isHotThread ? hotBadge : '');

    let cardTitle = $('<h5>', { class: 'card-title' }).text(title);

    let cardSubtitle2 = $('<h6>', { class: 'card-subtitle text-muted mb-3' }).text(dateAgo);

    let badges = $('<div>');

    let badgeAnsVerif;

    if (hasAnswerVerified) {
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
    let container = $('.picmoInit').closest('.thread-reaction').find('.reacted-emoji-container').find('button');
    // let container = $('.thread-reaction > div:nth-child(2) > button')
    let isExist = false
    let existObj;
    container.each(function () {
        console.log($(this).attr('decodedEmoji'))
        if ($(this).attr('decodedEmoji') == withoutPrefix) {
            isExist = true;
            existObj = $(this)
        }
    })
    console.log(isExist)
    if (isExist) {
        let currCount = existObj.find('span').attr('data-emoji-count');
        currCount++

        if (currCount >= 100) {
            existObj.find('span').html('99+');
            existObj.find('span').attr('data-emoji-count', currCount);
        } else {
            existObj.find('span').html(currCount);
            existObj.find('span').attr('data-emoji-count', currCount);
        }
    } else {
        addNewReaction(emoji, 1)
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
        'html': decodedEmoji + ' <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" data-emoji-count="' + count + '">' + count + '</span>'
    });
    newReactionButton.attr('decodedEmoji', withoutPrefix)

    let container = $('.picmoInit').closest('.thread-reaction').find('.reacted-emoji-container')

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
        $('#addQuestion-container object').css('width', '40vw')

    } else {
        $('section#thread-details').addClass('m-5')
        $('#addQuestion-container object').css('width', '25vw')
    }

    if (viewportWidth < 1024) {
        $('.suggestion-container ').css('top', headerHeight)
        part2Childs.addClass('flex-column')
        part2Childs.removeClass('flex-row')
        threadDetails.addClass('flex-column')
        threadDetails.removeClass('flex-row')
        threadDetailsChilds.addClass('w-100')
        $('#header-nav').addClass("w-100")
        $('#header-nav > form').addClass("w-100")
        $('#newTitle').css('width', '95%')
        $('#step5 p').addClass('w-90')
        $('#step5 p').removeClass('w-50')
        console.log("SMALLER")
    } else {
        $('.suggestion-container ').css('top', '');
        part2Childs.removeClass('flex-column')
        part2Childs.addClass('flex-row')
        threadDetails.removeClass('flex-column')
        threadDetails.addClass('flex-row')
        threadDetailsChilds.removeClass('w-100')
        $('#header-nav').removeClass("w-100")
        $('#header-nav > form').removeClass("w-100")
        $('#newTitle').css('width', '52%')
        $('#step5 p').removeClass('w-90')
        $('#step5 p').addClass('w-50')

        console.log("BIGGER")
    }
}

var resizeTimeout;
var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
var viewportHeight = window.innerHeight || document.documentElement.clientHeight;

function handleResize() {
    clearTimeout(resizeTimeout);
    let viewportWidth2 = window.innerWidth || document.documentElement.clientWidth;
    let viewportHeight2 = window.innerHeight || document.documentElement.clientHeight;

    resizeTimeout = setTimeout(function () {


        onResizeActions(viewportWidth2, viewportHeight2);
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

        editorRoot.find('p:has(img)').not(':first').find('img').remove();

        editorRoot.find('p:has(img)').each(function () {
            let p = $(this);
            p.find('img').slice(1).remove();
        });


        console.log("FNFONDFNNEONOEN")

        $('.ql-image').off('click').on('click', function () {
            console.log('New click event listener');
        });
        return true;
    }
    return false;
}

$(document).ready(() => {


    $('.logout-action').on('click', function (e) {
        e.preventDefault()
        console.log("LOGOUT")

        $.removeCookie('api_plain_token', { path: '/' });


        window.location.href = $(this).attr('href');
    })

    // Check if the URL contains a specific #id
    setTimeout(function () {

        if (urlHash === '#login') {
            $('#login-hero-btn').click()
        } else if (urlHash === '#register') {
            $('#register-hero-btn').click()
        }
    }, 100);
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

    if (window.location.pathname === "/thread-detail") {
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


        var addQuestionContainer = $('#addQuestion-container').innerHeight()

        var currquestionQuillHeight = $('#question-quill-container').height()
        var additionalheight = $("#step4 > div:nth-of-type(2)").outerHeight(true) + $("#step4 > div:nth-of-type(3)").outerHeight(true) + $("#step4 > h2").outerHeight(true) + 120;
        quillEditor.on('text-change', function (delta) {


            checkQuillImage($('#question-quill-container > .ql-editor'))
            let curraddQuestionContainer = $('#addQuestion-container').height()
            let questionQuillHeight = $('#question-quill-container').height()
            if (currquestionQuillHeight < questionQuillHeight && questionQuillHeight > (addQuestionContainer - additionalheight)) {
                let currHeightChange = questionQuillHeight - currquestionQuillHeight
                $('#addQuestion-container').css('height', (currHeightChange + curraddQuestionContainer) + 'px');
            } else if (currquestionQuillHeight > questionQuillHeight && questionQuillHeight > (addQuestionContainer - additionalheight)) {
                let currHeightChange = currquestionQuillHeight - questionQuillHeight
                $('#addQuestion-container').css('height', (curraddQuestionContainer - currHeightChange) + 'px');
            } else if (questionQuillHeight < (addQuestionContainer - additionalheight)) {
                $('#addQuestion-container').css('height', 75 + 'vh');
            } else {
                setTimeout(function () {
                    let currHeightChange = questionQuillHeight - currquestionQuillHeight
                    $('#addQuestion-container').css('height', (currHeightChange + curraddQuestionContainer) + 'px');
                }, 200);
            }
            currquestionQuillHeight = questionQuillHeight
            setTimeout(function () {
                if (checkOverflow($('#addQuestion-container'), $('#addQuestion-container > div:nth-of-type(4) > div:last-child'))) {
                    let childHeight = $('#addQuestion-container > div:nth-of-type(4) > div:last-child').position().top + $('#addQuestion-container > div:nth-of-type(4) > div:last-child').outerHeight()
                    let parentHeight = $('#addQuestion-container').position().top + $('#addQuestion-container').outerHeight()
                    let overflowHeight = (childHeight - parentHeight)
                    $('#addQuestion-container').css('height', (overflowHeight + curraddQuestionContainer + 210) + 'px');
                    console.log("is overfowing")
                } else {
                    console.log("not overfowing")
                }
            }, 100);
        })
    }

    function checkOverflow(parent, child) {
        var parentHeight = parent.height();
        var childTop = child.position().top;
        var childBottom = childTop + child.outerHeight();

        return childTop < 0 || childBottom > parentHeight;
    };
    ///////////////////////////////////////////////////////

    // var parentElement = $('#question-quill-container > .ql-editor');
    // var childChanges = [];

    // // Create a new MutationObserver
    // var observer = new MutationObserver(function (mutations) {
    //     childChanges = []
    //     mutations.forEach(function (mutation) {
    //         // Check if the childList or characterData property changed
    //         if (mutation.type === 'childList' || mutation.type === 'characterData') {
    //             // Log the new child count
    //             // console.log('Child count changed:', parentElement.children().length);

    //             var childCount = parentElement.children().length;

    //             // Log the inner HTML of each child
    //             var childHTMLs = parentElement.children().map(function (index, child) {
    //                 return $(child).html();
    //             }).get();

    //             var change = {
    //                 childCount: childCount,
    //                 childHTMLs: childHTMLs
    //             };

    //             // Push the change object into the array

    //             childChanges.push(change);
    //         }
    //     });
    //     console.log(childChanges)
    // });

    // // Configure the observer to watch for changes in the childList and characterData
    // var observerConfig = {
    //     childList: true,
    //     characterData: true,
    //     subtree: true // Set to true if you want to observe changes in all descendant elements as well
    // };

    // // Start observing the parent element
    // observer.observe(parentElement[0], observerConfig);







    ///////////////////////////////////////////////////////
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

    function initAllPicmo() {
        const rootElement = $('.picmoInit');
        const picker = picmo.createPicker({ rootElement });
        const emojiInput = $('.picmoInit').siblings('input');
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


        rootElement.on('click', (e) => {
            e.stopPropagation()
        })
    }

    initAllPicmo()



    var currPicmoSelector = $()
    function emojiSelectorToggle() {

    }


    $('.emoji-input').on('click', function () {
        console.log("fewfewfefeff")
        currPicmoSelector = $(this).children('.picmo-picker-container');
        // currPicmoSelector.replaceWith($('.picmoInit'));

        if (!currPicmoSelector.hasClass('picmoInit')) {
            // let elementAContent = $('.picmoInit').html();
            // currPicmoSelector.empty().html(elementAContent);
            currPicmoSelector.empty()
            $('.picmoInit').empty()
            $('.picmoInit').removeClass('picmoInit')
            currPicmoSelector.addClass('picmoInit')
            initAllPicmo()
        }

        currPicmoSelector.toggleClass('d-none')
        currPicmoSelector.toggleClass("z-index100")
        console.log(currPicmoSelector)

        activeModal.emojiSelectorToggle = () => {
            let currPicmoSelector2 = currPicmoSelector
            currPicmoSelector2.toggleClass('d-none')
            currPicmoSelector2.toggleClass("z-index100")
            $('.picmoInit').replaceWith(currPicmoSelector2);
        }
        backdropCloseEvokeShow()
    })


    /////////////////////////////////////
    var tagsSelectedEncID = [];

    $('#chips-filter .badge').on('click', function () {
        $(this).toggleClass('bg-dark');
        $(this).toggleClass('bg-secondary');
        $(this).toggleClass('chips-first-select');

        $('.search-not-header').trigger('input');

        tagsSelectedEncID = []
        $('.chips-first-select').each(function () {

            tagsSelectedEncID.push($(this).attr('data-tag-id'));
        })
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
        let requestHeaders = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + $.cookie('api_plain_token')
        };

        $.ajax({
            url: window.location.origin + "/api/" + 'get-threads',
            method: 'GET',
            headers: requestHeaders,
            data: { query: query },
            timeout: 5000,
            success: function (response) {

                // Object.keys(response.threads).length
                if (response.total > 0) {
                    $('#step3 .fa-circle-xmark').show();
                    $('#step3 .fa-circle-check').hide();
                    pushToastMessage('Failed', 'Title is unavailable', 'fail')
                    $("#nextButton").attr("isDisabled", "true");
                } else if (response.total <= 0) {
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

        $("#nextButton").attr("isDisabled", "true");

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


        let tagsSelectedEncIDJSON = JSON.stringify(tagsSelectedEncID);

        let requestHeaders = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + $.cookie('api_plain_token')
        };

        $.ajax({
            url: window.location.origin + "/api/" + 'get-threads',
            method: 'POST',
            headers: requestHeaders,
            data: JSON.stringify({
                query: query,
                tags: tagsSelectedEncIDJSON
            }),
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

        let total = Object.keys(results.threads).length

        $('#threadList-totalData').html(total)

        if (total > 0) {
            for (var i = 0; i < total; i++) {
                let result = results.threads[i];

                // if(result.title === null){
                //     console.log('---------------'+i)
                // }
                try {
                    var resultItem = createNewCard(result.title, result.user.username, result.elapsed_time,
                        window.location.origin + '/assets/user_images/' + result.user.user_profile_img,
                        result.answer.length, result.hasAnswerVerified, "/", result.user.is_bolt_user, result.isHotThread);

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

        let requestHeaders = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + $.cookie('api_plain_token')
        };

        $.ajax({
            url: window.location.origin + "/api/" + 'get-threads',
            method: 'GET',
            headers: requestHeaders,
            data: { query: query },
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

        let total = Object.keys(results.threads).length

        if (total > 0) {
            for (var i = 0; i < total; i++) {
                var result = results.threads[i];
                // var resultItem = $('<div class="card mb-3"><div class="card-body"><h5 class="card-title">' + result.title + '</h5><p class="card-text">' + result.user.username + '</p>' + '</div></div>');
                var cardDiv = $('<div>', {
                    class: 'card mb-3'
                });

                var cardBodyDiv = $('<div>', {
                    class: 'card-body'
                });

                var cardTitle = $('<h5>', {
                    class: 'card-title',
                    text: result.title
                });

                var cardText = $('<p>', {
                    class: 'card-text',
                    text: result.user.username
                });

                if (result.hasAnswerVerified) {
                    var spanBadge = $('<span>', {
                        class: 'badge bg-light text-dark',
                    });
                    var checkIcon = $('<i>', {
                        class: 'fa-solid fa-circle-check'
                    });
                    var spanText = ' answer verified';
                    spanBadge.append(checkIcon, spanText);
                } else {
                    var spanBadge = $('<span>', {
                        class: 'badge bg-light text-dark',
                    });
                    var checkIcon = $('<i>', {
                        class: 'fa-solid fa-triangle-exclamation'
                    });
                    var spanText = ' no verified answer';
                    spanBadge.append(checkIcon, spanText);
                }

                cardBodyDiv.append(cardTitle, cardText, spanBadge);
                cardDiv.append(cardBodyDiv);

                searchResults.append(cardDiv);
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

