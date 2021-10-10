<?php

/**
 * @TODO: error handling
 */

function bc_enqueue_comments_form_scripts() {
    // ajax comments
    wp_register_script('bc-ajax-comment-form', BC_URI_ROOT . 'js/ajax-comment-form.js', ['jquery'], '1.0.0', true);
    wp_localize_script('bc-ajax-comment-form', 'bcscript', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script('bc-ajax-comment-form');
}

function bc_add_comment() {
    $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );

    add_comment_meta($comment->comment_ID, 'rating', $_POST['rating']);

    $user            = wp_get_current_user();
    $cookies_consent = ( isset( $_POST['wp-comment-cookies-consent'] ) );

    do_action( 'set_comment_cookies', $comment, $user, $cookies_consent );

    $list_callback = apply_filters('bc_comments_callback', '');

    $comments_args = array(
        'style'       => 'ol',
        'short_ping'  => true,
    );

    if ($list_callback) {
        $comments_args['callback'] = $list_callback;
    }

    wp_list_comments($comments_args, array( $comment ));

    die;
}

$options = get_option( 'bc_options' );

if (isset($options['bc_field_comments_ajax']) && $options['bc_field_comments_ajax'] === 'on') {
    add_action( 'wp_ajax_sendcomment', 'bc_add_comment' );
    add_action('wp_enqueue_scripts', 'bc_enqueue_comments_form_scripts');
}
