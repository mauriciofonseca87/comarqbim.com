<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DieFinnhutteInstagramWidget extends WP_Widget {
	protected $params;
	
	public function __construct() {
		parent::__construct(
			'qodef_instagram_widget',
			esc_html__( 'DieFinnhutte Instagram Widget', 'diefinnhutte-instagram-feed' ),
			array(
				'description' => esc_html__( 'Display your Instagram feed', 'diefinnhutte-instagram-feed' )
			)
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'name'  => 'title',
				'type'  => 'textfield',
				'title' => esc_html__( 'Title', 'diefinnhutte-instagram-feed' )
			),
			array(
				'name'    => 'type',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Type', 'diefinnhutte-instagram-feed' ),
				'options' => array(
					'gallery'  => esc_html__( 'Gallery', 'diefinnhutte-instagram-feed' ),
					'carousel' => esc_html__( 'Carousel', 'diefinnhutte-instagram-feed' )
				)
			),
			array(
				'name'    => 'number_of_cols',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Number of Columns', 'diefinnhutte-instagram-feed' ),
				'options' => array(
					'2' => esc_html__( 'Two', 'diefinnhutte-instagram-feed' ),
					'3' => esc_html__( 'Three', 'diefinnhutte-instagram-feed' ),
					'4' => esc_html__( 'Four', 'diefinnhutte-instagram-feed' ),
					'6' => esc_html__( 'Six', 'diefinnhutte-instagram-feed' ),
					'9' => esc_html__( 'Nine', 'diefinnhutte-instagram-feed' )
				)
			),
			array(
				'name'  => 'number_of_photos',
				'type'  => 'textfield',
				'title' => esc_html__( 'Number of Photos', 'diefinnhutte-instagram-feed' )
			),
			array(
				'name'    => 'space_between_items',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Space Between Items', 'diefinnhutte-instagram-feed' ),
				'options' => diefinnhutte_select_get_space_between_items_array( false, array( 'large', 'huge' ) )
			),
			array(
				'name'    => 'show_instagram_icon',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Show Instagram Icon', 'diefinnhutte-instagram-feed' ),
				'options' => diefinnhutte_select_get_yes_no_select_array( false, true )
			),
			array(
				'name'  => 'transient_time',
				'type'  => 'textfield',
				'title' => esc_html__( 'Images Cache Time', 'diefinnhutte-instagram-feed' )
			)
		);
	}
	
	public function getParams() {
		return $this->params;
	}
	
	public function widget( $args, $instance ) {
		extract( $instance );
		
		print $args['before_widget'];
		if ( ! empty( $title ) ) {
			print $args['before_title'] . $title . $args['after_title'];
		}
		
		$number_of_photos = isset( $number_of_photos ) ? $number_of_photos : '6';
		$transient_time = ! empty( $transient_time ) ? $transient_time : '10800';
		
		$instagram_api = DieFinnhutteInstagramApi::getInstance();
		$images_array  = $instagram_api->getImages( $number_of_photos, array(
			'use_transients' => true,
			'transient_name' => $args['widget_id'],
			'transient_time' => $transient_time
		) );
		
		$type                = ! empty( $type ) ? $type : 'gallery';
		$number_of_cols      = $number_of_cols == '' ? 3 : $number_of_cols;
		$space_between_items = ! empty( $space_between_items ) ? $space_between_items : 'normal';
		$show_instagram_icon = ! empty( $show_instagram_icon ) ? $show_instagram_icon : 'yes';

		$widget_class = '';
		$slider_data  = array();
		
		if ( $type === 'carousel' ) {
			$widget_class = 'qodef-instagram-carousel qodef-owl-slider';
			
			$slider_margin = 0;
			if ( $space_between_items === 'normal' ) {
				$slider_margin = 30;
			} else if ( $space_between_items === 'small' ) {
				$slider_margin = 20;
			} else if ( $space_between_items === 'tiny' ) {
				$slider_margin = 10;
			} else if ( $space_between_items === 'no' ) {
				$slider_margin = 0;
			}
			
			$slider_data['data-number-of-items']   = esc_attr( $number_of_cols );
			$slider_data['data-slider-margin']     = esc_attr( $slider_margin );
			$slider_data['data-enable-navigation'] = 'no';
			$slider_data['data-enable-pagination'] = 'no';
		} else if ( $type == 'gallery' ) {
			$widget_class = 'qodef-instagram-gallery qodef-' . esc_attr( $space_between_items ) . '-space';
		}
		
		if ( is_array( $images_array ) && count( $images_array ) ) { ?>
			<ul class="qodef-instagram-feed clearfix qodef-col-<?php echo esc_attr( $number_of_cols ); ?> <?php echo esc_attr( $widget_class ); ?>" <?php echo diefinnhutte_select_get_inline_attrs( $slider_data ); ?>>
				<?php
				foreach ( $images_array as $image ) { ?>
					<li>
						<a href="<?php echo esc_url( $instagram_api->getHelper()->getImageLink( $image ) ); ?>" target="_blank">
							<?php if ( $show_instagram_icon == 'yes' ) { ?>
                                <span class="qodef-instagram-icon"><i class="social_instagram"></i></span>
							<?php } ?>
							<?php echo diefinnhutte_select_kses_img( $instagram_api->getHelper()->getImageHTML( $image ) ); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php }
		
		print $args['after_widget'];
	}
	
	public function form( $instance ) {
		foreach ( $this->params as $param_array ) {
			$param_name    = $param_array['name'];
			${$param_name} = isset( $instance[ $param_name ] ) ? esc_attr( $instance[ $param_name ] ) : '';
		}
		
		$instagram_api = DieFinnhutteInstagramApi::getInstance();
		
		//user has connected with instagram. Show form
		if ( $instagram_api->hasUserConnected() ) {
			foreach ( $this->params as $param ) {
				switch ( $param['type'] ) {
					case 'textfield':
						?>
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo esc_html( $param['title'] ); ?></label>
							<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>"/>
						</p>
						<?php
						break;
					case 'dropdown':
						?>
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo esc_html( $param['title'] ); ?></label>
							<?php if ( isset( $param['options'] ) && is_array( $param['options'] ) && count( $param['options'] ) ) { ?>
								<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>">
									<?php foreach ( $param['options'] as $param_option_key => $param_option_val ) {
										$option_selected = '';
										if ( ${$param['name']} == $param_option_key ) {
											$option_selected = 'selected';
										}
										?>
										<option <?php echo esc_attr( $option_selected ); ?> value="<?php echo esc_attr( $param_option_key ); ?>"><?php echo esc_attr( $param_option_val ); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</p>
						
						<?php
						break;
				}
			}
		}
	}
}

if ( ! function_exists( 'diefinnhutte_instagram_feed_widget_load' ) ) {
	function diefinnhutte_instagram_feed_widget_load() {
		if ( diefinnhutte_instagram_theme_installed() ) {
			register_widget( 'DieFinnhutteInstagramWidget' );
		}
	}
	
	add_action( 'widgets_init', 'diefinnhutte_instagram_feed_widget_load' );
}