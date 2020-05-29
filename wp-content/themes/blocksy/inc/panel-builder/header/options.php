<?php

$options = [
	'is_absolute' => apply_filters('blocksy:header:settings:is_absolute_option', [
		'label' => __( 'Absolute/Transparent', 'blocksy' ),
		'type' => 'hidden',
		'value' => 'no',
		'divider' => 'bottom',
		'setting' => [ 'transport' => 'postMessage' ],
	]),

	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => ['is_absolute' => 'yes'],
		'options' => [
			'absoluteHeaderBackground' => [
				'label' => __( 'Header Background', 'blocksy' ),
				'type' => 'ct-background',
				'design' => 'block:right',
				'responsive' => true,
				'setting' => [ 'transport' => 'postMessage' ],
				'value' => blocksy_background_default_value([
					'backgroundColor' => [
						'default' => [
							'color' => 'rgba(255, 255, 255, 0)'
						],
					],
				]),
			],
		],
	],

	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => ['is_absolute' => '!yes'],
		'options' => [
			'headerBackground' => [
				'label' => __( 'Header Background', 'blocksy' ),
				'type' => 'ct-background',
				'design' => 'block:right',
				'responsive' => true,
				'setting' => [ 'transport' => 'postMessage' ],
				'value' => blocksy_background_default_value([
					'backgroundColor' => [
						'default' => [
							'color' => '#ffffff'
						],
					],
				]),
				'desc' => __( 'Please note, you can also change the background color for each row individually.', 'blocksy' ),
			],
		]
	]
];
