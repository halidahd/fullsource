<?php
/**
 * Dummy module return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */

$__psp_video_include = array(
	'localhost'			=> 'Self Hosted'
	,'blip'				=> 'Blip.tv'
	,'dailymotion'		=> 'Dailymotion.com'
	,'dotsub'			=> 'Dotsub.com'
	,'flickr'			=> 'Flickr.com'
	,'metacafe'			=> 'Metacafe.com'
	,'screenr'			=> 'Screenr.com'
	,'veoh'				=> 'Veoh.com'
	,'viddler'			=> 'Viddler.com'
	,'vimeo'			=> 'Vimeo.com'
	,'vzaar'			=> 'Vzaar.com'
	,'youtube'			=> 'Youtube.com'
	,'wistia'			=> 'Wistia.com'
);

function psp_postTypes_priority() {
	global $psp;

	ob_start();
	
	$post_types = get_post_types(array(
		'public'   => true
	));
	//$post_types['attachment'] = __('Images', $this->the_plugin->localizationName);
	//unset media - images | videos are treated as belonging to post, pages, custom post types
	unset($post_types['attachment'], $post_types['revision']);
	
	$options = $psp->get_theoption('psp_sitemap');
?>
<div class="psp-form-row">
	<label><?php _e('Posts', $psp->localizationName); ?></label>
	<div class="psp-form-item large">
	<span class="formNote">&nbsp;</span>
	<?php
	foreach ($post_types as $key => $value){
		$val = '';
		if( isset($options['priority']) && isset($options['priority'][$key]) ){
			$val = $options['priority'][$key];
		}
		?>
		<label for="priority[<?php echo $key;?>]" style="display:inline;float:none;"><?php echo ucfirst(str_replace('_', ' ', $value));?>:</label>
		&nbsp;
		<select id="priority[<?php echo $key;?>]" name="priority[<?php echo $key;?>]" style="width:60px;">
			<?php
			foreach (range(0, 1, 0.1) as $kk => $vv){
				echo '<option value="' . ( $vv ) . '" ' . ( $val == $vv ? 'selected="true"' : '' ) . '>' . ( $vv ) . '</option>';
			} 
			?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
	} 
	?>
	</div>
</div>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
} 

function psp_postTypes_changefreq() {
	global $psp;

	ob_start();
	
	$post_types = get_post_types(array(
		'public'   => true
	));
	//$post_types['attachment'] = __('Images', $this->the_plugin->localizationName);
	//unset media - images | videos are treated as belonging to post, pages, custom post types
	unset($post_types['attachment'], $post_types['revision']);
	
	$options = $psp->get_theoption('psp_sitemap');
?>
<div class="psp-form-row">
	<label><?php _e('Posts', $psp->localizationName); ?></label>
	<div class="psp-form-item large">
	<span class="formNote">&nbsp;</span>
	<?php
	foreach ($post_types as $key => $value){
		
		$val = '';
		if( isset($options['changefreq']) && isset($options['changefreq'][$key]) ){
			$val = $options['changefreq'][$key];
		}
		?>
		<label for="changefreq[<?php echo $key;?>]" style="display:inline;float:none;"><?php echo ucfirst(str_replace('_', ' ', $value));?>:</label>
		&nbsp;
		<select id="changefreq[<?php echo $key;?>]" name="changefreq[<?php echo $key;?>]" style="width:120px;">
			<?php
			foreach (array('always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never') as $kk => $vv){
				echo '<option value="' . ( $vv ) . '" ' . ( $val == $vv ? 'selected="true"' : '' ) . '>' . ( $vv ) . '</option>';
			} 
			?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
	} 
	?>
	</div>
</div>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

function psp_postTypes_get() {
	global $psp;

	$post_types = get_post_types(array(
		'public'   => true
	));
	//unset media - images | videos are treated as belonging to post, pages, custom post types
	unset($post_types['attachment'], $post_types['revision']);
	return $post_types;
}

function __pspNotifyEngine( $engine='google', $action='default' ) {
	global $psp;
	
	$req['action'] = $action;
	
	if ( $req['action'] == 'getStatus' ) {
		$notifyStatus = $psp->get_theoption('psp_sitemap_engine_notify');
		if ( $notifyStatus === false || !isset($notifyStatus["$engine"]) || !isset($notifyStatus["$engine"]["sitemap"]) )
			return '';
		return $notifyStatus["$engine"]["sitemap"]["msg_html"];
	}

	$html = array();
	
	$html[] = '<div class="psp-form-row psp-notify-engine-ping psp-notify-' . $engine . '">';

	if ( $engine == 'google' ) {
		$html[] = '<div class="">' . sprintf( __('Notify Google: you can check statistics on <a href="%s" target="_blank">Google Webmaster Tools</a>', $psp->localizationName), 'http://www.google.com/webmasters/tools/' ). '</div>';
	} else if ( $engine == 'bing' ) {
		$html[] = '<div class="">' . sprintf( __('Notify Bing: you can check statistics on <a href="%s" target="_blank">Bing Webmaster Tools</a>', $psp->localizationName), 'http://www.bing.com/toolbox/webmaster' ). '</div>';
	}
	
	ob_start();
?>
		<label for="sitemap_type<?php echo '_'.$engine; ?>" style="display:inline;float:none;"><?php echo __('Select Sitemap', $psp->localizationName);?>:</label>
		&nbsp;
		<select id="sitemap_type<?php echo '_'.$engine; ?>" name="sitemap_type" style="width:160px;">
			<?php
			foreach (array('sitemap' => 'Sitemap.xml', 'sitemap_images' => 'Sitemap-Images.xml', 'sitemap_videos' => 'Sitemap-Videos.xml') as $kk => $vv){
				echo '<option value="' . ( $kk ) . '" ' . ( 0 ? 'selected="true"' : '' ) . '>' . ( $vv ) . '</option>';
			} 
			?>
		</select>&nbsp;&nbsp;
<?php
	$selectSitemap = ob_get_contents();
	ob_end_clean();
	$html[] = $selectSitemap;
	
	$html[] = '<input type="button" class="psp-button blue" style="width: 160px;" id="psp-notify-' . $engine . '" value="' . ( __('Notify '.ucfirst($engine), $psp->localizationName) ) . '">
	<span style="margin:0px 0px 0px 10px" class="response">' . __pspNotifyEngine( $engine, 'getStatus' ) . '</span>';

	$html[] = '</div>';

	// view page button
	ob_start();
?>
	<script>
	(function($) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>',
		engine = '<?php echo $engine; ?>';

		$("body").on("click", "#psp-notify-"+engine, function(){

			$.post(ajaxurl, {
				'action' 		: 'pspAdminAjax',
				'sub_action'	: 'notify',
				'engine'		: engine,
				'sitemap_type'	: $('#sitemap_type_'+engine).val()
			}, function(response) {

				var $box = $('.psp-notify-'+engine), $res = $box.find('.response');
				$res.html( response.msg_html );
				if ( response.status == 'valid' )
					return true;
				return false;
			}, 'json');
		});
		
		$('#sitemap_type_'+engine).on('change', function (e) {
			e.preventDefault();

			$.post(ajaxurl, {
				'action' 		: 'pspAdminAjax',
				'sub_action'	: 'getStatus',
				'engine'		: engine,
				'sitemap_type'	: $('#sitemap_type_'+engine).val()
			}, function(response) {

				var $box = $('.psp-notify-'+engine), $res = $box.find('.response');
				$res.html( response.msg_html );
				if ( response.status == 'valid' )
					return true;
				return false;
			}, 'json');
		});
   	})(jQuery);
	</script>
<?php
	$__js = ob_get_contents();
	ob_end_clean();
	$html[] = $__js;

	return implode( "\n", $html );
}
global $psp;
echo json_encode(
	array(
		$tryed_module['db_alias'] => array(
			/* define the form_messages box */
			'sitemap' => array(
				'title' 	=> __('Sitemap settings', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> true, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				// create the box elements array
				'elements'	=> array(
					'xmlsitemap_html' => array(
						'type' 		=> 'html',
						'html' 		=> 
							'<div class="psp-form-row">
								<label for="site-items">' . __('Website posts, pages sitemap:', $psp->localizationName) . '</label>
						   		<div class="psp-form-item large">
									<a id="site-items" target="_blank" href="' . ( home_url('/sitemap.xml') ) . '" style="position: relative;bottom: -6px;">' . ( home_url('/sitemap.xml') ) . '</a>
								</div>
								
								<label for="site-items">' . __('Images sitemap:', $psp->localizationName) . '</label>
						   		<div class="psp-form-item large">
									<a id="site-items" target="_blank" href="' . ( home_url('/sitemap-images.xml') ) . '" style="position: relative;bottom: -6px;">' . ( home_url('/sitemap-images.xml') ) . '</a>
								</div>
								
								<label for="site-items">' . __('Videos sitemap:', $psp->localizationName) . '</label>
						   		<div class="psp-form-item large">
									<a id="site-items" target="_blank" href="' . ( home_url('/sitemap-videos.xml') ) . '" style="position: relative;bottom: -6px;">' . ( home_url('/sitemap-videos.xml') ) . '</a>
								</div>
							</div>'
					),
					
					/*
					'logo' => array(
						'type' 			=> 'upload_image_wp',
						'size' 			=> 'large',
						'force_width'	=> '80',
						'preview_size'	=> 'large',	
						'value' 		=> __('Upload Image', $psp->localizationName),
						'title' 		=> __('Logo', $psp->localizationName),
						'desc' 			=> __('Upload your Logo using the native media uploader', $psp->localizationName),
					),*/
					
					/*'xmlsitemap_html' => array(
						'type' 		=> 'html',
						'html' 		=> 
							'<div class="psp-form-row">
						   		<label for="items_per_page">Items per page</label>
						   		<div class="psp-form-item large">
									<span class="formNote">Number of items per page:</span>
									<a href="' . ( home_url('/sitemap.xml') ) . '" style="position: relative;bottom: -6px;">' . ( home_url('/sitemap.xml') ) . '</a>
								</div>
							</div>'
					),*/
					/*'items_per_page' => array(
						'type' 		=> 'text',
						'std' 		=> '100',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> 'Items per page',
						'desc' 		=> 'Number of items per page:',
					),*/
					
					/*'stylesheet' 	=> array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '70',
						'title' 	=> 'Disable Stylesheet',
						'desc' 		=> '&nbsp;',
						'options' 	=> array(
							'yes' 	=> 'YES', 
							'no' 	=>'NO'
						)
					),*/
					
					'notify' => array(
						'type' 		=> 'html',
						'html' 		=> __(
							'<div class="psp-form-row">
								<div>If you are using a custom robots.txt file, you must add the following Sitemap XML URLs:
									<ul style="margin-left: 20px;">
										<li><i>'. home_url('/sitemap.xml'). '</i></li>
										<li><i>'. home_url('/sitemap-images.xml'). '</i></li>
										<li><i>'. home_url('/sitemap-videos.xml'). '</i></li>
									</ul>
								</div>
								<div>If you are using Wordpress virtual robots.txt file, check bellow to include your Sitemap XML URL.</div>
							</div>', $psp->localizationName)
					),
					
					'notify_virtual_robots' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Add to virtual robots.txt: ', $psp->localizationName),
						'desc' 		=> __('Add to Wordpress virtual robots.txt', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					
					'notify_google' => array(
						'type' => 'html',
						'html' => __pspNotifyEngine( 'google' )
					),
					
					'notify_bing' => array(
						'type' => 'html',
						'html' => __pspNotifyEngine( 'bing' )
					),
					
					'post_types' 	=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array('post','page'),
						'size' 		=> 'small',
						'force_width'=> '300',
						'title' 	=> __('Post Types:', $psp->localizationName),
						'desc' 		=> __('Select post types which you want to include in your sitemap xml file.', $psp->localizationName),
						'options' 	=> psp_postTypes_get()
					),
					
					'include_img' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Include Images:', $psp->localizationName),
						'desc' 		=> __('Website posts, pages sitemap.xml file will include images', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					
					/*'include_video' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> 'Include Videos:',
						'desc' 		=> 'Sitemap file will include videos',
						'options'	=> array(
							'yes' 	=> 'YES',
							'no' 	=> 'NO'
						)
					),*/
					
					array(
						'type' 		=> 'message',
						'status' 	=> 'info',
						'html' 		=> __('
							<h3 style="margin: 0px 0px 5px 0px;">Priorities:</h3>
							<p>Because this value is relative to other pages on your site, assigning a high priority (or specifying the same priority for all URLs) will not help your site\'s search ranking. In addition, setting all pages to the same priority will have no effect.</p>
						', $psp->localizationName)
					),
					
					'priority' => array(
						'type' 		=> 'html',
						'html' 		=> psp_postTypes_priority()
					),
					
					array(
						'type' 		=> 'message',
						'status' 	=> 'info',
						'html' 		=> __('
							<h3 style="margin: 0px 0px 5px 0px;">Changes frequencies:</h3>
							<p>Provides a hint about how frequently the page is likely to change.</p>
						', $psp->localizationName)
					),
					
					'changefreq' => array(
						'type' 		=> 'html',
						'html' 		=> psp_postTypes_changefreq()
					),
					
					/* Video Xml Sitemap */
					'video_html' => array(
						'type' 		=> 'html',
						'html' 		=> 
							'<div class="psp-form-row">
								<span><strong>' . __('Video sitemap settings:', $psp->localizationName) . '</strong></span>
							</div>'
					),
					
					'video_title_prefix' 	=> array(
						'type' 		=> 'text',
						'std' 		=> 'Video',
						'size' 		=> 'large',
						'force_width'=> '150',
						'title' 	=> __('Video Title Before Text: ', $psp->localizationName),
						'desc' 		=> __('this text will be showed as prefix for video title in the schema.org content snippet (only if the text doesn\'t already exist in the title).', $psp->localizationName)
					),
					
					'video_social_force' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Social Tags Rewrite: ', $psp->localizationName),
						'desc' 		=> __('rewrite the social meta tags (facebook) with the information from the video; if you have multiple videos in the post or page content, will use the first video found by our search algorithm and it may not be the first video in your post or page content', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					
					'thumb_default' => array(
						'type' 			=> 'upload_image',
						'size' 			=> 'large',
						'force_width'	=> '80',
						'preview_size'	=> 'large',	
						'value' 		=> __('Upload Image', $psp->localizationName),
						'title' 		=> __('Video Default Thumb', $psp->localizationName),
						'desc' 			=> __('Upload your Video Default Thumb using the native media uploader', $psp->localizationName),
						'thumbSize' => array(
							'w' => '100',
							'h' => '100',
							'zc' => '2',
						)
					),
					
					'video_include' 	=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array_keys($__psp_video_include),
						'size' 		=> 'large',
						'force_width'=> '300',
						'title' 	=> __('Select Video Providers:', $psp->localizationName),
						'desc' 		=> __('select the video providers to include in your sitemap-videos.xml', $psp->localizationName),
						'options' 	=> $__psp_video_include
					),
					
					'vzaar_domain' 	=> array(
						'type' 		=> 'text',
						'std' 		=> 'vzaar.com/videos',
						'size' 		=> 'large',
						'force_width'=> '150',
						'title' 	=> __('Vzaar domain: ', $psp->localizationName),
						'desc' 		=> __('enter vzaar domain.', $psp->localizationName)
					),
					
					'viddler_key' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '150',
						'title' 	=> __('Viddler key: ', $psp->localizationName),
						'desc' 		=> __('enter viddler key.', $psp->localizationName)
					),
					
					'flickr_key' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '150',
						'title' 	=> __('Flickr key: ', $psp->localizationName),
						'desc' 		=> __('enter flickr key.', $psp->localizationName)
					),
				)
			)
		)
	)
);