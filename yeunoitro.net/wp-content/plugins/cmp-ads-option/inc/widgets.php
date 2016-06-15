<?php
/**
 * Widgets CMP Ads
 * @author  halidahd
 * @pagkage cmp-ads-option
 */

add_action( 'widgets_init', 'cmp_ads_widget_init' );

function cmp_ads_widget_init()
{
	register_widget( "Cmp_ads_widget" );
}

class Cmp_ads_widget extends WP_Widget
{
	function Cmp_ads_widget()
	{
		$widget_ops = array( 'classname' => 'cmp_ads_widget', 'description' => __( 'Widget to display Ads', 'yeunoitro' ) );
		parent::WP_Widget( false, $name = __( 'CMP Ads', 'yeunoitro' ), $widget_ops );
	}

	function form( $instance )
	{
		$args = array(
			'title'  => '',
			'id_ads' => '',
			'page'   => '',
		);

		$pages = array(
			'home'     => 'Home',
			'single'   => 'Single',
			'tag'      => 'Tag',
			'category' => 'Category',
			'series'   => 'Series',
      'search'   => 'Search',
		);

		$instance = wp_parse_args( (array) $instance, $args );
		$title    = esc_attr( $instance['title'] );
		$id_ads   = $instance['id_ads'];
		$page     = $instance['page'];

		$all_options = wp_load_alloptions();
		$my_options  = array();
		foreach ( $all_options as $name => $value )
		{
			if ( stristr( $name, 'cmp_ads' ) && stristr( $name, '_on_off' ) == false )
				$my_options[$name] = $name;
		}

		?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mb-slider' ); ?></label></p>
		<p>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'id_ads' ); ?>"> <?php _e( 'Select Ads', 'yeunoitro' ); ?></label>
		</p>
		<p><select class="widefat" name="<?php echo $this->get_field_name( 'id_ads' ); ?>">
				<?php
				foreach ( $my_options as $key => $name )
				{
					$selected = '';
					if ( $id_ads == $key )
						$selected = 'selected="selected"';
					echo '<option value="' . $key . '" ' . $selected . '>' . $name . '</option>';
				}
				?>
			</select></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php _e( 'Display on Page:', 'yeunotro' ); ?></label>
		</p>
		<p><select size="5" class="widefat" name="<?php echo $this->get_field_name( 'page' ); ?>[]" multiple="multiple">
				<?php
				foreach ( $pages as $key => $name )
				{
					$selected = '';
					if ( in_array( $key, $page ) )
						$selected = 'selected="selected"';

					echo '<option value="' . $key . '" ' . $selected . '>' . $name . '</option>';
				}
				?>
			</select></p>
		<?php
	}

	function update( $new_instance, $old_instance )
	{
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['id_ads'] = $new_instance['id_ads'];
		$instance['page']   = $new_instance['page'];

		return $instance;
	}

	function widget( $args, $instance )
	{
		extract( $args );
		extract( $instance );

		$title  = isset( $instance['title'] ) ? $instance['title'] : '';
		$id_ads = isset( $instance['id_ads'] ) ? $instance['id_ads'] : '';
		$pages  = isset( $instance['page'] ) ? $instance['page'] : array();

		echo $before_widget;
		//		echo $before_title. $title . $after_title;
		if ( get_option( $id_ads . '_on_off') == 1 && $this->checkPage( $pages ) )
		{
			echo get_option( $id_ads );
		}

		echo $after_widget;
	}

	function checkPage( $page = array() )
	{
		if ( in_array( 'home', $page ) && is_home() )
			return true;
		if ( in_array( 'tag', $page ) && is_tag() )
			return true;
		if ( in_array( 'category', $page ) && is_category() )
			return true;
		if ( in_array( 'single', $page ) && is_single() )
			return true;
		if ( in_array( 'series', $page ) && is_tax( 'series' ) )
			return true;
    if ( in_array( 'search', $page ) && is_search() )
      return true;

		return false;
	}

}