<article class="post-block top-10">
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<figure class="post-img w130 pull-left">

			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'Category-list', array(
					'class' => 'img-full-width',
					'style' => 'width:130px; height:117px;'
				) );
			}
			?>

		</figure>
	</a>

	<div class="post-content ps-1">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3><?php the_title(); ?></h3></a>

		<div class="description font-3 top-10"><?php echo excerpt( 35 ); ?></div>
		<div class="date"><span class="icon-date"></span><span
				class="font-1 color-2"><em><?php echo show_date_category( get_the_date( 'd/m/Y' ), get_the_date( 'G:i' ) ); ?></em></span>
		</div>
		<div class="clearfix"></div>
	</div>
</article>