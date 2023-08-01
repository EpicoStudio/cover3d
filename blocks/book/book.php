<?php
/**
 * Book HTML template.
 * Version: 1.0
 *
 */

// Define an unique ID for the block.
$block_id = wp_unique_id() ?? 'ID';

// Check the context.
$context = isset($_GET['context']) ? sanitize_text_field($_GET['context']) : '';

// Check if a link was added.
$book_link = PG_Blocks::getAttribute( $args, 'book_cover_link' );

// Define the “alt” text.
$img_alt_value = PG_Blocks::getImageField($args, 'book_cover_img', 'alt', true);
$img_alt = $img_alt_value ?? __( 'Cover image', 'cover3d' );

 // Get user color choices.
$back_cover_color = PG_Helper_v2::sanitizeRgba( PG_Blocks::getAttribute( $args, 'back_cover_color' )) ?? 'rgba(255,255,255,1)';
$back_cover_bkg_color = PG_Helper_v2::sanitizeRgba( PG_Blocks::getAttribute( $args, 'back_cover_bkg_color' )) ?? 'rgb(0,73,255,1)';
$back_cover_icon_type = PG_Blocks::getAttribute( $args, 'back_cover_icon_type' ) ?? 'download';

// Set the style for the “download” icon based on user choice.
$download_icon = <<<EOT
#book-cover-container-$block_id .book-cover-image[data-icon="download"] .book-backcover{background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='$back_cover_color' stroke-width='1'%3E%3Cstyle%3E%0A@keyframes a_d %7B 0%25 %7B d: path('M12,6L12,13M12,13L15.5,9.5M12,13L8.5,9.5'); animation-timing-function: cubic-bezier(.4,0,1,1); %7D 50%25 %7B d: path('M12,6L12,15M12,15L15.5,11.5M12,15L8.5,11.5'); animation-timing-function: cubic-bezier(0,0,.6,1); %7D 100%25 %7B d: path('M12,6L12,13M12,13L15.5,9.5M12,13L8.5,9.5'); %7D %7D%0A%3C/style%3E%3Cpath d='M9 17h6' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 6v7m0 0l3.5-3.5m-3.5 3.5l-3.5-3.5' stroke-linecap='round' stroke-linejoin='round' style='animation: 1s linear infinite both a_d;'/%3E%3Cpath d='M12 22c5.5 0 10-4.5 10-10c0-5.5-4.5-10-10-10c-5.5 0-10 4.5-10 10c0 5.5 4.5 10 10 10Z' stroke-linecap='round' stroke-linejoin='round' /%3E%3C/svg%3E");}
EOT;

// Set the style for the “buy” icon based on user choice.
$buy_icon = <<<EOT
#book-cover-container-$block_id .book-cover-image[data-icon="buy"] .book-backcover{background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='$back_cover_color' stroke-width='1' %3E%3Cstyle%3E@keyframes a0_d %7B 0%25 %7B d: path('M12,6L12,13M12,13L14.5,10.5M12,13L9.5,10.5'); animation-timing-function: cubic-bezier(.3,0,.7,.4); %7D 10%25 %7B d: path('M12,4L12,11.1M12,11.1L14.5,8.6M12,11.1L9.5,8.6'); animation-timing-function: cubic-bezier(.5,.2,1,1); %7D 50%25 %7B d: path('M12,6L12,15M12,15L14.5,12.5M12,15L9.5,12.5'); animation-timing-function: cubic-bezier(0,0,.6,1); %7D 100%25 %7B d: path('M12,6L12,13M12,13L14.5,10.5M12,13L9.5,10.5'); %7D %7D%3C/style%3E%3Cg stroke-linecap='round' stroke-linejoin='round' transform='translate(.3,-1.5)'%3E%3Cpath d='M18.8 23.2c.8 0 1.5-0.7 1.5-1.5c0-0.8-0.7-1.5-1.5-1.5c-0.8 0-1.5 .7-1.5 1.5c0 .8 .7 1.5 1.5 1.5Zm-10 0c.8 0 1.5-0.7 1.5-1.5c0-0.8-0.7-1.5-1.5-1.5c-0.8 0-1.5 .7-1.5 1.5c0 .8 .7 1.5 1.5 1.5Z'/%3E%3Cpath d='M15.8 5.2h5.5l-2 11m-3.5-11m-5.8 0m.1 0h-5.8l2 11m-2-11c-0.2-0.7-1-2-3-2m18 13h-14.8c-1.8 0-2.7 .8-2.7 2c0 1.2 .9 2 2.7 2h14.3'/%3E%3Cpath d='M12 6v7m0 0l2.5-2.5m-2.5 2.5l-2.5-2.5' transform='translate(1,-1.4)' style='animation: 1s linear infinite both a0_d;'/%3E%3C/g%3E%3C/svg%3E");}
EOT;

// Set the color styles based on user choice.
$color_styles = <<<EOT
#book-cover-container-$block_id .book-cover-image > picture,#book-cover-container-$block_id .book-cover-image .book-backcover{color:$back_cover_color;background-color:$back_cover_bkg_color;}img.book-cover-notfound::before{background-color:$back_cover_bkg_color}img.book-cover-notfound::after{color:$back_cover_color}
EOT;

// Get the attachment ID of the custom image.
$attachment_id = PG_Blocks::getImageField( $args, 'book_cover_img', 'id', true );

// If a custom image was chosen.
if ( 0 !== $attachment_id ) :

    // User selected image size.
    $selected_size = PG_Blocks::getImageField( $args, 'book_cover_img', 'size', true );

    // Get the metadata for the image.
    $metadata = wp_get_attachment_metadata( $attachment_id );

    // If the array contain a `sizes` key with the value of the field.
    if ( isset( $metadata['sizes'][ $selected_size ] ) ) {
        // Use the available size to get the correct image metadata.
        $img_size = $metadata['sizes'][ $selected_size ];
    // But if the image size doesn't exist.
    } else {
        // Use the full size instead to get the metadata.
        $img_size = [
            'width' => $metadata['width'],
            'height' => $metadata['height']
        ];
    }

    // Get the image URL for the selected size.
    $img_src_array = wp_get_attachment_image_src($attachment_id, [$img_size['width'], $img_size['height']]);

    // Check if the array key exists.
    if ( isset( $img_src_array[0] ) ) {
        $selected_size_url = $img_src_array[0];
    } else {
        $selected_size_url = COVER3D_URL . '/assets/cover2x.png';
    }

    // Get the image URL for the medium size.
    $medium_size_url = wp_get_attachment_image_src( $attachment_id, 'medium' )[0];

    // Get the data for the medium size of the image.
    $medium_size_dimensions = $metadata['sizes']['medium'];

    // Get the width of the medium size.
    $medium_size_width = $medium_size_dimensions['width'];

    // Get the height of the medium size.
    $medium_size_height = $medium_size_dimensions['height'];

else: // If the user did not choose a image (use default).

    // Define the image URL for the large size.
    $selected_size_url = COVER3D_URL . '/assets/cover2x.png';

    // Define the image URL for the medium size.
    $medium_size_url = COVER3D_URL . '/assets/cover.png';

    // Define the width of the medium size.
    $medium_size_width = '400';

    // Define the height of the medium size.
    $medium_size_height = '600';

endif;

?>
<div <?php echo ( empty( $context ) || $context !== 'edit' ) ? get_block_wrapper_attributes( [ 'class' => "book-cover" ] ) : 'data-wp-block-props="true"'; ?>>
    <?php echo '<style>'; // Open the style tag. ?>
    <?php echo 'buy' === $back_cover_icon_type ? wp_strip_all_tags( $buy_icon ) : wp_strip_all_tags( $download_icon ); // Echo the desired icon. ?>
    <?php echo wp_strip_all_tags( $color_styles ); // Echo the color styles ?>
    <?php echo '</style>'; // Close the style tag. ?>
    <div class="book-cover-wrapper">
        <?php if ( $book_link['url'] && empty( $_GET['context'] ) ) : // If a link was added. ?>
        <a class="book-cover-link" href="<?php echo esc_url( PG_Blocks::getLinkUrl( $args, 'book_cover_link' ) ) ?>" id="<?php echo "book-cover-link-" . esc_attr( $block_id ) ?>" aria-labelledby="<?php echo "book-cover-label-" . esc_attr( $block_id ) ?>">
        <?php endif; ?>
            <div class="book-cover-container" id="<?php echo "book-cover-container-" . esc_attr( $block_id ) ?>">
                <div class="book-cover-image" data-icon="<?php echo esc_attr( PG_Blocks::getAttribute( $args, 'back_cover_icon_type' ) ) ?>" data-size="<?php echo esc_attr( PG_Blocks::getAttribute( $args, 'book_size' ) ) ?>">
                    <div aria-hidden="true" class="book-cover-pages"></div>
                    <picture>
                        <source media="(max-width: 767px)" srcset="<?php echo esc_url( $medium_size_url ) ?>">
                        <source media="(min-width: 768px)" srcset="<?php echo esc_url( $selected_size_url ) ?>">
                        <img
                            class="book-cover-image-file"
                            width="<?php echo esc_attr( $medium_size_width ) ?>"
                            height="<?php echo esc_attr( $medium_size_height ) ?>"
                            src="<?php echo esc_url( $medium_size_url ) ?>"
                            alt="<?php echo esc_html( $img_alt ); ?>"
                            onerror="this.classList.add('book-cover-notfound')">
                    </picture>
                    <div class="book-backcover" <?php echo 'small' === PG_Blocks::getAttribute( $args, 'book_size' ) ? 'aria-hidden="true"' : '' ?>>
                        <?php echo 'small' !== PG_Blocks::getAttribute( $args, 'book_size' ) ? esc_html( PG_Blocks::getAttribute( $args, 'back_cover_text' ) ) : '' ?>
                    </div>
                </div>
            </div>
        <?php if ( $book_link['url'] && empty( $_GET['context'] ) ) : // If a link was added. ?>
        </a>
        <?php echo '<span id="book-cover-label-' . esc_attr( $block_id ) . '" class="book-cover-sr-only">' . sprintf(__('%s', 'cover3d'), esc_html( $img_alt ) ) . '</span>';
        endif; ?>
    </div>
</div>