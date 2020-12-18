<div class="qodef-fullscreen-menu-holder-outer">
    <a href="javascript:void(0)" <?php diefinnhutte_select_class_attribute( $fullscreen_menu_icon_class ); ?>>
        <span class="qodef-fullscreen-menu-close-icon">
            <?php echo diefinnhutte_select_get_icon_sources_html( 'fullscreen_menu', true ); ?>
        </span>
        <span class="qodef-fullscreen-menu-opener-icon">
            <?php echo diefinnhutte_select_get_icon_sources_html( 'fullscreen_menu' ); ?>
        </span>
    </a>
    <div class="qodef-fullscreen-menu-holder">
        <div class="qodef-fullscreen-menu-holder-inner">
			<?php if ( $fullscreen_menu_in_grid ) : ?>
            <div class="qodef-container-inner">
				<?php endif; ?>

				<?php if ( diefinnhutte_select_is_header_widget_area_active( 'one' ) ) : ?>
                    <div class="qodef-fullscreen-side-menu-widget-wrapper">
                        <div class="qodef-fullscreen-side-menu-widget-holder">
							<?php diefinnhutte_select_get_header_widget_area_one(); ?>
                        </div>
                    </div>
				<?php endif; ?>

				<?php
				//Navigation
				diefinnhutte_select_get_module_template_part( 'templates/full-screen-menu-navigation', 'header/types/header-minimal' );;
				?>

				<?php if ( $fullscreen_menu_in_grid ) : ?>
            </div>
		<?php endif; ?>
        </div>
    </div>
</div>