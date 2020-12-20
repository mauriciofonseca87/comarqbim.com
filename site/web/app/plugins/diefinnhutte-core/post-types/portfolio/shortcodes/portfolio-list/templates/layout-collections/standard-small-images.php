<?php
$content_styles = $this_object->getStandardContentStyles($params);

echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params); ?>

<div class="qodef-pli-text-holder" <?php diefinnhutte_select_inline_style($content_styles); ?>>
    <div class="qodef-pli-text-wrapper">
        <div class="qodef-pli-text">
            <?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', $item_style, $params); ?>

            <?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>

            <?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/images-count', $item_style, $params); ?>

            <?php echo diefinnhutte_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/additional-info', $item_style, $params); ?>
        </div>
    </div>
</div>