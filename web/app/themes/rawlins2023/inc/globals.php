<?php
### Useful functions for this particular theme.
// Set up any `add_action`s or `add_filter`s here.

function rawlins_add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'rawlins_add_file_types_to_uploads');