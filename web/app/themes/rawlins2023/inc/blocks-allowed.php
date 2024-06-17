<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Restrict Blocks to the paragraph block only for Quotes.
 *
 * @param array                   $allowed_block_types Array of block types.
 * @param WP_Block_Editor_Context $block_editor_context The current block editor context.
 *
 * @return array
 */
function rawlins_allowed_block_types_all( $allowed_block_types, $block_editor_context ) {
	// Get the current WP_Post object from WP_Block_Editor_Context class.
	$post = $block_editor_context->post;

  $allowed_block_types = array(
    'core/classic',
    'core/image',
    'core/paragraph',
    'core/heading',
    'core/list',
    'core/list-item',
    'core/quote',
    'core/file',
    'core/buttons',
    'core/media-text',
    'core/video',
    'core/audio',
    'core/embed',
    'core/table',
    'core/html',
    'core/shortcode',
  );

  return $allowed_block_types;

}
// Hook function into allowed block type filter.
add_filter( 'allowed_block_types_all', 'rawlins_allowed_block_types_all', 10, 2 );