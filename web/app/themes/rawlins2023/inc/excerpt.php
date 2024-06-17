<?php
### Cusomizations for excerpts go here.



### Makes sure that when get_the_excerpt() is used, the content in the page builder is used as a backup to generate the excerpt, since the default content editor is not used for pages.
function rawlins_extend_excerpt( $excerpt, $post ) {

	$post_types_with_page_builder = rawlins_get_post_types_with_page_builder();

    // Make sure this has a page builder, and also that the excerpt is blank.
	if( in_array( get_post_type($post), $post_types_with_page_builder ) && !$excerpt ){

        // Get the page builder contents and strip all the tags, excerpts aren't supposed to have HTML in them.
        $page_content = get_post_meta( $post->ID, 'rawlins_page_builder_output', true );

        if( $page_content ){
            $stripped_content = trim( wp_strip_all_tags( $page_content, true ) );
    		$excerpt = wp_trim_words( $stripped_content, rawlins_custom_excerpt_length() );
        }

	}

	return $excerpt;
}
add_filter( 'get_the_excerpt', 'rawlins_extend_excerpt', 10, 2 );
