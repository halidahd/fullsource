<?php
/**
 * The template for displaying all single posts.
 * Template Name: Full width
 * @package atgd
 */

get_header(); ?>

	<style>
		.content-part-1 .col-xs-4, .content-part-2 .col-xs-4, .content-part-3 .col-xs-4 {
			padding: 0px;
			width: 31.333333%;
			margin-right: 23px;
		}

		.no-mr {
			margin: 0px !important;
		}

		._mtdl {
			position: relative;
		}

		._mtdl img {
			position: absolute;
			left: -27px;
			top: -33px;
		}
	</style>
	
	<div class="content-part bottom-20 right-20">	
		<div class="breakumb">
			<?php if(function_exists('bcn_display'))
		{
			bcn_display();
		}
		?>
		</div>
		
		<?php while ( have_posts() ) : the_post(); ?>

			<h1 class="_title-herder bottom-20"><?php the_title(); ?></h1>

			<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>
	</div>

<?php get_footer(); ?>
