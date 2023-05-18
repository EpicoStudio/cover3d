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

/**
 *
 * Função para gravar erros no debug.log do WordPress
 * Usage: write_log( "The variable value is: $variable");
 *
 */

function cover3d_write_log( $log )  {
    if ( true === WP_DEBUG ) {
        if ( is_array( $log ) || is_object( $log ) ) {
            error_log( print_r( $log, true ) );
        } else {
            error_log( $log );
        }
    }
}
