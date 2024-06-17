<?php
### Set up your project's navigation menus.

function rawlins_register_menus() {

	// Navigation Menus
	register_nav_menus(
		array(	'main-navigation' => 'Main Navigation',
				'utility-navigation' => 'Utility Navigation',
		)
	);

}
add_action( 'init', 'rawlins_register_menus' );
