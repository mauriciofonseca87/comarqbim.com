<?php
namespace DieFinnhutteCore\CPT\Shortcodes\CrossfadeImages;

use DieFinnhutteCore\Lib;

class CrossfadeImages implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
	private $base; 
	
    /**
     * CrossfadeImages constructor.
     */
	public function __construct() {
		$this->base = 'qodef_crossfade_images';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
		* Returns base for shortcode
		* @return string
	 */
	public function getBase() {
		return $this->base;
	}	
    
	public function vcMap() {
						
		vc_map( array(
			'name' => 'Crossfade Images',
			'base' => $this->getBase(),
			'category' => esc_html__('by DIEFINNHUTTE', 'diefinnhutte-core'),
			'icon' => 'icon-wpb-crossfade-images extended-custom-icon',
			'params' =>	array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Initial Image', 'diefinnhutte-core'),
                    'param_name' => 'initial_image'
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Hover Image', 'diefinnhutte-core'),
                    'param_name' => 'hover_image'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'diefinnhutte-core'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Link', 'diefinnhutte-core'),
                    'param_name'  => 'link',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Link target', 'diefinnhutte-core'),
                    'param_name'  => 'link_target',
                    'description' => '',
                    'value'       => array(
                        esc_html__('New Window', 'diefinnhutte-core') => '_blank',
                        esc_html__('Same Window', 'diefinnhutte-core')  => '_self'
                    ),
                    'save_always' => true,
                    'dependency' => array( 'element' => 'link', 'not_empty' => true )
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Background Color', 'diefinnhutte-core'),
                    'param_name'  => 'background_color',
                    'group'       => 'Design Options'
                ),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'featured_item',
					'heading'     => esc_html__( 'Featured Item', 'diefinnhutte-core' ),
					'value'       => array_flip( diefinnhutte_select_get_yes_no_select_array( false, false ) ),
					'save_always' => true,
					'group'       => 'Design Options'
				),
            )
		) );

	}

	public function render($atts, $content = null) {
		
		$args = array(
            'initial_image' => '',
            'hover_image'   => '',
            'title'         => '',
            'link'          => '',
            'link_target'   => '',
            'background_color' => '',
            'featured_item'    => '',
        );

        $params = shortcode_atts($args, $atts);

        extract($params);

		$params['additional_classes']  = $this->getAdditionalClasses( $params );
		$params['holder_styles']  = $this->getHolderStyles( $params );

        return diefinnhutte_core_get_shortcode_module_template_part('templates/crossfade-images-template', 'crossfade-images', '', $params);
    }

	private function getAdditionalClasses( $params ) {
		$additionalClasses = array();

		if ( $params['featured_item'] === 'yes' ) {
			$additionalClasses[] = 'featured-item';
		}

		$additionalClasses[] = 'qodef-crossfade-images';

		return $additionalClasses;
	}

	private function getHolderStyles( $params ) {
		$styles = array();

		if ( $params['background_color'] !== '' ) {
			$styles[] = 'background-color:'.$params['background_color'];
		}

		return implode( ' ', $styles );
	}
}