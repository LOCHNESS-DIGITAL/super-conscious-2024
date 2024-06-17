<?php

add_action('acf/init', 'rawlins_option_pages', 100);
function rawlins_option_pages() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

		acf_add_options_page(array(
			'page_title' => 'Site Settings',
			'position' => 4
		));
    }
}