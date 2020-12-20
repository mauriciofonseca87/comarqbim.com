<?php
$share_type = isset( $share_type ) ? $share_type : 'text';
?>
<?php if ( diefinnhutte_select_core_plugin_installed() && diefinnhutte_select_options()->getOptionValue( 'enable_social_share' ) === 'yes' && diefinnhutte_select_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="qodef-blog-share">
		<?php echo diefinnhutte_select_get_social_share_html( array( 'type' => $share_type ) ); ?>
	</div>
<?php } ?>