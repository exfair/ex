<?php

class Blocksy_Header_Builder_Elements {
	public function render_offcanvas($args = []) {
		$args = wp_parse_args($args, [
			'has_container' => true,
			'device' => 'mobile'
		]);

		$render = new Blocksy_Header_Builder_Render();

		if (! $render->contains_item('trigger')) {
			return '';
		}

		$content = '';

		$current_layout = $render->get_current_section()[$args['device']];

		foreach ($current_layout as $row) {
			if ($row['id'] !== 'offcanvas') {
				continue;
			}

			if ($render->is_row_empty($row)) {
				// return '';
			}

			$content .= $render->render_items_collection(
				$row['placements'][0]['items']
			);
		}

		$atts = $render->get_item_data_for('offcanvas');
		$row_config = $render->get_item_config_for('offcanvas');

		$class = 'ct-panel';
		$behavior = 'modal';

		$position_output = [];

		if (blocksy_default_akg('offcanvas_behavior', $atts, 'panel') !== 'modal') {
			$behavior = blocksy_default_akg(
				'side_panel_position', $atts, 'right'
			) . '-side';
		}

		$without_container = blocksy_html_tag(
			'div',
			array_merge([
				'class' => 'content-container',
			], (
				is_customize_preview() ? [
					'data-item-label' => $row_config['config']['name'],
					'data-location' => $render->get_customizer_location_for('offcanvas')
				] : []
			)),
			blocksy_html_tag(
				'section',
				[
					'data-align' => blocksy_default_akg(
						'offcanvasContentAlignment',
						$atts,
						'left'
					)
				],
				$content
			)
		);

		if (! $args['has_container']) {
			return $without_container;
		}

		return blocksy_html_tag(
			'div',
			array_merge(
				[
					'id' => 'offcanvas',
					'class' => $class,
					'data-behaviour' => $behavior,
					'data-device' => $args['device']
				],
				$position_output
			),

			'<div class="close-button">
				<span class="ct-trigger closed">
					<span></span>
				</span>
			</div>' .  $without_container
		);
	}

	public function render_search_modal() {
		$render = new Blocksy_Header_Builder_Render();

		if (! $render->contains_item('search')) {
			return;
		}

		$atts = $render->get_item_data_for('search');

		$search_through = blocksy_akg('search_through', $atts, [
			'post' => true,
			'page' => true,
			'product' => true
		]);

		foreach (blocksy_manager()->post_types->get_supported_post_types() as $single_cpt) {
			if (! isset($search_through[$single_cpt])) {
				$search_through[$single_cpt] = true;
			}
		}

		$post_type = [];

		foreach ($search_through as $single_post_type => $enabled) {
			if (! $enabled) {
				continue;
			}

			$post_type[] = $single_post_type;
		}

		?>

		<div id="search-modal" class="ct-panel" data-behaviour="modal">
			<div class="close-button">
				<span class="ct-trigger closed">
					<span></span>
				</span>
			</div>

			<div class="content-container" data-align="middle">
				<?php get_search_form([
					'enable_search_field_class' => true,
					'ct_post_type' => $post_type
				]); ?>
			</div>
		</div>

		<?php
	}
}

