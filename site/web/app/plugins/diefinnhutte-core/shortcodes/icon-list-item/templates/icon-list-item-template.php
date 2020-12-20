<?php $icon_html = diefinnhutte_select_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="qodef-icon-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo diefinnhutte_select_get_inline_style($holder_styles); ?>>
	<?php if($icon_side === 'icon-left') {?>
        <div class="qodef-il-icon-holder">
            <?php echo wp_kses_post($icon_html); ?>
        </div>
        <p class="qodef-il-text" <?php echo diefinnhutte_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
    <?php } else {?>
        <p class="qodef-il-text" <?php echo diefinnhutte_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
        <div class="qodef-il-icon-holder">
			<?php echo wp_kses_post($icon_html); ?>
        </div>
    <?php }?>
</div>