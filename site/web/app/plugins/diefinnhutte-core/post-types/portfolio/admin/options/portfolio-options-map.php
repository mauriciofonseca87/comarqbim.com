<?php

if ( ! function_exists( 'diefinnhutte_select_portfolio_options_map' ) ) {
	function diefinnhutte_select_portfolio_options_map() {
		
		diefinnhutte_select_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'diefinnhutte-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = diefinnhutte_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'diefinnhutte-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'diefinnhutte-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'diefinnhutte-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'diefinnhutte-core' ),
				'parent'        => $panel_archive,
				'options'       => diefinnhutte_select_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'diefinnhutte-core' ),
				'default_value' => 'normal',
				'options'       => diefinnhutte_select_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'diefinnhutte-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'diefinnhutte-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'diefinnhutte-core' ),
					'landscape' => esc_html__( 'Landscape', 'diefinnhutte-core' ),
					'portrait'  => esc_html__( 'Portrait', 'diefinnhutte-core' ),
					'square'    => esc_html__( 'Square', 'diefinnhutte-core' )
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'diefinnhutte-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'diefinnhutte-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'diefinnhutte-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'diefinnhutte-core' )
				)
			)
		);
		
		$panel = diefinnhutte_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'diefinnhutte-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'diefinnhutte-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'diefinnhutte-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'diefinnhutte-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => diefinnhutte_select_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'diefinnhutte-core' ),
				'default_value' => 'normal',
				'options'       => diefinnhutte_select_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'diefinnhutte-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'diefinnhutte-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => diefinnhutte_select_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'diefinnhutte-core' ),
				'default_value' => 'normal',
				'options'       => diefinnhutte_select_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'diefinnhutte-core' ),
					'yes' => esc_html__( 'Yes', 'diefinnhutte-core' ),
					'no'  => esc_html__( 'No', 'diefinnhutte-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'diefinnhutte-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = diefinnhutte_select_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'diefinnhutte-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'diefinnhutte-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'diefinnhutte-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_options_map', 'diefinnhutte_select_portfolio_options_map', diefinnhutte_select_set_options_map_position( 'portfolio' ) );
}