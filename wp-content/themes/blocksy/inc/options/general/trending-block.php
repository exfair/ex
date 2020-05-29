<?php
/**
 * Forms options
 *
 * @copyright 2019-present Creative Themes
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Blocksy
 */

$options = [

	'has_trending_block' => [
		'label' => __( 'Trending Block', 'blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => 'no',
		'setting' => [ 'transport' => 'postMessage' ],
		'inner-options' => [

			blocksy_rand_md5() => [
				'title' => __( 'General', 'blocksy' ),
				'type' => 'tab',
				'options' => [

					'trending_block_post_type' => class_exists('WooCommerce') ? [
						'label' => __( 'Post Type', 'blocksy' ),
						'type' => 'ct-select',
						'value' => 'post',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],
						'choices' => blocksy_ordered_keys(
							[
								'post' => __('Posts', 'blocksy'),
								'product' => __('Products', 'blocksy'),
							]
						),

						'selective_refresh' => [
							[
								'id' => 'trending_block_post_type',
								'container_inclusive' => true,
								'selector' => '.ct-trending-block',
								'fallbackRefresh' => false,
								'render_callback' => function () {
									echo blocksy_get_trending_block(true);
								}
							]
						],
					] : [
						'label' => __('Post Type', 'blocksy'),
						'type' => 'hidden',
						'value' => 'post',
						'design' => 'none',
						'setting' => ['transport' => 'postMessage'],
					],

					'trending_block_filter' => [
						'label' => __( 'Trending From', 'blocksy' ),
						'type' => 'ct-select',
						'value' => 'all_time',
						'view' => 'text',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],
						'choices' => blocksy_ordered_keys(
							[
								'all_time' => __( 'All Time', 'blocksy' ),
								'last_24_hours' => __( 'Last 24 Hours', 'blocksy' ),
								'last_7_days' => __( 'Last 7 Days', 'blocksy' ),
								'last_month' => __( 'Last Month', 'blocksy' ),
							]
						),
					],

					blocksy_rand_md5() => [
						'type' => 'ct-divider',
					],

					'trendingBlockContainerSpacing' => [
						'label' => __( 'Container Inner Spacing', 'blocksy' ),
						'type' => 'ct-slider',
						'value' => [
							'mobile' => '30px',
							'tablet' => '30px',
							'desktop' => '30px',
						],
						'units' => blocksy_units_config([
							[
								'unit' => 'px',
								'min' => 0,
								'max' => 100,
							],
						]),
						'responsive' => true,
						'setting' => [ 'transport' => 'postMessage' ],
					],

					blocksy_rand_md5() => [
						'type' => 'ct-divider',
					],

					'trending_block_visibility' => [
						'label' => __( 'Container Visibility', 'blocksy' ),
						'type' => 'ct-visibility',
						'design' => 'block',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'desktop' => true,
							'tablet' => true,
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

			blocksy_rand_md5() => [
				'title' => __( 'Design', 'blocksy' ),
				'type' => 'tab',
				'options' => [

					'trendingBlockFontColor' => [
						'label' => __( 'Font Color', 'blocksy' ),
						'type'  => 'ct-color-picker',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'default' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __( 'Initial', 'blocksy' ),
								'id' => 'default',
								'inherit' => 'var(--color)'
							],

							[
								'title' => __( 'Hover', 'blocksy' ),
								'id' => 'hover',
								'inherit' => 'var(--linkHoverColor)'
							],
						],
					],

					'trending_block_background' => [
						'label' => __( 'Container Background', 'blocksy' ),
						'type' => 'ct-background',
						'design' => 'inline',
						'divider' => 'top',
						'setting' => [ 'transport' => 'postMessage' ],
						'value' => blocksy_background_default_value([
							'backgroundColor' => [
								'default' => [
									'color' => '#e0e3e8',
								],
							],
						])
					],

				],
			],

		],
	],

];
