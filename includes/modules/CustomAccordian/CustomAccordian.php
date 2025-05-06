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
		$this->name             = esc_html__( 'Intercept Accordion', 'wca-customaccordian' );
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
					'othertext'       => esc_html__( 'Other Text', 'wca-customaccordian' ),
					'button'       => esc_html__( 'Button', 'wca-customaccordian' ),
				),
			),
		);
	}

	public function get_fields() {
		$fields = array();

		$fields['title_color'] = array(
			'label'          => esc_html__( 'Title Color', 'wca-customaccordian' ),
			'type'           => 'color-alpha',
			'tab_slug'       => 'advanced',
			'default'				 => '#d23b26',
			'mobile_options' => true,
			'toggle_slug'    => 'title',
		);

		$fields['title_font_size'] = array(
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

		$fields['icon_color'] = array(
			'label'          => esc_html__( 'Icon Color', 'wca-customaccordian' ),
			'type'           => 'color-alpha',
			'tab_slug'       => 'advanced',
			'mobile_options' => true,
			'toggle_slug'    => 'icon',
		);

		$fields['icon_font_size'] = array(
			'label'            => esc_html__( 'Icon Font Size', 'wca-customaccordian' ),
			'type'             => 'range',
			'default'          => '22px',
			'default_unit'     => 'px',
			'default_on_front' => '22px',
			'allowed_units'    => array( 'em', 'rem', 'px', 'pt' ),
			'range_settings'   => array(
				'min'  => '1',
				'max'  => '150',
				'step' => '1',
			),
			'validate_unit'    => true,
			'mobile_options'   => true,
			'tab_slug'         => 'advanced',
			'toggle_slug'      => 'icon',
		);

		$fields['content_color'] = array(
			'label'          => esc_html__( 'Content Color', 'wca-customaccordian' ),
			'type'           => 'color-alpha',
			'tab_slug'       => 'advanced',
			'default'				 => '#333',
			'mobile_options' => true,
			'toggle_slug'    => 'description',
		);

		$fields['content_font_size'] = array(
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

		$fields['smalltext_color'] = array(
			'label'          => esc_html__( 'Other Text Color', 'wca-customaccordian' ),
			'type'           => 'color-alpha',
			'tab_slug'       => 'advanced',
			'default'				 => '#333',
			'mobile_options' => true,
			'toggle_slug'    => 'othertext',
		);

		$fields['smalltext_font_size'] = array(
			'label'            => esc_html__( 'Other Text Font Size', 'wca-customaccordian' ),
			'type'             => 'range',
			'default'          => '12px',
			'default_unit'     => 'px',
			'default_on_front' => '12px',
			'allowed_units'    => array( 'em', 'rem', 'px', 'pt' ),
			'range_settings'   => array(
				'min'  => '1',
				'max'  => '150',
				'step' => '1',
			),
			'validate_unit'    => true,
			'mobile_options'   => true,
			'tab_slug'         => 'advanced',
			'toggle_slug'      => 'othertext',
		);
		
		$fields['button_color'] = array(
			'label'          => esc_html__( 'Button Color', 'wca-customaccordian' ),
			'type'           => 'color-alpha',
			'tab_slug'       => 'advanced',
			'default'				 => '#006e96',
			'mobile_options' => true,
			'toggle_slug'    => 'button',
		);

		$fields['button_font_size'] = array(
			'label'            => esc_html__( 'Button Font Size', 'wca-customaccordian' ),
			'type'             => 'range',
			'default'          => '18px',
			'default_unit'     => 'px',
			'default_on_front' => '18px',
			'allowed_units'    => array( 'em', 'rem', 'px', 'pt' ),
			'range_settings'   => array(
				'min'  => '1',
				'max'  => '150',
				'step' => '1',
			),
			'validate_unit'    => true,
			'mobile_options'   => true,
			'tab_slug'         => 'advanced',
			'toggle_slug'      => 'button',
		);

		return $fields;
	}

	public function apply_css($render_slug) {
		$title_color = $this->props['title_color'];
		$title_font_size = $this->props['title_font_size'];
		$icon_color = $this->props['icon_color'];
		$icon_font_size = $this->props['icon_font_size'];
		$content_font_size = $this->props['content_font_size'];
		$content_color = $this->props['content_color'];
		$button_color = $this->props['button_color'];
		$button_font_size = $this->props['button_font_size'];
		$smalltext_color = $this->props['smalltext_color'];
		$smalltext_font_size = $this->props['smalltext_font_size'];


		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-title',
				'declaration' => "color: {$title_color};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-title',
				'declaration' => "font-size: {$title_font_size};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-title span.et-pb-icon',
				'declaration' => "color: {$icon_color};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-title span',
				'declaration' => "
					font-size: {$icon_font_size};
				",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-title img',
				'declaration' => "
					height: {$icon_font_size};
					width: {$icon_font_size};
				",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-description p',
				'declaration' => "font-size: {$content_font_size};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-readmore-icon',
				'declaration' => "color: {$button_color};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-readmore-icon',
				'declaration' => "font-size: {$button_font_size};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-button',
				'declaration' => "color: {$button_color};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-accordion-button',
				'declaration' => "font-size: {$button_font_size};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-small-text',
				'declaration' => "color: {$smalltext_color};",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .wpd-small-text',
				'declaration' => "font-size: {$smalltext_font_size};",
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