<?php

if (! isset($has_sync)) {
	$has_sync = true;
}

if (! isset($prefix)) {
	$prefix = '';
	$initial_prefix = '';
} else {
	$initial_prefix = $prefix;
	$prefix = $prefix . '_';
}

$options = [

	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'structure' => '!gutenberg'
		],
		'options' => [
			$prefix . 'has_sidebar' => [
				'label' => __( 'Sidebar', 'blocksy' ),
				'type' => 'ct-panel',
				'switch' => true,
				'value' => 'no',
				'setting' => $has_sync ? ['transport' => 'postMessage'] : [],
				'inner-options' => [

					$prefix . 'sidebar_position' => [
						'label' => __( 'Sidebar Position', 'blocksy' ),
						'type' => 'ct-image-picker',
						'value' => 'right',
						'divider' => 'bottom',
						'condition' => [ $prefix . 'has_sidebar' => 'yes' ],
						'setting' => $has_sync ? ['transport' => 'postMessage'] : [],
						'choices' => [
							'left' => [
								'src'   => blocksy_image_picker_url( 'left-sidebar.svg' ),
								'title' => __( 'Left Sidebar', 'blocksy' ),
							],

							'right' => [
								'src'   => blocksy_image_picker_url( 'right-sidebar.svg' ),
								'title' => __( 'Right Sidebar', 'blocksy' ),
							],
						],
					],

				],
			],

		]
	],

];
