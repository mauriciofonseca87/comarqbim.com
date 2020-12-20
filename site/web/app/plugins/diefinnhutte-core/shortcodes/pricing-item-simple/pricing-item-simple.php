<?php
namespace DieFinnhutteCore\CPT\Shortcodes\PricingItemSimple;

use DieFinnhutteCore\Lib;

class PricingItemSimple implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'qodef_pricing_item_simple';

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                      => esc_html__( 'Pricing Item Simple', 'diefinnhutte-core' ),
                    'base'                      => $this->base,
                    'category'                  => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
                    'icon'                      => 'icon-wpb-pricing-item-simple extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'custom_class',
                            'heading'     => esc_html__('Custom CSS Class', 'diefinnhutte-core'),
                            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'innovio-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title',
                            'heading'     => esc_html__('Title', 'diefinnhutte-core'),
                            'value'       => esc_html__('Basic Plan', 'diefinnhutte-core'),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_color',
                            'heading'    => esc_html__('Title Color', 'diefinnhutte-core'),
                            'dependency' => array('element' => 'title', 'not_empty' => true)
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'additional_title',
                            'heading'     => esc_html__('Additional Title', 'diefinnhutte-core'),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'additional_title_color',
                            'heading'    => esc_html__('Additional Title Color', 'diefinnhutte-core'),
                            'dependency' => array('element' => 'additional_title', 'not_empty' => true)
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'price',
                            'heading'    => esc_html__('Price', 'diefinnhutte-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'price_color',
                            'heading'    => esc_html__('Price Color', 'diefinnhutte-core'),
                            'dependency' => array('element' => 'price', 'not_empty' => true)
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'currency',
                            'heading'    => esc_html__('Currency', 'diefinnhutte-core'),
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'currency_color',
                            'heading'    => esc_html__('Currency Color', 'diefinnhutte-core'),
                            'dependency' => array('element' => 'currency', 'not_empty' => true)
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'button_text',
                            'heading'     => esc_html__('Button Text', 'diefinnhutte-core'),
                            'save_always' => true,
                            'group'      => esc_html__('Button', 'diefinnhutte-core')
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link',
                            'heading'    => esc_html__('Button Link', 'diefinnhutte-core'),
                            'dependency' => array('element' => 'button_text', 'not_empty' => true),
                            'group'      => esc_html__('Button', 'diefinnhutte-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_color',
                            'heading'    => esc_html__('Button Color', 'diefinnhutte-core'),
                            'dependency'  => array('element' => 'button_text', 'not_empty' => true),
                            'group'      => esc_html__('Button', 'diefinnhutte-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_background_color',
                            'heading'    => esc_html__('Button Background Color', 'diefinnhutte-core'),
                            'dependency'  => array('element' => 'button_text', 'not_empty' => true),
                            'group'      => esc_html__('Button', 'diefinnhutte-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_border_color',
                            'heading'    => esc_html__('Button Border Color', 'diefinnhutte-core'),
                            'dependency'  => array('element' => 'button_text', 'not_empty' => true),
                            'group'      => esc_html__('Button', 'diefinnhutte-core')
                        ),
                        array(
                            'type'       => 'textarea_html',
                            'param_name' => 'content',
                            'heading'    => esc_html__('Content', 'diefinnhutte-core'),
                            'value'      => '<li>content content content</li><li>content content content</li><li>content content content</li>'
                        )
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
            'custom_class'                  => '',
            'title'                         => '',
            'title_color'                   => '',
            'additional_title'              => '',
            'additional_title_color'        => '',
            'price'                         => '100',
            'price_color'                   => '',
            'currency'                      => '',
            'currency_color'                => '',
            'button_text'                   => '',
            'link'                          => '',
            'button_type'                   => 'solid',
            'button_color'                  => '',
            'button_background_color'       => '',
            'button_border_color'           => '',
        );
        $params = shortcode_atts( $args, $atts );

        $params['content'] = preg_replace('#^<\/p>|<p>$#', '', $content); // delete p tag before and after content
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['additional_title_styles'] = $this->getAdditionalTitleStyles($params);
        $params['price_styles'] = $this->getPriceStyles($params);
        $params['currency_styles'] = $this->getCurrencyStyles($params);
        $params['button_type'] = $args['button_type'];

        $html = diefinnhutte_core_get_shortcode_module_template_part( 'templates/pricing-item-simple', 'pricing-item-simple', '', $params );

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';

        return implode(' ', $holderClasses);
    }

    private function getTitleStyles($params) {
        $itemStyle = array();

        if (!empty($params['title_color'])) {
            $itemStyle[] = 'color: ' . $params['title_color'];
        }

        return implode(';', $itemStyle);
    }

    private function getAdditionalTitleStyles($params) {
        $itemStyle = array();

        if (!empty($params['additional_title_color'])) {
            $itemStyle[] = 'color: ' . $params['additional_title_color'];
        }

        return implode(';', $itemStyle);
    }

    private function getPriceStyles($params) {
        $itemStyle = array();

        if (!empty($params['price_color'])) {
            $itemStyle[] = 'color: ' . $params['price_color'];
        }

        return implode(';', $itemStyle);
    }

    private function getCurrencyStyles($params) {
        $itemStyle = array();

        if (!empty($params['currency_color'])) {
            $itemStyle[] = 'color: ' . $params['currency_color'];
        }

        return implode(';', $itemStyle);
    }
}