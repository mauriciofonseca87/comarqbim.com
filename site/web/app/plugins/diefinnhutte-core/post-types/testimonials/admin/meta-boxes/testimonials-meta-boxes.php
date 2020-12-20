<?php

if ( ! function_exists( 'diefinnhutte_core_map_testimonials_meta' ) ) {
	function diefinnhutte_core_map_testimonials_meta() {
		$testimonial_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'diefinnhutte-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'diefinnhutte-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'diefinnhutte-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Enter author name', 'diefinnhutte-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'diefinnhutte-core' ),
				'description' => esc_html__( 'Enter author job position', 'diefinnhutte-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_core_map_testimonials_meta', 95 );
}