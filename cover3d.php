<?php
/**
 * Cover3D
 *
 * @package           Cover3D
 * @author            Márcio Duarte
 * @copyright         2023 Épico Studio
 * @license           GPL v2 or later
 *
 * Plugin Name:       Cover3D
 * Plugin URI:        https://github.com/EpicoStudio/cover3d
 * Description:       A block that displays a 3D book cover, animated when you mouse over it.
 * Version:           0.1.0
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Author:            Márcio Duarte
 * Author URI:        https://epico.studio
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       cover3d
 * Domain Path:       /languages
*/

defined( 'ABSPATH' ) || exit;

// Define constants.
define( 'COVER3D_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'COVER3D_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


// Require resource files.
require_once "inc/custom.php";
if ( ! class_exists( 'PG_Helper_v2' ) ) {
    require_once "inc/wp_pg_helpers.php";
}
if ( ! class_exists( 'PG_Blocks' ) ) {
    require_once "inc/wp_pg_blocks_helpers.php";
}

/**
 * Require the file that creates the block.
 * @return void
 */
if ( ! function_exists( 'cover3d_blocks_init' ) ) :
    function cover3d_blocks_init() {
        require_once 'blocks/book/book_register.php';
    }
    add_action( 'init', 'cover3d_blocks_init' );
endif;

/**
 * Load block translations in the editor.
 * $path is not needed here, as this is hosted on WordPress.org.
 * @return void
 */
function cover3d_set_script_translations() {
    wp_set_script_translations( 'block-cover3d-book-script', 'cover3d', plugin_dir_path( __FILE__ ) . 'languages' );
}
add_action( 'init', 'cover3d_set_script_translations' );
