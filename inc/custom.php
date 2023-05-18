<?php
/**
 *
 * Sanitize RGBA values.
 *
 */

function cover3d_sanitize_rgba($rgba) {
    $sanitized_rgba = sanitize_text_field($rgba);
    if (preg_match('/^rgba\(\d{1,3},\s*\d{1,3},\s*\d{1,3},\s*(0|1|0?\.\d+)\)$/', $sanitized_rgba)) {
        return $sanitized_rgba;
    }
    return null;
}


function cover3d_remove_image_srcset( $sources, $size_array, $image_src, $image_meta, $attachment_id ) {
    // Check if the current image has the specific custom meta value
    $custom_meta_value = get_post_meta( $attachment_id, 'book_cover_img', true );
    if ( $custom_meta_value ) {
        return false; // Remove the srcset attribute
    }
    return $sources; // Keep the srcset attribute for other images
}
add_filter( 'wp_calculate_image_srcset', 'cover3d_remove_image_srcset', 10, 5 );


/**
 * Função para gravar erros no debug.log do WordPress
 * Usage: write_log( "The variable value is: $variable");
 */

function uf_write_log( $log )  {
    if ( true === WP_DEBUG ) {
        if ( is_array( $log ) || is_object( $log ) ) {
            error_log( print_r( $log, true ) );
        } else {
            error_log( $log );
        }
    }
}
