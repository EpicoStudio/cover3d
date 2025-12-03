<?php
/**
 * Book block render template.
 *
 * All code is wrapped in a function to avoid global variable scope issues
 * that would trigger WordPress coding standards warnings.
 *
 * @package Cover3D
 * @version 1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

// Only define the function once to avoid redefinition errors when multiple blocks are rendered.
if ( ! function_exists( 'cover3d_render_book_block' ) ) {
	/**
	 * Renders the book block output.
	 *
	 * @param array    $cover3d_attributes Block attributes.
	 * @param string   $cover3d_content    Block default content.
	 * @param WP_Block $cover3d_block      Block instance.
	 * @return string The rendered block HTML.
	 */
	function cover3d_render_book_block( $cover3d_attributes, $cover3d_content, $cover3d_block ) {
	// Define a unique ID for the block.
	$cover3d_block_id = wp_unique_id( 'cover3d-' );

	// Check the context (for editor preview via REST API).
	// In the editor, the block is rendered via ServerSideRender which passes context as a query param.
	// This is a read-only operation and doesn't require nonce verification.
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$cover3d_context = isset( $_GET['context'] ) ? sanitize_text_field( wp_unslash( $_GET['context'] ) ) : '';

	// Get attributes with defaults.
	$cover3d_book_link        = $cover3d_attributes['bookCoverLink'] ?? array( 'url' => '', 'opensInNewTab' => false );
	$cover3d_book_size        = $cover3d_attributes['bookSize'] ?? 'big';
	$cover3d_back_cover_text  = $cover3d_attributes['backCoverText'] ?? 'Download';

	// Translate the default back cover text if it matches the English default.
	// This ensures proper i18n when users save the block without changing the default value.
	if ( 'Download' === $cover3d_back_cover_text ) {
		$cover3d_back_cover_text = __( 'Download', 'cover3d' );
	}
	$cover3d_back_cover_icon  = $cover3d_attributes['backCoverIconType'] ?? 'download';
	$cover3d_back_cover_color = $cover3d_attributes['backCoverColor'] ?? '#ffffff';
	$cover3d_back_cover_bkg   = $cover3d_attributes['backCoverBkgColor'] ?? '#0049ff';
	$cover3d_attachment_id    = $cover3d_attributes['bookCoverImageId'] ?? 0;
	$cover3d_img_alt          = $cover3d_attributes['bookCoverImageAlt'] ?? __( 'Cover image', 'cover3d' );

	// Sanitize colors.
	$cover3d_back_cover_color = cover3d_sanitize_color( $cover3d_back_cover_color );
	$cover3d_back_cover_bkg   = cover3d_sanitize_color( $cover3d_back_cover_bkg );

	// URL-encode the color for SVG usage (remove # for hex).
	$cover3d_svg_color = rawurlencode( $cover3d_back_cover_color );

	// Set the style for the "download" icon based on user choice.
	$cover3d_download_icon = sprintf(
		'#%1$s .book-cover-image[data-icon="download"] .book-backcover{background-image: url("data:image/svg+xml,%%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2$s\' stroke-width=\'1\'%%3E%%3Cstyle%%3E%%0A@keyframes a_d %%7B 0%%%% %%7B d: path(\'M12,6L12,13M12,13L15.5,9.5M12,13L8.5,9.5\'); animation-timing-function: cubic-bezier(.4,0,1,1); %%7D 50%%%% %%7B d: path(\'M12,6L12,15M12,15L15.5,11.5M12,15L8.5,11.5\'); animation-timing-function: cubic-bezier(0,0,.6,1); %%7D 100%%%% %%7B d: path(\'M12,6L12,13M12,13L15.5,9.5M12,13L8.5,9.5\'); %%7D %%7D%%0A%%3C/style%%3E%%3Cpath d=\'M9 17h6\' stroke-linecap=\'round\' stroke-linejoin=\'round\'/%%3E%%3Cpath d=\'M12 6v7m0 0l3.5-3.5m-3.5 3.5l-3.5-3.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\' style=\'animation: 1s linear infinite both a_d;\'/%%3E%%3Cpath d=\'M12 22c5.5 0 10-4.5 10-10c0-5.5-4.5-10-10-10c-5.5 0-10 4.5-10 10c0 5.5 4.5 10 10 10Z\' stroke-linecap=\'round\' stroke-linejoin=\'round\' /%%3E%%3C/svg%%3E");}',
		esc_attr( $cover3d_block_id ),
		$cover3d_svg_color
	);

	// Set the style for the "buy" icon based on user choice.
	$cover3d_buy_icon = sprintf(
		'#%1$s .book-cover-image[data-icon="buy"] .book-backcover{background-image: url("data:image/svg+xml,%%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2$s\' stroke-width=\'1\' %%3E%%3Cstyle%%3E@keyframes a0_d %%7B 0%%%% %%7B d: path(\'M12,6L12,13M12,13L14.5,10.5M12,13L9.5,10.5\'); animation-timing-function: cubic-bezier(.3,0,.7,.4); %%7D 10%%%% %%7B d: path(\'M12,4L12,11.1M12,11.1L14.5,8.6M12,11.1L9.5,8.6\'); animation-timing-function: cubic-bezier(.5,.2,1,1); %%7D 50%%%% %%7B d: path(\'M12,6L12,15M12,15L14.5,12.5M12,15L9.5,12.5\'); animation-timing-function: cubic-bezier(0,0,.6,1); %%7D 100%%%% %%7B d: path(\'M12,6L12,13M12,13L14.5,10.5M12,13L9.5,10.5\'); %%7D %%7D%%3C/style%%3E%%3Cg stroke-linecap=\'round\' stroke-linejoin=\'round\' transform=\'translate(.3,-1.5)\'%%3E%%3Cpath d=\'M18.8 23.2c.8 0 1.5-0.7 1.5-1.5c0-0.8-0.7-1.5-1.5-1.5c-0.8 0-1.5 .7-1.5 1.5c0 .8 .7 1.5 1.5 1.5Zm-10 0c.8 0 1.5-0.7 1.5-1.5c0-0.8-0.7-1.5-1.5-1.5c-0.8 0-1.5 .7-1.5 1.5c0 .8 .7 1.5 1.5 1.5Z\'/%%3E%%3Cpath d=\'M15.8 5.2h5.5l-2 11m-3.5-11m-5.8 0m.1 0h-5.8l2 11m-2-11c-0.2-0.7-1-2-3-2m18 13h-14.8c-1.8 0-2.7 .8-2.7 2c0 1.2 .9 2 2.7 2h14.3\'/%%3E%%3Cpath d=\'M12 6v7m0 0l2.5-2.5m-2.5 2.5l-2.5-2.5\' transform=\'translate(1,-1.4)\' style=\'animation: 1s linear infinite both a0_d;\'/%%3E%%3C/g%%3E%%3C/svg%%3E");}',
		esc_attr( $cover3d_block_id ),
		$cover3d_svg_color
	);

	// Set the color styles based on user choice.
	$cover3d_color_styles = sprintf(
		'#%1$s .book-cover-image > picture, #%1$s .book-cover-image .book-backcover { color: %2$s; background-color: %3$s; } img.book-cover-notfound::before { background-color: %3$s; } img.book-cover-notfound::after { color: %2$s; }',
		esc_attr( $cover3d_block_id ),
		esc_attr( $cover3d_back_cover_color ),
		esc_attr( $cover3d_back_cover_bkg )
	);

	// Initialize image variables.
	$cover3d_selected_size_url  = COVER3D_URL . '/assets/cover2x.png';
	$cover3d_medium_size_url    = COVER3D_URL . '/assets/cover.png';
	$cover3d_medium_size_width  = 400;
	$cover3d_medium_size_height = 600;

	// If a custom image was chosen.
	if ( $cover3d_attachment_id > 0 ) {

		// Get the metadata for the image.
		$cover3d_metadata = wp_get_attachment_metadata( $cover3d_attachment_id );

		if ( $cover3d_metadata ) {
			// Map book size to WordPress image size.
			$cover3d_size_map = array(
				'big'    => 'large',
				'medium' => 'medium_large',
				'small'  => 'medium',
			);
			$cover3d_wp_size = $cover3d_size_map[ $cover3d_book_size ] ?? 'large';

			// Get the image URL for the selected size.
			$cover3d_img_src_array = wp_get_attachment_image_src( $cover3d_attachment_id, $cover3d_wp_size );
			if ( $cover3d_img_src_array ) {
				$cover3d_selected_size_url = $cover3d_img_src_array[0];
			}

			// Get the image URL for the medium size.
			$cover3d_medium_src_array = wp_get_attachment_image_src( $cover3d_attachment_id, 'medium' );
			if ( $cover3d_medium_src_array ) {
				$cover3d_medium_size_url    = $cover3d_medium_src_array[0];
				$cover3d_medium_size_width  = $cover3d_medium_src_array[1];
				$cover3d_medium_size_height = $cover3d_medium_src_array[2];
			}
		}
	}

	// Get performance attributes for usage inside the <img> tag.
	$cover3d_loading_attrs = wp_get_loading_optimization_attributes(
		'img',
		array(
			'width'  => $cover3d_medium_size_width,
			'height' => $cover3d_medium_size_height,
		),
		'template_part_header'
	);

	// Link attributes.
	$cover3d_link_url      = $cover3d_book_link['url'] ?? '';
	$cover3d_opens_new_tab = $cover3d_book_link['opensInNewTab'] ?? false;
	$cover3d_has_link      = ! empty( $cover3d_link_url ) && empty( $cover3d_context );

	// Build wrapper attributes.
	$cover3d_wrapper_attributes = empty( $cover3d_context ) || 'edit' !== $cover3d_context
		? get_block_wrapper_attributes( array( 'class' => 'book-cover' ) )
		: 'data-wp-block-props="true"';

	// Build loading attributes string.
	$cover3d_loading_attrs_html = '';
	foreach ( $cover3d_loading_attrs as $cover3d_attr_name => $cover3d_attr_value ) {
		$cover3d_loading_attrs_html .= esc_attr( $cover3d_attr_name ) . '="' . esc_attr( $cover3d_attr_value ) . '" ';
	}

	// Start output buffering.
	ob_start();

	?>
<div <?php echo $cover3d_wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_block_wrapper_attributes() returns escaped output. ?>>
	<style>
		<?php echo esc_html( 'buy' === $cover3d_back_cover_icon ? wp_strip_all_tags( $cover3d_buy_icon ) : wp_strip_all_tags( $cover3d_download_icon ) ); ?>
		<?php echo esc_html( wp_strip_all_tags( $cover3d_color_styles ) ); ?>
	</style>
	<div class="book-cover-wrapper">
		<?php if ( $cover3d_has_link ) : ?>
		<a
			class="book-cover-link"
			href="<?php echo esc_url( $cover3d_link_url ); ?>"
			id="book-cover-link-<?php echo esc_attr( $cover3d_block_id ); ?>"
			aria-labelledby="book-cover-label-<?php echo esc_attr( $cover3d_block_id ); ?>"
			<?php echo $cover3d_opens_new_tab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
		>
		<?php endif; ?>
			<div class="book-cover-container" id="<?php echo esc_attr( $cover3d_block_id ); ?>">
				<div
					class="book-cover-image"
					data-icon="<?php echo esc_attr( $cover3d_back_cover_icon ); ?>"
					data-size="<?php echo esc_attr( $cover3d_book_size ); ?>"
				>
					<div aria-hidden="true" class="book-cover-pages"></div>
					<picture>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $cover3d_medium_size_url ); ?>">
						<source media="(min-width: 768px)" srcset="<?php echo esc_url( $cover3d_selected_size_url ); ?>">
						<img
							<?php echo $cover3d_loading_attrs_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped above. ?>
							class="book-cover-image-file"
							width="<?php echo esc_attr( $cover3d_medium_size_width ); ?>"
							height="<?php echo esc_attr( $cover3d_medium_size_height ); ?>"
							src="<?php echo esc_url( $cover3d_medium_size_url ); ?>"
							alt="<?php echo esc_attr( $cover3d_img_alt ); ?>"
							onerror="this.classList.add('book-cover-notfound')"
						>
					</picture>
					<div
						class="book-backcover"
						<?php echo 'small' === $cover3d_book_size ? 'aria-hidden="true"' : ''; ?>
					>
						<?php echo 'small' !== $cover3d_book_size ? esc_html( $cover3d_back_cover_text ) : ''; ?>
					</div>
				</div>
			</div>
		<?php if ( $cover3d_has_link ) : ?>
		</a>
		<span
			id="book-cover-label-<?php echo esc_attr( $cover3d_block_id ); ?>"
			class="book-cover-sr-only"
		>
			<?php echo esc_html( $cover3d_img_alt ); ?>
		</span>
		<?php endif; ?>
	</div>
</div>
	<?php
	return ob_get_clean();
	}
} // End if function_exists.

// Call the render function and output its result.
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Function returns escaped HTML.
echo cover3d_render_book_block( $attributes, $content, $block );
