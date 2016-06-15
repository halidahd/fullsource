<?php get_header(); ?>
  <section class="slider">
    <style>
      .carousel-title {
        color: white;
        font-weight: bold;
        font-size: 17px;
      }
    </style>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <?php
        $postids = array();
        $args    = array(
          'posts_per_page' => 3,
          'meta_query'     => array(
            'relation' => 'AND',
            array(
//							'key'     => 'wpcf-noi-bat',
              'key'   => 'wpcf-dac-biet-1',
              'value' => 1
            ),
//						array(
//							'key'     => 'wpcf-hien-thi-tu',
//							'value'   => strtotime(current_time( 'mysql' )),
//							'compare' => '<='
//						),
//						array(
//							'key'     => 'wpcf-hien-thi-den',
//							'value'   => strtotime(current_time( 'mysql' )),
//							'compare' => '>='
//						),
          ),
          'orderby'        => 'date',
          'order'          => 'DESC'
        );

        $class = 'active';
        query_posts( $args );
        if ( have_posts() ) : while( have_posts() ) : the_post();
          $postids[ ] = get_the_ID();
          ?>
          <div class="item<?php echo ' ' . $class; ?>">
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'thumbnail', array(
                    'class' => 'img-full-width',
                    'style' => '',
                    'alt'   => '' . get_the_title() . ''
                  ) );
              } else {
                echo "<img class='img-full-width' src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "'>";
              }
              ?>
            </a>

            <div class="carousel-caption">
              <div class="carousel-title"><?php echo get_the_category()[ 0 ]->cat_name; ?></div>
              <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <p><?php echo get_the_title(); ?></p>
              </a>
            </div>
          </div>
          <?php $class = ''; ?>
        <?php
        endwhile;
        else:
        endif;
        wp_reset_query();
        ?>
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span>
      </a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  <!--tin -->
  <section class="wrapper-post-inline clearfix">
    <?php
    $args   = array(
      'posts_per_page' => 4,
//      'offset'         => 0,
      'meta_query'     => array(
        'relation' => 'AND',
        array(
          'key'   => 'wpcf-noi-bat',
          'value' => 1
        )
      ),
      'date_query'     => array(
        array(
          'after' => '1 week ago',
        ),
      ),
    );
    $sopost = 0;
    query_posts( $args );
    if ( have_posts() ) : while( have_posts() ) : the_post();
      $sopost ++;
      $postids[ ] = get_the_ID();
      ?>
      <article class="post col-xs-6 no-padding">
        <figure class="post-img bottom-10">
          <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'Category-list_mobile', array(
                  'class' => 'img-full-width',
                  'style' => '',
                  'alt'   => '' . get_the_title() . ''
                ) );
            } else {
              echo "<img class='img-full-width' src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "'>";
            }
            ?>
          </a>
        </figure>
        <div class="post-description mh60">
          <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <h3>
              <?php the_title() ?>
            </h3>
          </a>
        </div>
      </article>
    <?php
    endwhile;
    else:
    endif;
    wp_reset_query();
    if ( $sopost < 4 ) {
      $sopost       = 4 - $sopost;
      $arr222       = array(
        'posts_per_page' => $sopost,
        'post__not_in'   => $postids
      );
      $the_query222 = new WP_Query( $arr222 );
      if ( $the_query222->have_posts() ) {
        while( $the_query222->have_posts() ) {
          $the_query222->the_post();
          ?>
          <article class="post col-xs-6 no-padding">
            <figure class="post-img bottom-10">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'Category-list_mobile', array(
                    'class' => 'img-full-width',
                    'alt'   => '' . get_the_title() . ''
                  ) );
              } else {
                echo "<img class='img-full-width' src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "'>";
              }
              ?>
            </figure>
            <div class="post-description mh60">
              <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <h3>
                  <?php the_title() ?>
                </h3>
              </a>
            </div>
          </article>
        <?php
        }
      }
      wp_reset_query();
    }
    ?>
  </section>

<?php cmp_ads( 'sp_home_mid_content' ); ?>

  <!--CÔNG THỨC MỚI NHẤT Sidebar-Home-->
  <section class="formula-top-one">
    <div class="ts1">
      <h2>công thức mới nhất</h2>

      <div class="clearfix"></div>
    </div>
    <aside class="wrapper-post">

      <?php $query_opts = apply_filters( 'wpzoom_query', array(
        'posts_per_page' => 10,
        'post_type'      => 'post',
      ) );

      query_posts( $query_opts );
      if ( have_posts() ) :
        get_template_part( 'loop-index' );
      endif;
      wp_reset_query();
      ?>
    </aside>
    <a href="#" id="ctm" class="btn-xt">Xem thêm nhiều công thức <span class="icon-mt"></span></a>
  </section>
  <aside class="box-img-ads left-left-10 top-10">
    <figure>
      <?php cmp_ads( 'mb_cate_bottom_content' ); ?>
    </figure>
  </aside>

<?php get_sidebar(); ?>

<?php get_footer(); ?>