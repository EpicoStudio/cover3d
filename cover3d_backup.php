<?php
/**
 * Plugin Name:       3D Cover
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       A block to display an animated 3D cover of your physical or digital books.
 * Version: 0.1.90
 * Requires at least: 5.5
 * Requires PHP:      7.0
 * Author:            Márcio Duarte @pagelab
 * Author URI:        https://epico.studio/
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       cover3d
 * Domain Path:       /languages
*/

if ( ! function_exists( 'cover3d_plugin_base_url' ) ) :

function cover3d_plugin_base_url() {
    global $cover3d_plugin_base_url_value;
    if(empty($cover3d_plugin_base_url_value)) {
        $cover3d_plugin_base_url_value = untrailingslashit( plugin_dir_url( __FILE__ ) );
    }
    return $cover3d_plugin_base_url_value;
}

endif;

if ( ! function_exists( 'cover3d_plugin_base_path' ) ) :

function cover3d_plugin_base_path() {
    global $cover3d_plugin_base_path_value;
    if(empty($cover3d_plugin_base_path_value)) {
        $cover3d_plugin_base_path_value = untrailingslashit( plugin_dir_path(  __FILE__ ) );
    }
    return $cover3d_plugin_base_path_value;
}

endif;

if ( ! function_exists( 'cover3d_setup' ) ) :

function cover3d_setup() {

    cover3d_plugin_base_url();
    /*
     * Make the plugin available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_plugin_textdomain( 'cover3d', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

    /*
    * Set image sizes
     */
    add_image_size( 'big_cover', 200, 300, true );
    add_image_size( 'medium_cover', 133, 200, true );
    add_image_size( 'small_cover', 66, 100, true );

}
endif; // cover3d_setup

add_action( 'after_setup_theme', 'cover3d_setup' );

if ( ! function_exists( 'cover3d_custom_image_sizes_names' ) ) :

function cover3d_custom_image_sizes_names( $sizes ) {

return array_merge( $sizes, array(
        'big_cover' => __( 'Big cover' ),
        'medium_cover' => __( 'Medium cover' ),
        'small_cover' => __( 'Small cover' )
) );

    return $sizes;
}
add_action( 'image_size_names_choose', 'cover3d_custom_image_sizes_names' );
endif;// cover3d_custom_image_sizes_names


if ( ! function_exists( 'cover3d_pgwp_sanitize_placeholder' ) ) :
    function cover3d_pgwp_sanitize_placeholder($input) { return $input; }
endif;

/*
 * Resource files.
 */
require_once "inc/custom.php";
if( !class_exists( 'PG_Helper_v2' ) ) { require_once "inc/wp_pg_helpers.php"; }
if( !class_exists( 'PG_Blocks' ) ) { require_once "inc/wp_pg_blocks_helpers.php"; }

/* Creating Editor Blocks */

if ( ! function_exists('cover3d_blocks_init') ) :
function cover3d_blocks_init() {
    // Register blocks.
    require_once 'blocks/book/book_register.php';
}
add_action('init', 'cover3d_blocks_init');
endif;