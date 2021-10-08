(function($) {
    const $commentForm = $('#commentform');

    if (!$commentForm.length) { // don't use the script, if the comment form is not present
        return;
    }

    $commentForm.submit(function(e) {
        e.preventDefault();

        const $respond = $('#respond');
        const $commentList = $('.comment-list');

        $.ajax({
            type: $commentForm.attr('method'),
            url: bcscript.ajaxurl,
            data: $commentForm.serialize() + '&action=sendcomment',
            beforeSend: function() {
                formSubmitSuccess($commentForm);
            },
            success: function(newComment) {
                if ($commentList.length) {
                    if ($respond.parent().hasClass('comment')) {
                        if( $respond.parent().children('.children').length > 0 ) {
                            $respond.parent().children('.children').append(newComment);
                        } else {
                            $respond.after('<ol class="children">' + newComment + '</ol>');
                        }
                    } else {
                        $commentList.append(newComment);
                    }
                } else {
                    $respond.before('<ol class="comment-list">' + newComment + '</ol>');
                }
            }
        });
    });

    function formSubmitSuccess($form) {
        $form.trigger('reset');
    }
})( jQuery );
