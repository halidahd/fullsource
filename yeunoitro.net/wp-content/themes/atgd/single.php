<?php
/**
 * The template for displaying all single posts.
 *
 * @package atgd
 */

get_header(); ?>

	<div class="content-left pull-left">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php the_post_navigation(); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar("child"); ?>
<?php get_footer(); ?>
