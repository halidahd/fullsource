<?php get_header(); ?>
	<!--breadcrumb-->
	<div class="breadcrumbs">
		<?php if(function_exists('bcn_display'))
		{
			bcn_display();
		}?>
	</div>

	<!--title header and note-->
	<div class="title-header">
		<h1><?php get_meta_key_title_psp(); ?></h1>

		<div class="descriptions">
			<?php the_archive_description(); 	?>
		</div>
	</div>

	<!--công thức mới nhất -->
	<section class="formula-top-one">
		<div class="ts1">
			<h2>công thức theo chủ đề mới nhất</h2>
			<div class="clearfix"></div>
		</div>
		<?php get_template_part( 'content', get_post_format() ); ?>
	</section>
	<aside class="box-img-ads left-left-10 top-10">
		<figure>
			<?php cmp_ads("mb_cate_bottom_content"); ?>
		</figure>
	</aside>

<?php get_sidebar(); ?>
<?php get_footer(); ?>