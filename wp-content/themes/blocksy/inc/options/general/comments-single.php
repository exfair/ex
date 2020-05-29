<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [
	$prefix . 'has_comments' => [
		'label' => __( 'Comments', 'blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => 'yes',
		'setting' => [ 'transport' => 'postMessage' ],
		'inner-options' => [

			$prefix . 'comments_containment' => [
				'label' => __('Module Placement', 'blocksy'),
				'type' => 'ct-radio',
				'value' => 'separated',
				'view' => 'text',
				'design' => 'block',
				'setting' => [ 'transport' => 'postMessage' ],
				'desc' => __('Separate or unify the comments module from or with the entry content area.', 'blocksy'),
				'choices' => [
					'separated' => __('Separated', 'blocksy'),
					'contained' => __('Contained', 'blocksy'),
				],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-divider',
			],

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [ $prefix . 'comments_containment' => 'separated' ],
				'options' => [

					$prefix . 'comments_structure' => [
						'label' => __( 'Container Structure', 'blocksy' ),
						'type' => 'ct-radio',
						'value' => 'narrow',
						'view' => 'text',
						'design' => 'block',
						'setting' => [ 'transport' => 'postMessage' ],
						'choices' => [
							'narrow' => __( 'Narrow', 'blocksy' ),
							'normal' => __( 'Normal', 'blocksy' ),
						],
					],

				],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [
					$prefix . 'comments_containment' => 'separated',
					$prefix . 'comments_structure' => 'narrow'
				],
				'options' => [
					$prefix . 'commentsNarrowWidth' => [
						'label' => __( 'Container Max Width', 'blocksy' ),
						'type' => 'ct-slider',
						'value' => 750,
						'min' => 500,
						'max' => 800,
						'divider' => 'bottom',
						'setting' => [ 'transport' => 'postMessage' ],
					],
				],
			],

			$prefix . 'commentsFontColor' => [
				'label' => __( 'Font Color', 'blocksy' ),
				'type'  => 'ct-color-picker',
				'design' => 'inline',
				'setting' => [ 'transport' => 'postMessage' ],
				'value' => [
					'default' => [
						'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
					],

					'hover' => [
						'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
					],
				],

				'pickers' => [
					[
						'title' => __( 'Initial', 'blocksy' ),
						'id' => 'default',
						'inherit' => 'var(--color)'
					],

					[
						'title' => __( 'Hover', 'blocksy' ),
						'id' => 'hover',
						'inherit' => 'var(--linkHoverColor)'
					],
				],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [ $prefix . 'comments_containment' => 'separated' ],
				'options' => [

					$prefix . 'comments_background' => [
						'label' => __( 'Container Background', 'blocksy' ),
						'type' => 'ct-background',
						'design' => 'inline',
						'divider' => 'top',
						'setting' => [ 'transport' => 'postMessage' ],
						'value' => blocksy_background_default_value([
							'backgroundColor' => [
								'default' => [
									'color' => 'rgba(255, 255, 255, 0)',
								],
							],
						])
					],

				],
			],

		],
	],
];
