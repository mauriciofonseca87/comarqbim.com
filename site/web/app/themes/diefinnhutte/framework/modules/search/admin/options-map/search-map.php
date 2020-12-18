<?php

if ( ! function_exists( 'diefinnhutte_select_get_search_types_options' ) ) {
    function diefinnhutte_select_get_search_types_options() {
        $search_type_options = apply_filters( 'diefinnhutte_select_filter_search_type_global_option', $search_type_options = array() );

        return $search_type_options;
    }
}

if ( ! function_exists( 'diefinnhutte_select_search_options_map' ) ) {
	function diefinnhutte_select_search_options_map() {
		
		diefinnhutte_select_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'diefinnhutte' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = diefinnhutte_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'diefinnhutte' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'search_page_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Layout', 'diefinnhutte' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set layout. Default is in grid.', 'diefinnhutte' ),
				'parent'        => $search_page_panel,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'diefinnhutte' ),
					'full-width' => esc_html__( 'Full Width', 'diefinnhutte' )
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'name'          => 'search_page_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'diefinnhutte' ),
				'description'   => esc_html__( "Choose a sidebar layout for search page", 'diefinnhutte' ),
				'default_value' => 'no-sidebar',
				'options'       => diefinnhutte_select_get_custom_sidebars_options(),
				'parent'        => $search_page_panel
			)
		);
		
		$diefinnhutte_custom_sidebars = diefinnhutte_select_get_custom_sidebars();
		if ( count( $diefinnhutte_custom_sidebars ) > 0 ) {
			diefinnhutte_select_add_admin_field(
				array(
					'name'        => 'search_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'diefinnhutte' ),
					'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'diefinnhutte' ),
					'parent'      => $search_page_panel,
					'options'     => $diefinnhutte_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		$search_panel = diefinnhutte_select_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'diefinnhutte' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen',
				'label'         => esc_html__( 'Select Search Type', 'diefinnhutte' ),
				'description'   => esc_html__( "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'diefinnhutte' ),
				'options'       => diefinnhutte_select_get_search_types_options()
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_source',
				'default_value' => 'predefined',
				'label'         => esc_html__( 'Select Search Icon Source', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'diefinnhutte' ),
				'options'       => diefinnhutte_select_get_icon_sources_array( false, false )
			)
		);

		$search_icon_pack_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $search_icon_pack_container,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Search Icon Pack', 'diefinnhutte' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'diefinnhutte' ),
				'options'       => diefinnhutte_select_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$search_svg_path_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'svg_path'
					)
				)
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_icon_svg_path',
				'label'       => esc_html__( 'Search Icon SVG Path', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter your search icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'diefinnhutte' ),
			)
		);

		diefinnhutte_select_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_close_icon_svg_path',
				'label'       => esc_html__( 'Search Close Icon SVG Path', 'diefinnhutte' ),
				'description' => esc_html__( 'Enter your search close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'diefinnhutte' ),
			)
		);

        diefinnhutte_select_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'search_sidebar_columns',
                'parent'        => $search_panel,
                'default_value' => '3',
                'label'         => esc_html__( 'Search Sidebar Columns', 'diefinnhutte' ),
                'description'   => esc_html__( 'Choose number of columns for FullScreen search sidebar area', 'diefinnhutte' ),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_sidebar_columns_dependency', $dependency_array = array())
					)
				)
            )
        );
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'diefinnhutte' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'diefinnhutte' ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_in_grid_dependency', $dependency_array = array())
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'diefinnhutte' )
			)
		);

		$search_icon_pack_icon_styles_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_icon_styles_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $search_icon_pack_icon_styles_container,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'diefinnhutte' ),
				'description'   => esc_html__( 'Set size for icon', 'diefinnhutte' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = diefinnhutte_select_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'diefinnhutte' ),
				'description' => esc_html__( 'Define color style for icon', 'diefinnhutte' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = diefinnhutte_select_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'diefinnhutte' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'diefinnhutte' )
			)
		);
		
		$enable_search_icon_text_container = diefinnhutte_select_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'dependency' => array(
					'show' => array(
						'enable_search_icon_text' => 'yes'
					)
				)
			)
		);
		
		$enable_search_icon_text_group = diefinnhutte_select_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'diefinnhutte' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'diefinnhutte' )
			)
		);
		
		$enable_search_icon_text_row = diefinnhutte_select_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'diefinnhutte' )
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'diefinnhutte' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'diefinnhutte' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = diefinnhutte_select_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'diefinnhutte' ),
				'default_value' => '',
				'options'       => diefinnhutte_select_get_text_transform_array()
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'diefinnhutte' ),
				'default_value' => '-1',
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'diefinnhutte' ),
				'default_value' => '',
				'options'       => diefinnhutte_select_get_font_style_array(),
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'diefinnhutte' ),
				'default_value' => '',
				'options'       => diefinnhutte_select_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = diefinnhutte_select_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		diefinnhutte_select_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'diefinnhutte' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_options_map', 'diefinnhutte_select_search_options_map', diefinnhutte_select_set_options_map_position( 'search' ) );
}