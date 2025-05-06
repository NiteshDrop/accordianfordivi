<?php

class Wpd_Accordian_Item extends ET_Builder_Module {
	public function init() {
		$this->name                     = esc_html__( 'Intercept Accordion Item', 'wca-customaccordian' );
		$this->slug                     = 'wca_accordian_item';
		$this->vb_support               = 'on';
		$this->type                     = 'child';
		$this->child_title_var          = 'accordian_title';
		$this->child_title_fallback_var = 'accordian_title';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'content'         => esc_html__( 'Content', 'wca-customaccordian' ),
				),
			),
		);
	}

	public function get_fields() {
		$fields = array();

		$fields['accordian_title'] = array(
			'label'					=> esc_html__( 'Accordian Title', 'wca-customaccordian' ),
			'type'					=> 'text',
			'description'		=> esc_html__('This is title for each accordian.','wca-customaccordian'),
		);

		$fields['accordian_content'] = array(
			'label'					=> esc_html__( 'Accordian Content', 'wca-customaccordian' ),
			'type'					=> 'tiny_mce',
			'description'		=> esc_html__('This is contents for each accordian.','wca-customaccordian'),
		);

		$fields['image_icon'] = array(
			'label'       => esc_html__( 'Image Icon', 'wca-customaccordian' ),
			'type'        => 'yes_no_button',
			'options'     => array(
				'off' => esc_html__( 'No', 'wca-customaccordian' ),
				'on'  => esc_html__( 'Yes', 'wca-customaccordian' ),
			),
			'default'     => 'off',
		);

		$fields['accordion_icon'] = array(
			'label'       => esc_html__( 'Icon', 'wca-customaccordian' ),
			'type'        => 'select_icon',
			'class'       => array( 'et-pb-icon et-pb-font-icon' ),
			'show_if'          => array(
				'image_icon' => 'off',
			),
		);

		$fields['accordion_icon_image'] = array(
			'type'               => 'upload',
			'hide_metadata'      => true,
			'choose_text'        => esc_attr__( 'Choose an Image', 'wca-customaccordian' ),
			'upload_button_text' => esc_attr__( 'Upload an Image', 'wca-customaccordian' ),
			'description'		=> esc_html__('This field is for icon.','wca-customaccordian'),
			'dynamic_content'    => 'image',
			'affects'            => array(
				'alt',
				'title_text',
			),
			'show_if'          => array(
				'image_icon' => 'on',
			),
		);

		$fields['accordion_image'] = array(
			'label'       			 => esc_html__( 'Image', 'wca-customaccordian' ),
			'type'               => 'upload',
			'hide_metadata'      => true,
			'choose_text'        => esc_attr__( 'Choose an Image', 'wca-customaccordian' ),
			'upload_button_text' => esc_attr__( 'Upload an Image', 'wca-customaccordian' ),
			'dynamic_content'    => 'image',
			'affects'            => array(
				'alt',
				'title_text',
			),
		);

		$fields['show_small_text'] = array(
			'label'       => esc_html__( 'Show Small Text', 'wca-customaccordian' ),
			'type'        => 'yes_no_button',
			'options'     => array(
				'off' => esc_html__( 'No', 'wca-customaccordian' ),
				'on'  => esc_html__( 'Yes', 'wca-customaccordian' ),
			),
		);

		$fields['accordian_small_text'] = array(
			'label'					=> esc_html__( 'Accordian Small Text', 'wca-customaccordian' ),
			'type'					=> 'textarea',
			'description'		=> esc_html__('This field is for small text.','wca-customaccordian'),
			'show_if'          => array(
				'show_small_text' => 'on',
			),
		);

		$fields['show_accordian_link'] = array(
			'label'       => esc_html__( 'Show Read More', 'wca-customaccordian' ),
			'type'        => 'yes_no_button',
			'options'     => array(
				'off' => esc_html__( 'No', 'wca-customaccordian' ),
				'on'  => esc_html__( 'Yes', 'wca-customaccordian' ),
			),
		);

		$fields['accordian_link_text'] = array(
			'label'					=> esc_html__( 'Read More Text', 'wca-customaccordian' ),
			'type'					=> 'text',
			'description'		=> esc_html__('This Field is For Read More Text.','wca-customaccordian'),
			'show_if'          => array(
				'show_accordian_link' => 'on',
			),
		);

		$fields['accordian_link'] = array(
			'label'					=> esc_html__( 'Read More Link', 'wca-customaccordian' ),
			'type'					=> 'text',
			'description'		=> esc_html__('This Field is For Read More Link.','wca-customaccordian'),
			'show_if'          => array(
				'show_accordian_link' => 'on',
			),
		);

		$fields['accordion_link_icon'] = array(
			'label'       => esc_html__( 'Read More Icon', 'wca-customaccordian' ),
			'type'        => 'select_icon',
			'class'       => array( 'et-pb-icon et-pb-font-icon' ),
			'show_if'          => array(
				'show_accordian_link' => 'on',
			),
		);

		return $fields;
	}

	public function render( $attrs, $render_slug, $content = null ) {
		$multi_view		= et_pb_multi_view_options( $this );

		$accordion_icon_image = $this->props['image_icon'];
		$accordion_icon = isset($this->props['accordion_icon']) ? et_pb_process_font_icon($this->props['accordion_icon']) : '';
		$accordion_link_icon = isset($this->props['accordion_link_icon']) ? et_pb_process_font_icon($this->props['accordion_link_icon']) : '';
		$icon_image = esc_url($this->props['accordion_icon_image']);

		// Process image - safely handle the image URL
		$accordion_image = '';
		$image_caption = '';
		if (!empty($this->props['accordion_image'])) {
			$accordion_image = esc_url($this->props['accordion_image']);
			if($accordion_image) {
				$attachment_id	= attachment_url_to_postid( $accordion_image );
				if($attachment_id) {
					$image_caption = wp_get_attachment_caption( $attachment_id );
				}
			}
		}
		
		// Get content and title, ensuring they are not objects
		$accordion_title = isset($this->props['accordian_title']) ? esc_html($this->props['accordian_title']) : 'your Title Goes here';
		$accordion_content = isset($this->props['accordian_content']) ? $this->props['accordian_content'] : 'This is content area.';
		$accordian_small_text = isset($this->props['accordian_small_text']) ? $this->props['accordian_small_text'] : 'This is small text.';
		$accordion_link = isset($this->props['accordian_link']) ? $this->props['accordian_link'] : '';
		$accordion_link_text = isset($this->props['accordian_link_text']) ? $this->props['accordian_link_text'] : 'Read More';

		$output = sprintf(
			'<div class="wpd_accordian_contents">
				<h3 class="wpd-accordion-title">
					%1$s%2$s
				</h3>
				<div class="wpd-accordion-description">
					%3$s
					<span class="wpd-small-text">%4$s</span>
					%5$s
				</div>
			</div>
			<div class="wpd-accordion-img">
				<img src="%6$s" alt="img1" />
				<span>%7$s</span>
			</div>
			',
			($accordion_icon_image == "on") ? '<img src="'.$icon_image.'" />' : sprintf('<span class="et-pb-icon et-pb-font-icon wpd-readmore-icon">%1$s</span>', $accordion_icon),
			$accordion_title,
			$accordion_content,
			$accordian_small_text,
			($accordion_link_text) ? sprintf('<a class="wpd-accordion-button" href="%1$s"> %2$s <span class="et-pb-icon et-pb-font-icon wpd-readmore-icon">%3$s</span></a>', $accordion_link, $accordion_link_text,$accordion_link_icon ) : "",
			$accordion_image,
			$image_caption
		);

		return $output;
	}
}

new Wpd_Accordian_Item;