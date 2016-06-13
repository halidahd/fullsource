<?php get_header(); ?>

<div id="content-wrapper" class="site-content">
	<?php while (have_posts()) :
	the_post(); ?>
	<div class="breadcrumbs">
		<?php echo cmp_breadcrumb(); ?>
	</div>
	<div class="pad"></div>
	<div id="content" role="main" class="single-wrapper">

		<header class="entry-header-single">
			<h1 class="entry-title single-entry-title"> <?php the_title(); ?></h1>

			<?php if ( get_option_mmtheme( 'ad_3_on_off' ) == 'true' ) {
				; ?>
				<div class="ad-3">
					<?php echo stripslashes( get_option_mmtheme( 'ad_3' ) ) ?>
				</div>
			<?php } ?>

			<div class="single-meta">
				<div class="metainfoleft">
					<div class="info">
						<?php _e( "Posted on", "mm" ); ?>
						<span class="date"> <?php the_time( 'd/m/Y' ) ?>  </span>
						<!--			--><?php //_e("by", "mm"); ?><!--   <a href="-->
						<?php //echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?><!--" title="-->
						<?php //printf( esc_attr__( 'View all posts by %s', 'mm'), get_the_author() ); ?><!--">-->
						<?php //the_author(); ?><!--</a> -->
						<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>
				<div class="single-pagi">
					<div class="facebook pull-left">
						<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count"
							 data-share="true" data-action="like" data-show-faces="true"></div>
					</div>
					<div class="google pull-left left-10">
						<div class="g-plusone" data-size="medium" data-annotation="none"></div>
					</div>
					<div class="cb"></div>
				</div>
				<div class="cb"></div>
			</div>
		</header>
		<!-- .entry-header -->

		<section>


			<?php get_template_part( 'content', 'single' ); ?>

			<?php if ( get_option_mmtheme( 'ad_4_on_off' ) == 'true' ) {
				; ?>
				<div class="ad-4">
					<?php echo stripslashes( get_option_mmtheme( 'ad_4' ) ) ?>
				</div>
			<?php } ?>

			<?php if ( get_option_mmtheme( 'author_box' ) == 'true' ) {
				?>
				<div id="authorarea-wrap">
					<div id="authorarea">
						<div class="authorareah3">
							<div class="authorareah3-img"><?php _e( "About the Author", "mm" ); ?></div>
							<div style="float: left;"><?php the_author_posts_link(); ?></div>
							<div class="cb"></div>
						</div>
						<div style="float: left; padding:0 5px 2px 0px">
							<a href="<?php bloginfo( 'url' ); ?>/author/<?php the_author_meta( 'nickname' ); ?>"><?php if ( function_exists( 'get_avatar' ) ) {
									echo get_avatar( get_the_author_meta( 'email' ), '60' );
								} ?></a></div>
						<div style="display: block;">
							<div class="authorinfo">
								<p><?php the_author_meta( 'description' ); ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
		</section>
	</div>
	<!-- #content -->


	<?php get_sidebar(); ?>

	<?php if ( get_option_mmtheme( 'share_box' ) == 'true' ) {
		; ?>
		<!--<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js"></script>-->
		<div id="sharebox">
			<!--	<div class="wdt"><a class="addthis_button_tweet" tw:count="vertical"></a></div>-->
			<div class="fb-like wdt fb" data-layout="box_count" data-share="false" data-show-faces="false"></div>
			<!--	 <div class="wdt fb"> <a class="addthis_button_facebook_like" fb:like:layout="box_count"></a> </div>-->
			<!--	<div class="wdt gp"><a class="addthis_button_google_plusone" g:plusone:size="tall"></a></div>-->
			<!--	<div class="wdt"> <a href="http://pinterest.com/pin/create/button/?url=-->
			<?php //the_permalink(); ?><!--&media=-->
			<?php //if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?><!--&description=-->
			<?php //echo get_the_title(); ?><!--" class="pin-it-button" count-layout="vertical">Pin It</a>-->
			<!--<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script> </div>-->
			<!--	<div class="wdt"><a class="addthis_counter"></a></div>-->
			<!-- <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>-->
		</div>
	<?php } ?>

	<?php get_footer(); ?>
