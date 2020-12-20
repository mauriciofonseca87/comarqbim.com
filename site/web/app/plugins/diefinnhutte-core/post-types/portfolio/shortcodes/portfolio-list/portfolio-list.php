<?php

namespace DieFinnhutteCore\CPT\Shortcodes\Portfolio;

use DieFinnhutteCore\Lib;

class PortfolioList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_portfolio_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Portfolio category filter
		add_filter( 'vc_autocomplete_qodef_portfolio_list_category_callback', array( &$this, 'portfolioCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio category render
		add_filter( 'vc_autocomplete_qodef_portfolio_list_category_render', array( &$this, 'portfolioCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio selected projects filter
		add_filter( 'vc_autocomplete_qodef_portfolio_list_selected_projects_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio selected projects render
		add_filter( 'vc_autocomplete_qodef_portfolio_list_selected_projects_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)
		
		//Portfolio tag filter
		add_filter( 'vc_autocomplete_qodef_portfolio_list_tag_callback', array( &$this, 'portfolioTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio tag render
		add_filter( 'vc_autocomplete_qodef_portfolio_list_tag_render', array( &$this, 'portfolioTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Portfolio List', 'diefinnhutte-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte-core' ),
					'icon'     => 'icon-wpb-portfolio extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Portfolio List Template', 'diefinnhutte-core' ),
							'value'       => array(
								esc_html__( 'Gallery', 'diefinnhutte-core' ) => 'gallery',
								esc_html__( 'Masonry', 'diefinnhutte-core' ) => 'masonry',
                                esc_html__('Vertical Showcase', 'diefinnhutte-core') => 'vertical-showcase',
                                esc_html__( 'Justified Gallery', 'diefinnhutte-core' ) => 'justified-gallery',
							),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_type',
							'heading'    => esc_html__( 'Click Behavior', 'diefinnhutte-core' ),
							'value'      => array(
								esc_html__( 'Open portfolio single page on click', 'diefinnhutte-core' )   => '',
								esc_html__( 'Open gallery in Pretty Photo on click', 'diefinnhutte-core' ) => 'gallery'
							)
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'row_height',
                            'heading'     => esc_html__( 'Row Height', 'diefinnhutte-core' ),
                            'description' => esc_html__( 'Targeted row height, which may vary depending on the proportions of the images.', 'diefinnhutte-core' ),
                            'value'       => '',
                            'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery' ) ),
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_number_of_columns_array( true ) ),
							'description' => esc_html__( 'Default value is Three', 'diefinnhutte-core' ),
                            'dependency'  => array('element' => 'type', 'value' => array('gallery', 'masonry'))
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Portfolios Per Page', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Set number of items for your portfolio list. Enter -1 to show all.', 'diefinnhutte-core' ),
							'value'       => '-1'
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_proportions',
							'heading'     => esc_html__( 'Image Proportions', 'diefinnhutte-core' ),
							'value'       => array(
								esc_html__( 'Original', 'diefinnhutte-core' )  => 'full',
								esc_html__( 'Square', 'diefinnhutte-core' )    => 'square',
								esc_html__( 'Landscape', 'diefinnhutte-core' ) => 'landscape',
								esc_html__( 'Portrait', 'diefinnhutte-core' )  => 'portrait',
								esc_html__( 'Medium', 'diefinnhutte-core' )    => 'medium',
								esc_html__( 'Large', 'diefinnhutte-core' )     => 'large'
							),
							'description' => esc_html__( 'Set image proportions for your portfolio list.', 'diefinnhutte-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'gallery' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_fixed_proportions',
							'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Set predefined image proportions for your masonry portfolio list. This option will apply image proportions you set in Portfolio Single page - dimensions for masonry option.', 'diefinnhutte-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Portfolio List', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_projects',
							'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'diefinnhutte-core' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'tag',
							'heading'     => esc_html__( 'One-Tag Portfolio List', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_style',
							'heading'    => esc_html__( 'Item Style', 'diefinnhutte-core' ),
							'value'      => array(
								esc_html__( 'Standard', 'diefinnhutte-core' )                 => 'standard-shader',
								esc_html__( 'Standard - Switch Featured Images', 'diefinnhutte-core' ) => 'standard-switch-images',
								esc_html__( 'Standard - Small Featured Images', 'diefinnhutte-core' ) => 'standard-small-images',
								esc_html__( 'Gallery - Overlay', 'diefinnhutte-core' )                 => 'gallery-overlay',
								esc_html__( 'Gallery - Slide From Image Bottom', 'diefinnhutte-core' ) => 'gallery-slide-from-image-bottom',
								esc_html__( 'Gallery - Slide From Image Right', 'diefinnhutte-core' ) => 'gallery-slide-from-image-right',
							),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' ),
                            'dependency' => array('element' => 'type', 'value' => array('gallery', 'masonry'))
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'skin',
                            'heading'     => esc_html__( 'Skin', 'diefinnhutte-core' ),
                            'value'       => array(
                                esc_html__( 'Default', 'diefinnhutte-core' ) => '',
                                esc_html__( 'Light', 'diefinnhutte-core' )   => 'light',
                            ),
                            'dependency' => array( 'element' => 'item_style', 'value' => array( 'standard-shader', 'standard-switch-images', 'gallery-slide-from-image-bottom' ) ),
                            'save_always' => true,
                            'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' )
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'content_top_margin',
							'heading'    => esc_html__( 'Content Top Margin (px or %)', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'item_style', 'value' => array( 'standard-shader', 'standard-switch-images' ) ),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'content_bottom_margin',
							'heading'    => esc_html__( 'Content Bottom Margin (px or %)', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'item_style', 'value' => array( 'standard-shader', 'standard-switch-images' ) ),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name' => 'text_alignment',
                            'heading'    => esc_html__( 'Content Text Alignment', 'diefinnhutte-core' ),
                            'value'       => array(
                                esc_html__( 'Default', 'diefinnhutte-core' ) => '',
                                esc_html__( 'Left', 'diefinnhutte-core' )    => 'left',
                                esc_html__( 'Center', 'diefinnhutte-core' )  => 'center',
                                esc_html__( 'Right', 'diefinnhutte-core' )   => 'right'
                            ),
                            'save_always' => true,
                            'dependency' => array( 'element' => 'item_style', 'value' => array( 'standard-shader', 'standard-switch-images' ) ),
                            'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' )
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_title',
							'heading'    => esc_html__( 'Enable Title', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' ),
                            'description' => esc_html__( 'Does not apply for Vertical Showcase type', 'diefinnhutte-core' )
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_text_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_category',
							'heading'    => esc_html__( 'Enable Category', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_count_images',
							'heading'    => esc_html__( 'Enable Number of Images', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false, true ) ),
							'dependency' => array( 'element' => 'type', 'value' => array( 'gallery' ) ),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_excerpt',
							'heading'    => esc_html__( 'Enable Excerpt', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'item_style', 'value' => array( 'standard-shader', 'standard-switch-images', 'gallery-slide-from-image-bottom' ) ),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'diefinnhutte-core' ),
							'description' => esc_html__( 'Number of characters', 'diefinnhutte-core' ),
							'dependency'  => array( 'element' => 'enable_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Content Layout', 'diefinnhutte-core' )
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_link',
                            'heading'    => esc_html__( 'Enable Read More link', 'diefinnhutte-core' ),
                            'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
                            'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'item_style', 'value' => array( 'standard-shader', 'standard-switch-images', 'gallery-slide-from-image-bottom' ) ),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_additional_info',
                            'heading'    => esc_html__( 'Enable Additional Info', 'diefinnhutte-core' ),
                            'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
                            'group'      => esc_html__( 'Content Layout', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'item_style', 'value' => array( 'standard-shader', 'standard-switch-images', 'standard-small-images' ) ),
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'pagination_type',
							'heading'    => esc_html__( 'Pagination Type', 'diefinnhutte-core' ),
							'value'      => array(
								esc_html__( 'None', 'diefinnhutte-core' )            => 'no-pagination',
								esc_html__( 'Standard', 'diefinnhutte-core' )        => 'standard',
								esc_html__( 'Load More', 'diefinnhutte-core' )       => 'load-more',
								esc_html__( 'Infinite Scroll', 'diefinnhutte-core' ) => 'infinite-scroll'
							),
							'group'      => esc_html__( 'Additional Features', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'load_more_top_margin',
							'heading'    => esc_html__( 'Load More Top Margin (px or %)', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'pagination_type', 'value' => array( 'load-more' ) ),
							'group'      => esc_html__( 'Additional Features', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter',
							'heading'    => esc_html__( 'Enable Category Filter', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Additional Features', 'diefinnhutte-core' ),
                            'dependency'  => array( 'element' => 'type', 'value' => array( 'justified-gallery', 'gallery', 'masonry' ) ),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'filter_count',
                            'heading'    => esc_html__( 'Enable Category Filter Count', 'diefinnhutte-core' ),
                            'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
                            'group'      => esc_html__( 'Additional Features', 'diefinnhutte-core' ),
                            'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter_order_by',
							'heading'    => esc_html__( 'Filter Order By', 'diefinnhutte-core' ),
							'value'      => array(
								esc_html__( 'Name', 'diefinnhutte-core' )  => 'name',
								esc_html__( 'Count', 'diefinnhutte-core' ) => 'count',
								esc_html__( 'Id', 'diefinnhutte-core' )    => 'id',
								esc_html__( 'Slug', 'diefinnhutte-core' )  => 'slug'
							),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'diefinnhutte-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'filter_text_transform',
							'heading'    => esc_html__( 'Filter Text Transform', 'diefinnhutte-core' ),
							'value'      => array_flip( diefinnhutte_select_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'diefinnhutte-core' )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name' => 'filter_text_alignment',
                            'heading'    => esc_html__( 'Filter Text Alignment', 'diefinnhutte-core' ),
                            'value'       => array(
                                esc_html__( 'Default', 'diefinnhutte-core' ) => '',
                                esc_html__( 'Left', 'diefinnhutte-core' )    => 'left',
                                esc_html__( 'Center', 'diefinnhutte-core' )  => 'center',
                                esc_html__( 'Right', 'diefinnhutte-core' )   => 'right'
                            ),
                            'save_always' => true,
                            'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Additional Features', 'diefinnhutte-core' )
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'filter_bottom_margin',
							'heading'    => esc_html__( 'Filter Bottom Margin (px or %)', 'diefinnhutte-core' ),
							'dependency' => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Additional Features', 'diefinnhutte-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_article_animation',
							'heading'     => esc_html__( 'Enable Article Animation', 'diefinnhutte-core' ),
							'value'       => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Enabling this option you will enable appears animation for your portfolio list items', 'diefinnhutte-core' ),
							'group'       => esc_html__( 'Additional Features', 'diefinnhutte-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'                     => 'gallery',
			'item_type'                => '',
			'number_of_columns'        => 'three',
			'space_between_items'      => 'normal',
			'number_of_items'          => '-1',
			'image_proportions'        => 'full',
			'enable_fixed_proportions' => 'no',
			'enable_image_shadow'      => 'no',
			'category'                 => '',
			'selected_projects'        => '',
			'tag'                      => '',
			'orderby'                  => 'date',
			'order'                    => 'ASC',
			'item_style'               => 'standard-shader',
			'skin'                     => '',
			'content_top_margin'       => '',
			'content_bottom_margin'    => '',
			'text_alignment'           => '',
			'enable_title'             => 'yes',
			'title_tag'                => 'h4',
			'title_text_transform'     => '',
			'enable_category'          => 'yes',
			'enable_count_images'      => 'yes',
			'enable_excerpt'           => 'no',
			'excerpt_length'           => '20',
            'enable_link'              => 'no',
            'enable_additional_info'   => 'no',
			'pagination_type'          => 'no-pagination',
			'load_more_top_margin'     => '',
			'filter'                   => 'no',
			'filter_count'             => 'no',
			'filter_order_by'          => 'name',
			'filter_text_transform'    => '',
			'filter_text_alignment'    => '',
			'filter_bottom_margin'     => '',
			'enable_article_animation' => 'no',
			'portfolio_slider_on'      => 'no',
            'enable_fullheight'        => 'no',
            'portfolio_slider_full_height_decrease' => '',
			'enable_loop'              => 'yes',
			'enable_mousewheel_scroll' => 'no',
			'enable_autoplay'          => 'yes',
			'slider_speed'             => '5000',
			'slider_speed_animation'   => '600',
			'enable_navigation'        => 'yes',
			'navigation_skin'          => '',
			'enable_pagination'        => 'yes',
			'pagination_skin'          => '',
			'pagination_position'      => '',
            'row_height'      		   => '',
            'item_style_justified'     => 'standard-shader',
		);
		$params = shortcode_atts( $args, $atts );
		
		/***
		 * @params query_results
		 * @params holder_data
		 * @params holder_classes
		 * @params holder_inner_classes
		 */
		$additional_params = array();
		
		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );
		$additional_params['query_results'] = $query_results;

        //if justified gallery type is chosen use item_style_justified as item_style
        if ($params['type'] == 'justified-gallery'){
            $params['item_style'] = $params['item_style_justified'];
        }
		
		$additional_params['holder_data']          = diefinnhutte_select_get_holder_data_for_cpt( $params, $additional_params );
		$additional_params['holder_classes']       = $this->getHolderClasses( $params, $args );
		$additional_params['holder_inner_classes'] = $this->getHolderInnerClasses( $params );
		
		$params['this_object'] = $this;
		
		$html = diefinnhutte_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'portfolio-holder', $params['type'], $params, $additional_params );
		
		return $html;
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'portfolio-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);
		
		if ( ! empty( $params['category'] ) ) {
			$query_array['portfolio-category'] = $params['category'];
		}
		
		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
            $query_array['orderby'] = 'post__in';
			$query_array['post__in'] = $project_ids;
		}
		
		if ( ! empty( $params['tag'] ) ) {
			$query_array['portfolio-tag'] = $params['tag'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['type'] ) ? 'qodef-pl-' . $params['type'] : 'qodef-pl-' . $args['type'];
		$classes[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $args['number_of_columns'] . '-columns';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $args['space_between_items'] . '-space';
		$classes[] = ! empty( $params['item_style'] ) ? 'qodef-pl-' . $params['item_style'] : '';
		$classes[] = $params['enable_fixed_proportions'] === 'yes' ? 'qodef-fixed-masonry-items' : '';
		$classes[] = $params['enable_image_shadow'] === 'yes' ? 'qodef-pl-has-shadow' : '';
		$classes[] = $params['enable_title'] === 'no' && $params['enable_category'] === 'no' && $params['enable_excerpt'] === 'no' && $params['enable_link'] === 'no' && $params['enable_additional_info'] === 'no' ? 'qodef-pl-no-content' : '';
		$classes[] = ! empty( $params['pagination_type'] ) ? 'qodef-pl-pag-' . $params['pagination_type'] : '';
		$classes[] = $params['filter'] === 'yes' ? 'qodef-pl-has-filter' : '';
		$classes[] = $params['enable_article_animation'] === 'yes' ? 'qodef-pl-has-animation' : '';
		$classes[] = ! empty( $params['navigation_skin'] ) ? 'qodef-nav-' . $params['navigation_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_skin'] ) ? 'qodef-pag-' . $params['pagination_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_position'] ) ? 'qodef-pag-' . $params['pagination_position'] : '';
        $classes[] = ! empty( $params['skin'] ) ? 'qodef-pl-' . $params['skin'] : '';
		
		return implode( ' ', $classes );
	}
	
	public function getHolderInnerClasses( $params ) {
		$classes = array();
		
		$classes[] = $params['portfolio_slider_on'] === 'yes' ? 'qodef-owl-slider qodef-list-is-slider' : '';
        if($params['portfolio_slider_on'] === 'yes') {
            if($params['enable_fullheight'] === 'yes') {
                $classes[] = 'qodef-ps-full-height';
            }
        }
		
		return implode( ' ', $classes );
	}

    public function getFilterHolderClasses( $params ) {
        $classes = array();

        $classes[] = $params['type'] === 'justified-gallery' ? 'qodef-pl-justified-filter' : 'qodef-pl-regular-filter';

        return implode( ' ', $classes );
    }
	
	public function getArticleClasses( $params ) {
		$classes = array();
		
		$type       = $params['type'];
		$item_style = $params['item_style'];
		
		if ( get_post_meta( get_the_ID(), "qodef_portfolio_featured_image_meta", true ) !== "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'qodef-pl-has-switch-image';
		} elseif ( get_post_meta( get_the_ID(), "qodef_portfolio_featured_image_meta", true ) === "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'qodef-pl-no-switch-image';
		}
		
		$image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
		$masonry_size     = get_post_meta( get_the_ID(), 'qodef_portfolio_masonry_' . $image_proportion . '_dimensions_meta', true );
		
		$classes[] = ! empty( $masonry_size ) && $type === 'masonry' ? 'qodef-masonry-size-' . esc_attr( $masonry_size ) : '';
		
		$article_classes = get_post_class( $classes );
		
		return implode( ' ', $article_classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) && $params['type'] == 'gallery' ) {
			$image_size = $params['image_proportions'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'diefinnhutte_select_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'diefinnhutte_select_image_portrait';
					break;
				case 'square':
					$thumb_size = 'diefinnhutte_select_image_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}
		
		if ( $params['type'] == 'masonry' && $params['enable_fixed_proportions'] === 'yes' ) {
			$fixed_image_size = get_post_meta( get_the_ID(), 'qodef_portfolio_masonry_fixed_dimensions_meta', true );
			
			switch ( $fixed_image_size ) {
				case 'small' :
					$thumb_size = 'diefinnhutte_select_image_square';
					break;
				case 'large-width':
					$thumb_size = 'diefinnhutte_select_image_landscape';
					break;
				case 'large-height':
					$thumb_size = 'diefinnhutte_select_image_portrait';
					break;
				case 'large-width-height':
					$thumb_size = 'diefinnhutte_select_image_huge';
					break;
				default :
					$thumb_size = 'full';
					break;
			}
		}
		
		return $thumb_size;
	}
	
	public function getStandardContentStyles( $params ) {
		$styles = array();
		
		$margin_top    = isset( $params['content_top_margin'] ) ? $params['content_top_margin'] : '';
		$margin_bottom = isset( $params['content_bottom_margin'] ) ? $params['content_bottom_margin'] : '';
		$text_alignment = isset( $params['text_alignment'] ) ? $params['text_alignment'] : '';

		
		if ( ! empty( $margin_top ) ) {
			if ( diefinnhutte_select_string_ends_with( $margin_top, '%' ) || diefinnhutte_select_string_ends_with( $margin_top, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin_top;
			} else {
				$styles[] = 'margin-top: ' . diefinnhutte_select_filter_px( $margin_top ) . 'px';
			}
		}
		
		if ( ! empty( $margin_bottom ) ) {
			if ( diefinnhutte_select_string_ends_with( $margin_bottom, '%' ) || diefinnhutte_select_string_ends_with( $margin_bottom, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin_bottom;
			} else {
				$styles[] = 'margin-bottom: ' . diefinnhutte_select_filter_px( $margin_bottom ) . 'px';
			}
		}

        if ( ! empty( $text_alignment ) ) {
            $styles[] = 'text-align: ' . $text_alignment;
        }
		
		return implode( ';', $styles );
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_text_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getSwitchFeaturedImage() {
		$featured_image_meta = get_post_meta( get_the_ID(), 'qodef_portfolio_featured_image_meta', true );
		
		$featured_image = ! empty( $featured_image_meta ) ? esc_url( $featured_image_meta ) : '';
		
		return $featured_image;
	}

    public function getSmallFeaturedImage() {
        $small_featured_image_meta = get_post_meta( get_the_ID(), 'qodef_portfolio_small_featured_image_meta', true );

        $small_featured_image = ! empty( $small_featured_image_meta ) ? esc_url( $small_featured_image_meta ) : '';

        return $small_featured_image;
    }

    public function getSmallImagesItemPadding() {
        $small_image_item_padding_meta = get_post_meta( get_the_ID(), 'qodef_portfolio_small_featured_image_padding_meta', true );

        $small_item_padding = ! empty( $small_image_item_padding_meta ) ? $small_image_item_padding_meta : '';

        return $small_item_padding;
    }

    public function getSmallImagesItemPaddingResponsive() {
        $data                    = array();
        $data['data-item-class'] = 'qodef-pi-small-' . mt_rand( 1000, 10000 );
        $small_item_padding_responsive1 = get_post_meta( get_the_ID(), 'qodef_portfolio_small_featured_image_padding_meta_1367_1600', true );
        $small_item_padding_responsive2 = get_post_meta( get_the_ID(), 'qodef_portfolio_small_featured_image_padding_meta_1025_1366', true );
        $small_item_padding_responsive3 = get_post_meta( get_the_ID(), 'qodef_portfolio_small_featured_image_padding_meta_769_1024', true );
        $small_item_padding_responsive4 = get_post_meta( get_the_ID(), 'qodef_portfolio_small_featured_image_padding_meta_681_768', true );
        $small_item_padding_responsive5 = get_post_meta( get_the_ID(), 'qodef_portfolio_small_featured_image_padding_meta_680', true );


        if ( $small_item_padding_responsive1 !== '' ) {
            $data['data-1367-1600'] = $small_item_padding_responsive1;
        }

        if ( $small_item_padding_responsive2 !== '' ) {
            $data['data-1025-1366'] = $small_item_padding_responsive2;
        }

        if ( $small_item_padding_responsive3 !== '' ) {
            $data['data-769-1024'] = $small_item_padding_responsive3;
        }

        if ( $small_item_padding_responsive4 !== '' ) {
            $data['data-681-768'] = $small_item_padding_responsive4;
        }

        if ( $small_item_padding_responsive5 !== '' ) {
            $data['data-680'] = $small_item_padding_responsive5;
        }

        return $data;
    }

    public function getStampText() {
        $stamp_text = get_post_meta( get_the_ID(), 'portfolio_stamp_text', true );

        $stamp_text = ! empty( $stamp_text ) ? $stamp_text : '';

        return $stamp_text;
    }

    public function getAdditionalInfoLabel() {
        $additional_info_label = get_post_meta( get_the_ID(), 'qodef_portfolio_list_additional_info_label', true );

        $additional_info_label = ! empty( $additional_info_label ) ? $additional_info_label : '';

        return $additional_info_label;
    }

    public function getAdditionalInfoValue() {
        $additional_info_value = get_post_meta( get_the_ID(), 'qodef_portfolio_list_additional_info_value', true );

        $additional_info_value = ! empty( $additional_info_value ) ? $additional_info_value : '';

        return $additional_info_value;
    }

    public function getAdditionalInfoLink() {
        $additional_info_link = get_post_meta( get_the_ID(), 'qodef_portfolio_list_additional_info_link', true );

        $additional_info_link = ! empty( $additional_info_link ) ? $additional_info_link : '';

        return $additional_info_link;
    }
	
	public function getLoadMoreStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['load_more_top_margin'] ) ) {
			$margin = $params['load_more_top_margin'];
			
			if ( diefinnhutte_select_string_ends_with( $margin, '%' ) || diefinnhutte_select_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin;
			} else {
				$styles[] = 'margin-top: ' . diefinnhutte_select_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
	
	public function getFilterCategories( $params ) {
		$cat_id = 0;
		
		if ( ! empty( $params['category'] ) ) {
			$top_category = get_term_by( 'slug', $params['category'], 'portfolio-category' );
			
			if ( isset( $top_category->term_id ) ) {
				$cat_id = $top_category->term_id;
			}
		}
		
		$order = $params['filter_order_by'] === 'count' ? 'DESC' : 'ASC';
		
		$args = array(
			'taxonomy' => 'portfolio-category',
			'child_of' => $cat_id,
			'orderby'  => $params['filter_order_by'],
			'order'    => $order
		);
		
		$filter_categories = get_terms( $args );
		
		return $filter_categories;
	}
	
	public function getFilterHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_bottom_margin'] ) ) {
			$margin = $params['filter_bottom_margin'];
			
			if ( diefinnhutte_select_string_ends_with( $margin, '%' ) || diefinnhutte_select_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin;
			} else {
				$styles[] = 'margin-bottom: ' . diefinnhutte_select_filter_px( $margin ) . 'px';
			}
		}

        if ( ! empty( $params['filter_text_alignment'] ) ) {
            $styles[] = 'text-align: ' . $params['filter_text_alignment'];
        }
		
		return implode( ';', $styles );
	}
	
	public function getFilterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_text_transform'] ) ) {
            $styles[] = 'text-transform: ' . $params['filter_text_transform'];
        }
		
		return implode( ';', $styles );
	}
	
	public function getItemLink() {
		$portfolio_link_meta = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link      = ! empty( $portfolio_link_meta ) ? $portfolio_link_meta : get_permalink( get_the_ID() );
		
		return apply_filters( 'diefinnhutte_select_filter_portfolio_external_link', $portfolio_link );
	}
	
	public function getItemLinkTarget() {
		$portfolio_link_meta   = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link_target = ! empty( $portfolio_link_meta ) ? '_blank' : '_self';
		
		return apply_filters( 'diefinnhutte_select_filter_portfolio_external_link_target', $portfolio_link_target );
	}
	
	/**
	 * Filter portfolio categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'diefinnhutte-core' ) . ': ' . $value['portfolio_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
			if ( is_object( $portfolio_category ) ) {
				
				$portfolio_category_slug  = $portfolio_category->slug;
				$portfolio_category_title = $portfolio_category->name;
				
				$portfolio_category_title_display = '';
				if ( ! empty( $portfolio_category_title ) ) {
					$portfolio_category_title_display = esc_html__( 'Category', 'diefinnhutte-core' ) . ': ' . $portfolio_category_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_category_slug;
				$data['label'] = $portfolio_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'diefinnhutte-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'diefinnhutte-core' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {
				
				$portfolio_id    = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;
				
				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'diefinnhutte-core' ) . ': ' . $portfolio_title;
				}
				
				$portfolio_id_display = esc_html__( 'Id', 'diefinnhutte-core' ) . ': ' . $portfolio_id;
				
				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'diefinnhutte-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {
				
				$portfolio_tag_slug  = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;
				
				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'diefinnhutte-core' ) . ': ' . $portfolio_tag_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}