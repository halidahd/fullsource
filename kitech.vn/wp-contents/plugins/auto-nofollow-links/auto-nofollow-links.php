<?php
/**
 * Plugin Name: Auto NoFollow Links
 * Plugin URI:  http://wpextends.sinaapp.com/plugins/auto-nofollow-links.html
 * Description: Auto NoFollow Links adds nofollow attribute to all external links in your blog posts automatically. 
 * Author:      WPExtends Team
 * Version:     1.2.8
 * Author URI:  http://wpextends.sinaapp.com
 */

function auto_nofollow_links_the_content($content) {
	return preg_replace_callback('|<a (.+?)>|i', 'auto_nofollow_links_callback', $content);
}

function auto_nofollow_links_callback($matches) {
	$text = $matches[1];

	$wpanl_options = get_option('wpanl_options');
	if ($wpanl_options['nofollow']) {
		$site_url = get_option('siteurl');
		if (strpos($text, 'http://') && strpos($text, $site_url) === false) {
			if (strpos($text, 'follow') === false) {				
				$text .= ' rel="nofollow"';
			}
		}
	}
	if ($wpanl_options['newwindow']) {	
		if (strpos($text, 'target') === false) {				
			$text .= ' target="_blank"';
		}
	}
	return "<a $text>";
}

function auto_nofollow_links_activate() {
	$wpanl_options = get_option('wpanl_options');
	$wpanl_options['nofollow'] = true;
	$wpanl_options['newwindow'] = true;
	update_option('wpanl_options', $wpanl_options);	
}

function auto_nofollow_links_deactivate() {}

add_action('the_content', 'auto_nofollow_links_the_content');
add_action('get_comment_text', 'auto_nofollow_links_the_content');
add_action('get_comment_author_url_link', 'auto_nofollow_links_the_content');
//add_action('get_comment_author_link', 'auto_nofollow_links_the_content');
//add_action('widget_content', 'auto_nofollow_links_the_content');

register_activation_hook(__FILE__, 'auto_nofollow_links_activate');
register_deactivation_hook(__FILE__, 'auto_nofollow_links_deactivate');
	
include 'auto-nofollow-links-admin.php';
?>