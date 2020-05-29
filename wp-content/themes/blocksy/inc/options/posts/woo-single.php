<?php

$options = [
	'woo_single_section_options' => [
		'type' => 'ct-options',
		'setting' => [ 'transport' => 'postMessage' ],
		'inner-options' => [

			[
				blocksy_rand_md5() => [
					'title' => __( 'General', 'blocksy' ),
					'type' => 'tab',
					'options' => [

						'gallery_style' => [
							'label' => __( 'Gallery Style', 'blocksy' ),
							'type' => 'ct-image-picker',
							'value' => 'horizontal',
							'setting' => [ 'transport' => 'postMessage' ],
							'choices' => [

								'horizontal' => [
									'src'   => blocksy_image_picker_url( 'woo-gallery-type-1.svg' ),
									'title' => __( 'Horizontal', 'blocksy' ),
								],

								'vertical' => [
									'src'   => blocksy_image_picker_url( 'woo-gallery-type-2.svg' ),
									'title' => __( 'Vertical', 'blocksy' ),
								],

							],
						],

						'productGalleryWidth' => [
							'label' => __( 'Gallery Width', 'blocksy' ),
							'type' => 'ct-slider',
							'defaultUnit' => '%',
							'value' => 48,
							'min' => 20,
							'max' => 70,
							'setting' => [ 'transport' => 'postMessage' ],
						],

						'product_gallery_ratio' => [
							'label' => __( 'Thumbnail', 'blocksy' ),
							'type' => 'ct-ratio',
							'value' => '3/4',
							'design' => 'inline',
							'attr' => [ 'data-type' => 'compact' ],
							'setting' => [ 'transport' => 'postMessage' ],
							'preview_width_key' => 'woocommerce_single_image_width',
							'inner-options' => [

								'woocommerce_single_image_width' => [
									'type' => 'text',
									'label' => __('Image Width', 'blocksy'),
									'desc' => __('Image height will be automatically calculated based on the image ratio.', 'blocksy'),
									'value' => 600,
									'design' => 'inline',
									'setting' => [
										'type' => 'option',
										'capability' => 'manage_woocommerce',
									]
								],

							],
						],


						'product_content_style' => [
							'label' => __( 'Content Area Style', 'blocksy' ),
							'type' => 'ct-radio',
							'value' => 'wide',
							'view' => 'text',
							'design' => 'block',
							'divider' => 'top',
							'setting' => [ 'transport' => 'postMessage' ],
							'choices' => [
								'wide' => __( 'Wide', 'blocksy' ),
								'boxed' => __( 'Boxed', 'blocksy' ),
							],
						],

					],
				],

				blocksy_rand_md5() => [
					'title' => __( 'Design', 'blocksy' ),
					'type' => 'tab',
					'options' => [

						'singleProductTitleFont' => [
							'type' => 'ct-typography',
							'label' => __( 'Product Title Font', 'blocksy' ),
							'value' => blocksy_typography_default_values([
								'size' => '30px',
							]),
							'setting' => [ 'transport' => 'postMessage' ],
						],

						'singleProductTitleColor' => [
							'label' => __( 'Product Title Color', 'blocksy' ),
							'type'  => 'ct-color-picker',
							'design' => 'inline',
							'divider' => 'bottom',
							'setting' => [ 'transport' => 'postMessage' ],

							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--headingColor)'
								],
							],
						],

						'singleProductPriceColor' => [
							'label' => __( 'Price Color', 'blocksy' ),
							'type'  => 'ct-color-picker',
							'design' => 'inline',
							'setting' => [ 'transport' => 'postMessage' ],

							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--color)'
								],
							],
						],

						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

						'product_page_background' => [
							'label' => __( 'Page Background', 'blocksy' ),
							'type' => 'ct-background',
							'design' => 'inline',
							'setting' => [ 'transport' => 'postMessage' ],
							'value' => blocksy_background_default_value([
								'backgroundColor' => [
									'default' => [
										'color' => Blocksy_Css_Injector::get_skip_rule_keyword(),
									],
								],
							]),
							'desc' => sprintf(
								// translators: placeholder here means the actual URL.
								__( 'Please note: by default this option is inherited from %sGeneral ➝ Site Background%s.', 'blocksy' ),
								sprintf(
									'<a data-trigger-section="general" href="%s">',
									admin_url('/customize.php?autofocus[section]=general')
								),
								'</a>'
							),
						],

						blocksy_rand_md5() => [
							'type' => 'ct-condition',
							'condition' => [ 'product_content_style' => 'boxed' ],
							'options' => [

								'product_content_background' => [
									'label' => __( 'Content Area Background', 'blocksy' ),
									'type' => 'ct-background',
									'design' => 'inline',
									'divider' => 'top',
									'setting' => [ 'transport' => 'postMessage' ],
									'value' => blocksy_background_default_value([
										'backgroundColor' => [
											'default' => [
												'color' => '#ffffff',
											],
										],
									])
								],

								'productContentBoxedShadow' => [
									'label' => __( 'Content Area Shadow', 'blocksy' ),
									'type' => 'ct-box-shadow',
									'responsive' => true,
									'divider' => 'top',
									'setting' => [ 'transport' => 'postMessage' ],
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

								'productContentBoxedSpacing' => [
									'label' => __( 'Content Area Spacing', 'blocksy' ),
									'type' => 'ct-slider',
									'value' => [
										'desktop' => '40px',
										'tablet' => '35px',
										'mobile' => '20px',
									],
									'units' => blocksy_units_config([
										[ 'unit' => 'px', 'min' => 0, 'max' => 200 ],
									]),
									'responsive' => true,
									'divider' => 'top',
									'setting' => [ 'transport' => 'postMessage' ],
								],

							],
						],

					],
				],

				blocksy_rand_md5() => [
					'type'  => 'ct-title',
					'label' => __( 'Product Elements', 'blocksy' ),
				],

				'has_product_single_onsale' => [
					'label' => __( 'Sale Badge', 'blocksy' ),
					'type' => 'ct-switch',
					'value' => 'yes',
					'setting' => [ 'transport' => 'postMessage' ],
				],

				'has_product_single_rating' => [
					'label' => __( 'Star Rating', 'blocksy' ),
					'type' => 'ct-switch',
					'value' => 'yes',
					'setting' => [ 'transport' => 'postMessage' ],
				],

				'has_product_single_lightbox' => [
					'label' => __( 'Image Lightbox', 'blocksy' ),
					'type' => 'ct-switch',
					'value' => 'no'
				],

				'has_product_single_meta' => [
					'label' => __( 'Product Meta', 'blocksy' ),
					'type' => 'ct-switch',
					'value' => 'yes',
					'setting' => [ 'transport' => 'postMessage' ],
				],

				blocksy_rand_md5() => [
					'type'  => 'ct-title',
					'label' => __( 'Page Elements', 'blocksy' ),
				],

				'has_product_breadcrumbs' => [
					'label' => __( 'Breadcrumbs', 'blocksy' ),
					'type' => 'ct-switch',
					'value' => 'yes',
					'setting' => [ 'transport' => 'postMessage' ],
				],

				blocksy_rand_md5() => [
					'label' => __( 'Related & Upsells', 'blocksy' ),
					'type' => 'ct-panel',
					'inner-options' => [

						'upsell_products_visibility' => [
							'label' => __('Upsell Visibility', 'blocksy'),
							'type' => 'ct-visibility',
							'design' => 'block',
							'setting' => ['transport' => 'postMessage'],
							'allow_empty' => true,

							'value' => [
								'desktop' => true,
								'tablet' => false,
								'mobile' => false,
							],

							'choices' => blocksy_ordered_keys([
								'desktop' => __( 'Desktop', 'blocksy' ),
								'tablet' => __( 'Tablet', 'blocksy' ),
								'mobile' => __( 'Mobile', 'blocksy' ),
							]),
						],

						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

						'related_products_visibility' => [
							'label' => __('Related Visibility', 'blocksy'),
							'type' => 'ct-visibility',
							'design' => 'block',
							'setting' => ['transport' => 'postMessage'],
							'allow_empty' => true,

							'value' => [
								'desktop' => true,
								'tablet' => false,
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
			],

			apply_filters(
				'blocksy_single_product_elements_end_customizer_options',
				[]
			),

			blocksy_get_options('general/sidebar-particular', [
				'prefix' => 'product'
			]),

			blocksy_rand_md5() => [
				'type'  => 'ct-title',
				'label' => __( 'Functionality Options', 'blocksy' ),
			],

			'has_product_sticky_summary' => [
				'label' => __( 'Sticky Summary', 'blocksy' ),
				'type' => 'ct-switch',
				'value' => 'no',
				'setting' => [ 'transport' => 'postMessage' ],
			],

			'has_ajax_add_to_cart' => [
				'label' => __( 'AJAX add to cart', 'blocksy' ),
				'type' => 'ct-switch',
				'value' => 'no',
			],


		],
	],
];
