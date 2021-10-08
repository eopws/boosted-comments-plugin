"use strict";

(function($) {
    const $ratingInput     = $('#commentrating');
    const $ratingContainer = $('.bc-comment-rating');

    if (!$ratingContainer.length) {
        return;
    }

    $ratingContainer.find('i').mouseover(function(e) {
        let lessStar = $(this);

        while ((lessStar = $(lessStar.prev('.bc-comment-rating__star'))) && lessStar.length) {
            $(lessStar.find('svg')).attr('fill', '#F00');
        }

        $($(this).find('svg')).attr('fill', '#F00');
    });

    $ratingContainer.mouseout(syncStarsAndInput);

    $ratingContainer.find('i').click(function(e) {
        $ratingInput.val($(this).index() + 1);

        syncStarsAndInput();
    });

    function syncStarsAndInput() {
        const inputValue = $ratingInput.val();

        for (let i = 0; i < 5; i++) {
            const star      = $($ratingContainer.find('.bc-comment-rating__star')[i]);
            const fillColor = inputValue >= i + 1 ? '#F00' : '#898989';

            $(star.find('svg')).attr('fill', fillColor);
        }
    }
}(jQuery));
