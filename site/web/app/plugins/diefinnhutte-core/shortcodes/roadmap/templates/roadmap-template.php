<div class="qodef-roadmap <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-roadmap-line">

        <span class="qodef-rl-arrow-left">
            <i class="qodef-icon-font-awesome fa fa-angle-left"></i>
        </span>

        <span class="qodef-rl-arrow-right">
            <i class="qodef-icon-font-awesome fa fa-angle-right"></i>
        </span>
    </div>
<!--    <div class="qodef-roadmap-holder">-->
        <?php if (is_array($stage) && count($stage)) { ?>
            <div class="qodef-roadmap-inner-holder clearfix">
            <?php foreach($stage as $key => $stage_item) {
                $stage_item['number'] = $key;
                $additional = $this_object->getItemAdditional($stage_item);
                $item_classes = $additional['classes'];
                $item_style = $additional['style'];
                ?>
                <div <?php diefinnhutte_select_class_attribute($item_classes);?>>
                    <div class="qodef-roadmap-item-circle-holder">
                        <div class="qodef-roadmap-item-before-circle"></div>
                        <div class="qodef-roadmap-item-circle"></div>
                        <div class="qodef-roadmap-item-after-circle"></div>
                    </div>
                    <div class="qodef-roadmap-item-stage-title-holder">
                        <span class="qodef-ris-title">
                            <?php echo esc_html($stage_item['stage_title'])?>
                        </span>
                    </div>
                    <div class="qodef-roadmap-item-content-holder" <?php diefinnhutte_select_inline_style($item_style);?>>
                        <h5 class="qodef-ric-title">
                            <?php echo esc_html($stage_item['info_title'])?>
                        </h5>
                        <div class="qodef-ric-content">
                            <?php echo esc_html($stage_item['info_text'])?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
<!--    </div>-->
</div>