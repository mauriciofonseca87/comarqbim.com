<?php
$qodef_blog_type = diefinnhutte_select_get_archive_blog_list_layout();
diefinnhutte_select_include_blog_helper_functions( 'lists', $qodef_blog_type );
$qodef_holder_params = diefinnhutte_select_get_holder_params_blog();

get_header();
diefinnhutte_select_get_title();
do_action('diefinnhutte_select_action_before_main_content');
?>

<div class="<?php echo esc_attr( $qodef_holder_params['holder'] ); ?>">
	<?php do_action( 'diefinnhutte_select_action_after_container_open' ); ?>
	
	<div class="<?php echo esc_attr( $qodef_holder_params['inner'] ); ?>">
		<?php diefinnhutte_select_get_blog( $qodef_blog_type ); ?>
	</div>
	
	<?php do_action( 'diefinnhutte_select_action_before_container_close' ); ?>
</div>

<?php do_action( 'diefinnhutte_select_action_blog_list_additional_tags' ); ?>
<?php get_footer(); ?>