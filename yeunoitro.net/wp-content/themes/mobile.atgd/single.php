<?php get_header(); ?>
	<!-- Google search recipe -->
<div itemscope itemtype="http://schema.org/Recipe">
<section>
	<div class="breadcrumbs">
		<?php if(function_exists('bcn_display'))
		{
			bcn_display();
		}?>
	</div>
	<!--title header and note-->
	<?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="title-header">
		<h1 itemprop="name"><?php the_title(); ?></h1>
		<style>
		.follow{display: table;}.descriptions{width: 100%;border: 0px !important;border-radius: 0px!important;display: table;color: #7d7d7d}
		</style>

		<div class="descriptions">
			<?php $fields = get_fields();
			if ( !empty( $fields ) ) {
			?>
			<?php if(!empty($fields['thoi-gian'])): ?>
				<div class="pull-left">
					<span class="icon-tgn"></span><strong>Thời gian nấu:</strong><time datetime="PT<?php echo $fields['thoi-gian'];?>M" itemprop="totalTime"> <?php echo $fields['thoi-gian'] ?></time> phút
					<?php if(!empty($fields['so-nguoi'])): ?>
						<span class="icon-group-user left-10"></span><strong>Người ăn:</strong> <?php echo $fields['so-nguoi'] ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php
			}
			?>

			<div class="top-30">
				<span class="icon-date"></span>Đăng lúc <time datetime="<?php echo get_the_date("H:i d/m/Y"); ?>" itemprop="datePublished"><?php echo get_the_date("H:i d/m/Y"); ?></time> bởi <b><span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author();?></span></span></b> trong <strong><?php
					$category = get_the_category();
					if($category[0]){
						echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
					}?></strong>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="follow bottom-10">
		<div class="facebook pull-left">
			<div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-share="true" data-action="like" data-show-faces="true"></div>
		</div>
		<div class="google pull-left left-10">
			<div class="g-plusone" data-size="medium" data-annotation="none"></div>
		</div>
	</div>

  <div class="mb-detail-header box-img-ads">
    <?php cmp_ads('mb_detail_header'); ?>
  </div>

	<div class="_ndbv bottom-30">
		<?php the_content(); ?>
	</div>

	<!--like share FB google-->
	<div class="group-fb-gl">
		<div class="text-center c-like">
			Các bạn nhớ ủng hộ các công thức nấu ăn ngon
			từ Ẩm Thực Gia Đình bằng cách Like
			hoặc giới thiệu cho bạn bè nhé!
		</div>
		<div class="group-btn text-center">
			<div class="text-left _mt"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mui-ten.png"></div>
			<div class="facebook pull-left">
				<div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="true"></div>
			</div>
			<div class="google pull-left left-10">
				<div class="g-plusone" data-size="medium" data-annotation="none"></div>
			</div>
<!--			<div class="pull-left left-10">-->
<!--				--><?php //echo do_shortcode('[wp-review]') ?>
<!--			</div>-->
		</div>
	</div>
	<aside class="box-img-ads left-left-10 top-10">
		<?php cmp_ads('mb_detail_bottom_content'); ?>
	</aside>
</section>
  <!--plugin comment-->
  <section class="comment">
    <div class="ts1 bottom-20">
      <h2><span class="fb-comments-count" xid="<?php the_ID();?>" data-href="<?php the_permalink();?>"></span> bình luận</h2>
      <div class="clearfix"></div>
    </div>
    <div><?php
      //		if ( comments_open()) {
      ?>
      <div class="fb-comments" data-width="700" xid="<?php the_ID();?>" data-href="<?php the_permalink();?>" data-order-by="social" data-numposts="10" data-colorscheme="light"></div>
      <?php
      //		}?>
    </div>
  </section>
<?php related_posts(); ?>
  <!-- Ads dưới khối bài viết liên quan  sp_detail_bottom_content2 -->
  <?php cmp_ads( 'sp_detail_bottom_content2' ); ?>
  <!-- End Ads sp_detail_bottom_content2 -->
<div class="clearfix bottom-10"></div>
<section>
	<div class="tags">
		<?php the_tags( "<ul class='list-unstyled list-inline'><li class='tags-title color-1'><strong>Tags: </strong></li><li>", "</li><li>", "</li></ul>" ); ?>
	</div>
</section>

	<!-- BEGIN TAG - DO NOT MODIFY -->
<?php endwhile; else: ?>
	<p>Xin lỗi, không tìm thấy bài viết tương ứng.</p>
<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>