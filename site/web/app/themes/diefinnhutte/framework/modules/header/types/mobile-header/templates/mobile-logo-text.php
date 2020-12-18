<?php
if(!function_exists('diefinnhutte_select_generate_mobile_logo_text_output')){
    function diefinnhutte_select_generate_mobile_logo_text_output($output){
        if(!empty($output)){
            return $output;
        }
    }
}

$styles = array();
if($logo_text_color != '') {
    $styles[] =  'color: ' . $logo_text_color;
}

do_action( 'diefinnhutte_select_action_before_mobile_logo' ); ?>

    <div class="qodef-mobile-logo-wrapper qodef-text-logo">
        <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">
	        <?php if($mobile_logo_text !== '') { ?>
                <span class="qodef-text-logo-left" <?php diefinnhutte_select_inline_style($styles); ?>>
                <?php print diefinnhutte_select_generate_mobile_logo_text_output($mobile_logo_text); ?>
                </span>
	        <?php } ?>
	        <?php if($mobile_logo_text_two !== '') { ?>
                <span class="qodef-text-logo-right" <?php diefinnhutte_select_inline_style($styles); ?>>
                <?php print diefinnhutte_select_generate_mobile_logo_text_output($mobile_logo_text_two); ?>
                </span>
	        <?php } ?>
        </a>
    </div>

<?php do_action( 'diefinnhutte_select_action_after_mobile_logo' ); ?>
