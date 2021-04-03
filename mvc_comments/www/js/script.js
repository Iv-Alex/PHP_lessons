'use strict';

// set event handlers after full load DOM elements
$(document).ready(function () {

    // submit button click event
    $('#addComment').on('click', function (event) {
        addComment();
        event.preventDefault();
    });

    // submit button click event
    $('#tryadd').on('click', function (event) {
        this.innerHTML = 'Beginning';
        addComment();
    });

});

function addComment() {
    jQuery.ajax({
        url: "/add/ajax",
        cache: false,
        data: {
            username: $("#username").val(),
            email: $("#email").val(),
            text: $("#text").val(),
            ajaxAddComment: "ok",
        },
        type: "POST",
        dataType: "json",
        success: function (data) {
            $(".form-message").html('<div class="text-success">Комментарий добавлен. Спасибо!</div>');
            $(".form-message .text-success").hide(7000);
            $("#comment-form").find("input, textarea").val("");
            console.log(data);
        },
        error: function (data) {
            $(".form-message").html('<div class="text-danger">' + data.responseJSON.error + '</div>');

            console.log(data);
        }
    });
}
