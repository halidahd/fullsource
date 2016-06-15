<?php
/**
 * The template for displaying search results pages.
 *
 * @package atgd
 */

get_header(); ?>
<div class="content-left pull-left">
  <style>
    .content-part-1 .col-xs-4, .content-part-2 .col-xs-4, .content-part-3 .col-xs-4 {
      padding: 0px;
      width: 31.333333%;
      margin-right: 23px;
    }

    .no-mr {
      margin: 0px !important;
    }
  </style>

  <div class="content-part bottom-10 right-20">
    <div class="breakumb">
      <?php if( function_exists( 'bcn_display' ) ) {
        bcn_display();
      }
      ?>
    </div>
    <h3 class="_title-herder bottom-10"><?php echo $count; ?> KẾT QUẢ CHO TỪ KHÓA <span class="color-1">"<?php echo get_search_query(); ?>"</span>
    </h3>

    <div class="pull-left">
      <div class="search-options top-20">
        <style>
          .search-options ol {
            padding-left: 20px;
          }

          .search-options ol li {
            margin-bottom: 5px;
          }
        </style>
        <?php echo adrotate_ad( 7 ); ?>
      </div>
    </div>
    <div class="pull-left">
      <div class="wrapper-content-serch">
        <div class="_t1 list-search">
          <h3 class="text-3 title-style-1">List các món ăn</h3>
          <div class="clearfix"></div>
          <div class="line-border bottom-10"></div>
        </div>
        <div class="search-content">
          <?php
          if( have_posts() ) :
            $i = 0;
          ?>
            <?php
            while(have_posts()) : the_post();
              $i++;
              if($i == 4){
                cmp_ads('pc_search_in_content');
              }
            ?>

              <?php get_template_part( 'content', 'search' ); ?>
            <?php endwhile; ?>

            <div class="line-border"></div>
            <div class="_pt text-center">
              <?php wp_pagenavi(); ?>
            </div>

          <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

          <?php endif; ?>

        </div>
      </div>
    </div>
    <div class="clearfix"></div>
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
