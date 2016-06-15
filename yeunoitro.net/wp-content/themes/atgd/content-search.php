<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package atgd
 */
?>



                <div class="part-content top-10">
					<div class="pull-left img-w140">
						<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title();?>">                    
                            <?php 
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'Category-list', array('class' => '', 'style' => 'width:142px; height:101px;', 'alt' => ''.get_the_title().''));
                                }
                                else {
                                    echo "<img src='".get_stylesheet_directory_uri()."/images/noimage.jpg' alt='".get_the_title()."' style='width:142px; height:101px;'>";
                                }
                            ?> 
                        </a>
					</div>
					<div class="pull-left s-list-content">
						<div class="fix-h">
							<h3 class="text-2 font-16">
                            <a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php the_title() ?></a>
                            </h3>
							<p class="top-10 font-13"><?php echo excerpt(25); ?></p>
						</div>
						<div class="group-info">
<!--							<div class="info col-xs-5 no-padding">-->
<!--                                <i class="_user"></i><span><strong>--><?php //echo get_the_author(); ?><!--</strong></span></strong>-->
<!--                            </div>-->
<!--                            <div class="info col-xs-2 no-padding">-->
<!--                                <i class="_like"></i><span>--><?php //echo $post->comment_count; ?><!--</span>-->
<!--                            </div>-->
                            <div class="info col-xs-5 no-padding text-right">
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
                                    lúc : <?php echo get_the_date("G:i"); ?>
                                </span>
                            </div>
                            <div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>



