<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package atgd
 */

get_header(); ?>

<div class="content-left pull-left">
	<div class="right-20">
		<div class="breakumb">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}
			?>
		</div>

		<div class="pw">
			<?php while ( have_posts() ) : the_post(); ?>

				<h1 class="_title-herder"><?php the_title(); ?></h1>
				<div class="line-border bottom-10"></div>
				<div class="posts-content">
					<?php the_content(); ?>
				</div>

			<?php endwhile; // end of the loop. ?>
		</div>
	</div>
</div>


<?php get_sidebar("child"); ?>
<?php get_footer(); ?>
