<?php get_header(); ?>
<div id="content-wrapper" class="site-content">

	<div class="breadcrumbs">
		<div class="breadcrumbs">
			<?php echo cmp_breadcrumb(); ?>
		</div>
	</div>

	<div id="content" role="main">


		<section>
			<?php if ( have_posts() ) : ?>
				<?php $post = $posts[0]; ?>
				<header class="page-header">

					<h1 class="page-title">

						<?php
						if ( is_category() ) {
							printf( __( 'Category Archives: %s', '_s' ), '<span>' . single_cat_title( '', false ) . '</span>' );

						} elseif ( is_tag() ) {
							printf( __( 'Tag Archives: %s', '_s' ), '<span>' . single_tag_title( '', false ) . '</span>' );

						} elseif ( is_author() ) {
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
//								printf( __( 'Author Archives: %s', '_s' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						} elseif ( is_day() ) {
							printf( __( 'Daily Archives: %s', '_s' ), '<span>' . get_the_date() . '</span>' );

						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives: %s', '_s' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives: %s', '_s' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						} else {
							_e( 'Archives', '_s' );

						}
						?>
					</h1>






					<?php
					if ( is_category() ) {
						// show an optional category description
						$category_description = category_description();
						if ( ! empty( $category_description ) ) {
							echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
						}

					} elseif ( is_tag() ) {
						// show an optional tag description
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) ) {
							echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
						}
					}
					?>
				</header>

				<?php rewind_posts(); ?>


				<?php if ( is_author() ) { ?>

					<?php $otherFeaturedPost = new WP_Query();
					$otherFeaturedPost->query( 'showposts=1' ); ?>
					<?php while ( $otherFeaturedPost->have_posts() ) : $otherFeaturedPost->the_post(); ?>
					<?php endwhile;
					wp_reset_query(); ?>
					<?php if ( isset( $_GET['author_name'] ) ) {
						$current_author = get_userdatabylogin( $author_name );
					} else {
						$current_author = get_userdata( intval( $author ) );
					} ?>


					<br/>
					<div class="clear-block">
						<div class="alignleft" style="margin: 0 6px 0px 15px">
							<?php if ( function_exists( 'get_avatar' ) ) {
								echo get_avatar( get_the_author_meta( 'email' ), '170' );
							} ?>
						</div>

						<div class="author-info">
							<b><?php echo $current_author->display_name; ?></b>

							<p style=" margin-top: 5px !important; margin-bottom: 5px !important;">     <?php  if ( $current_author->user_description <> '' ) {
									echo $current_author->user_description;
								} else {
									_e( "This user hasn't shared any profile information", "mm" );
								} ?>
							</p>
							<ul>         <?php  if ( ( $current_author->user_url <> 'http://' ) && ( $current_author->user_url != '' ) ) {
									echo '<li class="authorstuff">' . __( 'Home page:', mm ) . ' <a href="' . $current_author->user_url . '">' . $current_author->user_url . '</a></li>';
								}
								if ( $current_author->yim != '' ) {
									echo '<li class="authorstuff">Yahoo Messenger: <a href="ymsgr:sendIM?' . $current_author->yim . '">' . $current_author->yim . '</a></li>';
								}
								if ( $current_author->jabber != '' ) {
									echo '<li class="authorstuff">Jabber/GTalk: <a href="gtalk:chat?jid=' . $current_author->jabber . '">' . $current_author->jabber . '</a></li>';
								}
								if ( $current_author->aim != '' ) {
									echo '<li class="authorstuff">AIM: <a href="aim:goIM?screenname=' . $current_author->aim . '">' . $current_author->aim . '</a></li>';
								}   ?>
							</ul>
						</div>
					</div>
					<div class="cb"></div>

				<?php } ?>

				<?php if ( get_option_mmtheme( 'ad_5_on_off' ) == 'true' ) {
					; ?>
					<center>
						<div class="ad-5">
							<?php echo stripslashes( get_option_mmtheme( 'ad_5' ) ) ?>
						</div>
					</center>
				<?php } ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>



					<?php get_template_part( 'content', 'archive', get_post_format() ); ?>




				<?php endwhile; ?>


				<?php if ( get_option_mmtheme( 'ad_6_on_off' ) == 'true' ) {
					; ?>
					<center>
						<div class="ad-6">
							<?php echo stripslashes( get_option_mmtheme( 'ad_6' ) ) ?>
						</div>
					</center>
				<?php } ?>

				<div id="pag">
					<div class="pagination-wrapper"><?php magazine3_pagination(); ?></div>
					<div class="cb"></div>
				</div>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', '_s' ); ?></h1>
					</header>
					<!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', '_s' ); ?></p>
						<?php get_search_form(); ?>
					</div>
					<!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
		</section>

	</div>
	<!-- #content -->
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
