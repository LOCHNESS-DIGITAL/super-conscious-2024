<?php
### Enqueue styles and scripts.

/*
 * NOTE
 * The theme CSS is loaded in the <head> via
 * the 'rawlins_do_css' action, so critical and
 * noncritical CSS can be loaded seperately.
 * The standard enqueue functions don't support
 * this sort of thing yet.
 */



/*
 * PURPOSE : Dequeue jQuery, load the theme's main JS file, localize common things like the AJAX URL.
 * NOTES	 : All scripts should load at the end of the page, use TRUE for the 5th parameter of wp_register_script().
 */
function rawlins_scripts(){
	if( !is_admin() ){

		// Deregister WordPress jQuery and register Google's, only if you need jQuery.
		if( !is_customize_preview() ){
			wp_deregister_script('jquery');
		}
		wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true);

		// Main Scripts (this file is concatenated from the files inside of js/development/ )
		wp_enqueue_script('scripts', get_template_directory_uri().'/dist/index.js', array('splide-auto-scroll-script'), filemtime( get_template_directory().'/dist/index.js' ), true);

		// Main Styles
		wp_enqueue_style('styles', get_template_directory_uri().'/dist/index.css', array(), filemtime( get_template_directory().'/dist/index.css' ) );

		// Owl Carousel
		// wp_enqueue_style('owlcarousel', get_template_directory_uri().'/libs/owlcarousel/assets/owl.carousel.min.css', array(), filemtime( get_template_directory().'/libs/owlcarousel/assets/owl.carousel.min.css' ) );
		// wp_enqueue_style('owlcarousel-default', get_template_directory_uri().'/libs/owlcarousel/assets/owl.theme.default.min.css', array(), filemtime( get_template_directory().'/libs/owlcarousel/assets/owl.theme.default.min.css' ) );
		// wp_enqueue_script('owlcarousel-script', get_template_directory_uri().'/libs/owlcarousel/owl.carousel.min.js', array('jquery'), '2.3.4', true);

		wp_enqueue_style('splide', get_template_directory_uri().'/libs/splide/css/splide.min.css', array(), filemtime( get_template_directory().'/libs/splide/css/splide.min.css' ) );
		wp_enqueue_style('splide-default', get_template_directory_uri().'/libs/splide/css/splide.min.css', array(), filemtime( get_template_directory().'/libs/splide/css/themes/splide-default.min.css' ) );
		wp_enqueue_script('splide-auto-scroll-script', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array('splide-script'), filemtime( get_template_directory().'/libs/splide/js/splide.min.js' ), true);
		wp_enqueue_script('splide-script', get_template_directory_uri().'/libs/splide/js/splide.min.js', array('jquery'), filemtime( get_template_directory().'/libs/splide/js/splide.min.js' ), true);
		wp_enqueue_script('hammer-script', get_template_directory_uri().'/libs/hammer/hammer.min.js', array('jquery'), filemtime( get_template_directory().'/libs/hammer/hammer.min.js' ), true);
		

		/**
		 * Wave Motion Effect
		 * src: https://tympanus.net/codrops/2020/03/17/create-a-wave-motion-effect-on-an-image-with-three-js/
		 */

		// wp_enqueue_script('wave-js', get_stylesheet_directory_uri().'/js-wave/index.js', array(), filemtime( get_stylesheet_directory().'/js-wave/index.js' ), true);

			// wp_localize_script( 'scripts', 'rawlins_js', array(
			// 	'ajax_url' => admin_url('admin-ajax.php'),
			// 	'path' => get_template_directory_uri().'/js',
			// ) );

	}
}
add_action( 'wp_enqueue_scripts', 'rawlins_scripts' );



/*
 * PURPOSE : Main stylsheet loaded as Non-Critical CSS.
 *   NOTES : Instructions on loading the non-critical CSS asyncronously - https://github.com/filamentgroup/loadCSS
 */
function rawlins_styles(){

  // Set up the URL to the non-critical CSS file with a version number for cache-busting.
  $css_filemtime = filemtime( get_template_directory().'/styles/css/style-noncritical.min.css' );
  $css_version = '?v='.$css_filemtime;
  $css_href = get_template_directory_uri().'/styles/css/style-noncritical.min.css'.$css_version;
  ?>
  <?php /*<link rel="preload" href="<?php echo $css_href; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">*/ ?>
	<link rel="stylesheet" href="<?php echo $css_href; ?>" media="print" onload="this.media='all'; this.onload=null;">
  <noscript><link rel="stylesheet" href="<?php echo $css_href; ?>"></noscript>
	<?php

}
// add_action('rawlins_do_css', 'rawlins_styles');






/*
 * PURPOSE : Admin area enqueues
 */
function rawlins_admin_theme_enqueues(){
	// CSS for admin
    wp_enqueue_style('admin-theme', get_template_directory_uri().'/dist/admin.css', array(), filemtime( get_template_directory().'/dist/admin.css' ) );

		// JS for admin
		wp_enqueue_script('admin-scripts', get_template_directory_uri().'/js/admin/dashboard.js', array('jquery'), filemtime( get_template_directory().'/js/admin/dashboard.js' ), true);

		wp_localize_script( 'admin-scripts', 'rawlins_admin_js', array(
			'theme_path' => get_template_directory_uri(),
		) );
}
add_action('admin_enqueue_scripts', 'rawlins_admin_theme_enqueues');

/*
 * PURPOSE : Login screen enqueues
 */
function rawlins_login_stylesheet(){
	// CSS for login screen
	wp_enqueue_style('login-theme', get_template_directory_uri().'/styles/css/style-login.min.css', array(), filemtime( get_template_directory().'/styles/css/style-login.min.css' ) );
}
// add_action( 'login_enqueue_scripts', 'rawlins_login_stylesheet' );

/*
 * PURPOSE : Post content editor (TinyMCE) enqueues (load a CSS file to use for the editor in the iframe)
 */
function rawlins_tinymce_style(){
	// CSS for admin
    add_editor_style( get_template_directory_uri().'/styles/css/style-tinymce.min.css', array(), filemtime( get_template_directory().'/styles/css/style-tinymce.min.css' ) );
}
// add_action('admin_init', 'rawlins_tinymce_style');
