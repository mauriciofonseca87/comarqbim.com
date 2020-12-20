<div class="qodef-stamp-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo diefinnhutte_select_get_inline_style( $holder_styles ); ?> <?php echo diefinnhutte_select_get_inline_attrs( $holder_data, true ); ?>>
    <div class="qodef-s-text" data-count="<?php echo esc_attr( $text_data['count'] ); ?>"><?php echo wp_kses_post( $text_data['text'] ); ?></div>
</div>