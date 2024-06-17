<?php
### Set up image sizes and their descriptions.



// Add custom image sizes.
function rawlins_image_size_setup(){

	add_image_size('1080p', 1920, 1080, true);
	add_image_size('work-thumbnail', 0, 774, false);


}
add_action( 'after_setup_theme', 'rawlins_image_size_setup' );



// Give human-readable names the image sizes.
function rawlins_custom_size_names( $sizes ) {

	return array_merge( $sizes, array(
		'1080p' => 'Standard 1080p',
		'work-thumbnail' => 'Work Thumbnail'
	) );

}
add_filter( 'image_size_names_choose', 'rawlins_custom_size_names' );
