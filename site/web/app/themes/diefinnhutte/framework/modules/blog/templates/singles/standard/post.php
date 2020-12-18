<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-heading">
            <?php diefinnhutte_select_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-info-top">
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-text-main">
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php the_content(); ?>
                    <?php do_action('diefinnhutte_select_action_single_link_pages'); ?>
                </div>
                <div class="qodef-post-info-bottom clearfix">
                    <div class="qodef-post-info-bottom-under">
	                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                        <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                        <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-post-info-bottom-left">
	                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-post-info-bottom-right">
                        <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>