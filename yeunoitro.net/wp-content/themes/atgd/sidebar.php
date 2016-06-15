<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package atgd
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="content-right pull-left">	
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<div class="clearfix"></div>
</div>
	