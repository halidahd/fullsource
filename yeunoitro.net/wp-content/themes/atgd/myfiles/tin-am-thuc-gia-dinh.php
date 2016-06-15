<div class="content-part-5 bottom-20 right-10">
	<h3 class="text-3 title title-style-1">tin của ẩm thực gia đình</h3>

	<div class="clearfix"></div>
	<div class="line-border"></div>
	<div class="_col-50-gr">
	<?php
		$args = array('child_of' => constant("id_tin_am_thuc_gia_dinh"), 'orderby' => 'name', 'number' => constant("so_cm_hien_thi"));
		$categories = get_categories($args);
		$check = 1;
		foreach($categories as $category) {
	?>
		<div class="_col-50">
			<div class="_dg">
			<a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>">
				<?php echo get_field('category-icon', 'category_' . $category->cat_ID); ?><?php echo $category->name; ?>
			</a>
			</div>
		<?php
			if($check % 2 == 1){
				echo "<div class='_cdg'>";
			} else {
				echo "<div style='padding:10px 0px 0px 10px'>";
			}
		?>
				<?php
					$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					'cat' => $category->cat_ID
					);
					$the_query = new WP_Query( $args );
					if ($the_query -> have_posts() ) :
					while ($the_query -> have_posts() ) : $the_query -> the_post();
				?>
				<div class="box-img text-center bottom-10 pull-left">
					<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">
							<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'tin-am-thuc', array('class' => '', 'style' => 'width:142px; height:106px;', 'alt' => ''.get_the_title().''));
								}
								else {
									echo "<img src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style='width:142px; height:106px;'>";
								}
							?>
					</a>
				</div>

				<div class="pull-left _tdnhn-ct">
					<div>
						<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">
							<strong><?php shorttitle(get_the_title(), 45) ?></strong>
						</a>
					</div>
					<p style="margin:10px 0px 0px 0px;">
						<?php echo excerpt(15); ?>
					</p>
				</div>
				<?php
					endwhile;
					endif;
					wp_reset_query();
				?>
				<div class="clearfix"></div>
				<ul class="ul-style-1">
				<?php
					$args = array(
					'post_type' => 'post',
					'posts_per_page' => 7,
					'cat' => $category->cat_ID,
					'offset' => 1
					);
					$the_query = new WP_Query( $args );
					if ($the_query -> have_posts() ) :
					while ($the_query -> have_posts() ) : $the_query -> the_post();
				?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">
							<?php the_title() ?>
						</a>
					</li>
				<?php
					endwhile;
					endif;
					wp_reset_query();
				?>
				</ul>
			</div>
		</div>
	<?php
		$check++;
		}
	?>
	</div>
	<div class="clearfix"></div>
</div>
