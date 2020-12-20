<button type="submit" <?php diefinnhutte_select_inline_style($button_styles); ?> <?php diefinnhutte_select_class_attribute($button_classes); ?> <?php echo diefinnhutte_select_get_inline_attrs($button_data); ?> <?php echo diefinnhutte_select_get_inline_attrs($button_custom_attrs); ?>>
	<?php
        if( $simple_type === 'with_icon') {
	        echo diefinnhutte_select_icon_collections()->renderIcon( 'arrow_right', 'font-elegant' );
        }
    ?>
    <span class="qodef-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo diefinnhutte_select_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>