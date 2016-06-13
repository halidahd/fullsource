<?php
add_action( 'after_setup_theme', 'topgadget_theme_setup' );
/**
 * Theme setup function.
 * @since  0.1.0
 */
function topgadget_theme_setup() {
	/* updater args */
	$updater_args = array(
		'repo_uri'  => 'http://magazine3.com/updates/',
		'repo_slug' => 'topgadget'
	);

	/* add support for updater */
	add_theme_support( 'auto-hosted-theme-updater', $updater_args );
}

/* Load Theme Updater */
require_once( trailingslashit( get_template_directory() ) . 'includes/theme-updater.php' );
new topgadget_Theme_Updater;

function remove_shortcode_from_index( $content ) {
	if ( is_home() || is_archive() || is_search() ) {
		$content = strip_shortcodes( $content );
	}

	return $content;
}

add_filter( 'the_content', 'remove_shortcode_from_index' );


function postimage( $size = medium ) {
	if ( $images = get_children( array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => 5,
		'post_mime_type' => 'image',
	) )
	) {
		foreach ( $images as $image ) {
			$attachmenturl   = get_attachment_link( $image->ID );
			$attachmentimage = wp_get_attachment_image( $image->ID, $size );

			echo '<a href="' . $attachmenturl . '" class="home-gallery-item" rel="lightbox">' . $attachmentimage . '</a>';
		}
	} else {
		echo "No Image";
	}
}

//include("includes/update_notifier.php");    
require( get_template_directory() . '/includes/jetpack-carousel.php' );
require( get_template_directory() . '/metaboxes.php' );

if ( function_exists( 'grunion_media_button' ) ) {
	?>
<?php
} else {
	?>
	<?php require( get_template_directory() . '/includes/grunion-contact-form/grunion-contact-form.php' ); ?>
<?php
}
add_filter( 'the_category', 'add_nofollow_cat' );
function add_nofollow_cat( $text ) {
	$text = str_replace( 'rel="category tag"', "", $text );

	return $text;
}


function magazine3_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo "<div class='pagination'>";
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<a rel='nofollow' href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
		}
		if ( $paged > 0 && $showitems < $pages ) {
			echo "<a rel='nofollow' class='firstpag' href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";
		}

		$nofollow = "";
		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $i ) {
				$nofollow = "rel='nofollow'";
			}
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<span class='current'>" . $i . "</span>" : "<a " . $nofollow . " href='" . get_pagenum_link( $i ) . "' class='inactive' >" . $i . "</a>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo "<a rel='nofollow' href='" . get_pagenum_link( $paged + 1 ) . "'>&rsaquo;</a>";
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<a rel='nofollow' class='lastpag' href='" . get_pagenum_link( $pages ) . "'>&raquo;</a>";
		}
		echo "</div>\n";
	}
}

$prefix = 'dbt_';

$meta_box = array(
	'id'       => 'my-meta-box',
	'title'    => 'Thumbnail Type',
	'page'     => 'post',
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name'    => 'Thumbnail Type',
			'id'      => $prefix . 'select1',
			'type'    => 'select',
			'options' => array(
				'Small thumbnail in Left',
				'No Thumbnail',
				'Small thumbnail in Right',
				'Big left thumbnail',
				'Big right thumbnail',
				'Center Big Thumbnail',
				'Video',
				'Full Post'
			)
		),
		array(
			'name' => 'Video html code',
			'desc' => 'If selected video, then paste html code above',
			'id'   => $prefix . 'videocode',
			'type' => 'textarea',
			'std'  => ''
		),
		array(
			'name'    => 'Gallery on Homepage',
			'id'      => $prefix . 'select',
			'type'    => 'select',
			'std'     => 'Disable',
			'options' => array( 'Disable', 'Enable' )
		)

	)
);

add_action( 'admin_menu', 'mytheme_add_box' );

// Add meta box
function mytheme_add_box() {
	global $meta_box;

	add_meta_box( $meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority'] );
}

// Callback function to show fields in meta box
function mytheme_show_box() {
	global $meta_box, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce( basename( __FILE__ ) ), '" />';

	echo '<table class="form-table">';

	foreach ( $meta_box['fields'] as $field ) {
		// get current post meta data
		$meta = get_post_meta( $post->ID, $field['id'], true );

		echo '<tr>',
		'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
		'<td>';
		switch ( $field['type'] ) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
				'<br />', $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
				'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ( $field['options'] as $option ) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ( $field['options'] as $option ) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo '<td>',
		'</tr>';
	}

	echo '</table>';
}

add_action( 'save_post', 'mytheme_save_data' );

// Save data from meta box
function mytheme_save_data( $post_id ) {
	global $meta_box;

	// verify nonce
	if ( ! wp_verify_nonce( $_POST['mytheme_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	foreach ( $meta_box['fields'] as $field ) {
		$old = get_post_meta( $post_id, $field['id'], true );
		$new = $_POST[ $field['id'] ];

		if ( $new && $new != $old ) {
			update_post_meta( $post_id, $field['id'], $new );
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field['id'], $old );
		}
	}
}

function the_content_limit( $max_char, $more_link_text = ' ', $stripteaser = 0, $more_file = '' ) {
	$content = get_the_content( $more_link_text, $stripteaser, $more_file );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = strip_tags( $content );
	if ( ( strlen( $content ) > $max_char ) && ( $espacio = strpos( $content, " ", $max_char ) ) ) {
		$content = substr( $content, 0, $espacio );
		$content = $content;
		echo "<p>";
		echo $content;
		echo "...<a href='";
		the_permalink();
		echo "'>" . "</a>";
		echo "</p>";
	} else {
		echo "<p>";
		echo $content;
		echo "...<a href='";
		the_permalink();
		echo "'>" . "</a>";
		echo "</p>";
	}
}

/* THUMBNAIL */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featuredthumbnail', 620, 226, true );
	add_image_size( 'popular-thumb', 84, 55, true );
	add_image_size( 'sidebar-thumb', 50, 50, true );
	add_image_size( 'contentsmall', 195, 110, true );
	add_image_size( 'secondpostimg', 102, 75, true );
	add_image_size( 'featuredbig', 420, 283, true );
	add_image_size( 'featuredsmall', 300, 188, true );
	add_image_size( 'review-home', 100, 90, true );
	add_image_size( 'singlegalthumb', 64, 50, true );
	add_image_size( 'big-image-center', 600, 450, true );
	add_image_size( 'smallthumb-left', 210, 158, true );
	add_image_size( 'bigthumb-left', 390, 293, true );
}
/**
 * _s functions and definitions
 *
 * @package _s
 * @since   _s 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since _s 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640;
} /* pixels */

if ( ! function_exists( '_s_setup' ) ): /**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since _s 1.0
 */ {
	function _s_setup() {

		/**
		 * Custom template tags for this theme.
		 */
		require( get_template_directory() . '/includes/core/template-tags.php' );

		/**
		 * Custom functions that act independently of the theme templates
		 */
		//require( get_template_directory() . '/includes/core/tweaks.php' );


		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on _s, use a find and replace
		 * to change '_s' to the name of your theme in all the template files
		 */
		load_theme_textdomain( '_s', get_template_directory() . '/languages' );

		$locale      = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );


	}
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since _s 1.0
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => ( 'Sidebar' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div></aside>",
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div><div class="widget_container">',
	) );

	register_sidebar( array(
		'name'          => 'Footer Block 1',
		'description'   => __( 'Footer Block 1', "mm" ),
		'before_widget' => ' <div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );
	register_sidebar( array(
		'name'          => 'Footer Block 2',
		'description'   => __( 'Footer Block 2', "mm" ),
		'before_widget' => ' <div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );
	register_sidebar( array(
		'name'          => 'Footer Block 3',
		'description'   => __( 'Footer Block 3', "mm" ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );
	register_sidebar( array(
		'name'          => 'Footer Block 4',
		'description'   => __( 'Footer Block 4', "mm" ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );

}

add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function mm_admin_styles() {
	wp_enqueue_style( 'color-picker', get_template_directory_uri() . '/includes/overall.css' );
}

add_action( 'admin_print_styles', 'mm_admin_styles' );

function _s_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
	}
}

add_action( 'wp_enqueue_scripts', '_s_scripts' );

/* -----------    Comments BOXES     --------------- */
function thecomment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="the-comment">
		<?php echo get_avatar( $comment, $size = '60' ); ?>
		<div class="comment-arrow"></div>
		<div class="comment-box">
			<div class="comment-author">
				<strong><?php echo get_comment_author_link() ?></strong>
				<small><?php printf( __( '%1$s at %2$s', "mm" ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( __( 'Edit', "mm" ), '  ', '' ) ?>
					- <?php comment_reply_link( array_merge( $args, array(
						'reply_text' => 'Reply',
						'add_below'  => $add_below,
						'depth'      => $depth,
						'max_depth'  => $args['max_depth']
					) ) ) ?></small>
			</div>
			<div class="comment-text">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', "mm" ) ?></em>
					<br/>
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
		</div>
	</div>
<?php
}


/*
 * Function gender Breadcrumb
 */
function cmp_breadcrumb() {
	if ( is_home() ) {
		?><span>Trang chủ</span><?php
	}

	if ( is_single() ) {
		?>
		<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="Trở về Trang chủ Kitech"
									   href="<?php echo home_url(); ?>">Trang chủ</a></span> &gt; <span
			typeof="v:Breadcrumb"><?php the_category( '&gt; ' ); ?></span> &gt; <span typeof="v:Breadcrumb"
																					  property="v:title"><?php the_title(); ?></span>
	<?php
	}

	if ( is_category() ) {
		?>
		<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="Trở về Trang chủ Kitech"
									   href="<?php echo home_url(); ?>">Trang chủ</a></span> &gt; <span
			typeof="v:Breadcrumb"><?php single_cat_title( '', true ); ?></span>
	<?php
	}

	if ( is_tag() ) {
		?>
		<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="Trở về Trang chủ Kitech"
									   href="<?php echo home_url(); ?>">Trang
				chủ</a></span> &gt; <?php printf( __( 'Tags :<span typeof="v:Breadcrumb">%s</span>', '_s' ), single_tag_title( '', true ) ); ?>
	<?php
	}

	if ( is_author() ) {
		?>
		<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="Trở về Trang chủ Kitech"
									   href="<?php echo home_url(); ?>">Trang
				chủ</a></span> &gt; <?php printf( __( 'Author: <span typeof="v:Breadcrumb">%s</span>', '_s' ), get_the_author() ); ?>
	<?php
	}

}

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

/*  MM Panel */
require( get_template_directory() . '/includes/mm/mm.php' );
require( get_template_directory() . '/includes/mm/mm-includes.php' );
/* JS */
require( get_template_directory() . '/includes/theme-js.php' );
require( get_template_directory() . '/includes/w.php' );
require( get_template_directory() . '/includes/function.php' );
