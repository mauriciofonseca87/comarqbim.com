<?php

namespace DieFinnhutteCore\CPT\Shortcodes\HorizontalTimeline;

use DieFinnhutteCore\Lib;

class HorizontalTimelineItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_horizontal_timeline_item';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Horizontal Timeline Item', 'diefinnhutte-core' ),
					'base'            => $this->base,
					'category'        => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
                    'as_child'        => array( 'only' => 'qodef_horizontal_timeline' ),
					'icon'            => 'icon-wpb-horizontal-timeline-item extended-custom-icon',
                    'as_parent'               => array( 'except' => 'vc_row' ),
                    'show_settings_on_create' => true,
                    'params'                  => array(
                        array(
                            'type'       => 'attach_image',
                            'param_name' => 'content_image',
                            'heading'    => esc_html__( 'Timeline Event Image', 'diefinnhutte-core' )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Timeline Event Title', 'diefinnhutte-core' ),
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'subtitle',
                            'heading'     => esc_html__( 'Timeline Event Subtitle', 'diefinnhutte-core' ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'custom_date',
							'heading'    => esc_html__( 'Timeline Event Date', 'diefinnhutte-core' ),
						),
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args = array(
			'title'         => '',
			'subtitle'      => '',
			'custom_date'   => '',
			'content_image' => ''
		);
		$params       = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['content']        = $content;
		
		$html = diefinnhutte_core_get_shortcode_module_template_part( 'templates/horizontal-timeline-item', 'horizontal-timeline', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['content_image'] ) ? 'qodef-timeline-has-image' : 'qodef-timeline-no-image';
		
		return implode( ' ', $holderClasses );
	}
}