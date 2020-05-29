<?php

$options = [

	[
		'page_title_panel' => [
			'label' => __( 'Page Title', 'blocksy' ),
			'type' => 'ct-panel',
			'wrapperAttr' => [ 'data-label' => 'heading-label' ],
			'setting' => [ 'transport' => 'postMessage' ],
			'inner-options' => [

				blocksy_get_options('general/page-title', [
					'has_default' => true,
					'is_single' => true,
					'is_page' => true
				])

			]
		],

		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Page Structure', 'blocksy' ),
		],

		'page_structure_type' => [
			'label' => false,
			'type' => 'ct-image-picker',
			'value' => 'default',
			'design' => 'block',
			'attr' => [
				'data-type' => 'background',
				'data-state' => 'sync',
			],
			'setting' => [ 'transport' => 'postMessage' ],
			'choices' => [

				'default' => [
					'src'   => blocksy_image_picker_url( 'default.svg' ),
					'title' => __( 'Inherit from customizer', 'blocksy' ),
				],

				'type-3' => [
					'src'   => blocksy_image_picker_url( 'narrow.svg' ),
					'title' => __( 'Narrow Width', 'blocksy' ),
				],

				'type-4' => [
					'src'   => blocksy_image_picker_url( 'normal.svg' ),
					'title' => __( 'Normal Width', 'blocksy' ),
				],

				'type-2' => [
					'src'   => blocksy_image_picker_url( 'left-single-sidebar.svg' ),
					'title' => __( 'Left Sidebar', 'blocksy' ),
				],

				'type-1' => [
					'src'   => blocksy_image_picker_url( 'right-single-sidebar.svg' ),
					'title' => __( 'Right Sidebar', 'blocksy' ),
				],

			],
		],

		'page_enable_vertical_spacing' => [
			'label' => __( 'Page Vertical Spacing', 'blocksy' ),
			'type' => 'ct-switch',
			'value' => 'yes',
			'divider' => 'top',
			'desc' => __( 'You may need to turn off this option when building a page with a page builder.', 'blocksy' ),
		],

		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Page Elements', 'blocksy' ),
		],

		'disable_featured_image' => [
			'label' => __( 'Disable Featured Image', 'blocksy' ),
			'type' => 'ct-switch',
			'value' => 'no',
		],
	],

	apply_filters(
		'blocksy_extensions_metabox_page_bottom',
		[]
	)

];
