<?php

class Blocksy_Header_Builder_Render {
	public function get_section_value() {
		return blocksy_manager()->header_builder->get_section_value();
	}

	public function get_current_section_id() {
		return blocksy_manager()->header_builder->get_current_section_id();
	}

	public function get_current_section() {
		return blocksy_manager()->header_builder->get_current_section();
	}

	public function get_header_height() {
		$top_row = $this->get_item_data_for('top-row');
		$middle_row = $this->get_item_data_for('middle-row');
		$bottom_row = $this->get_item_data_for('bottom-row');

		$top_row_height = blocksy_akg('headerRowHeight', $top_row, [
			'mobile' => 50,
			'tablet' => 50,
			'desktop' => 50,
		]);

		$is_row_empty_mobile = $this->is_row_empty('top-row', 'mobile');
		$is_row_empty_desktop = $this->is_row_empty('top-row', 'desktop');

		if ($is_row_empty_mobile) {
			$top_row_height['mobile'] = 0;
			$top_row_height['tablet'] = 0;
		}

		if ($is_row_empty_desktop) {
			$top_row_height['desktop'] = 0;
		}

		$middle_row_height = blocksy_akg('headerRowHeight', $middle_row, [
			'mobile' => 70,
			'tablet' => 70,
			'desktop' => 120,
		]);

		$is_row_empty_mobile = $this->is_row_empty('middle-row', 'mobile');
		$is_row_empty_desktop = $this->is_row_empty('middle-row', 'desktop');

		if ($is_row_empty_mobile) {
			$middle_row_height['mobile'] = 0;
			$middle_row_height['tablet'] = 0;
		}

		if ($is_row_empty_desktop) {
			$middle_row_height['desktop'] = 0;
		}

		$bottom_row_height = blocksy_akg('headerRowHeight', $bottom_row, [
			'mobile' => 80,
			'tablet' => 80,
			'desktop' => 80,
		]);

		$is_row_empty_mobile = $this->is_row_empty('bottom-row', 'mobile');
		$is_row_empty_desktop = $this->is_row_empty('bottom-row', 'desktop');

		if ($is_row_empty_mobile) {
			$bottom_row_height['mobile'] = 0;
			$bottom_row_height['tablet'] = 0;
		}

		if ($is_row_empty_desktop) {
			$bottom_row_height['desktop'] = 0;
		}

		return [
			'mobile' => intval($top_row_height['mobile']) + intval(
				$middle_row_height['mobile']
			) + intval($bottom_row_height['mobile']),
			'tablet' => intval($top_row_height['tablet']) + intval(
				$middle_row_height['tablet']
			) + intval($bottom_row_height['tablet']),
			'desktop' => intval($top_row_height['desktop']) + intval(
				$middle_row_height['desktop']
			) + intval($bottom_row_height['desktop']),
		];
	}

	public function contains_item($item) {
		if (is_customize_preview()) {
			return true;
		}

		$section = $this->get_current_section();

		foreach ($section['desktop'] as $desktop_row) {
			foreach ($desktop_row['placements'] as $single_placement) {
				if (in_array($item, $single_placement['items'])) {
					return true;
				}
			}
		}

		foreach ($section['mobile'] as $mobile_row) {
			foreach ($mobile_row['placements'] as $single_placement) {
				if (in_array($item, $single_placement['items'])) {
					return true;
				}
			}
		}

		return false;
	}

	public function render() {
		$content = $this->render_for_device('desktop');
		$content .= $this->render_for_device('mobile');

		$current_section = $this->get_current_section();

		if (! isset($current_section['settings'])) {
			$current_section['settings'] = [];
		}

		$atts = $current_section['settings'];

		$data_header_output = 'static';

		if (blocksy_akg('is_absolute', $atts, 'no') === 'yes') {
			$data_header_output = 'absolute';
		}

		return blocksy_html_tag(
			'header',
			apply_filters(
				'blocksy:header:wrapper-attr',
				array_merge(
					[
						'id' => 'header',
						'data-behavior' => $data_header_output,
					],
					blocksy_schema_org_definitions('header', ['array' => true]),
					is_customize_preview() ? [
						'data-id' => $this->get_current_section_id(),
					] : []
				),
				[
					'atts' => $atts
				]
			),
			$content
		);
	}

	public function render_for_device($device) {
		$content = '';

		$current_section = $this->get_current_section();
		$current_layout = $current_section[$device];

		foreach ($current_layout as $row) {
			if ($row['id'] === 'offcanvas') {
				continue;
			}

			$content .= $this->render_row($row, [
				'device' => $device
			]);
		}

		return blocksy_html_tag(
			'div',
			['data-device' => $device],
			$content
		);
	}

	public function render_row($row, $args = []) {
		$args = wp_parse_args($args, [
			'device' => 'desktop'
		]);

		if ($this->is_row_empty($row)) {
			return '';
		}

		$row_config = $this->get_item_config_for($row['id']);

		$simplified_id = str_replace(
			'-row',
			'',
			$row['id']
		);

        $atts = $this->get_item_data_for($row['id']);

		$container_class = 'ct-container';

		if (blocksy_default_akg('headerRowWidth', $atts, 'fixed') !== 'fixed') {
			$container_class = 'ct-container-fluid';
		}

		$start_placement = $this->render_start_placement($row, [
			'device' => $args['device']
		]);
		$middle_placement = $this->render_middle_placement($row, [
			'device' => $args['device']
		]);
		$end_placement = $this->render_end_placement($row, [
			'device' => $args['device']
		]);

		$count = 0;

		if (! empty(trim($start_placement))) {
			$count++;
		}

		if (! empty(trim($middle_placement))) {
			$count++;
		}

		if (! empty(trim($end_placement))) {
			$count++;
		}

		$topBorder = blocksy_expand_responsive_value(
			blocksy_akg('headerRowTopBorder', $atts, [
				'width' => 1,
				'style' => 'none',
				'color' => [
					'color' => 'rgba(44,62,80,0.2)',
				],
			])
		);

		$bottomBorder = blocksy_expand_responsive_value(
			blocksy_akg('headerRowBottomBorder', $atts, [
				'width' => 1,
				'style' => 'none',
				'color' => [
					'color' => 'rgba(44,62,80,0.2)',
				],
			])
		);

		$border_behavior = [];

		if (
			$topBorder['desktop']['style'] !== 'none'
			||
			$topBorder['tablet']['style'] !== 'none'
			||
			$topBorder['mobile']['style'] !== 'none'
		) {
			if (blocksy_akg(
				'headerRowTopBorderFullWidth',
				$atts,
				'no'
			) === 'no') {
				$border_behavior[] = 'top-fixed';
			} else {
				$border_behavior[] = 'top-full';
			}
		}

		if (
			$bottomBorder['desktop']['style'] !== 'none'
			||
			$bottomBorder['tablet']['style'] !== 'none'
			||
			$bottomBorder['mobile']['style'] !== 'none'
		) {
			if (blocksy_akg(
				'headerRowBottomBorderFullWidth',
				$atts,
				'no'
			) === 'no') {
				$border_behavior[] = 'bottom-fixed';
			} else {
				$border_behavior[] = 'bottom-full';
			}
		}

		$row_container_attr = array_merge([
			'data-row' => $simplified_id,
			'data-columns' => $count,
		], (
			is_customize_preview() ? [
				'data-item-label' => $row_config['config']['name'],
				'data-shortcut' => 'border',
				'data-location' => $this->get_customizer_location_for(
					$row['id']
				),
			] : []
		), (
			count($border_behavior) > 0 ? [
				'data-border' => implode(':', $border_behavior)
			] : []
		));

		$result = '<div ' . blocksy_attr_to_html($row_container_attr) . '>';
		$result .= '<div ' . blocksy_attr_to_html(array_merge([
			'class' => $container_class
		])) . '>';
		// $result .= '<div class="' . $container_class . '">';

		$result .= $start_placement;
		$result .= $middle_placement;
		$result .= $end_placement;

		$result .= '</div>';
		$result .= '</div>';

		return $result;
	}

	public function render_single_item($item_id, $args = []) {
		$args = wp_parse_args($args, [
			'device' => 'desktop'
		]);

		$item = null;

		$registered_items = blocksy_manager()->builder->get_registered_items_by('header');

		foreach ($registered_items as $single_item) {
			if ($single_item['id'] === $item_id) {
				$item = $single_item;
				break;
			}
		}

		$not_registered_label = sprintf(
			// translated: %s is the panel builder item ID that is missing
			__('Item %s not registered or doesn\'t have a view.php file.', 'blocksy'),
			$item_id
		);

		if (! $item) {
			return $not_registered_label;
		}

		return blocksy_render_view(
			$item['path'] . '/view.php',
			[
				'atts' => $this->get_item_data_for($item_id),
				'header_id' => $this->get_current_section_id(),
				'attr' => array_merge([
					'data-id' => $item_id,
				], (
					is_customize_preview() ? [
						'data-item-label' => $item['config']['name'],
						'data-shortcut' => $item['config']['shortcut_style'],
						'data-location' => $this->get_customizer_location_for($item_id)
					] : []
				)),
				'device' => $args['device']
			],
			$not_registered_label
		);
	}

	public function get_item_data_for($id) {
		$header = $this->get_section_value()['sections'][0];

		foreach ($this->get_section_value()['sections'] as $single_section) {
			if ($single_section['id'] === $this->get_current_section_id()) {
				$header = $single_section;
			}
		}

		foreach ($header['items'] as $single_item) {
			if (
				$single_item['id'] === $id
				&&
				isset($single_item['values'])
				&&
				is_array($single_item['values'])
			) {
				return $single_item['values'];
			}
		}

		return [];
	}

	public function get_item_config_for($id) {
		$registered_items = blocksy_manager()
			->builder
			->get_registered_items_by('header');

		foreach ($registered_items as $single_item) {
			if ($single_item['id'] === $id) {
				return $single_item;
			}
		}

		return [];
	}

	private function render_start_placement($row, $args = []) {
		$args = wp_parse_args($args, [
			'device' => 'desktop'
		]);

		$placement = $this->get_placement_by($row, 'start');

		$middle_placement = $this->get_placement_by($row, 'middle');
		$end_placement = $this->get_placement_by($row, 'end');
		$start_secondary = $this->get_placement_by($row, 'start-middle');
		$end_secondary = $this->get_placement_by($row, 'end-middle');

		if (! $placement) {
			return '';
		}

		if ($start_secondary && $end_secondary && $end_placement) {
			if (
				count($start_secondary['items']) === 0
				&&
				count($end_secondary['items']) === 0
				&&
				count($placement['items']) === 0
				&&
				count($end_placement['items']) === 0
			) {
				return '';
			}
		}

		if ($middle_placement && $end_placement) {
			if (
				count($middle_placement['items']) === 0
				&&
				count($placement['items']) === 0
			) {
				return '';
			}
		}

		$secondary_output = '';
		$primary_output = '';

		if (count($placement['items']) > 0) {
			$primary_output = blocksy_html_tag(
				'div',
				[
					'data-items' => 'primary'
				],
				$this->render_items_collection($placement['items'], [
					'device' => $args['device']
				])
			);
		}

		if (
			$middle_placement
			&&
			$start_secondary
			&&
			count($middle_placement['items']) > 0
			&&
			count($start_secondary['items']) > 0
		) {
			$secondary_output = blocksy_html_tag(
				'div',
				[
					'data-items' => 'secondary'
				],
				$this->render_items_collection($start_secondary['items'])
			);
		}

		$count = 0;

		if (! empty(trim($primary_output))) {
			$count++;
		}

		if (! empty(trim($secondary_output))) {
			$count++;
		}

		return blocksy_html_tag(
			'div',
			array_merge([
				'data-column' => 'start'
			], (
				$count > 0 ? [
					'data-placements' => $count
				] : []
			)),
			$primary_output . $secondary_output
		);
	}

	private function render_middle_placement($row, $args = []) {
		$args = wp_parse_args($args, [
			'device' => 'desktop'
		]);

		$placement = $this->get_placement_by($row, 'middle');

		if (! $placement) {
			return '';
		}

		if (count($placement['items']) === 0) {
			return '';
		}

		return blocksy_html_tag(
			'div',
			['data-column' => 'middle'],
			blocksy_html_tag(
				'div',
				['data-items' => ''],
				$this->render_items_collection($placement['items'], [
					'device' => $args['device']
				])
			)
		);
	}

	private function render_end_placement($row, $args = []) {
		$args = wp_parse_args($args, [
			'device' => 'desktop'
		]);

		$placement = $this->get_placement_by($row, 'end');

		$middle_placement = $this->get_placement_by($row, 'middle');
		$start_placement = $this->get_placement_by($row, 'start');
		$start_secondary = $this->get_placement_by($row, 'start-middle');
		$end_secondary = $this->get_placement_by($row, 'end-middle');

		if (! $placement) {
			return '';
		}

		if ($start_secondary && $end_secondary && $start_placement) {
			if (
				count($start_secondary['items']) === 0
				&&
				count($end_secondary['items']) === 0
				&&
				count($placement['items']) === 0
				&&
				count($start_placement['items']) === 0
			) {
				return '';
			}
		}

		if ($middle_placement && $start_placement) {
			if (
				count($middle_placement['items']) === 0
				&&
				count($placement['items']) === 0
			) {
				return '';
			}
		}

		$secondary_output = '';
		$primary_output = '';

		if (count($placement['items']) > 0) {
			$primary_output = blocksy_html_tag(
				'div',
				[
					'data-items' => 'primary'
				],
				$this->render_items_collection($placement['items'], [
					'device' => $args['device']
				])
			);
		}

		if (
			$middle_placement
			&&
			$end_secondary
			&&
			count($middle_placement['items']) > 0
			&&
			count($end_secondary['items']) > 0
		) {
			$secondary_output = blocksy_html_tag(
				'div',
				[
					'data-items' => 'secondary'
				],
				$this->render_items_collection($end_secondary['items'], [
					'device' => $args['device']
				])
			);
		}

		$count = 0;

		if (! empty(trim($primary_output))) {
			$count++;
		}

		if (! empty(trim($secondary_output))) {
			$count++;
		}

		return blocksy_html_tag(
			'div',
			array_merge([
				'data-column' => 'end'
			], (
				$count > 0 ? [
					'data-placements' => $count
				] : []
			)),
			$secondary_output . $primary_output
		);
	}

	private function get_placement_by($row, $id) {
		foreach ($row['placements'] as $placement) {
			if ($placement['id'] === $id) {
				return $placement;
			}
		}

		return null;
	}

	public function is_row_empty($row, $device = '') {
		if (! is_array($row)) {
			$current_section = $this->get_current_section();
			$current_layout = $current_section[$device];

			foreach ($current_layout as $single_row) {
				if ($single_row['id'] === $row) {
					$row = $single_row;
				}
			}
		}

		$columns_to_check = ['start', 'middle', 'end'];

		foreach ($row['placements'] as $single_column) {
			if (
				in_array($single_column['id'], ['start', 'middle', 'end'])
				&&
				isset($single_column['items'])
				&&
				count($single_column['items']) > 0
			) {
				return false;
			}
		}

		return true;
	}

	public function render_items_collection($items, $args = []) {
		$args = wp_parse_args($args, [
			'device' => 'desktop'
		]);

		$result = '';

		foreach ($items as $item) {
			$result .= $this->render_single_item($item, [
				'device' => $args['device']
			]);
		}

		return $result;
	}

	public function get_customizer_location_for($id) {
		return 'header:builder_panel_' . $id;
	}

	public function get_primary_item($id) {
		return [];
	}
}

