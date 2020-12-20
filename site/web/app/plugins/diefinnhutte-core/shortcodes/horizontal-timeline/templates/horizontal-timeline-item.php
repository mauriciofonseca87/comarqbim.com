<div class="qodef-ht-content-item">
    <?php if ( ! empty( $content_image ) ): ?>
        <div class="qodef-hti-content-image">
            <?php echo wp_get_attachment_image( $content_image, 'full' ); ?>
        </div>
    <?php endif; ?>
    <div class="qodef-hti-circle"></div>
    <?php if( $title !== '' || $subtitle !== '' || $custom_date !=='') { ?>
    <div class="qodef-hti-content-value">
        <?php if($title !== '') { ?>
            <h4 class="qodef-hti-title"><?php echo esc_html($title); ?></h4>
        <?php } ?>
        <?php if($subtitle !== '') { ?>
            <p class="qodef-hti-subtitle"><?php echo esc_html($subtitle); ?></p>
        <?php } ?>
        <?php if($custom_date !== '') { ?>
            <p class="qodef-hti-date"><?php echo esc_html($custom_date); ?></p>
        <?php } ?>
    </div>
    <?php } ?>
</div>