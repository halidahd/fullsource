<?php get_header(); ?>
<?php /* Start the Loop */

$arr = array(
	's'              => get_search_query(),
	'posts_per_page' => 10,
	'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
);
$t   = isset( $_GET['t'] ) ? $_GET['t'] : 'DESC';
if ( isset( $_GET['b'] ) )
{
	$b = $_GET['b'];

	if ( $b == "review" )
	{
		$arr['post__in'] = get_posts_by_review( $t );
		$arr['orderby']  = 'post__in';
	}
	elseif ( $b == "time" )
	{
		$arr['orderby'] = 'date';
		$arr['order']   = $t;
	}
	elseif ( $b == "hot" )
	{
		$arr = array_merge( $arr, array(
			'meta_key'   => 'wpcf-noi-bat',
			'meta_value' => 1
		) );

		$arr['orderby'] = array( 'meta_value_num' => 'DESC', 'title' => $t );
	}
}
else
{
	$arr['orderby'] = 'date';
}

$search_result = query_posts( $arr );
?>
	<!--breadcrumb-->
	<div class="breadcrumbs">
		<?php if ( function_exists( 'bcn_display' ) )
		{
			bcn_display();
		} ?>
	</div>

	<!--title header and note-->
	<div class="title-header">
		<h2><?php echo count($search_result); ?> kết quả cho từ khóa </h2>
		<h2 class="color-4">"<?php echo get_search_query(); ?>"</h2>
	</div>
	<!--công thức mới nhất -->
	<section class="formula-top-one">
		<div class="ts1">
			<h2>list các món ăn</h2>
			<div class="menu-filter pull-right font-4 dropdown">
				<div data-toggle="dropdown">
					Sắp xếp theo<span class="icon-menu-down"></span>
				</div>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li>
						<a class="_lt" href="/?s=<?php echo $arr['s']; ?>&b=review" title="Lượt thích"><i class="icon-like-small"></i> Lượt thích</a>
					</li>
					<li>
						<a class="_nb" href="/?s=<?php echo $arr['s']; ?>&b=hot" title="Nổi bật"><i class="icon-star"></i> Nổi bật</a>
					</li>
					<li>
						<a class="_t" href="/?s=<?php echo $arr['s']; ?>&b=time" title="Thời gian"><i class="icon-time-small"></i> Thời gian</a>
					</li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<aside id="lma" class="wrapper-post">
			<style>.ps-1 {
					margin-left: 130px;
				}</style>
			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				?>
				<article class="post-block top-10">
					<figure class="post-img w130 pull-left">
						<?php
						if ( has_post_thumbnail() )
						{
							the_post_thumbnail( 'Category-list', array( 'class' => 'img-full-width', 'style' => 'width:130px; height:117px;', 'alt' => '' . get_the_title() . '' ) );
						}
						?>
					</figure>
					<div class="post-content ps-1">
						<a href="<?php the_permalink(); ?>" class="mh80" title="<?php echo get_the_title(); ?>">
							<h3><?php echo get_the_title(); ?></h3></a>
						<div class="description font-3 top-10">
							<?php echo excerpt( 28 ); ?>
						</div>
						<div class="info">
							<div class="auth">
								<span class="icon-user"></span>
								<span class="font-1 color-2"><em><?php echo get_the_author(); ?></em></span>
							</div>
							<div class="date">
								<span class="icon-date"></span>
								<span class="font-1 color-2"><em><?php echo show_date_category( get_the_date( 'd/m/Y' ), get_the_date( 'G:i' ) ); ?></em></span>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</article>
			<?php endwhile;
			else:
			endif;
			wp_reset_query();
			?>
		</aside>
		<!--	<a href="" id="#" class="btn-xt">Xem thêm nhiều công thức <span class="icon-mt"></span></a>-->
	</section>
<?php get_sidebar(); ?>

<?php get_footer(); ?>