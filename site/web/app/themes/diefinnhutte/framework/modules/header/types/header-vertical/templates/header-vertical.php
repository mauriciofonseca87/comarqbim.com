<?php do_action( 'diefinnhutte_select_action_before_page_header' ); ?>

    <aside class="qodef-vertical-menu-area <?php echo esc_attr( $holder_class ); ?>">
        <div class="qodef-vertical-menu-area-inner">
            <div class="qodef-vertical-area-background"></div>
			<?php if ( ! $hide_logo ) {
				diefinnhutte_select_get_logo();
			} ?>
			<?php diefinnhutte_select_get_header_vertical_main_menu(); ?>

			<?php if ( diefinnhutte_select_is_header_widget_area_active( 'one' ) ): ?>
                <div class="qodef-vertical-area-widget-holder">
					<?php diefinnhutte_select_get_header_widget_area_one(); ?>
                </div>
			<?php endif; ?>

        </div>
    </aside>

<?php do_action( 'diefinnhutte_select_action_after_page_header' ); ?>