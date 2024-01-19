<?php
/*
Plugin Name: QR Code Short URLS SVG Local
Plugin URI: 
Description: Add .qr to shorturls to display QR Code in SVG on the your site
Version: 1.0
Author: Alex Kolodko
Author URI: https://alexkolodko.com/
*/

// Kick in if the loader does not recognize a valid pattern
yourls_add_action('redirect_keyword_not_found', 'alexk_yourls_qrcode', 1);

function alexk_yourls_qrcode( $request ) {
        // Get authorized charset in keywords and make a regexp pattern
        $pattern = yourls_make_regexp_pattern( yourls_get_shorturl_charset() );

        // Shorturl is like bleh.qr?
        if( preg_match( "@^([$pattern]+)\.qr?/?$@", $request[0], $matches ) ) {
                // this shorturl exists?
                $keyword = yourls_sanitize_keyword( $matches[1] );
                if( yourls_is_shorturl( $keyword ) ) {
                        // Show the QR code then!
                        header('Location: /qr?content='.YOURLS_SITE.'/'.$keyword);
                        // header('Location: https://alexkolodko.com?link='.YOURLS_SITE.'/'.$keyword);
                        exit;
                }
        }
}
?>