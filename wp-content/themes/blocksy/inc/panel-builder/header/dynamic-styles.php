<?php

$absoluteHeaderBackground = blocksy_akg(
	'absoluteHeaderBackground',
	$atts,
	blocksy_background_default_value([
		'backgroundColor' => [
			'default' => [
				'color' => 'rgba(255, 255, 255, 0)'
			],
		],
	])
);

$headerBackground = blocksy_akg(
	'headerBackground',
	$atts,
	blocksy_background_default_value([
		'backgroundColor' => [
			'default' => [
				'color' => '#ffffff'
			],
		],
	])
);

blocksy_output_background_css([
	'selector' => '[data-behavior]',
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'responsive' => true,
	'value' => blocksy_akg(
		'is_absolute',
		$atts,
		'no'
	) === 'no' ? $headerBackground : $absoluteHeaderBackground
]);

if (blocksy_akg('is_absolute', $atts, 'no') === 'yes') {
	blocksy_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => ':root',
		'variableName' => 'headerHeight',
		'value' => $header_height
	]);
}

