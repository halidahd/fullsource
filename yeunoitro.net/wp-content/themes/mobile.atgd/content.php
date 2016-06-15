<figure class="wrapper-post">

  <?php
  if ( have_posts() ) :
    $count = 0;
    while( have_posts() ) : the_post();
      $count ++;
      get_template_part( 'loop' );

      if ( $count == 3 ):
        ?>
        <aside class="box-img-ads top-10">
          <?php cmp_ads( 'mb_cate_in_content' ); ?>
        </aside>
      <?php
      elseif ( $count == 6 ):
        ?>
        <aside class="box-img-ads top-10 mb_cate_in_content_2">
          <?php cmp_ads( 'mb_cate_in_content_2' ); ?>
        </aside>
      <?php
      endif;
    endwhile;
  endif;
  ?>
  </aside>
  <?php
  $current_term_id = get_queried_object()->term_id;
  ?>
</figure><a href="#" id="<?php echo $current_term_id; ?>" class="btn-xt">Xem thêm nhiều công thức
  <span class="icon-mt"></span></a>