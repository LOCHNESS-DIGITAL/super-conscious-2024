<?php
### Any other customizations/tweaks for the TinyMCE editor.





/*
 * PURPOSE : Make image links default to "none".
 * You know how when you add an image in TinyMCE and it defaults to linking to the original size or to its attachment page? Well this makes it default to having no link.
 *   NOTES : https://www.wpbeginner.com/wp-tutorials/automatically-remove-default-image-links-wordpress/
 */
function rawlins_imagelink_setup(){

	$image_set = get_option( 'image_default_link_type' );

	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}

}
add_action('admin_init', 'rawlins_imagelink_setup', 10);





/*
 * PURPOSE : Use Paste As Text by default in the editor.
 *   NOTES : https://anythinggraphic.net/paste-as-text-by-default-in-wordpress
 */
function rawlins_tinymce_paste_as_text( $init ) {
	$init['paste_as_text'] = true;
	return $init;
}
add_filter('tiny_mce_before_init', 'rawlins_tinymce_paste_as_text');





/*
 * PURPOSE : Remove the inline styles from .wp-caption <div>s, which become difficult to override in the theme's CSS.
 *   NOTES :
 */
function rawlins_fixed_img_caption_shortcode( $attr, $content=null ){
    if (! isset($attr['caption'])) {
        if (preg_match('#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches)) {
        $content = $matches[1];
        $attr['caption'] = trim($matches[2]);
        }
    }

    $output = apply_filters('img_caption_shortcode', '', $attr, $content);
    if ($output != '')
    return $output;

    extract(shortcode_atts(array(
        'id' => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
  ), $attr));

    if (1 > (int) $width || empty($caption))
    return $content;

    if ($id) $id = 'id="' . esc_attr($id) . '" ';

    return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="max-width:'.$width.'px">' . do_shortcode($content) . '<p>' . $caption . '</p></div>';
}
add_shortcode('wp_caption', 'rawlins_fixed_img_caption_shortcode');
add_shortcode('caption', 'rawlins_fixed_img_caption_shortcode');





/*
 * PURPOSE : Remove the inline styles from .wp-video <div>s
 *   NOTES :
 */
function rawlins_remove_excess_video_attributes($output, $atts, $video, $post_id, $library){
	$style_attribute_pattern = '/ style="[^\"]*"/';
	$filtered_output = preg_replace( $style_attribute_pattern, '', $output );

	return $filtered_output;
}
add_filter( 'wp_video_shortcode', 'rawlins_remove_excess_video_attributes', 10, 5 );
