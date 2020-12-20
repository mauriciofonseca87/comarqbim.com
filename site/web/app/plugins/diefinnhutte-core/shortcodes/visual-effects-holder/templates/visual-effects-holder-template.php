<div class="qodef-visual-effects-holder <?php echo esc_attr($holder_classes); ?>" <?php echo diefinnhutte_select_get_inline_attrs($holder_data); ?>>
	<div class="qodef-veh-inner">
		<?php if ($effect_type == 'uncover') : ?>
			<div class="qodef-veh-mask"  <?php echo diefinnhutte_select_get_inline_style($mask_styles); ?>></div>
		<?php endif; ?>
		<div class="qodef-veh-content">
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>