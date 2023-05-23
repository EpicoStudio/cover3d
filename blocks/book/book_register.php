<?php
PG_Blocks::register_block_type( array(
    'name' => 'cover3d/book',
    'title' => __( '3D Book Cover', 'cover3d' ),
    'description' => __( 'A 3D book cover animated on hover.', 'cover3d' ),
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 4H7C5.89543 4 5 4.89543 5 6C5 7.10457 5.89543 8 7 8H21V21C21 21.5523 20.5523 22 20 22H7C4.79086 22 3 20.2091 3 18V6C3 3.79086 4.79086 2 7 2H20C20.5523 2 21 2.44772 21 3V4ZM5 18C5 19.1046 5.89543 20 7 20H19V10H7C6.27143 10 5.58835 9.80521 5 9.46487V18ZM20 7H7C6.44772 7 6 6.55228 6 6C6 5.44772 6.44772 5 7 5H20V7Z"></path></svg>',
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