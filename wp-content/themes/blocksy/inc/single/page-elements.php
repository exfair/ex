<?php

if (! function_exists('blocksy_display_page_elements')) {
function blocksy_display_page_elements($location = null) {
	$has_related_posts = get_theme_mod('has_related_posts', 'yes') === 'yes' && (
		blocksy_default_akg(
			'disable_related_posts',
			blocksy_get_post_options(),
			'no'
		) !== 'yes'
	);

	$comments_source = blocksy_get_comments_source();

	$related_posts_location = get_theme_mod('related_posts_containment', 'separated');
	$comments_location = null;

	if ($comments_source) {
		$comments_location = blocksy_akg_or_customizer(
			'comments_containment',
			$comments_source,
			'separated'
		);
	}

	ob_start();

	if ($has_related_posts) {
		blocksy_related_posts($location);
	}

	$related_posts_output = ob_get_clean();

	ob_start();

	blocksy_related_posts($location, true);

	$related = ob_get_clean();

	if (is_customize_preview()) {
		blocksy_add_customizer_preview_cache(
			function () use ($related) {
				return blocksy_html_tag(
					'div',
					[
						'data-part' => 'related-posts',
					],
					$related
				);
			}
		);
	}

	if (
		(
			get_theme_mod('related_location', 'before') === 'before'
			||
			$comments_location !== $related_posts_location
		) && $has_related_posts && $related_posts_location === $location
	) {
		/**
		 * Note to code reviewers: This line doesn't need to be escaped.
		 * The var $related_posts_output used here escapes the value properly.
		 */
		echo $related_posts_output;
	}


	$forced_comments_source = blocksy_get_comments_source(true);

	$container_class = 'ct-container';

	if (
		blocksy_akg_or_customizer(
			'comments_structure',
			$forced_comments_source,
			'narrow'
		) === 'narrow'
	) {
		$container_class = 'ct-container-narrow';
	}

	ob_start();

	// If comments are open or we have at least one comment, load up the comment template.
	if (comments_open() || get_comments_number()) { ?>

		<?php if ($location === 'separated') { ?>
		<div class="ct-comments-container">
			<div class="<?php echo $container_class ?>">
		<?php } ?>

				<?php comments_template(); ?>

		<?php if ($location === 'separated') { ?>
			</div>
		</div>
		<?php } ?>

	<?php }

	$comments = ob_get_clean();

	ob_start();

	if (is_customize_preview() && (comments_open() || get_comments_number())) { ?>

		<div class="ct-comments-container">
			<div class="<?php echo $container_class ?>">
				<?php comments_template(); ?>
			</div>
		</div>

	<?php }

	$comments_for_preview = ob_get_clean();

	if ($comments_source && $comments_location === $location) {
		/**
		 * Note to code reviewers: This line doesn't need to be escaped.
		 * The val $comments used here escapes the value properly.
		 */
		echo $comments;
	}

	if (
		get_theme_mod('related_location', 'before') === 'after'
		&&
		$comments_location === $related_posts_location
		&&
		$has_related_posts
		&&
		$related_posts_location === $location
	) {
		/**
		 * Note to code reviewers: This line doesn't need to be escaped.
		 * The var $related_posts_output used here escapes the value properly.
		 */
		echo $related_posts_output;
	}

	if (is_customize_preview()) {
		blocksy_add_customizer_preview_cache(
			blocksy_html_tag(
				'div',
				[
					'data-part' => 'comments',
				],
				$comments_for_preview
			)
		);
	}
}
}
