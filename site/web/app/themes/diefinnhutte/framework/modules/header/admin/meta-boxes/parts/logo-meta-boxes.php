<?php

if ( ! function_exists( 'diefinnhutte_select_logo_meta_box_map' ) ) {
	function diefinnhutte_select_logo_meta_box_map() {
		
		$logo_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => apply_filters( 'diefinnhutte_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'diefinnhutte' ),
				'name'  => 'logo_meta'
			)
		);

        diefinnhutte_select_create_meta_box_field(
            array(
                'parent'        => $logo_meta_box,
                'type'          => 'select',
                'name'          => 'qodef_logo_source_meta',
                'default_value' => '',
                'label'         => esc_html__( 'Select Logo Source', 'diefinnhutte' ),
                'description'   => esc_html__( 'Choose whether you would like to use logo as image or text', 'diefinnhutte' ),
                'options'       => array(
                    ''     => esc_html__('Default', 'diefinnhutte'),
                    'image' => esc_html__( 'Image', 'diefinnhutte' ),
                    'text' => esc_html__( 'Text', 'diefinnhutte' )
                )
            )
        );

        $image_logo_container = diefinnhutte_select_add_admin_container(
            array(
                'parent'          => $logo_meta_box,
                'name'            => 'image_logo_container',
                'dependency' => array(
                    'hide' => array(
                        'qodef_logo_source_meta'  => 'text'
                    )
                )
            )
        );
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'diefinnhutte' ),
				'parent'      => $image_logo_container
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'diefinnhutte' ),
				'parent'      => $image_logo_container
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'diefinnhutte' ),
				'parent'      => $image_logo_container
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'diefinnhutte' ),
				'parent'      => $image_logo_container
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'diefinnhutte' ),
				'parent'      => $image_logo_container
			)
		);

        diefinnhutte_select_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'text',
                'name'        => 'qodef_logo_text_meta',
                'label'       => esc_html__( 'Logo Text', 'diefinnhutte' ),
                'description' => esc_html__( 'Enter your logo text', 'diefinnhutte' ),
                'dependency' => array(
                    'hide' => array(
                        'qodef_logo_source_meta'  => 'image'
                    )
                )
            )
        );

        diefinnhutte_select_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'text',
                'name'        => 'qodef_logo_text_two_meta',
                'label'       => esc_html__( 'Logo Text - Part Two', 'diefinnhutte' ),
                'description' => esc_html__( 'Enter your logo text', 'diefinnhutte' ),
                'dependency' => array(
                    'hide' => array(
                        'qodef_logo_source_meta'  => 'image'
                    )
                )
            )
        );

        diefinnhutte_select_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'color',
                'name'        => 'qodef_logo_text_color_meta',
                'label'       => esc_html__( 'Logo Text Color', 'diefinnhutte' ),
                'description' => esc_html__( 'Choose color for your logo text', 'diefinnhutte' ),
                'dependency' => array(
                    'hide' => array(
                        'qodef_logo_source_meta'  => 'image'
                    )
                )
            )
        );

		diefinnhutte_select_create_meta_box_field(
			array(
				'parent'      => $logo_meta_box,
				'type'        => 'text',
				'name'        => 'qodef_mobile_logo_text_meta',
				'label'       => esc_html__( 'Mobile Logo Text', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter your logo text for mobile device', 'diefinnhutte' ),
				'dependency' => array(
					'hide' => array(
						'qodef_logo_source_meta'  => 'image'
					)
				)
			)
		);

		diefinnhutte_select_create_meta_box_field(
			array(
				'parent'      => $logo_meta_box,
				'type'        => 'text',
				'name'        => 'qodef_mobile_logo_text_two_meta',
				'label'       => esc_html__( 'Mobile Logo Text - Part Two', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter your logo text for mobile device', 'diefinnhutte' ),
				'dependency' => array(
					'hide' => array(
						'qodef_logo_source_meta'  => 'image'
					)
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_logo_meta_box_map', 47 );
}