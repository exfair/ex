<?php

$page_title_source = blocksy_get_page_title_source(is_customize_preview());

if ($page_title_source) {
	$default_type = 'type-1';

	$default_hero_elements = [];

	$default_hero_elements[] = [
		'id' => 'custom_title',
		'enabled' => true,
	];

	$default_hero_elements[] = [
		'id' => 'custom_description',
		'enabled' => true,
	];

	if (is_singular() || is_author()) {
		$default_hero_elements[] = [
			'id' => 'custom_meta',
			'enabled' => true,
		];
	}

	if (is_author()) {
		$default_hero_elements[] = [
			'id' => 'author_social_channels',
			'enabled' => true,
		];
	}

	$default_hero_elements[] = [
		'id' => 'breadcrumbs',
		'enabled' => false,
	];

	$hero_elements = blocksy_akg_or_customizer(
		'hero_elements',
		blocksy_get_page_title_source(),
		$default_hero_elements
	);

	if (
		function_exists('is_woocommerce')
		&&
		(
			is_product_category()
			||
			is_product_tag()
			||
			is_shop()
		)
		&&
		isset($page_title_source['strategy'])
		&&
		$page_title_source['strategy'] === 'customizer'
	) {
		$default_type = 'type-2';
	}

	$type = blocksy_akg_or_customizer(
		'hero_section',
		$page_title_source,
		$default_type
	);

	$hero_elements = blocksy_akg_or_customizer(
		'hero_elements',
		blocksy_get_page_title_source(),
		$default_hero_elements
	);

	// title
	blocksy_output_font_css([
		'font_value' => blocksy_akg_or_customizer(
			'pageTitleFont',
			$page_title_source,
			blocksy_typography_default_values([
				'size' => [
					'desktop' => '32px',
					'tablet'  => '30px',
					'mobile'  => '25px'
				],
				'line-height' => '1.3',
			])
		),
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.entry-header .page-title'
	]);

	blocksy_output_colors([
		'value' => blocksy_akg_or_customizer( 'pageTitleFontColor', $page_title_source ),
		'default' => [
			'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		],
		'css' => $css,
		'variables' => [
			'default' => [
				'selector' => '.entry-header .page-title',
				'variable' => 'headingColor'
			],
		],
	]);


	// meta
	blocksy_output_font_css([
		'font_value' => blocksy_akg_or_customizer(
			'pageMetaFont',
			$page_title_source,
			blocksy_typography_default_values([
				'size' => [
					'desktop' => '12px',
					'tablet'  => '12px',
					'mobile'  => '12px'
				],
				'variation' => 'n6',
				'line-height' => '1.5',
				'text-transform' => 'uppercase',
			])
		),
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.entry-header .entry-meta'
	]);

	blocksy_output_colors([
		'value' => blocksy_akg_or_customizer( 'pageMetaFontColor', $page_title_source ),
		'default' => [
			'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
			'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		],
		'css' => $css,
		'variables' => [
			'default' => [
				'selector' => '.entry-header .entry-meta',
				'variable' => 'color'
			],

			'hover' => [
				'selector' => '.entry-header .entry-meta',
				'variable' => 'linkHoverColor'
			],
		],
	]);

	// excerpt
	blocksy_output_font_css([
		'font_value' => blocksy_akg_or_customizer(
			'pageExcerptFont',
			$page_title_source,
			blocksy_typography_default_values([
				'variation' => 'n5',
			])
		),
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.entry-header .page-description'
	]);

	blocksy_output_colors([
		'value' => blocksy_akg_or_customizer( 'pageExcerptColor', $page_title_source ),
		'default' => [
			'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		],
		'css' => $css,
		'variables' => [
			'default' => [
				'selector' => '.entry-header .page-description',
				'variable' => 'color'
			],
		],
	]);

	// breadcrumbs
	blocksy_output_font_css([
		'font_value' => blocksy_akg_or_customizer(
			'breadcrumbsFont',
			$page_title_source,
			blocksy_typography_default_values([
				'size' => '12px',
				'variation' => 'n6',
				'text-transform' => 'uppercase',
			])
		),
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.entry-header .ct-breadcrumbs'
	]);

	blocksy_output_colors([
		'value' => blocksy_akg_or_customizer( 'breadcrumbsFontColor', $page_title_source ),
		'default' => [
			'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
			'initial' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
			'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		],
		'css' => $css,
		'variables' => [
			'default' => [
				'selector' => '.entry-header .ct-breadcrumbs',
				'variable' => 'color'
			],

			'initial' => [
				'selector' => '.entry-header .ct-breadcrumbs',
				'variable' => 'linkInitialColor'
			],

			'hover' => [
				'selector' => '.entry-header .ct-breadcrumbs',
				'variable' => 'linkHoverColor'
			],
		],
	]);

	if ($type === 'type-1' || is_customize_preview()) {
		blocksy_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => '.hero-section[data-type="type-1"]',
			'variableName' => 'alignment',
			'unit' => '',
			'value' => blocksy_akg_or_customizer('hero_alignment1', $page_title_source, 'left'),
		]);
	}


	if ($type === 'type-2' || is_customize_preview()) {
		blocksy_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => '.hero-section[data-type="type-2"]',
			'variableName' => 'alignment',
			'unit' => '',
			'value' => blocksy_akg_or_customizer('hero_alignment2', $page_title_source, 'center'),
		]);

		// height
		blocksy_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => '.hero-section[data-type="type-2"]',
			'variableName' => 'minHeight',
			'unit' => '',
			'value' => blocksy_akg_or_customizer(
				'hero_height',
				$page_title_source,
				'230px'
			)
		]);

		// overlay color
		blocksy_output_colors([
			'value' => blocksy_akg_or_customizer(
				'pageTitleOverlay',
				$page_title_source
			),
			'default' => ['default' => ['color' => 'rgba(41, 51, 60, 0.2)']],
			'css' => $css,
			'variables' => [
				'default' => [
					'selector' => '.hero-section[data-type="type-2"]',
					'variable' => 'pageTitleOverlay'
				],
			],
		]);

		// background
		blocksy_output_background_css([
			'selector' => '.hero-section[data-type="type-2"]',
			'css' => $css,
			'value' => blocksy_akg_or_customizer(
				'pageTitleBackground',
				$page_title_source,
				blocksy_background_default_value([
					'backgroundColor' => [
						'default' => [
							'color' => '#EDEFF2'
						],
					],
				])
			)
		]);
	}

	$selectors_map = [
		// custom_meta is a bit specially handled
		'author_social_channels' => '.author-box-social',
		'custom_description' => '.page-description',
		'custom_title' => '.page-title,.ct-image-container',
		'breadcrumbs' => '.ct-breadcrumbs',
		'custom_meta' => '.entry-meta'
	];

	$meta_indexes = [
		'first' => null,
		'second' => null
	];

	foreach ($hero_elements as $index => $single_hero_element) {
		if (! isset($single_hero_element['enabled'])) {
			continue;
		}

		if ($single_hero_element['id'] === 'custom_meta') {
			if ($meta_indexes['first'] === null) {
				$meta_indexes['first'] = $index;
			} else {
				$meta_indexes['second'] = $index;
			}
		}
	}

	foreach ($hero_elements as $index => $single_hero_element) {
		if (! $single_hero_element['enabled']) {
			continue;
		}

		if (
			$single_hero_element['id'] === 'custom_meta'
			&&
			$index === $meta_indexes['second']
		) {
			$selectors_map['custom_meta'] = '.entry-meta[data-id="second"]';
		}

		blocksy_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => '.hero-section ' . $selectors_map[$single_hero_element['id']],
			'variableName' => 'itemSpacing',
			'value' => blocksy_akg('hero_item_spacing', $single_hero_element, 20)
		]);
	}
}

