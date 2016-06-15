<div class="content-part-4 bottom-10 right-10">
  <h3 class="text-3 title title-style-1">Các loại thực đơn</h3>

  <div class="clearfix"></div>
  <div class="line-border"></div>

  <div class="_col-50-gr">

    <?php
    $args       = array(
      'child_of' => constant( "id_thuc_don" ),
      'orderby'  => 'name',
      'number'   => constant( "so_cm_hien_thi" )
    );
    $categories = get_categories( $args );
    $check      = 1;
    foreach ($categories as $category) {
    ?>

    <div class="_col-50">
      <div class="_dg">
        <a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>">
          <?php echo get_field( 'category-icon', 'category_' . $category->cat_ID ); ?>
          <?php echo $category->name; ?>
        </a>
      </div>

      <?php
      $args      = array(
        'post_type'      => 'post',
        'posts_per_page' => 1,
        'cat'            => $category->cat_ID,

      );
      $the_query = new WP_Query( $args );
      if ($the_query->have_posts()) :
      while ($the_query->have_posts()) :
      $the_query->the_post();
      ?>

      <?php
      if ( $check % 2 == 1 ) {
        echo "<div class='_cdg'>";
      } else {
        echo "<div style='padding:10px 0px 0px 10px'>";
      }
      ?>
      <div class="box-img text-center bottom-10 pull-left">
        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
          <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'thuc-don', array(
                'class' => '',
                'style' => 'width:165px; height:123px;',
                'alt'   => '' . get_the_title() . ''
              ) );
          } else {
            echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:165px; height:123px;'>";
          }
          ?>
        </a>
      </div>
      <div class="pull-left _tdnhn-ct">
        <div>
          <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <strong><?php shorttitle( get_the_title(), 45 ) ?></strong> </a>
        </div>
        <div class="group-info">
          <div class="info pull-left">
            <i class="_user-2"></i><span> <em><?php echo get_post_meta( $post->ID, 'so-nguoi', true ); ?> người ăn</em></span>
          </div>
          <div class="info pull-left left-10">
            <i class="_clock"></i><span> <em><?php echo get_post_meta( $post->ID, 'thoi-gian', true ); ?> phút</em></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <p>
          <?php echo excerpt( 15 ); ?>
        </p>
      </div>
      <div class="clearfix"></div>
      <?php echo get_field( 'cat_dac_biet', 'category_' . $category->cat_ID ); ?>

    </div>
  <?php
  endwhile;
  endif;
  wp_reset_query();
  ?>
  </div>

  <?php
  $check ++;
  }
  ?>
</div>

<div class="clearfix"></div>

</div>
	