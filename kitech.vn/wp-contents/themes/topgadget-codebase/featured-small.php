<?php ?>
<!-- stories -->
<div class="stories">

	<div class="infiniteCarousel">
		<div class="wrapper">

			<ul>

				<?php $otherFeaturedPost = new WP_Query();
				$otherFeaturedPost->query( 'showposts=12&cat=' . get_option( 'top_slider_cats' ) . '&offset=0' ); ?>
				<?php while ( $otherFeaturedPost->have_posts() ) : $otherFeaturedPost->the_post(); ?>

					<li>
						<div class="box">
							<div class="box-image"><a
									href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'singlegalthumb' ); ?></a>
							</div>
							<div class="box-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<div class="cb"></div>
						</div>
					</li>

				<?php endwhile;
				wp_reset_query(); ?>
			</ul>

		</div>
	</div>
</div>

<div class="cb"></div>