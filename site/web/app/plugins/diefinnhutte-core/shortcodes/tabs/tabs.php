<?php
namespace DieFinnhutteCore\CPT\Shortcodes\Tabs;

use DieFinnhutteCore\Lib;

class Tabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_tabs';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Tabs', 'diefinnhutte-core' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'only' => 'qodef_tabs_item' ),
					'content_element' => true,
					'category'        => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
					'icon'            => 'icon-wpb-tabs extended-custom-icon',
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
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'diefinnhutte-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'diefinnhutte-core' ) => 'standard',
								esc_html__( 'Boxed', 'diefinnhutte-core' )    => 'boxed',
								esc_html__( 'Simple', 'diefinnhutte-core' )   => 'simple',
								esc_html__( 'Vertical', 'diefinnhutte-core' ) => 'vertical'
							),
							'save_always' => true
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'skin',
                            'heading'    => esc_html__( 'Skin', 'diefinnhutte-core' ),
                            'value'      => array(
                                esc_html__( 'Default', 'diefinnhutte-core' ) => '',
                                esc_html__( 'White', 'diefinnhutte-core' )   => 'white'
                            ),
                        )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class' => '',
			'type'         => 'standard',
            'skin'            => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		// Extract tab titles
		preg_match_all( '/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		
		/**
		 * get tab titles array
		 */
		if ( isset( $matches[0] ) ) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach ( $tab_titles as $tab ) {
			preg_match( '/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = diefinnhutte_core_get_shortcode_module_template_part( 'templates/tab-template', 'tabs', '', $params );
		
		return $output;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['skin'] ) ? 'qodef-tabs-' . esc_attr( $params['skin'] ) . '-skin' : '';
        $holderClasses[] = ! empty( $params['type'] ) ? 'qodef-tabs-' . esc_attr( $params['type'] ) : 'qodef-tabs-standard';
		
		return implode( ' ', $holderClasses );
	}
}