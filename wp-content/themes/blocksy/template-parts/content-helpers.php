<?php

function blocksy_single_content($check_for_preview = false) {
    $post_options = blocksy_get_post_options();

	$has_share_box = get_theme_mod('has_share_box', 'yes') === 'yes';
	$has_post_tags = get_theme_mod('has_post_tags', 'yes') === 'yes';
	$has_author_box = get_theme_mod('has_author_box', 'no') === 'yes';
	$has_post_nav = get_theme_mod('has_post_nav', 'yes') === 'yes';

	if ($check_for_preview) {
		$has_share_box = true;
		$has_post_tags = true;
		$has_author_box = true;
		$has_post_nav = true;
	}

	if (
		blocksy_default_akg(
			'disable_posts_navigation', $post_options, 'no'
		) === 'yes'
	) {
		$has_post_nav = false;
	}

	if (
		blocksy_default_akg(
			'disable_author_box', $post_options, 'no'
		) === 'yes'
	) {
		$has_author_box = false;
	}

	if (
		blocksy_default_akg(
			'disable_post_tags', $post_options, 'no'
		) === 'yes'
	) {
		$has_post_tags = false;
	}

	if (
		blocksy_default_akg(
			'disable_share_box', $post_options, 'no'
		) === 'yes'
	) {
		$has_share_box = false;
	}

	$featured_image_location = 'none';

	if (get_post_type() === 'post' || blocksy_is_page()) {
		$page_title_source = blocksy_get_page_title_source();
		$featured_image_source = blocksy_get_featured_image_source();

		if ($page_title_source) {
			$actual_type = blocksy_akg_or_customizer(
				'hero_section',
				blocksy_get_page_title_source(),
				'type-1'
			);

			if ($actual_type !== 'type-2') {
				$featured_image_location = blocksy_akg_or_customizer(
					'featured_image_location',
					$featured_image_source,
					'above'
				);
			} else {
				$featured_image_location = 'below';
			}
		} else {
			$featured_image_location = 'above';
		}
	}

	$share_box_type = get_theme_mod('share_box_type', 'type-1');

	if ($check_for_preview) {
		$share_box_type = 'type-1';
		$featured_image_location = 'above';
	}

	$share_box1_location = get_theme_mod(
		'share_box1_location',
		[
			'top' => false,
			'bottom' => true,
		]
	);

	$share_box2_location = get_theme_mod('share_box2_location', 'right');

	if ( $check_for_preview ) {
		$share_box1_location = [
			'top' => true,
			'bottom' => true,
		];
	}

	$content_class = 'entry-content';
	$content_editor = blocksy_get_entry_content_editor();

	if (
		strpos($content_editor, 'classic') === false
		&&
		strpos($content_editor, 'default') === false
	) {
		$content_class = 'ct-builder-content';
	}

	ob_start();

	?>

	<article
		id="post-<?php the_ID(); ?>"
		<?php post_class(); ?>
		<?php echo blocksy_get_entry_content_editor() ?>>

		<?php
			if ($featured_image_location === 'above' || $check_for_preview) {
				echo blocksy_get_featured_image_output($check_for_preview);
			}

			if (!is_singular([ 'product' ])) {
				/**
				 * Note to code reviewers: This line doesn't need to be escaped.
				 * Function blocksy_output_hero_section() used here escapes the value properly.
				 */
				echo blocksy_output_hero_section( 'type-1' );
			}

			if ($featured_image_location === 'below' && !$check_for_preview) {
				echo blocksy_get_featured_image_output();
			}
		?>

		<?php if (
			(
				(
					$share_box_type === 'type-1'
					&&
					$share_box1_location['top']
				) || $share_box_type === 'type-2'
			)
			&&
			$has_share_box
			&&
			get_post_type() === 'post'
		) { ?>
			<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				/**
				 * Note to code reviewers: This line doesn't need to be escaped.
				 * Function blocksy_get_social_share_box() used here escapes the value properly.
				 */
				echo blocksy_get_social_share_box($check_for_preview, [
					'html_atts' => $share_box_type === 'type-1' ? [
						'data-location' => 'top'
					] : [
						'data-location' => $share_box2_location,
					],
					'type' => $share_box_type
				]);
			?>
		<?php } ?>

		<div class="<?php echo $content_class ?>">
			<?php

			if (! is_attachment()) {
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blocksy' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);
			} else {
				?>
					<figure class="entry-attachment wp-block-image">
						<?php
							echo blocksy_image([
								'attachment_id' => get_the_ID(),
								'size' => 'full',
								'tag_name' => 'a',
								'ratio' => 'original',
								'html_atts' => [
									'href' => wp_get_attachment_url(get_the_ID())
								]
							]);
						?>

						<figcaption class="wp-caption-text"><?php the_excerpt(); ?></figcaption>
					</figure>
				<?php
			}

			wp_link_pages(
				[
					'before' => '<div class="page-links"><span class="post-pages-label">' . esc_html__( 'Pages', 'blocksy' ) . '</span>',
					'after'  => '</div>',
				]
			);

			?>
		</div>

		<?php if (
			$has_post_tags
			||
			blocksy_is_page()
		) { ?>
			<?php
				/**
				 * Note to code reviewers: This line doesn't need to be escaped.
				 * Function blocksy_post_meta() used here escapes the value properly.
				 */
				if (blocksy_get_categories_list('', false)) {
					echo blocksy_html_tag(
						'div',
						['class' => 'entry-tags'],
						blocksy_get_categories_list('', false)
					);
				}
			?>
		<?php } ?>

		<?php if (
			$share_box_type === 'type-1'
			&&
			$share_box1_location['bottom']
			&&
			$has_share_box
			&&
			get_post_type() === 'post'
		) { ?>
			<?php
				/**
				 * Note to code reviewers: This line doesn't need to be escaped.
				 * Function blocksy_get_social_share_box() used here escapes the value properly.
				 */
				echo blocksy_get_social_share_box($check_for_preview, [
					'html_atts' => ['data-location' => 'bottom'],
					'type' => 'type-1'
				]);
			?>
		<?php } ?>

		<?php

		if ($has_author_box && get_post_type() === 'post') {
			blocksy_author_box($check_for_preview);
		}

		if ($has_post_nav && get_post_type() === 'post') {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * Function blocksy_post_navigation() used here escapes the value properly.
			 */
			echo blocksy_post_navigation( $check_for_preview );
		}

		if (function_exists('blc_ext_mailchimp_subscribe_form')) {
			if (get_post_type() === 'post') {
				/**
				 * Note to code reviewers: This line doesn't need to be escaped.
				 * Function blc_ext_mailchimp_subscribe_form() used here escapes the value properly.
				 */
				echo blc_ext_mailchimp_subscribe_form();
			}
		}

		blocksy_display_page_elements('contained');

		?>

	</article>

	<?php

	return ob_get_clean();
}

