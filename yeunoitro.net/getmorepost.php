<?php
/**
 * Created by PhpStorm.
 * User: Seta
 * Date: 3/25/2016
 * Time: 5:48 PM
 */

$action = $_GET["action"] ? $_GET["action"] : "";

if($action == "get_more"){
  $paged = $_GET["paged"] ? $_GET["paged"] : 2;

  getMorePost( $paged );
}

function getMorePost( $paged ){
  global $wp_query,$wp;
echo "123123";
  // WP_Query arguments
  $args = array (
    'paged'                  => $paged,
    'posts_per_page'         => '10',
  );
  echo "444444";
  if( is_category() ){
    $cat_name = get_category(get_query_var('cat'))->name;
    $args['category_name'] = $cat_name;
  }
  echo "222222222";
// The Query
  $query = new WP_Query( $args );
  echo "1000000000000000000";
  ob_start();
  while ( $query->have_posts() ):
    $query->the_post();
    ?>
    <article class="post-block top-10">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <figure class="post-img w130 pull-left">
          <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'Category-list', array(
              'class' => 'img-full-width',
              'style' => 'width:130px; height:117px;'
            ) );
          }
          ?>
        </figure>
      </a>

      <div class="post-content ps-1">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3><?php the_title(); ?></h3></a>
        <div class="description font-3 top-10"><?php echo excerpt( 35 ); ?></div>
        <div class="date"><span class="icon-date"></span><span
            class="font-1 color-2"><em><?php echo show_date_category( get_the_date( 'd/m/Y' ), get_the_date( 'G:i' ) ); ?></em></span>
        </div>
        <div class="clearfix"></div>
      </div>
    </article>
  <?php
  endwhile;

  $content = ob_get_contents();
  ob_end_clean();
  wp_reset_query();
echo "123123";
  echo json_encode(array("a"=>'123'));die();
}