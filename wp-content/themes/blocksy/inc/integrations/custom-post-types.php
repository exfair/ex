<?php

add_filter('post_class', function ($classes) {
	if (function_exists('is_bbpress') && (
		get_post_type() === 'forum'
		||
		get_post_type() === 'topic'
		||
		get_post_type() === 'reply'
	)) {
		$classes[] = 'bbpress';
	}

	return $classes;
});

class Blocksy_Custom_Post_Types {
	private $supported_post_types = null;

	public function get_supported_post_types() {
		if (! $this->supported_post_types) {
			$this->supported_post_types = apply_filters(
				'blocksy:custom_post_types:supported_list',
				[]
			);
		}

		return $this->supported_post_types;
	}

	public function is_supported_post_type() {
		global $post;
		global $wp_taxonomies;
		global $wp_query;

		$post_type = get_post_type($post);

		$tax_query = $wp_query->tax_query;

		if ($tax_query) {
			$tax = $tax_query->queries;

			if (! empty($tax) && isset($tax[0]['taxonomy'])) {
				$tax = $tax[0]['taxonomy'];
			}

			if ($tax && isset($wp_taxonomies[$tax])) {
				$all_tax_post_types = $wp_taxonomies[$tax]->object_type;

				if (! empty($all_tax_post_types)) {
					$post_type = $all_tax_post_types[0];
				}
			}
		}

		if (! $post_type) {
			$post_type = get_query_var('post_type');
		}

		if (in_array($post_type, $this->get_supported_post_types())) {
			return $post_type;
		}

		return null;
	}
}


