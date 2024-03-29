<?php

if ( ! function_exists( 'diefinnhutte_select_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function diefinnhutte_select_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'diefinnhutte_select_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'diefinnhutte_select_header_standard_meta_map' ) ) {
	function diefinnhutte_select_header_standard_meta_map( $parent ) {
		$hide_dep_options = diefinnhutte_select_get_hide_dep_for_header_standard_meta_boxes();
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'qodef_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'diefinnhutte' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'diefinnhutte' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'diefinnhutte' ),
					'left'   => esc_html__( 'Left', 'diefinnhutte' ),
					'right'  => esc_html__( 'Right', 'diefinnhutte' ),
					'center' => esc_html__( 'Center', 'diefinnhutte' )
				),
				'dependency' => array(
					'hide' => array(
						'qodef_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_additional_header_area_meta_boxes_map', 'diefinnhutte_select_header_standard_meta_map' );
}