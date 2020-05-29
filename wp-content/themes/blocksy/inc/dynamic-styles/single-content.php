<?php

$global_selector = $prefix;

if ($prefix !== 'page' && $prefix !== 'bbpress') {
	$global_selector = 'single-' . $prefix;
}

blocksy_output_background_css([
	'selector' => 'body.' . $global_selector,
	'css' => $css,
	'value' => get_theme_mod(
		$prefix . '_background',
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => Blocksy_Css_Injector::get_skip_rule_keyword()
				],
			],
		])
	)
]);

blocksy_output_background_css([
	'selector' => '.' . $prefix . '[data-structure*="boxed"]',
	'css' => $css,
	'value' => get_theme_mod(
		$prefix . '_content_background',
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => '#ffffff'
				],
			],
		])
	)
]);

blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.' . $prefix . '[data-structure*="boxed"]',
	'variableName' => 'contentBoxedSpacing',
	'value' => get_theme_mod($prefix . 'ContentBoxedSpacing', [
		'mobile' => '20px',
		'tablet' => '35px',
		'desktop' => '40px',
	]),
	'unit' => ''
]);

blocksy_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.' . $prefix . '[data-structure*="boxed"]',
	'property' => 'borderRadius',
	'value' => get_theme_mod( $prefix . 'ContentBoxedRadius',
		blocksy_spacing_value([
			'linked' => true,
		])
	)
]);

blocksy_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.' . $prefix . '[data-structure*="boxed"]',
	'value' => get_theme_mod($prefix . 'ContentBoxedShadow', blocksy_box_shadow_value([
		'enable' => false,
		'h_offset' => 0,
		'v_offset' => 12,
		'blur' => 18,
		'spread' => -6,
		'inset' => false,
		'color' => [
			'color' => 'rgba(34, 56, 101, 0.04)',
		],
	])),
	'responsive' => true
]);
