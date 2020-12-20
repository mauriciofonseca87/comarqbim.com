<?php
$blog_single_navigation = diefinnhutte_select_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = diefinnhutte_select_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
    <div class="qodef-blog-single-navigation">
        <div class="qodef-blog-single-navigation-inner clearfix">
			<?php
			/* Single navigation section - SETTING PARAMS */
			$same_cat_flag = false;
			if($blog_navigation_through_same_category){
				$same_cat_flag = true;
			}
			$prevPost = get_previous_post($same_cat_flag);
			$nextPost = get_next_post($same_cat_flag);

			if(isset($prevPost) && $prevPost !== '' && $prevPost !== null){

				$post_navigation['prev']['post'] = $prevPost;

				$post_navigation['prev']['classes'] = array(
					'qodef-blog-single-prev'
				);

				$image = get_the_post_thumbnail($prevPost->ID, array(75, 75));
				$post_navigation['prev']['image'] = '';

				if($image !== ''){
					$post_navigation['prev']['image'] = '<div class="qodef-blog-single-nav-thumbnail">'.wp_kses_post($image).'</div>';
					$post_navigation['prev']['classes'][] = 'qodef-with-image';
				}

				$post_navigation['prev']['mark'] = '<span class="qodef-blog-single-nav-mark arrow_carrot-left"></span>';
				$post_navigation['prev']['title'] = '<h6 class="qodef-blog-single-nav-title">'.get_the_title($prevPost->ID).'</h6>';
				$post_navigation['prev']['label'] = '<span class="qodef-blog-single-nav-label">'.esc_html__('prev', 'diefinnhutte').'</span>';

			}

			if(isset($nextPost) && $nextPost !== '' && $nextPost !== null){

				$post_navigation['next']['post'] = $nextPost;

				$post_navigation['next']['classes'] = array(
					'qodef-blog-single-next'
				);

				$image = get_the_post_thumbnail($nextPost->ID,  array(75, 75));
				$post_navigation['next']['image'] = '';

				$post_navigation['next']['title'] = '<h6 class="qodef-blog-single-nav-title">'.get_the_title($nextPost->ID).'</h6>';

				if($image !== ''){
					$post_navigation['next']['classes'][] = 'qodef-with-image';
					$post_navigation['next']['image'] = '<div class="qodef-blog-single-nav-thumbnail">'.wp_kses_post($image).'</div>';
				}

				$post_navigation['next']['mark'] = '<span class="qodef-blog-single-nav-mark arrow_carrot-right"></span>';
				$post_navigation['next']['label'] = '<span class="qodef-blog-single-nav-label">'.esc_html__('next', 'diefinnhutte').'</span>';
			}


			/* Single navigation section - RENDERING */

			if(isset($post_navigation['prev'])){ ?>

                <div class="<?php echo implode(' ', $post_navigation['prev']['classes']) ?>">
                    <a itemprop="url" href="<?php echo get_permalink($post_navigation['prev']['post']->ID); ?>">
						<?php echo wp_kses_post($post_navigation['prev']['image']); ?>
                        <div class="qodef-blog-single-wrapper">
                            <?php
                            echo wp_kses_post($post_navigation['prev']['mark']);
                            echo wp_kses_post($post_navigation['prev']['label']);
                            echo wp_kses_post($post_navigation['prev']['title']);
                            ?>
                        </div>
                    </a>
                </div>

			<?php }

			if(isset($post_navigation['next'])){ ?>
                <div class="<?php echo implode(' ', $post_navigation['next']['classes']) ?>">
                    <a itemprop="url" href="<?php echo get_permalink($post_navigation['next']['post']->ID); ?>">
                        <div class="qodef-blog-single-wrapper">
                            <?php
                            echo wp_kses_post($post_navigation['next']['label']);
                            echo wp_kses_post($post_navigation['next']['mark']);
                            echo wp_kses_post($post_navigation['next']['title']);
                            ?>
                        </div>
	                    <?php echo wp_kses_post($post_navigation['next']['image']); ?>
                    </a>
                </div>
			<?php } ?>
        </div>
    </div>
<?php } ?>