<?php
/**
 * The template for displaying all single posts.
 * Template Name: Advertisement view
 * @package atgd
 */

get_header(); ?>

	<div class="content-left pull-left">	
		<style>
			._mtdl {
				position: relative;
			}
			.new-wp a{
				line-height: 20px;
			}
			.new-wp .w525{
				padding-left:13px;
			}
			._mtdl img {
				position: absolute;
				left: -27px;
				top: -33px;
			}
		</style>
		<div class="content-part-1 bottom-10 right-20">
			<div class="breakumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}
				?>
			</div>
			<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="_title-herder bottom-10"><?php the_title(); ?></h1>	
			<?php endwhile; // end of the loop. ?>		
		</div>		
		<div class="line-border bottom-10"></div>
        <div class="content-part-3 bottom-10 right-20">			
			<div class="group-new">
			<?php 
				$args = array(
				'posts_per_page' => 10,
                'meta_key'  => 'wpcf-tin-quang-cao',
                'meta_value' => 1,
                'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 )
				);
				$the_query = new WP_Query( $args );
				if ($the_query -> have_posts() ) :
				while ($the_query -> have_posts() ) : $the_query -> the_post(); 
			?>
				<div class="new-wp bottom-10">
					<div class="img-w185 pull-left">
						<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">                        
						<?php 
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'thumbnail', array('class' => '', 'style' => 'width:185px; height:117px;', 'alt' => ''.get_the_title().'')); 
							}
							else {
								echo "<img src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style='width:185px; height:117px;'>";
							}
						?> 
						</a>	
					</div>
					<div class="w525 pull-left">
						<div>
							<a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>" class="font-21">
								<strong><?php the_title() ?></strong>
							</a>	
						</div>
						<p class="top-10">
							<?php echo excerpt(30); ?>
						</p>

						<div class="info">
<!--							<div class="info col-xs-6 no-padding"><!--them xoa class-->
<!--								<i class="_user"></i><span>Đăng bởi <strong>--><?php //the_author(); ?><!--</strong></span>-->
<!--							</div>-->
							<div class="info col-xs-6 no-padding"><!--them xoa class-->
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
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			<?php
				endwhile;
				endif; 
				wp_reset_query();
			?>	
			</div>
            <div class="line-border clearfix"></div>
            <div class="_pt text-center">
                <?php wp_pagenavi(array( 'query' => $the_query )); ?>
            </div>
		</div>
		<div class="content-part-4 bottom-10 right-20">
            <?php echo adrotate_ad(8); ?>
        </div>
        <div class="content-part-5 bottom-10 right-20">
            <?php include (TEMPLATEPATH . '/myfiles/bi-quyet-nau-an.php'); ?>           
        </div>
        <div class="content-part-* bottom-10 right-20">
			<?php echo adrotate_ad(6); ?>
		</div>
		<div class="_cttatccb bottom-10 right-20">
		    <?php echo adrotate_ad(9); ?>
		</div>
    </div>

<?php get_sidebar("child"); ?>
<?php get_footer(); ?>