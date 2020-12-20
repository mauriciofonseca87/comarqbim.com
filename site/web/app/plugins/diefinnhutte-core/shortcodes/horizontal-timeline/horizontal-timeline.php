<?php
namespace DieFinnhutteCore\CPT\Shortcodes\HorizontalTimeline;

use DieFinnhutteCore\Lib;

class HorizontalTimeline implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_horizontal_timeline';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Horizontal Timeline', 'diefinnhutte-core' ),
					'base'                    => $this->base,
					'category'                => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
					'icon'                    => 'icon-wpb-horizontal-timeline extended-custom-icon',
					'as_parent'               => array( 'only' => 'qodef_horizontal_timeline_item' ),
					'js_view'                 => 'VcColumnView',
					'content_element'         => true,
					'show_settings_on_create' => false,
					'params'                  => array(
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'skin',
                            'heading'     => esc_html__( 'Skin', 'diefinnhutte-core' ),
                            'value'       => array(
                                esc_html__( 'Default', 'diefinnhutte-core' ) => '',
                                esc_html__( 'Light', 'diefinnhutte-core' )   => 'light',
                            ),
                            'save_always' => true
                        ),
					)
				)
			);
		}
	}
	
	/**
	 * Renders HTML for product list shortcode
	 *
	 * @param array $atts
	 * @param null  $content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {
		$args   = array(
            'skin' => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content'] = $content;
        $params['holder_classes'] = $this->getHolderClasses( $params );
		
		$html = diefinnhutte_core_get_shortcode_module_template_part( 'templates/horizontal-timeline-holder', 'horizontal-timeline', '', $params );
		
		return $html;
	}

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['skin'] ) ? 'qodef-ht-' . $params['skin'] : '';

        return implode( ' ', $holderClasses );
    }
}