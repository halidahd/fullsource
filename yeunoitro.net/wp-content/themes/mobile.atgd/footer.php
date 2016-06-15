<!--menu search -->
<div id="footer" class="footer">
	<?php static_footer_info(); ?>
</div>
<div class="clearContent"></div>
</div>
<?php wp_footer(); ?>
</div>
<!-- End Container -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/atgd.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/custom.js"></script>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/responsive.css" />
<script>
	$( document ).ready( function ()
	{

		$( ".menu-dmn" ).mCustomScrollbar(
			{
				setWidth           : "75 %",
				scrollInertia      : 1000,
				autoHideScrollbar  : true,
				autoExpandScrollbar: false,
				scrollbarPosition  : "outside"
			}
		);
		$( ".menu-search" ).mCustomScrollbar(
			{
				scrollInertia      : 1000,
				autoHideScrollbar  : true,
				autoExpandScrollbar: false,
				scrollbarPosition  : "outside"
			}
		);
	} );
</script>
</body>
</html>