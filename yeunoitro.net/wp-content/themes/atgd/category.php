<?php
/**
 * The template for displaying category pages.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * @package atgd
 */

get_header(); ?>

<?php
$cat = get_query_var( 'cat' );
?>

  <div class="content-left pull-left">
  <style>
    ._mtdl {
      position: relative;
    }

    .new-wp a {
      line-height: 20px;
    }

    .new-wp .w525 {
      padding-left: 13px;
    }

    ._mtdl img {
      position: absolute;
      left: -27px;
      top: -33px;
    }
  </style>
  <div class="content-part-1 bottom-10 right-20">
    <div class="breakumb">
      <?php if ( function_exists( 'bcn_display' ) ) {
        bcn_display();
      }


      ?>
    </div>
    <h1 class="_title-herder bottom-10"><?php get_meta_key_title_psp(); ?></h1>

    <div class="_mtdl"><img src="<?php echo get_template_directory_uri(); ?>/images/mui-ten-dm.png" alt="" title="">
    </div>
    <div class="dm_description bottom-10">
      <?php
      $des = str_replace( "<p>", "", get_the_archive_description() );
      $des = str_replace( "</p>", "", $des );
      echo $des;
      ?>
    </div>
  </div>
  <div class="content-part-2 bottom-10 right-20">
  <div class="_col-50-gr">
  <div class="_col-50">
    <style>
      ._cdg {
        padding-top: 0px;
        min-height: 370px;
      }

      .post-xnt {
        padding-top: 0px;
        padding-bottom: 10px;
      }

      .top-view-content .post-xnt:last-child {
        padding-bottom: 0px;
      }
    </style>
    <?php
    $postids   = array();
    $args      = array(
      'posts_per_page' => 1,
      'cat'            => $cat,
      'meta_query'     => array(
        'relation' => 'AND',
        array(
          'key'   => 'wpcf-dac-biet-1',
          'value' => 1
        ),
//							array(
//								'key'     => 'wpcf-hien-thi-tu',
//								'value'   => strtotime(current_time( 'mysql' )),
//								'compare' => '<='
//							),
//							array(
//								'key'     => 'wpcf-hien-thi-den',
//								'value'   => strtotime(current_time( 'mysql' )),
//								'compare' => '>='
//							),
      ),
    );
    $the_query = new WP_Query( $args );

    if ( $the_query->post_count == 0 ) {
      $the_query = new WP_Query( 'posts_per_page=1&&cat=' . $cat );
    }

    if ( $the_query->have_posts() ) :
      while( $the_query->have_posts() ) : $the_query->the_post();
        $postids[ ] = get_the_ID();
        ?>
        <div class="_cdg">
          <div class="img-w351 bottom-10">
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'thumbnail', array(
                    'class' => '',
                    'style' => 'width:351px; height:208px;',
                    'alt'   => '' . get_the_title() . ''
                  ) );
              } else {
                echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:351px; height:208px;'>";
              }
              ?>
            </a>
          </div>
          <div>
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
              <h3 class="text-2 bottom-10"><?php the_title() ?></h3>
            </a>

            <!--							<div class="info col-xs-7 no-padding">--><!--								<i class="_user"></i><span>Đăng bởi <strong>--><?php //the_author(); ?><!--</strong></span>--><!--							</div>-->
            <div class="info col-xs-5 no-padding text-right">
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
                lúc <?php echo get_the_date( "G:i" ); ?>
								</span>
            </div>

            <div class="clearfix"></div>
            <p class="top-10">
              <?php echo excerpt( 55 ); ?>
            </p>
          </div>
        </div>
      <?php
      endwhile;
    endif;
    wp_reset_query();
    ?>
  </div>
  <div class="_col-50">
    <div class="top-view-content">
      <?php
      $args      = array(
        'posts_per_page' => 5,
        'cat'            => $cat,
        'meta_query'     => array(
          'relation' => 'AND',
          array(
            'key'   => 'wpcf-dac-biet-2',
            'value' => 1
          ),
//							array(
//								'key'     => 'wpcf-hien-thi-tu',
//								'value'   => strtotime(current_time( 'mysql' )),
//								'compare' => '<='
//							),
//							array(
//								'key'     => 'wpcf-hien-thi-den',
//								'value'   => strtotime(current_time( 'mysql' )),
//								'compare' => '>='
//							),
        ),
      );
      $sopost    = 0;
      $the_query = new WP_Query( $args );
      if ( $the_query->have_posts() ) :
        while( $the_query->have_posts() ) : $the_query->the_post();
          $sopost ++;
          $postids[ ] = get_the_ID();
          ?>
          <div class="post-xnt">
            <div class="pull-left img-w80">
              <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'Category-thumb', array(
                      'class' => '',
                      'style' => 'width:80px; height:64px;',
                      'alt'   => '' . get_the_title() . ''
                    ) );
                } else {
                  echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:80px; height:64px;'>";
                }
                ?>
              </a>
            </div>
            <div class="pull-left item-new-ct-content">
              <div class="mh-42">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <strong><?php the_title() ?></strong> </a>
              </div>

              <div class="info">
                <!--doi class--><!--									<div class="col-xs-8 no-padding">--><!--										<i class="_user"></i><span style="font-size:11px;">Đăng bởi <strong>--><?php //the_author(); ?><!--</strong></span>--><!--									</div>-->
                <div class="col-xs-4 no-padding">
                  <i class="_view"></i><span><?php echo( ajax_hits_counter_get_hits( $post->ID ) ); ?></span>
                </div>
                <!--end-->
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        <?php
        endwhile;
      endif;
      wp_reset_query();

      if ( $sopost < 5 ) {
        $sopost       = 5 - $sopost;
        $arr222       = array(
          'posts_per_page' => $sopost,
          'cat'            => $cat,
          'post__not_in'   => $postids
        );
        $the_query222 = new WP_Query( $arr222 );
        if ( $the_query222->have_posts() ) {
          while( $the_query222->have_posts() ) {
            $the_query222->the_post();
            $postids[ ] = get_the_ID();
            ?>

            <div class="post-xnt">
              <div class="pull-left img-w80">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <?php
                  if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'Category-thumb', array(
                        'class' => '',
                        'style' => 'width:80px; height:64px;',
                        'alt'   => '' . get_the_title() . ''
                      ) );
                  } else {
                    echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:80px; height:64px;'>";
                  }
                  ?>
                </a>
              </div>
              <div class="pull-left item-new-ct-content">
                <div class="mh-42">
                  <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                    <strong><?php the_title() ?></strong> </a>
                </div>

                <div class="info">
                  <!--doi class--><!--									<div class="col-xs-8 no-padding">--><!--										<i class="_user"></i><span style="font-size:11px;">Đăng bởi <strong>--><?php //the_author(); ?><!--</strong></span>--><!--									</div>-->
                  <div class="col-xs-4 no-padding">
                    <i class="_view"></i><span><?php echo( ajax_hits_counter_get_hits( $post->ID ) ); ?></span>
                  </div>
                  <!--end-->
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          <?php
          }
        }
        wp_reset_query();
      }
      ?>
    </div>
  </div>
  </div>
  <div class="clearfix"></div>
  </div>
  <div class="top-20 bottom-20"><?php cmp_ads( 'pc_cate_mid_content' ); ?></div>
  <div class="content-part-3 bottom-10 right-20">
    <h2 class="text-3 title-style-1">Các tin mới khác</h2>

    <div class="line-border bottom-10"></div>
    <div class="group-new">
      <?php
      $args2      = array(
        'posts_per_page' => 10,
        'cat'            => $cat,
        'post__not_in'   => $postids,
        'paged'          => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 )
      );
      $the_query1 = new WP_Query( $args2 );
      if ( $the_query1->have_posts() ) :
        while( $the_query1->have_posts() ) : $the_query1->the_post();
          ?>
          <div class="new-wp bottom-10">
            <div class="img-w185 pull-left">
              <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'Category-list', array(
                      'class' => '',
                      'style' => 'width:185px; height:117px;',
                      'alt'   => '' . get_the_title() . ''
                    ) );
                } else {
                  echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:185px; height:117px;'>";
                }
                ?>
              </a>
            </div>
            <div class="w525 pull-left">
              <div>
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="font-21">
                  <strong><?php the_title() ?></strong> </a>
              </div>
              <p class="top-10">
                <?php echo excerpt( 30 ); ?>
              </p>

              <div class="info">
                <div class="info col-xs-6 no-padding"><!--them xoa class-->
                  <i class="_user"></i><span>Đăng bởi <strong><?php the_author(); ?></strong></span>
                </div>
                <div class="info col-xs-6 no-padding"><!--them xoa class-->
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
                    lúc <?php echo get_the_date( "G:i" ); ?>
								</span>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        <?php
        endwhile;
      endif;
      wp_reset_query();
      ?>
    </div>
    <div class="line-border clearfix"></div>
    <div class="_pt text-center">
      <?php wp_pagenavi( array( 'query' => $the_query1 ) ); ?>
    </div>
  </div>
  <div class="content-part-4 bottom-10 right-20">
    <?php echo adrotate_ad( 8 ); ?>
  </div>
  <div class="content-part-5 bottom-10 right-20">
    <?php include( TEMPLATEPATH . '/myfiles/bi-quyet-nau-an.php' ); ?>
  </div>
  <div class="content-part-* bottom-10 right-20">
    <?php echo adrotate_ad( 6 ); ?>
  </div>
  <div class="_cttatccb bottom-10 right-20">
    <?php echo adrotate_ad( 9 ); ?>
  </div>
  </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>