<div class="qodef-portfolio-list-holder qodef-full-width  qodef-disable-bottom-space <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
    <div class="qodef-pl-inner qodef-full-width-inner qodef-outer-space qodef-vertical-item-showcase-list-wrapper clearfix">
        <div class="qodef-pl-showcase-left">
            <div class="qodef-pl-showcase-left-inner">
                <?php
                if($query_results->have_posts()):
                    while ( $query_results->have_posts() ) : $query_results->the_post();
                        echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item', 'vertical-showcase', $params);
                    endwhile;
                else:
                    echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/posts-not-found');
                endif;

                wp_reset_postdata();
                ?>
            </div>
        </div>
        <div class="qodef-pl-showcase-right">
            <?php
            if($query_results->have_posts()):
                while ( $query_results->have_posts() ) : $query_results->the_post();
                    ?>
                    <?php
                    echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params);
                    ?><?php
                endwhile;
            endif;

            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>