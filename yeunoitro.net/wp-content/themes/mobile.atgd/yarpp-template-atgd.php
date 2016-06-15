<?php
/*
YARPP Template: ATGD
Description: Nothing
Author: DMD
*/ ?>
<?php
$cat = get_query_var( 'cat' );
$args = array(
  'posts_per_page' => 2,
  'cat'            => $cat,
  'orderby'        => 'rand'
);
$the_query = new WP_Query( $args );
?>
<style>
  /*.post .post-img{*/
    /*max-height: 135px;*/
    /*overflow: hidden;*/
  /*}*/
</style>
<section class="wrapper-post-inline clearfix">
  <div class="ts1 bottom-20">
    <h3>Có thể bạn quan tâm</h3>
    <div class="clearfix"></div>
  </div>
  <?php
  if ($the_query->have_posts()):
    ?>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

    <article class="post related-post col-xs-6 no-padding">
      <figure class="post-img bottom-10">
        <?php
        if ( has_post_thumbnail() ) {
          the_post_thumbnail('thumbnail', array('class' => 'Category-list', 'style' => 'width: 100%; height: 135px;', 'alt' => ''.get_the_title().''));
        }
        else {
          echo "<img class='img-full-width' src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style=''>";
        }
        ?>
      </figure>
      <div class="post-description">
        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">
          <h4>
            <?php the_title() ?>
          </h4>
        </a>
      </div>
    </article>
  <?php
  endwhile;
    ?>
  <?php else: ?>
    <p><?php __( 'Không có nội dung phù hợp.', 'atgd' ); ?></p>
  <?php endif; ?>
</section>
	