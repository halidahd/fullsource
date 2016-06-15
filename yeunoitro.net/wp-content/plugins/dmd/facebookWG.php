<?php
/*
Plugin Name: FacebookWG
Plugin URI: http://toi88.com/
Description: Widget Facebook cho amthucgiadinh.net/
Author: Doan Manh Duc
Version: 1.0
Author URI: http://toi88.com/
*/
/*
 * Khởi tạo widget item
 */
add_action( 'widgets_init', 'create_facebook_widget' );
function create_facebook_widget() {
        register_widget('Facebook_Widget');
}

/**
 * Tạo class Facebook_Widget
 */
class Facebook_Widget extends WP_Widget {
 
        /**
         * Thiết lập widget: đặt tên, base ID
         */
        function Facebook_Widget() {
			$tpwidget_options = array(
					'classname' => 'facebook_widget_class', //ID của widget
					'description' => 'widget hien thi facebook social'
			);
			$this->WP_Widget('facebook_widget_class', 'Facebook Widget', $tpwidget_options);
        }
 
        /**
         * Tạo form option cho widget
         */
        function form( $instance ) {
			
        }
 
        /**
         * save widget form
         */
 
        function update( $new_instance, $old_instance ) {
			
        }
 
        /**
         * Show widget
         */
 
        function widget( $args, $instance ) {
			if(isset($before_widget)) echo $before_widget;
			
			?>
			<div class="new-ct bottom-20 _blmn" style="text-align:center;">
			<style>
				._tfb {
					position: relative;
					z-index: 2;
				}
			</style>
				<div class="fb-page" data-href="https://www.facebook.com/yeunoitro.net" data-width="500" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/yeunoitro.net"><a href="https://www.facebook.com/yeunoitro.net">Yêu nội trợ</a></blockquote></div></div>
			</div>
		<?php
			
            if(isset($after_widget)) echo $after_widget;
        }
 
}
