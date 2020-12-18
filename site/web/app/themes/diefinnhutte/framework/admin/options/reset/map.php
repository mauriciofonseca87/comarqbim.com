<?php

if ( ! function_exists( 'diefinnhutte_select_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function diefinnhutte_select_reset_options_map() {
		
		diefinnhutte_select_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'diefinnhutte' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = diefinnhutte_select_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'diefinnhutte' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'diefinnhutte' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_options_map', 'diefinnhutte_select_reset_options_map', diefinnhutte_select_set_options_map_position( 'reset' ) );
}