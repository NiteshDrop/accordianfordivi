<?php

class Wpd_Custom_Accordian extends ET_Builder_Module {

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'WPDrops',
		'author_uri' => 'wpdrops.com',
	);

	public function init() {
		$this->slug             = 'wca_accordian';
		$this->child_slug       = 'wca_accordian_item';
		$this->vb_support       = 'on';
		$this->name             = esc_html__( 'WPD Custom Accordion', 'wca-customaccordian' );
		$this->main_css_element = '%%order_class%%';
	}

	public function get_settings_modal_toggles() {
		return array(
			'advanced' => array(
				'toggles' => array(
					'icon'       => esc_html__( 'Icon', 'wca-customaccordian' ),
					'image'      => esc_html__( 'Image', 'wca-customaccordian' ),
					'title'      => esc_html__( 'Title', 'wca-customaccordian' ),
					'description'       => esc_html__( 'Description', 'wca-customaccordian' ),
				),
			),
		);
	}

	public function get_fields() {
		$fields = array();

		$fields['wpd_title_color'] = array(
			'label'          => esc_html__( 'Title Color', 'wca-customaccordian' ),
			'type'           => 'color-alpha',
			'tab_slug'       => 'advanced',
			'default'				 => '#d23b26',
			'mobile_options' => true,
			'toggle_slug'    => 'title',
		);

		$fields['wpd_title_font_size'] = array(
			'label'            => esc_html__( 'Title Font Size', 'wca-customaccordian' ),
			'type'             => 'range',
			'default'          => '28px',
			'default_unit'     => 'px',
			'default_on_front' => '28px',
			'allowed_units'    => array( 'em', 'rem', 'px', 'pt' ),
			'range_settings'   => array(
				'min'  => '1',
				'max'  => '150',
				'step' => '1',
			),
			'validate_unit'    => true,
			'mobile_options'   => true,
			'tab_slug'         => 'advanced',
			'toggle_slug'      => 'title',
		);

		$fields['wpd_icon_color'] = array(
			'label'          => esc_html__( 'Icon Color', 'wca-customaccordian' ),
			'type'           => 'color-alpha',
			'tab_slug'       => 'advanced',
			'mobile_options' => true,
			'toggle_slug'    => 'icon',
		);

		$fields['wpd_content_color'] = array(
			'label'          => esc_html__( 'Content Color', 'wca-customaccordian' ),
			'type'           => 'color-alpha',
			'tab_slug'       => 'advanced',
			'default'				 => '#333',
			'mobile_options' => true,
			'toggle_slug'    => 'description',
		);

		$fields['wpd_desc_font_size'] = array(
			'label'            => esc_html__( 'Content Font Size', 'wca-customaccordian' ),
			'type'             => 'range',
			'default'          => '16px',
			'default_unit'     => 'px',
			'default_on_front' => '16px',
			'allowed_units'    => array( 'em', 'rem', 'px', 'pt' ),
			'range_settings'   => array(
				'min'  => '1',
				'max'  => '150',
				'step' => '1',
			),
			'validate_unit'    => true,
			'mobile_options'   => true,
			'tab_slug'         => 'advanced',
			'toggle_slug'      => 'description',
		);

		return $fields;
	}

	public function apply_css($render_slug) {
		$wpd_title_color = $this->props['wpd_title_color'];
		$wpd_title_font_size = $this->props['wpd_title_font_size'];
		$wpd_desc_font_size = $this->props['wpd_desc_font_size'];


		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-title',
				'declaration' => "color: {$wpd_title_color};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-title',
				'declaration' => "font-size: {$wpd_title_font_size};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-description p',
				'declaration' => "font-size: {$wpd_desc_font_size};",
			)
		);
	}

	public function render( $attrs, $content, $render_slug ) {
		$this->apply_css( $render_slug );
		wp_enqueue_style( 'wpd-accordion-style', plugin_dir_url( __DIR__ ) . 'CustomAccordian/style.css' );
		wp_enqueue_script( 'wpd-accordion-style' );
		wp_enqueue_script( 'wpd-accordion-script', plugin_dir_url( __DIR__ ) . 'CustomAccordian/frontend.min.js', array(), '', true);

		return sprintf(
			'%1$s',
			et_core_sanitized_previously( $this->content ),
		);
	}
}

new Wpd_Custom_Accordian;