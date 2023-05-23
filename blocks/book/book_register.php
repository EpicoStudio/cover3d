<?php
PG_Blocks::register_block_type( array(
    'name' => 'cover3d/book',
    'title' => __( '3D Book Cover', 'cover3d' ),
    'description' => __( 'A 3D book cover animated on hover.', 'cover3d' ),
    'icon' => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m10.212 17.714-2.82 2.743h6.121l2.82-2.743h-6.121zM10.212 13.371l-2.82-2.742h6.121l2.82 2.742h-6.121zM6.81 13.606l2.82 2.743v-2.412l-2.82-2.743v2.412zM16.914 16.914v-2.743h-6.461v2.743h6.461zM10.453 3.543h6.461v2.743h-6.461V3.543zM7.392 0h6.121l2.82 2.743h-6.121L7.392 0zM6.81 2.977 9.63 5.72V3.309L6.81.566v2.411zM10.212 7.086h6.121l-2.82 2.743H7.392l2.82-2.743zM16.914 18.28l-2.819 2.743v2.411l2.819-2.743V18.28zM6.81 24h6.462v-2.743H6.81V24z"/></svg>',
    'category' => 'media',
    'keywords' => array( 'book', 'cover', '3D', 'animated', 'hover', 'lead magnet' ),
    'enqueue_style' => COVER3D_URL . '/assets/style-min.css',
    'render_template' => 'blocks/book/book.php',
    'supports' => array('color' => array('background' => false,'text' => false,'gradients' => false,'link' => false,),'typography' => array('fontSize' => false,),'anchor' => false,'align' => false,),
    'base_url' => COVER3D_URL,
    'base_path' => COVER3D_PATH,
    'js_file' => 'blocks/book/book.js',
    'attributes' => array(
        'book_cover_link' => array(
            'type' => 'object',
            'default' => array('post_id' => 0, 'url' => '', 'post_type' => '', 'title' => '')
        ),
        'book_size' => array(
            'type' => 'string',
            'default' => 'big'
        ),
        'back_cover_text' => array(
            'type' => 'string',
            'default' => __( 'Download', 'cover3d')
        ),
        'back_cover_icon_type' => array(
            'type' => 'string',
            'default' => 'download'
        ),
        'back_cover_color' => array(
            'type' => 'string',
            'default' => '#ffffff'
        ),
        'back_cover_bkg_color' => array(
            'type' => 'string',
            'default' => '#0049ff'
        ),
        'book_cover_img' => array(
            'type' => 'object',
            'default' => array('id' => 0, 'url' => esc_url( COVER3D_URL . '/assets/cover.png' ), 'size' => '', 'svg' => '', 'alt' => null)
        )
    ),
    'example' => array(
        'book_cover_link' => array('post_id' => 0, 'url' => '#void', 'post_type' => '', 'title' => ''), 'book_size' => 'big', 'back_cover_text' => __( 'Buy', 'cover3d'), 'back_cover_icon_type' => 'download', 'back_cover_color' => '', 'back_cover_bkg_color' => '', 'book_cover_img' => array('id' => 0, 'url' => esc_url( COVER3D_URL . '/assets/cover.png' ), 'size' => '', 'svg' => '', 'alt' => null)
    ),
    'dynamic' => true,
    'version' => '0.1.0'
) );