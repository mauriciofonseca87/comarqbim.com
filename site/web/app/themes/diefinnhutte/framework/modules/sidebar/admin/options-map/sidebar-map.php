<?php

if ( ! function_exists( 'diefinnhutte_select_sidebar_options_map' ) ) {
	function diefinnhutte_select_sidebar_options_map() {
		
		diefinnhutte_select_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'diefinnhutte' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = diefinnhutte_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'diefinnhutte' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		diefinnhutte_select_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'diefinnhutte' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'diefinnhutte' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => diefinnhutte_select_get_custom_sidebars_options()
		) );
		
		$diefinnhutte_custom_sidebars = diefinnhutte_select_get_custom_sidebars();
		if ( count( $diefinnhutte_custom_sidebars ) > 0 ) {
			diefinnhutte_select_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'diefinnhutte' ),
				'parent'      => $sidebar_panel,
				'options'     => $diefinnhutte_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'diefinnhutte_select_action_options_map', 'diefinnhutte_select_sidebar_options_map', diefinnhutte_select_set_options_map_position( 'sidebar' ) );
}