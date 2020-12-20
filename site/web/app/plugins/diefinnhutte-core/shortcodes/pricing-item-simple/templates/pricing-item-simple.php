<div class="qodef-price-item-simple qodef-item-space <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-pis-inner">
        <ul>
            <li class="qodef-pis-prices">
                <sup class="qodef-pis-value" <?php echo diefinnhutte_select_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></sup>
                <span class="qodef-pis-price" <?php echo diefinnhutte_select_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
            </li>
            <li class="qodef-pis-content-holder">
                <ul>
                    <li class="qodef-pis-title-holder">
                        <span class="qodef-pis-title" <?php echo diefinnhutte_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
                    </li>
                    <li class="qodef-pis-additional-title-holder">
                        <span class="qodef-pis-additional-title" <?php echo diefinnhutte_select_get_inline_style($additional_title_styles); ?>><?php echo esc_html($additional_title); ?></span>
                    </li>
                    <li class="qodef-pis-content">
                        <?php echo do_shortcode($content); ?>
                    </li>
                    <?php
                    if (!empty($button_text)) { ?>
                        <li class="qodef-pis-button">
                            <?php echo diefinnhutte_select_get_button_html(array(
                                'link'                   => $link,
                                'text'                   => $button_text,
                                'type'                   => $button_type,
                                'size'                   => 'medium',
                                'color'                  => $button_color,
                                'background_color'       => $button_background_color,
                                'border_color'           => $button_border_color,
                            )); ?>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
    </div>
</div>