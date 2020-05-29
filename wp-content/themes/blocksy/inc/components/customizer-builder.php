<?php

require_once dirname(__FILE__) . '/builder/header-logic.php';
require_once dirname(__FILE__) . '/builder/header-elements.php';
require_once dirname(__FILE__) . '/builder/builder-header-renderer.php';
require_once dirname(__FILE__) . '/builder/header/header-value-patcher.php';

require_once dirname(__FILE__) . '/builder/footer-logic.php';
require_once dirname(__FILE__) . '/builder/builder-footer-renderer.php';

class Blocksy_Customizer_Builder {
	private $items_cache = null;

	public function __construct() {
		$this->items_cache = [
			'header' => null,
			'footer' => null
		];
	}

	public function patch_header_value_for($processed_terms) {
		blocksy_manager()->header_builder->patch_value_for($processed_terms);
	}

	public function translation_keys() {
		return array_merge(
			blocksy_manager()->header_builder->translation_keys(),
			blocksy_manager()->footer_builder->translation_keys()
		);
	}

	public function typography_keys() {
		return array_merge(
			blocksy_manager()->header_builder->typography_keys(),
			blocksy_manager()->footer_builder->typography_keys()
		);
	}

	public function dynamic_css($panel_type = 'header', $args = []) {
		if (! blocksy_dynamic_styles_should_call($args)) {
			return;
		}

		foreach ($this->get_registered_items_by($panel_type) as $item) {
			if (! file_exists($item['path'] . '/dynamic-styles.php')) {
				continue;
			}

			if ($panel_type === 'header') {
				$render = new Blocksy_Header_Builder_Render();
			} else {
				$render = new Blocksy_Customizer_Builder_Render_Columns();
			}

			$args['atts'] = $render->get_item_data_for($item['id']);
			$args['item'] = $item;

			if ($panel_type === 'header') {
				$args['header_height'] = $render->get_header_height();
			}

			if (isset($item['is_primary']) && $item['is_primary']) {
				$args['primary_item'] = $render->get_primary_item($item['id']);
			}

			blocksy_theme_get_dynamic_styles(array_merge([
				'path' => $item['path'] . '/dynamic-styles.php',
			], $args));
		}

		if ($panel_type === 'footer') {
			$path = get_template_directory() . '/inc/panel-builder/footer/dynamic-styles.php';
			$render = new Blocksy_Customizer_Builder_Render_Columns();
			$footer = $render->get_current_section();

			if (! isset($footer['settings'])) {
				$footer['settings'] = [];
			}

			$args['atts'] = $footer['settings'];

			if (file_exists($path)) {
				blocksy_theme_get_dynamic_styles(array_merge([
					'path' => $path
				], $args));
			}
		}

		if ($panel_type === 'header') {
			$path = apply_filters(
				'blocksy:header:dynamic-styles-path',
				get_template_directory() . '/inc/panel-builder/header/dynamic-styles.php'
			);

			$render = new Blocksy_Header_Builder_Render();
			$header = $render->get_current_section();

			if (! isset($header['settings'])) {
				$header['settings'] = [];
			}

			$args['atts'] = $header['settings'];

			if (file_exists($path)) {
				blocksy_theme_get_dynamic_styles(array_merge([
					'path' => $path
				], $args));
			}
		}
	}

	public function get_data_for_customizer() {
		$result = [];

		$result['header'] = $this->get_registered_items_by('header', [
			'require_options' => true
		]);

		$result['footer'] = $this->get_registered_items_by('footer', [
			'require_options' => true
		]);

		$result['footer_data'] = [
			'footer_options' => blocksy_get_options(
				get_template_directory() . '/inc/panel-builder/footer/options.php',
				[],
				false
			)
		];

		$result['header_data'] = [
			'header_options' => blocksy_get_options(
				apply_filters(
					'blocksy:header:general-options-path',
					get_template_directory() . '/inc/panel-builder/header/options.php'
				),
				[],
				false
			)
		];

		$result['secondary_items'] = [
			'header' => $this->get_registered_items_by('header', [
				'include' => 'secondary'
			]),

			'footer' => $this->get_registered_items_by('footer', [
				'include' => 'secondary'
			]),
		];

		return $result;
	}

	public function get_option_id_for($panel_type = 'header', $item) {
		return $panel_type . '_item_' . str_replace('-', '_', $item['id']);
	}

	public function get_registered_items_by($panel_type = 'header', $args = []) {
		$args = wp_parse_args($args, [
			// all | primary | secondary
			'include' => 'all',
			'require_options' => false
		]);

		$should_do_caching = $args['include'] === 'all' && ! $args['require_options'];

		if ($should_do_caching) {
			if ($this->items_cache[$panel_type]) {
				return $this->items_cache[$panel_type];
			}
		}

		$paths_to_look_for_items = apply_filters(
			'blocksy:header:items-paths',
			[
				get_template_directory() . '/inc/panel-builder/' . $panel_type
			],
			$panel_type
		);

		$items = [];

		$primary_items = [
			'top-row',
			'middle-row',
			'bottom-row',
			'offcanvas'
		];

		foreach ($paths_to_look_for_items as $single_path) {
			$all_items = glob(
				$single_path . '/*',
				GLOB_ONLYDIR
			);

			foreach ($all_items as $single_item) {
				$id = str_replace('_', '-', basename($single_item));

				if (in_array($id, $primary_items)) {
					if ($args['include'] === 'secondary') {
						continue;
					}
				} else {
					if ($args['include'] === 'primary') {
						continue;
					}
				}

				$future_data = [
					'id' => $id,
					'config' => $this->read_config_for($single_item),
					'path' => $single_item,
					'is_primary' => in_array($id, $primary_items)
				];

				if ($args['require_options']) {
					$future_data['options'] = $this->get_options_for(
						$panel_type,
						$future_data
					);
				}

				$items[] = $future_data;
			}
		}

		if ($should_do_caching) {
			$this->items_cache[$panel_type] = $items;
		}

		return $items;
	}

	private function read_config_for($file_path) {
		$name = explode('-', basename($file_path));
		$name = array_map('ucfirst', $name);
		$name = implode(' ', $name);

		$_extract_variables = ['config' => []];

		if (is_readable($file_path . '/config.php')) {
			require $file_path . '/config.php';

			foreach ($_extract_variables as $variable_name => $default_value) {
				if (isset($$variable_name)) {
					$_extract_variables[$variable_name] = $$variable_name;
				}
			}
		}

		$_extract_variables['config'] = array_merge(
			[
				'name' => $name,
				'description' => '',
				'typography_keys' => [],
				'translation_keys' => [],
				'devices' => ['desktop', 'mobile'],
				'selective_refresh' => [],
				'allowed_in' => [],
				'excluded_from' => [],

				// border | drop
				'shortcut_style' => 'drop',
				'enabled' => true
			],
			$_extract_variables['config']
		);

		return $_extract_variables['config'];
	}

	public function get_options_for($panel_type = 'header', $item) {
		if (! is_array($item)) {
			return [];
		}

		if (! isset($item['path'])) {
			return [];
		}

		return blocksy_get_options($item['path'] . '/options.php', [
			'prefix' => $this->get_option_id_for($panel_type, $item) . '_'
		], false);
	}
}

