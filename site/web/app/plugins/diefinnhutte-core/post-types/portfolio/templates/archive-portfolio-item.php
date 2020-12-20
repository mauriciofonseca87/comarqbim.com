<?php
get_header();
diefinnhutte_select_get_title();
do_action( 'diefinnhutte_select_action_before_main_content' ); ?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action( 'diefinnhutte_select_action_after_container_open' ); ?>
	<div class="qodef-container-inner clearfix">
		<?php
			$diefinnhutte_taxonomy_id   = get_queried_object_id();
			$diefinnhutte_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$diefinnhutte_taxonomy      = ! empty( $diefinnhutte_taxonomy_id ) ? get_term_by( 'id', $diefinnhutte_taxonomy_id, $diefinnhutte_taxonomy_type ) : '';
			$diefinnhutte_taxonomy_slug = ! empty( $diefinnhutte_taxonomy ) ? $diefinnhutte_taxonomy->slug : '';
			$diefinnhutte_taxonomy_name = ! empty( $diefinnhutte_taxonomy ) ? $diefinnhutte_taxonomy->taxonomy : '';
			
			diefinnhutte_core_get_archive_portfolio_list( $diefinnhutte_taxonomy_slug, $diefinnhutte_taxonomy_name );
		?>
	</div>
	<?php do_action( 'diefinnhutte_select_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
