<?php

// Font
blocksy_output_font_css([
	'font_value' => blocksy_akg( 'copyrightFont', $atts,
		blocksy_typography_default_values([
			'size' => '15px',
			'variation' => 'n4',
			'line-height' => '1.3',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-footer-copyright'
]);

// Font color
blocksy_output_colors([
	'value' => blocksy_akg('copyrightColor', $atts),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'link_initial' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'link_hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-footer-copyright',
			'variable' => 'color'
		],

		'link_initial' => [
			'selector' => '.ct-footer-copyright',
			'variable' => 'linkInitialColor'
		],

		'link_hover' => [
			'selector' => '.ct-footer-copyright',
			'variable' => 'linkHoverColor'
		],
	],
]);

// Alignment
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '[data-column="copyright"]',
	'variableName' => 'horizontal-alignment',
	'unit' => '',
	'value' => blocksy_akg('footerCopyrightAlignment', $atts, [
		'desktop' => 'center',
		'tablet' => 'center',
		'mobile' => 'center'
	])
]);

blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '[data-column="copyright"]',
	'variableName' => 'vertical-alignment',
	'unit' => '',
	'value' => blocksy_akg('footerCopyrightVerticalAlignment', $atts, [
		'desktop' => 'flex-start',
		'tablet' => 'flex-start',
		'mobile' => 'flex-start'
	])
]);

blocksy_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-footer-copyright',
	'important' => true,
	'value' => blocksy_default_akg( 'copyrightMargin', $atts,
		blocksy_spacing_value([
			'linked' => true,
		])
	)
]);