<?php
namespace DieFinnhutteCore\CPT\Shortcodes\Process;

use DieFinnhutteCore\Lib;

class ProcessItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_process_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Process Item', 'diefinnhutte-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
					'icon'     => 'icon-wpb-process-item extended-custom-icon',
					'as_child' => array( 'only' => 'qodef_process' ),
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Select image from media library', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_top_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'     => '',
			'image'            => '',
			'title'            => '',
			'title_tag'        => 'h4',
			'title_color'      => '',
			'text'             => '',
			'text_color'       => '',
			'text_top_margin'  => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['text_styles']    = $this->getTextStyles( $params );
		$params['image']          = $this->getImage( $params );
		
		$html = diefinnhutte_core_get_shortcode_module_template_part( 'templates/process-item-template', 'process', '', $params );
		
		return $html;
	}

	private function getImage( $params ) {
		$image = array();

		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];

			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}

		return $image;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . diefinnhutte_select_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}
