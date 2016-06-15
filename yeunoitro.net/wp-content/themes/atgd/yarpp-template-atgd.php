<?php
/*
YARPP Template: ATGD
Description: Nothing
Author: DMD
*/
?>
<?php
$cat = get_query_var( 'cat' );
$args = array(
  'posts_per_page' => 4,
  'cat'            => $cat,
  'orderby'        => 'rand'
  );
$the_query = new WP_Query( $args );
?>
<style>
  .yarpp-related .col-xs-3{
    padding-left: 10px;
    padding-right: 10px;
  }
  .yarpp-related img{
   width: 100%;
  }
</style>
<div class="_t1">
  <h3 class="text-3 title-style-1">Có thể bạn quan tâm</h3>

  <div class="clearfix"></div>
  <div class="line-border bottom-20"></div>
  <div class="clearfix"></div>
</div>
<div class="cl-s4">
  <?php
  if ( $the_query->have_posts() ):
    ?>
    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <div class="col-xs-3 ">
      <div class="box-img">
        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
          <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'Category-list', array(
              'alt' => get_the_title()
            ) );
          } else {
            echo "<img src='" . get_stylesheet_directory_uri() . "/images/noimage.jpg' alt='" . get_the_title() . "' style='width:165px; height:106px;'>";
          }
          ?>
        </a>
      </div>
      <div class="title-style-2">
        <a href="<?php the_permalink() ?>" title="<?php echo get_the_title(); ?>"> <strong><?php the_title() ?></strong>
        </a>
      </div>
    </div>

  <?php
  endwhile;
    ?>

  <?php else: ?>
    <p>No related photos.</p>
  <?php endif;
  wp_reset_query();
  ?>
</div>
<div class="clearfix"></div>
	