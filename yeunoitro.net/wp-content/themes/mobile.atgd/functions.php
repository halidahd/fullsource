<?php

if ( ! function_exists( 'atgd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function atgd_setup()
	{

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

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'atgd_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

	}
endif; // atgd_setup

add_action( 'wp_print_styles', 'remove_styles', 100 );

function remove_styles()
{
	wp_deregister_style( 'simple_popup_manager-style' );
	wp_deregister_style( 'yarppWidgetCss' );
}

add_action( 'wp_print_scripts', 'remove_scripts', 100 );

function remove_scripts()
{
	wp_deregister_script( 'jquery-core' );
	wp_deregister_script( 'jquery-migrate' );
	wp_deregister_script( 'simple-popup-manager' );
}

add_action( 'after_setup_theme', 'atgd_setup' );


// This theme uses wp_nav_menu() in one location.
register_nav_menus( array( 'primary' => __( 'Primary Menu' ) ) );

add_action( 'init', 'register_nav_menus' );


function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );

	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}

function atgd_admin_init()
{
	wpb_imagelink_setup();
}

add_action('admin_init', 'wpb_imagelink_setup', 10);

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function atgd_widgets_init()
{

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

if ( function_exists( 'add_image_size' ) )
{
	add_image_size( 'Sidebar-thumb', 70, 62, true ); // (cropped)
	add_image_size( 'Category-thumb', 80, 64, true );
	add_image_size( 'Category-list', 185, 117, true );
	add_image_size( 'Category-list_mobile', 223, 166, true );

}

function get_canonical( $url )
{
	$str = $url;
	if ( strpos( $url, 'page' ) !== false )
	{
		$str = substr( $url, 0, strrpos( $url, 'page' ) );
	}
	echo "<link rel='canonical' href='http://" . $str . "' />";
}

require_once dirname( __FILE__ ) . "/mfunctions/function.php";
require_once dirname( __FILE__ ) . "/mfunctions/custom.php";
