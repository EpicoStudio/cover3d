<?php
/**
 * Addicional helper functions.
 *
 * @since 0.1.0
 * @package cover3d
 */

/**
 *
 * Sanitize RGBA values.
 * @param  string    $rgba Color value in RGBA
 * @return string    Sanitized color value.
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
 * Function to record errors in WordPress wp-content/debug.log.
 * Usage: cover3d_write_log( "The variable value is: $variable");
 * @param  mixed    $log The variable to write to the debug.log file.
 * @return void
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
