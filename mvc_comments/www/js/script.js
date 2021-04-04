'use strict';

// set event handlers after full load DOM elements
$(document).ready(function () {

    // submit button click event
    $('#addComment').on('submit', function (event) {
        addComment();
        event.preventDefault();
    });

    // back-to-top engine
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').on('click', function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });

});

function addComment() {
    jQuery.ajax({
        url: '/add/ajax',
        cache: false,
        data: {
            username: $('#username').val(),
            email: $('#email').val(),
            text: $('#text').val(),
            ajaxAddComment: 'ok',
        },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            $('.form-message').html('<div class="text-success">Комментарий добавлен.</div>');
            $('.form-message .text-success').hide(7000);
            //$('#comment-form').find('input, textarea').val('');
            $('#comment-form')[0].reset();
            console.log(data.data);
            showComment(data.data);
        },
        error: function (data) {
            $('.form-message').html('<div class="text-danger">' + data.responseJSON.error + '</div>');
            console.log(data);
        }
    });
}

function showComment(data) {
    let $commentList = $('#comments-list');
    $commentList.append(
        '<section style="position: absolute; left: -1000px; top: 0px;"' +
        '" class="col-md-6 col-lg-4" data-comment-id="' + data.id + '">' +
        '<div class="wrap"><div class="head">' + data.username + '</div>' +
        '<div class="email">' + data.email + '</div>' +
        '<div class="text text-break overflow-hidden">' + data.text +
        '</div></div></section>'
    );
    setTimeout(function () {
        $commentList.masonry('reloadItems');
        $commentList.masonry();
    }, 500);
}
