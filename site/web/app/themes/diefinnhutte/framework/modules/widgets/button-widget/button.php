<?php

if ( class_exists( 'DieFinnhutteCoreClassWidget' ) ) {
	class DieFinnhutteSelectClassButtonWidget extends DieFinnhutteCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_button_widget',
				esc_html__( 'DieFinnhutte Button Widget', 'diefinnhutte' ),
				array( 'description' => esc_html__( 'Add button element to widget areas', 'diefinnhutte' ) )
			);

			$this->setParams();
		}

		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Type', 'diefinnhutte' ),
					'options' => array(
						'solid'   => esc_html__( 'Solid', 'diefinnhutte' ),
						'outline' => esc_html__( 'Outline', 'diefinnhutte' ),
						'simple'  => esc_html__( 'Simple', 'diefinnhutte' )
					)
				),
				array(
					'type'  => 'textfield',
					'name'  => 'custom_class',
					'title' => esc_html__( 'Custom CSS Class', 'diefinnhutte' )
				),
				array(
					'type'        => 'dropdown',
					'name'        => 'size',
					'title'       => esc_html__( 'Size', 'diefinnhutte' ),
					'options'     => array(
						'small'  => esc_html__( 'Small', 'diefinnhutte' ),
						'medium' => esc_html__( 'Medium', 'diefinnhutte' ),
						'large'  => esc_html__( 'Large', 'diefinnhutte' ),
						'huge'   => esc_html__( 'Huge', 'diefinnhutte' )
					),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'diefinnhutte' )
				),
				array(
					'type'    => 'textfield',
					'name'    => 'text',
					'title'   => esc_html__( 'Text', 'diefinnhutte' ),
					'default' => esc_html__( 'Button Text', 'diefinnhutte' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'diefinnhutte' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Link Target', 'diefinnhutte' ),
					'options' => diefinnhutte_select_get_link_target_array()
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'diefinnhutte' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'hover_color',
					'title' => esc_html__( 'Hover Color', 'diefinnhutte' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'background_color',
					'title'       => esc_html__( 'Background Color', 'diefinnhutte' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'diefinnhutte' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_background_color',
					'title'       => esc_html__( 'Hover Background Color', 'diefinnhutte' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'diefinnhutte' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'border_color',
					'title'       => esc_html__( 'Border Color', 'diefinnhutte' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'diefinnhutte' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_border_color',
					'title'       => esc_html__( 'Hover Border Color', 'diefinnhutte' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'diefinnhutte' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__( 'Margin', 'diefinnhutte' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'diefinnhutte' )
				)
			);
		}

		public function widget( $args, $instance ) {
			$params = '';

			if ( ! is_array( $instance ) ) {
				$instance = array();
			}

			// Filter out all empty params
			$instance = array_filter( $instance, function ( $array_value ) {
				return trim( $array_value ) != '';
			} );

			// Default values
			if ( ! isset( $instance['text'] ) ) {
				$instance['text'] = 'Button Text';
			}

			// Generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}

			echo '<div class="widget qodef-button-widget">';
			echo do_shortcode( "[qodef_button $params]" ); // XSS OK
			echo '</div>';
		}
	}
}