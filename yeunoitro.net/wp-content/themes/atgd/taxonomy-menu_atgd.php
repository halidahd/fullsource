<?php
/**
 * The template for displaying all single posts.
 * Template Name: menu_atgd taxonomy
 * @package atgd
 */
get_header(); ?>

<?php 
    $slug = $wp_query->queried_object->slug;

    $cat_id = get_category_by_slug($slug)->term_id;

	$category = get_category($cat_id);
?>

	<div class="content-left pull-left">	
			<style>
                .content-part-1 .col-md-4, .content-part-2 .col-md-4, .content-part-3 .col-md-4 {
                    padding: 0px;
                    width: 31.48%;
                    margin-right: 20px;
                }

                .cl-s3 .col-md-4:last-child {
                    margin-right: 0px;
                }

                .content-part-1 .col-md-4 img, .content-part-2 .col-md-4 img, .content-part-3 .col-md-4 img {
                    width: 100%;
                }

                ._mtdl {
                    position: relative;
                }

                ._mtdl img {
                    position: absolute;
                    left: -27px;
                    top: -33px;
                }
            </style>
            <div class="content-part-1 bottom-20 right-20">
                <div class="breakumb">
                    <a href="/">Trang chủ <i class="fa fa-angle-double-right"></i></a>
					<span><?php echo $category->name; ?></span>
                </div>
                <h1 class="_title-herder bottom-20"><?php get_meta_key_title_psp();//single_cat_title(); ?></h1>
                <div class="_mtdl"><img src="<?php echo get_template_directory_uri() ;?>/images/mui-ten-dm.png" alt="" title=""></div>	
                <div class="dm_description bottom-20">
                    <?php echo $category->description; ?>
                </div>
                <div class="_t1">
                    <h3 class="text-3 title-style-1">công thức nấu ăn nổi bật</h3>
                    <div class="clearfix"></div>
                    <div class="line-border bottom-20"></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="cl-s3">
                <?php
					$arr = array(
					  'posts_per_page' => 3,
					  'meta_key' => 'wpcf-noi-bat',
					  'meta_value' => 1,
					  'cat' => $cat_id
					);
					
					$the_query = new WP_Query($arr);	
					if ($the_query->have_posts() ) :
					while ($the_query->have_posts() ) : $the_query->the_post();
                ?>
                <div class="col-md-4">                
                    <div class="box-img">
                        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">                    
                            <?php 
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'thumbnail', array('class' => '', 'style' => 'width:227px; height:146px;', 'alt' => ''.get_the_title().'')); 
                                }
                                else {
                                    echo "<img src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style='width:227px; height:146px;'>";
                                }
                            ?> 
                        </a>
                    </div>
                    <div class="title-style-2">
                        <a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><strong><?php the_title() ?></strong></a>
                    </div>
                    <div class="text-description bottom-10 font-13">
                        <p class="font-13">
                            Hôm nay, mình sẽ hướng dẫn bạn cách làm gỏi chân gà rút xương đơn giản mà cực kỳ thơm ngon...
                        </p>
                    </div>
                    <div class="group-info">
<!--                        <div class="info pull-left no-pdt">-->
<!--                            <i class="_user"></i><span> Đăng bởi --><?php //the_author(); ?><!--</span>-->
<!--                        </div>-->
                        <div class="line-border"></div>
                        <div class="info pull-left">
                            <i class="_view"></i><span> <?php echo get_post_meta($post->ID, 'views', true); ?></span>
                        </div>
                        <div class="info pull-right left-20">
                            <i class="_time"></i><span> 
                                <?php                                           
                                    $date_created = explode('/',get_the_date("d/m/Y"));
                                    
                                    $day = $date_created[0];
                                    $month = $date_created[1];
                                    $year = $date_created[2];                                           
                                    
                                    $strday =  $day . "/" . $month . "/" . $year;
                                    
                                    $today = getdate();
                                    if($today["year"] == $year) {
                                        if($today["mon"] == $month) {
                                            if($today["mday"] == $day) {
                                                echo "Hôm nay";
                                            }
                                            elseif(($today["mday"] - 1) == $day) {
                                                echo "Hôm qua";
                                            }
                                            else {
                                                echo $strday;
                                            }
                                        }
                                        else {
                                            echo $strday;
                                        }
                                    }
                                    else {
                                        echo $strday;
                                    }                                           
                                ?> 
                                lúc <?php echo get_the_date("G:i"); ?>
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php
					endwhile;
					endif; 
					wp_reset_query();
				?>	
                </div>
                <!--thêm class clearfix vào div clearfix-->
                <div class="clearfix bottom-20"></div>
                <style>
                    ._top-20-ct label {
                        width: 379px;
                        line-height: 61px;
                        text-transform: uppercase;
                        cursor: pointer;
                    }

                    ._top-20-ct {
                        margin: auto;
                        display: block;
                        width: 505px;
                        margin-top: 20px;
                        padding: 1px 15px;
                    }
                </style>
                <div class="bottom-20"><!--add class bottom-20-->
                    <a href="/danh-gia-nhieu">
                        <div class="_top-20-ct top-10">
                            <i class="_db pull-left"></i>
                            <label class="pull-left">Top 20 công thức được đánh giá cao nhất</label>
                            <i class="_mt pull-left"></i>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="content-part-2 bottom-20 right-20">
                <div class="_t1">
                    <h2 class="text-3 title-style-1">công thức nấu ăn mới nhất</h2>
                    <div class="clearfix"></div>
                    <div class="line-border bottom-20"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="cl-s3">
                <?php
					$arr = array(
					  'posts_per_page' => 3,
					  'cat' => $cat_id
					);
					
					$the_query = new WP_Query($arr);
					                    
					if ($the_query->have_posts() ) :
					while ($the_query->have_posts() ) : $the_query->the_post();
                ?>
                <div class="col-md-4">                
                    <div class="box-img">
                        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">                    
                            <?php 
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'thumbnail', array('class' => '', 'style' => 'width:227px; height:146px;', 'alt' => ''.get_the_title().'')); 
                                }
                                else {
                                    echo "<img src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style='width:227px; height:146px;'>";
                                }
                            ?> 
                        </a>
                    </div>
                    <div class="title-style-2">
                        <a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><strong><?php the_title() ?></strong></a>
                    </div>
                    <div class="text-description bottom-10 font-13">
                        <p class="font-13">
                            Hôm nay, mình sẽ hướng dẫn bạn cách làm gỏi chân gà rút xương đơn giản mà cực kỳ thơm ngon...
                        </p>
                    </div>
                    <div class="group-info">
<!--                        <div class="info pull-left no-pdt">-->
<!--                            <i class="_user"></i><span> Đăng bởi --><?php //the_author(); ?><!--</span>-->
<!--                        </div>-->
                        <div class="line-border"></div>
                        <div class="info pull-left">
                            <i class="_view"></i><span> <?php echo get_post_meta($post->ID, 'views', true); ?></span>
                        </div>
                        <div class="info pull-right left-20">
                            <i class="_time"></i><span> 
                                <?php                                           
                                    $date_created = explode('/',get_the_date("d/m/Y"));
                                    
                                    $day = $date_created[0];
                                    $month = $date_created[1];
                                    $year = $date_created[2];                                           
                                    
                                    $strday =  $day . "/" . $month . "/" . $year;
                                    
                                    $today = getdate();
                                    if($today["year"] == $year) {
                                        if($today["mon"] == $month) {
                                            if($today["mday"] == $day) {
                                                echo "Hôm nay";
                                            }
                                            elseif(($today["mday"] - 1) == $day) {
                                                echo "Hôm qua";
                                            }
                                            else {
                                                echo $strday;
                                            }
                                        }
                                        else {
                                            echo $strday;
                                        }
                                    }
                                    else {
                                        echo $strday;
                                    }                                           
                                ?> 
                                lúc <?php echo get_the_date("G:i"); ?>
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php
					endwhile;
					endif; 
					wp_reset_query();
				?>	
                </div>
                <div class="clearfix bottom-10"></div>
                <!-- Thêm class img-w227 boder-radius-5 -->
                <a class="view-more-2 img-w227 border-radius-5" href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>">Xem thêm »</a>
            </div>
            <div class="content-part-3 bottom-20 right-20">
                <div class="_t1">
                    <h2 class="text-3 title-style-1">công thức nấu ăn được nhiều người chú ý</h2>
                    <div class="clearfix"></div>
                    <div class="line-border bottom-20"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="cl-s3">
                <?php
					$arr = array(
					  'posts_per_page' => 3,
                      'v_sortby' => 'views',
					  'v_orderby' => 'desc',
					  'cat' => $cat_id					  
					);
					
					$the_query = new WP_Query($arr);
					                    
					if ($the_query->have_posts() ) :
					while ($the_query->have_posts() ) : $the_query->the_post();
                ?>
                <div class="col-md-4">                
                    <div class="box-img">
                        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">                    
                            <?php 
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'thumbnail', array('class' => '', 'style' => 'width:227px; height:146px;', 'alt' => ''.get_the_title().'')); 
                                }
                                else {
                                    echo "<img src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style='width:227px; height:146px;'>";
                                }
                            ?> 
                        </a>
                    </div>
                    <div class="title-style-2">
                        <a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><strong><?php the_title() ?></strong></a>
                    </div>
                    <div class="text-description bottom-10 font-13">
                        <p class="font-13">
                            Hôm nay, mình sẽ hướng dẫn bạn cách làm gỏi chân gà rút xương đơn giản mà cực kỳ thơm ngon...
                        </p>
                    </div>
                    <div class="group-info">
<!--                        <div class="info pull-left no-pdt">-->
<!--                            <i class="_user"></i><span> Đăng bởi --><?php //the_author(); ?><!--</span>-->
<!--                        </div>-->
                        <div class="line-border"></div>
                        <div class="info pull-left">
                            <i class="_view"></i><span> <?php echo get_post_meta($post->ID, 'views', true); ?></span>
                        </div>
                        <div class="info pull-right left-20">
                            <i class="_time"></i><span> 
                                <?php                                           
                                    $date_created = explode('/',get_the_date("d/m/Y"));
                                    
                                    $day = $date_created[0];
                                    $month = $date_created[1];
                                    $year = $date_created[2];                                           
                                    
                                    $strday =  $day . "/" . $month . "/" . $year;
                                    
                                    $today = getdate();
                                    if($today["year"] == $year) {
                                        if($today["mon"] == $month) {
                                            if($today["mday"] == $day) {
                                                echo "Hôm nay";
                                            }
                                            elseif(($today["mday"] - 1) == $day) {
                                                echo "Hôm qua";
                                            }
                                            else {
                                                echo $strday;
                                            }
                                        }
                                        else {
                                            echo $strday;
                                        }
                                    }
                                    else {
                                        echo $strday;
                                    }                                           
                                ?> 
                                lúc <?php echo get_the_date("G:i"); ?>
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php
					endwhile;
					endif; 
					wp_reset_query();
				?>	
                </div>
                <div class="clearfix bottom-10"></div>
                <!-- Thêm class img-w227 boder-radius-5 -->                
                <a class="view-more-2 img-w227 border-radius-5" href="/xem-nhieu">Xem thêm »</a>
            </div>
            <div class="content-part-4 bottom-20 right-20">
                <?php echo adrotate_ad(8); ?>
            </div>
            <div class="content-part-5 bottom-20 right-20">
                <?php include (TEMPLATEPATH . '/myfiles/bi-quyet-nau-an.php'); ?>           
            </div>
            <div class="content-part-* bottom-20 right-20">
                <?php echo adrotate_ad(6); ?>
            </div>

    </div>

<?php get_sidebar("child"); ?>
<?php get_footer(); ?>