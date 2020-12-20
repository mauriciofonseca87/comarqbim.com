<div class="qodef-workflow-item">
    <span class="line" style="<?php echo esc_attr($line_color); ?>"></span>
    <div class="qodef-workflow-item-inner">
        <div class="qodef-workflow-image">
            <?php if(!empty($image)){
                echo wp_get_attachment_image($image, 'full');
            } ?>
        </div>
        <div class="qodef-workflow-text">
            <span class="circle" style="<?php echo esc_attr($circle_border_color.$circle_background_color); ?>"></span>
            <?php if(!empty($title)){ ?>
                <h4><?php echo esc_attr($title) ?></h4>
            <?php } ?>
            <?php if(!empty($text)){ ?>
                <p class="text"><?php echo esc_attr($text) ?></p>
            <?php } ?>
        </div>
    </div>
</div>