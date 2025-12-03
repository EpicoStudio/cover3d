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
 * Version:           1.0.0
 * Requires at least: 6.1
 * Requires PHP:      7.4
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
if ( ! defined( 'COVER3D_URL' ) ) {
	define( 'COVER3D_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
}
if ( ! defined( 'COVER3D_PATH' ) ) {
	define( 'COVER3D_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
}

/**
 * Registers the Cover3D block using the block.json metadata.
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_type/
 * @link https://developer.wordpress.org/reference/functions/wp_register_block_metadata_collection/
 *
 * @return void
 */
function cover3d_register_block() {
	if ( ! function_exists( 'register_block_type' ) ) {
		// The block editor is not available.
		return;
	}

	$manifest_file = COVER3D_PATH . '/build/blocks-manifest.php';

	// Register the block metadata collection to improve performance (WP 6.7+).
	if ( file_exists( $manifest_file ) ) {
		if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
			wp_register_block_types_from_metadata_collection(
				COVER3D_PATH . '/build',
				$manifest_file
			);
		} else {
			if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
				wp_register_block_metadata_collection(
					COVER3D_PATH . '/build',
					$manifest_file
				);
			}
			$manifest_data = require $manifest_file;
			foreach ( array_keys( $manifest_data ) as $block_type ) {
				register_block_type( COVER3D_PATH . "/build/{$block_type}" );
			}
		}
	} else {
		// Fallback: Register the block directly from block.json.
		register_block_type( COVER3D_PATH . '/build/book' );
	}

	// Load available translations for the editor script.
	wp_set_script_translations( 'cover3d-book-editor-script', 'cover3d', COVER3D_PATH . '/languages' );
}
add_action( 'init', 'cover3d_register_block' );

/**
 * Sanitizes a color value.
 *
 * Accepts hex colors with or without hash, rgb(), rgba(), hsl(), hsla(), and named colors.
 *
 * @param string $color The color value to sanitize.
 * @return string The sanitized color value.
 */
function cover3d_sanitize_color( $color ) {
	// Return empty string for empty values.
	if ( empty( $color ) ) {
		return '';
	}

	// Trim whitespace.
	$color = trim( $color );

	// Check for hex color (with or without hash, 3, 4, 6, or 8 digits).
	if ( preg_match( '/^#?([A-Fa-f0-9]{8}|[A-Fa-f0-9]{6}|[A-Fa-f0-9]{4}|[A-Fa-f0-9]{3})$/', $color ) ) {
		// Add hash if missing.
		return '#' . ltrim( $color, '#' );
	}

	// Check for rgb/rgba colors.
	if ( preg_match( '/^rgba?\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(,\s*(0|1|0?\.\d+))?\s*\)$/i', $color ) ) {
		return $color;
	}

	// Check for hsl/hsla colors.
	if ( preg_match( '/^hsla?\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})%\s*,\s*(\d{1,3})%\s*(,\s*(0|1|0?\.\d+))?\s*\)$/i', $color ) ) {
		return $color;
	}

	// Check for valid named colors.
	$named_colors = array(
		'transparent', 'currentcolor', 'inherit',
		'black', 'white', 'red', 'green', 'blue', 'yellow', 'orange',
		'purple', 'pink', 'gray', 'grey', 'brown', 'cyan', 'magenta', 'lime', 'navy',
		'teal', 'olive', 'maroon', 'aqua', 'silver', 'fuchsia',
	);

	if ( in_array( strtolower( $color ), $named_colors, true ) ) {
		return strtolower( $color );
	}

	// Return a safe default if nothing matches.
	return '#ffffff';
}

/**
 * Loads the plugin text domain for translations.
 *
 * @return void
 */
function cover3d_load_textdomain() {
	load_plugin_textdomain( 'cover3d', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'cover3d_load_textdomain' );
