<?php

if ( ! function_exists( 'diefinnhutte_select_get_blog_list_types_options' ) ) {
	function diefinnhutte_select_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'diefinnhutte_select_filter_blog_list_type_global_option', $blog_list_type_options = array() );
		
		return $blog_list_type_options;
	}
}

if ( ! function_exists( 'diefinnhutte_select_blog_options_map' ) ) {
	function diefinnhutte_select_blog_options_map() {
		$blog_list_type_options = diefinnhutte_select_get_blog_list_types_options();
		
		diefinnhutte_select_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__( 'Blog', 'diefinnhutte' ),
				'icon'  => 'fa fa-files-o'
			)
		);
		
		/**
		 * Blog Lists
		 */
		$panel_blog_lists = diefinnhutte_select_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'blog_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for blog post lists. Default value is large', 'diefinnhutte' ),
				'options'     => diefinnhutte_select_get_space_between_items_array( true ),
				'parent'      => $panel_blog_lists
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_list_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Archive Pages', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose a default blog layout for archived blog post lists', 'diefinnhutte' ),
				'default_value' => 'standard',
				'parent'        => $panel_blog_lists,
				'options'       => $blog_list_type_options
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'archive_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout for Archive Pages', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose a sidebar layout for archived blog post lists', 'diefinnhutte' ),
				'default_value' => '',
				'parent'        => $panel_blog_lists,
                'options'       => diefinnhutte_select_get_custom_sidebars_options(),
			)
		);
		
		$diefinnhutte_custom_sidebars = diefinnhutte_select_get_custom_sidebars();
		if ( count( $diefinnhutte_custom_sidebars ) > 0 ) {
			diefinnhutte_select_add_admin_field(
				array(
					'name'        => 'archive_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display for Archive Pages', 'diefinnhutte' ),
					'description' => esc_html__( 'Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'diefinnhutte' ),
					'parent'      => $panel_blog_lists,
					'options'     => diefinnhutte_select_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_masonry_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Layout', 'diefinnhutte' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set masonry layout. Default is in grid.', 'diefinnhutte' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'diefinnhutte' ),
					'full-width' => esc_html__( 'Full Width', 'diefinnhutte' )
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_masonry_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Number of Columns', 'diefinnhutte' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for your masonry blog lists. Default value is 4 columns', 'diefinnhutte' ),
				'parent'        => $panel_blog_lists,
				'options'       => diefinnhutte_select_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Space Between Items', 'diefinnhutte' ),
				'description'   => esc_html__( 'Set space size between posts for your masonry blog lists. Default value is normal', 'diefinnhutte' ),
				'default_value' => 'normal',
				'options'       => diefinnhutte_select_get_space_between_items_array(),
				'parent'        => $panel_blog_lists
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_list_featured_image_proportion',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'diefinnhutte' ),
				'default_value' => 'fixed',
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'diefinnhutte' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'fixed'    => esc_html__( 'Fixed', 'diefinnhutte' ),
					'original' => esc_html__( 'Original', 'diefinnhutte' )
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_pagination_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'diefinnhutte' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'standard',
				'options'       => array(
					'standard'        => esc_html__( 'Standard', 'diefinnhutte' ),
					'load-more'       => esc_html__( 'Load More', 'diefinnhutte' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'diefinnhutte' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'diefinnhutte' )
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '40',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'diefinnhutte' ),
				'parent'        => $panel_blog_lists,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_tags_area_blog',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Blog Tags on Standard List', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show tags on standard blog list', 'diefinnhutte' ),
				'parent'        => $panel_blog_lists
			)
		);
		
		/**
		 * Blog Single
		 */
		$panel_blog_single = diefinnhutte_select_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'blog_single_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for Blog Single pages. Default value is large', 'diefinnhutte' ),
				'options'     => diefinnhutte_select_get_space_between_items_array( true ),
				'parent'      => $panel_blog_single
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_single_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'diefinnhutte' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
                'options'       => diefinnhutte_select_get_custom_sidebars_options()
			)
		);
		
		if ( count( $diefinnhutte_custom_sidebars ) > 0 ) {
			diefinnhutte_select_add_admin_field(
				array(
					'name'        => 'blog_single_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'diefinnhutte' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'diefinnhutte' ),
					'parent'      => $panel_blog_single,
					'options'     => diefinnhutte_select_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_blog',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'diefinnhutte' ),
				'parent'        => $panel_blog_single,
				'options'       => diefinnhutte_select_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_single_title_in_title_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Post Title in Title Area', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'diefinnhutte' ),
				'parent'        => $panel_blog_single,
				'dependency' => array(
					'hide' => array(
						'show_title_area_blog' => 'no'
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Related Posts', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show related posts on single post pages', 'diefinnhutte' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'no'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'blog_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments Form', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show comments form on single post pages', 'diefinnhutte' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'diefinnhutte' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_navigation_container = diefinnhutte_select_add_admin_container(
			array(
				'name'            => 'qodef_blog_single_navigation_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_single_navigation' => 'yes'
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Navigation Only in Current Category', 'diefinnhutte' ),
				'description'   => esc_html__( 'Limit your navigation only through current category', 'diefinnhutte' ),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Info Box', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will display author name and descriptions on single post pages. Author biographic info field in Users section must contain some data', 'diefinnhutte' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_author_info_container = diefinnhutte_select_add_admin_container(
			array(
				'name'            => 'qodef_blog_single_author_info_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_author_info' => 'yes'
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Author Email', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show author email', 'diefinnhutte' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Social Icons', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show author social icons on single post pages', 'diefinnhutte' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		do_action( 'diefinnhutte_select_action_blog_single_options_map', $panel_blog_single );
	}
	
	add_action( 'diefinnhutte_select_action_options_map', 'diefinnhutte_select_blog_options_map', diefinnhutte_select_set_options_map_position( 'blog' ) );
}