<?php
/**
 * Dropcaps shortcode template
 */
?>

<span class="qodef-dropcaps <?php echo esc_attr($dropcaps_class);?>" <?php diefinnhutte_select_inline_style($dropcaps_style);?>>
	<?php echo esc_html($letter);?>
</span>