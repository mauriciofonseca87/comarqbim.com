<div <?php diefinnhutte_select_class_attribute($additional_classes); ?> >
	<?php if($link != '') { ?>
		<a class="qodef-cfi-link" href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($link_target) ?>"></a>
	<?php } ?>
	<div class="qodef-cfi-img-holder" <?php echo diefinnhutte_select_get_inline_style($holder_styles); ?>>
		<div class="qodef-cfi-img-holder-inner">
			<img src="<?php echo wp_get_attachment_url($initial_image,'full');?>" alt="<?php echo get_the_title($initial_image) ?>" />
			<div class="qodef-cfi-image-hover" style="background-image: url(<?php echo wp_get_attachment_url($hover_image,'full');?>);"></div>
		</div>
	</div>
	<?php if ($title != '') { ?>
		<div class="qodef-cfi-title-holder">
			<h4 class="qodef-cfi-title"><?php echo esc_attr($title) ?></h4>
		</div>
	<?php } ?>
</div>