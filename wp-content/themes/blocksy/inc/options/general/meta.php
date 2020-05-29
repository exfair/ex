<?php

if (! isset($has_label)) {
	$has_label = false;
}

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (! isset($is_page)) {
	$is_page = false;
}

if (! isset($item_style_type)) {
	$item_style_type = 'ct-radio';
}

if (! isset($item_divider_type)) {
	$item_divider_type = 'ct-radio';
}

if (! isset($meta_elements)) {
	$meta_elements = blocksy_post_meta_defaults([
		[
			'id' => 'author',
			'enabled' => true,
		],

		[
			'id' => 'post_date',
			'enabled' => true,
		],

		[
			'id' => 'updated_date',
			'enabled' => false,
		],

		[
			'id' => 'categories',
			'enabled' => true,
		],

		[
			'id' => 'comments',
			'enabled' => true,
		],

		[
			'id' => 'tags',
			'enabled' => false,
		]
	]);
}

$date_format_options = [
	blocksy_rand_md5() => [
		'type' => 'ct-group',
		'attr' => [ 'data-columns' => '1' ],
		'options' => [
			'date_format_source' => [
				'label' => __( 'Date Format', 'blocksy' ),
				'type' => 'ct-radio',
				'value' => 'default',
				'view' => 'text',
				'setting' => [ 'transport' => 'postMessage' ],
				'choices' => [
					'default' => __( 'Default', 'blocksy' ),
					'custom' => __( 'Custom', 'blocksy' ),
				],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [
					'date_format_source' => 'custom'
				],
				'options' => [
					'date_format' => [
						'label' => false,
						'type' => 'text',
						'design' => 'block',
						'value' => 'M j, Y',
						'setting' => [ 'transport' => 'postMessage' ],
						// translators: The interpolations addes a html link around the word.
						'desc' => sprintf(
							__('Date format %sinstructions%s.', 'blocksy'),
							'<a href="https://wordpress.org/support/article/formatting-date-and-time/#format-string-examples" target="_blank">',
							'</a>'
						),
						'disableRevertButton' => true,
					],
				],
			],
		],
	],
];

$options = [
	$prefix . 'meta_elements' => [
		'label' => $has_label ? __( 'Meta Elements', 'blocksy' ) : false,
		'type' => 'ct-layers',
		'wrapperAttr' => [ 'data-layer' => 'inner' ],
		'itemClass' => 'ct-inner-layer',
		'manageable' => true,
		'value' => $meta_elements,
		'setting' => ['transport' => 'postMessage'],

		'settings' => array_merge([
			'author' => [
				'label' => __('Author', 'blocksy'),
				'options' => [
					'has_author_avatar' => [
						'label' => __( 'Author Avatar', 'blocksy' ),
						'type' => 'ct-switch',
						'value' => 'no',
					],

					blocksy_rand_md5() => [
						'type' => 'ct-condition',
						'condition' => ['has_author_avatar' => 'yes'],
						'options' => [
							'avatar_size' => [
								'label' => __('Avatar Size', 'blocksy'),
								'type' => 'ct-number',
								'design' => 'inline',
								'value' => 25,
								'min' => 15,
								'max' => 50,
							],
						],
					],

					blocksy_rand_md5() => [
						'type' => 'ct-condition',
						'condition' => [ 'meta_type' => 'label' ],
						'values_source' => 'parent',
						'options' => [
							'label' => [
								'type' => 'text',
								'design' => 'inline',
								'value' => __('By', 'blocksy')
							],
						],
					],
				],
			],

			'comments' => [
				'label' => __('Comments', 'blocksy'),
			],

			'post_date' => [
				'label' => __('Published Date', 'blocksy'),
				'options' => [
					$date_format_options,

					[
						blocksy_rand_md5() => [
							'type' => 'ct-condition',
							'condition' => [ 'meta_type' => 'label' ],
							'values_source' => 'parent',
							'options' => [
								'label' => [
									'type' => 'text',
									'design' => 'inline',
									'value' => __('On', 'blocksy')
							],
							],
						],
					],
				],
			],

			'updated_date' => [
				'label' => __('Updated Date', 'blocksy'),
				'options' => [
					$date_format_options,

					[
						blocksy_rand_md5() => [
							'type' => 'ct-condition',
							'condition' => [ 'meta_type' => 'label' ],
							'values_source' => 'parent',
							'options' => [
								'label' => [
									'type' => 'text',
									'design' => 'inline',
									'value' => __('On', 'blocksy')
							],
							],
						],
					],
				],
			],


		], !$is_page ? [
			'categories' => [
				'label' => __('Categories', 'blocksy'),
				'options' => [
					'style' => [
						'label' => __( 'Categories Style', 'blocksy' ),
						'type' => 'ct-radio',
						'value' => 'simple',
						'setting' => [ 'transport' => 'postMessage' ],
						'view' => 'text',
						'choices' => [
							'simple' => __( 'Simple', 'blocksy' ),
							'pill' => __( 'Button', 'blocksy' ),
							'underline' => __( 'Underline', 'blocksy' ),
						],
					],

					blocksy_rand_md5() => [
						'type' => 'ct-condition',
						'condition' => [ 'meta_type' => 'label' ],
						'values_source' => 'parent',
						'options' => [
							'label' => [
								'type' => 'text',
								'design' => 'inline',
								'value' => __('In', 'blocksy')
							],
						],
					],
				],
			],

			'tags' => [
				'label' => __('Tags', 'blocksy'),
				'options' => [
					'style' => [
						'label' => __( 'Tags Style', 'blocksy' ),
						'type' => 'ct-radio',
						'value' => 'simple',
						'setting' => [ 'transport' => 'postMessage' ],
						'view' => 'text',
						'choices' => [
							'simple' => __( 'Simple', 'blocksy' ),
							'pill' => __( 'Button', 'blocksy' ),
							'underline' => __( 'Underline', 'blocksy' ),
						],
					],

					blocksy_rand_md5() => [
						'type' => 'ct-condition',
						'condition' => [ 'meta_type' => 'label' ],
						'values_source' => 'parent',
						'options' => [
							'label' => [
								'type' => 'text',
								'design' => 'inline',
								'value' => __('In', 'blocksy')
							],
						],
					],
				],
			]
		] : []),
	],

	$prefix . 'meta_type' => [
		'label' => __('Items Style', 'blocksy'),
		'type' => $item_style_type,
		'value' => 'simple',
		'setting' => ['transport' => 'postMessage'],
		'view' => 'text',
		'choices' => [
			'simple' => __('Simple', 'blocksy'),
			'label' => __('Labels', 'blocksy'),
			'icons' => __('Icons', 'blocksy'),
		],
	],

	$prefix . 'meta_divider' => [
		'label' => __('Items Divider', 'blocksy'),
		'type' => $item_divider_type,
		'value' => 'slash',
		'view' => 'text',
		'attr' => [ 'data-type' => 'meta-divider' ],
		'setting' => ['transport' => 'postMessage'],
		'choices' => [
			'none' => __('none', 'blocksy'),
			'slash' => '',
			'line' => '',
			'circle' => '',
		],
	],
];

