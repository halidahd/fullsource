<?php

add_action('admin_menu', 'auto_nofollow_links_menu');

function auto_nofollow_links_menu() {
	add_options_page('Auto Nofollow Links', 'Auto Nofollow Links', 'manage_options', __FILE__, 'auto_nofollow_links_setting_page');
	add_action('admin_init', 'auto_nofollow_links_init');
}

function auto_nofollow_links_init() {
	register_setting('wpanl_settings_fields', 'wpanl_options');
}

function auto_nofollow_links_setting_page() {
	$wpanl_options = get_option('wpanl_options');
?>
<style>
.postbox{
	margin: 15px 0px; 
	font-size: 1.1em;
	width: 60%;
}
.h10 {
	overflow: hidden;
	height: 8px;
}
</style>
<div class="wrap">
    <div class="metabox-holder">

      	<h2>Auto Nofollow Links</h2>

        <div class="postbox">
         	<h3>Settings</h3>
         	<div class="inside">
	         	<form method="post" action="options.php">
	         		<?php settings_fields('wpanl_settings_fields'); ?>
	         		
	         		<div class="h10"></div>
	         		<?php if ($wpanl_options['nofollow']) {?>
					<input id="nofollow" name="wpanl_options[nofollow]" checked="checked" type="checkbox"/>
					<?php } else { ?>
					<input id="nofollow" name="wpanl_options[nofollow]" type="checkbox"/>
					<?php } ?>
					Add rel="nofollow" to all external links.		
	         		<div class="h10"></div>
					
	         		<?php if ($wpanl_options['newwindow']) {?>
					<input id="newwindow" name="wpanl_options[newwindow]" checked="checked" type="checkbox"/>
					<?php } else { ?>
					<input id="newwindow" name="wpanl_options[newwindow]" type="checkbox"/>
					<?php } ?>				
					Add target="_blank", Open external links in new window or tab.			
					<div class="h10"></div>
					<div class="h10"></div>
					
	              	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	              	<br/>
					<br/>
	       		</form>
       		</div>
        </div>
         		

        <div>
			<h4>For more infomation</h4>
			Plugin URI: <a href="http://wpextends.sinaapp.com/plugins/auto-nofollow-links.html" target="_blank">http://wpextends.sinaapp.com/plugins/auto-nofollow-links.html</a><br/>
			Our Website:<a href="http://wpextends.sinaapp.com" target="_blank">http://wpextends.sinaapp.com</a><br/>
	        <div class="h10"></div>
	        Please contact us at <a href="mailto:support@wordpressextends.com">support@wordpressextends.com</a> whenever you have any questions and comments.
        </div>		
        <div class="h10"></div>   
        
        <div>
          	<h4>Like this plugin? We need your help to make it better:</h4>
          	<ul>
        		<li>Write a positive review.</li>
        		<li>Tell us some improvements.</li>
          		<li>If you’d like to donate...</li>
          	</ul>
          	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_donations">
				<input type="hidden" name="business" value="market@wordpressextends.com">
				<input type="hidden" name="item_name" value="Auto Nofollow Links plugin for Wordpress">
				<input type="hidden" name="currency_code" value="USD">
				<!-- <input type="hidden" name="notify_url" value="link to IPN script"> -->				
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
			</form>
			<p>Your support shows that what we’re doing really matters and help this plugin to move forward! Thank you.</p>
        </div>
        <div class="h10"></div>   
    </div>
</div>
<?php } ?>