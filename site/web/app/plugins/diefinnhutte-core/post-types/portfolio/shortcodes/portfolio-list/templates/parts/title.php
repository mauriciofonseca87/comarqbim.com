<?php if ($enable_title === 'yes') {
	$title_tag = !empty($title_tag) ? $title_tag : 'h4';
	$title_styles = $this_object->getTitleStyles($params);
	?>
	<<?php echo esc_attr($title_tag); ?> itemprop="name" class="qodef-pli-title entry-title" <?php diefinnhutte_select_inline_style($title_styles); ?>>
		<span><?php echo esc_attr(get_the_title()); ?></span>
	</<?php echo esc_attr($title_tag); ?>>
<?php } ?>