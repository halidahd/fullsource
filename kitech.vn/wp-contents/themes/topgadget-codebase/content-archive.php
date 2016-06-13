<div class="post-wrapper-archive">


	<div class="bottom-recentpost-wrapper-cat">

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="bottom-archive">
				<div class="bottom-recentpost-image-0"><a href="<?php the_permalink(); ?>" rel="bookmark">

						<?php the_post_thumbnail( 'contentsmall' ); ?> </a></div>
				<div class="post-content-holder">
					<div class="bottom-content-heading-0"><h2><a href="<?php the_permalink(); ?>"
																 rel="bookmark"> <?php the_title(); ?> </a></h2>


					</div>
					<div class="cb"></div>
					<div class="post-content">  <?php the_content_limit( '150' ); ?></div>
				</div>
				<div class="cb"></div>
			</div>
		<?php } else { ?>

			<div class="post-content-holder bottom-archive  no-img-bottom-archive">
				<div class="bottom-content-heading"><h2><a href="<?php the_permalink(); ?>"
														   rel="bookmark"> <?php the_title(); ?> </a></h2>

				</div>
				<div class="cb"></div>
				<div class="post-content">  <?php the_content_limit( '370' ); ?>  </div>

				<div class="cb"></div>

			</div>

		<?php } ?>



		<div class="cb"></div>
	</div>
</div>
