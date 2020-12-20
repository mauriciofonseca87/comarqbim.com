<?php

if ( ! function_exists( 'diefinnhutte_select_portfolio_category_additional_fields' ) ) {
	function diefinnhutte_select_portfolio_category_additional_fields() {
		
		$fields = diefinnhutte_select_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		diefinnhutte_select_add_taxonomy_field(
			array(
				'name'   => 'qodef_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'diefinnhutte-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_custom_taxonomy_fields', 'diefinnhutte_select_portfolio_category_additional_fields' );
}