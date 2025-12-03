<?php
/**
 * Blocks manifest file for wp_register_block_types_from_metadata_collection.
 *
 * This file is auto-generated. Do not edit manually.
 *
 * @package Cover3D
 * @version 1.0.0
 */

return array(
	'epico-studio/cover3d' => array(
		'$schema'       => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion'    => 3,
		'name'          => 'epico-studio/cover3d',
		'version'       => '1.0.0',
		'title'         => 'Cover 3D',
		'category'      => 'media',
		'icon'          => 'book-alt',
		'description'   => 'A block that displays a 3D book cover, animated when you mouse over it.',
		'keywords'      => array( 'book', 'cover', '3d', 'animation', 'ebook' ),
		'supports'      => array(
			'html'   => false,
			'align'  => array( 'left', 'center', 'right' ),
			'anchor' => true,
		),
		'textdomain'    => 'cover3d',
		'editorScript'  => 'file:./index.js',
		'editorStyle'   => 'file:./index.css',
		'style'         => 'file:./style-index.css',
		'render'        => 'file:./render.php',
		'attributes'    => array(
			'bookCoverImageId'   => array( 'type' => 'number', 'default' => 0 ),
			'bookCoverImageUrl'  => array( 'type' => 'string', 'default' => '' ),
			'bookCoverImageAlt'  => array( 'type' => 'string', 'default' => '' ),
			'bookSize'           => array( 'type' => 'string', 'default' => 'big' ),
			'backCoverText'      => array( 'type' => 'string', 'default' => '' ),
			'backCoverIconType'  => array( 'type' => 'string', 'default' => 'download' ),
			'backCoverColor'     => array( 'type' => 'string', 'default' => '#ffffff' ),
			'backCoverBkgColor'  => array( 'type' => 'string', 'default' => '#0049ff' ),
			'bookCoverLink'      => array(
				'type'    => 'object',
				'default' => array(
					'url'           => '',
					'opensInNewTab' => false,
				),
			),
		),
	),
);
