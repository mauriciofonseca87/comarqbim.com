<?php

if ( ! function_exists( 'diefinnhutte_select_sticky_header_meta_boxes_options_map' ) ) {
	function diefinnhutte_select_sticky_header_meta_boxes_options_map( $header_meta_box ) {
		
		$sticky_amount_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'sticky_amount_container_meta_container',
				'dependency' => array(
					'hide' => array(
						'qodef_header_behaviour_meta'  => array( '', 'no-behavior','fixed-on-scroll','sticky-header-on-scroll-up' )
					)
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll Amount for Sticky Header Appearance', 'diefinnhutte' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'diefinnhutte' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		$diefinnhutte_custom_sidebars = diefinnhutte_select_get_custom_sidebars();
		if ( count( $diefinnhutte_custom_sidebars ) > 0 ) {
			diefinnhutte_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sticky_menu_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area In Sticky Header Menu Area', 'diefinnhutte' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header menu area"', 'diefinnhutte' ),
					'parent'      => $header_meta_box,
					'options'     => $diefinnhutte_custom_sidebars,
					'dependency' => array(
						'show' => array(
							'qodef_header_behaviour_meta' => array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' )
						)
					)
				)
			);
		}
	}
	
	add_action( 'diefinnhutte_select_action_additional_header_area_meta_boxes_map', 'diefinnhutte_select_sticky_header_meta_boxes_options_map', 8 );
}