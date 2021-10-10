<?php

function bc_enqueue_comments_rating_scripts() {
    // comments rating
    wp_register_script('bc-comment-rating', BC_URI_ROOT . 'js/comment-rating.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('bc-comment-rating');

    // css
    wp_enqueue_style('bc-comment-rating-style', BC_URI_ROOT . 'css/comments.css');
}

function bc_add_rating_stars() {
    $star_icon = '<svg fill="#898989" viewBox="0 0 512 512"><defs><style>.cls-1{fill:inherit;}</style></defs><title>star-other</title><path class="cls-1" d="M415.29,511.82a5.71,5.71,0,0,1-3.31-1.06L256,399.34,100,510.77a5.69,5.69,0,0,1-8.82-6l44.73-178.92L1.67,191.58a5.69,5.69,0,0,1,4-9.71h178.1L250.67,3.51c1.67-4.44,9-4.44,10.66,0l66.88,178.35h178.1a5.69,5.69,0,0,1,4,9.71L376.08,325.83,420.8,504.75a5.69,5.69,0,0,1-5.52,7.07ZM256,386.67a5.71,5.71,0,0,1,3.31,1.06L406,492.52,364.26,325.47a5.68,5.68,0,0,1,1.49-5.4L492.58,193.24H324.27a5.69,5.69,0,0,1-5.33-3.69L256,21.71,193.06,189.56a5.69,5.69,0,0,1-5.33,3.69H19.42L146.24,320.07a5.68,5.68,0,0,1,1.49,5.4L106,492.52l146.72-104.8A5.71,5.71,0,0,1,256,386.67Z"/></svg>';

    $star_icon = apply_filters('bc_star_icon', $star_icon);

    ?>
        <div class="bc-comment-form-rating">
            <i class="bc-comment-form-rating__star">
                <?= $star_icon; ?>
            </i>
            <i class="bc-comment-form-rating__star">
                <?= $star_icon; ?>
            </i>
            <i class="bc-comment-form-rating__star">
                <?= $star_icon; ?>
            </i>
            <i class="bc-comment-form-rating__star">
                <?= $star_icon; ?>
            </i>
            <i class="bc-comment-form-rating__star">
                <?= $star_icon; ?>
            </i>
        </div>

        <input id="commentrating" name="rating" type="hidden" value="0" />
    <?php
}

$options = get_option( 'bc_options' );

if (isset($options['bc_field_comments_rating']) && $options['bc_field_comments_rating'] === 'on') {
    add_filter('comment_form_top', 'bc_add_rating_stars');
    add_action('wp_enqueue_scripts', 'bc_enqueue_comments_rating_scripts');

    function bc_get_comment_rating_HTML($comment_id) {
        $rating_value = get_comment_meta($comment_id, 'rating', true);
    
        $star_icon = '<svg fill="!FILL_COLOR!" viewBox="0 0 512 512"><defs><style>.cls-1{fill:inherit;}</style></defs><title>star-other</title><path class="cls-1" d="M415.29,511.82a5.71,5.71,0,0,1-3.31-1.06L256,399.34,100,510.77a5.69,5.69,0,0,1-8.82-6l44.73-178.92L1.67,191.58a5.69,5.69,0,0,1,4-9.71h178.1L250.67,3.51c1.67-4.44,9-4.44,10.66,0l66.88,178.35h178.1a5.69,5.69,0,0,1,4,9.71L376.08,325.83,420.8,504.75a5.69,5.69,0,0,1-5.52,7.07ZM256,386.67a5.71,5.71,0,0,1,3.31,1.06L406,492.52,364.26,325.47a5.68,5.68,0,0,1,1.49-5.4L492.58,193.24H324.27a5.69,5.69,0,0,1-5.33-3.69L256,21.71,193.06,189.56a5.69,5.69,0,0,1-5.33,3.69H19.42L146.24,320.07a5.68,5.68,0,0,1,1.49,5.4L106,492.52l146.72-104.8A5.71,5.71,0,0,1,256,386.67Z"/></svg>';
    
        $star_icon = apply_filters('bc_star_icon', $star_icon);
    
        $filled_star_color = apply_filters('bc_filled_star_color', '#F00');
        $empty_star_color  = apply_filters('bc_empty_star_color', '#898989');
    
        ?>
    
        <div class="bc-comment-rating">
    
        <?php for ($i = 1; $i <= 5; $i++) : ?>
    
            <?php if ($rating_value >= $i) : ?>
                <i class="bc-comment-rating__star">
                    <?= str_replace('!FILL_COLOR!', $filled_star_color, $star_icon); ?>
                </i>
            <?php else : ?>
                <i class="bc-comment-rating__star">
                    <?= str_replace('!FILL_COLOR!', $empty_star_color, $star_icon); ?>
                </i>
            <?php endif; ?>
    
        <?php endfor;
    }
} else {
    function bc_get_comment_rating_HTML() {
        return '';
    }
}
