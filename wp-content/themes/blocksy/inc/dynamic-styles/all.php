<?php
// Color palette
blocksy_output_colors([
	'value' => get_theme_mod('colorPalette'),
	'default' => [
		'color1' => [ 'color' => '#3eaf7c' ],
		'color2' => [ 'color' => '#33a370' ],
		'color3' => [ 'color' => 'rgba(44, 62, 80, 0.9)' ],
		'color4' => [ 'color' => 'rgba(44, 62, 80, 1)' ],
		'color5' => [ 'color' => '#ffffff' ],
	],
	'css' => $css,
	'variables' => [
		'color1' => ['variable' => 'paletteColor1'],
		'color2' => ['variable' => 'paletteColor2'],
		'color3' => ['variable' => 'paletteColor3'],
		'color4' => ['variable' => 'paletteColor4'],
		'color5' => ['variable' => 'paletteColor5'],
	],
]);

// Colors
blocksy_output_colors([
	'value' => get_theme_mod('fontColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'color'],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('linkColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor1)' ],
		'hover' => [ 'color' => 'var(--paletteColor2)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'linkInitialColor'],
		'hover' => ['variable' => 'linkHoverColor'],
	],
]);


// Heading
blocksy_output_colors([
	'value' => get_theme_mod('headingColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor4)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => ':root',
			'variable' => 'headingColor'
		],
	],
]);

// Content spacing
$contentSpacingMap = [
	'compact' => '0.8em',
	'comfortable' => '1.5em',
	'spacious' => '2em',
];

$contentSpacing = get_theme_mod('contentSpacing', 'comfortable');

$contentSpacing = isset(
	$contentSpacingMap[$contentSpacing]
) ? $contentSpacingMap[$contentSpacing] : $contentSpacingMap['comfortable'];

$css->put(':root', '--contentSpacing: ' . $contentSpacing);

// Buttons
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => ':root',
	'variableName' => 'buttonMinHeight',
	'value' => get_theme_mod('buttonMinHeight', [
		'mobile' => 45,
		'tablet' => 45,
		'desktop' => 45,
	])
]);

if (get_theme_mod('buttonHoverEffect', 'yes') !== 'yes') {
	$css->put(':root', '--buttonShadow: none');
	$css->put(':root', '--buttonTransform: none');
}

blocksy_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => ':root',
	'property' => 'buttonBorderRadius',
	'value' => get_theme_mod( 'buttonRadius',
		blocksy_spacing_value([
			'linked' => true,
			'top' => '3px',
			'left' => '3px',
			'right' => '3px',
			'bottom' => '3px',
		])
	)
]);

blocksy_output_colors([
	'value' => get_theme_mod('buttonTextColor'),
	'default' => [
		'default' => [ 'color' => '#ffffff' ],
		'hover' => [ 'color' => '#ffffff' ],
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'buttonTextInitialColor'],
		'hover' => ['variable' => 'buttonTextHoverColor'],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('buttonColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor1)' ],
		'hover' => [ 'color' => 'var(--paletteColor2)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'buttonInitialColor'],
		'hover' => ['variable' => 'buttonHoverColor'],
	],
]);

// Layout
$max_site_width = get_theme_mod( 'maxSiteWidth', 1290 );
$css->put(
	':root',
	'--maxSiteWidth: ' . $max_site_width . 'px'
);

blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.content-area',
	'variableName' => 'contentAreaSpacing',
	'unit' => '',
	'value' => get_theme_mod('contentAreaSpacing', [
		'mobile' => '50px',
		'tablet' => '60px',
		'desktop' => '80px',
	])
]);

$narrowContainerWidth = get_theme_mod( 'narrowContainerWidth', 750 );
$css->put(
	':root',
	'--narrowContainer: ' . $narrowContainerWidth . 'px'
);


$wideOffset = get_theme_mod( 'wideOffset', 130 );
$css->put(
	':root',
	'--wideOffset: ' . $wideOffset . 'px'
);


// Sidebar
$sidebar_width = get_theme_mod( 'sidebarWidth', '27' );
$css->put( '[data-sidebar]', '--sidebarWidth: ' . $sidebar_width . '%' );
$css->put( '[data-sidebar]', '--sidebarWidthNoUnit: ' . intval($sidebar_width) );


$sidebarGap = blocksy_get_with_percentage( 'sidebarGap', '4%' );
$css->put( '[data-sidebar]', '--sidebarGap: ' . $sidebarGap );

$sidebarOffset = get_theme_mod( 'sidebarOffset', '50' );
$css->put( '[data-sidebar]', '--sidebarOffset: ' . $sidebarOffset . 'px' );


blocksy_output_colors([
	'value' => get_theme_mod('sidebarWidgetsTitleColor'),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-sidebar .widget-title',
			'variable' => 'headingColor'
		],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('sidebarWidgetsFontColor'),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'link_initial' => [ 'color' => 'var(--color)' ],
		'link_hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-sidebar > *',
			'variable' => 'color'
		],

		'link_initial' => [
			'selector' => '.ct-sidebar',
			'variable' => 'linkInitialColor'
		],

		'link_hover' => [
			'selector' => '.ct-sidebar',
			'variable' => 'linkHoverColor'
		],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('sidebarBackgroundColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor5)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '[data-sidebar] > aside',
			'variable' => 'sidebarBackgroundColor'
		],
	],
]);

// Sidebar border
blocksy_output_border([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => 'aside[data-type="type-2"]',
	'variableName' => 'border',
	'value' => get_theme_mod('sidebarBorder', [
		'width' => 1,
		'style' => 'none',
		'color' => [
			'color' => 'rgba(224, 229, 235, 0.8)',
		],
	]),
	'responsive' => true
]);


blocksy_output_border([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => 'aside[data-type="type-3"]',
	'variableName' => 'border',
	'value' => get_theme_mod('sidebarDivider', [
		'width' => 1,
		'style' => 'solid',
		'color' => [
			'color' => 'rgba(224, 229, 235, 0.8)',
		],
	]),
	'responsive' => true
]);

blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-sidebar',
	'variableName' => 'sidebarWidgetsSpacing',
	'value' => get_theme_mod('sidebarWidgetsSpacing', [
		'mobile' => 30,
		'tablet' => 40,
		'desktop' => 60,
	])
]);

blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => "[data-sidebar] > aside",
	'variableName' => 'sidebarInnerSpacing',
	'value' => get_theme_mod('sidebarInnerSpacing', [
		'mobile' => 35,
		'tablet' => 35,
		'desktop' => 35,
	])
]);

blocksy_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => 'aside[data-type="type-2"]',
	'property' => 'borderRadius',
	'value' => get_theme_mod( 'sidebarRadius',
		blocksy_spacing_value([
			'linked' => true,
		])
	)
]);

// Sidebar shadow
blocksy_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => 'aside[data-type="type-2"]',
	'value' => get_theme_mod('sidebarShadow', blocksy_box_shadow_value([
		'enable' => true,
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

// Footer trending posts
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => ".ct-trending-block",
	'variableName' => 'padding',
	'value' => get_theme_mod('trendingBlockContainerSpacing', [
		'mobile' => '30px',
		'tablet' => '30px',
		'desktop' => '30px',
	]),
	'unit' => ''
]);

blocksy_output_colors([
	'value' => get_theme_mod('trendingBlockFontColor'),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-trending-block',
			'variable' => 'color'
		],

		'hover' => [
			'selector' => '.ct-trending-block',
			'variable' => 'linkHoverColor'
		],
	],
]);

// Related Posts
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => ".ct-related-posts-container",
	'variableName' => 'padding',
	'value' => get_theme_mod('relatedPostsContainerSpacing', [
		'mobile' => '30px',
		'tablet' => '50px',
		'desktop' => '70px',
	]),
	'unit' => ''
]);

blocksy_output_colors([
	'value' => get_theme_mod('relatedPostsLabelColor'),
	'default' => [
		'default' => ['color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-related-posts .ct-block-title',
			'variable' => 'headingColor'
		],
	],
]);

if (function_exists('blocksy_output_responsive_switch')) {
	blocksy_output_responsive_switch([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.ct-related-posts-container',
		'value' => get_theme_mod(
			'related_visibility',
			[
				'desktop' => true,
				'tablet' => false,
				'mobile' => false,
			]
		),
		'on' => 'block'
	]);
}

if (function_exists('blocksy_output_responsive_switch')) {
	blocksy_output_responsive_switch([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.ct-related-posts',
		'value' => get_theme_mod(
			'related_visibility',
			[
				'desktop' => true,
				'tablet' => false,
				'mobile' => false,
			]
		),
		'on' => 'grid'
	]);
}

blocksy_output_colors([
	'value' => get_theme_mod('relatedPostsLinkColor'),
	'default' => [
		'default' => [ 'color' => 'var(--color)' ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.related-entry-title',
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => '.related-entry-title',
			'variable' => 'linkHoverColor'
		],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('relatedPostsMetaColor'),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-related-posts .entry-meta',
			'variable' => 'color'
		],

		'hover' => [
			'selector' => '.ct-related-posts .entry-meta',
			'variable' => 'linkHoverColor'
		],
	],
]);

blocksy_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-related-posts .ct-image-container',
	'property' => 'borderRadius',
	'value' => get_theme_mod( 'relatedThumbRadius',
		blocksy_spacing_value([
			'linked' => true,
			'top' => '5px',
			'left' => '5px',
			'right' => '5px',
			'bottom' => '5px',
		])
	)
]);

$relatedNarrowWidth = get_theme_mod( 'relatedNarrowWidth', 750 );
$css->put(
	'.ct-related-posts-container',
	'--narrowContainer: ' . $relatedNarrowWidth . 'px'
);

// Posts Navigation
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.post-navigation',
	'variableName' => 'margin',
	'value' => get_theme_mod('postNavSpacing', [
		'mobile' => '40px',
		'tablet' => '60px',
		'desktop' => '80px',
	]),
	'unit' => ''
]);

blocksy_output_colors([
	'value' => get_theme_mod('postsNavFontColor'),
	'default' => [
		'default' => [ 'color' => 'var(--color)' ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.post-navigation',
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => '.post-navigation',
			'variable' => 'linkHoverColor'
		],
	],
]);

// Share Box
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-share-box[data-location="top"]',
	'variableName' => 'margin',
	'value' => get_theme_mod('topShareBoxSpacing', [
		'mobile' => '30px',
		'tablet' => '50px',
		'desktop' => '70px',
	]),
	'unit' => ''
]);

blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-share-box[data-location="bottom"]',
	'variableName' => 'margin',
	'value' => get_theme_mod('bottomShareBoxSpacing', [
		'mobile' => '30px',
		'tablet' => '50px',
		'desktop' => '70px',
	]),
	'unit' => ''
]);

blocksy_output_colors([
	'value' => get_theme_mod('shareItemsIconColor'),
	'default' => [
		'default' => [ 'color' => 'var(--color)' ],
		'hover' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-share-box[data-type="type-1"]',
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => '.ct-share-box[data-type="type-1"]',
			'variable' => 'linkHoverColor'
		],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('shareItemsBorder'),
	'default' => [
		'default' => [ 'color' => '#e0e5eb' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-share-box[data-type="type-1"]',
			'variable' => 'borderColor'
		],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('shareItemsIcon'),
	'default' => [
		'default' => [ 'color' => '#ffffff' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-share-box[data-type="type-2"]',
			'variable' => 'color'
		],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('shareItemsBackground'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor1)' ],
		'hover' => [ 'color' => 'var(--paletteColor2)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-share-box[data-type="type-2"]',
			'variable' => 'backgroundColor'
		],

		'hover' => [
			'selector' => '.ct-share-box[data-type="type-2"]',
			'variable' => 'backgroundColorHover'
		]
	],
]);


// Author Box
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.author-box',
	'variableName' => 'spacing',
	'value' => get_theme_mod('singleAuthorBoxSpacing', [
		'mobile' => '40px',
		'tablet' => '40px',
		'desktop' => '40px',
	]),
	'unit' => ''
]);

blocksy_output_colors([
	'value' => get_theme_mod('singleAuthorBoxBackground'),
	'default' => [
		'default' => [ 'color' => '#ffffff' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.author-box[data-type="type-1"]',
			'variable' => 'backgroundColor'
		],
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('singleAuthorBoxBorder'),
	'default' => [
		'default' => [ 'color' => '#e8ebf0' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.author-box[data-type="type-2"]',
			'variable' => 'borderColor'
		],
	],
]);

blocksy_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.author-box[data-type="type-1"]',
	'value' => get_theme_mod('singleAuthorBoxShadow', blocksy_box_shadow_value([
		'enable' => true,
		'h_offset' => 0,
		'v_offset' => 50,
		'blur' => 90,
		'spread' => 0,
		'inset' => false,
		'color' => [
			'color' => 'rgba(210, 213, 218, 0.4)',
		],
	])),
	'responsive' => true
]);


// To top button
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-back-to-top',
	'variableName' => 'size',
	'value' => get_theme_mod('topButtonSize', 12)
]);

blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-back-to-top',
	'variableName' => 'bottom',
	'value' => get_theme_mod('topButtonOffset', 25)
]);

blocksy_output_colors([
	'value' => get_theme_mod('topButtonIconColor'),
	'default' => [
		'default' => [ 'color' => '#ffffff' ],
		'hover' => [ 'color' => '#ffffff' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-back-to-top',
			'variable' => 'color'
		],

		'hover' => [
			'selector' => '.ct-back-to-top',
			'variable' => 'colorHover'
		]
	],
]);

blocksy_output_colors([
	'value' => get_theme_mod('topButtonShapeBackground'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor3)' ],
		'hover' => [ 'color' => 'var(--paletteColor4)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-back-to-top',
			'variable' => 'backgroundColor'
		],

		'hover' => [
			'selector' => '.ct-back-to-top',
			'variable' => 'backgroundColorHover'
		]
	],
]);

blocksy_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-back-to-top',
	'value' => get_theme_mod('topButtonShadow', blocksy_box_shadow_value([
		'enable' => false,
		'h_offset' => 0,
		'v_offset' => 5,
		'blur' => 20,
		'spread' => 0,
		'inset' => false,
		'color' => [
			'color' => 'rgba(210, 213, 218, 0.2)',
		],
	])),
	'responsive' => true
]);

// Passepartout
blocksy_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.ct-passepartout',
	'variableName' => 'passepartoutSize',
	'value' => get_theme_mod('passepartoutSize', [
		'mobile' => 0,
		'tablet' => 10,
		'desktop' => 10,
	])
]);

blocksy_output_colors([
	'value' => get_theme_mod('passepartoutColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor1)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.ct-passepartout',
			'variable' => 'passepartoutColor'
		],
	],
]);


$supported_post_types = blocksy_manager()->post_types->get_supported_post_types();
$supported_post_types[] = 'post';
$supported_post_types[] = 'page';

if (class_exists('bbPress')) {
	$supported_post_types[] = 'bbpress';
}

foreach ($supported_post_types as $post_type) {
	blocksy_theme_get_dynamic_styles([
		'name' => 'single-content',
		'css' => $css,
		'mobile_css' => $mobile_css,
		'tablet_css' => $tablet_css,
		'context' => $context,
		'chunk' => 'global',
		'prefix' => $post_type,
	]);
}

