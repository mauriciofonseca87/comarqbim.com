<?php do_action( 'diefinnhutte_select_get_footer_template' );

global $diefinnhutte_qodef_toolbar;

if ( isset ( $diefinnhutte_qodef_toolbar ) ) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    if (file_exists ( get_home_path() . 'toolbar/toolbar.php' ) ) {
        include(get_home_path() . 'toolbar/toolbar.php');
    }
}