<?php

$comments_source = blocksy_get_comments_source(is_customize_preview());

if (! $comments_source) {
	return;
}

$commentsNarrowWidth = blocksy_akg_or_customizer(
	'commentsNarrowWidth',
	$comments_source,
	750
);

$css->put(
	'.ct-comments-container',
	'--narrowContainer: ' . $commentsNarrowWidth . 'px'
);

blocksy_output_colors([
	'value' => blocksy_akg_or_customizer(
		'commentsFontColor',
		$comments_source,
		[
			'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
			'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		]
	),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-comments',
			'variable' => 'color'
		],

		'hover' => [
			'selector' => '.ct-comments',
			'variable' => 'linkHoverColor'
		],
	],
]);

blocksy_output_background_css([
	'selector' => '.ct-comments-container',
	'css' => $css,
	'value' => blocksy_akg_or_customizer(
		'comments_background',
		$comments_source,
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => 'rgba(255, 255, 255, 0)'
				],
			],
		])
	)
]);
