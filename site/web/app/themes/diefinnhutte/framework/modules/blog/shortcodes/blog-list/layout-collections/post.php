<li class="qodef-bl-item qodef-item-space">
	<div class="qodef-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			diefinnhutte_select_get_module_template_part( 'templates/parts/media', 'blog', 'shortcode', $params );
		} ?>
        <div class="qodef-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="qodef-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                diefinnhutte_select_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                diefinnhutte_select_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_author == 'yes' ) {
			                diefinnhutte_select_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                diefinnhutte_select_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                diefinnhutte_select_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                diefinnhutte_select_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php diefinnhutte_select_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="qodef-bli-excerpt">
		        <?php diefinnhutte_select_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
		        <?php diefinnhutte_select_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
	        </div>
        </div>
	</div>
</li>