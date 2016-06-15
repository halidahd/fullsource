<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package atgd
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div class="content-right pull-left bottom-30 top-10">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
		<div class="clearfix"></div>
</div>
	