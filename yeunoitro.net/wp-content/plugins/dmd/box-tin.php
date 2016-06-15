<?php
/*
Plugin Name: Box tin
Plugin URI: http://toi88.com/
Description: Widget Box tin cho amthucgiadinh.net/
Author: Doan Manh Duc
Version: 1.0
Author URI: http://toi88.com/
*/
/*
 * Khởi tạo widget item
 */
add_action( 'widgets_init', 'create_boxtin_widget' );
function create_boxtin_widget() {
  register_widget( 'BoxTin_Widget' );
}

/**
 * Tạo class BoxTin_Widget
 */
class BoxTin_Widget extends WP_Widget {

  /**
   * Thiết lập widget: đặt tên, base ID
   */
  function BoxTin_Widget() {
    $tpwidget_options = array(
      'classname'   => 'boxtin_widget_class', //ID của widget
      'description' => 'widget hien thi danh sach cac tin'
    );
    $this->WP_Widget( 'boxtin_widget_class', 'BoxTin Widget', $tpwidget_options );
  }

  /**
   * Tạo form option cho widget
   */
  function form( $instance ) {
    $default       = array(
      'tieu_de'       => '',
      'post_number'   => 10,
      'ma_chuyen_muc' => 1
    );
    $instance      = wp_parse_args( (array) $instance, $default );
    $post_number   = esc_attr( $instance[ 'post_number' ] );
    $tieu_de       = $instance[ 'tieu_de' ];
    $ma_chuyen_muc = esc_attr( $instance[ 'ma_chuyen_muc' ] );
?>
    <p><label for="">Tiêu đề box</label>
      <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'tieu_de' ); ?>"  value="<?php echo $tieu_de; ?>" /></p>
    <p><label for="">ID chuyên mục</label><input type="number" class="widefat" name="<?php echo $this->get_field_name( 'ma_chuyen_muc' ); ?>" value="<?php echo $ma_chuyen_muc; ?>" /></p>
    <p><label for="">Số lượng bài viết hiển thị</label><input type="number" class="widefat" name="<?php echo $this->get_field_name( 'post_number' ); ?>" value="<?php echo $post_number ?>" /></p>
    <?php
  }

  /**
   * save widget form
   */

  function update( $new_instance, $old_instance ) {
    $instance                    = $old_instance;
    $instance[ 'tieu_de' ]       = $new_instance[ 'tieu_de' ];
    $instance[ 'post_number' ]   = strip_tags( $new_instance[ 'post_number' ] );
    $instance[ 'ma_chuyen_muc' ] = strip_tags( $new_instance[ 'ma_chuyen_muc' ] );

    return $instance;
  }

  /**
   * Show widget
   */

  function widget( $args, $instance ) {
    extract( $args );
    $post_number   = $instance[ 'post_number' ];
    $tieu_de       = $instance[ 'tieu_de' ];
    $ma_chuyen_muc = esc_attr( $instance[ 'ma_chuyen_muc' ] );
    if ( isset( $before_widget ) ) {
      echo $before_widget;
    }
    ?>
    <div class="new-ct bottom-20">
      <div class="title-nct">
        <h3 class="text-3 title-style-1">
          <a href="<?php echo get_category_link( $ma_chuyen_muc ); ?>"><?php echo $tieu_de; ?></a></h3>

        <div class="clearfix"></div>
      </div>
      <?php
      $arr       = array(
        'post_type'      => 'post',
        'cat'            => $ma_chuyen_muc,
        'posts_per_page' => $post_number
      );
      $the_query = new WP_Query( $arr );
      if ( $the_query->have_posts() ) :
        while( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <div class="item-new-ct">
            <div class="pull-left item-new-ct-img img-w70">
              <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'wp_review_small', array(
                      'alt'   => get_the_title()
                    ) );
                } else {
                  echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:65px; height:65px;'>";
                }
                ?>
              </a>
            </div>
            <div class="pull-left item-new-ct-content">
              <div><a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a>
              </div>
              <div class="info2 pull-left">
								<span>
									<?php
                  $date_created = explode( '/', get_the_date( "d/m/Y" ) );

                  $day   = $date_created[ 0 ];
                  $month = $date_created[ 1 ];
                  $year  = $date_created[ 2 ];

                  $strday = $day . "/" . $month . "/" . $year;

                  $today = getdate();
                  if ( $today[ "year" ] == $year ) {
                    if ( $today[ "mon" ] == $month ) {
                      if ( $today[ "mday" ] == $day ) {
                        echo "Hôm nay";
                      } elseif ( ( $today[ "mday" ] - 1 ) == $day ) {
                        echo "Hôm qua";
                      } else {
                        echo $strday;
                      }
                    } else {
                      echo $strday;
                    }
                  } else {
                    echo $strday;
                  }
                  ?>
                  <?php echo get_the_date( "G:i" ); ?>
								</span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>
        <?php endwhile;
      endif;
      ?>
      <!--			<a class="view-more pull-right" href="--><?php //echo get_category_link( $ma_chuyen_muc ); ?><!--"><em>Xem nhiều hơn &#187;</em></a>-->
    </div>
    <?php
    if ( isset( $after_widget ) ) {
      echo $after_widget;
    }
  }
}
