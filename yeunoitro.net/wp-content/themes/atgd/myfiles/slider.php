<script type="text/javascript">
	$(document).ready(function(){
		$(".carousel-inner .item:first-child").addClass("active");
	});
</script>
<style type="text/css">
	.header-caption a,
	.content-caption a{
		color:#FFF;
	}
</style>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	</ol>
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<?php 						
			$postids = array();
			$args = array(
			'posts_per_page' => 3,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key'     => 'wpcf-dac-biet-1',
					'value'   => 1
				),
//				array(
//					'key'     => 'wpcf-hien-thi-tu',
//					'value'   => strtotime(current_time( 'mysql' )),
//					'compare' => '<='
//				),
//				array(
//					'key'     => 'wpcf-hien-thi-den',
//					'value'   => strtotime(current_time( 'mysql' )),
//					'compare' => '>='
//				),
			),
			);
			$the_query = new WP_Query( $args );

			$sopost = 0;
			if ($the_query -> have_posts() ) :
			while ($the_query -> have_posts() ) : $the_query -> the_post(); 
			$sopost++;
			$postids[] = get_the_ID();
		?>
		<div class="item">
			<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">                        
				<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'thumbnail', array('class' => '', 'style' => 'width:473px; height:265px;', 'alt' => ''.get_the_title().'')); 
					}
					else {
						echo "<img src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style='width:473px; height:265px;'>";
					}
				?> 
			</a>
			<div class="carousel-caption">
				<div class="header-caption">
					<?php 
						$category = get_the_category(); 
						if($category[0]){
						echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
						}
					?>
				</div>
				<div class="content-caption">
					<a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>">
						<?php the_title() ?>
					</a>
				</div>
			</div>
		</div>
		<?php
			endwhile;
			endif; 
			wp_reset_query();
			if($sopost < 3) 
			{
			$sopost = 3 - $sopost;
			$arr222 = array(
				'posts_per_page'=>$sopost,		
				'post__not_in' => $postids
			);
			$the_query222 = new WP_Query($arr222);
			if ($the_query222 -> have_posts() ) {
			while ($the_query222 -> have_posts() ) { $the_query222 -> the_post(); 
		?>	
		<div class="item">
			<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">                        
				<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'thumbnail', array('class' => '', 'style' => 'width:473px; height:265px;', 'alt' => ''.get_the_title().'')); 
					}
					else {
						echo "<img src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style='width:473px; height:265px;'>";
					}
				?> 
			</a>
			<div class="carousel-caption">
				<div class="header-caption">
					<?php 
						$category = get_the_category(); 
						if($category[0]){
						echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
						}
					?>
				</div>
				<div class="content-caption">
					<a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>">
						<?php the_title() ?>
					</a>
				</div>
			</div>
		</div>
		<?php 
			}
			} 
			wp_reset_query();
			}
		?>
	</div>
	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>