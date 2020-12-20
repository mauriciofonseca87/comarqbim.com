<section class="qodef-side-menu">
    <div class="qodef-side-area-inner">
        <a <?php diefinnhutte_select_class_attribute( $close_icon_classes ); ?> href="#">
            <?php echo diefinnhutte_select_get_icon_sources_html( 'side_area', true ); ?>
        </a>
        <?php if ( is_active_sidebar( 'sidearea' ) ) {
            dynamic_sidebar( 'sidearea' );
        } ?>
    </div>
    <div class="qodef-side-area-bottom">
		<?php if ( is_active_sidebar( 'sidearea-bottom' ) ) {
			dynamic_sidebar( 'sidearea-bottom' );
		} ?>
    </div>
</section>