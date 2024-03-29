<?php

/*** Post Settings ***/

if ( ! function_exists( 'diefinnhutte_select_map_post_meta' ) ) {
	function diefinnhutte_select_map_post_meta() {
		
		$post_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'diefinnhutte' ),
				'name'  => 'post-meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'diefinnhutte' ),
				'parent'        => $post_meta_box,
				'options'       => diefinnhutte_select_get_yes_no_select_array()
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'diefinnhutte' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => diefinnhutte_select_get_custom_sidebars_options( true )
			)
		);
		
		$diefinnhutte_custom_sidebars = diefinnhutte_select_get_custom_sidebars();
		if ( count( $diefinnhutte_custom_sidebars ) > 0 ) {
			diefinnhutte_select_create_meta_box_field( array(
				'name'        => 'qodef_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'diefinnhutte' ),
				'parent'      => $post_meta_box,
				'options'     => diefinnhutte_select_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'diefinnhutte' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('diefinnhutte_select_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_post_meta', 20 );
}
