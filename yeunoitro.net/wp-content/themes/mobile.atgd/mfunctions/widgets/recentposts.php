<?php

/*------------------------------------------*/
/* HALH COPY WPZOOM: Recent Posts           */
/*------------------------------------------*/

class ATGD_Feature_Posts extends WP_Widget {

	function ATGD_Feature_Posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'feature-posts', 'description' => 'A list of posts, optionally filter by category.' );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'atgd-feature-posts' );

		/* Create the widget. */
		$this->WP_Widget( 'atgd-feature-posts', 'ATGD: Recent Posts', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		/* User-selected settings. */
		$title 			= apply_filters('widget_title', $instance['title'] );
		$category 		= $instance['category'];
		$show_count 	= $instance['show_count'];
		$show_date 		= $instance['show_date'] ? true : false;
		$show_rating	= $instance['show_rating'] ? true : false;
		$show_thumb 	= $instance['show_thumb'] ? true : false;
		$show_excerpt 	= $instance['show_excerpt'] ? true : false;
		$excerpt_length = $instance['excerpt_length'];
		$show_title 	= $instance['hide_title'] ? false : true;

		/* Before widget (defined by themes). */
		echo $before_widget;

		echo '<section class="formula-top-one">';

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo  '<div class="ts1"><h3>'.$title.'</h3><div class="clearfix"></div></div>';

		if ($show_rating) {
			$query_opts[1] = m_get_post_args(1, ($category)?$category:0, array('wpcf-dac-biet-1' => 1));
			$query_opts[2] = m_get_post_args(3, ($category)?$category:0, array('wpcf-dac-biet-2' => 1));
		}

		$args = array('post_type' => 'post', "posts_per_page" => ( $show_count - 4));

		$query_opts[3] = $args;

		if ( $category ) $query_opts[3]['cat'] = $category;

		echo '<aside class="wrapper-post">';

		foreach ($query_opts as $key => $query_opt) {
			query_posts($query_opt);
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				echo '<article class="post-block top-10">';

				if ( $show_thumb ) {
					echo '<figure class="post-img w130 pull-left">';
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'Category-list', array('class' => 'img-full-width', 'style' => 'width:'.$instance['thumb_width'].'px; height:'.$instance['thumb_height'].'px;', 'alt' => ''.get_the_title().''));
					}
					echo '</figure>';
				}
				echo '<div class="post-content ps-1">';
				if ( $show_title ) {
					echo '<a href="' . get_permalink() . '"><h4>' . get_the_title() . '</h4></a>';
				}

				if ( $show_excerpt ) {
					echo '<div class="description font-3 top-10">'.excerpt($excerpt_length).'</div>';
				}

//				echo '<div class="info">
//								<div class="auth pull-left">
//									<span class="icon-user"></span>
//									<span class="font-1 color-2"><em><strong>'.get_the_author().'</strong></em></span>
//								</div>';
				if ( $show_excerpt ) {
					echo '<div class="date"><span class="icon-date"></span><span class="font-1 color-2"><em>'; show_date_category(get_the_date('M/d/Y'),get_the_date('G:i')); echo '</em></div>';
				}

				echo '<div class="clearfix"></div></article>';
			endwhile; else:
			endif;

			//Reset query_posts
			wp_reset_query();
		}
		echo '</aside>
		</section>';
//		<a href="" class="btn-xt">Xem thêm nhiều công thức <span class="icon-mt"></span></a>
		/* After widget (defined by themes). */
		echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = $new_instance['category'];
		$instance['show_count'] = $new_instance['show_count'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_rating'] = $new_instance['show_rating'];
		$instance['show_thumb'] = $new_instance['show_thumb'];
		$instance['show_excerpt'] = $new_instance['show_excerpt'];
		$instance['hide_title'] = $new_instance['hide_title'];
		$instance['thumb_width'] = $new_instance['thumb_width'];
		$instance['thumb_height'] = $new_instance['thumb_height'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Recent Posts', 'category' => 0, 'show_count' => 5, 'show_date' => false, 'show_rating' => false, 'show_thumb' => false, 'show_excerpt' => false, 'hide_title' => false, 'thumb_width' => 75, 'thumb_height' => 50, 'excerpt_length' => 55 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br />
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Category:</label>
			<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
				<option value="0" <?php if ( !$instance['category'] ) echo 'selected="selected"'; ?>>All</option>
				<?php
				$categories = get_categories(array('type' => 'post'));

				foreach( $categories as $cat ) {
					echo '<option value="' . $cat->cat_ID . '"';

					if ( $cat->cat_ID == $instance['category'] ) echo  ' selected="selected"';

					echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';

					echo '</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_count' ); ?>">Show:</label>
			<input id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" value="<?php echo $instance['show_count']; ?>" type="text" size="2" /> posts
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['hide_title'], 'on' ); ?> id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>">Hide post title</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>">Display post date</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_rating'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_rating' ); ?>" name="<?php echo $this->get_field_name( 'show_rating' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_rating' ); ?>">Display post rating</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_thumb'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>">Display post thumbnail</label>
		</p>

		<?php
		// only allow thumbnail dimensions if GD library supported
		if ( function_exists('imagecreatetruecolor') ) {
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'thumb_width' ); ?>">Thumbnail size</label> <input type="text" id="<?php echo $this->get_field_id( 'thumb_width' ); ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" value="<?php echo $instance['thumb_width']; ?>" size="3" /> x <input type="text" id="<?php echo $this->get_field_id( 'thumb_height' ); ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" value="<?php echo $instance['thumb_height']; ?>" size="3" />
			</p>
		<?php
		}
		?>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_excerpt'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>">Display post excerpt</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>">Excerpt character limit:</label>
			<input id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $instance['excerpt_length']; ?>" type="text" size="4" />
		</p>

	<?php
	}
}

function atgd_register_fp_widget() {
	register_widget('ATGD_Feature_Posts');
}
add_action('widgets_init', 'atgd_register_fp_widget');