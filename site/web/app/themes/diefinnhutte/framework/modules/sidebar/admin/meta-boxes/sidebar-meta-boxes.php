<?php

if ( ! function_exists( 'diefinnhutte_select_map_sidebar_meta' ) ) {
	function diefinnhutte_select_map_sidebar_meta() {
		$qodef_sidebar_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => apply_filters( 'diefinnhutte_select_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'diefinnhutte' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'diefinnhutte' ),
				'parent'      => $qodef_sidebar_meta_box,
                'options'       => diefinnhutte_select_get_custom_sidebars_options( true )
			)
		);
		
		$qodef_custom_sidebars = diefinnhutte_select_get_custom_sidebars();
		if ( count( $qodef_custom_sidebars ) > 0 ) {
			diefinnhutte_select_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'diefinnhutte' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'diefinnhutte' ),
					'parent'      => $qodef_sidebar_meta_box,
					'options'     => $qodef_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_sidebar_meta', 31 );
}