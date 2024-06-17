<?php
### Define your helper functions here.
### Helper functions help other areas in the code process or retrieve something. Most likely, helper functions will have a return value.



/*
* PURPOSE : Set which post types are using the page builder. This helps generate excerpts when the_content() isn't used, or is used in conjunction with the_page_builder(), or however you can find it useful in your theme.
*  PARAMS : n/a
* RETURNS : array - An array of post type slugs (strings).
*   NOTES : This is important for the developer to maintain.
*/
### TODO: Set up this array when building your project. Remove this todo when done.
function rawlins_get_post_types_with_page_builder(){

	$post_types_with_page_builder = [
		'page',
		'post',
	];

	return $post_types_with_page_builder;
}



/*
* PURPOSE : Shortens a string by character count, add optional ellipsis.
*  PARAMS : $string (string) - the string you want to shorten.
						$length (int) - the number of characters to shorten the string to.
						$ellipsis (boolean) - True to add the ellipsis, false to leave it off.
* RETURNS : (string) - the shortened string, or original string if it wasn't shortened.
*   NOTES : This will run wp_strip_all_tags() on the given string.
*/
function rawlins_substr( $string, $length=50, $ellipsis = true ){
    $excerpt = wp_strip_all_tags($string, true);

    if( strlen($excerpt) > $length ){
        $excerpt = substr($excerpt, 0, $length);
        $excerpt .= ($ellipsis)? '<em class="ellipsis">&hellip;</em>' : '';
    }

    return $excerpt;
}





/*
 * PURPOSE : Retrieve a post's primary term for a given taxonomy, or at least get the first term in the list.
 *  PARAMS :  $post_id (int) The ID for the post
 *            $taxonomy_slug (string) The slug name for the taxonomy.
 * RETURNS :  A WP_Term object.
 *   NOTES :  Yoast has a feature that can mark a term as the "primary term", for posts that have multiple terms selected. This function will attempt to retrieve that first, and fall back on the first term in the list if Yoast is not installed.
 */
function rawlins_get_primary_term( $post_id, $taxonomy_slug='category' ){

    if( !$post_id ){
        global $post;

        if( isset($post->ID) ){
            $post_id = $post->ID;
        }

    }

    if( !$post_id ){
        return false;
    }

    $primary_term = false;

    $terms = get_the_terms( $post_id, $taxonomy_slug );

    if( is_array($terms) && !empty($terms) ){

        // Assume we'll use the first term as the primary term.
        $primary_term = $terms[0];

        // But if Yoast is installed, get the actual primary term.
        if( class_exists('WPSEO_Primary_Term') ){
            $wpseo_primary_term_object = new WPSEO_Primary_Term( $taxonomy_slug, $post_id );
            $wpseo_primary_term_id = $wpseo_primary_term_object->get_primary_term();

            $term_object = get_term( $wpseo_primary_term_id );
            if( !is_wp_error( $term_object ) ){
                $primary_term = $term_object;
            }

        }

    }

    return $primary_term;

}





/*
* PURPOSE : If there are zero results (or other parameters) in the archive query, get_post_type() isn't reliable for knowing what the archive's post type is. This function gets the post type from the global $wp_query object instead.
*  PARAMS : n/a
* RETURNS : boolean / string - the slug for the post type fromm $wp_query, or false if that is not found.
*   NOTES :
*/
function rawlins_get_archive_post_type(){
	$post_type = false;

	global $wp_query;
	if( isset($wp_query->query['post_type']) ){
		$post_type = $wp_query->query['post_type'];
	}

	return $post_type;
}
