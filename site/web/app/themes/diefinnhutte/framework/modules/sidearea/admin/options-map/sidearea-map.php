<?php

if ( ! function_exists( 'diefinnhutte_select_sidearea_options_map' ) ) {
	function diefinnhutte_select_sidearea_options_map() {

        diefinnhutte_select_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'diefinnhutte'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = diefinnhutte_select_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'diefinnhutte'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'diefinnhutte'),
                'description'   => esc_html__('Choose a type of Side Area', 'diefinnhutte'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'diefinnhutte'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'diefinnhutte'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'diefinnhutte'),
                ),
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'diefinnhutte'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'diefinnhutte'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = diefinnhutte_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'diefinnhutte'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'diefinnhutte'),
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'diefinnhutte'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'diefinnhutte'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'predefined',
                'label'         => esc_html__('Select Side Area Icon Source', 'diefinnhutte'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'diefinnhutte'),
                'options'       => diefinnhutte_select_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = diefinnhutte_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'diefinnhutte'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'diefinnhutte'),
                'options'       => diefinnhutte_select_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = diefinnhutte_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'diefinnhutte'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'diefinnhutte'),
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'diefinnhutte'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'diefinnhutte'),
            )
        );

        $side_area_icon_style_group = diefinnhutte_select_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'diefinnhutte'),
                'description' => esc_html__('Define styles for Side Area icon', 'diefinnhutte')
            )
        );

        $side_area_icon_style_row1 = diefinnhutte_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'diefinnhutte')
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'diefinnhutte')
            )
        );

        $side_area_icon_style_row2 = diefinnhutte_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'diefinnhutte')
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'diefinnhutte')
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'diefinnhutte'),
                'description' => esc_html__('Choose a background color for Side Area', 'diefinnhutte')
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'diefinnhutte'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'diefinnhutte'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        diefinnhutte_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'diefinnhutte'),
                'description'   => esc_html__('Choose text alignment for side area', 'diefinnhutte'),
                'options'       => array(
                    ''       => esc_html__('Default', 'diefinnhutte'),
                    'left'   => esc_html__('Left', 'diefinnhutte'),
                    'center' => esc_html__('Center', 'diefinnhutte'),
                    'right'  => esc_html__('Right', 'diefinnhutte')
                )
            )
        );
    }

    add_action('diefinnhutte_select_action_options_map', 'diefinnhutte_select_sidearea_options_map', diefinnhutte_select_set_options_map_position( 'sidearea' ) );
}