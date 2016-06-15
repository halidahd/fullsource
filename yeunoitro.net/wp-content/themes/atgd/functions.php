<?php
/**
 * atgd functions and definitions
 * @package atgd
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 640; /* pixels */
}

if ( ! function_exists( 'atgd_setup' ) ) : /**
 * Sets up theme defaults and registers support for various WordPress features.
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */ {
  function atgd_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on atgd, use a find and replace
     * to change 'atgd' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'atgd', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'atgd' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
      'aside',
      'image',
      'video',
      'quote',
      'link',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'atgd_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    ) ) );

  }
}
endif; // atgd_setup
add_action( 'after_setup_theme', 'atgd_setup' );


/**
 * Register widget area.
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function atgd_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'atgd' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<div class="title-nct"><h3 class="text-3 title-style-1">',
    'after_title'   => '</h3><div class="clearfix"></div></div>'
  ) );

  register_sidebar( array(
    'name'          => __( 'Sidebar Trang chi tiet', 'atgd' ),
    'id'            => 'sidebar-2',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<div class="title-nct"><h3 class="text-3 title-style-1">',
    'after_title'   => '</h3><div class="clearfix"></div></div>'
  ) );

  register_sidebar( array(
    'name'          => __( 'Sidebar Popup', 'atgd' ),
    'id'            => 'popup',
    'description'   => '',
    'before_widget' => '&nbsp;',
    'after_widget'  => '&nbsp;',
    //'before_title'  => '<h1 class="widget-title">',
    //'after_title'   => '</h1>'
  ) );

  register_sidebar( array(
    'name'          => __( 'Sidebar_mobile', 'atgd' ),
    'id'            => 'sidebar-mobile',
    'description'   => '',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="cleaner">&nbsp;</div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
    //'before_title'  => '<h1 class="widget-title">',
    //'after_title'   => '</h1>'
  ) );
}

add_action( 'widgets_init', 'atgd_widgets_init' );

function wpb_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );

  if ( $image_set !== 'none' ) {
    update_option( 'image_default_link_type', 'none' );
  }
}

add_action( 'admin_init', 'wpb_imagelink_setup', 10 );

function remove_scripts() {
  wp_deregister_script( 'jquery-core' );
  wp_deregister_script( 'jquery-migrate' );
}

//add_action( 'wp_print_scripts', 'remove_scripts', 100 );

/**
 * Enqueue scripts and styles.
 */
function atgd_scripts() {

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}

add_action( 'wp_enqueue_scripts', 'atgd_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Cac bien constant
 */
require get_template_directory() . '/myfiles/constant-variable.php';

/**
 * Cac bien comment disqus
 */
require_once( get_template_directory() . "/myfiles/DQRecentComments.php" );

/**
 * taxnomy nguyen lieu
 */

require_once( get_template_directory() . "/myfiles/taxonguyenlieu.php" );

/**
 * top review
 */

require_once( get_template_directory() . "/myfiles/topreview.php" );

/**
 * my function
 */

require_once( get_template_directory() . "/myfiles/myfunctions.php" );

function custom_excerpt_length( $length ) {
  return 35;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function shorttitle( $str, $length = 50, $trailing = '...' ) {
  $length -= mb_strlen( $trailing );
  if ( mb_strlen( $str ) > $length ) {
    echo mb_substr( $str, 0, $length ) . $trailing;
  } else {
    echo $str;
  }
}

register_sidebar( array(
  'name'          => 'Chân trang - cột 1',
  'id'            => 'footer1',
  'description'   => 'Khu vực sidebar chân trang cột 1',
  'before_widget' => '',
  'after_widget'  => '',
  'before_title'  => '',
  'after_title'   => ''
) );

register_sidebar( array(
  'name'          => 'Chân trang - cột 2',
  'id'            => 'footer2',
  'description'   => 'Khu vực sidebar chân trang cột 2',
  'before_widget' => '',
  'after_widget'  => '',
  'before_title'  => '',
  'after_title'   => ''
) );

register_sidebar( array(
  'name'          => 'Chân trang - cột 3',
  'id'            => 'footer3',
  'description'   => 'Khu vực sidebar chân trang cột 3',
  'before_widget' => '',
  'after_widget'  => '',
  'before_title'  => '',
  'after_title'   => ''
) );

register_sidebar( array(
  'name'          => 'Chân trang - cột 4',
  'id'            => 'footer4',
  'description'   => 'Khu vực sidebar chân trang cột 4',
  'before_widget' => '',
  'after_widget'  => '',
  'before_title'  => '',
  'after_title'   => ''
) );

register_sidebar( array(
  'name'          => 'Chân trang dưới cùng',
  'id'            => 'footer5',
  'description'   => 'Khu vực sidebar chân trang dưới cùng',
  'before_widget' => '',
  'after_widget'  => '',
  'before_title'  => '',
  'after_title'   => ''
) );

/**
 * do dai cua mo ta
 */
function excerpt( $limit ) {
  $excerpt = explode( ' ', get_the_excerpt(), $limit );
  if ( count( $excerpt ) >= $limit ) {
    array_pop( $excerpt );
    $excerpt = implode( " ", $excerpt ) . '...';
  } else {
    $excerpt = implode( " ", $excerpt );
  }
  $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

  return $excerpt;
}

function content( $limit ) {
  $content = explode( ' ', get_the_content(), $limit );
  if ( count( $content ) >= $limit ) {
    array_pop( $content );
    $content = implode( " ", $content ) . '...';
  } else {
    $content = implode( " ", $content );
  }
  $content = preg_replace( '/\[.+\]/', '', $content );
  $content = apply_filters( 'the_content', $content );
  $content = str_replace( ']]>', ']]&gt;', $content );

  return $content;
}

/**
 * shortcode
 */

function wpz_shortcode_ingredients( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'title' => 'Ingredients',
  ), $atts ) );

  return '<div class="shortcode-ingredients"><h2>' . esc_attr( $title ) . '</h2>' . do_shortcode( $content ) . '</div>' . "\n ";
}

add_shortcode( 'ingredients', 'wpz_shortcode_ingredients' );

function wpz_shortcode_directions( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'title' => 'Directions',
  ), $atts ) );

  $ads_div = cmp_ads( 'pc_detail_in_content', true );

  return $ads_div . '<div class="shortcode-directions" itemprop="recipeInstructions"><h2>' . esc_attr( $title ) . '</h2>' . do_shortcode( $content ) . '</div>' . "\n";
}

add_shortcode( 'directions', 'wpz_shortcode_directions' );

function add_recipe_buttons() {
  if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
    return;
  }

  if ( get_user_option( 'rich_editing' ) == 'true' ) {
    add_filter( 'mce_external_plugins', 'add_recipe_tinymce_plugin' );
    add_filter( 'mce_buttons', 'register_recipe_buttons' );
  }
}

add_action( 'init', 'add_recipe_buttons' );

function register_recipe_buttons( $buttons ) {
  array_push( $buttons, "|", "ingredients", "directions" );

  return $buttons;
}

function add_recipe_tinymce_plugin( $plugin_array ) {
  $plugin_array[ 'recipe' ] = get_template_directory_uri() . '/js/recipe_buttons.js';

  return $plugin_array;
}

function recipe_refresh_mce( $ver ) {
  $ver += 3;

  return $ver;
}

add_filter( 'tiny_mce_version', 'recipe_refresh_mce' );

add_filter( 'wp_pagenavi', 'wp_navi_rel_nofollow' );
function wp_navi_rel_nofollow( $out ) {
  //$str = str_replace('<a ', '<a rel="nofollow" ', $out);
  //$str = str_replace('rel="nofollow" class="first"', ' class="first"', $str);
  $arr = explode( '/a>', $out );

  for ( $i = 0; $i < count( $arr ); $i ++ ) {
    if ( strpos( $arr[ $i ], 'first' ) !== false || strpos( $arr[ $i ], '>1<' ) !== false ) {

    } else {
      $arr[ $i ] = str_replace( '<a ', '<a rel="nofollow" ', $arr[ $i ] );
    }
  }

  $str = implode( '/a>', $arr );

  return $str;
}

/**
 * HALH
 * Get Meta title and meta description from SEO PREMIUM PACK
 */
function get_meta_key_title_psp() {

  $tax_seo = get_option( 'psp_taxonomy_seo' );

  $current_term_id = get_queried_object()->term_id;;

  if ( is_tag() ) {
    if ( ! empty( $tax_seo[ 'post_tag' ][ $current_term_id ][ 'psp_meta' ] ) ) {
      echo $tax_seo[ 'post_tag' ][ $current_term_id ][ 'psp_meta' ][ 'title' ];
    } else {
      echo single_tag_title();
    }

  } else if ( is_category() ) {

    if ( ! empty( $tax_seo[ 'category' ][ $current_term_id ][ 'psp_meta' ] ) ) {
      echo $tax_seo[ 'category' ][ $current_term_id ][ 'psp_meta' ][ 'title' ];
    } else {
      echo single_cat_title();
    }
  } else if ( ! empty( $tax_seo[ 'series' ][ $current_term_id ][ 'psp_meta' ] ) ) {
    if ( ! empty( $tax_seo[ 'series' ][ $current_term_id ][ 'psp_meta' ][ 'title' ] ) ) {
      echo $tax_seo[ 'series' ][ $current_term_id ][ 'psp_meta' ][ 'title' ];
    } else {
      single_tag_title();
    }
  } else {
    echo single_tag_title();
  }
}

if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'Sidebar-thumb', 70, 62, true ); // (cropped)
  add_image_size( 'cong-thuc-noi-bat1', 87, 87, true ); // (cropped)
  add_image_size( 'cong-thuc-noi-bat2', 351, 210, true ); // (cropped)
  add_image_size( 'Category-thumb', 80, 64, true );
  add_image_size( 'Category-list', 185, 117, true );
  add_image_size( 'thuc-don', 165, 123, true );
  add_image_size( 'related-thumb', 165, 106, true );
  add_image_size( 'tin-am-thuc', 142, 106, true );
  add_image_size( 'Category-list_mobile', 223, 166, true );
  add_image_size( 'wp_review_small', 65, 65, true );

}

register_sidebar( array(
  'name'          => 'Chân trang dưới cùng',
  'id'            => 'footer5',
  'description'   => 'Khu vực sidebar chân trang dưới cùng',
  'before_widget' => '',
  'after_widget'  => '',
  'before_title'  => '',
  'after_title'   => ''
) );

function show_post_option_dacbiet() {
  global $pagenow;
  if ( $pagenow == 'upload.php' ) {
    return false;
  }

  $html    = array();
  $html[ ] = '<select name="atgd_option_select">';
  $html[ ] = '<option value="none">' . "ATGD: No Options" . '</option>';
  $values  = array(
    'wpcf-noi-bat'       => 'ATGD: Công thức nấu ăn nổi bật',
    'wpcf-dac-biet-1'    => 'ATGD: Công thức nấu ăn đặc biệt loại 1',
    'wpcf-dac-biet-2'    => 'ATGD: Công thức nấu ăn đặc biệt loại 2',
    'wpcf-tin-quang-cao' => 'ATGD: Tin quảng cáo',
    'all'                => 'ATGD: All Options'
  );

  foreach ( $values as $key => $val ) {
    $html[ ] = '<option ' . ( isset( $_GET[ 'atgd_option_select' ] ) && $_GET[ 'atgd_option_select' ] == $key ? ' selected="selected" ' : '' ) . 'value="' . $key . '">' . $val . '</option>';
  }
  $html[ ] = '</select>';
  echo implode( '', $html );
}

function post_option_dacbiet_orderby( $request ) {
  if ( isset( $_GET[ 'atgd_option_select' ] ) ) { // score select / drop-down

    $selVal = $_GET[ 'atgd_option_select' ];

    if ( $selVal == 'none' ) {
      $request = array_merge( $request, array(
        'meta_query' => array(
          'relation' => 'AND',
          'key'      => $selVal,
          array(
            'value'   => 1,
            'compare' => 'NOT EXISTS',
          ),
        )
      ) );
    } else {
      $request = array_merge( $request, array(
        'meta_query' => array(
          'relation' => 'AND',
          'key'      => $selVal,
          array(
            'value' => 1
          ),
        )
      ) );
    }
  }

//	if ( isset( $request['orderby'] ) && $request['orderby'] == 'psp_seo_score' ) { // score column
//		$request = array_merge($request, array(
//			'meta_key' => 'psp_score',
//			'orderby'  => 'meta_value_num'
//		));
//	}
  return $request;
}

add_action( 'restrict_manage_posts', 'show_post_option_dacbiet' );
add_filter( 'request', 'post_option_dacbiet_orderby' );

remove_action( 'wp_head', 'wlwmanifest_link' ); // Removes the link to Windows manifest

/* Theme widgets */
require_once get_template_directory() . "/widgets/social.php";
require_once get_template_directory() . "/widgets/recentposts.php";
require_once get_template_directory() . "/widgets/recentcomments.php";
require_once get_template_directory() . "/widgets/twitter.php";
require_once get_template_directory() . "/widgets/facebook-like-box.php";
require_once get_template_directory() . "/widgets/tabbed-login.php";
require_once get_template_directory() . "/widgets/instagram.php";
?>