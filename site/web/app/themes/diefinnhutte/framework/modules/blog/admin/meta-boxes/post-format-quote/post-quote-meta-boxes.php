<?php

if ( ! function_exists( 'diefinnhutte_select_map_post_quote_meta' ) ) {
	function diefinnhutte_select_map_post_quote_meta() {
		$quote_post_format_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'diefinnhutte' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter Quote text', 'diefinnhutte' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter Quote author', 'diefinnhutte' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_post_quote_meta', 25 );
}