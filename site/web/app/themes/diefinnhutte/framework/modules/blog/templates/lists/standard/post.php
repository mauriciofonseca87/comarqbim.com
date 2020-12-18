<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-heading">
            <?php diefinnhutte_select_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-info-top">
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php
                    if(diefinnhutte_select_options()->getOptionValue('show_tags_area_blog') === 'yes') {
                            diefinnhutte_select_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params);
                    } ?>
                </div>
                <div class="qodef-post-text-main">
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php do_action('diefinnhutte_select_action_single_link_pages'); ?>
                </div>
                <div class="qodef-post-info-bottom clearfix">
                    <div class="qodef-post-info-bottom-left">
	                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>