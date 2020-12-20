<?php
$thumb_size = $this_object->getImageSize($params);
$small_featured_image = $this_object->getSmallFeaturedImage($params);
?>
<div class="qodef-pli-image qodef-pli-small-image">
    <?php if (!empty($small_featured_image)) {
        if ($thumb_size === 'full') { ?>
            <img itemprop="image" class="qodef-pl-hover-image" src="<?php echo esc_url($small_featured_image); ?>" alt="<?php esc_attr_e('Portfolio Small Featured Image', 'diefinnhutte-core'); ?>" />
        <?php } else {
            $thumb_image_size = diefinnhutte_select_get_image_size($thumb_size);
            echo diefinnhutte_select_generate_thumbnail(null, $small_featured_image, $thumb_image_size['width'], $thumb_image_size['height']);
        }
    } else {
        if(has_post_thumbnail()) {
            echo get_the_post_thumbnail(get_the_ID(), $thumb_size);
        }
    } ?>
</div>