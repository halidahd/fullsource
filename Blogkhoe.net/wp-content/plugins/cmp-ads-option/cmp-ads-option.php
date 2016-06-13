<?php
/*
Plugin Name: CMP Ads Theme option
Description: Cho phép add quảng cáo vào theme theo vị trí và page
Version: 1.0
Author: PhươngCM
*/
// Prevent loading this file directly
defined( "ABSPATH" ) || exit;
define( "CMP_ADS_DIR", plugin_dir_path( __FILE__ ) );
define( "CMP_ADS_DIR_INC_DIR", CMP_ADS_DIR . "inc/" );

$option_ads = array(
  array(
    'name'          => __( 'PC - Cate - Mid content - 336x280', 'blogkhoe' ),
    'id'            => 'cmp_ads_pc_cate_mid_content',
    'desc'          => __( 'PC Cate Mid content đặt ở home/cate/tag/… dưới bài thứ 4 trong danh sách bài viết', 'blogkhoe' ),
    'sub_option_id' => 'cmp_ads_pc_cate_mid_content_on_off'
  ),
  array(
    'name'          => __( 'PC - Detail - Bottom content - 336x280', 'blogkhoe' ),
    'id'            => 'cmp_ads_pc_detail_bottom_content',
    'desc'          => __( 'Detail Bottom content là ngay dưới nội dung bài viết', 'blogkhoe' ),
    'sub_option_id' => 'cmp_ads_pc_detail_bottom_content_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Detail - Mid content - 300x250', 'blogkhoe' ),
    'id'            => 'cmp_ads_mb_detail_mid_content',
    'desc'          => __( 'Detail Mid content là ngay trên thẻ h2 đầu tiên trong bài', 'blogkhoe' ),
    'sub_option_id' => 'cmp_ads_mb_detail_mid_content_on_off'
  ),
		array(
		'name'          => __( 'Mobile - Detail - Bottom content - 300x250', 'blogkhoe' ),
		'id'            => 'cmp_ads_mb_detail_bottom_content',
		'desc'          => __( 'Mobile - Detail - Bottom content - 300x250', 'blogkhoe' ),
		'sub_option_id' => 'cmp_ads_mb_detail_bottom_content_on_off'
		),
  array(
    'name'          => __( 'Mobile - Cate - Mid content 1 - 300x250', 'blogkhoe' ),
    'id'            => 'cmp_ads_mb_cate_mid_content1',
    'desc'          => __( 'Cate Mid content 1 là ngay dưới bài viết thứ 3 trong danh sách(Cate là áp dụng cho cả home/cate/tag/)', 'blogkhoe' ),
    'sub_option_id' => 'cmp_ads_mb_cate_mid_content1_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Cate - Mid content 2 - 300x250', 'blogkhoe' ),
    'id'            => 'cmp_ads_mb_cate_mid_content2',
    'desc'          => __( 'Cate Mid content 2 là ngay dưới bài viết thứ 6 trong danh sách(Cate là áp dụng cho cả home/cate/tag/)', 'blogkhoe' ),
    'sub_option_id' => 'cmp_ads_mb_cate_mid_content2_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Sitewide - Footer - 300x250', 'blogkhoe' ),
    'id'            => 'cmp_ads_mb_sitewide_footer',
    'desc'          => __( 'Mobile - Sitewide - Footer - 300x250', 'blogkhoe' ),
    'sub_option_id' => 'cmp_ads_mb_sitewide_footer_on_off'
  ),
  array(
    'name'          => __( 'PC - Sitewide - Floating - 160x600', 'blogkhoe' ),
    'id'            => 'cmp_ads_pc_sitewide_floating',
    'desc'          => __( 'PC - Sitewide - Floating - 160x600', 'blogkhoe' ),
    'sub_option_id' => 'cmp_ads_pc_sitewide_floating_on_off'
  ),
	array(
			'name'          => __( 'PC - Sitewide - Header - 320x100', 'blogkhoe' ),
			'id'            => 'cmp_ads_pc_sitewide_header',
			'desc'          => __( 'PC - Sitewide - Header - 320x100', 'blogkhoe' ),
			'sub_option_id' => 'cmp_ads_pc_sitewide_header_on_off'
	),
	array(
				'name'          => __( 'PC - Sitewide - Bottom right - 300x600', 'blogkhoe' ),
				'id'            => 'cmp_ads_pc_sitewide_bottom_right',
				'desc'          => __( 'PC - Sitewide - Bottom right - 300x600', 'blogkhoe' ),
				'sub_option_id' => 'cmp_ads_pc_sitewide_bottom_right_on_off'
		),
  array(
    'name'          => __( 'Mobile - Sitewide - Header - 320x100', 'blogkhoe' ),
    'id'            => 'cmp_ads_mb_sitewide_header',
    'desc'          => __( 'Mobile - Sitewide - Header - 320x100', 'blogkhoe' ),
    'sub_option_id' => 'cmp_ads_mb_sitewide_header_on_off'
  ),
);

function add_theme_menu_item() {
  //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( "CMP Ads Option", "CMP Ads Options", "manage_options", "theme-option", "cmp_ads_theme_options", null, 99 );
}

add_action( "admin_menu", "add_theme_menu_item" );


//Seting function
function cmp_ads_theme_options() {
  global $option_ads;
  ?>
  <div class="wrap">
    <h1>CMP Ads option</h1>

    <form method="post" action="options.php">
      <?php
      settings_fields( "section" );
      do_settings_sections( "theme-options" );
      submit_button();

      ?>
      <table class="form-table">
        <tr>
          <th colspan="2" style="line-height: 150%">
            Đặt đoạn code sau vào chỗ cần đặt quảng cáo<br>
            <code>cmp_ads("ID", $return = false)</code> //default return = false <br>Hoặc<br>
            <code>if( is_home() ){ cmp_ads("ID"); }<br></code>
          </th>
        </tr>
        <?php
        foreach ( $option_ads as $option ):
          ?>
          <tr>
            <th scope="row" style="width: 300px;">
              <strong><?php echo $option[ 'name' ] ?></strong><br><br> ID:
              <em style="font-weight: 500"><?php echo $option[ 'id' ] ?></em><br><br>
							<em style="font-weight: 500"><?php echo $option['desc']; ?></em>
            </th>
            <td>
              <div>
                <label><strong>Enable: </strong><input type="checkbox" name="<?php echo $option[ 'sub_option_id' ] ?>" value="1" <?php checked( 1, get_option( $option[ 'sub_option_id' ] ), true ); ?> />
              </div>
              <textarea rows="4" style="width: 80%" name="<?php echo $option[ 'id' ] ?>" id="ads_home_header"><?php echo get_option( $option[ 'id' ] ); ?></textarea>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <?php
      submit_button();
      ?>
    </form>
  </div>
<?php
}

function ads_home_header() {
  ?>
  <div><label><strong>Enable: </strong>
      <input type="checkbox" name="ads_home_header_on_off" value="1" <?php checked( 1, get_option( 'ads_home_header_on_off' ), true ); ?> />
  </div>
  <textarea rows="4" style="width: 80%" name="ads_home_header" id="ads_home_header"><?php echo get_option( 'ads_home_header' ); ?></textarea>
<?php
}

function display_theme_panel_fields() {
  global $option_ads;

  add_settings_section( "section", "Ads Settings", null, "theme-options" );

  foreach ( $option_ads as $option ) {
    register_setting( "section", $option[ 'id' ] );
    if ( isset( $option[ 'sub_option_id' ] ) ) {
      register_setting( "section", $option[ 'sub_option_id' ] );
    }
  }

}

add_action( "admin_init", "display_theme_panel_fields" );

if ( ! is_admin() ) {
  if ( ! function_exists( 'cmp_ads' ) ) {
    function cmp_ads( $id = '', $return = false ) {

      if ( get_option( $id . '_on_off', 0 ) ) {
        if ( $return ) {
          return get_option( $id );
        }

        echo get_option( $id );
      }
    }
  }
}

require_once CMP_ADS_DIR_INC_DIR . 'widgets.php';