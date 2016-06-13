<?php get_header(); ?>
<div id="content-wrapper" class="site-content">

	<div class="breadcrumbs">
		<div class="breadcrumbs">
			<?php echo cmp_breadcrumb(); ?>
		</div>
	</div>
	<div id="content" role="main">

		<div class="cat-title-b0-1">
			<h1>
				<center>
					<span><?php _e( "You Are Browsing ", "mm" ); ?>  <?php _e( "Category ", "mm" ); ?> <b>
							&#8216;<?php single_cat_title(); ?>&#8217;</b></span>
					<center>
			</h1>
			<div class="cb"></div>
		</div>


		<section>
			<?php if ( get_option_mmtheme( 'ad_5_on_off' ) == 'true' ) {
				; ?>
				<center>
					<div class="ad-5">
						<?php echo stripslashes( get_option_mmtheme( 'ad_5' ) ) ?>
					</div>
				</center>
			<?php } ?>


			<?php get_template_part( 'normalposts' ); ?>


			<?php if ( get_option_mmtheme( 'ad_6_on_off' ) == 'true' ) {
				; ?>
				<center>
					<div class="ad-6">
						<?php echo stripslashes( get_option_mmtheme( 'ad_6' ) ) ?>
					</div>
				</center>
			<?php } ?>


		</section>


	</div>
	<!-- #content -->
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
