<?php

if ( ! function_exists( 'diefinnhutte_select_map_post_gallery_meta' ) ) {
	
	function diefinnhutte_select_map_post_gallery_meta() {
		$gallery_post_format_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'diefinnhutte' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		diefinnhutte_select_add_multiple_images_field(
			array(
				'name'        => 'qodef_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose your gallery images', 'diefinnhutte' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_post_gallery_meta', 21 );
}
