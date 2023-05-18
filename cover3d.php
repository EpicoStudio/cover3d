<?php
/**
 * Plugin Name:       3D Cover
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Describe what the plugin does.
 * Version: 0.1.95
 * Requires at least: 5.5
 * Requires PHP:      5.3
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
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
    /* Pinegrow generated Load Text Domain Begin */
    load_plugin_textdomain( 'cover3d', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    /* Pinegrow generated Load Text Domain End */

    /*
     * Register custom menu locations
     */
    /* Pinegrow generated Register Menus Begin */

    /* Pinegrow generated Register Menus End */
    
    /*
    * Set image sizes
     */
    /* Pinegrow generated Image sizes Begin */

    /* Pinegrow generated Image sizes End */
    
}
endif; // cover3d_setup

add_action( 'after_setup_theme', 'cover3d_setup' );


if ( ! function_exists( 'cover3d_init' ) ) :

function cover3d_init() {

    /*
     * Register custom post types. You can also move this code to a plugin.
     */
    /* Pinegrow generated Custom Post Types Begin */

    /* Pinegrow generated Custom Post Types End */
    
    /*
     * Register custom taxonomies. You can also move this code to a plugin.
     */
    /* Pinegrow generated Taxonomies Begin */

    /* Pinegrow generated Taxonomies End */

}
endif; // cover3d_setup

add_action( 'init', 'cover3d_init' );


if ( ! function_exists( 'cover3d_custom_image_sizes_names' ) ) :

function cover3d_custom_image_sizes_names( $sizes ) {

    /*
     * Add names of custom image sizes.
     */
    /* Pinegrow generated Image Sizes Names Begin */

return array_merge( $sizes, array(
        'big_cover' => __( 'Big cover' ),
        'medium_cover' => __( 'Medium cover' ),
        'small_cover' => __( 'Small cover' ),
        'retina_cover' => __( 'Retina cover' )
) );

    /* Pinegrow generated Image Sizes Names End */
    return $sizes;
}
add_action( 'image_size_names_choose', 'cover3d_custom_image_sizes_names' );
endif;// cover3d_custom_image_sizes_names


if ( ! function_exists( 'cover3d_widgets_init' ) ) :

function cover3d_widgets_init() {

    /*
     * Register widget areas.
     */
    /* Pinegrow generated Register Sidebars Begin */

    /* Pinegrow generated Register Sidebars End */
}
add_action( 'widgets_init', 'cover3d_widgets_init' );
endif;// cover3d_widgets_init



if ( ! function_exists( 'cover3d_customize_register' ) ) :

function cover3d_customize_register( $wp_customize ) {
    // Do stuff with $wp_customize, the WP_Customize_Manager object.

    /* Pinegrow generated Customizer Controls Begin */

    /* Pinegrow generated Customizer Controls End */

}
add_action( 'customize_register', 'cover3d_customize_register' );
endif;// cover3d_customize_register


if ( ! function_exists( 'cover3d_enqueue_scripts' ) ) :
    function cover3d_enqueue_scripts() {

        /* Pinegrow generated Enqueue Scripts Begin */

    /* Pinegrow generated Enqueue Scripts End */

        /* Pinegrow generated Enqueue Styles Begin */

    /* Pinegrow generated Enqueue Styles End */

    }
    add_action( 'wp_enqueue_scripts', 'cover3d_enqueue_scripts' );
endif;

if ( ! function_exists( 'cover3d_pgwp_sanitize_placeholder' ) ) :
    function cover3d_pgwp_sanitize_placeholder($input) { return $input; }
endif;

    /*
     * Resource files included by Pinegrow.
     */
    /* Pinegrow generated Include Resources Begin */
require_once "inc/custom.php";
if( !class_exists( 'PG_Helper_v2' ) ) { require_once "inc/wp_pg_helpers.php"; }
if( !class_exists( 'PG_Blocks' ) ) { require_once "inc/wp_pg_blocks_helpers.php"; }

    /* Pinegrow generated Include Resources End */

/* Creating Editor Blocks with Pinegrow */

if ( ! function_exists('cover3d_blocks_init') ) :
function cover3d_blocks_init() {
    // Register blocks. Don't edit anything between the following comments.
    /* Pinegrow generated Register Pinegrow Blocks Begin */
    require_once 'blocks/book/book_register.php';

    /* Pinegrow generated Register Pinegrow Blocks End */
}
add_action('init', 'cover3d_blocks_init');
endif;

/* End of creating Editor Blocks with Pinegrow */

?>