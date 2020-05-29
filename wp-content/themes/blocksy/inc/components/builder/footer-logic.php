<?php

class Blocksy_Footer_Builder {
	private $default_value = null;

	public function get_default_value() {
		if ($this->default_value) {
			return $this->default_value;
		}

		$this->default_value = [
			'current_section' => 'type-1',
			'sections' => [
				$this->get_structure_for([
					'id' => 'type-1',
					'rows' => [
						'top-row' => [
							'columns' => [
								['socials'],
								['menu']
							]
						],

						'middle-row' => [
							'columns' => [
								['widget-area-1'],
								['widget-area-2'],
								['widget-area-3']
							]
						],

						'bottom-row' => [
							'columns' => [
								['copyright']
							]
						],
					]
				]),

				$this->get_structure_for([
					'id' => 'type-2',
					'rows' => [
						'top-row' => [
							'columns' => [
								['menu'],
								['socials']
							]
						],

						'middle-row' => [
							'columns' => [
								['widget-area-1'],
								['widget-area-2'],
								['widget-area-3'],
								['widget-area-4']
							]
						],

						'bottom-row' => [
							'columns' => [
								['copyright']
							]
						],
					]
				])
			]
		];

		return $this->default_value;
	}

	public function translation_keys() {
		$render = new Blocksy_Customizer_Builder_Render_Columns();
		$sections = $render->get_section_value();

		$result = [];

		foreach ($sections['sections'] as $section) {
			foreach ($section['items'] as $item) {
				$nested_item = $render->get_item_config_for($item['id']);

				if (
					! isset($nested_item['config']['translation_keys'])
					||
					empty($nested_item['config']['translation_keys'])
				) {
					continue;
				}

				foreach ($nested_item['config']['translation_keys'] as $key) {
					if (! isset($item['values'][$key['key']])) {
						continue;
					}

					$result[] = array_merge($key, [
						'key' => 'footer:' . $section['id'] . ':' . $item['id'] . ':' . $key['key'],
						'value' => $item['values'][$key['key']]
					]);
				}
			}
		}

		return $result;
	}

	public function typography_keys() {
		$render = new Blocksy_Customizer_Builder_Render_Columns();
		$section = $render->get_current_section();

		$result = [];

		foreach ($section['items'] as $item) {
			$nested_item = $render->get_item_config_for($item['id']);

			if (
				! isset($nested_item['config']['typography_keys'])
				||
				empty($nested_item['config']['typography_keys'])
			) {
				continue;
			}

			$data = $render->get_item_data_for($item['id']);

			foreach ($nested_item['config']['typography_keys'] as $key) {
				$result[] = blocksy_akg($key, $data, []);
			}
		}

		return $result;
	}

	public function render() {
		$render = new Blocksy_Customizer_Builder_Render_Columns();
		return $render->render();
	}

	public function get_structure_for($args = []) {
		$args = wp_parse_args($args, [
			'id' => null,
			'mode' => 'columns',
			'rows' => []
		]);

		$args['rows'] = wp_parse_args($args['rows'], [
			'top-row' => [],
			'middle-row' => [],
			'bottom-row' => [],
		]);

		$base = [
			'id' => $args['id'],
			'mode' => $args['mode'],
			'rows' => [
				$this->get_bar_structure_for(array_merge([
					'id' => 'top-row',
					'mode' => $args['mode'],
				], $args['rows']['top-row'])),
				$this->get_bar_structure_for(array_merge([
					'id' => 'middle-row',
					'mode' => $args['mode']
				], $args['rows']['middle-row'])),
				$this->get_bar_structure_for(array_merge([
					'id' => 'bottom-row',
					'mode' => $args['mode']
				], $args['rows']['bottom-row'])),
			],
			'items' => [],
			'settings' => []
		];

		return $base;
	}

	private function get_bar_structure_for($args = []) {
		$args = wp_parse_args($args, [
			'id' => null,
			'mode' => 'columns',
			'columns' => [
				/**
				 * We always have one column available
				 */
				[],
				[],
				[]
			]
		]);

		return array_merge([
			'id' => $args['id'],
			'columns' => $args['columns']
		]);
	}
}

