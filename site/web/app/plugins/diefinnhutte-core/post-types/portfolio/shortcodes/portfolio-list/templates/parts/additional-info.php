<?php if ($enable_additional_info === 'yes') { ?>
    <?php
    $additional_info_label = $this_object->getAdditionalInfoLabel($params);
    $additional_info_value = $this_object->getAdditionalInfoValue($params);
    $additional_info_link = $this_object->getAdditionalInfoLink($params);
    ?>
    <p class="qodef-pli-additional-info">
        <span class="qodef-pli-additional-info-label"><?php echo esc_html($additional_info_label); ?></span>
        <?php if($additional_info_link !== '') { ?>
        <a itemprop="url" href="<?php echo esc_url($additional_info_link); ?>" target="_blank"><?php } ?>
        <span class="qodef-pli-additional-info-value"><?php echo esc_html($additional_info_value); ?></span>
        <?php if($additional_info_link !== '') { ?></a><?php } ?>
    </p>
<?php } ?>