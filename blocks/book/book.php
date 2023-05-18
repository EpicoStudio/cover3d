<div <?php if(empty($_GET['context']) || $_GET['context'] !== 'edit') echo get_block_wrapper_attributes( array('class' => "book-cover", ) ); else echo 'data-wp-block-props="true"'; ?>>
        <?php $block_id = wp_unique_id() ?? 'ID'; ?><div class="book-cover-wrapper">
            <?php $book_link = PG_Blocks::getAttribute($args, 'book_cover_link');
if ($book_link['url']):
 ?><a class="book-cover-link" href="<?php echo (!empty($_GET['context']) && $_GET['context'] === 'edit') ? 'javascript:void()' : PG_Blocks::getLinkUrl( $args, 'book_cover_link' ) ?>" id="<?php echo "book-cover-link-" . $block_id;
 ?>" aria-labelledby="<?php echo "book-cover-label-" . $block_id; ?>">
                <?php endif; ?><div class="book-cover-container" id="<?php echo "book-cover-container-" . $block_id; ?>"><?php $back_cover_color = cover3d_sanitize_rgba(PG_Blocks::getAttribute($args, 'back_cover_color')) ?? 'rgba(255,255,255,1)';
$back_cover_bkg_color = cover3d_sanitize_rgba(PG_Blocks::getAttribute($args, 'back_cover_bkg_color')) ?? 'rgb(0,73,255,1)';
$back_cover_icon_type = PG_Blocks::getAttribute($args, 'back_cover_icon_type') ?? 'download';

$color_styles = <<<EOT
<style>#book-cover-container-$block_id .book-cover-image > :first-child,#book-cover-container-$block_id .book-cover-image::after{color:$back_cover_color;background-color:$back_cover_bkg_color;}img.book-cover-notfound::before{background-color:$back_cover_bkg_color}img.book-cover-notfound::after{color:$back_cover_color}</style>
EOT;

echo $color_styles;

$download_icon = <<<EOT
<style>#book-cover-container-$block_id .book-cover-image[data-icon="download"]::after{background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='$back_cover_color' stroke-width='1'%3E%3Cstyle%3E%0A@keyframes a_d %7B 0%25 %7B d: path('M12,6L12,13M12,13L15.5,9.5M12,13L8.5,9.5'); animation-timing-function: cubic-bezier(.4,0,1,1); %7D 50%25 %7B d: path('M12,6L12,15M12,15L15.5,11.5M12,15L8.5,11.5'); animation-timing-function: cubic-bezier(0,0,.6,1); %7D 100%25 %7B d: path('M12,6L12,13M12,13L15.5,9.5M12,13L8.5,9.5'); %7D %7D%0A%3C/style%3E%3Cpath d='M9 17h6' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 6v7m0 0l3.5-3.5m-3.5 3.5l-3.5-3.5' stroke-linecap='round' stroke-linejoin='round' style='animation: 1s linear infinite both a_d;'/%3E%3Cpath d='M12 22c5.5 0 10-4.5 10-10c0-5.5-4.5-10-10-10c-5.5 0-10 4.5-10 10c0 5.5 4.5 10 10 10Z' stroke-linecap='round' stroke-linejoin='round' /%3E%3C/svg%3E");}</style>
EOT;

$buy_icon = <<<EOT
<style>#book-cover-container-$block_id .book-cover-image[data-icon="buy"]::after{background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='$back_cover_color' stroke-width='1' %3E%3Cstyle%3E@keyframes a0_d %7B 0%25 %7B d: path('M12,6L12,13M12,13L14.5,10.5M12,13L9.5,10.5'); animation-timing-function: cubic-bezier(.3,0,.7,.4); %7D 10%25 %7B d: path('M12,4L12,11.1M12,11.1L14.5,8.6M12,11.1L9.5,8.6'); animation-timing-function: cubic-bezier(.5,.2,1,1); %7D 50%25 %7B d: path('M12,6L12,15M12,15L14.5,12.5M12,15L9.5,12.5'); animation-timing-function: cubic-bezier(0,0,.6,1); %7D 100%25 %7B d: path('M12,6L12,13M12,13L14.5,10.5M12,13L9.5,10.5'); %7D %7D%3C/style%3E%3Cg stroke-linecap='round' stroke-linejoin='round' transform='translate(.3,-1.5)'%3E%3Cpath d='M18.8 23.2c.8 0 1.5-0.7 1.5-1.5c0-0.8-0.7-1.5-1.5-1.5c-0.8 0-1.5 .7-1.5 1.5c0 .8 .7 1.5 1.5 1.5Zm-10 0c.8 0 1.5-0.7 1.5-1.5c0-0.8-0.7-1.5-1.5-1.5c-0.8 0-1.5 .7-1.5 1.5c0 .8 .7 1.5 1.5 1.5Z'/%3E%3Cpath d='M15.8 5.2h5.5l-2 11m-3.5-11m-5.8 0m.1 0h-5.8l2 11m-2-11c-0.2-0.7-1-2-3-2m18 13h-14.8c-1.8 0-2.7 .8-2.7 2c0 1.2 .9 2 2.7 2h14.3'/%3E%3Cpath d='M12 6v7m0 0l2.5-2.5m-2.5 2.5l-2.5-2.5' transform='translate(1,-1.4)' style='animation: 1s linear infinite both a0_d;'/%3E%3C/g%3E%3C/svg%3E");}</style>
EOT;

if ('buy' === $back_cover_icon_type):
    echo $buy_icon;
else :
    echo $download_icon;
endif; ?><div class="book-cover-image" data-download-text="<?php echo PG_Blocks::getAttribute( $args, 'back_cover_text' ) ?>" data-icon="<?php echo PG_Blocks::getAttribute( $args, 'back_cover_icon_type' ) ?>" data-size="<?php echo PG_Blocks::getAttribute( $args, 'book_size' ) ?>">
                        <?php if ( !PG_Blocks::getImageSVG( $args, 'book_cover_img', false) && PG_Blocks::getImageUrl( $args, 'book_cover_img', 'medium' ) ) : ?><img src="<?php echo PG_Blocks::getImageUrl( $args, 'book_cover_img', 'medium' ) ?>" onerror="this.classList.add('book-cover-notfound')" class="<?php echo (PG_Blocks::getImageField( $args, 'book_cover_img', 'id', true) ? ('wp-image-' . PG_Blocks::getImageField( $args, 'book_cover_img', 'id', true)) : '') ?>" alt="<?php $img_alt = PG_Blocks::getImageField( $args, 'book_cover_img', 'alt', true);
if ($img_alt) : echo $img_alt; else: _e('Cover image', 'cover3d'); endif; ?>" srcset="<?php echo PG_Blocks::getImageUrl( $args, 'book_cover_img', 'medium' ) . ' 1x, ' . PG_Blocks::getImageUrl( $args, 'book_cover_img', 'medium_large' ) . ' 2x'; ?>"  sizes="<?php echo "(min-width: 768px) 50vw, 100vw" ?>"><?php endif; ?><?php if ( PG_Blocks::getImageSVG( $args, 'book_cover_img', false) ) : ?><?php echo PG_Blocks::mergeInlineSVGAttributes( PG_Blocks::getImageSVG( $args, 'book_cover_img' ), array() ) ?><?php endif; ?>
                    </div>
                </div><?php if ($book_link['url']): ?>
            </a><?php echo '<span id="book-cover-label-' . $block_id . '" class="book-cover-sr-only">' . sprintf(__('%s', 'cover3d'), PG_Blocks::getImageField( $args, 'book_cover_img', 'alt', true)) . '</span>';
endif; ?>
        
        </div>
    </div>