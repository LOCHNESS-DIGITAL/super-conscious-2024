<?php
### Set up your Customizer options (Appearance > Customize).

/*
 * NOTE
 * Options for contact details, social URLs,
 * and the 404 page are set up here as a
 * starting point. Use these, remove them,
 * or add more.
 */



### Remove default sections and panels
function rawlins_remove_customizer_defaults($wp_customize){
	$wp_customize->remove_section('title_tagline');
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('custom_css');
	// $wp_customize->remove_panel('widgets');

	return $wp_customize;
}
add_action( 'customize_register', 'rawlins_remove_customizer_defaults' );





### Section - Contact Details
function rawlins_customizer_contact_details($wp_customize){

	$wp_customize->add_section( 'rawlins_section_contact_details' , array(
		'title' => __( 'Contact Details', 'rawlins' ),
		'description' => 'Enter your contact details that will appear throughout the website.',
		'priority' => 20,
	) );

	// Phone Number
	$wp_customize->add_setting( 'rawlins_phone_number' , array(
		'default'   => '(123) 456-7890',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'rawlins_phone_number', array(
		'label' => __( 'Phone Number', 'rawlins' ),
		'section' => 'rawlins_section_contact_details',
		'settings' => 'rawlins_phone_number',
		'type' => 'text',
		'description' => 'This is for the phone number as it would appear within copy for a person to read, e.g., (123) 456-7890',
	) );

	// Street Address
	$wp_customize->add_setting( 'rawlins_address' , array(
		'default'   => '',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'rawlins_address', array(
		'label' => __( 'Street Address', 'rawlins' ),
		'section' => 'rawlins_section_contact_details',
		'settings' => 'rawlins_address',
		'type' => 'textarea',
		'description' => 'Enter your address as it will appear throughout the website.'
	) );

	// Contact Email
	$wp_customize->add_setting( 'rawlins_contact_email' , array(
		'default'   => '',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'rawlins_contact_email', array(
		'label' => __( 'Contact Email', 'rawlins' ),
		'section' => 'rawlins_section_contact_details',
		'settings' => 'rawlins_contact_email',
		'type' => 'email',
		'description' => 'Enter the email address that is used for general emails and/or customer service.',
	) );

	// Facebook
	$wp_customize->add_setting( 'rawlins_facebook_url' , array(
		'default'   => '',
	) );

	$wp_customize->add_control( 'rawlins_facebook_url', array(
		'label' => __( 'Facebook Page URL', 'rawlins' ),
		'section' => 'rawlins_section_contact_details',
		'settings' => 'rawlins_facebook_url',
		'type' => 'url',
		'description' => 'Copy and paste the URL to your Facebook page here.',
	) );

	// Twitter
	$wp_customize->add_setting( 'rawlins_twitter_url' , array(
		'default'   => '',
	) );

	$wp_customize->add_control( 'rawlins_twitter_url', array(
		'label' => __( 'Twitter Page URL', 'rawlins' ),
		'section' => 'rawlins_section_contact_details',
		'settings' => 'rawlins_twitter_url',
		'type' => 'url',
		'description' => 'Copy and paste the URL to your Twitter page here.',
	) );

	return $wp_customize;
}
add_action( 'customize_register', 'rawlins_customizer_contact_details' );





### Section - 404 Page
function rawlins_customizer_404_page($wp_customize){

	$wp_customize->add_section( 'rawlins_section_404_page' , array(
		'title' => __( '404 Page', 'rawlins' ),
		'description' => 'Add a custom title and message to your 404 page.',
		'priority' => 100,
	) );

	// 404 page title
	$wp_customize->add_setting( 'rawlins_404_page_title' , array(
		'default'   => 'Not Found (404)',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'rawlins_404_page_title', array(
		'label' => __( 'Page Title', 'rawlins' ),
		'section' => 'rawlins_section_404_page',
		'settings' => 'rawlins_404_page_title',
		'type' => 'text',
		'description' => 'Set the main page title.',
	) );

	// 404 page content
	$wp_customize->add_setting( 'rawlins_404_content' , array(
		'default'   => 'The content you were looking for could not be found.',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'rawlins_404_content', array(
		'label' => __( 'Message', 'rawlins' ),
		'section' => 'rawlins_section_404_page',
		'settings' => 'rawlins_404_content',
		'type' => 'textarea',
		'description' => 'Set the message that lets a user know what to do.',
	) );

	return $wp_customize;
}
add_action( 'customize_register', 'rawlins_customizer_404_page' );





function rawlins_customizer_live_preview(){
    wp_enqueue_script( 'rawlins-themecustomizer', get_template_directory_uri().'/js/admin/theme-customizer.js', array( 'jquery','customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'rawlins_customizer_live_preview', 0, 99 );
