<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-text">
	        <?php diefinnhutte_select_get_module_template_part('templates/parts/image-background', 'blog', ''); ?>
            <div class="qodef-post-text-inner">
                <div class="qodef-post-mark">
                    <span class="icon_quotations qodef-quote-mark"></span>
                </div>
                <div class="qodef-post-info-top">
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-text-main">
                    <?php diefinnhutte_select_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="qodef-post-additional-content">
        <?php the_content(); ?>
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
</article>