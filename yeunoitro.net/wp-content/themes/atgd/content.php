<?php
/**
 * @package atgd
 */
?>


<style>
  .content-part-1 .col-xs-4, .content-part-2 .col-xs-4, .content-part-3 .col-xs-4 {
    padding: 0px;
    width: 31.333333%;
    margin-right: 23px;
  }

  .no-mr {
    margin: 0px !important;
  }

  ._mtdl {
    position: relative;
  }

  ._mtdl img {
    position: absolute;
    left: -27px;
    top: -33px;
  }
</style>

<div class="content-part bottom-10 right-20 clearfix">
  <div class="breakumb">
    <?php if ( function_exists( 'bcn_display' ) ) {
      bcn_display();
    }
    ?>
  </div>

  <h1 class="_title-herder bottom-10">
    <?php get_meta_key_title_psp();//single_cat_title(); ?>
  </h1>

  <div class="_mtdl"><img src="<?php echo get_template_directory_uri(); ?>/images/mui-ten-dm.png" alt="" title=""></div>
  <p class="dm_description bottom-10">
    <?php
    $des = str_replace( "<p>", "", get_the_archive_description() );
    $des = str_replace( "</p>", "", $des );
    echo $des;
    ?>
  </p>

  <div class="_t1 col-xs-6 _cmamn">
    <h2 class="text-3 title-style-1">các món ăn mới nhất</h2>

    <div class="clearfix"></div>
    <?php
    if ( have_posts() ) :
      while( have_posts() ) : the_post();
        ?>
        <div class="line-border"></div>
        <div class="clearfix"></div>
        <div class="style-list-1">
          <div class="pull-left">
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'thumbnail', array(
                    'class' => '',
                    'style' => 'width:142px; height:101px;',
                    'alt'   => '' . get_the_title() . ''
                  ) );
              } else {
                echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:142px; height:101px;'>";
              }
              ?>
            </a>
          </div>
          <div class="pull-left left-10 style-list-1-content">
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><strong><?php the_title(); ?></strong></a>

            <p>
              <?php echo excerpt( 15 ); ?>
            </p>
          </div>
          <div class="clearfix"></div>
          <div class="group-info top-10">
            <div class="info pull-left col-xs-4 no-padding">
              <i class="_user-2"></i><span> <?php echo get_post_meta( $post->ID, 'so-nguoi', true ); ?> người ăn</span>
            </div>
            <!--đổi col-xs-4 thành col-xs-2 -->
            <div class="info pull-left col-xs-2 no-padding">
              <i class="_clock"></i><span> <?php echo get_post_meta( $post->ID, 'thoi-gian', true ); ?></span>
            </div>
            <!--đổi col-xs-4 thành col-xs-6 -->
            <div class="info pull-left col-xs-6 no-padding">
              <i class="_time"></i><span>
							<?php
              $date_created = explode( '/', get_the_date( "d/m/Y" ) );

              $day = $date_created[ 0 ];
              $month = $date_created[ 1 ];
              $year = $date_created[ 2 ];

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
          </div>
        </div>
      <?php endwhile; endif; // end of the loop. ?>
    <div class="line-border clearfix"></div>
  </div>
  <div class="col-xs-6 bg-green _ctnanb bottom-10">
    <h2 class="text-center text-3" style="color:white; padding:0px; margin:0px;">
      công thức nấu ăn nổi bật
      <div class="line-border"></div>
    </h2>
    <?php
    $qobj = get_queried_object();

    $listids = get_hot_list_post( $qobj );

    $arr = array(
      'posts_per_page' => 10,
      'post__in'       => $listids,
      'orderby'        => 'post__in'
    );

    $the_query = new WP_Query( $arr );

    if ( $the_query->have_posts() ) :
      while( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="style-list-1">
          <div class="pull-left">
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'thumbnail', array(
                    'class' => '',
                    'style' => 'width:108px; height:77px;',
                    'alt'   => '' . get_the_title() . ''
                  ) );
              } else {
                echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:108px; height:77px;'>";
              }
              ?>
            </a>
          </div>
          <div class="pull-left left-10 style-list-1-content">
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><strong><?php shorttitle( get_the_title(), 50 ) ?></strong></a>

            <div class="group-info top-10">
              <div class="info pull-left" title="<?php the_author(); ?>">
                <i class="_user-w"></i><span> <em><?php echo get_the_author(); ?></em></span>
              </div>
              <div class="info pull-left left-10">
                <i class="_like-w"></i><span> <em><?php echo get_total_reviews( get_the_ID() ); ?></em></span>
              </div>
              <div class="clearfix"></div>
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
</div>
<div class="_pt text-center">
  <?php wp_pagenavi(); ?>
</div>
<div class="top-20 bottom-20">
  <?php if ( is_tag() ) {
    cmp_ads( 'pc_tag_mid_content' );
  } else if ( is_category() ) {
    cmd_ads( 'pc_cate_mid_content' );
  } else {
    cmp_ads( 'pc_series_mid_content' );
  } ?>
</div>
<div class="content-part-5 bottom-10 right-20">
  <?php include( TEMPLATEPATH . '/myfiles/bi-quyet-nau-an.php' ); ?>
</div>

<div class="content-part-* bottom-10 right-20">
  <?php echo adrotate_ad( 6 ); ?>
</div>

<div class="_cttatccb bottom-10 right-20">
  <!--	--><?php //echo adrotate_ad(9); ?>
</div>
<div class="_cttatccb bottom-10 right-20">
  <!--	--><?php //echo adrotate_ad(11); ?>
</div>