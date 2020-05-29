<?php

// Icon color
blocksy_output_colors([
	'value' => blocksy_akg('triggerIconColor', $atts),
	'default' => [
		'default' => [ 'color' => 'var(--color)' ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-header-trigger',
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => '.ct-header-trigger',
			'variable' => 'linkHoverColor'
		],
	],
]);

blocksy_output_colors([
	'value' => blocksy_akg('triggerSecondColor', $atts),
	'default' => [
		'default' => [ 'color' => '#eeeeee' ],
		'hover' => [ 'color' => '#eeeeee' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-header-trigger',
			'variable' => 'secondColor'
		],

		'hover' => [
			'selector' => '.ct-header-trigger',
			'variable' => 'secondColorHover'
		],
	],
]);

// Margin
blocksy_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-header-trigger',
    'important' => true,
	'value' => blocksy_default_akg( 'triggerMargin', $atts,
		blocksy_spacing_value([
			'linked' => true,
		])
	)
]);