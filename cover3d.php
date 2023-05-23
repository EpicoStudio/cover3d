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

// Prevent direct access to the plugin file.
defined( 'ABSPATH' ) || exit;

// Define constants.
if ( ! defined( 'COVER3D_URL' ) ) :
    define( 'COVER3D_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
endif;
if ( ! defined( 'COVER3D_PATH' ) ) :
    define( 'COVER3D_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
endif;

// Require resource files.
require_once "inc/custom.php";
if ( ! class_exists( 'PG_Helper_v2' ) ) :
    require_once "inc/wp_pg_helpers.php";
endif;
if ( ! class_exists( 'PG_Blocks' ) ) :
    require_once "inc/wp_pg_blocks_helpers.php";
endif;

/**
 * Require the file that creates the block and
 * load block translations in the editor..
 * @return void
 */
add_action('init', function () {
    require_once 'blocks/book/book_register.php';
    wp_set_script_translations('block-cover3d-book-script', 'cover3d');
});
