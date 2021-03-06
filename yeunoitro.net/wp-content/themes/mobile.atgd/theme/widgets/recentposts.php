<?php

/*------------------------------------------*/
/* WPZOOM: Recent Posts           */
/*------------------------------------------*/
 
class Wpzoom_Feature_Posts extends WP_Widget {
	
	function Wpzoom_Feature_Posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'feature-posts', 'description' => 'A list of posts, optionally filter by category.' );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'wpzoom-feature-posts' );

		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-feature-posts', 'WPZOOM: Recent Posts', $widget_ops, $control_ops );
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
		echo '<section class="formula-top-one">';
		
		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo '<div class="ts1"><h2>'. $title . '</h2><div class="clearfix"></div></div>';
		
		echo '<aside class="wrapper-post">';
		
		$query_opts = apply_filters('wpzoom_query', array(
			'posts_per_page' => $show_count,
			'post_type' => 'post'
		));
		if ( $category ) $query_opts['cat'] = $category;
		
		query_posts($query_opts);			
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			echo '<article class="post-block top-10">';
				
				if ( $show_thumb ) {
					echo '<figure class="post-img w130 pull-left">';
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'Category-list', array('class' => 'img-full-width', '', 'alt' => ''.get_the_title().''));
					}
					echo '</figure>';
				}
			echo '<div class="post-content ps-1">';
						
				if ( $show_title ) echo '<a href="' . get_permalink() . '"><h3>' . get_the_title() . '</h3></a> <br />';

				if ( $show_excerpt ) {
					$the_excerpt = get_the_excerpt();
					
					// cut to character limit
					$the_excerpt = substr( $the_excerpt, 0, $excerpt_length );
					
					// cut to last space
					$the_excerpt = substr( $the_excerpt, 0, strrpos( $the_excerpt, ' '));
					
					echo '<div class="description font-3 top-10">'.$the_excerpt.'</div>';
				}
//			echo '<div class="info">
//							<div class="auth">
//								<span class="icon-user pull-left"></span>
//								<span class="font-1 color-2"><em><strong>'.get_the_author().'</strong></em></span>
//							</div>';

				if ( $show_date ) echo '<div class="date"><span class="icon-date"></span>span class="font-1 color-2"><em>' . get_the_time('M/d/Y lúc h:i') . '</em></div>';

			echo '<div class="clearfix"></div></article>';

			endwhile; else:
			endif;
			
			//Reset query_posts
			wp_reset_query();
		echo '</aside>';
//		echo '<a href="#" class="btn-xt">Xem thêm nhiều công thức <span class="icon-mt"></span></a>';
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

function wpzoom_register_fp_widget() {
	register_widget('Wpzoom_Feature_Posts');
}
add_action('widgets_init', 'wpzoom_register_fp_widget');