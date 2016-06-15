<?php
/**
shortcode
 */
function wpz_shortcode_ingredients( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Ingredients',
	), $atts ) );

	//	$ads_div = '<script type="text/javascript" src="//admicro1.vcmedia.vn/ads_codes/ads_box_16907.ads"></script>';
	return '<div class="shortcode-ingredients"><h2>' . esc_attr($title) . '</h2>' . do_shortcode( $content ) . '</div>' . "\n ";
}
add_shortcode( 'ingredients', 'wpz_shortcode_ingredients' );

function wpz_shortcode_directions( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Directions',
	), $atts ) );

	$ads_code = "<div class='mb_detail_in_content' style='text-align:center;'>".cmp_ads('mb_detail_in_content', true)."</div>";
  $ads_code2 = "<div class='mb_detail_in_content_2' style='text-align:center;'>".cmp_ads('mb_detail_in_content_2', true)."</div>";

	return $ads_code . '<div class="shortcode-directions"><h2>' . esc_attr($title) . '</h2>' . do_shortcode( $content ) . '</div>'. $ads_code2;
}
add_shortcode( 'directions', 'wpz_shortcode_directions' );

function add_recipe_buttons() {
	if ( !current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}

	if ( get_user_option('rich_editing') == 'true' ) {
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
	$plugin_array['recipe'] = get_template_directory_uri() . '/js/recipe_buttons.js';
	return $plugin_array;
}

function recipe_refresh_mce( $ver ) {
	$ver += 3;
	return $ver;
}
add_filter( 'tiny_mce_version', 'recipe_refresh_mce' );

add_filter('wp_pagenavi', 'wp_navi_rel_nofollow');
function wp_navi_rel_nofollow($out){
	//$str = str_replace('<a ', '<a rel="nofollow" ', $out);
	//$str = str_replace('rel="nofollow" class="first"', ' class="first"', $str);
	$arr = explode('/a>', $out);

	for ($i = 0; $i < count($arr); $i++) {
		if (strpos($arr[$i],'first') !== false || strpos($arr[$i],'>1<') !== false) {

		}
		else {
			$arr[$i] = str_replace('<a ', '<a rel="nofollow" ', $arr[$i]);
		}
	}

	$str = implode('/a>', $arr);

	return $str;
}

function custom_excerpt_length( $length = 0 )
{
	return (int) ( $length ) ? $length : 250;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * do dai cua mo ta
 */
function excerpt( $limit )
{
	$excerpt = explode( ' ', get_the_excerpt(), $limit );

	if ( count( $excerpt ) >= $limit )
	{
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	}
	else
	{
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;
}

function get_cookie_crc( $name = 'atgd_info' )
{

	while ( isset( $_COOKIE[$name] ) && isset( $_COOKIE[$name . '_crc'] ) )
	{

		$array = json_decode( stripslashes( $_COOKIE[$name] ), true );

		if ( ! is_array( $array ) )
			break;

		if ( $_COOKIE[$name . '_crc'] !== md5( stripslashes( $_COOKIE[$name] ) . '0S30nfjid66Y8wRkJweSIhdOVcQfUxMO' ) )
			break;

		return $array;
	}

	return false;
}

$action = $_GET["action"] ? $_GET["action"] : "";

if($action == "get_more"){
  $paged = $_GET["paged"] ? $_GET["paged"] : 2;
  getMorePost( $paged );
}

function getMorePost( $paged ){
  echo json_encode(array("a"=>'123'));die();
  // WP_Query arguments
}

//add_action('wp_ajax_getMorePost', 'getMorePost');
//add_action('wp_ajax_nopriv_getMorePost', 'getMorePost');