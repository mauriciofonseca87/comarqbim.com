<?php
$stamp_params = array();
$stamp_text = $this_object->getStampText($params);
$stamp_params['text'] = $stamp_text;
if($stamp_text !== '') {
    echo diefinnhutte_select_execute_shortcode( 'qodef_stamp', $stamp_params );
}
?>