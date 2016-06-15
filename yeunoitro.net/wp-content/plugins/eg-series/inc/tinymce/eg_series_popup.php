<?php

//Load bootstrap file
require_once( dirname( dirname( dirname(__FILE__) ) ) .'/eg-series-bootstrap.php');

if (! defined('EGS_TEXTDOMAIN'))
	require_once( dirname( dirname( __FILE__) ).'/eg-series-common.inc.php');

//Check for rights
if (!is_user_logged_in() || (!current_user_can('edit_posts') &&
	!current_user_can('edit_pages') && !current_user_can('edit_topics') && !current_user_can('edit_replies')))
	wp_die(esc_html__('You are not allowed to access this file.', EGS_TEXTDOMAIN));

$egs_options = get_option(EGS_OPTIONS_ENTRY);
global $EGS_SHORTCODE_SERIES_DEFAULTS;
$serie_default_values = $EGS_SHORTCODE_SERIES_DEFAULTS;

global $EGS_SHORTCODE_POSTS_DEFAULTS;
if (! $egs_options['shortcode_auto_default_opts']) {
	$post_default_values = $EGS_SHORTCODE_POSTS_DEFAULTS;
}
else {
	$post_shortcode_values = wp_parse_args(array (
		'title'	    => $egs_options['shortcode_auto_title'],
		'titletag'  => $egs_options['shortcode_auto_title_tag'],
		'listtype'  => $egs_options['shortcode_auto_listtype'],
		'orderby'   => $egs_options['shortcode_auto_orderby'],
		'order'	    => $egs_options['shortcode_auto_order'],
		'show_date' => $egs_options['shortcode_auto_show_date'],
		'expand' 	=> $egs_options['shortcode_auto_expand']),
		$EG_SERIES_SHORTCODE_POSTS_DEFAULTS
	);
}

$list = EG_Series_Common::get_series_list($egs_options);
$series_list = array();
if ($list && sizeof($list)>0) {
	foreach ($list as $id => $value) {
		$series_list[$id] = $value->name;
	}
}

if (isset($_REQUEST['post_id'])) {
	$current_serie = EG_Series_Common::get_the_serie(0, '', absint($_REQUEST['post_id']));
	if ($current_serie) {
		$post_default_values['sid'] = $current_serie->term_id;
	}
}

$select_fields = array(
	'listtype' 	=> array(
		'select' 		=> __('Select',			EGS_TEXTDOMAIN ),
		'ul'     		=> __('Simple list',	EGS_TEXTDOMAIN ),
		'ol'    		=> __('Ordered list',	EGS_TEXTDOMAIN )
	),
	'orderby' => array(
		 'date' 		=> __('Date',			EGS_TEXTDOMAIN ),
		 'title' 		=> __('Title',    		EGS_TEXTDOMAIN ),
		 'menu_order' 	=> __('User order',		EGS_TEXTDOMAIN )
	),
	'order' => array(
		 'ASC' 			=> __('Ascending',		EGS_TEXTDOMAIN ),
		 'DESC' 		=> __('descending',    	EGS_TEXTDOMAIN ),
	),
	'post_orderby' => array(
		 'date' 		=> __('Date',			EGS_TEXTDOMAIN ),
		 'title' 		=> __('Title',    		EGS_TEXTDOMAIN ),
		 'menu_order' 	=> __('User order',		EGS_TEXTDOMAIN )
	),
	'post_order' => array(
		 'ASC' 			=> __('Ascending',		EGS_TEXTDOMAIN ),
		 'DESC' 		=> __('descending',    	EGS_TEXTDOMAIN ),
	),
	'sid'				=> $series_list
);

function get_select($html_id, $key, $current_values, $default_values, $blank_value=FALSE) {
	global $select_fields;

	$string = '<select id="'.$html_id.'" name="'.$html_id.'">';
	if ($blank_value)
		$string .= '<option value=""> </option>';
	foreach ($select_fields[$key] as $id => $value) {
		$selected = ($current_values[$key] == $id ? 'selected' : '');
		$string .= '<option value="'.$id.'" '.$selected.'>'.$value.'</option>';
	}
	$string .= '</select>'."\n".'<input type="hidden" name="'.$html_id.'_def" id="'.$html_id.'_def" value="'.$default_values[$key].'" />';
	return $string;
} // End of get_select

?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>EG-Series shortcode</title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />

	<base target="_self" />

    <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript">

		function toggle_visibility(obj) {
			if (obj.checked) {
				document.getElementById("egseries-showposts").style.display = "block";
			} else {
				document.getElementById("egseries-showposts").style.display = "none";
			}	
		}
	
		function init() {
			tinyMCEPopup.resizeToInnerSize();
		}

		function insertEGSeriesShortCode() {

			if (series_panel.className.indexOf('current') != -1) {

				var shortcode_tag	    = document.getElementById('serie_shortcode_tag').value;

				var order_prefix        = 'post_';
				var title 				= document.getElementById('serie_title').value;
				var title_def 		 	= document.getElementById('serie_title_def').value;
				var titletag 			= document.getElementById('serie_titletag').value;
				var titletag_def 		= document.getElementById('serie_titletag_def').value;
				var listtype 			= document.getElementById('serie_listtype').value;
				var listtype_def		= document.getElementById('serie_listtype_def').value;
				var number				= parseInt(document.getElementById('serie_number').value);
				var number_def			= parseInt(document.getElementById('serie_number_def').value);
				var more				= parseInt(document.getElementById('serie_more').value);
				var more_def			= parseInt(document.getElementById('serie_more_def').value);
				var hide_empty			= document.getElementById('serie_hide_empty');
				var hide_empty_def		= parseInt(document.getElementById('serie_hide_empty_def').value);
				var show_count			= document.getElementById('serie_show_count');
				var show_count_def		= parseInt(document.getElementById('serie_show_count_def').value);
				var width				= parseInt(document.getElementById('serie_width').value);
				var width_def			= parseInt(document.getElementById('serie_width_def').value);
				var description			= document.getElementById('serie_description');
				var description_def		= parseInt(document.getElementById('serie_description_def').value);
				var listposts			= document.getElementById('serie_listposts');
				var listposts_def		= parseInt(document.getElementById('serie_listposts_def').value);
				var orderby 			= document.getElementById('serie_orderby').value;
				var orderby_def			= document.getElementById('serie_orderby_def').value;
				var order 				= document.getElementById('serie_order').value;
				var order_def			= document.getElementById('serie_order_def').value;
				var show_date			= document.getElementById('serie_show_date');
				var show_date_def		= parseInt(document.getElementById('serie_show_date_def').value);
				var expand				= document.getElementById('serie_expand');
				var expand_def			= parseInt(document.getElementById('serie_expand_def').value);
				var numposts			= parseInt(document.getElementById('serie_numposts').value);
				var numposts_def		= parseInt(document.getElementById('serie_numposts_def').value);
			}

			if (posts_panel.className.indexOf('current') != -1) {

				var shortcode_tag	    = document.getElementById('post_shortcode_tag').value;

				var order_prefix        = '';
				var sid 				= document.getElementById('post_sid').value;
				var sid_def				= document.getElementById('post_sid_def').value;
				var title 				= document.getElementById('post_title').value;
				var title_def 		 	= document.getElementById('post_title_def').value;
				var titletag 			= document.getElementById('post_titletag').value;
				var titletag_def 		= document.getElementById('post_titletag_def').value;
				var listtype 			= document.getElementById('post_listtype').value;
				var listtype_def		= document.getElementById('post_listtype_def').value;
				var orderby 			= document.getElementById('post_orderby').value;
				var orderby_def			= document.getElementById('post_orderby_def').value;
				var order 				= document.getElementById('post_order').value;
				var order_def			= document.getElementById('post_order_def').value;
				var show_date			= document.getElementById('post_show_date');
				var show_date_def		= parseInt(document.getElementById('post_show_date_def').value);
				var expand				= document.getElementById('post_expand');
				var expand_def			= parseInt(document.getElementById('post_expand_def').value);
				var width				= parseInt(document.getElementById('post_width').value);
				var width_def			= parseInt(document.getElementById('post_width_def').value);
				var numposts			= parseInt(document.getElementById('post_numposts').value);
				var numposts_def		= parseInt(document.getElementById('post_numposts_def').value);
			}

			var shortcode = "[" + shortcode_tag;

			if (sid != sid_def)
				shortcode = shortcode + ' sid=' + sid;

			if (title != title_def)
				shortcode = shortcode + ' title="' + title + '"';

			if (titletag != titletag_def)
				shortcode = shortcode + ' titletag="' + titletag + '"';

			if (listtype != listtype_def)
				shortcode = shortcode + ' listtype=' + listtype;

			if (! isNaN(number) && number != number_def)
				shortcode = shortcode + ' number=' + number;

			if (! isNaN(more) && more != more_def)
				shortcode = shortcode + ' more=' + more;

			if (typeof listposts != "undefined") {
				if (listposts.checked) listposts_value=1;
				else listposts_value=0;
				if (listposts_value != listposts_def)
					shortcode = shortcode + ' listposts=' + listposts_value;
			}

			if (typeof hide_empty != "undefined") {
				if (hide_empty.checked) hide_empty_value=1;
				else hide_empty_value=0;
				if (hide_empty_value != hide_empty_def)
					shortcode = shortcode + ' hide_empty=' + hide_empty_value;
			}

			if (typeof show_count != "undefined") {
				if (show_count.checked) show_count_value=1;
				else show_count_value=0;
				if (show_count_value != show_count_def)
					shortcode = shortcode + ' show_count=' + show_count_value;
			}

			if (! isNaN(width) && width != width_def)
				shortcode = shortcode + ' width=' + width;


			if (typeof description != "undefined") {
				if (description.checked) description_value=1;
				else description_value=0;
				if (description_value != description_def)
					shortcode = shortcode + ' description=' + description_value;
			}

			if (orderby != orderby_def)
				shortcode = shortcode + ' ' + order_prefix + 'orderby=' + orderby;

			if (order != order_def)
				shortcode = shortcode + ' ' + order_prefix + 'order=' + order;

//			if (typeof show_date != "undefined") {
				if (show_date.checked) show_date_value=1;
				else show_date_value=0;
				if (show_date_value != show_date_def)
					shortcode = shortcode + ' show_date=' + show_date_value;
//			}

//			if (typeof expand != "undefined") {
				if (expand.checked) expand_value=1;
				else expand_value=0;
				if (expand_value != expand_def)
					shortcode = shortcode + ' expand=' + expand_value;
//			}

			var shortcode = shortcode + "]";
			// EGE - 2.1.1 - Run with TinyMCE 3.x and 4.x
			if(window.tinyMCE) {
				window.tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
				// window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcode);
			}
			tinyMCEPopup.close();
			return;

		} // End of insertEGSeriesShortCode
	</script>
	<style type='text/css'>
		span.description {  font-size: 90%; font-style: italic; }
	</style>
  </head>
  <body onload="tinyMCEPopup.executeOnLoad('init();');">
	<form action="" method="post" name="egs-mcebox">
		<div class="mceActionPanel">
			<div class="tabs">
				<ul>
					<li id="posts_tab"  class="current"><span>
						<a href="javascript:mcTabs.displayTab('posts_tab','posts_panel');" onmousedown="return false;"><?php _e('Posts shortcode', EGS_TEXTDOMAIN ); ?></a>
					</span></li>
					<li id="series_tab"><span>
						<a href="javascript:mcTabs.displayTab('series_tab','series_panel');" onmousedown="return false;"><?php _e('Series shortcode', EGS_TEXTDOMAIN); ?></a>
					</span></li>
				</ul>
			</div>
			<div class="panel_wrapper" >
				<div id="posts_panel" class="panel current">
					<input type="hidden" name="post_shortcode_tag" id="post_shortcode_tag" value="<?php echo $egs_options['shortcode_list_posts']; ?>" />
					<div style="float: left; width: 48%; margin-right: 2%;" >
						<p>
							<label for="post_sid"><strong><?php _e('Serie: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<?php echo get_select('post_sid', 'sid', $post_default_values, $post_default_values); ?>
						</p>
						<p>
							<label for="post_title"><strong><?php _e('Title: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="post_title" name="post_title" type="text" value="<?php echo $post_default_values['title']; ?>" />
							<input type="hidden" name="post_title_def" id="post_title_def" value="<?php echo $post_default_values['title']; ?>" />
						</p>
						<p>
							<label for="post_titletag"><strong><?php _e('HTML Tag for title: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="post_titletag" name="post_titletag" type="text" value="<?php echo $post_default_values['titletag']; ?>" />
							<input type="hidden" name="post_titletag_def" id="post_titletag_def" value="<?php echo $post_default_values['titletag']; ?>" />
						</p>
						<p>
							<label for="post_typelist"><strong><?php _e('Format: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<?php echo get_select('post_listtype', 'listtype', $post_default_values, $post_default_values); ?>
						</p>
						<p>
							<label for="post_orderby"><strong><?php _e('Sort key: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<?php echo get_select('post_orderby', 'orderby', $post_default_values, $post_default_values); ?>
						</p>
						<p>
							<label for="post_order"><strong><?php _e('Sort order: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<?php echo get_select('post_order', 'order', $post_default_values, $post_default_values); ?>
						</p>
					</div>
					<div style="float: left; width: 48%; margin-right: 2%;" >
						<p>
							<label for="post_width"><strong><?php _e('Lines length (shortcode width): ', EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="post_width" name="post_width" type="text" value="<?php echo $post_default_values['width']; ?>" />
							<br /><span class="description"><?php _e('Enter a number of characters, or 0 to keep posts or series title unchanged',EGS_TEXTDOMAIN); ?></span>
							<input type="hidden" name="post_width_def" id="post_width_def" value="<?php echo $post_default_values['width']; ?>" />
						</p>
						<p>
							<label for="post_numposts"><strong><?php _e('Maximum number of posts to display: ', EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="post_numposts" name="post_width" type="text" value="<?php echo $post_default_values['numposts']; ?>" />
							<br /><span class="description"><?php _e('Enter a number, or 0 to display all posts', EGS_TEXTDOMAIN); ?></span>
							<input type="hidden" name="post_numposts_def" id="post_numposts_def" value="<?php echo $post_default_values['numposts']; ?>" />
						</p>
						<p>
							<input type="hidden" name="post_show_date_def" id="post_show_date_def" value="<?php echo $post_default_values['show_date']; ?>" />
							<input type="checkbox" id="post_show_date" <?php echo ($post_default_values['show_date']>0?'checked':''); ?> />
							<label for="post_show_date"><strong><?php _e('Show post date',EGS_TEXTDOMAIN); ?></strong></label>
						</p>
						<p>
							<input type="hidden" name="post_expand_def" id="post_expand_def" value="<?php echo $post_default_values['expand']; ?>" />
							<input type="checkbox" id="post_expand" <?php echo ($post_default_values['expand']>0?'checked':''); ?> />
							<label for="post_expand"><strong><?php _e('Show post exceprt',EGS_TEXTDOMAIN); ?></strong></label>
						</p>

					</div>
				</div>
				<div id="series_panel" class="panel">
					<input type="hidden" name="serie_shortcode_tag" id="serie_shortcode_tag" value="<?php echo $egs_options['shortcode_list_series']; ?>" />
					<div style="float: left; width: 48%; margin-right: 2%;" >
						<p>
							<label for="serie_title"><strong><?php _e('Title: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="serie_title" name="serie_title" type="text" value="<?php echo $serie_default_values['title']; ?>" />
							<input type="hidden" name="serie_title_def" id="serie_title_def" value="<?php echo $serie_default_values['title']; ?>" />
						</p>
						<p>
							<label for="serie_titletag"><strong><?php _e('HTML Tag for title: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="serie_titletag" name="serie_titletag" type="text" value="<?php echo $serie_default_values['titletag']; ?>" />
							<input type="hidden" name="serie_titletag_def" id="serie_titletag_def" value="<?php echo $serie_default_values['titletag']; ?>" />
						</p>
						<p>
							<label for="serie_typelist"><strong><?php _e('Format: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<?php echo get_select('serie_listtype', 'listtype', $serie_default_values, $serie_default_values); ?>
						</p>
						<p>
							<label for="serie_number"><strong><?php _e('Maximum number of series to display:  ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="serie_number" name="serie_number" type="text" value="<?php echo $serie_default_values['number']; ?>" />
							<br /><span class="description"><?php _e('Enter a number, or 0 to diplay all series', EGS_TEXTDOMAIN); ?></span>
							<input type="hidden" name="serie_number_def" id="serie_number_def" value="<?php echo $serie_default_values['number']; ?>" />
						</p>
						<p>
							<label for="serie_more"><strong><?php _e('id of post/page to see the whole list of the series: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="serie_more" name="serie_more" type="text" value="<?php echo $serie_default_values['more']; ?>" />
							<input type="hidden" name="serie_more_def" id="serie_more_def" value="<?php echo $serie_default_values['more']; ?>" />
						</p>
						<p>
							<input type="hidden" name="serie_hide_empty_def" id="serie_hide_empty_def" value="<?php echo $serie_default_values['hide_empty']; ?>" />
							<input type="checkbox" id="serie_hide_empty" <?php echo ($serie_default_values['hide_empty']>0?'checked':''); ?> />
							<label for="serie_hide_empty"><strong><?php _e('Hide empty series',EGS_TEXTDOMAIN); ?></strong></label>
						</p>
						<p>
							<input type="hidden" name="serie_show_count_def" id="serie_show_count_def" value="<?php echo $serie_default_values['show_count']; ?>" />
							<input type="checkbox" id="serie_show_count" <?php echo ($serie_default_values['show_count']>0?'checked':''); ?> />
							<label for="serie_show_count"><strong><?php _e('Show the number of posts for each serie',EGS_TEXTDOMAIN); ?></strong></label>
						</p>
					</div>
					<div style="float: left; width: 48%;" >
						<p>
							<label for="serie_width"><strong><?php _e('Lines length: ',EGS_TEXTDOMAIN); ?></strong></label><br />
							<input id="serie_width" name="serie_width" type="text" value="<?php echo $serie_default_values['width']; ?>" />
							<br /><span class="description"><?php _e('Enter a number of characters, or 0 to keep posts or series title unchanged',EGS_TEXTDOMAIN); ?></span>
							<input type="hidden" name="serie_width_def" id="serie_width_def" value="<?php echo $serie_default_values['width']; ?>" />
						</p>
						<p>
							<input type="hidden" name="serie_description_def" id="serie_description_def" value="<?php echo $serie_default_values['description']; ?>" />
							<input type="checkbox" id="serie_description" <?php echo ($serie_default_values['description']>0?'checked':''); ?> />
							<label for="serie_description"><strong><?php _e('Show description text of series',EGS_TEXTDOMAIN); ?></strong></label>
						</p>
						<p>
							<input type="hidden" name="serie_listposts_def" id="serie_listposts_def" value="<?php echo $serie_default_values['listposts']; ?>" />
							<input type="checkbox" id="serie_listposts" <?php echo ($serie_default_values['listposts']>0?'checked':''); ?> onclick="toggle_visibility(this);" />
							<label for="serie_listposts"><strong><?php _e('Show posts',EGS_TEXTDOMAIN); ?></strong></label>
						</p>
						<div id="egseries-showposts" style="display:<?php echo ($serie_default_values['listposts']? 'block' : 'none'); ?>;">
							<p>
								<label for="serie_orderby"><strong><?php _e('Sort key: ',EGS_TEXTDOMAIN); ?></strong></label><br />
								<?php echo get_select('serie_orderby', 'post_orderby', $serie_default_values, $serie_default_values); ?>
							</p>
							<p>
								<label for="serie_order"><strong><?php _e('Sort order: ',EGS_TEXTDOMAIN); ?></strong></label><br />
								<?php echo get_select('serie_order', 'post_order', $serie_default_values, $serie_default_values); ?>
							</p>
							<p>
								<label for="serie_numposts"><strong><?php _e('Maximum number of posts to display: ',EGS_TEXTDOMAIN); ?></strong></label><br />
								<input id="serie_numposts" name="serie_numposts" type="text" value="<?php echo $serie_default_values['numposts']; ?>" /><br /><span class="description"><?php _e('Enter a number, or 0 to display all posts',EGS_TEXTDOMAIN); ?></span>
								<input type="hidden" name="serie_numposts_def" id="serie_numposts_def" value="<?php echo $serie_default_values['numposts']; ?>" />
							</p>
							<p>
								<input type="hidden" name="serie_show_date_def" id="serie_show_date_def" value="<?php echo $serie_default_values['show_date']; ?>" />
								<input type="checkbox" id="serie_show_date" <?php echo ($serie_default_values['show_date']>0?'checked':''); ?> />
								<label for="serie_show_date"><strong><?php _e('Show post date',EGS_TEXTDOMAIN); ?></strong></label>
							</p>
							<p>
								<input type="hidden" name="serie_expand_def" id="serie_expand_def" value="<?php echo $serie_default_values['expand']; ?>" />
								<input type="checkbox" id="serie_expand" <?php echo ($serie_default_values['expand']>0?'checked':''); ?> />
								<label for="serie_expand"><strong><?php _e('Show post exceprt',EGS_TEXTDOMAIN); ?></strong></label>
							</p>
						</div>
					</div>
					<br style="clear: both;" />
			</div>
				<br style="clear: both;" />
			</div>
		</div>
		<div class="mceActionPanel">
			<div style="float: left">
				<input type="submit" id="insert" name="insert" value="<?php _e('Insert', EGS_TEXTDOMAIN); ?>" onclick="insertEGSeriesShortCode();" />
			</div>
			<div style="float: right">
				<input type="button" id="cancel" name="cancel" value="<?php _e('Cancel', EGS_TEXTDOMAIN); ?>" onclick="tinyMCEPopup.close();" />
			</div>
			<br style="clear: both;" />
		</div>
	</form>
  </body>
</html>