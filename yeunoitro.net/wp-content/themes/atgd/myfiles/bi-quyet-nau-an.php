<div class="_t1 top-15"><!--add class top-15-->
    <h3 class="text-3 title-style-1"><a href="/bi-quyet-nau-an" title="bí quyết nấu ăn">bí quyết nấu ăn</a></h3>
    <div class="clearfix"></div>
    <div class="line-border bottom-10"></div>
    <div class="clearfix"></div>
</div>

<!-- sửa bottom-30 thanh bottom-10 add class top-15 -->
<div class="clearfix bottom-10">
    <?php
        $args = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'cat' => 1314
        );
        $the_query = new WP_Query( $args );
        if ($the_query -> have_posts() ) :
        while ($the_query -> have_posts() ) : $the_query -> the_post(); 
    ?>
    <div class="pull-left">
        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">
        <img src="<?php echo get_template_directory_uri() ;?>/images/img_15.png" alt="" title="">
        </a>
    </div>
    <div class="col-xs-10">
        <h3 class="text-2"><a href=""><strong>
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">
                <?php the_title() ?>
            </a>
        </strong></a></h3>

        <p class="top-10">
            <?php the_excerpt(); ?>
        </p>
    </div>
    <?php
        endwhile;
        endif; 
        wp_reset_query();
    ?>  
</div>
<style>
    .col-xs-4 ol li {
        margin-bottom: 10px;
    }
</style>
<!--bỏ div class col-xs-4 -->
<div class="col-xs-12 no-padding">
    <ul class="list-inline-2 list-unstyled">
        <?php
            $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'cat' => 1314,
            'offset' => 1
            );
            $the_query = new WP_Query( $args );
            if ($the_query -> have_posts() ) :
            while ($the_query -> have_posts() ) : $the_query -> the_post(); 
        ?>
        <li>
            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">
                <span class="glyphicon glyphicon-play pull-left" aria-hidden="true"></span>
                <p>                    
                    <?php the_title() ?>
                </p>
            </a>
        </li>    
        <?php
            endwhile;
            endif; 
            wp_reset_query();
        ?>  
    </ul>
</div>
<div class="clearfix bottom-10"></div>
<!-- Thêm class img-w227 boder-radius-5 -->
<!--<a class="view-more-2 img-w227 border-radius-5" href="--><?php //echo get_category_link(1314); ?><!--"><em>Xem thêm »</em></a>-->

