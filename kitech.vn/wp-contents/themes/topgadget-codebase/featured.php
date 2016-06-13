<?php if ( $paged < 2 and get_option_mmtheme( 'featured_slider' ) == 'true' ) {
	; ?>
	<?php if ( is_home() ) { ?>

		<div class="featured_slider">
			<div class="pad"></div>
			<h2><?php _e( 'Tiêu điểm', 'mm' ); ?></h2>

			<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
				<?php $recent = new WP_Query( 'showposts=5&cat=' . get_option( 'slider_cats_area' ) . '&offset=0' );
				while ( $recent->have_posts() ) : $recent->the_post(); ?>

					<?php
					$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'popular-thumb' );
					$url    = $thumb['0'];
					$thumb2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featuredthumbnail' );
					$url2   = $thumb2['0'];
					?>

					<div data-thumb="<?= $url ?>" data-src="<?= $url2 ?>">
						<div class="camera_caption fadeFromBottom">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</div>
						<div class="readmore-featured">
							<a href="<?php the_permalink(); ?>" rel="bookmark"> <?php _e( 'Read more', 'mm' ); ?> </a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<div class="cb"></div>
		</div>


	<?php }
} ?>

