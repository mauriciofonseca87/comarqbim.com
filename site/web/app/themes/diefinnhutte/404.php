<?php get_header(); ?>
				<div class="qodef-page-not-found">
					<?php
					$qodef_title_image_404 = diefinnhutte_select_options()->getOptionValue( '404_page_title_image' );
					$qodef_title_404       = diefinnhutte_select_options()->getOptionValue( '404_title' );
					$qodef_subtitle_404    = diefinnhutte_select_options()->getOptionValue( '404_subtitle' );
					$qodef_text_404        = diefinnhutte_select_options()->getOptionValue( '404_text' );
					$qodef_button_label    = diefinnhutte_select_options()->getOptionValue( '404_back_to_home' );
					$qodef_button_style    = diefinnhutte_select_options()->getOptionValue( '404_button_style' );
					
					if ( ! empty( $qodef_title_image_404 ) ) { ?>
						<div class="qodef-404-title-image">
							<img src="<?php echo esc_url( $qodef_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'diefinnhutte' ); ?>" />
						</div>
					<?php } ?>
					
					<h1 class="qodef-404-title">
						<?php if ( ! empty( $qodef_title_404 ) ) {
							echo esc_html( $qodef_title_404 );
						} else {
							esc_html_e( '404', 'diefinnhutte' );
						} ?>
					</h1>
					
					<h3 class="qodef-404-subtitle">
						<?php if ( ! empty( $qodef_subtitle_404 ) ) {
							echo esc_html( $qodef_subtitle_404 );
						} else {
							esc_html_e( 'Page not found', 'diefinnhutte' );
						} ?>
					</h3>
					
					<p class="qodef-404-text">
						<?php if ( ! empty( $qodef_text_404 ) ) {
							echo esc_html( $qodef_text_404 );
						} else {
							esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'diefinnhutte' );
						} ?>
					</p>
					
					<?php
						$button_params = array(
							'link' => esc_url( home_url( '/' ) ),
							'text' => ! empty( $qodef_button_label ) ? $qodef_button_label : esc_html__( 'Back to home', 'diefinnhutte' )
						);
					
						if ( $qodef_button_style == 'light-style' ) {
							$button_params['custom_class'] = 'qodef-btn-light-style';
						}
						
						get_search_form();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>