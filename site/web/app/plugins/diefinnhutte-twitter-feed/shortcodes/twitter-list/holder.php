<div class="qodef-twitter-list-holder qodef-grid-list <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-tl-wrapper qodef-outer-space">
        <?php if ( isset($response) && $response->status ) { ?>
            <?php if ( is_array( $response->data ) && count( $response->data ) ) { ?>
                <ul class="qodef-twitter-list">
                    <?php foreach ( $response->data as $tweet ) { ?>
                        <?php
                            $params['tweet'] = $tweet;
                            echo diefinnhutte_twitter_get_shortcode_module_template_part('templates/item', 'twitter-list', '', $params);
                        ?>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <div class="qodef-twitter-message">
                    <?php echo esc_html( $response->message ); ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="qodef-twitter-not-connected">
                <?php esc_html_e( 'It seams that you haven\'t connected with your Twitter account', 'diefinnhutte-twitter-feed' ); ?>
            </div>
        <?php } ?>
    </div>
</div>