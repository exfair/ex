<?php

$options = [
	$post_type->name . '_section_options' => [
		'type' => 'ct-options',
		'inner-options' => [
			[
				$post_type->name . '_page_title_enabled' => [
					'label' => sprintf(
						__('%s Title', 'blocksy'),
						$post_type->labels->name
					),
					'type' => 'ct-panel',
					'switch' => true,
					'value' => 'yes',
					'wrapperAttr' => [ 'data-label' => 'heading-label' ],
					'inner-options' => [
						blocksy_get_options('general/page-title', [
							'prefix' => $post_type->name . '_archive',
							'has_sync' => false
						])
					],
				],
			],

			blocksy_get_options('general/posts-listing', [
				'prefix' => $post_type->name . '_archive',
				'title' => $post_type->labels->name,
				'has_sync' => false
			]),

			[
				blocksy_rand_md5() => [
					'type' => 'ct-title',
					'label' => __( 'Page Elements', 'blocksy' ),
				],
			],

			blocksy_get_options('general/sidebar-particular', [
				'prefix' => $post_type->name . '_archive',
				'has_sync' => false
			]),

			blocksy_get_options('general/pagination', [
				'prefix' => $post_type->name,
				'has_sync' => false
			]),


			[
				blocksy_rand_md5() => [
					'type' => 'ct-title',
					'label' => __( 'Functionality Options', 'blocksy' ),
				],
			],

			blocksy_get_options('general/cards-reveal-effect', [
				'prefix' => $post_type->name,
			]),
		],
	],
];
