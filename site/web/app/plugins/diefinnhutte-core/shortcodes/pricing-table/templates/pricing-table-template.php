<?php
$background_image   = '';
$image_id = wp_get_attachment_url( $image );
$background_image = 'background-image: url( ' . $image_id . ')';
?>

<div class="qodef-price-table qodef-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-pt-inner">
        <div class="qodef-pt-image-background-window">
            <div class="qodef-pt-image-background" <?php diefinnhutte_select_inline_style($background_image); ?>></div>
        </div>
		<ul <?php echo diefinnhutte_select_get_inline_style($holder_styles); ?>>
			<li class="qodef-pt-title-holder">
				<h4 class="qodef-pt-title" <?php echo diefinnhutte_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></h4>
			</li>
			<li class="qodef-pt-prices">
				<sup class="qodef-pt-value" <?php echo diefinnhutte_select_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></sup>
				<span class="qodef-pt-price" <?php echo diefinnhutte_select_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<h6 class="qodef-pt-mark" <?php echo diefinnhutte_select_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
			</li>
			<li class="qodef-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="qodef-pt-button">
					<?php echo diefinnhutte_select_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'medium',
                        'custom_class' => 'qodef-btn-custom-hover-color',
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>