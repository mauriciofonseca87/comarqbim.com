<?php
namespace DieFinnhutteCore\CPT\Shortcodes\ClientsCarouselItem;

use DieFinnhutteCore\Lib;

class ClientsCarouselItem implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_clients_carousel_item';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Clients Item', 'diefinnhutte-core' ),
					'base'                    => $this->getBase(),
					'category'                => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
					'icon'                    => 'icon-wpb-clients-carousel-item extended-custom-icon',
					'as_child'                => array( 'only' => 'qodef_clients_carousel' ),
					'as_parent'               => array( 'except' => 'vc_row' ),
					'show_settings_on_create' => true,
					'params'                  => array(
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Select image from media library', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'hover_image',
							'heading'     => esc_html__( 'Hover Image', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Select image from media library', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'border_bottom',
							'heading'    => esc_html__( 'Show Bottom Border', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false , true ) )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'border_bottom_color',
							'heading'    => esc_html__( 'Set bottom border color', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'border_bottom', 'value' => 'yes')
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'border_right',
							'heading'    => esc_html__( 'Show Right Border', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false , true ) )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'border_right_color',
							'heading'    => esc_html__( 'Set right border color', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'border_right', 'value' => 'yes')
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Custom Link', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'target',
							'heading'     => esc_html__( 'Custom Link Target', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_link_target_array() ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'image'        => '',
			'hover_image'  => '',
			'image_size'   => 'full',
			'link'         => '',
			'target'       => '_self',
			'border_bottom'=> 'yes',
			'border_bottom_color' => '#e1e1e1',
			'border_right'        => 'yes',
			'border_right_color'  => '#e1e1e1',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['image']          = $this->getCarouselImage( $params );
		$params['hover_image']    = $this->getCarouselHoverImage( $params );
		$params['holder_styles']   = $this->getHolderStyles( $params );
		$params['target']         = ! empty( $params['target'] ) ? $params['target'] : $args['target'];
		
		$html = diefinnhutte_core_get_shortcode_module_template_part( 'templates/clients-carousel-item', 'clients-carousel', '', $params );
		
		return $html;
	}

	private function getHolderStyles($params) {
		$styles = array();

		if ( $params['border_bottom_color'] !== '' && $params['border_bottom'] === 'yes' ) {
			$styles[] = 'border-bottom: 1px solid ' .  $params['border_bottom_color'] ;
		}

		if ( $params['border_right_color'] !== '' && $params['border_right'] === 'yes' ) {
			$styles[] = 'border-right: 1px solid ' .  $params['border_right_color'] ;
		}

		return implode( ';', $styles );
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['link'] ) ? 'qodef-cci-has-link' : 'qodef-cci-no-link';

		return implode( ' ', $holderClasses );
	}
	
	private function getCarouselImage( $params ) {
		$image_meta = array();
		
		if ( ! empty( $params['image'] ) ) {
            $image_size  = $this->getCarouselImageSize( $params['image_size'] );
			$image_id       = $params['image'];
			$image_original = wp_get_attachment_image_src( $image_id, $image_size );
			$image['url']   = $image_original[0];
			$image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			
			$image_meta = $image;
		}
		
		return $image_meta;
	}
	
	private function getCarouselHoverImage( $params ) {
		$image_meta = array();
		
		if ( ! empty( $params['hover_image'] ) ) {
            $image_size  = $this->getCarouselImageSize( $params['image_size'] );
			$image_id       = $params['hover_image'];
			$image_original = wp_get_attachment_image_src( $image_id, $image_size );
			$image['url']   = $image_original[0];
			$image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			
			$image_meta = $image;
		}
		
		return $image_meta;
	}
	
	private function getCarouselImageSize( $image_size ) {
		$image_size = trim( $image_size );
		
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'full';
		}
	}
}