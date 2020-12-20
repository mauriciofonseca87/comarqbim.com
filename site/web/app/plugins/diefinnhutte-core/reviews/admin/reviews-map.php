<?php

if ( ! function_exists( 'diefinnhutte_core_reviews_map' ) ) {
	function diefinnhutte_core_reviews_map() {
		
		$reviews_panel = diefinnhutte_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'diefinnhutte-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'diefinnhutte-core' ),
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'diefinnhutte-core' ),
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_additional_page_options_map', 'diefinnhutte_core_reviews_map', 75 ); //one after elements
}