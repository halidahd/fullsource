<?php
/*
Plugin Name: Binh luan moi nhat
Plugin URI: http://toi88.com/
Description: Widget Binh luan moi cho amthucgiadinh.net/
Author: Doan Manh Duc
Version: 1.0
Author URI: http://toi88.com/
*/
/*
 * Khởi tạo widget item
 */
add_action( 'widgets_init', 'create_binhluan_widget' );
function create_binhluan_widget() {
        register_widget('BinhLuan_Widget');
}

/**
 * Tạo class BinhLuan_Widget
 */
class BinhLuan_Widget extends WP_Widget {
 
        /**
         * Thiết lập widget: đặt tên, base ID
         */
        function BinhLuan_Widget() {
			$tpwidget_options = array(
					'classname' => 'binhluan_widget_class', //ID của widget
					'description' => 'widget hien thi danh sach cac binh luan moi dang'
			);
			$this->WP_Widget('binhluan_widget_class', 'BinhLuan Widget', $tpwidget_options);
        }
 
        /**
         * Tạo form option cho widget
         */
        function form( $instance ) {
			$default = array(
                        'no_comments' => 10
                );
            $instance = wp_parse_args( (array) $instance, $default );
            $no_comments = esc_attr($instance['no_comments']); 
            
            echo '<p>Số lượng bình luận hiển thị <input type="number" class="widefat" name="'.$this->get_field_name('no_comments').' value="'.$no_comments.'" placeholder="'.$no_comments.'" max="30" /></p>';
        }
 
        /**
         * save widget form
         */
 
        function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
            $instance['no_comments'] = strip_tags($new_instance['no_comments']);
            return $instance;
        }
 
        /**
         * Show widget
         */
 
        function widget( $args, $instance ) {
			extract($args);
            $no_comments = $instance['no_comments'];
			
            echo $before_widget;			
			?>
			<div class="new-ct bottom-20 _blmn">
			<div class="title-nct">
				<h3 class="text-3 title-style-1">BÌNH LUẬN MỚI NHẤT</h3>

				<div class="clearfix"></div>
			</div>
			<?php			
			// Make an array for the parameters.
			$parameters = array(
					'APIKey' => 'Tv2WJWDIQ8QFircKGr7NM80gSQJciKncVY3F7OnYaTLiGHLEgtrR3vGJURiuww3l',
					'forumName' => 'amthucgiadinh',
					'commentCount' => $no_comments,
					'commentLength' => 95
			);
			// Using the DQGetRecentComments() function.
			$DQComments = DQGetRecentComments($parameters);
			//$comments_query = new WP_Comment_Query();
			//$comments = $comments_query->query( array( 'number' => $no_comments, 'status' => 'approve' ) );
			foreach ( $DQComments as $comment ) : ?>    				
						<div class="box-user-comment">
                            <a href="<?php echo $comment["pageURL"]; ?>">
                                <div class="pull-left user-avt">
                                    <img src="<?php echo $comment["authorAvatar"];?>" style="width:70px; height:62px;" />
                                </div>
                                <div class="pull-left item-new-ct-content bottom-20 top-10 left-10">
                                    <div class="user-name"><strong><?php echo $comment["authorName"]; ?></strong></div>
                                    <div class="info pull-left">
                                        <i class="_time"></i>
                                        <span> 
                                        <em>
                                        <?php											
                                            $date_created = strtotime($comment["createdAt"]);
											
                                            $day = date('d', $date_created);
                                            $month = date('m', $date_created);
                                            $year = date('Y', $date_created);											
                                            
                                            $strday =  $day . "/" . $month . "/" . $year;
                                            
                                            $today = getdate();
                                            if($today["year"] == $year) {
                                                if($today["mon"] == $month) {
                                                    if($today["mday"] == $day) {
                                                        echo "Hôm nay";
                                                    }
                                                    elseif(($today["mday"] - 1) == $day) {
                                                        echo "Hôm qua";
                                                    }
                                                    else {
                                                        echo $strday;
                                                    }
                                                }
                                                else {
                                                    echo $strday;
                                                }
                                            }
                                            else {
                                                echo $strday;
                                            }											
                                        ?> 
                                        lúc : <?php echo date('H:i', $date_created); ?> 
                                        </em>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <p>
                                    <span class="font-21">&ldquo;</span> 
                                    <?php echo $comment["message"]; ?> 
                                    <span class="font-21">&rdquo;</span>
                                </p>
                                <p class="text-help font-12">
                                    <em>Trong bài: <?php echo $comment['pageTitle']?></em>
                                </p>
                                <div class="clearfix"></div>
                            </a>							
						</div>
             <?php 
				endforeach;
			?>
			<div class="clearfix"></div>
			</div>
		<?php
			
            echo $after_widget;
        }
 
}
