<?php

if ( class_exists( 'DieFinnhutteCoreClassWidget' ) ) {
        class DieFinnhutteSelectClassAuthorInfoWidget extends DieFinnhutteCoreClassWidget {
        public function __construct() {
            parent::__construct(
                'qodef_author_info_widget',
                esc_html__( 'DieFinnhutte Author Info Widget', 'diefinnhutte' ),
                array( 'description' => esc_html__( 'Add author info element to widget areas', 'diefinnhutte' ) )
            );

            $this->setParams();
        }

        protected function setParams() {
            $this->params = array(
                array(
                    'type'  => 'textfield',
                    'name'  => 'extra_class',
                    'title' => esc_html__( 'Custom CSS Class', 'diefinnhutte' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'widget_bottom_margin',
                    'title' => esc_html__( 'Widget Bottom Margin (px)', 'diefinnhutte' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'author_username',
                    'title' => esc_html__( 'Author Username', 'diefinnhutte' )
                )
            );
        }

        public function widget( $args, $instance ) {
            extract( $args );

            $extra_class = '';
            if ( ! empty( $instance['extra_class'] ) ) {
                $extra_class = $instance['extra_class'];
            }

            $widget_styles = array();
            if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
                $widget_styles[] = 'margin-bottom: ' . diefinnhutte_select_filter_px( $instance['widget_bottom_margin'] ) . 'px';
            }

            $authorID = 1;
            if ( ! empty( $instance['author_username'] ) ) {
                $author = get_user_by( 'login', $instance['author_username'] );

                if ( $author ) {
                    $authorID = $author->ID;
                }
            }

            $author_info = get_the_author_meta( 'description', $authorID );
            ?>

            <div class="widget qodef-author-info-widget <?php echo esc_attr( $extra_class ); ?>" <?php echo diefinnhutte_select_get_inline_style( $widget_styles ); ?>>
                <div class="qodef-aiw-inner">
                    <a itemprop="url" class="qodef-aiw-image" href="<?php echo esc_url( get_author_posts_url( $authorID ) ); ?>">
                        <?php echo diefinnhutte_select_kses_img( get_avatar( $authorID, 138 ) ); ?>
                    </a>
                    <?php if ( $author_info !== "" ) { ?>
                        <h4 class="qodef-aiw-title"><?php esc_html_e( 'About Author', 'diefinnhutte' ); ?></h4>
                        <p itemprop="description" class="qodef-aiw-text"><?php echo wp_kses_post( $author_info ); ?></p>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }
}