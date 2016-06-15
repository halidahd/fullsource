<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package atgd
 */

get_header(); ?>

<div class="content-left pull-left">
	<?php include (TEMPLATEPATH . '/myfiles/noi-bat-trang-chu.php'); ?>
	
	<?php include (TEMPLATEPATH . '/myfiles/cong-thuc-nau-an-noi-bat.php'); ?>

  <?php cmp_ads('pc_home_mid_content'); ?>

  <div class="content-part-3 bottom-20 right-10">
		<?php echo adrotate_ad(6); ?>
	</div>

	<div class="_cttatccb bottom-10 right-10">
		<?php echo adrotate_ad(9); ?>
	</div>
	
	<?php include (TEMPLATEPATH . '/myfiles/cac-loai-thuc-don.php'); ?>
	
	<?php include (TEMPLATEPATH . '/myfiles/tin-am-thuc-gia-dinh.php'); ?>

	<div class="_cttatccb bottom-10 right-20">
		<?php echo adrotate_ad(11); ?>
	</div>
</div>
	

<?php get_sidebar(); ?>
<?php get_footer(); ?>
