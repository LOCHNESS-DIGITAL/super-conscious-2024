<?php
### Cusotomize your project's user roles here.



### Only keep the Administrator, Editor, and Author roles
function rawlins_remove_unused_roles(){

    if( get_role('subscriber') ){
        remove_role( 'subscriber' );
    }

    if( get_role('contributor') ){
        remove_role( 'contributor' );
    }

}
add_action( 'after_setup_theme', 'rawlins_remove_unused_roles' );

if( get_role('subscriber') ){
    rawlins_remove_unused_roles();
}





### Remove Yoast `SEO Manager` role
if ( get_role('wpseo_manager') ) {
    remove_role( 'wpseo_manager' );
}

### Remove Yoast `SEO Editor` role
if ( get_role('wpseo_editor') ) {
    remove_role( 'wpseo_editor' );
}


function rawlins_custom_login_redirect( $redirect_to, $request, $user ) {
    // Get the current user's role
    $user_role = $user->roles[0];
 
    // Set the URL to redirect users to based on their role
    if ( $user_role == 'client' ) {
        $redirect_to = '/wp/wp-admin/admin.php?page=acf-options-site-settings';
    }
 
    return $redirect_to;
}
add_filter( 'login_redirect', 'rawlins_custom_login_redirect', 10, 3 );