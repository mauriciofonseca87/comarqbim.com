<?php
$small_padding = $this_object->getSmallImagesItemPadding($params);
$small_padding_resp = $this_object->getSmallImagesItemPaddingResponsive($params);
$small_padding_style = '';
if($small_padding !== '' && $params['item_style'] === 'standard-small-images') {
    $small_padding_style = 'padding: '.$small_padding;
}
$custom_class = $small_padding_resp['data-item-class'];
?>
<article class="qodef-pl-item qodef-item-space <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?> <?php echo esc_attr($custom_class); ?>" <?php diefinnhutte_select_inline_style($small_padding_style); ?> <?php echo diefinnhutte_select_get_inline_attrs($small_padding_resp); ?>>
	<div class="qodef-pl-item-inner">
		<?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'layout-collections/' . $item_style, '', $params ); ?>

		<a itemprop="url" class="qodef-pli-link qodef-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>"></a>
	</div>
</article>