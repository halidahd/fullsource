<div class="content-part-1 bottom-20">
  <div class="content-menu-left menu-left-part-1 pull-left">
    <?php
    wp_nav_menu( array(
      'menu'       => 'menu-trang-chu',
      'menu_class' => 'list-unstyled font-style-1 sub-menu'
    ) );
    ?>
  </div>
  <script type="text/javascript">
    $( document ).ready( function() {
      $( '.sub-menu li' ).hover( function() {
        $( this ).addClass( 'active' );
      }, function() {
        $( this ).removeClass( 'active' );
      } );
      $( '._khna ul> li > a ' ).hover( function() {
        $( '._khna > a' ).addClass( 'color-1' );
      }, function() {
        $( '._khna > a' ).removeClass( 'color-1' );
      } );
    } );
  </script>
  <div class="new-hot pull-left">
    <div class="img-new-hot text-center">
      <?php include( TEMPLATEPATH . '/myfiles/slider.php' ); ?>
    </div>
    <div class="top-new">
      <h3 class="new-title"><i class="_icon-new-hot"></i> Công thức nấu ăn nổi bật</h3>

      <div class="new-content">
        <div class="box-new">
          <?php
          $postids   = array();
          $args      = array(
            'posts_per_page' => 1,
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
          $the_query = new WP_Query( $args );

          if ( $the_query->post_count == 0 ) {
            $the_query = new WP_Query( 'posts_per_page=1' );
          }

          if ( $the_query->have_posts() ) :
            while( $the_query->have_posts() ) : $the_query->the_post();
              $postids[ ] = get_the_ID();
              ?>
              <div class="box-new-img pull-left">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <?php
                  if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'cong-thuc-noi-bat1', array(
                        'alt'   => '' . get_the_title() . ''
                      ) );
                  } else {
                    echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:87px; height:87px;'>";
                  }
                  ?>
                </a>
              </div>
              <div class="box-content pull-left">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <div class="text-2"><?php the_title() ?></div>
                </a>

                <div class="text-help font-13">
                  <?php echo excerpt( 35 ); ?>
                </div>
              </div>
            <?php
            endwhile;
          endif;
          wp_reset_query();
          ?>
          <div class="new-old font-style-1">
            <ul class="col-xs-12">
              <?php
              $args      = array(
                'posts_per_page' => 4,
                'offset'         => 1,
                'meta_query'     => array(
                  'relation' => 'AND',
                  array(
                    'key'   => 'wpcf-noi-bat',
                    'value' => '1',
                  ),
//										array(
//											'key'     => 'wpcf-hien-thi-tu',
//											'value'   => strtotime(current_time( 'mysql' )),
//											'compare' => '<='
//										),
//										array(
//											'key'     => 'wpcf-hien-thi-den',
//											'value'   => strtotime(current_time( 'mysql' )),
//											'compare' => '>='
//										),
                ),
                'date_query'     => array(
                  array(
                    'after' => '1 week ago',
                  ),
                ),
              );
              $sopost    = 0;
              $the_query = new WP_Query( $args );
              if ( $the_query->have_posts() ) :
                while( $the_query->have_posts() ) : $the_query->the_post();
                  $sopost ++;
                  $postids[ ] = get_the_ID();
                  ?>
                  <li>
                    <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php the_title() ?></a>
                  </li>
                <?php
                endwhile;
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
                    <li>
                      <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php the_title() ?></a>
                    </li>
                  <?php
                  }
                }
                wp_reset_query();
              }
              ?>
            </ul>
          </div>

          <a class="view-more pull-right" href="/cong-thuc-nau-an-noi-bat"><em>Xem thêm
              <i class="fa fa-angle-double-right"></i></em></a>

          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
	