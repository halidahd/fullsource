<?php // function to display number of posts.
function getPostViews( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );

		return __( '0 View', 'mm' );
	}

	return $count . __( ' ', 'mm' );
}

function short_title( $before = '', $after = '', $echo = true, $length = false ) {
	$title = get_the_title();

	if ( $length && is_numeric( $length ) ) {
		$title = substr( $title, 0, $length );
	}

	if ( strlen( $title ) > 0 ) {
		$title = apply_filters( 'short_title', $before . $title . $after, $before, $after );
		if ( $echo ) {
			echo $title;
		} else {
			return $title;
		}
	}
}

// function to count views.
function setPostViews( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $count_key, $count );
	}
}

function string_limit_words( $string, $word_limit ) {
	$words = explode( ' ', $string, ( $word_limit + 1 ) );
	if ( count( $words ) > $word_limit ) {
		array_pop( $words );
	}

	return implode( ' ', $words );
}

#MENU START
add_theme_support( 'menus' );
if ( function_exists( 'wp_nav_menu' ) ) {
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'nav-menus' );
		add_action( 'init', 'register_my_menus' );
		function register_my_menus() {
		}

		register_nav_menus( array(
			'first' => __( 'Trending Menu', 'first' ),
		) );
		register_nav_menus( array(
			'second' => __( 'Navigate Menu', 'second' ),
		) );
		register_nav_menus( array(
			'third' => __( 'Main Menu', 'third' ),
		) );
		register_nav_menus( array(
			'forth' => __( 'Footer Menu', 'forth' ),
		) );
	}
}
function primarymenu1() {
	?>
	<div class="top-menu-default">
		<div style="color:#fff"><?php _e( " Go to DASHBOARD > Appearance > Menus to set up the menu.", "mm" ); ?></div>
	</div>
<?php
}

function primarymenu2() {
	?>
	<div class="top-menu-default">
		<div style="color:#fff"><?php _e( " Go to DASHBOARD > Appearance > Menus to set up the menu.", "mm" ); ?></div>
	</div>
<?php
}

function primarymenu3() {
	?>
	<div id="topMenu">
		<ul>
			<li>
				<div><?php _e( " Go to DASHBOARD > Appearance > Menus to set up the menu.", "mm" ); ?></div>
			</li>
		</ul>
	</div>
<?php
}

function primarymenu4() {
	?>
	<div class="navigate-menu">
		<ul id="menu-page" class="menu">
			<li>
				<?php _e( " Go to DASHBOARD > Appearance > Menus to set up the menu.", "mm" ); ?>
			</li>
		</ul>
	</div>
<?php
}


class Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( ! empty( $children_elements[ $element->$id_field ] ) ) {
			$element->classes[] = 'arrow'; //enter any classname you like here!
		}
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

#MENU END


add_theme_support( 'custom-background' );

function m3_titles() {
	global $shortname;
	#if the title is being displayed on the homepage
	if ( is_home() ) {
		if ( get_option_mmtheme( 'seo_home_title' ) == 'titledesc' ) {
			echo get_bloginfo( 'name' ) . get_option_mmtheme( 'homepage-seo-sep' ) . get_bloginfo( 'description' );
		}
		if ( get_option_mmtheme( 'seo_home_title' ) == 'desctitle' ) {
			echo get_bloginfo( 'description' ) . get_option_mmtheme( 'homepage-seo-sep' ) . get_bloginfo( 'name' );
		}
		if ( get_option_mmtheme( 'seo_home_title' ) == 'title' ) {
			echo get_bloginfo( 'name' );
		}
	}
	#if the title is being displayed on single posts/pages
	if ( is_single() || is_page() ) {
		if ( get_option_mmtheme( 'seo_single_title' ) == 'titledesc1' ) {
			echo get_bloginfo( 'name' ) . get_option_mmtheme( 'homepage-seo-sep' ) . wp_title( '', false, '' );
		}
		if ( get_option_mmtheme( 'seo_single_title' ) == 'desctitle1' ) {
			echo wp_title( '', false, '' ) . get_option_mmtheme( 'homepage-seo-sep' ) . get_bloginfo( 'name' );
		}
		if ( get_option_mmtheme( 'seo_single_title' ) == 'title1' ) {
			echo wp_title( '', false, '' );
		}
	}
	#if the title is being displayed on index pages (categories/archives/search results)
	if ( is_category() || is_archive() || is_search() ) {
		echo wp_title( '', false, '' ) . get_option_mmtheme( 'homepage-seo-sep' ) . get_bloginfo( 'name' );
	}
}

function rel_next_prev() {
	global $paged;

	if ( get_previous_posts_link() ) {
		?>
		<link rel="prev" href="<?php echo get_pagenum_link( $paged - 1 ); ?>" /><?php
	}

	if ( get_next_posts_link() ) {
		?>
		<link rel="next" href="<?php echo get_pagenum_link( $paged + 1 ); ?>" /><?php
	}
}

function m3_indexing() {
	global $post;
	global $wpdb;
	if ( ! empty( $post ) ) {
		$post_id = $post->ID;
	}

	/* Robots */
	$index  = 'index';
	$follow = 'follow';

	if ( is_tag() && get_option_mmtheme( 'seo_index_tag' ) != 'index' ) {
		$index = 'noindex';
	} elseif ( is_search() && get_option_mmtheme( 'seo_index_search' ) != 'index' ) {
		$index = 'noindex';
	} elseif ( is_author() && get_option_mmtheme( 'seo_index_author' ) != 'index' ) {
		$index = 'noindex';
	} elseif ( is_date() && get_option_mmtheme( 'seo_index_date' ) != 'index' ) {
		$index = 'noindex';
	} elseif ( is_category() && get_option_mmtheme( 'seo_index_category' ) != 'index' ) {
		$index = 'noindex';
	}
	echo '<meta name="robots" content="' . $index . ', ' . $follow . '" />' . "\n";
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package _s
 * @since _s 1.0
 */


if ( ! function_exists( '_s_comment' ) ) : /**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since _s 1.0
 */ {
	function _s_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
				<p><?php _e( 'Pingback:', '_s' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', '_s' ), ' ' ); ?></p>
				<?php
				break;
			default :
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<footer>
							<div class="comment-author vcard">
								<?php echo get_avatar( $comment, 40 ); ?>
								<?php printf( __( '%s <span class="says">says:</span>', '_s' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
							</div>
							<!-- .comment-author .vcard -->
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em><?php _e( 'Your comment is awaiting moderation.', '_s' ); ?></em>
								<br/>
							<?php endif; ?>

							<div class="comment-meta commentmetadata">
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
									<time pubdate datetime="<?php comment_time( 'c' ); ?>">
										<?php
										/* translators: 1: date, 2: time */
										printf( __( '%1$s at %2$s', '_s' ), get_comment_date(), get_comment_time() ); ?>
									</time>
								</a>
								<?php edit_comment_link( __( '(Edit)', '_s' ), ' ' );
								?>
							</div>
							<!-- .comment-meta .commentmetadata -->
						</footer>

						<div class="comment-content"><?php comment_text(); ?></div>

						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'depth'     => $depth,
																				 'max_depth' => $args['max_depth']
									) ) ); ?>
						</div>
						<!-- .reply -->
					</article>
					<!-- #comment-## -->

				<?php
				break;
		endswitch;
	}
}
endif; // ends check for _s_comment()

if ( ! function_exists( 'm3_posted_on' ) ) : /**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since _s 1.0
 */ {
	function m3_posted_on() {
//	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', '_s' ),
//		esc_url( get_permalink() ),
//		esc_attr( get_the_time() ),
//		esc_attr( get_the_date( 'c' ) ),
//		esc_html( get_the_date() ),
//		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
//		esc_attr( sprintf( __( 'View all posts by %s', '_s' ), get_the_author() ) ),
//		esc_html( get_the_author() )
//	);
		printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', '_s' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since _s 1.0
 */
function _s_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so _s_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so _s_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in _s_categorized_blog
 *
 * @since _s 1.0
 */
function _s_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}

add_action( 'edit_category', '_s_category_transient_flusher' );
add_action( 'save_post', '_s_category_transient_flusher' );
