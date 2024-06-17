<?php


### Function includes
include 'inc/acf/acf.php';
include 'inc/acf/acf-json.php';
include 'inc/wp-reset.php';
include 'inc/post-types.php';
include 'inc/taxonomies.php';
include 'inc/blocks-allowed.php';
include 'inc/helpers.php';
include 'inc/globals.php';
include 'inc/excerpt.php';
include 'inc/walkers.php';
include 'inc/enqueue.php';
include 'inc/image-sizes.php';
include 'inc/shortcodes.php';
include 'inc/navigation.php';
include 'inc/options.php';
include 'inc/customizer.php';
include 'inc/admin-bar.php';
include 'inc/tinyMCE/tinymce.styles.php';
include 'inc/tinyMCE/tinymce.toolbars.php';
include 'inc/tinyMCE/tinymce.customizations.php';
include 'inc/user-roles.php';


add_filter( 'the_password_form', 'rawlins_custom_post_password_msg' );

/**
 * Add a message to the password form.
 *
 * @wp-hook the_password_form
 * @param   string $form
 * @return  string
 */
function rawlins_custom_post_password_msg( $form )
{
    // No cookie, the user has not sent anything until now.
    if ( ! isset ( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) )
        return $form;

    // Translate and escape.
    $msg = esc_html__( 'sorry, try again...', 'rawlins2023' );

    // We have a cookie, but it doesn’t match the password.
    $msg = "<p class='custom-password-message'>$msg</p>";

    return $msg . $form;
}