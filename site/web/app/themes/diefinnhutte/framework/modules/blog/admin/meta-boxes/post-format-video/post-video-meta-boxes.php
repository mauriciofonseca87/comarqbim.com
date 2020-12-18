<?php

if ( ! function_exists( 'diefinnhutte_select_map_post_video_meta' ) ) {
	function diefinnhutte_select_map_post_video_meta() {
		$video_post_format_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'diefinnhutte' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose video type', 'diefinnhutte' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'diefinnhutte' ),
					'self'            => esc_html__( 'Self Hosted', 'diefinnhutte' )
				)
			)
		);
		
		$qodef_video_embedded_container = diefinnhutte_select_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'qodef_video_embedded_container'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter Video URL', 'diefinnhutte' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'diefinnhutte' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'self'
					)
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter video image', 'diefinnhutte' ),
				'parent'      => $qodef_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_post_video_meta', 22 );
}