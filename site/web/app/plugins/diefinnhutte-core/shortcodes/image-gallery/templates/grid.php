<?php
$i    = 0;
$rand = rand( 0, 1000 );
?>
<div class="qodef-image-gallery qodef-grid-list qodef-disable-bottom-space <?php echo esc_attr( $holder_classes ); ?>">
	<div class="qodef-ig-inner qodef-outer-space">
		<?php foreach ( $images as $image ) { ?>
			<div class="qodef-ig-image qodef-item-space">
				<div class="qodef-ig-image-inner">
					<?php if ( $image_behavior === 'lightbox' ) { ?>
						<a itemprop="image" class="qodef-ig-lightbox" href="<?php echo esc_url( $image['url'] ); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr( $rand ); ?>]" title="<?php echo esc_attr( $image['title'] ); ?>">
					<?php } else if ( $image_behavior === 'custom-link' && ! empty( $custom_links ) ) { ?>
						<a itemprop="url" class="qodef-ig-custom-link" href="<?php echo esc_url( $custom_links[ $i ++ ] ); ?>" target="<?php echo esc_attr( $custom_link_target ); ?>" title="<?php echo esc_attr( $image['title'] ); ?>">
					<?php } ?>
						<?php if ( is_array( $image_size ) && count( $image_size ) ) :
							echo diefinnhutte_select_generate_thumbnail( $image['image_id'], null, $image_size[0], $image_size[1] );
						else:
							echo wp_get_attachment_image( $image['image_id'], $image_size );
						endif; ?>
                        <?php if (!empty($custom_titles)) { ?>
                            <span class="qodef-ig-custom-title">
                            <?php echo esc_html($custom_titles[$i]); ?>
                            </span>
                        <?php } ?>
					<?php if ( $image_behavior === 'lightbox' || $image_behavior === 'custom-link' ) { ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>