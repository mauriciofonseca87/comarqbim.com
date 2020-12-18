<?php if($show_category_filter == 'yes'){ ?>
	<div class="qodef-pl-categories">
        <h6 class="qodef-pl-categories-label"><?php esc_html_e('Categories','diefinnhutte'); ?></h6>
		<ul>
			<?php echo wp_kses_post($categories_filter_list) ?>
		</ul>
	</div>
<?php } ?>