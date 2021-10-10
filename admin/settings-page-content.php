<?php

function bc_field_comments_rating_cb( $args ) {
    $options = get_option( 'bc_options' );
    ?>

    <input name="bc_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" <?= (isset($options[$args['label_for']]) && $options[$args['label_for']] === 'on') ? 'checked' : '' ?> />

    <?php
}

function bc_field_comments_ajax_cb( $args ) {
    $options = get_option( 'bc_options' );
    ?>

    <input name="bc_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" <?= (isset($options[$args['label_for']]) && $options[$args['label_for']] === 'on') ? 'checked' : '' ?> />

    <?php
}

/**
 * Top level menu callback function
 */
function bc_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'bc_messages', 'bc_message', __( 'Settings Saved', 'bc' ), 'updated' );
    }

    // show error/update messages
    settings_errors( 'bc_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "bc"
            settings_fields( 'bc' );
            // output setting sections and their fields
            // (sections are registered for "bc", each field is registered to a specific section)
            do_settings_sections( 'bc' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}
