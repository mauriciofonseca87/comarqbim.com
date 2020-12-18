<?php

if ( ! function_exists( 'diefinnhutte_select_get_title_types_meta_boxes' ) ) {
	function diefinnhutte_select_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'diefinnhutte_select_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'diefinnhutte' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'diefinnhutte_select_map_title_meta' ) ) {
	function diefinnhutte_select_map_title_meta() {
		$title_type_meta_boxes = diefinnhutte_select_get_title_types_meta_boxes();
		
		$title_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => apply_filters( 'diefinnhutte_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'diefinnhutte' ),
				'name'  => 'title_meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'diefinnhutte' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'diefinnhutte' ),
				'parent'        => $title_meta_box,
				'options'       => diefinnhutte_select_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = diefinnhutte_select_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'qodef_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'qodef_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'diefinnhutte' ),
						'description'   => esc_html__( 'Choose title type', 'diefinnhutte' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'diefinnhutte' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'diefinnhutte' ),
						'options'       => diefinnhutte_select_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'diefinnhutte' ),
						'description' => esc_html__( 'Set a height for Title Area', 'diefinnhutte' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose a background color for title area', 'diefinnhutte' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose an Image for title area', 'diefinnhutte' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'diefinnhutte' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'diefinnhutte' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'diefinnhutte' ),
							'hide'                => esc_html__( 'Hide Image', 'diefinnhutte' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'diefinnhutte' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'diefinnhutte' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'diefinnhutte' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'diefinnhutte' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'diefinnhutte' )
						)
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'diefinnhutte' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'diefinnhutte' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'diefinnhutte' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'diefinnhutte' ),
							'window-top'    => esc_html__( 'From Window Top', 'diefinnhutte' )
						)
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'diefinnhutte' ),
						'options'       => diefinnhutte_select_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose a color for title text', 'diefinnhutte' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'diefinnhutte' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'diefinnhutte' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'diefinnhutte' ),
						'options'       => diefinnhutte_select_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'diefinnhutte' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'diefinnhutte_select_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_title_meta', 60 );
}