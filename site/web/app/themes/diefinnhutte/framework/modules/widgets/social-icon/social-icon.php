<?php

if ( class_exists( 'DieFinnhutteCoreClassWidget' ) ) {
	class DieFinnhutteSelectClassSocialIconWidget extends DieFinnhutteCoreClassWidget {

		public function __construct() {
			parent::__construct(
				'qodef_social_icon_widget',
				esc_html__( 'DieFinnhutte Social Icon Widget', 'diefinnhutte' ),
				array( 'description' => esc_html__( 'Add social network icons to widget areas', 'diefinnhutte' ) )
			);

			$this->setParams();
		}

		protected function setParams() {
			$this->params = array_merge(
				array(
					array(
						'type'        => 'dropdown',
						'name'        => 'icon_text',
						'title'       => esc_html__( 'Display Icon or Text', 'diefinnhutte' ),
						'description' => esc_html__( 'Choose whether you want to display social icon or text instead', 'diefinnhutte' ),
						'options'     => array(
							'icon' => esc_html__( 'Icon', 'diefinnhutte' ),
							'text' => esc_html__( 'Text', 'diefinnhutte' )
						)
					),
					array(
						'type'        => 'textfield',
						'name'        => 'social_text',
						'title'       => esc_html__( 'Social Text', 'diefinnhutte' ),
						'description' => esc_html__( 'Instert text which will describe desired social network', 'diefinnhutte' )
					)
				),
				diefinnhutte_select_icon_collections()->getSocialIconWidgetParamsArray(),
				array(
					array(
						'type'  => 'textfield',
						'name'  => 'link',
						'title' => esc_html__( 'Link', 'diefinnhutte' )
					),
					array(
						'type'    => 'dropdown',
						'name'    => 'target',
						'title'   => esc_html__( 'Target', 'diefinnhutte' ),
						'options' => diefinnhutte_select_get_link_target_array()
					),
					array(
						'type'  => 'textfield',
						'name'  => 'icon_size',
						'title' => esc_html__( 'Icon Size (px)', 'diefinnhutte' )
					),
					array(
						'type'  => 'colorpicker',
						'name'  => 'color',
						'title' => esc_html__( 'Color', 'diefinnhutte' )
					),
					array(
						'type'  => 'colorpicker',
						'name'  => 'hover_color',
						'title' => esc_html__( 'Hover Color', 'diefinnhutte' )
					),
					array(
						'type'        => 'textfield',
						'name'        => 'margin',
						'title'       => esc_html__( 'Margin', 'diefinnhutte' ),
						'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'diefinnhutte' )
					)
				)
			);
		}

		public function widget( $args, $instance ) {
			$icon_styles = array();

			if ( ! empty( $instance['color'] ) ) {
				$icon_styles[] = 'color: ' . $instance['color'] . ';';
			}

			if ( ! empty( $instance['icon_size'] ) ) {
				$icon_styles[] = 'font-size: ' . diefinnhutte_select_filter_px( $instance['icon_size'] ) . 'px';
			}

			if ( ! empty( $instance['margin'] ) ) {
				$icon_styles[] = 'margin: ' . $instance['margin'] . ';';
			}

			$link        = ! empty( $instance['link'] ) ? $instance['link'] : '#';
			$target      = ! empty( $instance['target'] ) ? $instance['target'] : '_self';
			$hover_color = ! empty( $instance['hover_color'] ) ? $instance['hover_color'] : '';

			$icon_holder_html = '';
			if ( ! empty( $instance['icon_pack'] ) ) {
				$icon_class   = array( 'qodef-social-icon-widget' );
				$icon_class[] = ! empty( $instance['fa_icon'] ) && $instance['icon_pack'] === 'font_awesome' ? $instance['fa_icon'] : '';
				$icon_class[] = ! empty( $instance['fe_icon'] ) && $instance['icon_pack'] === 'font_elegant' ? $instance['fe_icon'] : '';
				$icon_class[] = ! empty( $instance['ion_icon'] ) && $instance['icon_pack'] === 'ion_icons' ? $instance['ion_icon'] : '';
				$icon_class[] = ! empty( $instance['linea_icon'] ) && $instance['icon_pack'] === 'linea_icons' ? $instance['linea_icon'] : '';
				$icon_class[] = ! empty( $instance['linear_icon'] ) && $instance['icon_pack'] === 'linear_icons' ? 'lnr ' . $instance['linear_icon'] : '';
				$icon_class[] = ! empty( $instance['simple_line_icon'] ) && $instance['icon_pack'] === 'simple_line_icons' ? $instance['simple_line_icon'] : '';
				$icon_class[] = ! empty( $instance['dripicon'] ) && $instance['icon_pack'] === 'dripicons' ? $instance['dripicon'] : '';

				$icon_class = implode( ' ', $icon_class );

				$icon_holder_html = '<span class="' . $icon_class . '"></span>';
			}
			?>
            <a class="qodef-social-icon-widget-holder qodef-icon-has-hover" <?php echo diefinnhutte_select_get_inline_attr( $hover_color, 'data-hover-color' ); ?> <?php diefinnhutte_select_inline_style( $icon_styles ) ?>
               href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<?php if ( isset( $instance['icon_text'] ) && $instance['icon_text'] === 'text' && isset( $instance['social_text'] ) && $instance['social_text'] !== '' ) { ?>
                    <span><?php echo esc_html( $instance['social_text'] ); ?></span>
				<?php } else {
					echo wp_kses_post( $icon_holder_html );
				} ?>
            </a>
			<?php
		}
	}
}