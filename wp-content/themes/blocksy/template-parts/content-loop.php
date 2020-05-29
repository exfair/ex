<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blocksy
 */

$listing_source = blocksy_get_posts_listing_source();

$blog_post_structure = blocksy_akg_or_customizer(
	'structure',
	$listing_source,
	'grid'
);

$archive_order = blocksy_akg_or_customizer(
	'archive_order',
	$listing_source,
	[
		[
			'id' => 'post_meta',
			'enabled' => true,
			'meta_elements' => blocksy_post_meta_defaults([
				[
					'id' => 'categories',
					'enabled' => true,
				],
			]),
		],

		[
			'id' => 'title',
			'enabled' => true,
		],

		[
			'id' => 'featured_image',
			'enabled' => true,
		],

		[
			'id' => 'excerpt',
			'enabled' => true,
		],

		[
			'id' => 'read_more',
			'enabled' => false,
		],

		[
			'id' => 'post_meta',
			'enabled' => true,
			'meta_elements' => blocksy_post_meta_defaults([
				[
					'id' => 'author',
					'enabled' => true,
				],

				[
					'id' => 'post_date',
					'enabled' => true,
				],

				[
					'id' => 'comments',
					'enabled' => true,
				],
			]),
		],
	]
);

$featured_image_settings = null;
$excerpt_settings = null;
$title_settings = null;
$read_more_settings = null;

$last_enabled_component = null;

if (! $archive_order) {
	$archive_order = [];
}

foreach (array_reverse($archive_order) as $index => $value) {
	if ($value['enabled'] && ! $last_enabled_component) {
		if (! isset($value['__id'])) {
			$id = blocksy_rand_md5();

			$archive_order[ count( $archive_order ) - 1 - $index ]['__id'] = $id;
			$value['__id'] = $id;
		}

		$last_enabled_component = $value['id'] . $value['__id'];
	}

	if ($value['id'] === 'featured_image') {
		$featured_image_settings = $value;
	}

	if ( $value['id'] === 'read_more' ) {
		$read_more_settings = $value;
	}

	if ( $value['id'] === 'excerpt' ) {
		$excerpt_settings = $value;
	}

	if ( $value['id'] === 'post_meta' ) {
		$post_meta_settings = $value;
	}

	if ( $value['id'] === 'title' ) {
		$title_settings = $value;
	}
}

if ($blog_post_structure === 'simple') {
	foreach ($archive_order as $index => $value) {
		if ($value['id'] === 'featured_image') {
			unset($archive_order[$index]);
		}
	}

	array_unshift($archive_order, $featured_image_settings);
}

$is_boundles = blocksy_default_akg('is_boundless', $featured_image_settings, 'yes');
$featured_image_size = blocksy_default_akg('image_size', $featured_image_settings, 'medium_large');

$featured_image_args = [
	'attachment_id' => get_post_thumbnail_id(),
	'ratio' => blocksy_default_akg('thumb_ratio', $featured_image_settings, '4/3'),
	'tag_name' => 'a',
	'size' => $featured_image_size,
	'html_atts' => [
		'href' => esc_url(get_permalink()),
	],
];

if (
	$is_boundles === 'yes'
	&&
	blocksy_akg_or_customizer('card_type', $listing_source, 'boxed') === 'boxed'
	&&
	$blog_post_structure !== 'gutenberg'
) {
	$featured_image_args['class'] = 'boundless-image';
}

$read_more_text = blocksy_translate_dynamic(blocksy_default_akg(
	'read_more_text',
	$read_more_settings,
	__('Read More', 'blocksy')
), $listing_source['prefix'] . '_archive_read_more_text');

$read_more_arrow = '<svg width="17px" height="17px" viewBox="0 0 32 32"><path d="M 21.1875 9.28125 L 19.78125 10.71875 L 24.0625 15 L 4 15 L 4 17 L 24.0625 17 L 19.78125 21.28125 L 21.1875 22.71875 L 27.90625 16 Z "></path></svg>';

if (blocksy_default_akg( 'read_more_arrow', $read_more_settings, 'no' ) === 'yes') {
	$read_more_text .= $read_more_arrow;
}

$button_type = blocksy_default_akg(
	'button_type',
	$read_more_settings,
	'background'
);

$outputs = [
	'title' => blocksy_entry_title( blocksy_default_akg( 'heading_tag', $title_settings, 'h2' ) ),
	'featured_image' => wp_get_attachment_url(
		$featured_image_args['attachment_id']
	) ? blocksy_image($featured_image_args) : '',
	'excerpt' => blocksy_entry_excerpt(
		intval(
			blocksy_default_akg( 'excerpt_length', $excerpt_settings, '40' )
		)
	),

	'read_more' => blocksy_html_tag(
		'a',
		[
            'class' => 'entry-button' . (
				$button_type === 'background' ? ' ct-button' : ''
			),
			'data-type' => $button_type,
			'data-alignment' => blocksy_default_akg( 'read_more_alignment', $read_more_settings, 'left' ),
			'href' => esc_url( get_permalink() )
		],
		$read_more_text
	)
];

$data_reveal_output = '';

if (
	blocksy_akg_or_customizer(
		'has_posts_reveal',
		blocksy_get_pagination_source(),
		'no'
	) === 'yes'
) {
	$data_reveal_output = 'data-reveal="bottom:no"';
}

?>

<article
	id="post-<?php the_ID(); ?>" <?php post_class( 'entry-card' ); ?>
	<?php echo wp_kses_post($data_reveal_output) ?>>

	<?php
		$had_a_meta = false;

		foreach ($archive_order as $single_component) {
			if ( ! $single_component['enabled'] ) {
				if (
					$blog_post_structure === 'simple'
					&&
					$single_component['id'] === 'featured_image'
				) {
					echo '<div class="card-content">';
				}

				continue;
			}

			$post_meta_default = null;

			if ('post_meta' === $single_component['id']) {
				$total_metas = [];

				foreach ($archive_order as $nested_single_component) {
					if ($nested_single_component['id'] === 'post_meta') {
						$total_metas[] = $nested_single_component;
					}
				}

				if (count($total_metas) > 1 && !$had_a_meta) {
					$post_meta_default = blocksy_post_meta_defaults([
						[
							'id' => 'categories',
							'enabled' => true,
						],
					]);
				} else {
					$post_meta_default = blocksy_post_meta_defaults([
						[
							'id' => 'author',
							'enabled' => true,
						],

						[
							'id' => 'post_date',
							'enabled' => true,
						],

						[
							'id' => 'comments',
							'enabled' => true,
						],
					]);
				}

				$had_a_meta = true;
			}

			$output = 'post_meta' === $single_component['id'] ? blocksy_post_meta(
				blocksy_akg(
					'meta_elements',
					$single_component,
					$post_meta_default
				),
				[
					'meta_type' => blocksy_akg('meta_type', $single_component, 'simple'),
					'meta_divider' => blocksy_akg('meta_divider', $single_component, 'slash')
				]
			) : $outputs[ $single_component['id'] ];

			if ( ! isset( $single_component['__id'] ) ) {
				$single_component['__id'] = '';
			}

			if (
				$last_enabled_component === $single_component['id'] . $single_component['__id'] && (
					strpos($last_enabled_component, 'post_meta') !== false
					||
					strpos($last_enabled_component, 'featured_image') !== false
				)
			) {
				echo '<div class="ct-ghost"></div>';
			}


			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * Variabile $output used here escapes the value properly.
			 */
			echo $output;

			if (
				$blog_post_structure === 'simple'
				&&
				$single_component['id'] === 'featured_image'
			) {
				echo '<div class="card-content">';
			}

			if (
				$blog_post_structure === 'simple'
				&&
				$last_enabled_component === $single_component[
					'id'
				] . $single_component['__id']
			) {
				echo '</div>';
			}
		}

		$id = get_the_ID();
		$excerpt = blocksy_entry_excerpt('original');

		if (is_customize_preview()) {
			blocksy_add_customizer_preview_cache(
				blocksy_html_tag(
					'div',
					[ 'data-id' => 'post-' . $id ],
					array_reduce(
						$archive_order,
						function ( $carry, $single_component ) use ( $outputs, $excerpt, $read_more_arrow, $read_more_settings) {
							$output = null;

							if ( isset( $outputs[ $single_component['id'] ] ) ) {
								$output = $outputs[ $single_component['id'] ];
							}

							if ( 'post_meta' === $single_component['id'] ) {
								$output = blocksy_post_meta(
									blocksy_post_meta_defaults([
										[
											'id' => 'author',
											'enabled' => true,
											'has_author_avatar' => 'yes',
										],

										[
											'id' => 'post_date',
											'enabled' => true,
										],

										[
											'id' => 'updated_date',
											'enabled' => true,
										],

										[
											'id' => 'categories',
											'enabled' => true,
										],

										[
											'id' => 'comments',
											'enabled' => true,
										],

										[
											'id' => 'tags',
											'enabled' => true,
										]
									]),
									[
										'meta_type' => 'label',
										'meta_divider' => 'none',
										'force_icons' => true
									]
								);
							}

							if ('excerpt' === $single_component['id']) {
								$output = $excerpt;
							}

							if ('read_more' === $single_component['id']) {
								$output = blocksy_html_tag(
									'a',
									[
										'class' => 'entry-button',
										'data-type' => blocksy_default_akg( 'button_type', $read_more_settings, 'background' ),
										'data-alignment' => blocksy_default_akg( 'read_more_alignment', $read_more_settings, 'left' ),
										'href' => esc_url( get_permalink() )
									],
									(
										blocksy_default_akg(
											'read_more_text',
											$read_more_settings,
											__('Read More', 'blocksy')
										) . $read_more_arrow
									)
								);
							}

							return $carry . blocksy_html_tag(
								'div',
								[
									'data-component' => $single_component['id'],
								],
								$output
							);
						},
						''
					)
				)
			);
		}

		?>

</article>
