<?php /* Template Name: Full Width Page */ ?>  <?php
get_header(); ?>

<div id="content-wrapper" class="site-content">
	<div id="content" class="full-width" role="main">
		<section>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>
		</section>
	</div>
	<!-- #content -->


	<?php get_footer(); ?>
