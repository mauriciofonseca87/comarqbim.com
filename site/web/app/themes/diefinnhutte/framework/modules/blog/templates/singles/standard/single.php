<?php

diefinnhutte_select_get_single_post_format_html( $blog_single_type );

do_action( 'diefinnhutte_select_action_after_article_content' );

diefinnhutte_select_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

diefinnhutte_select_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

diefinnhutte_select_get_module_template_part( 'templates/parts/single/comments', 'blog' );

diefinnhutte_select_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );