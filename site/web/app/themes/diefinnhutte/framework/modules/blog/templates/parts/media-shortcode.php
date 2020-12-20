<?php
if($type === 'boxed') {
	diefinnhutte_select_get_module_template_part('templates/parts/image-background', 'blog', '', $params);
} else {
	diefinnhutte_select_get_module_template_part('templates/parts/image', 'blog', '', $params);
}