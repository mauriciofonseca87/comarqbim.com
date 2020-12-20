<?php

if ( ! function_exists( 'diefinnhutte_core_map_portfolio_meta' ) ) {
	function diefinnhutte_core_map_portfolio_meta() {
		global $diefinnhutte_select_global_Framework;
		
		$diefinnhutte_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$diefinnhutte_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$diefinnhutte_portfolio_images = new DieFinnhutteSelectClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'diefinnhutte-core' ), '', '', 'portfolio_images' );
		$diefinnhutte_select_global_Framework->qodeMetaBoxes->addMetaBox( 'portfolio_images', $diefinnhutte_portfolio_images );
		
		$diefinnhutte_portfolio_image_gallery = new DieFinnhutteSelectClassMultipleImages( 'qodef-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'diefinnhutte-core' ), esc_html__( 'Choose your portfolio images', 'diefinnhutte-core' ) );
		$diefinnhutte_portfolio_images->addChild( 'qodef-portfolio-image-gallery', $diefinnhutte_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$diefinnhutte_portfolio_images_videos = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'diefinnhutte-core' ),
				'name'  => 'qodef_portfolio_images_videos'
			)
		);
		diefinnhutte_select_add_repeater_field(
			array(
				'name'        => 'qodef_portfolio_single_upload',
				'parent'      => $diefinnhutte_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'diefinnhutte-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'diefinnhutte-core' ),
						'options' => array(
							'image' => esc_html__('Image','diefinnhutte-core'),
							'video' => esc_html__('Video','diefinnhutte-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'diefinnhutte-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'diefinnhutte-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'diefinnhutte-core'),
							'vimeo' => esc_html__('Vimeo', 'diefinnhutte-core'),
							'self' => esc_html__('Self Hosted', 'diefinnhutte-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'diefinnhutte-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'diefinnhutte-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'diefinnhutte-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$diefinnhutte_additional_sidebar_items = diefinnhutte_select_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'diefinnhutte-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		diefinnhutte_select_add_repeater_field(
			array(
				'name'        => 'qodef_portfolio_properties',
				'parent'      => $diefinnhutte_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'diefinnhutte-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'diefinnhutte-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'diefinnhutte-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'diefinnhutte-core' )
					)
				)
			)
		);
	}
	
	add_action( 'diefinnhutte_select_action_meta_boxes_map', 'diefinnhutte_core_map_portfolio_meta', 40 );
}