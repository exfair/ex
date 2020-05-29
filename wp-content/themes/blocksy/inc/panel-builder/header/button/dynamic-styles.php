<?php

// Font color
blocksy_output_colors([
	'value' => blocksy_akg('headerButtonFontColor', $atts),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],

		'default_2' => [ 'color' => 'var(--buttonInitialColor)' ],
		'hover_2' => [ 'color' => '#ffffff' ],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '.ct-header-cta .ct-button',
			'variable' => 'buttonTextInitialColor'
		],

		'hover' => [
			'selector' => '.ct-header-cta .ct-button',
			'variable' => 'buttonTextHoverColor'
		],


		'default_2' => [
			'selector' => '.ct-header-cta .ct-button-ghost',
			'variable' => 'buttonTextInitialColor'
		],

		'hover_2' => [
			'selector' => '.ct-header-cta .ct-button-ghost',
			'variable' => 'buttonTextHoverColor'
		],
	],
	'responsive' => true
]);

// Background color
blocksy_output_colors([
	'value' => blocksy_akg('headerButtonForeground', $atts),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '.ct-header-cta',
			'variable' => 'buttonInitialColor'
		],

		'hover' => [
			'selector' => '.ct-header-cta',
			'variable' => 'buttonHoverColor'
		],
	],
	'responsive' => true
]);

// Margin
blocksy_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-header-cta',
    'important' => true,
	'value' => blocksy_default_akg( 'headerCtaMargin', $atts,
		blocksy_spacing_value([
			'linked' => true,
		])
	)
]);

// Border radius
blocksy_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-header-cta',
	'property' => 'buttonBorderRadius',
	'value' => blocksy_default_akg( 'headerCtaRadius', $atts,
		blocksy_spacing_value([
			'linked' => true,
		])
	)
]);
