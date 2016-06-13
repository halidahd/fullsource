<?php
/**
 * Provides a notification everytime the theme is updated
 * Original code courtesy of João Araújo of Unisphere Design - http://themeforest.net/user/unisphere

 */
function update_notifier_menu() {

	$xml = get_latest_theme_version( 604800 ); // This tells the function to cache the remote call for 604800 seconds (7 days)

	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' ); // Get theme data from style.css (current version is what we want)

	if ( version_compare( $theme_data['Version'], $xml->latest ) == - 1 ) {

		add_dashboard_page( $theme_data['Name'] . 'Theme Updates ', '&nbsp;<span class="update-plugins count-2"><span class="update-count">New Theme Update</span></span>', 'administrator', 'm3-updates', update_notifier );

	}

}

add_action( 'admin_menu', 'update_notifier_menu' );


function update_notifier() {

	$xml = get_latest_theme_version( 21600 ); // This tells the function to cache the remote call for 21600 seconds (6 hours)

	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' ); // Get theme data from style.css (current version is what we want)
	?>



	<style>

		.update-nag {
			display: none;
		}

		#instructions {
			max-width: 800px;
		}

		h3.title {
			margin: 30px 0 0 0;
			padding: 30px 0 0 0;
			border-top: 1px solid #ddd;
		}

	</style>

	<style type="text/css">

		.changelogcss {
			font: 400 14px/22px Georgia, serif;
			color: #333;
			width: 805px;
		}

		.changelogcss h1 {
			font-family: Georgia, serif;
			font-size: 26px;
			font-weight: 400;
			border-bottom: 1px dotted #ccc;
			padding: 20px 0 5px 0;
			color: #333;
		}

		.changelogcss h2 {
			font-family: Georgia, serif;
			font-size: 18px;
			font-weight: 400;
			border-bottom: 1px dotted #ccc;
			padding: 20px 0 0px 0;
			color: #333;
		}

		.changelogcss h2 span {
			background: #555555;
			color: #FFFFFF !important;
			float: right;
			font-family: Georgia, serif;
			font-size: 12px;
			font-weight: bold;
			padding: 0 12px;
			text-shadow: none;
		}

		.changelogcss strong {
			font-weight: 400;
			color: #000;
			font-style: italic;
			padding-bottom: 1px;
			border-bottom: 1px solid #ccc;
		}

		.changelogcss em {
			color: #000;
			font-style: normal;
			padding: 1px 4px 2px;
			border-bottom: 1px dotted #ccc;
			background-color: #f1f0cf;
			text-shadow: 0 1px 0 #fff;
			cursor: default;
		}

		.changelogcss a {
			outline: none;
			color: #53769a;
		}

		.changelogcss .wrapper {
			width: 650px;
			margin: 20px auto;
		}

		.changelogcss xmp {
			background-color: #f4f4f4;
			border-width: 1px 0;
			border-style: dotted;
			border-color: #ccc;
			padding: 2px 5px;
			font-size: 12px;
			text-shadow: 0 1px 0 #fff;
		}

		.changelogcss ol {
			float: left;
			width: 100%;
			margin: 0 0 25px 40px;
		}

		.changelogcss li {
			padding: 0;
			float: left;
			width: auto;
			clear: left;
			margin-bottom: 5px;
		}

	</style>



	<div class="wrap">


		<div id="icon-tools" class="icon32"></div>

		<h2><?php echo $theme_data['Name']; ?> Theme Updates</h2>

		<div id="message" class="updated below-h2"><p><strong>There is a new version of
					the <?php echo $theme_data['Name']; ?> theme available.</strong> You have
				version <?php echo $theme_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.
			</p></div>


		<img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;"
			 src="<?php echo get_bloginfo( 'template_url' ) . '/screenshot.png'; ?>"/>


		<div id="instructions" style="max-width: 800px;">

			<h3>Update Download and Instructions</h3>

			<p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress
				installation folder <strong>/wp-content/themes/<?php echo strtolower( $theme_data['Name'] ); ?>
					/</strong></p>

			<p><a href="http://magazine3.com/update-instructions"><b>Read the instructions on How to Update the
						theme.</b></a></p>

		</div>


		<div class="clear"></div>


		<div class="changelogcss wrapper">

			<h1>Change Logs</h1>

			<?php echo $xml->changelog; ?></div>


	</div>



<?php
}


// This function retrieves a remote xml file on my server to see if there's a new update 

// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)

function get_latest_theme_version( $interval ) {

	// remote xml file location 

	$notifier_file_url = 'http://magazine3.com/updates/topgadget.xml';

	$db_cache_field = 'contempo-notifier-cache';

	$db_cache_field_last_updated = 'contempo-notifier-last-updated';

	$last = get_option( $db_cache_field_last_updated );

	$now = time();

	// check the cache

	if ( ! $last || ( ( $now - $last ) > $interval ) ) {

		// cache doesn't exist, or is old, so refresh it

		if ( function_exists( 'curl_init' ) ) { // if cURL is available, use it...

			$ch = curl_init( $notifier_file_url );

			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

			curl_setopt( $ch, CURLOPT_HEADER, 0 );

			curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );

			$cache = curl_exec( $ch );

			curl_close( $ch );

		} else {

			$cache = file_get_contents( $notifier_file_url ); // ...if not, use the common file_get_contents()

		}


		if ( $cache ) {

			// we got good results

			update_option( $db_cache_field, $cache );

			update_option( $db_cache_field_last_updated, time() );

		}

		// read from the cache file

		$notifier_data = get_option( $db_cache_field );

	} else {

		// cache file is fresh enough, so read from it

		$notifier_data = get_option( $db_cache_field );

	}


	$xml = simplexml_load_string( $notifier_data );

	return $xml;
}