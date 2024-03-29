<?php

if ( ! function_exists( 'diefinnhutte_select_get_hide_dep_for_top_header_area_meta_boxes' ) ) {
	function diefinnhutte_select_get_hide_dep_for_top_header_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'diefinnhutte_select_filter_top_header_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'diefinnhutte_select_header_top_area_meta_options_map' ) ) {
	function diefinnhutte_select_header_top_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = diefinnhutte_select_get_hide_dep_for_top_header_area_meta_boxes();
		
		$top_header_container = diefinnhutte_select_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name'   => 'top_area_style',
				'title'  => esc_html__( 'Top Area', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_top_bar_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Top Bar', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show header top bar area', 'diefinnhutte' ),
				'parent'        => $top_header_container,
				'options'       => diefinnhutte_select_get_yes_no_select_array(),
			)
		);
		
		$top_bar_container = diefinnhutte_select_add_admin_container_no_style(
			array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $top_header_container,
				'dependency' => array(
					'show' => array(
						'qodef_top_bar_meta' => 'yes'
					)
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_top_bar_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar In Grid', 'diefinnhutte' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'diefinnhutte' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => diefinnhutte_select_get_yes_no_select_array()
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'   => 'qodef_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Top Bar Background Color', 'diefinnhutte' ),
				'parent' => $top_bar_container
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Background Color Transparency', 'diefinnhutte' ),
				'description' => esc_html__( 'Set top bar background color transparenct. Value should be between 0 and 1', 'diefinnhutte' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_top_bar_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar Border', 'diefinnhutte' ),
				'description'   => esc_html__( 'Set border on top bar', 'diefinnhutte' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => diefinnhutte_select_get_yes_no_select_array()
			)
		);
		
		$top_bar_border_container = diefinnhutte_select_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'show' => array(
						'qodef_top_bar_border_meta' => 'yes'
					)
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_top_bar_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose color for top bar border', 'diefinnhutte' ),
				'parent'      => $top_bar_border_container
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_additional_header_area_meta_boxes_map', 'diefinnhutte_select_header_top_area_meta_options_map' );
}