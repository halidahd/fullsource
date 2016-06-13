<?php get_header(); ?>

<?php get_template_part( 'featured', get_post_format() ); ?>

<?php if ( $paged < 2 and get_option_mmtheme( 'featured_area' ) == 'true' ) {
	; ?>
	<!-- featured-wrapper -->
	<div class="featured-wrapper">

		<div class="featured-block1">
			<?php $recent = new WP_Query( 'showposts=1&cat=' . get_option( 'featured_area_1' ) . '&offset=0' );
			while ( $recent->have_posts() ) : $recent->the_post(); ?>
				<div class="cat"><?php the_category(); ?>    </div>
				<div class="image"><a href="<?php the_permalink(); ?>"
									  rel="bookmark">  <?php the_post_thumbnail( 'featuredbig' ); ?> </a></div>
				<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<div class="content"><?php the_content_limit( '200' ); ?></div>
			<?php endwhile; ?>
		</div>


		<div class="featured-block2">
			<div class="heading-text"> <?php echo stripslashes( get_option_mmtheme( 'featured_area_2_text' ) ) ?> </div>
			<?php $recent = new WP_Query( 'showposts=2&cat=' . get_option( 'featured_area_2' ) . '&offset=0' );
			while ( $recent->have_posts() ) : $recent->the_post(); ?>
				<div class="postholder">
					<div class="title"><h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h3></div>
					<div class="image"><a href="<?php the_permalink(); ?>"
										  rel="bookmark">  <?php the_post_thumbnail( 'featuredsmall' ); ?> </a></div>
				</div>
			<?php endwhile; ?>
		</div>


		<div class="featured-block3">
			<div
				class="heading-text"> <?php echo stripslashes( get_option_mmtheme( 'featured_area_3_text' ) ) ?>   </div>
			<?php $recent = new WP_Query( 'showposts=4&cat=' . get_option( 'featured_area_3' ) . '&offset=0' );
			while ( $recent->have_posts() ) : $recent->the_post(); ?>

				<?php if ( has_post_thumbnail() ) { ?>

					<div class="postholder">
						<div class="image"><a href="<?php the_permalink(); ?>"
											  rel="bookmark">  <?php the_post_thumbnail( 'review-home' ); ?> </a></div>
						<div class="title-holder">
							<div class="title"><h4><a href="<?php the_permalink(); ?>"
													  rel="bookmark"><?php the_title(); ?></a></h4></div>
							<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
								<div class="rating">
									<div class="text"><?php _e( "Rating Score", "mm" ); ?> </div>
									<div class="rate">
										<span class="item-review"><img
												src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
												alt="<?php the_title(); ?> Overall Score"/></span>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>

				<?php } else { ?>

					<div class="postholder">
						<div class="imagesecond"><a href="<?php the_permalink(); ?>"
													rel="bookmark">  <?php the_post_thumbnail( 'review-home' ); ?> </a>
						</div>
						<div class="title-holdersecond">
							<div class="titlesecond">
								<h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
							</div>
							<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
								<div class="rating">
									<div class="text"><?php _e( "Rating Score", "mm" ); ?> </div>
									<div class="ratesec">
				  					<span class="item-review"><img
											src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
											alt="<?php the_title(); ?> Overall Score"/>
				  					</span>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php } ?>
				<div class="cb"></div>
			<?php endwhile; ?>
		</div>

		<div class="cb"></div>
	</div>
	<!-- end featured-wrapper -->
<?php } ?>


<div id="content-wrapper" class="site-content">
	<div class="pad"></div>
	<div id="content" role="main">
		<section>
			<div class="section_content"> <?php get_template_part( 'normalposts' ); ?>
			</div>
			<!-- .section-content -->
		</section>
	</div>
	<!-- #content -->
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
