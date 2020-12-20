<?php

if ( ! function_exists( 'diefinnhutte_select_footer_options_map' ) ) {
	function diefinnhutte_select_footer_options_map() {

		diefinnhutte_select_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'diefinnhutte' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = diefinnhutte_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'diefinnhutte' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'diefinnhutte' ),
				'parent'        => $footer_panel
			)
		);

        diefinnhutte_select_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'diefinnhutte' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'diefinnhutte' ),
                'parent'        => $footer_panel
            )
        );

		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'diefinnhutte' ),
				'parent'        => $footer_panel
			)
		);
		
		$show_footer_top_container = diefinnhutte_select_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'diefinnhutte' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'diefinnhutte' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'diefinnhutte' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'diefinnhutte' ),
					'left'   => esc_html__( 'Left', 'diefinnhutte' ),
					'center' => esc_html__( 'Center', 'diefinnhutte' ),
					'right'  => esc_html__( 'Right', 'diefinnhutte' )
				),
				'parent'        => $show_footer_top_container
			)
		);
		
		$footer_top_styles_group = diefinnhutte_select_add_admin_group(
			array(
				'name'        => 'footer_top_styles_group',
				'title'       => esc_html__( 'Footer Top Styles', 'diefinnhutte' ),
				'description' => esc_html__( 'Define style for footer top area', 'diefinnhutte' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		$footer_top_styles_row_1 = diefinnhutte_select_add_admin_row(
			array(
				'name'   => 'footer_top_styles_row_1',
				'parent' => $footer_top_styles_group
			)
		);
		
			diefinnhutte_select_add_admin_field(
				array(
					'name'   => 'footer_top_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'diefinnhutte' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			diefinnhutte_select_add_admin_field(
				array(
					'name'   => 'footer_top_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'diefinnhutte' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			diefinnhutte_select_add_admin_field(
				array(
					'name'   => 'footer_top_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'diefinnhutte' ),
					'parent' => $footer_top_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);

		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'diefinnhutte' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'diefinnhutte' ),
				'parent'        => $footer_panel
			)
		);

		$show_footer_bottom_container = diefinnhutte_select_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'diefinnhutte' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_group = diefinnhutte_select_add_admin_group(
			array(
				'name'        => 'footer_bottom_styles_group',
				'title'       => esc_html__( 'Footer Bottom Styles', 'diefinnhutte' ),
				'description' => esc_html__( 'Define style for footer bottom area', 'diefinnhutte' ),
				'parent'      => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_row_1 = diefinnhutte_select_add_admin_row(
			array(
				'name'   => 'footer_bottom_styles_row_1',
				'parent' => $footer_bottom_styles_group
			)
		);
		
			diefinnhutte_select_add_admin_field(
				array(
					'name'   => 'footer_bottom_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'diefinnhutte' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			diefinnhutte_select_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'diefinnhutte' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			diefinnhutte_select_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'diefinnhutte' ),
					'parent' => $footer_bottom_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);
	}

	add_action( 'diefinnhutte_select_action_options_map', 'diefinnhutte_select_footer_options_map', diefinnhutte_select_set_options_map_position( 'footer' ) );
}