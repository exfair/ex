<?php

if (! isset($is_bbpress)) {
	$is_bbpress = false;
}

$options = [
	$post_type->name . '_single_section_options' => [
		'type' => 'ct-options',
		'inner-options' => [
			[
				$post_type->name . '_single_title_enabled' => [
					'label' => sprintf(
						__('%s Title', 'blocksy'),
						$post_type->labels->singular_name
					),
					'type' => 'ct-panel',
					'switch' => true,
					'value' => 'yes',
					'wrapperAttr' => [ 'data-label' => 'heading-label' ],
					'inner-options' => [
						blocksy_get_options('general/page-title', [
							'prefix' => $post_type->name . '_single',
							'is_single' => true,
							'is_bbpress' => $is_bbpress,
							'has_sync' => false
						])
					],
				],

				blocksy_rand_md5() => [
					'type' => 'ct-title',
					'label' => sprintf(
						__('%s Structure', 'blocksy'),
						$post_type->labels->singular_name
					),
				],

				blocksy_rand_md5() => [
					'title' => __( 'General', 'blocksy' ),
					'type' => 'tab',
					'options' => array_merge([
						$post_type->name . '_single_structure' => [
							'label' => false,
							'type' => 'ct-image-picker',
							'value' => 'type-4',
							'choices' => [
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

						$post_type->name . '_single_content_style' => [
							'label' => __( 'Content Area Style', 'blocksy' ),
							'type' => 'ct-radio',
							'value' => 'wide',
							'view' => 'text',
							'design' => 'block',
							'choices' => [
								'wide' => __( 'Wide', 'blocksy' ),
								'boxed' => __( 'Boxed', 'blocksy' ),
							],
						],
					]),
				],

				blocksy_rand_md5() => [
					'title' => __( 'Design', 'blocksy' ),
					'type' => 'tab',
					'options' => [

						$post_type->name . '_background' => [
							'label' => sprintf(
								__('%s Background', 'blocksy'),
								$post_type->labels->singular_name
							),
							'type' => 'ct-background',
							'design' => 'inline',
							'value' => blocksy_background_default_value([
								'backgroundColor' => [
									'default' => [
										'color' => Blocksy_Css_Injector::get_skip_rule_keyword(),
									],
								],
							]),
							'desc' => sprintf(
								// translators: placeholder here means the actual URL.
								__( 'Please note, by default this option is inherited from Colors ➝ %sSite Background%s.', 'blocksy' ),
								sprintf(
									'<a data-trigger-section="color" href="%s">',
									admin_url('/customize.php?autofocus[section]=color')
								),
								'</a>'
							),
						],

						blocksy_rand_md5() => [
							'type' => 'ct-condition',
							'condition' => [
								$post_type->name . '_single_content_style' => 'boxed'
							],
							'options' => [
								$post_type->name . '_content_background' => [
									'label' => __( 'Content Area Background', 'blocksy' ),
									'type' => 'ct-background',
									'design' => 'inline',
									'divider' => 'top',
									'value' => blocksy_background_default_value([
										'backgroundColor' => [
											'default' => [
												'color' => '#ffffff',
											],
										],
									])
								],

								$post_type->name . 'ContentBoxedSpacing' => [
									'label' => __( 'Content Area Spacing', 'blocksy' ),
									'type' => 'ct-slider',
									'value' => [
										'desktop' => '40px',
										'tablet' => '35px',
										'mobile' => '20px',
									],
									'units' => blocksy_units_config([
										[
											'unit' => 'px',
											'min' => 0,
											'max' => 200,
										],
									]),
									'responsive' => true,
									'divider' => 'top',
								],

								$post_type->name . 'ContentBoxedRadius' => [
									'label' => __( 'Border Radius', 'blocksy' ),
									'type' => 'ct-spacing',
									'divider' => 'top',
									'value' => blocksy_spacing_value([
										'linked' => true,
									]),
									'responsive' => true
								],

								$post_type->name . 'ContentBoxedShadow' => [
									'label' => __( 'Content Area Shadow', 'blocksy' ),
									'type' => 'ct-box-shadow',
									'responsive' => true,
									'divider' => 'top',
									'value' => blocksy_box_shadow_value([
										'enable' => false,
										'h_offset' => 0,
										'v_offset' => 12,
										'blur' => 18,
										'spread' => -6,
										'inset' => false,
										'color' => [
											'color' => 'rgba(34, 56, 101, 0.04)',
										],
									])
								],

							],
						],

					],
				],

			],
		],
	],
];
