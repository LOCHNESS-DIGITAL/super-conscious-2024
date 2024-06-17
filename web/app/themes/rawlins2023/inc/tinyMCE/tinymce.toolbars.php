<?php
### Edit TinyMCE toolbar stuff here.



/*
 * PURPOSE : Set options for the TinyMCE editor when it starts, like which buttons to use or things toggled on/off. Each customization is explained further within this function.
 *  PARAMS : $args - array of parameters for TinyMCE editor, look up the `tiny_mce_before_init` filter for more details.
 * RETURNS : $args
 *   NOTES :
 */
function rawlins_tinymce_set_init_options( $args ){
	// Always show kitchen sink in WYSIWYG Editor.
	$args['wordpress_adv_hidden'] = false;

	// Set the block formats. Prevent the client from using <h1> since those are usually included as the page title in the templates, and further customizations you need.
	$args['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

	return $args;
}
add_filter( 'tiny_mce_before_init', 'rawlins_tinymce_set_init_options' );





/*
 * PURPOSE : Customize the buttons on the TinyMCE toolbars, for the Basic WYSIWYG (via ACF). Look through the function and comment/uncomment as needed for the project.
 *  PARAMS : $toolbars - array - each item in the array corresponds to a buton in the TinyMCE toolbar. Example print_routput below.
 * RETURNS : $toolbars
 *   NOTES :
 */
function rawlins_tinymce_toolbar_buttons( $toolbars ){
	//echo "<pre>"; print_r($toolbars); echo "</pre>";
	/*
	Here's what gets output when you print_r($toolbars):
	Array
	(
	    [Basic] => Array
	        (
	            [1] => Array
	                (
	                    [0] => bold
	                    [1] => italic
	                    [2] => underline
	                    [3] => blockquote
	                    [4] => strikethrough
	                    [5] => bullist
	                    [6] => numlist
	                    [7] => alignleft
	                    [8] => aligncenter
	                    [9] => alignright
	                    [10] => undo
	                    [11] => redo
	                    [12] => link
	                    [13] => unlink
	                    [14] => fullscreen
	                )

	        )

	)
	*/

	// Removing the fullscreen button from the light WYSIWYG
	if( ($key = array_search('fullscreen' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('justifyleft' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('justifycenter' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('justifyright' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('blockquote' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('strikethrough' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('underline' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	// if( ($key = array_search('bullist' , $toolbars['Basic' ][1])) !== false ){
	//     unset( $toolbars['Basic' ][1][$key] );
	// }
	// if( ($key = array_search('numlist' , $toolbars['Basic' ][1])) !== false ){
	//     unset( $toolbars['Basic' ][1][$key] );
	// }
	if( ($key = array_search('alignleft' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('aligncenter' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('alignright' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	// if( ($key = array_search('link' , $toolbars['Basic' ][1])) !== false ){
	//     unset( $toolbars['Basic' ][1][$key] );
	// }
	// if( ($key = array_search('unlink' , $toolbars['Basic' ][1])) !== false ){
	//     unset( $toolbars['Basic' ][1][$key] );
	// }

	//Add the Paste as PlainText to the light WYSIWYG
	if( isset($toolbars['Basic' ][1]) ){
		$toolbars['Basic'][1][] = 'pastetext';
	}

	return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars' , 'rawlins_tinymce_toolbar_buttons'  );

/*
 * PURPOSE : For the FIRST row of the Full TinyMCE WYSIWYG buttons.
 */
function rawlins_tinymce_buttons_full_row1( $buttons ){
	//echo "<pre>"; print_r($buttons); echo "</pre>";
	/*
	Array (
		[0] => bold
	    [1] => italic
	    [2] => strikethrough
	    [3] => bullist
	    [4] => numlist
	    [5] => blockquote
	    [6] => hr
	    [7] => alignleft
	    [8] => aligncenter
	    [9] => alignright
	    [10] => link
	    [11] => unlink
	    [12] => wp_more
	    [13] => spellchecker
	    [14] => fullscreen
	    [15] => wp_adv
	)
	*/

	// Remove things like 'strikethrough' and alignment options - things we generally leave up to the design and not to a WYSIWYG.
	$remove = array('strikethrough','alignleft','aligncenter','alignright','wp_more','fullscreen');

	return array_diff($buttons,$remove);
}
add_filter('mce_buttons','rawlins_tinymce_buttons_full_row1');

/*
 * PURPOSE : For the SECOND row of the Full TinyMCE WYSIWYG buttons.
 */
function rawlins_tinymce_buttons_full_row2( $buttons ){
	//echo "<pre>"; print_r($buttons); echo "</pre>";
	/*
	Array (
	    [0] => formatselect
	    [1] => underline
	    [2] => alignjustify
	    [3] => forecolor
	    [4] => pastetext
	    [5] => removeformat
	    [6] => charmap
	    [7] => outdent
	    [8] => indent
	    [9] => undo
	    [10] => redo
	    [11] => wp_help
	)
	*/
	//Remove the format dropdown select and text color selector
	$remove = array('underline','strikethrough','alignjustify','forecolor','outdent','indent','wp_help');

	return array_diff($buttons,$remove);
}
add_filter('mce_buttons_2','rawlins_tinymce_buttons_full_row2');
