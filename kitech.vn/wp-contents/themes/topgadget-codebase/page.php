<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _s
 * @since _s 1.0
 */

get_header(); ?>


<div id="content-wrapper" class="site-content">
	<div class="breadcrumbs">
		<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="Trở về Trang chủ Kitech"
									   href="<?php echo home_url(); ?>">Trang chủ</a></span> &gt; <span
			typeof="v:Breadcrumb" property="v:title"><?php the_title(); ?></span>
	</div>
	<div id="content" role="main">
		<section>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>
		</section>
	</div>
	<!-- #content -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
