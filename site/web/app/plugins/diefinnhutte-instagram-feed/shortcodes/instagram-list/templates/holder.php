<div class="qodef-instagram-list-holder <?php echo esc_attr($holder_classes); ?>">
    <?php if ( is_array( $images_array ) && count( $images_array ) ) { ?>
	    <ul class="qodef-instagram-feed qodef-outer-space <?php echo esc_attr($carousel_classes); ?> clearfix" <?php echo diefinnhutte_select_get_inline_attrs( $data_attr ) ?>>
	    <?php
	    foreach ( $images_array as $image ) { ?>
		    <li class="qodef-il-item qodef-item-space">
			    <a href="<?php echo esc_url( $instagram_api->getHelper()->getImageLink( $image ) ); ?>" target="_blank">
				    <?php echo diefinnhutte_select_kses_img( $instagram_api->getHelper()->getImageHTML( $image ) ); ?>
				    <?php if ($show_instagram_icon =='yes' ) { ?>
                        <span class="qodef-instagram-icon"><i class="social_instagram"></i></span>
				    <?php } ?>
			    </a>
		    </li>
	    <?php } ?>
    </ul>
    <?php } else { ?>
        <div class="qodef-instagram-not-connected">
            <?php esc_html_e( 'It seams that you haven\'t connected with your Instagram account', 'diefinnhutte-instagram-feed' ); ?>
        </div>
    <?php } ?>
</div>