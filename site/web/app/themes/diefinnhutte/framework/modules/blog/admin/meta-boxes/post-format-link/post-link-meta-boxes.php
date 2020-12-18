<?php

if ( ! function_exists( 'diefinnhutte_select_map_post_link_meta' ) ) {
	function diefinnhutte_select_map_post_link_meta() {
		$link_post_format_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'diefinnhutte' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter link', 'diefinnhutte' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_post_link_meta', 24 );
}