<?php do_action( 'diefinnhutte_select_action_before_site_logo' ); ?>

<?php

if(!function_exists('diefinnhutte_select_generate_logo_text_output')){
    function diefinnhutte_select_generate_logo_text_output($output){
        if(!empty($output)){
            return $output;
        }
    }
}

$styles = array();
if($logo_text_color != '') {
    $styles[] =  'color: ' . $logo_text_color;
}

?>

    <div class="qodef-logo-wrapper qodef-text-logo">
        <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php if($logo_text !== '') { ?>
                <span class="qodef-text-logo-left-wrap">
                    <span class="qodef-text-logo-left" <?php diefinnhutte_select_inline_style($styles); ?>>
                    <?php print diefinnhutte_select_generate_logo_text_output($logo_text); ?>
                    </span>
                </span>
            <?php } ?>
            <?php if($logo_text !== '' && $logo_text_two !== '') { ?>
                <span class="qodef-text-logo-limiter"></span>
            <?php } ?>
            <?php if($logo_text_two !== '') { ?>
                <span class="qodef-text-logo-right-wrap">
                    <span class="qodef-text-logo-right" <?php diefinnhutte_select_inline_style($styles); ?>>
                    <?php print diefinnhutte_select_generate_logo_text_output($logo_text_two); ?>
                    </span>
                </span>
            <?php } ?>
        </a>
    </div>
<?php do_action( 'diefinnhutte_select_action_after_site_logo' ); ?>