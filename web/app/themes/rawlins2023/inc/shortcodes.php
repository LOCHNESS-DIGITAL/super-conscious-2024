<?php
use rawlins\Get;
### Callback functions for shortcodes.



// EXAMPLE - use this or delete
// Display a phone number link.
function rawlins_phone_number(){
    return Get::phoneNumberLink();
}
add_shortcode( 'phone', 'rawlins_phone_number' );
