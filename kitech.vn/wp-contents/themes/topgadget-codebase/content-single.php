<div id="single-heading-content">
	<!-- MetaData -->
	<?php if ( get_option_mmtheme( 'meta_data' ) == 'true' ) {
		; ?>
		<div class="clearfix">
			<div class="single-left">
				<div class="postedby"> <?php _e( "Categorized as", "mm" ); ?>  </div>
				<div class="single-category"><?php the_category(); ?></div>


				<div class="counter"> <?php echo getPostViews( get_the_ID() ); ?></div>
				<?php setPostViews( get_the_ID() ); ?>

				<?php
				$tag = get_the_tags();
				if ( ! $tag ) {
					?>
				<?php } else { ?>
					<div class="postedby">
						<?php _e( "Tagged as", "mm" ); ?>
					</div>
				<?php } ?>

				<div class="single-tags"> <?php the_tags( '', '' ); ?></div>
				<div class="cat-links-single cat-links-padding-social">
					<div class="addthis_toolbox addthis_default_style ">
						<!--	<a class="addthis_button_tweet"></a>-->
						<div class="fb-like" data-layout="box_count" data-share="false" data-show-faces="false"></div>
						<!--	<a class="addthis_button_pinterest_pinit" pi:pinit:url="-->
						<?php //the_permalink(); ?><!--" pi:pinit:media="-->
						<?php //$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); echo $thumb['0']; ?><!--" pi:pinit:layout="horizontal"></a> -->
					</div>
				</div>

				<?php if ( get_option_mmtheme( 'related_posts' ) == 'true' ) {
					; ?>
					<div class="single-related">
						<div class="cat-links-holder-single"><?php _e( "Related", "mm" ); ?> </div>
						<?php $categories = get_the_category( $post->ID );
						if ( $categories ) {
							$category_ids = array();
							foreach ( $categories as $individual_category ) {
								$category_ids[] = $individual_category->term_id;
							}
							$args     = array(
								'category__in'        => $category_ids,
								'post__not_in'        => array( $post->ID ),
								'showposts'           => get_option_mmtheme( 'relatedpost_number' ),
								'ignore_sticky_posts' => 1
							);
							$my_query = new WP_Query( $args );
							if ( $my_query->have_posts() ) {
								while ( $my_query->have_posts() ) : $my_query->the_post();
									?>
									<div class="related">
										<div class="relatedpost">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'secondpostimg' ); ?></a>

											<h3><a href="<?php the_permalink() ?>" rel="bookmark"
												   title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
										</div>
									</div>
								<?php endwhile;
							}
							wp_reset_query();
						} ?>
					</div>
				<?php } ?>
			</div>
			<!-- .single-left -->

			<!-- MetaData -->

			<div class="single-right">

				<?php if (
				(
					get_post_meta( $post->ID, 'the_overall_score', true ) ||
					( get_post_meta( $post->ID, 'the_critera_1', true ) && get_post_meta( $post->ID, 'the_critera_1_score', true ) ) ||
					( get_post_meta( $post->ID, 'the_critera_2', true ) && get_post_meta( $post->ID, 'the_critera_2_score', true ) ) ||
					( get_post_meta( $post->ID, 'the_critera_3', true ) && get_post_meta( $post->ID, 'the_critera_3_score', true ) ) ||
					( get_post_meta( $post->ID, 'the_critera_4', true ) && get_post_meta( $post->ID, 'the_critera_4_score', true ) ) ||
					( get_post_meta( $post->ID, 'the_critera_5', true ) && get_post_meta( $post->ID, 'the_critera_5_score', true ) )
				)
				): ?>
					<div class="post-review">
						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="overall-score"><span class="ratingtext"><?php _e( "RATING", "mm" ); ?></span>
								<img
									src="<?php bloginfo( 'template_directory' ); ?>/images/stars/big_<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt=""/></div>
						<?php endif; ?>
						<ul>
							<?php if ( get_post_meta( $post->ID, 'the_critera_1', true ) ): ?>
								<li><?php echo get_post_meta( $post->ID, 'the_critera_1', true ); ?> <span
										class="score"><img
											src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_1_score', true ); ?>.png"
											alt=""/></span></li>
							<?php endif; ?>
							<?php if ( get_post_meta( $post->ID, 'the_critera_2', true ) ): ?>
								<li><?php echo get_post_meta( $post->ID, 'the_critera_2', true ); ?> <span
										class="score"><img
											src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_2_score', true ); ?>.png"
											alt=""/></span></li>
							<?php endif; ?>
							<?php if ( get_post_meta( $post->ID, 'the_critera_3', true ) ): ?>
								<li><?php echo get_post_meta( $post->ID, 'the_critera_3', true ); ?> <span
										class="score"><img
											src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_3_score', true ); ?>.png"
											alt=""/></span></li>
							<?php endif; ?>
							<?php if ( get_post_meta( $post->ID, 'the_critera_4', true ) ): ?>
								<li><?php echo get_post_meta( $post->ID, 'the_critera_4', true ); ?> <span
										class="score"><img
											src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_4_score', true ); ?>.png"
											alt=""/></span></li>
							<?php endif; ?>
							<?php if ( get_post_meta( $post->ID, 'the_critera_5', true ) ): ?>
								<li><?php echo get_post_meta( $post->ID, 'the_critera_5', true ); ?> <span
										class="score"><img
											src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_5_score', true ); ?>.png"
											alt=""/></span></li>
							<?php endif; ?>

							<?php if ( get_post_meta( $post->ID, 'the_critera_6', true ) ): ?>
								<li><?php echo get_post_meta( $post->ID, 'the_critera_6', true ); ?> <span
										class="score"><img
											src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_6_score', true ); ?>.png"
											alt=""/></span></li>
							<?php endif; ?>

						</ul>
					</div>
				<?php endif; ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', '_s' ) ); ?>
						<?php wp_link_pages( array( 'before'         => '<center style="background:#ddd; font-size: 14px;font-weight: bold;margin: 8px;padding: 7px 4px;"><strong>Pages:</strong>',
													'after'          => '</center>',
													'next_or_number' => 'number'
							) ); ?>
					</div>
					<!-- .entry-content -->
				</article>
				<!-- #post-<?php the_ID(); ?> -->


			</div>
			<!-- .single-right -->
		</div>
	<?php } else { ?>
		<div class="single-right-big">

			<?php if (
			(
				get_post_meta( $post->ID, 'the_overall_score', true ) ||
				( get_post_meta( $post->ID, 'the_critera_1', true ) && get_post_meta( $post->ID, 'the_critera_1_score', true ) ) ||
				( get_post_meta( $post->ID, 'the_critera_2', true ) && get_post_meta( $post->ID, 'the_critera_2_score', true ) ) ||
				( get_post_meta( $post->ID, 'the_critera_3', true ) && get_post_meta( $post->ID, 'the_critera_3_score', true ) ) ||
				( get_post_meta( $post->ID, 'the_critera_4', true ) && get_post_meta( $post->ID, 'the_critera_4_score', true ) ) ||
				( get_post_meta( $post->ID, 'the_critera_5', true ) && get_post_meta( $post->ID, 'the_critera_5_score', true ) )
			)
			)    : ?>
				<div class="post-review">
					<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
						<div class="overall-score"><span class="ratingtext"><?php _e( "RATING", "mm" ); ?></span> <img
								src="<?php bloginfo( 'template_directory' ); ?>/images/stars/big_<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
								alt=""/></div>
					<?php endif; ?>
					<ul>
						<?php if ( get_post_meta( $post->ID, 'the_critera_1', true ) ): ?>
							<li><?php echo get_post_meta( $post->ID, 'the_critera_1', true ); ?> <span
									class="score"><img
										src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_1_score', true ); ?>.png"
										alt=""/></span></li>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'the_critera_2', true ) ): ?>
							<li><?php echo get_post_meta( $post->ID, 'the_critera_2', true ); ?> <span
									class="score"><img
										src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_2_score', true ); ?>.png"
										alt=""/></span></li>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'the_critera_3', true ) ): ?>
							<li><?php echo get_post_meta( $post->ID, 'the_critera_3', true ); ?> <span
									class="score"><img
										src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_3_score', true ); ?>.png"
										alt=""/></span></li>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'the_critera_4', true ) ): ?>
							<li><?php echo get_post_meta( $post->ID, 'the_critera_4', true ); ?> <span
									class="score"><img
										src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_4_score', true ); ?>.png"
										alt=""/></span></li>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'the_critera_5', true ) ): ?>
							<li><?php echo get_post_meta( $post->ID, 'the_critera_5', true ); ?> <span
									class="score"><img
										src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_5_score', true ); ?>.png"
										alt=""/></span></li>
						<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'the_critera_6', true ) ): ?>
							<li><?php echo get_post_meta( $post->ID, 'the_critera_6', true ); ?> <span
									class="score"><img
										src="<?php bloginfo( 'template_directory' ); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_critera_6_score', true ); ?>.png"
										alt=""/></span></li>
						<?php endif; ?>

					</ul>
				</div>
			<?php endif; ?>


			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', '_s' ) ); ?>
					<?php wp_link_pages( array( 'before'         => '<center style="background:#ddd; font-size: 14px;font-weight: bold;margin: 8px;padding: 7px 4px;"><strong>Pages:</strong>',
												'after'          => '</center>',
												'next_or_number' => 'number'
						) ); ?>
				</div>
				<!-- .entry-content -->
			</article>
			<!-- #post-<?php the_ID(); ?> -->


		</div><!-- .single-right -->
	<?php } ?>
	<div class="clearfix">
		<div class="google pull-right left-10">
			<div class="g-plusone" data-size="medium" data-annotation="none"></div>
		</div>
		<div class="facebook pull-right">
			<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-share="true"
				 data-action="like" data-show-faces="true"></div>
		</div>
	</div>

	<div class="tags sp">
		<?php the_tags( '<strong>Tags: </strong><span>', ' | ', '</span>' ); ?>
	</div>
	<?php
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Bài tiếp theo', 'kitech' ) . '</span> ' .
					   '<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Bài trước', 'kitech' ) . '</span> ' .
					   '<span class="post-title">%title</span>',
	) );
	?>
	<div class="clearfix"></div>
	<!-- Ads Details bottom content -->
	<?php if ( get_option_mmtheme( 'ad_details_bottom_content_on_off' ) == 'true' ) {
		; ?>
		<div class="ad_bottom_content ad_details_bottom_content">
			<?php echo stripslashes( get_option_mmtheme( 'ad_details_bottom_content' ) ) ?>
		</div>
	<?php } ?>
	<!-- End ads -->

	<div class="cb"></div>

