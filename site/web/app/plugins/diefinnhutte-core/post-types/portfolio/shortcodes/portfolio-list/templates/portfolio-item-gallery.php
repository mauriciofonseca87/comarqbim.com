<?php
$media = diefinnhutte_core_get_portfolio_single_media();
?>
<article class="qodef-pl-item qodef-item-space <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
	<div class="qodef-pl-item-inner">
		<?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'layout-collections/' . $item_style, '', $params ); ?>
		
		<?php if ( is_array( $media ) && count( $media ) > 0 ) : ?>
			<?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/image-gallery', '', $params ); ?>
		<?php endif; ?>
	</div>
</article>