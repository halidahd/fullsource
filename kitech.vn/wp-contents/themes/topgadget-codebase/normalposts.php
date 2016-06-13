<div class="post-holder">
<?php
$count = 0;
global $wp_query;
$poscount = $wp_query->post_count;
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<?php if ( $meta_box = get_post_meta( $post->ID, 'dbt_select1', true ) == 'No Thumbnail' ) { ?>
			<div class="homepost no-thumbnail">
				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<div class="content-area"> <?php the_content_limit( '540' ); ?> </div>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>


						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>
			</div>



		<?php } elseif ( $meta_box = get_post_meta( $post->ID, 'dbt_select1', true ) == 'Small thumbnail in Left' ) { ?>
			<div class="homepost small-image-left">
				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<div class="content-image"><a href="<?php the_permalink(); ?>"
												  rel="bookmark"> <?php the_post_thumbnail( 'smallthumb-left' ); ?></a>
					</div>
					<div class="content-area"> <?php the_content_limit( '365' ); ?> </div>
					<div class="cb"></div>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>


						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>


			</div>



		<?php } elseif ( $meta_box = get_post_meta( $post->ID, 'dbt_select1', true ) == 'Small thumbnail in Right' ) { ?>
			<div class="homepost small-image-right">
				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<div class="content-image"><a href="<?php the_permalink(); ?>"
												  rel="bookmark"> <?php the_post_thumbnail( 'smallthumb-left' ); ?></a>
					</div>
					<div class="content-area"> <?php the_content_limit( '365' ); ?> </div>
					<div class="cb"></div>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>


						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>
			</div>



		<?php } elseif ( $meta_box = get_post_meta( $post->ID, 'dbt_select1', true ) == 'Big left thumbnail' ) { ?>
			<div class="homepost big-image-left">
				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<div class="content-image"><a href="<?php the_permalink(); ?>"
												  rel="bookmark"> <?php the_post_thumbnail( 'bigthumb-left' ); ?></a>
					</div>
					<div class="content-area"> <?php the_content_limit( '400' ); ?> </div>
					<div class="cb"></div>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>


						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>
			</div>



		<?php } elseif ( $meta_box = get_post_meta( $post->ID, 'dbt_select1', true ) == 'Big right thumbnail' ) { ?>
			<div class="homepost big-image-right">
				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<div class="content-image"><a href="<?php the_permalink(); ?>"
												  rel="bookmark"> <?php the_post_thumbnail( 'bigthumb-left' ); ?></a>
					</div>
					<div class="content-area"> <?php the_content_limit( '400' ); ?> </div>
					<div class="cb"></div>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>


						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>
			</div>



		<?php } elseif ( $meta_box = get_post_meta( $post->ID, 'dbt_select1', true ) == 'Center Big Thumbnail' ) { ?>
			<div class="homepost big-image-center">
				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<div class="content-image"><a href="<?php the_permalink(); ?>"
												  rel="bookmark"> <?php the_post_thumbnail( 'big-image-center' ); ?></a>
					</div>
					<div class="content-area"> <?php the_content_limit( '540' ); ?> </div>
					<div class="cb"></div>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>


						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>
			</div>



		<?php } elseif ( $meta_box = get_post_meta( $post->ID, 'dbt_select1', true ) == 'Video' ) { ?>
			<div class="homepost video">
				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<div
						class="content-image"><?php echo get_post_meta( $post->ID, "dbt_videocode", $single = true ); ?> </div>
					<div class="content-area"> <?php the_content_limit( '540' ); ?> </div>
					<div class="cb"></div>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>


						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>
			</div>



		<?php } elseif ( $meta_box = get_post_meta( $post->ID, 'dbt_select1', true ) == 'Full Post' ) { ?>
			<div class="homepost full-post">
				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<div class="content-area"> <?php the_content(); ?> </div>
					<div class="cb"></div>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>


						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>
			</div>


		<?php } else { ?>
			<div class="homepost normal-post">

				<div class="title-meta-holder">
					<div class="homepost-heading"><h2><a href="<?php the_permalink(); ?>"
														 rel="bookmark"> <?php the_title(); ?> </a></h2></div>
					<?php get_template_part( 'normalposts-meta' ); ?>
				</div>
				<div class="postarea">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="content-image"><a href="<?php the_permalink(); ?>"
													  rel="bookmark"> <?php the_post_thumbnail( 'smallthumb-left' ); ?></a>
						</div>
						<div class="content-area"> <?php the_content_limit( '365' ); ?> </div>
						<div class="cb"></div>
					<?php } else { ?>
						<div class="content-area no-thumb"> <?php the_content_limit( '540' ); ?> </div>
					<?php } ?>
				</div>

				<?php get_template_part( 'home-gallery' ); ?>

				<div class="tags-readmore-holder">
					<div class="readmore">

						<?php if ( get_post_meta( $post->ID, 'the_overall_score', true ) ): ?>
							<div class="item-review"><img
									src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta( $post->ID, 'the_overall_score', true ); ?>.png"
									alt="<?php the_title(); ?> Overall Score"/></div>
						<?php endif; ?>

						<a href="<?php the_permalink(); ?>"
						   rel="bookmark"> <?php _e( "Continue Reading", "mm" ); ?> </a></div>
					<div class="tags"><?php the_tags( '<span>' . __( 'Tags:', 'mm' ) . '</span> ', ', ' ); ?></div>
					<div class="cb"></div>
				</div>
			</div>

		<?php } ?>

		<?php
		$count ++;
		if ( $count >= $poscount / 2 && $count < ( ( $poscount / 2 ) + 1 ) ):
			?>
			<!-- Ads Details bottom content -->
			<?php if ( get_option_mmtheme( 'ad_search_mid_content_on_off' ) == 'true' && is_search() ) {
			; ?>
			<div class="ad_search_mid_content">
				<?php echo stripslashes( get_option_mmtheme( 'ad_search_mid_content' ) ) ?>
			</div>
		<?php } ?>
			<!-- End ads -->
		<?php endif; ?>

	<?php endwhile; ?>

	<div class="pagination-wrapper"><?php magazine3_pagination(); ?></div>

<?php endif; ?>  <br/>
</div>
