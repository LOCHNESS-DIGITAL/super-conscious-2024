<?php
### Add custom post types here.

function rawlins_register_post_types() {

	// Add all your post type info into this array.
	$rawlins_magic_post_type_maker_array = [

		/*
		HOW TO USE

		Copy the array below for 'product' and edit as needed. $rawlins_magic_post_type_maker_array should be an array of arrays, and those arrays make it easier to create custom post types.

		The 'slug', 'singular', and 'plural' parameters are explained below in the example array's comments.

		For the 'register_args' array, add whichever arguments you need to the array (Except for the 'labels' argument, that's automatically generated for you).

		Use the documentation on https://codex.wordpress.org/Function_Reference/register_post_type

		*** Common arguments (that you'll definitely want to use) are `menu_icon` and `description`. ***

		The most common arguments are here for you to copy/paste, but again you can add whichever arguments are supported by the register_post_type() function.

		'menu_icon'  => 'dashicons-clipboard',
		'description' => 'Manage your PLURAL POST NAME here.',
		'menu_position' => 10,
		'hierarchical' => true,
		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => false,

		*/

		// Comment out or change this example:
		[
			'slug' => 'work',
			'singular' => 'Project',
			'plural' => 'Work',
			'register_args' => [
				'menu_icon' => 'dashicons-awards',
				'description' => 'Manage Projects.',
			],
		],

	];

	foreach( $rawlins_magic_post_type_maker_array as $post_type_args ){
		$singular = $post_type_args['singular'];
		$plural = $post_type_args['plural'];
		$slug = $post_type_args['slug'];
		$register_args = $post_type_args['register_args'];

	  	// Arguments
		$final_args = rawlins_generate_post_type_args( $register_args );

		// Admin Labels
		$labels = rawlins_generate_label_array([
			'singular' => $singular,
			'plural' => $plural,
			'slug' => $slug,
		]);

		$final_args['labels'] = $labels;

		// Finally register the post type.
		register_post_type( $slug, $final_args );
	}

}
add_action( 'init', 'rawlins_register_post_types', 0 );




// function rawlins_generate_label_array($cpt_plural, $cpt_single){
function rawlins_generate_label_array( $args = [] ){

	$defaults = [
		'singular' => false,
		'plural' => false,
		'slug' => false,
	];

	$merged = array_merge($defaults, $args);

	if( in_array(false, $merged, true) ){
		return false;
	}

	$singular = $merged['singular'];
	$plural = $merged['plural'];
	$slug = $merged['slug'];
	$singular_lowercase = strtolower( $singular );
	$plural_lowercase = strtolower( $plural );

	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'add_new' => _x('Add New', 'add new post or page', 'base'),
		'add_new_item' => sprintf( _x( 'Add New %s', 'referring to a post/page', 'base' ), $singular ),
		'edit_item' => sprintf( _x( 'Edit %s', 'referring to a post/page', 'base' ), $singular ),
		'new_item' => sprintf( _x( 'New %s', 'referring to a post/page', 'base' ), $singular ),
		'view_item' => sprintf( _x( 'View %s', 'referring to a post/page', 'base' ), $singular ),
		'view_items' => sprintf( _x( 'View %s', 'referring to posts/pages', 'base' ), $plural ),
		'search_items' => sprintf( _x( 'Search %s', 'referring to posts/pages', 'base' ), $plural ),
		'not_found' => sprintf( _x( 'No %s found', 'referring to posts/pages', 'base' ), $plural_lowercase ),
		'not_found_in_trash' => sprintf( _x( 'No %s found in Trash.', 'referring to posts/pages', 'base' ), $plural_lowercase ),
		'parent_item_colon' => sprintf( _x( 'Parent %s:', 'referring to a post/page', 'base' ), $singular ),
		'all_items' => sprintf( _x( 'All %s', 'referring to posts/pages', 'base' ), $plural ),
		'archives' => sprintf( _x( '%s Archives', 'referring to posts/pages', 'base' ), $singular ),
		'attributes' => sprintf( _x( '%s Attributes', 'referring to posts/pages', 'base' ), $singular ),
		'insert_into_item' => sprintf( _x( 'Insert into %s.', 'referring to a post/page', 'base' ), $singular ),
		'uploaded_to_this_item' => sprintf( _x( 'Uploaded to this %s.', 'referring to a post/page', 'base' ), $singular ),
    );

	return $labels;
}

function rawlins_generate_post_type_args( $args = [] ){

	$defaults = array(
		'public'        	  => true,
		'menu_position' 	  => 7,
		'hierarchical'		  => true,
		'supports'      	  => array( 'title', 'editor', 'page-attributes', 'thumbnail', 'excerpt' ),
		'has_archive'   	  => true,
		'exclude_from_search' => false
    );

	$merged = array_merge($defaults, $args);

	return $merged;
}

// // Change pages post type's menu_position
// function rawlins_custom_menu_order() {
//   return array( 'index.php', 'edit.php?post_type=page' );
// }

// add_filter( 'custom_menu_order', '__return_true' );
// add_filter( 'menu_order', 'rawlins_custom_menu_order' );

add_post_type_support( 'page', 'excerpt' );
add_post_type_support( 'tribe_events', 'excerpt' );
add_post_type_support( 'post', 'excerpt' );
add_post_type_support( 'leadership', 'thumbnail' );

function rawlins_leadership_sort_order($query){
	if(is_archive() && is_post_type_archive( "leadership" )):
		//Set the order ASC or DESC
		$query->set( 'order', 'DESC' );
		//Set the orderby
		$query->set( 'orderby', 'menu_order' );
    $query->set( 'showposts', -1 );
	endif;    
};
add_action( 'pre_get_posts', 'rawlins_leadership_sort_order'); 

// ************* Remove default Posts type since no blog *************

// Remove side menu
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}

// Remove Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

// End remove post type