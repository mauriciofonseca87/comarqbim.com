<div class="qodef-pl-holder qodef-grid-list qodef-disable-bottom-space <?php echo esc_attr( $holder_classes ) ?>" <?php echo wp_kses( $holder_data, array( 'data' ) ); ?>>
	<?php if($query_results->have_posts()): ?>
    <?php echo diefinnhutte_select_get_woo_shortcode_module_template_part('templates/parts/categories-filter', 'product-list', '', $params);?>
        <div class="qodef-prl-loading">
            <span class="qodef-prl-loading-msg"><?php esc_html_e('Loading...', 'diefinnhutte') ?></span>
        </div>
        <div class="qodef-pl-outer qodef-outer-space">
			<?php while ( $query_results->have_posts() ) : $query_results->the_post();
				echo diefinnhutte_select_get_woo_shortcode_module_template_part( 'templates/parts/' . $info_position, 'product-list', '', $params );
			endwhile;
			else:
            diefinnhutte_select_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
        endif;
        wp_reset_postdata();
        ?>
        </div>
	<?php
	$unique_id = rand( 1000, 9999 );
	wp_nonce_field( 'qodef_product_ajax_load_category_nonce_' . $unique_id, 'qodef_product_ajax_load_category_nonce_' . $unique_id );
	?>
</div>