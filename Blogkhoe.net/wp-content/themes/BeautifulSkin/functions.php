<?php
require_once TEMPLATEPATH . '/lib/Themater.php';
$theme = new Themater( 'BeautifulSkin' );
$theme->options['includes'] = array( 'featuredposts', 'social_profiles' );

$theme->options['plugins_options']['featuredposts'] = array( 'image_sizes' => '615px. x 300px.', 'speed' => '400', 'effect' => 'scrollHorz' );

$theme->admin_options['Ads']['content']['header_banner']['content']['value'] = '<a href="https://flexithemes.com/wp-content/pro/b468.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b468.gif" alt="Check for details" /></a>';


// Footer widgets
$theme->admin_option( 'Layout', 'Footer Widgets Enabled?', 'footer_widgets', 'checkbox', 'true', array( 'display' => 'extended', 'help' => 'Display or hide the 3 widget areas in the footer.', 'priority' => '15' ) );


$theme->load();

register_sidebar( array( 'name' => __( 'Primary Sidebar', 'themater' ), 'id' => 'sidebar_primary', 'description' => __( 'The primary sidebar widget area', 'themater' ), 'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">', 'after_widget' => '</li></ul>', 'before_title' => '<h3 class="widgettitle">', 'after_title' => '</h3>' ) );


$theme->add_hook( 'sidebar_primary', 'sidebar_primary_default_widgets' );

function sidebar_primary_default_widgets()
{
  global $theme;

  $theme->display_widget( 'SocialProfiles' );
  $theme->display_widget( 'Banners125', array( 'banners' => array( '<a href="https://flexithemes.com/wp-content/pro/b125-1.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b125-1.gif" alt="Check for details" /></a><a href="https://flexithemes.com/wp-content/pro/b125-2.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b125-2.gif" alt="Check for details" /></a><a href="https://flexithemes.com/wp-content/pro/b125-13.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b125-3.gif" alt="Check for details" /></a><a href="https://flexithemes.com/wp-content/pro/b125-4.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b125-4.gif" alt="Check for details" /></a>' ) ) );
  $theme->display_widget( 'Tabs' );
  $theme->display_widget( 'Tag_Cloud' );
  $theme->display_widget( 'Archives' );
  $theme->display_widget( 'Facebook', array( 'url' => 'https://www.facebook.com/FlexiThemes' ) );
  $theme->display_widget( 'Text', array( 'text' => '<div style="text-align:center;"><a href="https://flexithemes.com/wp-content/pro/b260.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b260.gif" alt="Check for details" /></a></div>' ) );
}

// Register the footer widgets only if they are enabled from the FlexiPanel
if( $theme->display( 'footer_widgets' ) ) {
  register_sidebar( array( 'name' => 'Footer Widget Area 1', 'id' => 'footer_1', 'description' => 'The footer #1 widget area', 'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">', 'after_widget' => '</li></ul>', 'before_title' => '<h3 class="widgettitle">', 'after_title' => '</h3>' ) );

  register_sidebar( array( 'name' => 'Footer Widget Area 2', 'id' => 'footer_2', 'description' => 'The footer #2 widget area', 'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">', 'after_widget' => '</li></ul>', 'before_title' => '<h3 class="widgettitle">', 'after_title' => '</h3>' ) );

  register_sidebar( array( 'name' => 'Footer Widget Area 3', 'id' => 'footer_3', 'description' => 'The footer #3 widget area', 'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">', 'after_widget' => '</li></ul>', 'before_title' => '<h3 class="widgettitle">', 'after_title' => '</h3>' ) );

  register_sidebar( array( 'name' => 'Footer Widget Area 4', 'id' => 'footer_4', 'description' => 'The footer #4 widget area', 'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">', 'after_widget' => '</li></ul>', 'before_title' => '<h3 class="widgettitle">', 'after_title' => '</h3>' ) );

  $theme->add_hook( 'footer_1', 'footer_1_default_widgets' );
  $theme->add_hook( 'footer_2', 'footer_2_default_widgets' );
  $theme->add_hook( 'footer_3', 'footer_3_default_widgets' );
  $theme->add_hook( 'footer_4', 'footer_4_default_widgets' );

  function footer_1_default_widgets()
  {
    global $theme;
    $theme->display_widget( 'Links' );
  }

  function footer_2_default_widgets()
  {
    global $theme;
    $theme->display_widget( 'Recent_Posts', array( 'number' => '6' ) );
  }

  function footer_3_default_widgets()
  {
    global $theme;
    $theme->display_widget( 'Search' );
    $theme->display_widget( 'Tag_Cloud' );

  }

  function footer_4_default_widgets()
  {
    global $theme;
    $theme->display_widget( 'Text', array( 'title' => 'Contact', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nis.<br /><br /> <span style="font-weight: bold;">Our Company Inc.</span><br />2458 S . 124 St.Suite 47<br />Town City 21447<br />Phone: 124-457-1178<br />Fax: 565-478-1445' ) );
  }
}
if( !is_admin() ) {
  require_once THEMATER_DIR . DIRECTORY_SEPARATOR . 'function.php';
}

add_filter( 'the_content', 'attachment_image_link_remove_filter' );
function attachment_image_link_remove_filter( $content )
{
  $content = preg_replace( array( '{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}', '{ wp-image-[0-9]*" /></a>}' ), array( '<img', '" />' ), $content );
  return $content;
}

//add ads vào trên thẻ h2 đầu tiên
function my_the_content_filter( $content ){

	$index_h2 = strpos($content, '<h2');
	$str1 = substr( $content, 0, $index_h2);
	$str2 = substr( $content, $index_h2);
	$ads = cmp_ads('cmp_ads_mb_detail_mid_content', true);

	$content = $str1.$ads.$str2;

	return $content;
}
add_filter( 'the_content', 'my_the_content_filter' );
