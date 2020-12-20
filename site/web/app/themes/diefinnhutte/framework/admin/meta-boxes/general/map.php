<?php

if ( ! function_exists( 'diefinnhutte_select_map_general_meta' ) ) {
	function diefinnhutte_select_map_general_meta() {
		
		$general_meta_box = diefinnhutte_select_create_meta_box(
			array(
				'scope' => apply_filters( 'diefinnhutte_select_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'diefinnhutte' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'diefinnhutte' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'diefinnhutte' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'diefinnhutte' ),
				'parent'        => $general_meta_box
			)
		);
		
		$qodef_content_padding_group = diefinnhutte_select_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'diefinnhutte' ),
				'description' => esc_html__( 'Define styles for Content area', 'diefinnhutte' ),
				'parent'      => $general_meta_box
			)
		);
		
			$qodef_content_padding_row = diefinnhutte_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row',
					'parent' => $qodef_content_padding_group
				)
			);
			
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'diefinnhutte' ),
						'parent'      => $qodef_content_padding_row
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'diefinnhutte' ),
						'parent'        => $qodef_content_padding_row
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'diefinnhutte' ),
						'options'       => diefinnhutte_select_get_yes_no_select_array(),
						'parent'        => $qodef_content_padding_row
					)
				);
		
			$qodef_content_padding_row_1 = diefinnhutte_select_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row_1',
					'next'   => true,
					'parent' => $qodef_content_padding_group
				)
			);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'   => 'qodef_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'diefinnhutte' ),
						'parent' => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'    => 'qodef_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'diefinnhutte' ),
						'parent'  => $qodef_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'diefinnhutte' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'diefinnhutte' ),
					'qodef-grid-1500' => esc_html__( '1500px', 'diefinnhutte' ),
					'qodef-grid-1300' => esc_html__( '1300px', 'diefinnhutte' ),
					'qodef-grid-1200' => esc_html__( '1200px', 'diefinnhutte' ),
					'qodef-grid-1100' => esc_html__( '1100px', 'diefinnhutte' ),
					'qodef-grid-1000' => esc_html__( '1000px', 'diefinnhutte' ),
					'qodef-grid-800'  => esc_html__( '800px', 'diefinnhutte' )
				)
			)
		);
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'diefinnhutte' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'diefinnhutte' ),
				'options'     => diefinnhutte_select_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'    => 'qodef_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'diefinnhutte' ),
				'parent'  => $general_meta_box,
				'options' => diefinnhutte_select_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = diefinnhutte_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'diefinnhutte' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'diefinnhutte' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'diefinnhutte' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'          => 'qodef_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'diefinnhutte' ),
						'description'   => esc_html__( 'Choose background image attachment', 'diefinnhutte' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'diefinnhutte' ),
							'fixed'  => esc_html__( 'Fixed', 'diefinnhutte' ),
							'scroll' => esc_html__( 'Scroll', 'diefinnhutte' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'diefinnhutte' ),
				'parent'        => $general_meta_box,
				'options'       => diefinnhutte_select_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = diefinnhutte_select_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'qodef_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'diefinnhutte' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'diefinnhutte' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'diefinnhutte' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'diefinnhutte' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'diefinnhutte' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				diefinnhutte_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'diefinnhutte' ),
						'options'       => diefinnhutte_select_get_yes_no_select_array(),
					)
				);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'diefinnhutte' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'diefinnhutte' ),
						'options'       => diefinnhutte_select_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'          => 'qodef_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'diefinnhutte' ),
				'parent'        => $general_meta_box,
				'options'       => diefinnhutte_select_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = diefinnhutte_select_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'qodef_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				diefinnhutte_select_create_meta_box_field(
					array(
						'name'        => 'qodef_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'diefinnhutte' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'diefinnhutte' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => diefinnhutte_select_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = diefinnhutte_select_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'qodef_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					diefinnhutte_select_create_meta_box_field(
						array(
							'name'   => 'qodef_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'diefinnhutte' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = diefinnhutte_select_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'diefinnhutte' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'diefinnhutte' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = diefinnhutte_select_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					diefinnhutte_select_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'qodef_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'diefinnhutte' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'diefinnhutte' ),
                                'diefinnhutte_spinner'	=> esc_html__( 'DieFinnhutte Spinner', 'diefinnhutte' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'diefinnhutte' ),
								'pulse'                 => esc_html__( 'Pulse', 'diefinnhutte' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'diefinnhutte' ),
								'cube'                  => esc_html__( 'Cube', 'diefinnhutte' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'diefinnhutte' ),
								'stripes'               => esc_html__( 'Stripes', 'diefinnhutte' ),
								'wave'                  => esc_html__( 'Wave', 'diefinnhutte' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'diefinnhutte' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'diefinnhutte' ),
								'atom'                  => esc_html__( 'Atom', 'diefinnhutte' ),
								'clock'                 => esc_html__( 'Clock', 'diefinnhutte' ),
								'mitosis'               => esc_html__( 'Mitosis', 'diefinnhutte' ),
								'lines'                 => esc_html__( 'Lines', 'diefinnhutte' ),
								'fussion'               => esc_html__( 'Fussion', 'diefinnhutte' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'diefinnhutte' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'diefinnhutte' )
							)
						)
					);
					
					diefinnhutte_select_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'qodef_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'diefinnhutte' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);

                    diefinnhutte_select_create_meta_box_field(
                        array(
                            'type'   => 'colorsimple',
                            'name'   => 'qodef_smooth_pt_spinner_text_color_meta',
                            'label'  => esc_html__( 'Preloader Text Color', 'diefinnhutte' ),
                            'parent' => $row_pt_spinner_animation_meta,
                            'dependency' => array(
                                'show' => array(
                                    'qodef_smooth_pt_spinner_type_meta' => 'diefinnhutte_spinner'
                                )
                            )
                        )
                    );
					
					diefinnhutte_select_create_meta_box_field(
						array(
							'name'        => 'qodef_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'diefinnhutte' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'diefinnhutte' ),
							'options'     => diefinnhutte_select_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);

                    diefinnhutte_select_create_meta_box_field(
                        array(
                            'type'          => 'text',
                            'name'          => 'qodef_smooth_pt_spinner_text_left_meta',
                            'default_value' => 'Loading',
                            'label'         => esc_html__( 'Preloader Text Left', 'diefinnhutte' ),
                            'parent'        => $row_pt_spinner_animation_meta,
                            'dependency' => array(
                                'show' => array(
                                    'qodef_smooth_pt_spinner_type_meta' => 'diefinnhutte_spinner'
                                )
                            )
                        )
                    );

                    diefinnhutte_select_create_meta_box_field(
                        array(
                            'type'          => 'text',
                            'name'          => 'qodef_smooth_pt_spinner_text_right_meta',
                            'default_value' => 'Loading',
                            'label'         => esc_html__( 'Preloader Text Right', 'diefinnhutte' ),
                            'parent'        => $row_pt_spinner_animation_meta,
                            'dependency' => array(
                                'show' => array(
                                    'qodef_smooth_pt_spinner_type_meta' => 'diefinnhutte_spinner'
                                )
                            )
                        )
                    );
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		diefinnhutte_select_create_meta_box_field(
			array(
				'name'        => 'qodef_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'diefinnhutte' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'diefinnhutte' ),
				'parent'      => $general_meta_box,
				'options'     => diefinnhutte_select_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_select_map_general_meta', 10 );
}

if ( ! function_exists( 'diefinnhutte_select_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function diefinnhutte_select_container_background_style( $style ) {
		$page_id      = diefinnhutte_select_get_page_id();
		$class_prefix = diefinnhutte_select_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .qodef-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'qodef_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'qodef_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'qodef_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = diefinnhutte_select_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'diefinnhutte_select_filter_add_page_custom_style', 'diefinnhutte_select_container_background_style' );
}