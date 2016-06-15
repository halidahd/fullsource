<?php get_header(); ?>
	<section>
		<!--breadcrumb-->
		<div class="breadcrumbs">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
		</div>

		<!--title header and note-->
		<div class="title-header">
			<h1>
				<?php /* category archive */ if (is_category()) { ?><?php echo single_cat_title(); ?>
					<?php /* tag archive */ } elseif( is_tag() ) { ?><?php _e('', 'atgd'); ?> <?php get_meta_key_title_psp();//single_tag_title(); ?>
					<?php /* daily archive */ } elseif (is_day()) { ?><?php _e('Lưu trữ', 'atgd'); ?> <?php the_time('F jS, Y'); ?>
					<?php /* monthly archive */ } elseif (is_month()) { ?><?php _e('Lưu trữ', 'atgd'); ?> <?php the_time('F, Y'); ?>
					<?php /* yearly archive */ } elseif (is_year()) { ?><?php _e('Lưu trữ', 'atgd'); ?> <?php the_time('Y'); ?>
					<?php /* author archive */ } elseif (is_author()) { ?><?php _e( ' Viết bởi: ', 'atgd' ); echo $curauth->display_name; ?>
					<?php /* paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><?php _e('Lưu trữ', 'atgd'); ?>
					<?php /* home page */ } elseif (is_front_page()) { ?><?php _e('Những bài viết liên quan','atgd');?>
					<?php /* is series*/ } else { ?><?php _e('','atgd'); get_meta_key_title_psp(); ?>
				<?php } ?>
			</h1>
			<div class="descriptions">
				<?php the_archive_description(); 	?>
			</div>
		</div>
	</section>
	<!--công thức mới nhất -->
	<section class="formula-top-one">
		<div class="ts1">
			<h2>công thức mới nhất</h2>
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