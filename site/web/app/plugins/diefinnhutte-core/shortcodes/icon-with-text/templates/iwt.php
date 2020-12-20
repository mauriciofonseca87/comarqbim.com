<div <?php diefinnhutte_select_class_attribute($holder_classes); ?>>
	<div class="qodef-iwt-icon">
		<?php if(!empty($link)) : ?>
			<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
		<?php endif; ?>
			<?php if(!empty($custom_icon)) : ?>
				<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
			<?php else: ?>
				<?php echo diefinnhutte_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
			<?php endif; ?>
		<?php if(!empty($link)) : ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="qodef-iwt-content" <?php diefinnhutte_select_inline_style($content_styles); ?>>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="qodef-iwt-title" <?php diefinnhutte_select_inline_style($title_styles); ?>>
				<?php if(!empty($link)) : ?>
					<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
				<?php endif; ?>
				<span class="qodef-iwt-title-text"><?php echo esc_html($title); ?></span>
				<?php if(!empty($link)) : ?>
					</a>
				<?php endif; ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) {?>
			<p class="qodef-iwt-text" <?php diefinnhutte_select_inline_style($text_styles); ?>>
                <?php if(!empty($text_link)) { ?>
                <a href="<?php echo esc_url($text_link); ?>">
                <?php } ?>
                <?php echo esc_html($text); ?>
            <?php if(!empty($text_link)) { ?>
                </a>
            <?php }?>
            </p>
		<?php } ?>
	</div>
</div>