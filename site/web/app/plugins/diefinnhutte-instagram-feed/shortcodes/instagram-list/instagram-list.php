<?php

namespace DieFinnhutteInstagram\Shortcodes\InstagramList;

use DieFinnhutteInstagram\Lib;


class InstagramList implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct()
    {
        $this->base = 'qodef_instagram_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Select Instagram List', 'diefinnhutte-instagram-feed'),
                    'base' => $this->base,
                    'category' => esc_html__('by DIEFINNHUTTE', 'diefinnhutte-instagram-feed'),
                    'icon' => 'icon-wpb-instagram-list extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'number_of_columns',
                            'heading' => esc_html__('Number of Columns', 'diefinnhutte-instagram-feed'),
                            'value' => array_flip(diefinnhutte_select_get_number_of_columns_array(false, array('one', 'six'))),
                            'save_always' => true
                        ),
                        array(
                            'param_name' => 'type',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Type', 'diefinnhutte-instagram-feed'),
                            'value' => array(
                                esc_html__( 'Gallery', 'diefinnhutte-instagram-feed') => 'gallery',
                                esc_html__( 'Carousel', 'diefinnhutte-instagram-feed') => 'carousel'
                            )
                        ),
                        array(
                            'param_name' => 'space_between_columns',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Space Between Items', 'diefinnhutte-instagram-feed'),
                            'value' => array_flip(diefinnhutte_select_get_space_between_items_array())
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'number_of_photos',
                            'heading' => esc_html__('Number of Photos', 'diefinnhutte-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'transient_time',
                            'heading' => esc_html__('Images Cache Time', 'diefinnhutte-instagram-feed'),
                            'value' => '10800',
                            'save_always' => true,
                        ),

                        array(
                            'param_name' => 'show_instagram_icon',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Show Instagram Icon', 'diefinnhutte-instagram-feed'),
                            'value' => array_flip(diefinnhutte_select_get_yes_no_select_array(false)),
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_loop',
                            'heading' => esc_html__('Enable Slider Loop', 'diefinnhutte-instagram-feed'),
                            'value' => array_flip(diefinnhutte_select_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'diefinnhutte-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_autoplay',
                            'heading' => esc_html__('Enable Slider Autoplay', 'diefinnhutte-instagram-feed'),
                            'value' => array_flip(diefinnhutte_select_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'diefinnhutte-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'slider_speed',
                            'heading' => esc_html__('Slide Duration', 'diefinnhutte-instagram-feed'),
                            'description' => esc_html__('Default value is 5000 (ms)', 'diefinnhutte-instagram-feed'),
                            'group' => esc_html__('Slider Settings', 'diefinnhutte-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'slider_speed_animation',
                            'heading' => esc_html__('Slide Animation Duration', 'diefinnhutte-instagram-feed'),
                            'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'diefinnhutte-instagram-feed'),
                            'group' => esc_html__('Slider Settings', 'diefinnhutte-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_navigation',
                            'heading' => esc_html__('Enable Slider Navigation Arrows', 'diefinnhutte-instagram-feed'),
                            'value' => array_flip(diefinnhutte_select_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'diefinnhutte-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_pagination',
                            'heading' => esc_html__('Enable Slider Pagination', 'diefinnhutte-instagram-feed'),
                            'value' => array_flip(diefinnhutte_select_get_yes_no_select_array(false, false)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'diefinnhutte-instagram-feed')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null)
    {
        $args = array(
            'number_of_columns' => '3',
            'space_between_columns' => 'normal',
            'number_of_photos' => '',
            'transient_time' => '',
            'show_instagram_icon' => 'no',
            'type' => 'gallery',
            'slider_loop' => 'yes',
            'slider_autoplay' => 'yes',
            'slider_speed' => '5000',
            'slider_speed_animation' => '600',
            'slider_navigation' => 'yes',
            'slider_pagination' => 'no'
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['carousel_classes'] = $this->getCarouselClasses($params);

        $instagram_api = new \DieFinnhutteInstagramApi();
        $params['instagram_api'] = $instagram_api;

        $images_array = $instagram_api->getImages($params['number_of_photos'], array(
            'use_transients' => true,
            'transient_name' => '_diefinnhutte_instagram_api_transient_name',
            'transient_time' => $params['transient_time']
        ));

        $params['images_array'] = $images_array;
        $params['data_attr'] = $this->getSliderData($params);

        //Get HTML from template based on type of team
        $html = diefinnhutte_instagram_get_shortcode_module_template_part('templates/holder', 'instagram-list', '', $params);

        return $html;
    }

    public function getHolderClasses($params)
    {
        $holderClasses = array();

        $holderClasses[] = $this->getColumnNumberClass($params['number_of_columns']);
        $holderClasses[] = !empty($params['space_between_columns']) ? 'qodef-' . $params['space_between_columns'] . '-space' : 'qodef-il-normal-space';

        return implode(' ', $holderClasses);
    }


    public function getCarouselClasses($params)
    {
        $carouselClasses = array();

        if ($params['type'] === 'carousel') {
            $carouselClasses = 'qodef-instagram-carousel qodef-owl-slider';

        } else if ($params['type'] == 'gallery') {
            $carouselClasses = 'qodef-instagram-gallery';
        }

        return $carouselClasses;
    }


    public function getColumnNumberClass($params)
    {
        switch ($params) {
            case 'one':
                $classes = 'qodef-il-one-column';
                break;
            case 'two':
                $classes = 'qodef-il-two-columns';
                break;
            case 'three':
                $classes = 'qodef-il-three-columns';
                break;
            case 'four':
                $classes = 'qodef-il-four-columns';
                break;
            case 'five':
                $classes = 'qodef-il-five-columns';
                break;
            default:
                $classes = 'qodef-il-three-columns';
                break;
        }

        return $classes;
    }

    private function getSliderData($params)
    {
        $slider_data = array();

        $slider_data['data-number-of-items'] = $params['number_of_columns'];
        $slider_data['data-enable-loop'] = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay'] = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed'] = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $slider_data;
    }
}