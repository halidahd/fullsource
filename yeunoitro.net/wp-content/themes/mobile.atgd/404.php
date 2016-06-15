<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package atgd
 */

get_header(); ?>

	<div class="content-left pull-left">	
        <div class="text-center top-20 bottom-40">
            <img src="<?php echo get_template_directory_uri() ;?>/images/404-img.png" alt="404 Not found" title="404 Not found" style="width: 100%;" />
        </div>
        <div class="categories bottom-30">
            <h2 class="text-3 title-style-1">Danh mục nhiều người đọc</h2>
            <div class="line-border bottom-20"></div>
            <div class="categories-list">
                <style>
                    .cl30 li{
                        width: 48.33333%;
                    }
                    .cl30 .glyphicon-play{
                        line-height:15px;
                    }
                </style>
                <ul class="ul-style-1 list-inline cl30">
				<?php
					$categories = get_terms( 'category', 'orderby=count&hide_empty=0' );
					foreach ( $categories as $cat ) {
				?>
                    <li>
						<a href="<?php echo get_term_link($cat); ?>" title="<?php echo $cat->name; ?>">
							<span class="glyphicon glyphicon-play" aria-hidden="true"></span><?php echo $cat->name; ?> (<?php echo $cat->count; ?>)
						</a>
					</li>   
				<?php } ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="categories">
            <h2 class="text-3 title-style-1">Lưu trữ</h2>
            <div class="line-border bottom-20"></div>
            <ul class="ul-style-1 list-inline cl30">
                <?php
					$series = get_terms( 'series', 'orderby=count&hide_empty=0' );
					foreach ( $series as $cat ) {
				?>
                    <li>
						<a href="<?php echo get_term_link($cat); ?>" title="<?php echo $cat->name; ?>">
							<span class="glyphicon glyphicon-play" aria-hidden="true"></span><?php echo $cat->name; ?> (<?php echo $cat->count; ?>)
						</a>
					</li>   
				<?php } ?>
            </ul>
            <div class="clearfix"></div>
        </div>

	</div>
    
<?php get_sidebar(); ?>
<?php get_footer(); ?>
