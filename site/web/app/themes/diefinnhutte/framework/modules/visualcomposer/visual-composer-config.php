<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = SELECT_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'diefinnhutte_select_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function diefinnhutte_select_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'diefinnhutte_select_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'diefinnhutte_select_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function diefinnhutte_select_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'diefinnhutte' ),
				'value'      => array(
					esc_html__( 'Full Width', 'diefinnhutte' ) => 'full-width',
					esc_html__( 'In Grid', 'diefinnhutte' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Select Anchor ID', 'diefinnhutte' ),
				'description' => esc_html__( 'For example "home"', 'diefinnhutte' ),
				'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'diefinnhutte' ),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'diefinnhutte' ),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'diefinnhutte' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'diefinnhutte' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'diefinnhutte' ),
				'value'       => array(
					esc_html__( 'Never', 'diefinnhutte' )        => '',
					esc_html__( 'Below 1280px', 'diefinnhutte' ) => '1280',
					esc_html__( 'Below 1024px', 'diefinnhutte' ) => '1024',
					esc_html__( 'Below 768px', 'diefinnhutte' )  => '768',
					esc_html__( 'Below 680px', 'diefinnhutte' )  => '680',
					esc_html__( 'Below 480px', 'diefinnhutte' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'diefinnhutte' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Select Parallax Background Image', 'diefinnhutte' ),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Select Parallax Speed', 'diefinnhutte' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'diefinnhutte' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Select Parallax Section Height (px)', 'diefinnhutte' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'diefinnhutte' ),
				'value'      => array(
					esc_html__( 'Default', 'diefinnhutte' ) => '',
					esc_html__( 'Left', 'diefinnhutte' )    => 'left',
					esc_html__( 'Center', 'diefinnhutte' )  => 'center',
					esc_html__( 'Right', 'diefinnhutte' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);

		do_action( 'diefinnhutte_select_action_additional_vc_row_params' );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'diefinnhutte' ),
				'value'      => array(
					esc_html__( 'Full Width', 'diefinnhutte' ) => 'full-width',
					esc_html__( 'In Grid', 'diefinnhutte' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'diefinnhutte' ),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'diefinnhutte' ),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'diefinnhutte' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'diefinnhutte' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'diefinnhutte' ),
				'value'       => array(
					esc_html__( 'Never', 'diefinnhutte' )        => '',
					esc_html__( 'Below 1280px', 'diefinnhutte' ) => '1280',
					esc_html__( 'Below 1024px', 'diefinnhutte' ) => '1024',
					esc_html__( 'Below 768px', 'diefinnhutte' )  => '768',
					esc_html__( 'Below 680px', 'diefinnhutte' )  => '680',
					esc_html__( 'Below 480px', 'diefinnhutte' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'diefinnhutte' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'diefinnhutte' ),
				'value'      => array(
					esc_html__( 'Default', 'diefinnhutte' ) => '',
					esc_html__( 'Left', 'diefinnhutte' )    => 'left',
					esc_html__( 'Center', 'diefinnhutte' )  => 'center',
					esc_html__( 'Right', 'diefinnhutte' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'diefinnhutte' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( diefinnhutte_select_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Select Enable Passepartout', 'diefinnhutte' ),
					'value'       => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Select Passepartout Size', 'diefinnhutte' ),
					'value'       => array(
						esc_html__( 'Tiny', 'diefinnhutte' )   => 'tiny',
						esc_html__( 'Small', 'diefinnhutte' )  => 'small',
						esc_html__( 'Normal', 'diefinnhutte' ) => 'normal',
						esc_html__( 'Large', 'diefinnhutte' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Select Disable Side Passepartout', 'diefinnhutte' ),
					'value'       => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Select Disable Top Passepartout', 'diefinnhutte' ),
					'value'       => array_flip( diefinnhutte_select_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'diefinnhutte' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'diefinnhutte_select_vc_row_map' );
}