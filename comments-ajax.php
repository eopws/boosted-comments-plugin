<?php

/**
 * @TODO: error handling
 */

function bc_enqueue_comments_form_scripts() {
    // ajax comments
    wp_register_script('bc-ajax-comment-form', BC_URI_ROOT . 'js/ajax-comment-form.js', ['jquery'], '1.0.0', true);
    wp_localize_script('bc-ajax-comment-form', 'bcscript', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script('bc-ajax-comment-form');

    // comments rating
    wp_register_script('bc-comment-rating', BC_URI_ROOT . 'js/comment-rating.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('bc-comment-rating');

    // css
    wp_enqueue_style('bc-comment-rating-style', BC_URI_ROOT . 'css/comments.css');
}
add_action('wp_enqueue_scripts', 'bc_enqueue_comments_form_scripts');

function bc_add_comment() {
    $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );

    $user            = wp_get_current_user();
    $cookies_consent = ( isset( $_POST['wp-comment-cookies-consent'] ) );

    do_action( 'set_comment_cookies', $comment, $user, $cookies_consent );

    wp_list_comments(
        array(
            'style'       => 'ol',
            'short_ping'  => true,
        ),
        array( $comment )
    );

    die;
}
add_action( 'wp_ajax_sendcomment', 'bc_add_comment' );
