<?php $title_styles = $this_object->getTitleStyles($params); ?>
<div class="qodef-pli-text-holder">
    <div class="qodef-pli-text-wrapper">
        <div class="qodef-pli-text">
            <?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>

            <h1 itemprop="name" class="qodef-pli-title entry-title" <?php diefinnhutte_select_inline_style($title_styles); ?>>
                <a itemprop="url" class="qodef-pli-title-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>">
                <?php echo esc_attr(get_the_title()); ?>
                </a>
            </h1>

            <div class="qodef-pli-author">
                <span class="qodef-pli-author-text">
                    <?php esc_html_e('By', 'diefinnhutte-core'); ?>
                </span>
                <?php the_author_meta('display_name'); ?>
            </div>
        </div>
    </div>
</div>

<?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params); ?>