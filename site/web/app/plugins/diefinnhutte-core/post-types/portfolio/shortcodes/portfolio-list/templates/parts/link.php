<?php if ($enable_link === 'yes') {?>
    <?php echo diefinnhutte_select_get_button_html(array(
        'link' => get_the_permalink(),
        'text' => esc_html('read more', 'diefinnhutte-core'),
        'type' => 'simple',
        'size' => 'medium'
    )); ?>
<?php } ?>