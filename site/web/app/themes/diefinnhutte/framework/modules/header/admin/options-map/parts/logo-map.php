<?php

if ( ! function_exists( 'diefinnhutte_select_logo_options_map' ) ) {
	function diefinnhutte_select_logo_options_map() {
		
		diefinnhutte_select_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'diefinnhutte' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = diefinnhutte_select_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'diefinnhutte' )
			)
		);
		
		$hide_logo_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);

        diefinnhutte_select_add_admin_field(
            array(
                'parent'        => $hide_logo_container,
                'type'          => 'select',
                'name'          => 'logo_source',
                'default_value' => 'image',
                'label'         => esc_html__( 'Select Logo Source', 'diefinnhutte' ),
                'description'   => esc_html__( 'Choose whether you would like to use logo as image or text', 'diefinnhutte' ),
                'options'       => array(
                    'image' => esc_html__( 'Image', 'diefinnhutte' ),
                    'text' => esc_html__( 'Text', 'diefinnhutte' )
                )
            )
        );

        $image_logo_container = diefinnhutte_select_add_admin_container(
            array(
                'parent'          => $hide_logo_container,
                'name'            => 'image_logo_container',
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'text'
                    )
                )
            )
        );
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'diefinnhutte' ),
				'parent'        => $image_logo_container
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'diefinnhutte' ),
				'parent'        => $image_logo_container
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'diefinnhutte' ),
				'parent'        => $image_logo_container
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'diefinnhutte' ),
				'parent'        => $image_logo_container
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => SELECT_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'diefinnhutte' ),
				'parent'        => $image_logo_container
			)
		);

        diefinnhutte_select_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'text',
                'name'        => 'logo_text',
                'label'       => esc_html__( 'Logo Text', 'diefinnhutte' ),
                'description' => esc_html__( 'Enter your logo text here', 'diefinnhutte' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                )
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'text',
                'name'        => 'logo_text_two',
                'label'       => esc_html__( 'Logo Text - part Two', 'diefinnhutte' ),
                'description' => esc_html__( 'Enter your logo text here', 'diefinnhutte' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                )
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'color',
                'name'        => 'logo_text_color',
                'label'       => esc_html__( 'Logo Text Color', 'diefinnhutte' ),
                'description' => esc_html__( 'Choose color for your logo text', 'diefinnhutte' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                )
            )
        );

		diefinnhutte_select_add_admin_field(
			array(
				'parent'      => $hide_logo_container,
				'type'        => 'text',
				'name'        => 'mobile_logo_text',
				'label'       => esc_html__( 'Modile Logo Text', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter your logo text here for mobile device', 'diefinnhutte' ),
				'dependency' => array(
					'hide' => array(
						'logo_source'  => 'image'
					)
				)
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'parent'      => $hide_logo_container,
				'type'        => 'text',
				'name'        => 'mobile_logo_text_two',
				'label'       => esc_html__( 'Mobile Logo Text - part Two', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter your logo text here for mobile device', 'diefinnhutte' ),
				'dependency' => array(
					'hide' => array(
						'logo_source'  => 'image'
					)
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_options_map', 'diefinnhutte_select_logo_options_map', diefinnhutte_select_set_options_map_position( 'logo' ) );
}