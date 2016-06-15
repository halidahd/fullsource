<?php
/**
 * @package atgd
 */
?>

<div class="content-part bottom-10 right-20">
  <div class="breakumb">
    <?php if( function_exists( 'bcn_display' ) ) {
      bcn_display();
    }
    ?>
  </div>
  <div class="pw" itemscope itemtype="http://schema.org/Recipe">
    <h1 itemprop="name" class="_title-herder">
      <?php the_title(); ?>
    </h1>

    <div class="post-group-info">
      <div class="info info-user pull-left" title="Yêu nội trợ">
        <i class="_user"></i><span itemprop="author" itemscope itemtype="http://schema.org/Person"> <em>Đăng bởi:
            <strong><span itemprop="name">Yêu nội trợ</span></strong></em></span>
      </div>
      <div class="info pull-left">
        <i class="_user-2"></i><span><?php echo get_post_meta( $post->ID, 'so-nguoi', true ); ?> người ăn</span>
      </div>
      <div class="info pull-left">
        <i class="_clock"></i><span><time datetime="PT<?php echo get_post_meta( $post->ID, 'thoi-gian', true ); ?>M" itemprop="totalTime"><?php echo get_post_meta( $post->ID, 'thoi-gian', true ); ?></time></span>
      </div>
      <div class="info pull-right"><!--đổi pull-left thành pull-right -->
        <i class="_time"></i><span> <em>Đăng lúc <strong>
              <time datetime="<?php echo get_the_date( "d-m-Y" ); ?>" itemprop="datePublished"><?php echo get_the_date( "d/m/Y" ); ?></time>
            </strong> trong <strong>
              <?php
              $category = get_the_category();
              if( $category[0] ) {
                echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
              }
              ?>    </strong></em></span>
      </div>
      <div class="clearfix"></div>
    </div>

    <div class="line-border bottom-10"></div>
    <div class="group-fb">
      <div class="no-padding pull-right">
        <div class="pull-left">
          <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
          <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="true"></div>
        </div>
        <div class="pull-left left-10">
          <div class="g-plusone" data-size="medium" data-annotation="none"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-6 no-padding text-right atgd-like">
        <!--			--><?php // echo do_shortcode('[wp-review]') ?>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

    <div class="posts-content">
      <?php the_content(); ?>
    </div>
    <div class="like-share-bt top-20">
      Các bạn nhớ ủng hộ các công thức ngon từ Ẩm Thực Gia Đình bằng cách Like hoặc giới thiệu cho bạn bè nhé!
    </div>
    <style>
      ._mt {
        margin-top: -100px;
      }

      ._fb {
        margin-top: 30px;
        display: inline-block;
      }

      .navigation {
        display: none;
      }
    </style>
    <div class="text-center">
      <img class="_mt" src="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/images/mui-ten-dm.png'; ?>">
		<span class="_fb">
			<div class="pull-left">
        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="true"></div>
      </div>
			<div class="pull-left left-10">
        <div class="g-plusone" data-size="medium" data-annotation="none"></div>
      </div>
<!--			<div class="pull-left left-10">-->
<!--				--><?php //echo do_shortcode('[wp-review]') ?>
      <!--			</div>-->
			<div class="clearfix"></div>
		</span>
    </div>
    <?php cmp_ads( 'pc_detail_bottom_content' ); ?>
  </div>
</div>
<div class="content-part-1 bottom-10 right-20">
  <style>
    .content-part-1 .col-md-3 {
      padding: 0px;
      width: 165px;
      margin-right: 20px;
    }

    .cl-s4 .col-md-3:last-child {
      margin-right: 0px;
    }

    .cl-s4 .col-md-3 img {
      width: 100%;
    }
  </style>

  <h3 class="text-3 title-style-1" style="margin-top: 10px;"></h3>
  <div class="fb-comments" data-width="700" xid="<?php the_ID(); ?>" data-href="<?php the_permalink(); ?>" data-order-by="social" data-numposts="10" data-colorscheme="light"></div>
  	<?php related_posts(); ?>
  <!-- Ads dưới khối bài viết liên quan  pc_detail_bottom_content2 -->
  <?php cmp_ads( 'pc_detail_bottom_content2' ); ?>
<!-- End Ads pc_detail_bottom_content2 -->
  <div class="clearfix bottom-10"></div>
  <div class="tags">
    <?php the_tags( "<ul class='list-unstyled list-inline'><li class='tags-title color-1'><strong>Xem thêm chủ đề: </strong></li><li>", "</li><li>", "</li></ul>" ); ?>
  </div>
</div>

<!--CÔNG THỨC NẤU ĂN THEO NGUYÊN LIỆU-->
<!--<div class="content-part-* bottom-10 right-20">-->
<!--  --><?php //echo adrotate_ad( 6 ); ?>
<!--</div>-->

<!--CÔNG THỨC NẤU ĂN THEO CÁCH CHẾ BIẾN-->
<!--<div class="_cttatccb bottom-10 right-20">-->
<!--  --><?php //echo adrotate_ad( 9 ); ?>
<!--</div>-->
<div class="boxComment-post up">
  <div class="popover fade top in tooltip-hide" role="tooltip">
    <div class="arrow"></div>
    <div class="popover-content text-center">Bình luận về công thức này?</div>
    <!--		<div class="popover-content text-center">Đăng ký nhận tin công thức nấu ăn từ Yêu nội trợ .Net</div>-->
  </div>
  <div class="boxComment-header">
    <div class="col-xs-11 boxComment-title">
      Bình luận về công thức <?php the_title(); ?>
      <!--			Đăng ký nhận công thức nấu ăn-->
    </div>
    <div class="pull-left boxComment-Controller">
      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="boxComment-body">
    <?php
    // If comments are open or we have at least one comment, load up the comment template
    //if ( comments_open() || get_comments_number() ) :
    //	comments_template();
    //endif;
    //		if ( comments_open()) {
    ?>
    <div style="width:300px" class="fb-comments" data-width="270" xid="<?php the_ID(); ?>" data-href="<?php the_permalink(); ?>" data-order-by="social" data-numposts="3" data-colorscheme="light"></div>
    <?php

    //		}
    //				comments_template();
    ?>
  </div>
</div>
<script type="text/javascript">
  $( document ).ready( function() {
    if( localStorage.myVariable != 1 ) {
      var openBox = setInterval( function() {
        localStorage.boxComment = 1;
        $( '.boxComment-post' ).addClass( 'show' );
        clearInterval( openBox );
      }, 10000 );
    }
    $( ".boxComment-header" ).click( function() {
      $( ".boxComment-post" ).toggleClass( "down up" );
      clearInterval( openBox );
    } )
  } )
</script>

<script>
  var $ = jQuery.noConflict();

  $( document ).ready( function() {
    $( '.icon-search' ).click( function() {
      $( '.box-search' ).slideToggle( '300' );
    } );

    $( '.btn-reg-news-single' ).click( function() {
      var regex = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
      var email = $( this ).parent().find( '.txt-email' ).val();

      if( email == '' ) {
        alert( 'Vui lòng nhập email!' );
        return false;
      }
      if( !regex.test( email ) ) {
        alert( 'Email không đúng định dạng! ' );
        return false;
      }

      var url = $( '.frm-reg-news' ).attr( 'action' );
      var format = $( '.reg-news .format' ).val();

      var postdata = { email : email, format : format };

      $.ajax( {
        type : 'POST',
        url : url,
        data : postdata,
        success : function( response ) {

        }
      } );
      alert( 'Cảm ơn! Bạn đã đăng ký nhận tin thành công!' );
      $( '.reg-news .txt-email' ).val( '' );
      return;
    } )
  } )
</script><!--BLUESEED ADSERVING DO NOT MODIFY  --><!--<script src="http://wac.A164.edgecastcdn.net/80A164/blueseed-cdn/files-blueseed/templates/26/67/jwplayer.js" type="text/javascript"></script>--><!--<script type="text/javascript">--><!--	var div_adcontent = 'bscontainer';--><!--	var div_player = 'bsplayer';--><!--	var v_height = '360';--><!--	var v_width = '100%';--><!--	var div_maincontains = 'posts-content';--><!--	var rule = 'p';--><!--	var rule_show_before = 4;--><!--	var bs_mode = 'auto' // 'auto', 'manual'--><!--	var timestamp = new Date().getTime();--><!--	var tag = "http://blueserving.com/vast.xml?key=185002fdd7503a0e971dc166f77e40bd&r=" + timestamp;--><!--</script>--><!--<script type="text/javascript" src="http://lab.blueserving.com/libs/bs-inread-v1.1.js"></script>--><!-- END BLUESEED ADSERVING -->