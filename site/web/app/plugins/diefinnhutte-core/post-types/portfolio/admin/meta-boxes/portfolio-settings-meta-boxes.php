<?php

if ( ! function_exists( 'diefinnhutte_core_map_portfolio_settings_meta' ) ) {
	function diefinnhutte_core_map_portfolio_settings_meta() {
		$meta_box = diefinnhutte_select_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'diefinnhutte-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		diefinnhutte_select_create_meta_box_field( array(
			'name'        => 'qodef_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'diefinnhutte-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'diefinnhutte-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'diefinnhutte-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'diefinnhutte-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'diefinnhutte-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'diefinnhutte-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'diefinnhutte-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'diefinnhutte-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'diefinnhutte-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'diefinnhutte-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'diefinnhutte-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'diefinnhutte-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'diefinnhutte-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'diefinnhutte-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'qodef_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'diefinnhutte-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'diefinnhutte-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => diefinnhutte_select_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'diefinnhutte-core' ),
				'default_value' => '',
				'options'       => diefinnhutte_select_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'qodef_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'diefinnhutte-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'diefinnhutte-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => diefinnhutte_select_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'diefinnhutte-core' ),
				'default_value' => '',
				'options'       => diefinnhutte_select_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'diefinnhutte-core' ),
				'parent'        => $meta_box,
				'options'       => diefinnhutte_select_get_yes_no_select_array()
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'diefinnhutte-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'diefinnhutte-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);

        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'portfolio_stamp_text',
                'type'        => 'text',
                'label'       => esc_html__( 'Portfolio Item Stamp Text', 'diefinnhutte-core' ),
                'description' => esc_html__( 'Enter stamp text for this item - will be displayed on Vertical Showcase Portfolio List', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );

        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_list_additional_info_label',
                'type'        => 'text',
                'label'       => esc_html__( 'Portfolio List Additional Info - label', 'diefinnhutte-core' ),
                'description' => esc_html__( 'If enabled, this additional info will be displayed in portfolio list shortcode for this item', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );

        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_list_additional_info_value',
                'type'        => 'text',
                'label'       => esc_html__( 'PortfolioList Additional Info - value', 'diefinnhutte-core' ),
                'description' => esc_html__( 'If enabled, this additional info will be displayed in portfolio list shortcode for this item', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );

        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_list_additional_info_link',
                'type'        => 'text',
                'label'       => esc_html__( 'PortfolioList Additional Info - link', 'diefinnhutte-core' ),
                'description' => esc_html__( 'If enabled, this additional info will be displayed in portfolio list shortcode for this item', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
            )
        );
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'diefinnhutte-core' ),
				'parent'      => $meta_box
			)
		);

        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_small_featured_image_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Small Featured Image', 'diefinnhutte-core' ),
                'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode - type Small Images', 'diefinnhutte-core' ),
                'parent'      => $meta_box
            )
        );

        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_small_featured_image_padding_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Portfolio Item Padding for Small Images list', 'diefinnhutte-core' ),
                'description' => esc_html__( 'Enter padding for this item to be used on Portfolio List - type Small Images', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );
        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_small_featured_image_padding_meta_1367_1600',
                'type'        => 'text',
                'label'       => esc_html__( 'Portfolio Item Padding for Small Images list on screen size between 1367px-1600px', 'diefinnhutte-core' ),
                'description' => esc_html__( 'Enter padding for this item to be used on Portfolio List - type Small Images', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );
        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_small_featured_image_padding_meta_1025_1366',
                'type'        => 'text',
                'label'       => esc_html__( 'Portfolio Item Padding for Small Images list on screen size between 1025px-1366px', 'diefinnhutte-core' ),
                'description' => esc_html__( 'Enter padding for this item to be used on Portfolio List - type Small Images', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );
        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_small_featured_image_padding_meta_769_1024',
                'type'        => 'text',
                'label'       => esc_html__( 'Portfolio Item Padding for Small Images list on screen size between 768px-1024px', 'diefinnhutte-core' ),
                'description' => esc_html__( 'Enter padding for this item to be used on Portfolio List - type Small Images', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );
        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_small_featured_image_padding_meta_681_768',
                'type'        => 'text',
                'label'       => esc_html__( 'Portfolio Item Padding for Small Images list on screen size between 680px-768px', 'diefinnhutte-core' ),
                'description' => esc_html__( 'Enter padding for this item to be used on Portfolio List - type Small Images', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );
        diefinnhutte_select_create_meta_box_field(
            array(
                'name'        => 'qodef_portfolio_small_featured_image_padding_meta_680',
                'type'        => 'text',
                'label'       => esc_html__( 'Portfolio Item Padding for Small Images list on screen size bellow 680px', 'diefinnhutte-core' ),
                'description' => esc_html__( 'Enter padding for this item to be used on Portfolio List - type Small Images', 'diefinnhutte-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 6
                )
            )
        );
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'diefinnhutte-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'diefinnhutte-core' ),
					'small'              => esc_html__( 'Small', 'diefinnhutte-core' ),
					'large-width'        => esc_html__( 'Large Width', 'diefinnhutte-core' ),
					'large-height'       => esc_html__( 'Large Height', 'diefinnhutte-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'diefinnhutte-core' )
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'diefinnhutte-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'diefinnhutte-core' ),
					'large-width' => esc_html__( 'Large Width', 'diefinnhutte-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'diefinnhutte-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_core_map_portfolio_settings_meta', 41 );
}