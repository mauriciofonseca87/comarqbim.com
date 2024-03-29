<?php

if ( class_exists( 'DieFinnhutteCoreClassWidget' ) ) {
	class DieFinnhutteSelectClassWoocommerceDropdownCart extends DieFinnhutteCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_woocommerce_dropdown_cart',
				esc_html__( 'DieFinnhutte Woocommerce Dropdown Cart', 'diefinnhutte' ),
				array( 'description' => esc_html__( 'Display a shop cart icon with a dropdown that shows products that are in the cart', 'diefinnhutte' ), )
			);

			$this->setParams();
		}

		protected function setParams() {
			$this->params = array(
				array(
					'type'        => 'textfield',
					'name'        => 'woocommerce_dropdown_cart_margin',
					'title'       => esc_html__( 'Icon Margin', 'diefinnhutte' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'diefinnhutte' )
				)
			);
		}

		public function widget( $args, $instance ) {
			extract( $args );

			global $woocommerce;

			$icon_styles = array();

			if ( $instance['woocommerce_dropdown_cart_margin'] !== '' ) {
				$icon_styles[] = 'margin: ' . $instance['woocommerce_dropdown_cart_margin'];
			}

			$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;

			$dropdown_cart_icon_class = diefinnhutte_select_get_dropdown_cart_icon_class();
			$dropdown_top_position    = diefinnhutte_select_options()->getOptionValue( 'dropdown_top_position' );

			if ( ! empty( $dropdown_top_position ) ) {
				$dd_top_position = 'top: ' . $dropdown_top_position . '%';
			}
			?>
            <div class="qodef-shopping-cart-holder" <?php diefinnhutte_select_inline_style( $icon_styles ) ?>>
                <div class="qodef-shopping-cart-inner">
                    <a itemprop="url" <?php diefinnhutte_select_class_attribute( $dropdown_cart_icon_class ); ?> href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                        <span class="qodef-cart-icon"><?php echo diefinnhutte_select_get_icon_sources_html( 'dropdown_cart', false, array( 'dropdown_cart' => 'yes' ) ); ?></span>
                        <span class="qodef-cart-number">(<?php echo sprintf( _n( '%d', '%d', WC()->cart->cart_contents_count, 'diefinnhutte' ), WC()->cart->cart_contents_count ); ?>)</span>
                    </a>
                    <div class="qodef-shopping-cart-dropdown" <?php diefinnhutte_select_inline_style( $dd_top_position ) ?>>
                        <ul>
							<?php if ( ! $cart_is_empty ) : ?>
								<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
									$_product = $cart_item['data'];
									// Only display if allowed
									if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
										continue;
									}
									// Get price
									$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
									?>
                                    <li>
                                        <div class="qodef-item-image-holder">
                                            <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
												<?php echo wp_kses( $_product->get_image(), array(
													'img' => array(
														'src'    => true,
														'width'  => true,
														'height' => true,
														'class'  => true,
														'alt'    => true,
														'title'  => true,
														'id'     => true
													)
												) ); ?>
                                            </a>
                                        </div>
                                        <div class="qodef-item-info-holder">
                                            <h6 itemprop="name" class="qodef-product-title">
                                                <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>"><?php echo apply_filters( 'diefinnhutte_select_woo_widget_cart_product_title', $_product->get_name(), $_product ); ?></a>
                                            </h6>
											<?php if ( apply_filters( 'diefinnhutte_select_woo_cart_enable_quantity', true ) ) { ?>
                                                <span class="qodef-quantity"><?php echo esc_html( $cart_item['quantity'] ) . ' x'; ?></span>
											<?php } ?>
											<?php echo apply_filters( 'diefinnhutte_select_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
											<?php echo apply_filters( 'diefinnhutte_select_woo_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'diefinnhutte' ) ), $cart_item_key ); ?>
                                        </div>
                                    </li>
								<?php endforeach; ?>
                                <li class="qodef-cart-bottom">
                                    <div class="qodef-subtotal-holder clearfix">
                                        <span class="qodef-total"><?php esc_html_e( 'Order Total:', 'diefinnhutte' ); ?></span>
                                        <span class="qodef-total-amount">
                                            <?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
	                                            'span' => array(
		                                            'class' => true,
		                                            'id'    => true
	                                            )
                                            ) ); ?>
                                        </span>
                                    </div>
                                    <div class="qodef-btn-holder clearfix">
                                        <a itemprop="url" href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="qodef-view-cart"
                                                data-title="<?php esc_attr_e( 'View Cart', 'diefinnhutte' ); ?>">
                                            <span><?php esc_html_e( 'View Cart', 'diefinnhutte' ); ?></span>
                                        </a>
                                        <a itemprop="url" href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="qodef-checkout"
                                                data-title="<?php esc_attr_e( 'Checkout', 'diefinnhutte' ); ?>">
                                            <span><?php esc_html_e( 'Checkout', 'diefinnhutte' ); ?></span>
                                        </a>
                                    </div>
                                </li>
							<?php else : ?>
                                <li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'diefinnhutte' ); ?></li>
							<?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
			<?php
		}
	}

	add_filter( 'woocommerce_add_to_cart_fragments', 'diefinnhutte_select_woocommerce_header_add_to_cart_fragment' );

	function diefinnhutte_select_woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;

		$dropdown_cart_icon_class = diefinnhutte_select_get_dropdown_cart_icon_class();
		$dropdown_top_position    = diefinnhutte_select_options()->getOptionValue( 'dropdown_top_position' );

		if ( ! empty( $dropdown_top_position ) ) {
			$dd_top_position = 'top: ' . $dropdown_top_position . '%';
		}
		?>
        <div class="qodef-shopping-cart-inner">
            <a itemprop="url" <?php diefinnhutte_select_class_attribute( $dropdown_cart_icon_class ); ?> href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                <span class="qodef-cart-icon"><?php echo diefinnhutte_select_get_icon_sources_html( 'dropdown_cart', false, array( 'dropdown_cart' => 'yes' ) ); ?></span>
                <span class="qodef-cart-number">(<?php echo sprintf( _n( '%d', '%d', WC()->cart->cart_contents_count, 'diefinnhutte' ), WC()->cart->cart_contents_count ); ?>)</span>
            </a>
            <div class="qodef-shopping-cart-dropdown" <?php diefinnhutte_select_inline_style( $dd_top_position ) ?>>
                <ul>
					<?php if ( ! $cart_is_empty ) : ?>
						<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
							$_product = $cart_item['data'];
							// Only display if allowed
							if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
								continue;
							}
							// Get price
							$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
							?>
                            <li>
                                <div class="qodef-item-image-holder">
                                    <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
										<?php echo wp_kses( $_product->get_image(), array(
											'img' => array(
												'src'    => true,
												'width'  => true,
												'height' => true,
												'class'  => true,
												'alt'    => true,
												'title'  => true,
												'id'     => true
											)
										) ); ?>
                                    </a>
                                </div>
                                <div class="qodef-item-info-holder">
                                    <h6 itemprop="name" class="qodef-product-title">
                                        <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>"><?php echo apply_filters( 'diefinnhutte_select_woo_widget_cart_product_title', $_product->get_name(), $_product ); ?></a>
                                    </h6>
									<?php if ( apply_filters( 'diefinnhutte_select_woo_cart_enable_quantity', true ) ) { ?>
                                        <span class="qodef-quantity"><?php echo esc_html( $cart_item['quantity'] ) . ' x'; ?></span>
									<?php } ?>
									<?php echo apply_filters( 'diefinnhutte_select_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
									<?php echo apply_filters( 'diefinnhutte_select_woo_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'diefinnhutte' ) ), $cart_item_key ); ?>
                                </div>
                            </li>
						<?php endforeach; ?>
                        <li class="qodef-cart-bottom">
                            <div class="qodef-subtotal-holder clearfix">
                                <span class="qodef-total"><?php esc_html_e( 'Order Total:', 'diefinnhutte' ); ?></span>
                                <span class="qodef-total-amount">
                                    <?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
	                                    'span' => array(
		                                    'class' => true,
		                                    'id'    => true
	                                    )
                                    ) ); ?>
                                </span>
                            </div>
                            <div class="qodef-btn-holder clearfix">
                                <a itemprop="url" href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="qodef-view-cart"
                                        data-title="<?php esc_attr_e( 'View Cart', 'diefinnhutte' ); ?>">
                                    <span><?php esc_html_e( 'View Cart', 'diefinnhutte' ); ?></span>
                                </a>
                                <a itemprop="url" href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="qodef-checkout"
                                        data-title="<?php esc_attr_e( 'Checkout', 'diefinnhutte' ); ?>">
                                    <span><?php esc_html_e( 'Checkout', 'diefinnhutte' ); ?></span>
                                </a>
                            </div>
                        </li>
					<?php else : ?>
                        <li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'diefinnhutte' ); ?></li>
					<?php endif; ?>
                </ul>
            </div>
        </div>

		<?php
		$fragments['div.qodef-shopping-cart-inner'] = ob_get_clean();

		return $fragments;
	}
}
?>