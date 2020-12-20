<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="qodef-pl-loading">
		<div class="qodef-pl-loading-bounce1"></div>
		<div class="qodef-pl-loading-bounce2"></div>
		<div class="qodef-pl-loading-bounce3"></div>
	</div>
	<div class="qodef-pl-load-more-holder">
		<div class="qodef-pl-load-more" <?php diefinnhutte_select_inline_style($holder_styles); ?>>
			<?php 
				echo diefinnhutte_select_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'medium',
					'text' => esc_html__('LOAD MORE', 'diefinnhutte-core')
				));
			?>
		</div>
	</div>
<?php }