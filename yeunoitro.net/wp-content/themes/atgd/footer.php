<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package atgd
 */
?>
</div>
<?php
if(is_home()):
?>
  <div class="home-floating-left floating-left floating-ads">
    <?php cmp_ads("pc_home_floating"); ?>
  </div>
<!--  <div class="home-floating-right floating-right floating-ads">-->
<!--    --><?php //cmp_ads("pc_home_floating"); ?>
<!--  </div>-->
<?php
elseif(is_single()):
?>
  <div class="details-floating-left floating-left floating-ads">
    <?php cmp_ads("pc_details_floating"); ?>
  </div>
<!--  <div class="details-floating-right floating-right floating-ads">-->
<!--    --><?php //cmp_ads("pc_details_floating"); ?>
<!--  </div>-->
<?php
else:
?>
  <div class="cate-floating-left floating-left floating-ads">
    <?php cmp_ads("pc_category_floating"); ?>
  </div>
<!--  <div class="cate-floating-right floating-right floating-ads">-->
<!--    --><?php //cmp_ads("pc_category_floating"); ?>
<!--  </div>-->
<?php
endif;
?>

</div>
<div class="footer">
	<div class="container">
		<div class="_bd">
			<div class="col-xs-3 no-padding">
				<?php dynamic_sidebar('footer1'); ?>
			</div>
			<div class="col-xs-3 no-padding">
				<?php dynamic_sidebar('footer2'); ?>
			</div>
			<div class="col-xs-3 no-padding bottom-20">
				<?php dynamic_sidebar('footer3'); ?>
			</div>
			<div class="col-xs-3 no-padding">
				<?php dynamic_sidebar('footer4'); ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php dynamic_sidebar('footer5'); ?>
	</div>
</div>

<?php wp_footer(); ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap-hover.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/atgd.js"></script>

<!-- BEGIN TAG - DO NOT MODIFY -->
<script type="text/javascript">
	//<![CDATA[
	blueseed_key = "dd66dfcad499bd60280c63d58c7de252";
	blueseed_channel = "";
	blueseed_code_format = "ads-sync.js";
	blueseed_ads_host = "//blueserving.com";
	blueseed_click = "";
	blueseed_custom_params = {};

	document.write("<script type='text\/javascript' src='"+(location.protocol == 'https:' ? 'https:' : 'http:') + "//blueserving.com\/js/show_ads_blueseed.js'><\/script>");
	//]]>
</script>
<!-- END TAG -->
<!-- BEGIN TAG - DO NOT MODIFY -->
<script type="text/javascript">
	/*<![CDATA[*/
	blueseed_key = "94759ba81b0885b8137807bb37b7ec49";
	blueseed_channel = "";
	blueseed_code_format = "ads-sync.js";
	blueseed_ads_host = "//blueserving.com";
	blueseed_click = "";
	blueseed_custom_params = {};

	document.write("<script type='text\/javascript' src='"+(location.protocol == 'https:' ? 'https:' : 'http:') + "//blueserving.com\/js/show_ads_blueseed.js?pubId=1939'><\/script>");
	/*]]>*/
</script>
<!-- END TAG -->

<?php //if(is_home()): ?>
  <!-- BEGIN TAG - DO NOT MODIFY -->
  <script type="text/javascript" src="http://lab.blueserving.com/libs/tool/bs_targetKeyword.js"></script>
  <script type="text/javascript">
    /*<![CDATA[*/
    blueseed_key = "576d5ac8ebb14ecb47024db6579c43ff";
    blueseed_time = new Date().getTime();
    blueseed_channel = "";
    blueseed_code_format = "ads-sync.js";
    blueseed_click = "";
    blueseed_custom_params = {channel:bs_lib_keyword.getDomain()};
    console.log(blueseed_custom_params);

    /*]]>*/
  </script>
  <script type='text/javascript' src='//blueserving.com/js/show_ads_blueseed.js?pubId=2259'></script>
  <!-- END TAG -->
<?php //endif;?>
</body>
</html>