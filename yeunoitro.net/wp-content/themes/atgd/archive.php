<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package atgd
 */

get_header(); ?>

	<div class="content-left pull-left">	
			<?php get_template_part( 'content', get_post_format() ); ?>		
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>