<?php

require_once BC_PATH_ROOT . 'admin/settings-page-content.php';

/**
 * custom option and settings
 */
function bc_settings_init() {
    // Register a new setting for "bc" page.
    register_setting( 'bc', 'bc_options' );

    // Register a new section in the "bc" page.
    add_settings_section(
        'bc_options_section',
        'Boosted comments plugin settings',
        'bc_options_section_callback',
        'bc'
    );

    // Register a new field in the "bc_options_section" section, inside the "bc" page.
    add_settings_field(
        'bc_field_comments_rating', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'Comments rating', 'bc' ),
        'bc_field_comments_rating_cb',
        'bc',
        'bc_options_section',
        array(
            'label_for'         => 'bc_field_comments_rating',
            'class'             => 'bc_row',
            'bc_custom_data' => 'custom',
        )
    );

    // Register a new field in the "bc_options_section" section, inside the "bc" page.
    add_settings_field(
        'bc_field_comments_ajax', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
        __( 'Comments ajax', 'bc' ),
        'bc_field_comments_ajax_cb',
        'bc',
        'bc_options_section',
        array(
            'label_for'         => 'bc_field_comments_ajax',
            'class'             => 'bc_row',
            'bc_custom_data' => 'custom',
        )
    );
}
add_action( 'admin_init', 'bc_settings_init' );

function bc_options_section_callback( $args ) {
    // silence
}

// Add the top level menu page.
function bc_options_page() {
    add_menu_page(
        'bc',
        'Boosted comments options',
        'manage_options',
        'bc',
        'bc_options_page_html'
    );
}

/**
 * Register our bc_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'bc_options_page' );
