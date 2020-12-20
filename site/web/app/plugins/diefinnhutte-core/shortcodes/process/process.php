<?php
namespace DieFinnhutteCore\CPT\Shortcodes\Process;

use DieFinnhutteCore\Lib;

class Process implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_process';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Process', 'diefinnhutte-core' ),
					'base'            => $this->base,
					'icon'            => 'icon-wpb-process extended-custom-icon',
					'category'        => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
					'as_parent'       => array( 'only' => 'qodef_process_item' ),
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number Of Columns', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'switch_to_one_column',
							'heading'     => esc_html__( 'Switch to One Column', 'diefinnhutte-core' ),
							'value'       => array(
								esc_html__( 'Default None', 'diefinnhutte-core' ) => '',
								esc_html__( 'Below 1366px', 'diefinnhutte-core' ) => '1366',
								esc_html__( 'Below 1024px', 'diefinnhutte-core' ) => '1024',
								esc_html__( 'Below 768px', 'diefinnhutte-core' )  => '768',
								esc_html__( 'Below 680px', 'diefinnhutte-core' )  => '680',
								esc_html__( 'Below 480px', 'diefinnhutte-core' )  => '480'
							),
							'description' => esc_html__( 'Choose on which stage item will be in one column', 'diefinnhutte-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'num_bg',
							'heading'    => esc_html__( 'Number Background', 'diefinnhutte-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'line_color',
							'heading'    => esc_html__( 'Arrow color', 'diefinnhutte-core' ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'         => '',
			'number_of_columns'    => 'three',
			'switch_to_one_column' => '',
			'num_bg'               => '',
			'line_color'           => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']  = $this->getHolderClasses( $params, $args );
		$params['number_of_items'] = $this->getNumberOfItems( $params['number_of_columns'] );
		$params['content']         = $content;
		$params['num_styles']     = $this->getNumberStyles( $params );
		$params['arrow_styles']   = $this->getArrowStyles( $params );
		
		$html = diefinnhutte_core_get_shortcode_module_template_part( 'templates/process-template', 'process', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['switch_to_one_column'] ) ? 'qodef-responsive-' . $params['switch_to_one_column'] : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getNumberStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['num_bg'] ) ) {
			$styles[] = 'background-color: ' . $params['num_bg'];
		}

		return implode( ';', $styles );
	}

	private function getArrowStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['line_color'] ) ) {
			$styles[] = 'color: ' . $params['line_color'];
		}

		return implode( ';', $styles );
	}
	
	private function getNumberOfItems( $params ) {
		$number = 3;
		
		switch ($params) {
			case 'two':
				$number = 2;
				break;
			case 'three':
				$number = 3;
				break;
			case 'four':
				$number = 4;
				break;
		}
		
		return $number;
	}
}
