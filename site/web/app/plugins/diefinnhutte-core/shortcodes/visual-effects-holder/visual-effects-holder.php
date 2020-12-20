<?php
namespace DieFinnhutteCore\CPT\Shortcodes\VisualEffectsHolder;

use DieFinnhutteCore\Lib;

class VisualEffectsHolder implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_visual_effects_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Visual Effects Holder', 'diefinnhutte-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
					'icon'                      => 'icon-wpb-visual-effects-holder extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
					'as_parent' => array('except' => ''),
					'js_view' => 'VcColumnView',
					'params' => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'uncover_effect_type',
							'heading'     => esc_html__( 'Uncover Effect Type', 'diefinnhutte-core' ),
							'value'       => array(
								esc_html__( 'Uncover From Top', 'diefinnhutte-core' )	=> 'from-top',
								esc_html__( 'Uncover From Right', 'diefinnhutte-core' )	=> 'from-right',
								esc_html__( 'Uncover From Bottom', 'diefinnhutte-core' )	=> 'from-bottom',
								esc_html__( 'Uncover From Left', 'diefinnhutte-core' )	=> 'from-left',
							),
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'mask_color',
							'heading'    => esc_html__( 'Mask Color', 'diefinnhutte-core' ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'diefinnhutte-core' ),
						),
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
	
		$args = array(
			'effect_type' => 'uncover',
			'uncover_effect_type' => 'from-top',
			'mask_color' => '',
			'animation_delay' => '',
		);
		$params = shortcode_atts($args, $atts);

		$params = shortcode_atts( $args, $atts );
		
		$params['content']           = $content;
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['mask_styles']       = $this->getMaskStyles( $params );
		$params['holder_data']       = $this->getHolderData( $params );
		
		$html = diefinnhutte_core_get_shortcode_module_template_part( 'templates/visual-effects-holder-template', 'visual-effects-holder', '', $params );
		
		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array('');
		
		$holderClasses[] = !empty( $params['effect_type'] ) ? 'qodef-veh-' . esc_attr( $params['effect_type'] ) : '';
		$holderClasses[] = ( $params['effect_type'] == 'uncover' && !empty( $params['uncover_effect_type'] ) ) ? 'qodef-veh-' . $params['uncover_effect_type'] : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getMaskStyles( $params ) {
		$styles = array();
		
		if ( $params['effect_type'] == 'uncover' && !empty( $params['mask_color'] ) ) {
			$styles[] = 'background-color: ' . $params['mask_color'];
		}
		
		return implode( ';', $styles );
	}

	private function getHolderData( $params ) {
		$data = array();
 
		if ( $params['effect_type'] == 'uncover' && !empty( $params['animation_delay'] ) ) {
			$data['data-animation-delay'] = $params['animation_delay'];
		}
		
		return $data;
	}
}