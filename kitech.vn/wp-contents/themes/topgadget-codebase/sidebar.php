<div id="sidebar">

	<!-- Ads -->
	<!-- ads home sidebar -->
	<?php if ( get_option_mmtheme( 'ad_home_right1_on_off' ) == 'true' && is_home() ) {
		; ?>
		<div class="ad_sidebar ad_home_right1">
			<?php echo stripslashes( get_option_mmtheme( 'ad_home_right1' ) ) ?>
		</div>
	<?php } ?>
	<?php if ( get_option_mmtheme( 'ad_home_right2_on_off' ) == 'true' && is_home() ) {
		; ?>
		<div class="ad_sidebar ad_home_right2">
			<?php echo stripslashes( get_option_mmtheme( 'ad_home_right2' ) ) ?>
		</div>
	<?php } ?>
	<!-- End ads home sidebar -->

	<!-- Ads Category sidebar -->
	<?php if ( get_option_mmtheme( 'ad_cate_right1_on_off' ) == 'true' && is_category() ) {
		; ?>
		<div class="ad_sidebar ad_cate_right1">
			<?php echo stripslashes( get_option_mmtheme( 'ad_cate_right1' ) ) ?>
		</div>
	<?php } ?>
	<?php if ( get_option_mmtheme( 'ad_cate_right2_on_off' ) == 'true' && is_category() ) {
		; ?>
		<div class="ad_sidebar ad_cate_right2">
			<?php echo stripslashes( get_option_mmtheme( 'ad_cate_right2' ) ) ?>
		</div>
	<?php } ?>
	<!-- End ads Category sidebar -->

	<!-- Ads Tags sidebar -->
	<?php if ( get_option_mmtheme( 'ad_tags_right1_on_off' ) == 'true' && is_tag() ) {
		; ?>
		<div class="ad_sidebar ad_tags_right1">
			<?php echo stripslashes( get_option_mmtheme( 'ad_tags_right1' ) ) ?>
		</div>
	<?php } ?>
	<?php if ( get_option_mmtheme( 'ad_tags_right2_on_off' ) == 'true' && is_tag() ) {
		; ?>
		<div class="ad_sidebar ad_tags_right2">
			<?php echo stripslashes( get_option_mmtheme( 'ad_tags_right2' ) ) ?>
		</div>
	<?php } ?>
	<!-- End ads tags sidebar -->

	<!-- Ads Details sidebar -->
	<?php if ( get_option_mmtheme( 'ad_details_right1_on_off' ) == 'true' && is_single() ) {
		; ?>
		<div class="ad_sidebar ad_details_right1">
			<?php echo stripslashes( get_option_mmtheme( 'ad_details_right1' ) ) ?>
		</div>
	<?php } ?>
	<!-- End Ads Details sidebar -->

	<!-- Ads Search sidebar -->
	<?php if ( get_option_mmtheme( 'ad_search_right1_on_off' ) == 'true' && is_search() ) {
		; ?>
		<div class="ad_right ad_search_right1">
			<?php echo stripslashes( get_option_mmtheme( 'ad_search_right1' ) ) ?>
		</div>
	<?php } ?>
	<!-- End Ads Search sidebar -->

	<!-- End Ads -->

	<div class="sidebar-wrapper">
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Sidebar' ) ) : ?>
		<?php endif; ?>
	</div>
</div>