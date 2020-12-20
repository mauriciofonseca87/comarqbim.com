<?php

if ( ! function_exists( 'diefinnhutte_select_map_post_audio_meta' ) ) {
	function diefinnhutte_select_map_post_audio_meta() {
		$audio_post_format_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'diefinnhutte' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose audio type', 'diefinnhutte' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'diefinnhutte' ),
					'self'            => esc_html__( 'Self Hosted', 'diefinnhutte' )
				)
			)
		);
		
		$qodef_audio_embedded_container = diefinnhutte_select_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'qodef_audio_embedded_container'
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter audio URL', 'diefinnhutte' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter audio link', 'diefinnhutte' ),
				'parent'      => $qodef_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'qodef_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_post_audio_meta', 23 );
}