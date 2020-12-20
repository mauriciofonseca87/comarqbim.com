<?php if(diefinnhutte_select_core_plugin_installed()) { ?>
    <div class="qodef-blog-like">
        <?php if( function_exists('diefinnhutte_select_get_like') ) diefinnhutte_select_get_like(); ?>
    </div>
<?php } ?>