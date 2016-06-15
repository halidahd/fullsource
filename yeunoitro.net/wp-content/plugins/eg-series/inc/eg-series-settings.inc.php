<?php

global $EGS_DEFAULT_OPTIONS;

// Build the list of post_types available (for parameters shortcode_auto_where)

EG_Series_Common::get_post_custom_types($this->options_entry, $this->options,
										$list_of_custom_post_type, $selected_custom_post_type);
$custom_post_type_enabled_disabled = array();

$tabs = array(
	1 => array( 'label' => 'Shortcodes',		'header' => ''),
	2 => array( 'label' => 'Auto shortcode',	'header' => ''),
	3 => array( 'label' => 'Admin interface', 	'header' => '')
);

$sections = array(
	'link'		=> array( 'label' => 'Link', 				'tab' => 1, 	'header' => '', 'footer' => ''),
	'shortcodes'=> array( 'label' => 'Shortcodes', 			'tab' => 1, 	'header' => '', 'footer' => ''),
	'auto' 		=> array( 'label' => 'Activation', 			'tab' => 2,		'header' => '', 'footer' => ''),
	'asformat' 	=> array( 'label' => 'Format', 				'tab' => 2,		'header' => '', 'footer' => ''),
	'admin_bar'	=> array( 'label' => 'Administration bar', 	'tab' => 3, 	'header' => '', 'footer' => ''),
	'admin'		=> array( 'label' => 'Admin interface','tab' => 3,	'header' => '', 'footer' => ''),
	'security'	=> array( 'label' => 'Security',			'tab' => 3,		'header' => '', 'footer' => ''),
	'styles' 	=> array( 'label' => 'Styles', 				'tab' => 3, 	'header' => '', 'footer' => ''),
	'uninstall' => array( 'label' => 'Uninstallation', 		'tab' => 3, 	'header' => 'Be careful: these actions cannot be cancelled. All plugin\'s options and or series will be deleted while plugin uninstallation.', 'footer' => '')
);

$fields = array(
	'series_url' => array(
		'name'		=> 'series_url',
		'label'		=> 'Link for series',
		'type'		=> 'radio',
		'section'	=> 'link',
		'group'		=> 0,
		'before'	=> 'In versions 1.x of this plugin, url of series was the permalink of the first post of these series.<br />To stay compatible, versions 2.x, keep this behavior by default. You can choose to switch to the new mode: in this case, the url will lead to the page of the serie',
		'after' 	=> '',
		'desc'		=> '',
		'options' 	=> array( 1 => 'Mode 1.x: url is the permalink of the first post of the serie',
			  2 => 'Mode 2.x: url is the link of the page of the serie'),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'taxonomy_slug'	=> array(
		'name'		=> 'taxonomy_slug',
		'label'		=> 'EG-Series permalink slug',
		'type'		=> 'text',
		'section'	=> 'link',
		'group'		=> 0,
		'before'	=> '',
		'after' 	=> '',
		'desc'		=> '',
		'options' 	=> FALSE,
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_list_series' => array(
		'name'		=> 'shortcode_list_series',
		'label'		=> 'List of series',
		'type'		=> 'text',
		'section'	=> 'shortcodes',
		'group'		=> 0,
		'before'	=> 'Shortcode to display list of series',
		'after' 	=> '',
		'desc'		=> 'Use to display list of series',
		'options' 	=> FALSE,
		'size'		=> 'medium',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_list_posts' => array(
		'name'		=> 'shortcode_list_posts',
		'label'		=> 'List of posts',
		'type'		=> 'text',
		'section'	=> 'shortcodes',
		'group'		=> 0,
		'before'	=> 'Shortcode to display posts of a serie',
		'after' 	=> '',
		'desc'		=> 'Use to list all posts of the same serie than the current post',
		'options' 	=> FALSE,
		'size'		=> 'medium',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'custom_post_types' => array(
		'name'		=> 'custom_post_types',
		'label'		=> 'Custom post types',
		'type'		=> 'checkbox',
		'section'	=> 'shortcodes',
		'group'		=> 0,
		'before'	=> 'You can use EG-Series with the following custom post types',
		'after' 	=> '',
		'desc'		=> '',
		'options' 	=> $list_of_custom_post_type,
		'size'		=> 'medium',
		'status'	=> '',
		'multiple'	=> TRUE,
		'list_options' => $custom_post_type_enabled_disabled
	),
	'shortcode_auto' => array(
		'name'		=> 'shortcode_auto',
		'label'		=> 'Activation',
		'type'		=> 'select',
		'section'	=> 'auto',
		'group'		=> 0,
		'before'	=> 'Automatically add the list of posts that are in the same serie than the current displayed post: ',
		'after'		=> '',
		'desc'		=> 'The option "Between excerpt and content" doesn\'t work if you use automatic excerpts. It works on with manual excerpt or with &lt!--more--&gt; tag. See the <a href="http://codex.wordpress.org/Excerpt" title="Excerpt in WordPress Codex">WordPress documentation</a> to get more details on excerpt.',
		'options'	=> array( 0 => 'Not activated', 2 => 'At the end', 3 => 'Before the excerpt', 4 => 'Between excerpt and content'),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_exclusive' => array(
		'name'		=> 'shortcode_auto_exclusive',
		'label'		=> 'Auto / Manual',
		'type'		=> 'checkbox',
		'section'	=> 'auto',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> 'If this option is activated, the auto shortcode won\'t be generated if a manual shortcode is detected in the post being displayed',
		'options'	=> array('Disable auto-shortcode when a manual shortcode is detected'),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_where' => array(
		'name'		=> 'shortcode_auto_where',
		'label'		=> 'Where',
		'type'		=> 'checkbox',
		'section'	=> 'auto',
		'group'		=> 0,
		'before'	=> 'Activate automatic shortcode only on the following cases',
		'after'		=> '',
		'desc'		=> 'Only post types selected in the previous options page are listed here. If a post type is missing, please go to &laquo; shortcode behavior &raquo; and select it. It will then, appear here.',
		'options'	=> array_merge(array( 'home' => 'Homepage,', 'index' => 'Lists of posts (archives, categories, ...).'),$selected_custom_post_type),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> TRUE
	),
	'shortcode_auto_title' => array(
		'name'		=> 'shortcode_auto_title',
		'label'		=> 'Title of the list',
		'type'		=> 'text',
		'section'	=> 'asformat',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> FALSE,
		'size'		=> 'medium',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_title_tag' => array(
		'name'		=> 'shortcode_auto_title_tag',
		'label'		=> 'HTML Tag for title',
		'type'		=> 'text',
		'section'	=> 'asformat',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '(tag like h2, or h3, ...)',
		'desc'		=> '',
		'options'	=> FALSE,
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_listtype' => array(
		'name'		=> 'shortcode_auto_listtype',
		'label'		=> 'List type',
		'type'		=> 'radio',
		'section'	=> 'asformat',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array( 'select' => 'Select', 'ul' => 'Simple list', 'ol' => 'Ordered list'),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_orderby' => array(
		'name'		=> 'shortcode_auto_orderby',
		'label'		=> 'Order by',
		'type'		=> 'radio',
		'section'	=> 'asformat',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array( 'date' => 'Date', 'title' => 'Title', 'menu_order' => 'User order'),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_order' => array(
		'name'		=> 'shortcode_auto_order',
		'label'		=> 'Sort Order',
		'type'		=> 'radio',
		'section'	=> 'asformat',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array( 'ASC' => 'Ascending', 'DESC' => 'Descending'),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_show_date' => array(
		'name'		=> 'shortcode_auto_show_date',
		'label'		=> 'Display dates',
		'type'		=> 'checkbox',
		'section'	=> 'asformat',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array( 'Display dates?' ),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_expand' => array(
		'name'		=> 'shortcode_auto_expand',
		'label'		=> 'Display posts',
		'type'		=> 'checkbox',
		'section'	=> 'asformat',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array( 'Display excerpt of posts?' ),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'display_admin_bar' => array(
		'name'		=> 'display_admin_bar',
		'label'		=> 'Administration bar',
		'type'		=> 'checkbox',
		'section'	=> 'admin_bar',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array( 'Display a <strong>EG-Series</strong> menu in the administration bar'),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'tinymce_button' => array(
		'name'		=> 'tinymce_button',
		'label'		=> 'EG-Series button',
		'type'		=> 'checkbox',
		'section'	=> 'admin',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array( 'Show EG-Series button in post text editor ?'),
		'size'		=> 'small',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'shortcode_auto_default_opts' => array(
		'name'		=> 'shortcode_auto_default_opts',
		'label'		=> 'Popup Window options',
		'type'		=> 'checkbox',
		'section'	=> 'admin',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array('Use options of auto shortcode, as default values for the TinyMCE popup window?'),
		'size'		=> 'regular',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'display_dashboard' => array(
		'name'		=> 'display_dashboard',
		'label'		=> 'Dashboard',
		'type'		=> 'checkbox',
		'section'	=> 'admin',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array('Display number of series in the dashboard?'),
		'size'		=> 'regular',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'access_level' => array(
		'name'		=> 'access_level',
		'label'		=> 'Edit series',
		'type'		=> 'radio',
		'section'	=> 'security',
		'group'		=> 0,
		'before'	=> 'Give the required access level to users for editing series, and posts in series',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array(
				'manage_options'	=> 'Administrator',
				'manage_categories' => 'Editor',
				'publish_posts' 	=> 'Author',
				'edit_posts' 		=> 'Contributor'),
		'size'		=> 'regular',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'load_css' => array(
		'name'		=> 'load_css',
		'label'		=> 'Stylesheet',
		'type'		=> 'checkbox',
		'section'	=> 'styles',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> 'Check if you want to use the plugin stylesheet file, uncheck if you want to use your own styles, or include styles on the theme stylesheet.',
		'options'	=> array('Automatically load plugins\' stylesheet'),
		'size'		=> 'regular',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'uninstall_del_options' => array(
		'name'		=> 'uninstall_del_options',
		'label'		=> 'Options',
		'type'		=> 'checkbox',
		'section'	=> 'uninstall',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array('Delete options during uninstallation.'),
		'size'		=> 'regular',
		'status'	=> '',
		'multiple'	=> FALSE
	),
	'uninstall_del_series' => array(
		'name'		=> 'uninstall_del_series',
		'label'		=> 'Delete series',
		'type'		=> 'checkbox',
		'section'	=> 'uninstall',
		'group'		=> 0,
		'before'	=> '',
		'after'		=> '',
		'desc'		=> '',
		'options'	=> array('Check if you want to delete all series and taxonomy'),
		'size'		=> 'regular',
		'status'	=> '',
		'multiple'	=> FALSE
	)
);


	$cache_series = EG_Series_Common::list_of_cache($this->options, $this->textdomain);
	if ( FALSE !== $cache_series && is_array($cache_series) ) {

		/* --- Clear the option --- */
		$this->options['clear_cache'] = FALSE;
		update_option($this->options_entry, $this->options);

		$tabs[4] = array(
			'label' => 'Cache',
			'header' => ''
		);

		$sections['cache'] = array(
			'label' => 'Clear plugin cache',
			'tab' => 4,
			'header' => 'The plugin is using cache to store the list of series, and the list of posts for each series. If the changes you make in the administration interface, are not seen in the front-end, you can use this option to clear the cache',
			'footer' => ''
		);

		$fields['clear_cache'] = array(
			'name'		=> 'clear_cache',
			'label'		=> 'Clear cache entries',
			'type'		=> 'checkbox',
			'section'	=> 'cache',
			'group'		=> 0,
			'before'	=> 'Check the options, if you want to delete the following cache entries',
			'after'		=> '',
			'desc'		=> '',
			'options'	=> $cache_series,
			'size'		=> 'regular',
			'status'	=> '',
			'multiple'	=> TRUE
		);
	} // End of cache not empty

$option_form->set_form($tabs, $sections, $fields);

?>