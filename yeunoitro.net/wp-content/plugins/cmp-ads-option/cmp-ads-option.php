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
    'name'          => __( 'Mobile - Home - Header - 320x100', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_home_header',
    'desc'          => __( 'Mobile - Home - Header - 320x100', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_home_header_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Detail - Header - 320x100', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_detail_header',
    'desc'          => __( 'Mobile - Detail - Header - 320x100', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_detail_header_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Detail - Bottom content - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_detail_bottom_content',
    'desc'          => __( 'Mobile - Detail - Bottom content - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_detail_bottom_content_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Detail - In content - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_detail_in_content',
    'desc'          => __( 'Mobile - Detail - In content - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_detail_in_content_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Detail - In content 2 - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_detail_in_content_2',
    'desc'          => __( 'Mobile - Detail - In content 2 - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_detail_in_content_2_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Cate - Header - 320x100', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_cate_header',
    'desc'          => __( 'Mobile - Cate - Header - 320x100', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_cate_header_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Cate - In content - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_cate_in_content',
    'desc'          => __( 'Mobile - Cate - In content - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_cate_in_content_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Cate - In content 2 - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_cate_in_content_2',
    'desc'          => __( 'Mobile - Cate - In content 2 - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_cate_in_content_2_on_off'
  ),
  array(
    'name'          => __( 'Mobile - Cate - Bottom content - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_mb_cate_bottom_content',
    'desc'          => __( 'Mobile - Cate - Bottom content - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_mb_cate_bottom_content_on_off'
  ),
  array(
    'name'          => __( 'PC - Detail - In content - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_detail_in_content',
    'desc'          => __( 'PC - Detail - In content - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_detail_in_content_on_off'
  ),
  array(
    'name'          => __( 'PC - Home - Header - 970x90', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_home_header',
    'desc'          => __( 'PC - Home - Header - 970x90', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_home_header_on_off'
  ),
  array(
    'name'          => __( 'PC - Single - Header - 970x90', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_single_header',
    'desc'          => __( 'PC - Single - Header - 970x90', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_single_header_on_off'
  ),
  array(
    'name'          => __( 'PC - Home - Top right 1 - 300x250', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_home_right1',
    'desc'          => __( 'PC - Home - Top right 1 - 300x250', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_home_right1_on_off'
  ),
  array(
    'name'          => __( 'PC - Home - Top right 2 - 300x250', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_home_right2',
    'desc'          => __( 'PC - Home - Top right 2 - 300x250', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_home_right2_on_off'
  ),
  array(
    'name'          => __( 'PC - Home - Mid Content - 728x90', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_home_mid_content',
    'desc'          => __( 'PC - Home - Mid Content - 728x90', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_home_mid_content_on_off'
  ),
  array(
    'name'          => __( 'SP - Home - Mid Content - 300x250', 'yeunoitro' ),
    'id'            => 'cmp_ads_sp_home_mid_content',
    'desc'          => __( 'SP - Home - Mid Content - 300x250', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_sp_home_mid_content_on_off'
  ),
  array(
    'name'          => __( 'SP - Home - Mid Content 2 - 300x250', 'yeunoitro' ),
    'id'            => 'cmp_ads_sp_home_mid_content_2',
    'desc'          => __( 'SP - Home - Mid Content 2 - 300x250', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_sp_home_mid_content_2_on_off'
  ),
  array(
    'name'          => __( 'PC - Detail - Bottom content - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_detail_bottom_content',
    'desc'          => __( 'PC - Detail - Bottom content - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_detail_bottom_content_on_off'
  ),
  array(
    'name'          => __( 'PC - Detail - Bottom content 2 (dưới mục "Có thể bạn quan tâm")', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_detail_bottom_content2',
    'desc'          => __( 'PC - Detail - Bottom content 2 (dưới mục "Có thể bạn quan tâm")', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_detail_bottom_content2_on_off'
  ),
  array(
    'name'          => __( 'SP - Detail - Bottom content 2 (dưới mục "Có thể bạn quan tâm")', 'yeunoitro' ),
    'id'            => 'cmp_ads_sp_detail_bottom_content2',
    'desc'          => __( 'SP - Detail - Bottom content 2 (dưới mục "Có thể bạn quan tâm")', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_sp_detail_bottom_content2_on_off'
  ),
  array(
    'name'          => __( 'PC - Detail - Top right 1 - 300x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_detail_right1',
    'desc'          => __( 'PC - Detail - Top right 1 - 300x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_detail_right1_on_off'
  ),
  array(
    'name'          => __( 'PC - Detail - Top right 2 - Bottom By ANTS - 300x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_detail_right2',
    'desc'          => __( 'PC - Detail - Top right 2 - Bottom By ANTS - 300x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_detail_right2_on_off'
  ),
  array(
    'name'          => __( 'PC - Cate - Mid content - 728x90', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_cate_mid_content',
    'desc'          => __( 'PC - Cate - Mid content - 728x90', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_cate_mid_content_on_off'
  ),
  array(
    'name'          => __( 'PC - Cate - Right 1 - 300x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_cate_right1',
    'desc'          => __( 'PC - Cate - Right 1 - 300x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_cate_right1_on_off'
  ),
  array(
    'name'          => __( 'PC - Tag - Right 1 - 300x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_tag_right1',
    'desc'          => __( 'PC - Tag - Right 1 - 300x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_tag_right1_on_off'
  ),
  array(
    'name'          => __( 'PC - Tag - Mid content - 728x90', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_tag_mid_content',
    'desc'          => __( 'PC - Tag - Mid content - 728x90', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_tag_mid_content_on_off'
  ),
  array(
    'name'          => __( 'PC - Series - Right 1 - 300x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_series_right1',
    'desc'          => __( 'PC - Series - Right 1 - 300x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_series_right1_on_off'
  ),
  array(
    'name'          => __( 'PC - Series - Mid content - 728x90', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_series_mid_content',
    'desc'          => __( 'PC - Series - Mid content - 728x90', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_series_mid_content_on_off'
  ),
  array(
    'name'          => __( 'PC - Search - Top right - 300x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_search_top_right',
    'desc'          => __( 'PC - Search - Top right - 300x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_search_top_right_on_off'
  ),
  array(
    'name'          => __( 'PC - Search - In content - 336x280', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_search_in_content',
    'desc'          => __( 'PC - Search - In content - 336x280', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_search_in_content_on_off'
  ),
  array(
    'name'          => __( 'PC - Home floating - 160x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_home_floating',
    'desc'          => __( 'PC - Home floating - 160x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_home_floating_on_off'
  ),
  array(
    'name'          => __( 'PC - Details floating - 160x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_details_floating',
    'desc'          => __( 'PC - Details floating - 160x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_details_floating_on_off'
  ),
  array(
    'name'          => __( 'PC - Category floating - 160x600', 'yeunoitro' ),
    'id'            => 'cmp_ads_pc_category_floating',
    'desc'          => __( 'PC - Category floating - 160x600', 'yeunoitro' ),
    'sub_option_id' => 'cmp_ads_pc_category_floating_on_off'
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
              <em style="font-weight: 500"><?php echo $option[ 'id' ] ?></em><br>
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
      if ( $id && ! strpos( $id, 'cmp_ads' ) ) {
        $id = 'cmp_ads_' . $id;
      }

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