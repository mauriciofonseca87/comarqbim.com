<?php

if ( ! function_exists( 'diefinnhutte_select_get_hide_dep_for_header_standard_options' ) ) {
	function diefinnhutte_select_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'diefinnhutte_select_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'diefinnhutte_select_header_standard_map' ) ) {
	function diefinnhutte_select_header_standard_map( $parent ) {
		$hide_dep_options = diefinnhutte_select_get_hide_dep_for_header_standard_options();
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'diefinnhutte' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'diefinnhutte' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'diefinnhutte' ),
					'left'   => esc_html__( 'Left', 'diefinnhutte' ),
					'center' => esc_html__( 'Center', 'diefinnhutte' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_additional_header_menu_area_options_map', 'diefinnhutte_select_header_standard_map' );
}