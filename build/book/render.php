<?php
/**
 * Book block render template.
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

// Define a unique ID for the block.
$block_id = wp_unique_id( 'cover3d-' );

// Check the context (for editor preview).
$context = isset( $_GET['context'] ) ? sanitize_text_field( wp_unslash( $_GET['context'] ) ) : '';

// Get attributes with defaults.
$book_link          = $attributes['bookCoverLink'] ?? array( 'url' => '', 'opensInNewTab' => false );
$book_size          = $attributes['bookSize'] ?? 'big';
$back_cover_text    = $attributes['backCoverText'] ?? __( 'Download', 'cover3d' );
$back_cover_icon    = $attributes['backCoverIconType'] ?? 'download';
$back_cover_color   = $attributes['backCoverColor'] ?? '#ffffff';
$back_cover_bkg     = $attributes['backCoverBkgColor'] ?? '#0049ff';
$attachment_id      = $attributes['bookCoverImageId'] ?? 0;
$img_alt            = $attributes['bookCoverImageAlt'] ?? __( 'Cover image', 'cover3d' );

// Sanitize colors.
$back_cover_color = cover3d_sanitize_color( $back_cover_color );
$back_cover_bkg   = cover3d_sanitize_color( $back_cover_bkg );

// URL-encode the color for SVG usage (remove # for hex).
$svg_color = rawurlencode( $back_cover_color );

// Set the style for the "download" icon based on user choice.
$download_icon = sprintf(
	'#%1$s .book-cover-image[data-icon="download"] .book-backcover{background-image: url("data:image/svg+xml,%%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2$s\' stroke-width=\'1\'%%3E%%3Cstyle%%3E%%0A@keyframes a_d %%7B 0%%%% %%7B d: path(\'M12,6L12,13M12,13L15.5,9.5M12,13L8.5,9.5\'); animation-timing-function: cubic-bezier(.4,0,1,1); %%7D 50%%%% %%7B d: path(\'M12,6L12,15M12,15L15.5,11.5M12,15L8.5,11.5\'); animation-timing-function: cubic-bezier(0,0,.6,1); %%7D 100%%%% %%7B d: path(\'M12,6L12,13M12,13L15.5,9.5M12,13L8.5,9.5\'); %%7D %%7D%%0A%%3C/style%%3E%%3Cpath d=\'M9 17h6\' stroke-linecap=\'round\' stroke-linejoin=\'round\'/%%3E%%3Cpath d=\'M12 6v7m0 0l3.5-3.5m-3.5 3.5l-3.5-3.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\' style=\'animation: 1s linear infinite both a_d;\'/%%3E%%3Cpath d=\'M12 22c5.5 0 10-4.5 10-10c0-5.5-4.5-10-10-10c-5.5 0-10 4.5-10 10c0 5.5 4.5 10 10 10Z\' stroke-linecap=\'round\' stroke-linejoin=\'round\' /%%3E%%3C/svg%%3E");}',
	esc_attr( $block_id ),
	$svg_color
);

// Set the style for the "buy" icon based on user choice.
$buy_icon = sprintf(
	'#%1$s .book-cover-image[data-icon="buy"] .book-backcover{background-image: url("data:image/svg+xml,%%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2$s\' stroke-width=\'1\' %%3E%%3Cstyle%%3E@keyframes a0_d %%7B 0%%%% %%7B d: path(\'M12,6L12,13M12,13L14.5,10.5M12,13L9.5,10.5\'); animation-timing-function: cubic-bezier(.3,0,.7,.4); %%7D 10%%%% %%7B d: path(\'M12,4L12,11.1M12,11.1L14.5,8.6M12,11.1L9.5,8.6\'); animation-timing-function: cubic-bezier(.5,.2,1,1); %%7D 50%%%% %%7B d: path(\'M12,6L12,15M12,15L14.5,12.5M12,15L9.5,12.5\'); animation-timing-function: cubic-bezier(0,0,.6,1); %%7D 100%%%% %%7B d: path(\'M12,6L12,13M12,13L14.5,10.5M12,13L9.5,10.5\'); %%7D %%7D%%3C/style%%3E%%3Cg stroke-linecap=\'round\' stroke-linejoin=\'round\' transform=\'translate(.3,-1.5)\'%%3E%%3Cpath d=\'M18.8 23.2c.8 0 1.5-0.7 1.5-1.5c0-0.8-0.7-1.5-1.5-1.5c-0.8 0-1.5 .7-1.5 1.5c0 .8 .7 1.5 1.5 1.5Zm-10 0c.8 0 1.5-0.7 1.5-1.5c0-0.8-0.7-1.5-1.5-1.5c-0.8 0-1.5 .7-1.5 1.5c0 .8 .7 1.5 1.5 1.5Z\'/%%3E%%3Cpath d=\'M15.8 5.2h5.5l-2 11m-3.5-11m-5.8 0m.1 0h-5.8l2 11m-2-11c-0.2-0.7-1-2-3-2m18 13h-14.8c-1.8 0-2.7 .8-2.7 2c0 1.2 .9 2 2.7 2h14.3\'/%%3E%%3Cpath d=\'M12 6v7m0 0l2.5-2.5m-2.5 2.5l-2.5-2.5\' transform=\'translate(1,-1.4)\' style=\'animation: 1s linear infinite both a0_d;\'/%%3E%%3C/g%%3E%%3C/svg%%3E");}',
	esc_attr( $block_id ),
	$svg_color
);

// Set the color styles based on user choice.
$color_styles = sprintf(
	'#%1$s .book-cover-image > picture, #%1$s .book-cover-image .book-backcover { color: %2$s; background-color: %3$s; } img.book-cover-notfound::before { background-color: %3$s; } img.book-cover-notfound::after { color: %2$s; }',
	esc_attr( $block_id ),
	esc_attr( $back_cover_color ),
	esc_attr( $back_cover_bkg )
);

// Initialize image variables.
$selected_size_url   = COVER3D_URL . '/assets/cover2x.png';
$medium_size_url     = COVER3D_URL . '/assets/cover.png';
$medium_size_width   = 400;
$medium_size_height  = 600;

// If a custom image was chosen.
if ( $attachment_id > 0 ) {

	// Get the metadata for the image.
	$metadata = wp_get_attachment_metadata( $attachment_id );

	if ( $metadata ) {
		// Map book size to WordPress image size.
		$size_map = array(
			'big'    => 'large',
			'medium' => 'medium_large',
			'small'  => 'medium',
		);
		$wp_size = $size_map[ $book_size ] ?? 'large';

		// Get the image URL for the selected size.
		$img_src_array = wp_get_attachment_image_src( $attachment_id, $wp_size );
		if ( $img_src_array ) {
			$selected_size_url = $img_src_array[0];
		}

		// Get the image URL for the medium size.
		$medium_src_array = wp_get_attachment_image_src( $attachment_id, 'medium' );
		if ( $medium_src_array ) {
			$medium_size_url    = $medium_src_array[0];
			$medium_size_width  = $medium_src_array[1];
			$medium_size_height = $medium_src_array[2];
		}
	}
}

// Get performance attributes for usage inside the <img> tag.
$loading_attrs = wp_get_loading_optimization_attributes(
	'img',
	array(
		'width'  => $medium_size_width,
		'height' => $medium_size_height,
	),
	'template_part_header'
);

// Link attributes.
$link_url       = $book_link['url'] ?? '';
$opens_new_tab  = $book_link['opensInNewTab'] ?? false;
$has_link       = ! empty( $link_url ) && empty( $context );

// Build wrapper attributes.
$wrapper_attributes = empty( $context ) || 'edit' !== $context
	? get_block_wrapper_attributes( array( 'class' => 'book-cover' ) )
	: 'data-wp-block-props="true"';

?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<style>
		<?php echo 'buy' === $back_cover_icon ? wp_strip_all_tags( $buy_icon ) : wp_strip_all_tags( $download_icon ); ?>
		<?php echo wp_strip_all_tags( $color_styles ); ?>
	</style>
	<div class="book-cover-wrapper">
		<?php if ( $has_link ) : ?>
		<a
			class="book-cover-link"
			href="<?php echo esc_url( $link_url ); ?>"
			id="book-cover-link-<?php echo esc_attr( $block_id ); ?>"
			aria-labelledby="book-cover-label-<?php echo esc_attr( $block_id ); ?>"
			<?php echo $opens_new_tab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
		>
		<?php endif; ?>
			<div class="book-cover-container" id="<?php echo esc_attr( $block_id ); ?>">
				<div
					class="book-cover-image"
					data-icon="<?php echo esc_attr( $back_cover_icon ); ?>"
					data-size="<?php echo esc_attr( $book_size ); ?>"
				>
					<div aria-hidden="true" class="book-cover-pages"></div>
					<picture>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $medium_size_url ); ?>">
						<source media="(min-width: 768px)" srcset="<?php echo esc_url( $selected_size_url ); ?>">
						<img
							<?php
							foreach ( $loading_attrs as $attr_name => $attr_value ) {
								echo esc_attr( $attr_name ) . '="' . esc_attr( $attr_value ) . '" ';
							}
							?>
							class="book-cover-image-file"
							width="<?php echo esc_attr( $medium_size_width ); ?>"
							height="<?php echo esc_attr( $medium_size_height ); ?>"
							src="<?php echo esc_url( $medium_size_url ); ?>"
							alt="<?php echo esc_attr( $img_alt ); ?>"
							onerror="this.classList.add('book-cover-notfound')"
						>
					</picture>
					<div
						class="book-backcover"
						<?php echo 'small' === $book_size ? 'aria-hidden="true"' : ''; ?>
					>
						<?php echo 'small' !== $book_size ? esc_html( $back_cover_text ) : ''; ?>
					</div>
				</div>
			</div>
		<?php if ( $has_link ) : ?>
		</a>
		<span
			id="book-cover-label-<?php echo esc_attr( $block_id ); ?>"
			class="book-cover-sr-only"
		>
			<?php echo esc_html( $img_alt ); ?>
		</span>
		<?php endif; ?>
	</div>
</div>
