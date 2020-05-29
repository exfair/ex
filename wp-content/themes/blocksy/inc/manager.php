<?php

class Blocksy_Manager {
	public static $instance = null;

	public $builder = null;

	public $header_builder = null;
	public $footer_builder = null;

	public $post_types = null;

	public static function instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->early_init();
	}

	private function early_init() {
		$this->builder = new Blocksy_Customizer_Builder();

		$this->header_builder = new Blocksy_Header_Builder();
		$this->footer_builder = new Blocksy_Footer_Builder();
		$this->post_types = new Blocksy_Custom_Post_Types();

		add_filter('block_parser_class', function () {
			return 'Blocksy_WP_Block_Parser';
		});

	}
}

function blocksy_manager() {
	return Blocksy_Manager::instance();
}
