<?php
/*
Plugin Name: Cong thuc noi bat
Plugin URI: http://ducdoan.com/
Description: Widget Cong thuc moi cho amthucgiadinh.net/
Author: Doan Manh Duc
Version: 1.0
Author URI: http://ducdoan.com/
*/

add_action( 'widgets_init', 'Wid_Cong_thuc_noi_bat' );
function Wid_Cong_thuc_noi_bat() {
  register_widget( 'Cong_thuc_noi_bat' );
}

class Cong_thuc_noi_bat extends WP_Widget {

  function Cong_thuc_noi_bat() {
    $wget_options = array(
      'classname'   => 'Cong thuc noi bat',
      'description' => 'Widget hien thi cong thuc noi bat goc phai'
    );
    $this->WP_Widget( 'ctnb_id', 'Cong thuc noi bat', $wget_options );
  }

  function form( $instance ) {

    $default = array(
      'title'  => 'Công thức nổi bật',
      'number' => '3',
      'time'   => 10
    );

    $instance = wp_parse_args( (array) $instance, $default );
    $title    = esc_attr( $instance[ 'title' ] );
    $number   = esc_attr( $instance[ 'number' ] );
    $time     = esc_attr( $instance[ 'time' ] );

    ?>
    <p><lable>Tên box:</lable>
      <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="widefat"/></p>
    <p><lable>Số lượng bài hiển thị:</lable>
      <input type="text" name="<?php echo $this->get_field_name( 'number' ) ; ?>" value="<?php echo $number; ?>" class="widefat"/></p>
    <p><lable>Hiển thị sau:</lable>
      <input type="text" name="<?php echo $this->get_field_name( 'time' ); ?>" value="<?php echo $time; ?>" class="widefat"/></p>
    <?php
  }

  function update( $new_instance, $old_instance ) {

    $instance             = $old_instance;
    $instance[ 'title' ]  = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'number' ] = strip_tags( $new_instance[ 'number' ] );
    $instance[ 'time' ]   = strip_tags( $new_instance[ 'time' ] );

    return $instance;
  }

  function widget( $args, $instance ) {
    extract( $args );
    $title  = $instance[ 'title' ];
    $number = $instance[ 'number' ];
    $time   = $instance[ 'time' ];

    echo $before_widget;
    ?>
    <style>
      .w310 {
        width: 310px;
        margin: auto;
      }

      .p-header {
        background-color: #0F994B;
        color: white;
        text-transform: uppercase;
        font-size: 16px;
        padding: 10px 10px;
      }

      .dropdown-tg {
        border: 1px solid white;
        padding: 0px 5px;
        border-radius: 50%;
        cursor: pointer;
      }

      .item-new-ct-img {
        margin-right: 10px;
      }

      .item-new-ct {
        border-bottom: 0px;
      }

      .p-content {
        border: 1px solid #dbdbdb;
      }
    </style>
    <script type="text/javascript">
      var $ = jQuery.noConflict();
      $( document ).ready( function() {
        if( $( window ).width() > 500 ) {
          var time = <?php echo $time ?>;
          $( "#popup_noibat" ).slideUp( "slow" ).delay( time * 1000 ).fadeIn( 1000 );
        }
      } );
      function toggle_popup() {
        if( $( ".fa-angle-down" ).hasClass( "down" ) ) {
          $( "#popup_noibat .p-content" ).slideUp( "slow" );

          $( "#popup_noibat .p-content" ).hide( "slow" );

          $( ".fa-angle-down" ).addClass( "up" );
          $( ".fa-angle-down" ).removeClass( "down" );
        }
        else {
          $( "#popup_noibat .p-content" ).slideDown( "slow" );

          $( "#popup_noibat .p-content" ).show( "slow" );

          $( "#popup_noibat .p-content" ).slideDown( "slow" );

          $( ".fa-angle-down" ).addClass( "down" );
          $( ".fa-angle-down" ).removeClass( "up" );
        }
      }
    </script>
    <div class="w310" id="popup_noibat">
      <div class="p-header">
        <span><?php echo $title; ?></span>

        <div class="dropdown-tg pull-right">
          <i class="fa fa-angle-down down" onclick="return toggle_popup();"></i>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="p-content">
        <?php
        $qobj      = get_queried_object();
        $tax_query = array();
        if ( is_archive() ) {
          $tax_query = array(
            array(
              'taxonomy' => $qobj->taxonomy,
              'field'    => 'id',
              'terms'    => $qobj->term_id,
            )
          );
        }
        $arr       = array(
          'meta_key'       => '',
          'meta_value'     => 1,
          'meta_query'     => array(
            'relation' => 'AND',
            array(
              'key'     => 'wpcf-noi-bat',
              'compare' => '=',
              'value'   => 1,
            ),
//                array(
//                    'key'     => 'wpcf-han-hien-thi',
//                    'value'   => '1/1/2015',
//                    'compare' => '>='
//                )
          ),
          'posts_per_page' => $number,
          'tax_query'      => $tax_query
        );
        $the_query = new WP_Query( $arr );
        if ( $the_query->have_posts() ) :
          while( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="item-new-ct">
              <div class="pull-left item-new-ct-img">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <?php
                  if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'wp_review_small', array(
                        'style' => 'width:70px; height:62px;',
                        'alt'   => get_the_title()
                      ) );
                  } else {
                    echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:70px; height:62px;'>";
                  }
                  ?>
                </a>
              </div>
              <div class="pull-left item-new-ct-content">
                <div>
                  <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?> </a>
                </div>
                <div class="info pull-left">
                  <i class="_time"></i><span>
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
      </div>
    </div>
    <?php

    echo $after_widget;
  }
}
