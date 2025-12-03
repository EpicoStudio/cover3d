<?php
// This file is generated. Do not modify it manually.
return array(
	'book' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'cover3d/book',
		'version' => '1.0.0',
		'title' => '3D Book Cover',
		'category' => 'media',
		'description' => 'A 3D book cover animated on hover.',
		'keywords' => array(
			'book',
			'cover',
			'3D',
			'animated',
			'hover',
			'lead magnet'
		),
		'icon' => 'book',
		'textdomain' => 'cover3d',
		'supports' => array(
			'color' => array(
				'background' => false,
				'text' => false,
				'gradients' => false,
				'link' => false
			),
			'typography' => array(
				'fontSize' => false
			),
			'anchor' => false,
			'align' => false,
			'html' => false
		),
		'attributes' => array(
			'bookCoverLink' => array(
				'type' => 'object',
				'default' => array(
					'url' => '',
					'opensInNewTab' => false
				)
			),
			'bookSize' => array(
				'type' => 'string',
				'default' => 'big'
			),
			'backCoverText' => array(
				'type' => 'string',
				'default' => 'Download'
			),
			'backCoverIconType' => array(
				'type' => 'string',
				'default' => 'download'
			),
			'backCoverColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'backCoverBkgColor' => array(
				'type' => 'string',
				'default' => '#0049ff'
			),
			'bookCoverImageId' => array(
				'type' => 'integer',
				'default' => 0
			),
			'bookCoverImageAlt' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'example' => array(
			'attributes' => array(
				'bookCoverLink' => array(
					'url' => '#',
					'opensInNewTab' => false
				),
				'bookSize' => 'big',
				'backCoverText' => 'Download',
				'backCoverIconType' => 'download'
			)
		),
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	)
);
