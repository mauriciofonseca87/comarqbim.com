<?php

namespace DieFinnhutteCore\CPT\Shortcodes\ProductList;

use DieFinnhutteCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_product_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Product List', 'diefinnhutte' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-list extended-custom-icon',
					'category'                  => esc_html__( 'by DIEFINNHUTTE', 'diefinnhutte' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'diefinnhutte' ),
							'value'       => array(
								esc_html__( 'Standard', 'diefinnhutte' ) => 'standard',
								esc_html__( 'Masonry', 'diefinnhutte' )  => 'masonry'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'info_position',
							'heading'     => esc_html__( 'Product Info Position', 'diefinnhutte' ),
							'value'       => array(
								esc_html__( 'Info On Image Hover', 'diefinnhutte' ) => 'info-on-image',
								esc_html__( 'Info Below Image', 'diefinnhutte' )    => 'info-below-image'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_posts',
							'heading'    => esc_html__( 'Number of Products', 'diefinnhutte' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'diefinnhutte' ),
							'value'       => array_flip( diefinnhutte_select_get_number_of_columns_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'diefinnhutte' ),
							'value'       => array_flip( diefinnhutte_select_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'show_category_filter',
							'heading'     => esc_html__('Show Category Filter', 'diefinnhutte'),
							'value'       => array_flip( diefinnhutte_select_get_yes_no_select_array(false, false)),
							'dependency'  => array('element' => 'type', 'value' => array('standard')),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'category_values',
							'heading'     => esc_html__('Enter Category Values', 'diefinnhutte'),
							'description' => esc_html__('Separate values (category slugs) with a comma', 'diefinnhutte'),
							'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'diefinnhutte' ),
							'value'       => array_flip( diefinnhutte_select_get_query_order_by_array( false, array( 'on-sale' => esc_html__( 'On Sale', 'diefinnhutte' ) ) ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'diefinnhutte' ),
							'value'       => array_flip( diefinnhutte_select_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'taxonomy_to_display',
							'heading'     => esc_html__( 'Choose Sorting Taxonomy', 'diefinnhutte' ),
							'value'       => array(
								esc_html__( 'Category', 'diefinnhutte' ) => 'category',
								esc_html__( 'Tag', 'diefinnhutte' )      => 'tag',
								esc_html__( 'Id', 'diefinnhutte' )       => 'id'
							),
							'save_always' => true,
							'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'diefinnhutte' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'taxonomy_values',
							'heading'     => esc_html__( 'Enter Taxonomy Values', 'diefinnhutte' ),
							'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_size',
							'heading'    => esc_html__( 'Image Proportions', 'diefinnhutte' ),
							'value'      => array(
								esc_html__( 'Default', 'diefinnhutte' )        => '',
								esc_html__( 'Original', 'diefinnhutte' )       => 'full',
								esc_html__( 'Square', 'diefinnhutte' )         => 'square',
								esc_html__( 'Landscape', 'diefinnhutte' )      => 'landscape',
								esc_html__( 'Portrait', 'diefinnhutte' )       => 'portrait',
								esc_html__( 'Medium', 'diefinnhutte' )         => 'medium',
								esc_html__( 'Large', 'diefinnhutte' )          => 'large',
								esc_html__( 'Shop Single', 'diefinnhutte' )    => 'woocommerce_single',
								esc_html__( 'Shop Thumbnail', 'diefinnhutte' ) => 'woocommerce_thumbnail'
							),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_title',
							'heading'    => esc_html__( 'Display Title', 'diefinnhutte' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'product_info_skin',
							'heading'    => esc_html__( 'Product Info Skin', 'diefinnhutte' ),
							'value'      => array(
								esc_html__( 'Default', 'diefinnhutte' ) => 'default',
								esc_html__( 'Light', 'diefinnhutte' )   => 'light',
								esc_html__( 'Dark', 'diefinnhutte' )    => 'dark'
							),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'diefinnhutte' ),
							'value'      => array_flip( diefinnhutte_select_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'diefinnhutte' ),
							'value'      => array_flip( diefinnhutte_select_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_category',
							'heading'    => esc_html__( 'Display Category', 'diefinnhutte' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Product Info', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_excerpt',
							'heading'    => esc_html__( 'Display Excerpt', 'diefinnhutte' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Product Info', 'diefinnhutte' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'diefinnhutte' ),
							'description' => esc_html__( 'Number of characters', 'diefinnhutte' ),
							'dependency'  => array( 'element' => 'display_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Product Info Style', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_rating',
							'heading'    => esc_html__( 'Display Rating', 'diefinnhutte' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_price',
							'heading'    => esc_html__( 'Display Price', 'diefinnhutte' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_button',
							'heading'    => esc_html__( 'Display Button', 'diefinnhutte' ),
							'value'      => array_flip( diefinnhutte_select_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_skin',
							'heading'    => esc_html__( 'Button Skin', 'diefinnhutte' ),
							'value'      => array(
								esc_html__( 'Default', 'diefinnhutte' ) => 'default',
								esc_html__( 'Light', 'diefinnhutte' )   => 'light',
								esc_html__( 'Dark', 'diefinnhutte' )    => 'dark'
							),
							'dependency' => array( 'element' => 'display_button', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'diefinnhutte' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'shader_background_color',
							'heading'    => esc_html__( 'Shader Background Color', 'diefinnhutte' ),
							'group'      => esc_html__( 'Product Info Style', 'diefinnhutte' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'info_bottom_text_align',
							'heading'    => esc_html__( 'Product Info Text Alignment', 'diefinnhutte' ),
							'value'      => array(
								esc_html__( 'Default', 'diefinnhutte' ) => '',
								esc_html__( 'Left', 'diefinnhutte' )    => 'left',
								esc_html__( 'Center', 'diefinnhutte' )  => 'center',
								esc_html__( 'Right', 'diefinnhutte' )   => 'right'
							),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'diefinnhutte' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'info_bottom_margin',
							'heading'    => esc_html__( 'Product Info Bottom Margin (px)', 'diefinnhutte' ),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'diefinnhutte' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                    => 'standard',
			'info_position'           => 'info-on-image',
			'number_of_posts'         => '8',
			'number_of_columns'       => 'four',
			'space_between_items'     => 'normal',
			'orderby'                 => 'date',
			'order'                   => 'ASC',
			'taxonomy_to_display'     => 'category',
			'taxonomy_values'         => '',
			'image_size'              => 'full',
			'display_title'           => 'yes',
			'product_info_skin'       => '',
			'title_tag'               => 'h4',
			'title_transform'         => '',
			'display_category'        => 'no',
			'display_excerpt'         => 'no',
			'excerpt_length'          => '20',
			'display_rating'          => 'no',
			'display_price'           => 'yes',
			'display_button'          => 'yes',
			'button_skin'             => 'default',
			'shader_background_color' => '',
			'info_bottom_text_align'  => '',
			'info_bottom_margin'      => '',
			'show_category_filter'    => '',
			'category_values'         => '',
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['class_name']     = 'pli';
		$params['type']           = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		$params['info_position']  = ! empty( $params['info_position'] ) ? $params['info_position'] : $default_atts['info_position'];
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];

		$params['category'] = ''; //used for ajax calling in category filter
		$params['meta_key'] = ''; //used for ajax calling in category filter

		$additional_params                  = array();
		$queryArray                         = $this->generateProductQueryArray( $params );
		$query_result                       = new \WP_Query( $queryArray );
		$additional_params['query_results'] = $query_result;

		$additional_params['holder_data'] = diefinnhutte_select_get_holder_data_for_cpt($params, $additional_params);
		$params['categories_filter_list'] = $this->getProductCategoriesList($params);
		$additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		
		$params['this_object'] = $this;
		
		$html = diefinnhutte_select_get_woo_shortcode_module_template_part( 'templates/product-list', 'product-list', $params['type'], $params, $additional_params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-' . $params['type'] . '-layout' : 'qodef-' . $default_atts['type'] . '-layout';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qodef-' . $params['number_of_columns'] . '-columns' : 'qodef-' . $default_atts['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['info_position'] ) ? 'qodef-' . $params['info_position'] : 'qodef-' . $default_atts['info_position'];
		$holderClasses[] = ! empty( $params['product_info_skin'] ) ? 'qodef-product-info-' . $params['product_info_skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	public function generateProductQueryArray( $params ) {
		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $params['number_of_posts'],
			'orderby'             => $params['orderby'],
			'order'               => $params['order']
		);
		
		if ( $params['orderby'] === 'on-sale' ) {
			$queryArray['no_found_rows'] = 1;
			$queryArray['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' ) {
			$queryArray['product_cat'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' ) {
			$queryArray['product_tag'] = $params['taxonomy_values'];
		}

		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' && $params['show_category_filter'] == 'no' ) {
			$idArray                = $params['taxonomy_values'];
			$ids                    = explode( ',', $idArray );
			$queryArray['post__in'] = $ids;
		}

		//used for ajax calling in category filter
		if($params['show_category_filter'] == 'yes'){
			if($params['category_values'] !== '' && $params['category'] == '') {
				$queryArray['product_cat'] = $params['category_values'];
			}else {
				$queryArray['product_cat'] = $params['category'];
			}
		}
		
		return $queryArray;
	}

	/**
	 * Return product categories
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductCategoriesList($params) {
		$category_html = '';

		if($params['show_category_filter'] == 'yes') {
			$taxonomy = 'product_cat';
			$orderby = 'name';
			$show_count = 0;      // 1 for yes, 0 for no
			$pad_counts = 0;      // 1 for yes, 0 for no
			$hierarchical = 1;      // 1 for yes, 0 for no
			$title = '';
			$empty = 0;
			$parent = 0;

			$args = array(
				'taxonomy' => $taxonomy,
				'orderby' => $orderby,
				'show_count' => $show_count,
				'pad_counts' => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li' => $title,
				'hide_empty' => $empty,
				'parent' => $parent
			);

			$all_categories_string = '';
			if($params['category_values'] == ''){

				$all_categories = get_categories($args);

			}else{
				$all_categories = array();
				$categories = explode(',',$params['category_values']);
				foreach ($categories as $cat){
					$all_categories[] = get_term_by( 'slug', $cat, 'product_cat' );
					$all_categories_string .= $cat.',';
				}
			}
			
			$category_html .= '<li><a class="qodef-no-smooth-transitions active" data-category="' . $all_categories_string . '" href="#">' . esc_html__('All Projects', 'diefinnhutte') . '</a></li>';
			foreach ($all_categories as $cat) {
				if ($cat != '') {
					$category_html .= '<li><a class="qodef-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($cat->slug, 'product_cat') . '">' . $cat->name . '</a></li>';

					$termchildren = get_term_children($cat->term_id, 'product_cat');

					if (!empty($termchildren)) {
						foreach ($termchildren as $child) {
							$cat = get_term_by('id', $child, 'product_cat');
							$category_html .= '<li><a class="qodef-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($child, 'product_cat') . '">' . $cat->name . '</a></li>';
						}
					}
				}
			}
		}

		return $category_html;
	}
	
	public function getItemClasses( $params ) {
		$itemClasses = array();
		
		$image_size_meta = get_post_meta( get_the_ID(), 'qodef_product_featured_image_size', true );
		
		if ( ! empty( $image_size_meta ) ) {
			$itemClasses[] = 'qodef-fixed-masonry-item qodef-masonry-size-' . $image_size_meta;
		}
		
		return implode( ' ', $itemClasses );
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getShaderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['shader_background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['shader_background_color'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getTextWrapperStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['info_bottom_text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['info_bottom_text_align'];
		}
		
		if ( $params['info_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . diefinnhutte_select_filter_px( $params['info_bottom_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}