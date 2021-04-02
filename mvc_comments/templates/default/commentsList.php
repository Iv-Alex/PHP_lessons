<?php foreach ($comments as $comment) : ?>
    <h4><?= $comment->getName() ?></h4>
    <h5><?= $comment->getEmail() ?></h5>
    <p><?= $comment->getText() ?></p>
<?php endforeach; ?>


<script>
    'use strict';

    // set event handlers after full load DOM elements
    $(document).ready(function() {

        // submit button click event
        $('#addComment').on('click', function(event) {
            addComment();
            event.preventDefault();
        });

        // submit button click event
        $('#tryadd').on('click', function(event) {
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
            success: function(data) {
                $(".form-error").html("");
                
                console.log(data);
            },
            error: function(data) {
                $(".form-error").html(data.responseJSON.error);
                console.log(data);
            }
        });
    }
</script>