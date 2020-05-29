<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blocksy
 */

$content = blocksy_render_sidebar();

if (is_customize_preview()) {
	blocksy_add_customizer_preview_cache(
		function () {
			return blocksy_html_tag(
				'div',
				['data-id' => 'sidebar'],
				blocksy_render_sidebar(null, true)
			);
		}
	);
}

/**
 * Note to code reviewers: This line doesn't need to be escaped.
 * The value used here escapes the value properly.
 * It's the actual WordPress sidebar content.
 */
echo $content;


