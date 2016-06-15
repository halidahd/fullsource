<div class="content-part-2 bottom-20 right-10">
  <h3 class="text-3 title title-style-1">công thức nấu ăn nổi bật</h3>

  <div class="clearfix"></div>
  <div class="line-border"></div>

  <div class="_col-50-gr">
    <div class="_col-50">
      <div class="_dg">
        <i class="_dgnt"></i><a href="/cong-thuc-nau-an-duoc-danh-gia-cao-nhat">Được đánh giá nhiều nhất</a></div>
      <div class="_cdg">
        <?php
        $args      = array(
          'post_type'      => 'post',
          'posts_per_page' => 1,
          'p'              => get_most_voted_by_date( 1, strtotime( '-7 day' ) )[ 0 ],
        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) :
          while( $the_query->have_posts() ) : $the_query->the_post();
            ?>
            <div class="img-w351 bottom-10">
              <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'cong-thuc-noi-bat2', array(
                      'class' => '',
                      'style' => 'height:210px;',
                      'alt'   => get_the_title()
                    ) );
                } else {
                  echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='height:210px;'>";
                }
                ?>
              </a>
            </div>
            <div>
              <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <div class="text-2"><?php echo get_the_title(); ?></div>
              </a>

              <div class="info">
                <!--						<div class="pull-left col-xs-6 no-padding">--><!--							<i class="_user"></i><span> <em>Đăng bởi <strong>--><?php //the_author(); ?><!--</strong></em></span>--><!--						</div>-->
                <div class="pull-left col-xs-6 no-padding">
                  <i class="_view"></i><span> <em><?php echo( ajax_hits_counter_get_hits( $post->ID ) ); ?> lượt xem</em></span>
                </div>
                <div class="clearfix"></div>
              </div>
              <p class="bottom-10 font-13">
                <?php echo excerpt( 35 ); ?>
              </p>
              <a href="/cong-thuc-nau-an-duoc-danh-gia-cao-nhat">
                <div class="_top-20-ct">
                  <i class="_db pull-left"></i>
                  <label class="pull-left">Top 20 công thức<br>được đánh giá cao nhất</label>
                  <i class="_mt pull-left"></i>

                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          <?php
          endwhile;
        endif;
        wp_reset_query();
        ?>
      </div>
    </div>
    <div class="_col-50">
      <div class="_xn">
        <i class="_dnnxn"></i><a href='/cong-thuc-nau-an-nhieu-nguoi-xem'>Được nhiều người xem nhất</a>
      </div>
      <div class="top-view-content">
        <?php
        $args      = array(
          'post_type'      => 'post',
          'posts_per_page' => 5,
          'meta_key'       => 'hits',
          'orderby'        => 'meta_value_num',
          'date_query'     => array(
            array(
              'after' => '1 week ago',
            ),
          ),

        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) :
          while( $the_query->have_posts() ) : $the_query->the_post();
            ?>
            <div class="post-xnt">
              <div class="pull-left img-w80">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <?php
                  if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'Category-thumb', array(
                        'class' => '',
                        'style' => 'width:80px; height:65px;',
                        'alt'   => '' . get_the_title() . ''
                      ) );
                  } else {
                    echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:80px; height:65px;'>";
                  }
                  ?>
                </a>
              </div>
              <div class="pull-left item-new-ct-content">
                <div class="mh-42">
                  <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><strong><?php shorttitle( get_the_title(), 70 ); ?></strong></a>
                </div>

                <div class="info">
                  <!--							<div class="col-xs-8 no-padding">--><!--								<i class="_user"></i><span> <em>Đăng bởi <strong>--><?php //the_author(); ?><!--</strong></em></span>--><!--							</div>-->
                  <div class="col-xs-4 no-padding  text-right">
                    <i class="_view"></i><span> <em><?php echo( ajax_hits_counter_get_hits( $post->ID ) ); ?></em></span>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
            </div>
          <?php
          endwhile;
        endif;
        wp_reset_query();
        ?>
        <a class="view-more-2" href="/cong-thuc-nau-an-nhieu-nguoi-xem"><em>Xem thêm
            <i class="fa fa-angle-double-right"></i></em></a>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>