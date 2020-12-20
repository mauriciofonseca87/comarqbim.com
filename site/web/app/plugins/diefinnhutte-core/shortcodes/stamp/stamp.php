<?php
namespace DieFinnhutteCore\CPT\Shortcodes\Stamp;

use DieFinnhutteCore\Lib;

class Stamp implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'qodef_stamp';

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                      => esc_html__( 'Stamp', 'diefinnhutte-core' ),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
                    'icon'                      => 'icon-wpb-stamp extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'custom_class',
                            'heading'     => esc_html__( 'Custom CSS Class', 'diefinnhutte-core' ),
                            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'diefinnhutte-core' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'text',
                            'heading'    => esc_html__( 'Stamp Text', 'diefinnhutte-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'text_color',
                            'heading'    => esc_html__( 'Text Color', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'text', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'text_font_size',
                            'heading'    => esc_html__( 'Text Font Size (px)', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'text', 'not_empty' => true )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'stamp_size',
                            'heading'     => esc_html__( 'Stamp Size (px)', 'diefinnhutte-core' ),
                            'description' => esc_html__( 'Default value is 114', 'diefinnhutte-core' ),
                            'dependency'  => array( 'element' => 'text', 'not_empty' => true )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'disable_stamp',
                            'heading'     => esc_html__( 'Disable Stamp', 'diefinnhutte-core' ),
                            'description' => esc_html__( 'Choose on which stage you will hide stamp shortcode', 'diefinnhutte-core' ),
                            'value'       => array(
                                esc_html__( 'Never', 'diefinnhutte-core' )        => '',
                                esc_html__( 'Below 1440px', 'diefinnhutte-core' ) => '1440',
                                esc_html__( 'Below 1280px', 'diefinnhutte-core' ) => '1280',
                                esc_html__( 'Below 1024px', 'diefinnhutte-core' ) => '1024',
                                esc_html__( 'Below 768px', 'diefinnhutte-core' )  => '768',
                                esc_html__( 'Below 680px', 'diefinnhutte-core' )  => '680',
                                esc_html__( 'Below 480px', 'diefinnhutte-core' )  => '480'
                            ),
                            'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
                            'group'       => esc_html__( 'Visibility', 'diefinnhutte-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'appearing_delay',
                            'heading'     => esc_html__( 'Appearing Delay (ms)', 'diefinnhutte-core' ),
                            'description' => esc_html__( 'Default value is 0', 'diefinnhutte-core' ),
                            'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
                            'group'       => esc_html__( 'Visibility', 'diefinnhutte-core' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'absolute_position',
                            'heading'    => esc_html__( 'Enable Absolute Position', 'diefinnhutte-core' ),
                            'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
                            'dependency' => array( 'element' => 'text', 'not_empty' => true ),
                            'group'      => esc_html__( 'Visibility', 'diefinnhutte-core' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'top_position',
                            'heading'    => esc_html__( 'Top Position (px or %)', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'absolute_position', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Visibility', 'diefinnhutte-core' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'left_position',
                            'heading'    => esc_html__( 'Left Position (px or %)', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'absolute_position', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Visibility', 'diefinnhutte-core' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'right_position',
                            'heading'    => esc_html__( 'Right Position (px or %)', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'absolute_position', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Visibility', 'diefinnhutte-core' )
                        )
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
            'custom_class'      => '',
            'text'              => '',
            'text_color'        => '',
            'text_font_size'    => '',
            'stamp_size'        => '',
            'disable_stamp'     => '',
            'appearing_delay'   => '0',
            'absolute_position' => 'no',
            'top_position'      => '',
            'left_position'     => '',
            'right_position'    => ''
        );
        $params = shortcode_atts( $args, $atts );

        $params['holder_classes'] = $this->getHolderClasses( $params );
        $params['holder_styles']  = $this->getHolderStyles( $params );
        $params['holder_data']    = $this->getHolderData( $params );
        $params['text_data']      = $this->getModifiedText( $params );

        $html = diefinnhutte_core_get_shortcode_module_template_part( 'templates/stamp', 'stamp', '', $params );

        return $html;
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['disable_stamp'] ) ? 'qodef-hide-on-' . esc_attr( $params['disable_stamp'] ) : '';
        $holderClasses[] = $params['absolute_position'] === 'yes' ? 'qodef-abs' : '';

        return implode( ' ', $holderClasses );
    }

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['text_color'] ) ) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        if ( ! empty( $params['text_font_size'] ) ) {
            $styles[] = 'font-size: ' . diefinnhutte_select_filter_px( $params['text_font_size'] ) . 'px';
        }

        if ( ! empty( $params['stamp_size'] ) ) {
            $styles[] = 'width: ' . diefinnhutte_select_filter_px( $params['stamp_size'] ) . 'px';
            $styles[] = 'height: ' . diefinnhutte_select_filter_px( $params['stamp_size'] ) . 'px';
        }

        if ( $params['top_position'] !== '' ) {
            $styles[] = 'top: ' . $params['top_position'];
        }

        if ( $params['left_position'] !== '' ) {
            $styles[] = 'left: ' . $params['left_position'];
        }

        if ( $params['right_position'] !== '' ) {
            $styles[] = 'right: ' . $params['right_position'];
        }

        return implode( ';', $styles );
    }

    private function getHolderData( $params ) {
        $slider_data = array();

        $slider_data['data-appearing-delay'] = ! empty( $params['appearing_delay'] ) ? intval( $params['appearing_delay'] ) : 0;

        return $slider_data;
    }

    private function getModifiedText( $params ) {
        $text = $params['text'];
        $data = array(
            'text'  => diefinnhutte_select_get_split_text( $text ),
            'count' => count( diefinnhutte_select_str_split_unicode( $text ) )
        );

        return $data;
    }
}