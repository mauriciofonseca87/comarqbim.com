<?php

if ( class_exists( 'DieFinnhutteCoreClassWidget' ) ) {
	class DieFinnhutteSelectClassSeparatorWidget extends DieFinnhutteCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_separator_widget',
				esc_html__( 'DieFinnhutte Separator Widget', 'diefinnhutte' ),
				array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'diefinnhutte' ) )
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
						'normal'     => esc_html__( 'Normal', 'diefinnhutte' ),
						'full-width' => esc_html__( 'Full Width', 'diefinnhutte' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'position',
					'title'   => esc_html__( 'Position', 'diefinnhutte' ),
					'options' => array(
						'center' => esc_html__( 'Center', 'diefinnhutte' ),
						'left'   => esc_html__( 'Left', 'diefinnhutte' ),
						'right'  => esc_html__( 'Right', 'diefinnhutte' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'border_style',
					'title'   => esc_html__( 'Style', 'diefinnhutte' ),
					'options' => array(
						'solid'  => esc_html__( 'Solid', 'diefinnhutte' ),
						'dashed' => esc_html__( 'Dashed', 'diefinnhutte' ),
						'dotted' => esc_html__( 'Dotted', 'diefinnhutte' )
					)
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'diefinnhutte' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'width',
					'title' => esc_html__( 'Width (px or %)', 'diefinnhutte' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'thickness',
					'title' => esc_html__( 'Thickness (px)', 'diefinnhutte' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'top_margin',
					'title' => esc_html__( 'Top Margin (px or %)', 'diefinnhutte' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'bottom_margin',
					'title' => esc_html__( 'Bottom Margin (px or %)', 'diefinnhutte' )
				)
			);
		}

		public function widget( $args, $instance ) {
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}

			//prepare variables
			$params = '';

			//is instance empty?
			if ( is_array( $instance ) && count( $instance ) ) {
				//generate shortcode params
				foreach ( $instance as $key => $value ) {
					$params .= " $key='$value' ";
				}
			}

			echo '<div class="widget qodef-separator-widget">';
			echo do_shortcode( "[qodef_separator $params]" ); // XSS OK
			echo '</div>';
		}
	}
}