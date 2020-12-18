<?php

if ( ! function_exists( 'diefinnhutte_select_get_hide_dep_for_top_header_options' ) ) {
	function diefinnhutte_select_get_hide_dep_for_top_header_options() {
		$hide_dep_options = apply_filters( 'diefinnhutte_select_filter_top_header_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'diefinnhutte_select_header_top_options_map' ) ) {
	function diefinnhutte_select_header_top_options_map( $panel_header ) {
		$hide_dep_options = diefinnhutte_select_get_hide_dep_for_top_header_options();
		
		$top_header_container = diefinnhutte_select_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $panel_header,
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'top_bar',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Top Bar', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show top bar area', 'diefinnhutte' ),
				'parent'        => $top_header_container,
			)
		);
		
		$top_bar_container = diefinnhutte_select_add_admin_container(
			array(
				'name'            => 'top_bar_container',
				'parent'          => $top_header_container,
				'dependency' => array(
					'hide' => array(
						'top_bar'  => 'no'
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'top_bar_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Top Bar in Grid', 'diefinnhutte' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'diefinnhutte' ),
				'parent'        => $top_bar_container
			)
		);
		
		$top_bar_in_grid_container = diefinnhutte_select_add_admin_container(
			array(
				'name'            => 'top_bar_in_grid_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'hide' => array(
						'top_bar_in_grid'  => 'no'
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'top_bar_grid_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'diefinnhutte' ),
				'description' => esc_html__( 'Set grid background color for top bar', 'diefinnhutte' ),
				'parent'      => $top_bar_in_grid_container
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'top_bar_grid_background_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'diefinnhutte' ),
				'description' => esc_html__( 'Set grid background transparency for top bar', 'diefinnhutte' ),
				'parent'      => $top_bar_in_grid_container,
				'args'        => array( 'col_width' => 3 )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'top_bar_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'diefinnhutte' ),
				'description' => esc_html__( 'Set background color for top bar', 'diefinnhutte' ),
				'parent'      => $top_bar_container
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'top_bar_background_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Background Transparency', 'diefinnhutte' ),
				'description' => esc_html__( 'Set background transparency for top bar', 'diefinnhutte' ),
				'parent'      => $top_bar_container,
				'args'        => array( 'col_width' => 3 )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'top_bar_border',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Top Bar Border', 'diefinnhutte' ),
				'description'   => esc_html__( 'Set top bar border', 'diefinnhutte' ),
				'parent'        => $top_bar_container
			)
		);
		
		$top_bar_border_container = diefinnhutte_select_add_admin_container(
			array(
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'hide' => array(
						'top_bar_border'  => 'no'
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'top_bar_border_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Top Bar Border Color', 'diefinnhutte' ),
				'description' => esc_html__( 'Set border color for top bar', 'diefinnhutte' ),
				'parent'      => $top_bar_border_container
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'        => 'top_bar_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Height', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter top bar height (Default is 46px)', 'diefinnhutte' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'   => 'top_bar_side_padding',
				'type'   => 'text',
				'label'  => esc_html__( 'Top Bar Side Padding', 'diefinnhutte' ),
				'parent' => $top_bar_container,
				'args'   => array(
					'col_width' => 2,
					'suffix'    => esc_html__( 'px or %', 'diefinnhutte' )
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_header_top_options_map', 'diefinnhutte_select_header_top_options_map', 10, 1 );
}