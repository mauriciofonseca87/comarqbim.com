<?php

if ( ! function_exists( 'diefinnhutte_select_map_woocommerce_meta' ) ) {
	function diefinnhutte_select_map_woocommerce_meta() {
		
		$woocommerce_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'diefinnhutte' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose image layout when it appears in Select Product List - Masonry layout shortcode', 'diefinnhutte' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'diefinnhutte' ),
					'small'              => esc_html__( 'Small', 'diefinnhutte' ),
					'large-width'        => esc_html__( 'Large Width', 'diefinnhutte' ),
					'large-height'       => esc_html__( 'Large Height', 'diefinnhutte' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'diefinnhutte' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'diefinnhutte' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'diefinnhutte' ),
				'options'       => diefinnhutte_select_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'diefinnhutte' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_woocommerce_meta', 99 );
}