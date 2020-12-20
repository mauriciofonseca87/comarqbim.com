<div class="qodef-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>" <?php diefinnhutte_select_inline_style($holder_styles); ?>>
    <div class="qodef-testimonials qodef-owl-slider" <?php echo diefinnhutte_select_get_inline_attrs( $data_attr ) ?>>

    <?php if ( $query_results->have_posts() ):
        $current_id = 0;
        while ( $query_results->have_posts() ) : $query_results->the_post();
            $title    = get_post_meta( get_the_ID(), 'qodef_testimonial_title', true );
            $text     = get_post_meta( get_the_ID(), 'qodef_testimonial_text', true );
            $author   = get_post_meta( get_the_ID(), 'qodef_testimonial_author', true );
            $position = get_post_meta( get_the_ID(), 'qodef_testimonial_author_position', true );
            $current_id++;

    ?>

            <div class="qodef-testimonial-content" id="qodef-testimonials-<?php echo esc_attr( $current_id ) ?>" data-index="<?php echo esc_attr($current_id); ?>">
                <div class="qodef-testimonial-text-holder">
                    <?php if ( ! empty( $title ) ) { ?>
                        <h2 itemprop="name" class="qodef-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h2>
                    <?php } ?>
                    <?php if ( ! empty( $text ) ) { ?>
                        <p class="qodef-testimonial-text"><?php echo esc_html( $text ); ?></p>
                    <?php } ?>
                    <?php if ( ! empty( $author ) ) { ?>
                        <h6 class="qodef-testimonial-author">
                            <span class="qodef-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
                            <?php if ( ! empty( $position ) ) { ?>
                                <span class="qodef-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                            <?php } ?>
                        </h6>
                    <?php } ?>
                </div>
            </div>

    <?php
        endwhile;
    else:
        echo esc_html__( 'Sorry, no posts matched your criteria.', 'diefinnhutte-core' );
    endif;

    wp_reset_postdata();
    ?>

    </div>
    <div class="qodef-testimonials-image-holder">
        <?php
        if($query_results->have_posts()):
            $current_id = 0;
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $current_id++;
                ?>
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="qodef-testimonial-image" data-index="<?php echo esc_attr($current_id); ?>" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>);">
                    </div>
                <?php }
                ?>
            <?php
            endwhile;
        endif;

        wp_reset_postdata();
        ?>
    </div>
</div>