<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (! isset($hero_enabled_key)) {
	$hero_enabled_key = 'single_blog_post_title_enabled';
}

if (! isset($hero_section_key)) {
	$hero_section_key = 'single_blog_post_hero_section';
}

if (! isset($content_style_key)) {
	$content_style_key = 'single_content_style';
}

if (! isset($post_structure_key)) {
	$post_structure_key = 'single_blog_post_structure';
}

$options = [
	$prefix . 'has_featured_image' => [
		'label' => __( 'Featured Image', 'blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => 'no',
		'setting' => [ 'transport' => 'postMessage' ],
		'inner-options' => [

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [
					$hero_enabled_key => 'yes',
					$hero_section_key => '!type-2'
				],
				'options' => [

					$prefix . 'featured_image_location' => [
						'label' => __( 'Image Location', 'blocksy' ),
						'type' => 'ct-radio',
						'value' => 'above',
						'view' => 'text',
						'design' => 'block',
						'divider' => 'bottom',
						'setting' => [ 'transport' => 'postMessage' ],
						'choices' => [
							'above' => __( 'Above Title', 'blocksy' ),
							'below' => __( 'Below Title', 'blocksy' ),
						],
					],

				]
			],

			$prefix . 'featured_image_ratio' => [
				'label' => __( 'Image Ratio', 'blocksy' ),
				'type' => 'ct-ratio',
				'value' => 'original',
				'design' => 'inline',
				'setting' => [ 'transport' => 'postMessage' ],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [ $content_style_key => 'boxed' ],
				'options' => [

					$prefix . 'featured_image_boundless' => [
						'label' => __( 'Boundless Image', 'blocksy' ),
						'type' => 'ct-switch',
						'value' => 'no',
						'divider' => 'top',
						'setting' => [ 'transport' => 'postMessage' ],
					],

				],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [
					$post_structure_key => 'type-3 | type-4',
					$content_style_key => 'wide',
				],
				'options' => [

					$prefix . 'featured_image_width' => [
						'label' => __( 'Image Width', 'blocksy' ),
						'type' => 'ct-radio',
						'value' => 'default',
						'view' => 'text',
						'design' => 'block',
						'divider' => 'top',
						'setting' => [ 'transport' => 'postMessage' ],
						'choices' => [
							'default' => __( 'Default Width', 'blocksy' ),
							'wide' => __( 'Wide Width', 'blocksy' ),
						],
					],

				],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-divider',
			],

			$prefix . 'featured_image_visibility' => [
				'label' => __( 'Visibility', 'blocksy' ),
				'type' => 'ct-visibility',
				'design' => 'block',
				'setting' => [ 'transport' => 'postMessage' ],

				'value' => [
					'desktop' => true,
					'tablet' => true,
					'mobile' => false,
				],

				'choices' => blocksy_ordered_keys([
					'desktop' => __( 'Desktop', 'blocksy' ),
					'tablet' => __( 'Tablet', 'blocksy' ),
					'mobile' => __( 'Mobile', 'blocksy' ),
				]),
			],

		],
	],

];
