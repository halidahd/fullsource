<?php
/*
Plugin Name: Cong thuc dac biet
Plugin URI: http://ducdoan.com/
Description: Widget Cong thuc dac biet cho amthucgiadinh.net/
Author: Doan Manh Duc
Version: 1.0
Author URI: http://ducdoan.com/
*/
/*
 * Khởi tạo widget item
 */
add_action( 'widgets_init', 'create_congthucdacbiet_widget' );
function create_congthucdacbiet_widget() {
  register_widget( 'CongThucDacBiet_Widget' );
}

/**
 * Tạo class CongThucDacBiet_Widget
 */
class CongThucDacBiet_Widget extends WP_Widget {

  /**
   * Thiết lập widget: đặt tên, base ID
   */
  function CongThucDacBiet_Widget() {
    $tpwidget_options = array(
      'classname'   => 'congthucdacbiet_widget_class', //ID của widget
      'description' => 'widget hien thi danh sach cac cong thuc dac biet'
    );
    $this->WP_Widget( 'congthucdacbiet_widget_class', 'CongThucDacBiet Widget', $tpwidget_options );
  }

  /**
   * Tạo form option cho widget
   */
  function form( $instance ) {
    $default     = array(
      'post_number' => 10
    );
    $instance    = wp_parse_args( (array) $instance, $default );
    $post_number = esc_attr( $instance[ 'post_number' ] );
    ?>
    <p><label>Số lượng bài viết hiển thị</label>
      <input type="text" name="<?php echo $this->get_field_name( 'post_number' ); ?>" value="<?php echo $post_number; ?>" class="widefat"/></p>
    <?php
  }

  /**
   * save widget form
   */

  function update( $new_instance, $old_instance ) {
    $instance                  = $old_instance;
    $instance[ 'post_number' ] = strip_tags( $new_instance[ 'post_number' ] );

    return $instance;
  }

  /**
   * Show widget
   */

  function widget( $args, $instance ) {
    extract( $args );
    $post_number = $instance[ 'post_number' ];

    if ( isset( $before_widget ) ) {
      echo $before_widget;
    }

    ?>
    <div class="new-ct bottom-20">

      <div class="title-nct">
        <h3 class="text-3 title-style-1">Công thức đặc biệt </h3>

        <div class="clearfix"></div>
      </div>
      <?php
      $postids = array();
      $args    = array(
        'posts_per_page' => $post_number,
        'meta_query'     => array(
          'relation' => 'AND',
          array(
            'key'   => 'wpcf-dac-biet-2',
            'value' => 1
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
      if ( isset( $cat ) ) {
        $args[ 'cat' ] = $cat;
      }
      $sopost    = 0;
      $the_query = new WP_Query( $args );
      if ( $the_query->have_posts() ) :
        while( $the_query->have_posts() ) : $the_query->the_post();
          $sopost ++;
          $postids[ ] = get_the_ID();
          ?>
          <div class="item-new-ct">
            <div class="pull-left img-w70">
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
            <!--thay đổi class xóa div clearfix-->
            <div class="pull-left item-new-ct-content">
              <div class="mh-42">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?> </a>
              </div>
            </div>
            <!--							<div class="info2 pull-left">--><!--								<i class="_user"></i><span><strong>--><?php //echo get_the_author(); ?><!--</strong></span>--><!--							</div>-->
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
            <!--end thay đổi class xóa div clearfix-->
          </div>
        <?php
        endwhile;
      endif;
      wp_reset_query();

      if ( $sopost < $post_number ) {
        $sopost       = $post_number - $sopost;
        $arr222       = array(
          'posts_per_page' => $sopost,
          'cat'            => $cat,
          'post__not_in'   => $postids
        );
        $the_query222 = new WP_Query( $arr222 );
        if ( $the_query222->have_posts() ) {
          while( $the_query222->have_posts() ) {
            $the_query222->the_post();
            ?>
            <div class="item-new-ct">
              <div class="pull-left img-w70">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <?php
                  if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'wp_review_small', array(
                        'class' => '',
                        'style' => 'width:70px; height:62px;',
                        'alt'   => '' . get_the_title() . ''
                      ) );
                  } else {
                    echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:70px; height:62px;'>";
                  }
                  ?>
                </a>
              </div>
              <!--thay đổi class xóa div clearfix-->
              <div class="pull-left item-new-ct-content">
                <div class="mh-42">
                  <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?> </a>
                </div>
              </div>
              <!--							<div class="info2 pull-left">--><!--								<i class="_user"></i><span><strong>--><?php //echo get_the_author(); ?><!--</strong></span>--><!--							</div>-->
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
              <!--end thay đổi class xóa div clearfix-->
            </div>
          <?php
          }
        }
        wp_reset_query();
      }
      ?>
      <!--			<a class="view-more pull-right" href="/cong-thuc-dac-biet"><em>Xem nhiều hơn &#187;</em></a>-->
    </div>
    <?php

    if ( isset( $after_widget ) ) {
      echo $after_widget;
    }
  }

}
