<?php

define('EGS_PLUGIN_NAME', 				'EG-Series'			);
define('EGS_TEXTDOMAIN',  				'eg-series' 		);
define('EGS_OPTIONS_ENTRY',				'EG-Series-Options'	);
define('EGS_OPTIONS_PAGE_ID', 			'egs_options'		);

define('EGS_TAXONOMY',					'series'			);
define('EGS_TAXONOMY_LABEL',			'EG-Series'			);

define('EGS_DEFAULT_POSTS_ORDER_BY',	'date' 				);
define('EGS_DEFAULT_POSTS_ORDER',		'DESC' 				);
// define('EGS_DEFAULT_AUTOSUBMIT',		1					);

define('EGS_CACHE_POSTS', 				86400				);
define('EGS_CACHE_SERIES', 				86400				);
define('EGS_CACHE_CHECK_SHORTCODE',		86400				);

define('EGS_CACHE',						TRUE);

$EGS_SHORTCODE_SERIES_DEFAULTS = array(
	'title'	       => '',   	/* tested */
	'titletag'     => 'h2',   	/* tested */
	'listtype'     => 'ul',   	/* tested */
	'number'       => 0,		/* tested */
	'more'         => 0,		/* tested */
	'hide_empty'   => 1,   		/* tested */
	'width'		   => 0,
	'show_count'   => 0,   		/* tested */
	'description'  => 0,   		/* tested */
	'listposts'    => 0,
	'post_orderby' => EGS_DEFAULT_POSTS_ORDER_BY,
	'post_order'   => EGS_DEFAULT_POSTS_ORDER,
	'numposts'	   => 0,
	'show_date'    => 1,
	'expand'	   => 0
);

// Default options for shortcode [seriesposts] (list of all posts of a specified serie)
$EGS_SHORTCODE_POSTS_DEFAULTS = array(
	'id'	    => 0,
	'name'	    => '',
	'sid'		=> 0,
	'title'	    => '',
	'titletag'  => 'h2',
	'listtype'  => 'ol',
	'orderby'   => EGS_DEFAULT_POSTS_ORDER_BY,
	'order'	    => EGS_DEFAULT_POSTS_ORDER,
	'show_date' => 1,
	'expand'    => 0,
	'width'	    => 0,
	'numposts'	=> 0
);

$EGS_DEFAULT_OPTIONS = array(
	'load_css'					  => 1,
	'uninstall_del_options'		  => 0,
	'uninstall_del_series' 		  => 0,
	'display_admin_bar'			  => 1,
	'tinymce_button'			  => 1,
	'display_columns'       	  => 1,
	'display_dashboard'			  => 1,
	'access_level'  			  => 'manage_categories',
	/* manage_options for Admin, manage_categories for Editor, publish_posts for Author, edit_posts */
	'shortcode_list_series' 	  => 'series',
	'shortcode_list_posts'  	  => 'seriesposts',
	'shortcode_auto' 			  => 0,
	'shortcode_auto_exclusive'	  => 1,
	'shortcode_auto_where'		  => array('post'),
	'shortcode_auto_title'  	  => 'Other posts of the serie',
	'shortcode_auto_title_tag' 	  => 'h2',
	'shortcode_auto_listtype'     => 'ol',
	'shortcode_auto_orderby'      => EGS_DEFAULT_POSTS_ORDER_BY,
	'shortcode_auto_order'		  => EGS_DEFAULT_POSTS_ORDER,
	'shortcode_auto_show_date'    => 1,
	'shortcode_auto_expand'   	  => 0,
	'shortcode_auto_default_opts' => 0,
	'custom_post_types'			  => array('post', 'page'),
	'date_format'				  => '',
	'series_url'				  => 2,
	'taxonomy_slug'				  => EGS_TAXONOMY,
	'tinymce_button'			  => 1,
	'clear_cache'				  => 1
);

if (! class_exists('EG_Series_Common')) {

	Class EG_Series_Common {

		static function get_post_custom_types($options_entry, $options, & $type_list, & $type_selected) {

			$type_list  	= array();
			$type_selected 	= array();

			if (function_exists('get_post_types')) {
				// Get custom post type
				$custom_post_types = get_post_types(array(), 'objects');

				// List of post type to exclude
				$exclusion_list = array(
					'attachment' 		 => 'attachment',
					'nav_menu_item' 	 => 'nav_menu_item',
					'revision' 			 => 'revision',
					'egatmpl' 			 => 'egatmpl',
					'wpcf7_contact_form' => 'wpcf7_contact_form'
				);

				$list = array_diff_key($custom_post_types, $exclusion_list);

				// Build lists
				if ( sizeof($list) > 0 ) {
					$type_list = wp_list_pluck($list, 'label');
					foreach ($type_list as $key => $label) {
						if (is_object_in_taxonomy( $key , EGS_TAXONOMY ))
							$type_selected[$key] = $key;
					}
					if ($options['custom_post_types'] != $type_selected) {
						update_option($options_entry, $options);
					}
				}
			} // End of function get_post_types exists
		} // End of get_post_custom_types

		/**
		 * create_taxonomy
		 *
		 * Create taxonomy
		 *
		 * @param	string	$textdomain			textdomain of the plugin
		 * @param	array	$custom_post_types	list of custom posts types
		 * @return	none
		 */
		static function create_taxonomy($textdomain, $options) {

			if ( ! taxonomy_exists(EGS_TAXONOMY)) {

				$labels = array(
					'name' 						 => EGS_TAXONOMY_LABEL,
					'singular_name' 			 => __( 'EG-Series', 		$textdomain),
					'search_items' 				 => __( 'Search series',	$textdomain),
					'popular_items'			 	 => null,
					'all_items' 				 => __( 'All series', 		$textdomain),
					'edit_item' 				 => __( 'Edit a serie', 	$textdomain),
					'update_item' 				 => __( 'Update a serie', 	$textdomain),
					'add_new_item' 				 => __( 'Add a new serie', 	$textdomain),
					'new_item_name' 			 => __( 'New serie Name', 	$textdomain),
					'separate_items_with_commas' => null,
					'add_or_remove_items' 		 => null,
					'choose_from_most_used' 	 => __( 'Choose from most used', $textdomain)
				);

				$structure = get_option( 'permalink_structure' );
				$args = array(  'hierarchical'	=> false,
								'labels' 		=> $labels,
								'query_var' 	=> $options['taxonomy_slug'],
								'rewrite' 		=> ( empty( $structure ) ? FALSE : array( 'slug' => $options['taxonomy_slug'] ) ) );

					register_taxonomy(EGS_TAXONOMY, $options['custom_post_types'], $args);

				/* Tentative to avoid 404 error after changing rewrite rules
				- Get rewrite rules
				- if rewrite rules don't contain "serie=" then flush
				*/
				$rewrite_rules = get_option('rewrite_rules');
				if (FALSE === $rewrite_rules ||
					FALSE === strpos(implode(',',$rewrite_rules), $options['taxonomy_slug'].'=')) {
// eg_plugin_error_log('EGS Common', 'Flushing rules');
					flush_rewrite_rules();
					delete_transient(EGS_PLUGIN_NAME.'-series');  /* change of taxonomy slug */
				}
			} // End of is_taxonomy
		} // End of eg_series_create_taxonomy


		/**
		 * get_serie_from_post_id
		 *
		 * Get the serie linked to the post specified by $post_id
		 *
		 * @package EG-Series
		 *
		 * @param 	int		$post_id		post id
		 * @return 	object					a serie
		 */
		static function get_serie_from_post_id($post_id) {

			$serie = get_the_terms($post_id, EGS_TAXONOMY );
			if ($serie) {
				if (is_array($serie))
					$serie = reset($serie);
			}
			return ($serie);
		} // End of get_serie_from_post_id

		/**
		 * get_serie_from_slug
		 *
		 * Get a serie from a slug
		 *
		 * @package EG-Series
		 *
		 * @param 	string		$slug		slug of a serie
		 * @return 	object					a serie
		 */
		static function get_serie_from_slug($slug) {

			$serie = get_term_by('name', $slug, EGS_TAXONOMY);
	
			if ($serie && is_array($serie))
				$serie = reset($serie);

			return ($serie);
		} // End of get_serie_from_slug

		/**
		 * get_the_serie
		 *
		 * Get serie object, according a name of the serie, or the id of one of its posts
		 *
		 * @param 	int			$sid	id of the serie
		 * @param 	string		$name	name of the requested serie
		 * @param 	int			$id		id of a posts belonging to serie
		 * @return	object		the serie
		 */
		static function get_the_serie($sid=0, $name='', $id=0) {

			$serie = FALSE;
			if (0 != $sid) {
				$serie = get_term($sid, EGS_TAXONOMY);
			}
			else {
				if ($name != '') {
					$serie = self::get_serie_from_slug($name);
				} // End of $name
				if (! $serie) {
					global $post;
					if (0 == $id && isset($post))
						$id = $post->ID;

					$serie = self::get_serie_from_post_id($id);

					if (FALSE !== $serie && is_array($serie) && sizeof($serie)>0)
						$serie = reset($serie);

				} // End of $serie_id==0
			}
			return ($serie);
		} // End of get_the_serie

		/**
		 * get_series_list
		 *
		 * Get the list of all existing series
		 *
		 * @package EG-Series
		 *
		 * @param 	none
		 * @return 	array of object		list of series
		 */
		static function get_series_list($options, $use_cache=TRUE) {
// eg_plugin_error_log('EGS Common', 'Getting list of series');
			$cache_id = EGS_PLUGIN_NAME.'-series';
			$series_list = get_transient($cache_id);
			if ( ! $series_list || ! $use_cache ) {
// eg_plugin_error_log('EGS Common', 'Cache not available, query DB');
				// Get list of series
				$list = get_terms(EGS_TAXONOMY, array('hide_empty'	=> false, 'hierarchical' => false));
				if ($list) {

					// Store series in the cache
					$series_list = array();
					foreach ($list as $serie) {
						$series_list[$serie->term_id] 			= new stdclass();
						$series_list[$serie->term_id]->term_id 	= $serie->term_id;
						$series_list[$serie->term_id]->name		= $serie->name;
						$series_list[$serie->term_id]->description = $serie->description;
						$series_list[$serie->term_id]->link		= self::get_serie_link($serie, $options);
						$series_list[$serie->term_id]->count	= $serie->count;
					} // End of foreach
					if (EGS_CACHE) set_transient($cache_id, $series_list, EGS_CACHE_SERIES );
				} // End of series_list
			} // End of cache empty
			return ($series_list);
		} // End of get_series_list

		/**
		 * get_serie_link
		 *
		 * Get link of a serie
		 *
		 * @param 	object		the serie for which we need the link
		 * @param 	array		plugin options list
		 * @return 	string		link of the serie
		 */
		static function get_serie_link($serie, $options) {

			$link = FALSE;
			if ( 2 == $options['series_url'] ) {
				$link = get_term_link( $serie, EGS_TAXONOMY );
			}
			else {
				$list = self::get_posts_of_a_serie($serie->term_id, $options, 'date', 'asc');
				if ($list) {
					$first_post = reset($list);
					$link = get_permalink($first_post->ID);
				}
			} // End of series_url = 1
			return ($link);
		} // End of get_serie_link

		/**
		 * shorten_string
		 *
		 *
		 *
		 * @param	string	$string		string to be shorten
		 * @param	int		$width		string width
		 * @return	string				shorten string
		 */
		static function shorten_string($string, $width) {

			if ( 0 == $width || $width >= mb_strlen($string) )
				$new_string = $string;
			else {
				$new_string = mb_substr($string, 0, $width).'...';
			}
			return esc_html($new_string);
		} // End of shorten_string

		/**
		 * replace_serie_tokens
		 *
		 *
		 *
		 * @param	string	$template		format to convert
		 * @param	object	$serie			serie to be used as input
		 * @return	string					filled template
		 */
		static function replace_series_tokens($template, $item, $series_list, $serie_id, $args, $options, $textdomain) {
			global $EGS_SHORTCODE_POSTS_DEFAULTS;

			if ('loop' == $item && 1 == $args['listposts'] && '' != $template['loop_with_posts']) {
				$item = 'loop_with_posts';
			}
// eg_plugin_error_log('EG-Series-Common', 'Series list : ', $series_list);

			$string = $template[$item];
			if (FALSE !== $serie_id) {
// eg_plugin_error_log('EG-Series-Common', 'Series id : ', $serie_id);
				$serie = $series_list[$serie_id];

				$name = self::shorten_string($serie->name, $args['width']);

				$string = str_replace('%SERIE_LINK%',		$serie->link, 					$string );
				$string = str_replace('%SERIE_NAME%', 		esc_html($name), 				$string );
				$string = str_replace('%SERIE_FULL_NAME%', 	esc_html($serie->name), 		$string );
				$string = str_replace('%DESCRIPTION%', 		esc_html($serie->description),	$string );
				$string = str_replace('%NUMBER_OF_POSTS%',	$serie->count, 					$string );

			} // End of serie defined

			if (0 == $args['number']) {
				$string = str_replace('%NUMBER_OF_SERIES_DISPLAYED%', '', $string);
			}
			else {
				$string = str_replace('%NUMBER_OF_SERIES_DISPLAYED%',
									sprintf(esc_html__('%s on %s series displayed ', $textdomain), $args['number'], sizeof($series_list)), $string);
			}

			/* --- Manage description shortcode parameter --- */
			if (0 == $args['description'] || FALSE === strpos($string, '%SERIE_DESC%')) {
				$string = str_replace('%SERIE_DESC%', '', $string);
			}
			else {
				$string = str_replace('%SERIE_DESC%',  self::replace_series_tokens($template, 'serie_desc', $series_list, $serie_id, $args, $options, $textdomain),$string);
			}

			/* --- Manage show_count shortcode parameter --- */
			if (0 == $args['show_count'] || FALSE === strpos($string, '%SERIE_COUNT%')) {
				$string = str_replace('%SERIE_COUNT%', '', $string);
			}
			else {
				$string = str_replace('%SERIE_COUNT%',  self::replace_series_tokens($template, 'serie_count', $series_list, $serie_id, $args, $options, $textdomain),$string);
			}

			/* --- Manage MORE shortcode parameter --- */
			if (0 == $args['more'] || 0 == $args['number']) {
				$string = str_replace('%MORE%', '', $string);
			}
			else {
				if (FALSE !== strpos($string, '%MORE%'))
					$string = str_replace('%MORE%', self::replace_series_tokens($template, 'more', $series_list, $serie_id, $args, $options, $textdomain), $string);

				$more_series = self::shorten_string(__('Display all series', $textdomain), $args['width']);
				$string = str_replace('%MORE_DESC%', 		$more_series,						$string);
				$string = str_replace('%MORE_LINK%', 		get_permalink($args['more']), 		$string);
				$string = str_replace('%MORE_NAME%', 		$more_series,						$string);
			}

			if (0 == $args['listposts'] || FALSE == strpos($string, '%SERIE_POSTS%')) {
				$string = str_replace('%SERIE_POSTS%', '', $string);
			}
			else {
				$list_posts = '';
				if ( 0 < $args['listposts'] ) {
					$list_posts = self::posts_list(wp_parse_args( array(
								'sid'	    	=> $serie_id,
								'listtype'  	=> $args['listtype'],
								'orderby'  		=> $args['post_orderby'],
								'order'	    	=> $args['post_order'],
								'show_date' 	=> $args['show_date'],
								'width'			=> $args['width'],
								'numposts'		=> $args['numposts'],
								'expand'		=> $args['expand']), $EGS_SHORTCODE_POSTS_DEFAULTS),
						$options,
						$textdomain
					);
				}
				$string = str_replace('%SERIE_POSTS%', $list_posts, $string);
			}
			return ($string);
		} // End of replace_serie_tokens


		/**
		 * series_list
		 *
		 * List series, and their posts (if requested)
		 *
		 * @param	array	$args				shortcode parameters
		 * @param	array	$options			plugin's options
		 * @return	string						list of the series
		 */
		static function series_list($args, $options, $textdomain) {
			global $EGS_SHORTCODE_SERIES_DEFAULTS;

// eg_plugin_error_log('EG-Series-Common', 'Starting SERIES shortcode');

//			if (is_singular()) {
				global $post;
				if ( $post && (post_password_required($post->ID) || ('private' == get_post_status($post->ID)  && !is_user_logged_in())) ) {
					return '';
				}
//			}

// eg_plugin_error_log('EG-Series-Common', 'SERIES shortcode: Security ok.');

			extract( shortcode_atts( $EGS_SHORTCODE_SERIES_DEFAULTS, $args ) );

			$serie_templates = array(
				'ul' =>	array(
						'pre' 			=> '<ul class="egs-series">'."\n",
						'loop'			=> '<li class="egs-series-item">'."\n".'<a class="egs-series-item-title" href="%SERIE_LINK%" title="%SERIE_FULL_NAME%" >%SERIE_NAME%</a>'."\n".'%SERIE_COUNT%%SERIE_DESC%%SERIE_POSTS%</li>'."\n",
						'loop_with_posts' => '',
						'post'			=> '%MORE%'."\n".'</ul>'."\n".'%NUMBER_OF_SERIES_DISPLAYED%',
						'serie_count' 	=> '<span class="egs-series-count"> (%NUMBER_OF_POSTS%)</span>'."\n",
						'serie_desc' 	=> '<br /><span class="egs-series-desc">%DESCRIPTION%</span>'."\n",
						'more'			=>  '<li class="egs-series-item egs-series-more"><a class="egs-series-item-title" href="%MORE_LINK%" title="%MORE_DESC%">%MORE_NAME%</a></li>'
					),
				'ol' =>	array(
						'pre' 			=> '<ol class="egs-series">'."\n",
						'loop'			=> '<li class="egs-series-item">'."\n".'<a class="egs-series-item-title" href="%SERIE_LINK%" title="%SERIE_FULL_NAME%" >%SERIE_NAME%</a>%SERIE_COUNT%%SERIE_DESC%%SERIE_POSTS%</li>',
						'loop_with_posts' => '',
						'post'			=> '%MORE%</ol>%NUMBER_OF_SERIES_DISPLAYED%',
						'serie_count' 	=> '<span class="egs-series-count"> (%NUMBER_OF_POSTS%)</span>',
						'serie_desc' 	=> '<br /><span class="egs-series-desc">%DESCRIPTION%</span>',
						'more'			=>  '<li class="egs-series-item egs-series-more"><a class="egs-series-item-title" href="%MORE_LINK%" title="%MORE_DESC%">%MORE_NAME%</a></li>'
					),
				'select' =>	array(
						'pre'			=> '<select onChange="if (this.value!=\'\') { window.location=this.value}" >'.
											'<option class="egs-series-item" value="#">'.esc_html__('Select a serie ...', $textdomain).'</option>',
						'loop'			=> '<option class="egs-series-item" value="%SERIE_LINK%">%SERIE_NAME%%SERIE_COUNT%</option>',
						'loop_with_posts' => '<optgroup label="%SERIE_NAME%">'."\n".
											'<option class="egs-series-item" value="%SERIE_LINK%">'.esc_html__('The serie', $textdomain).'</option>'."\n".
											'%SERIE_POSTS%'."\n".
											'</optgroup>',
						'post'			=> '%MORE%</select>%NUMBER_OF_SERIES_DISPLAYED%',
						'serie_count'	=> '<span class="egs-series-count"> (%NUMBER_OF_POSTS%)</span>',
						'serie_desc'	=> '<br /><span class="egs-series-desc">%DESCRIPTION%</span>',
						'more'			=>  '<option class="egs-series-item egs-series-more" value="%MORE_LINK%">%MORE_NAME%</option>'
					)
			);

			$string = '';
			// Get the list of series
			$series_list = self::get_series_list($options);
			if ($series_list) {

				if (0 != $number && $number >= sizeof($series_list)) {
					$args['number'] = 0;
					$number			= 0;
				}
				$template = $serie_templates[$listtype];
				$string = self::replace_series_tokens($template, 'pre', $series_list, FALSE, $args, $options, $textdomain)."\n";
				$num_loop = 1;
				foreach ($series_list as $serie) {
					if (1 == $hide_empty && 0 == $serie->count)
						continue;

					$string .= self::replace_series_tokens($template, 'loop', $series_list, $serie->term_id, $args, $options, $textdomain)."\n";
					if (0 != $number && (++$num_loop) > $number)
						break;
				} // End of foreach series
				$string .= self::replace_series_tokens($template, 'post', $series_list, FALSE, $args, $options, $textdomain)."\n";
			} // End of $series_list
			return ($string);
		} // End of eg_series_series_list

		/**
		 * sort_posts
		 *
		 * Sorts posts returned from the cache
		 *
		 * @param 	array		posts		posts (array of objects)
		 * @param 	string		$orderby	Field to use as sort key
		 * @param 	string		$order		ASC or DESC
		 *
		 * @return 	none
		 */
		static function sort_posts(& $posts, $order_by, $order) {
			$compare = ($order === 'ASC')
						? 'return  strcmp($a->'.$order_by.', $b->'.$order_by.');'
						: 'return -strcmp($a->'.$order_by.', $b->'.$order_by.');';
			uasort($posts, create_function('$a,$b', $compare));
		} // End of sort_posts

		/**
		 * get_excerpt
		 *
		 * Extract and return excerpt from a post
		 *
		 * @package EG-Series
		 * @param object	$post				$post to extract excerpt
		 * @return string						excerpt of the specified post
		 */
		static function get_excerpt($post) {

			// TODO: manage private posts if required
			if ( post_password_required($post) )
				$string = get_the_password_form();
			else {
				if (! empty($post->post_excerpt)) {
					$string = htmlspecialchars(strip_tags($post->post_excerpt));
				}
				else {
					if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
						$string = htmlspecialchars(strip_tags(current(explode($matches[0], $post->post_content, 2))));
					}
					else {
						$string = wp_html_excerpt($post->post_content, 150);
					}
				}
			}
			return ($string);
		} // End of eg_series_get_excerpt


		/**
		 * get_posts_of_a_serie
		 *
		 * List posts of a serie
		 *
		 * @param	int		$serie_id		Id of a serie
		 * @return	array					List of posts
		 */
		static function get_posts_of_a_serie($serie_id, $options, $orderby, $order) {

			/* --- Order parameters --- */
			if (in_array($orderby, array('title', 'date')))
				$orderby = 'post_'.$orderby;
			elseif ('user_order' == $orderby)
				$orderby = 'menu_order';

			/* --- Get data from the cache --- */
			$cache_id = EGS_PLUGIN_NAME.'-posts-'.$serie_id;
			$posts_list = (EGS_CACHE ? get_transient($cache_id) : FALSE);
			if ($posts_list) {
 //eg_plugin_error_log('EG_Series_Common', 'get_posts_of_a_serie: Get posts, use cache');
				self::sort_posts($posts_list, $orderby, $order);
			}
			else {
				$posts = get_posts(array(
					'tax_query' => array(
						array(
							'taxonomy' => EGS_TAXONOMY,
							'field' => 'id',
							'terms' => $serie_id
						)
					),
					'orderby'			=> $orderby,
					'order'				=> $order,
					'post_type'			=> array_merge( array('post'), (array)$options['custom_post_types']),
					'posts_per_page'	=> -1)
				);

				if ($posts) {
					foreach ($posts as $post) {
						$posts_list[$post->ID] 				= new stdClass();
						$posts_list[$post->ID]->ID		 	= $post->ID;
						$posts_list[$post->ID]->post_title 	= $post->post_title;
						$posts_list[$post->ID]->excerpt 	= self::get_excerpt($post);
						$posts_list[$post->ID]->permalink 	= get_permalink($post->ID);
						$posts_list[$post->ID]->post_date	= $post->post_date;
						$posts_list[$post->ID]->menu_order	= $post->menu_order;
					} // End of foreach
					if (EGS_CACHE) set_transient($cache_id, $posts_list, EGS_CACHE_POSTS );
//eg_plugin_error_log('EG_Series_Common', 'get_posts_of_a_serie: No cache, query DB', sizeof($posts));
				} // End of posts found
			} // End of getting posts from the DB
			return ($posts_list);
		} // End of get_posts_of_a_serie

		/**
		 * replace_post_tokens
		 *
		 *
		 *
		 * @param	string	$template		format to convert
		 * @param	object	$post			post to be used as input
		 * @return	string					filled template
		 */
		static function replace_post_tokens($template, $item, $post, $args, $date_format, $textdomain) {

			$string = $template[$item];
			if ($post) {
				$string = str_replace('%POST_LINK%', 	$post->permalink, 											$string);
				$string = str_replace('%POST_EXCERPT%', esc_html($post->excerpt), 									$string);
				$string = str_replace('%DATE_FORMAT%', 	date_i18n($date_format, strtotime($post->post_date)), 		$string);
				$string = str_replace('%POST_NAME%', 	self::shorten_string($post->post_title, $args['width']), 	$string);
			}

			if (0 == $args['show_date'] ) {
				$string = str_replace('%POST_DATE%', '', $string);
			}
			elseif (FALSE !== strpos($string, '%POST_DATE%')) {
				$string = str_replace('%POST_DATE%', self::replace_post_tokens($template, 'post_date', $post, $args,  $date_format, $textdomain), $string);
			}

			if (0 == $args['expand']) {
				$string = str_replace('%POST_DESC%', '', $string);
			}
			elseif (FALSE !== strpos($string, '%POST_DESC%')) {
				$string = str_replace('%POST_DESC%', self::replace_post_tokens($template, 'post_desc', $post, $args, $date_format, $textdomain), $string);
			}
			return ($string);
		} // End of replace_post_tokens


		/**
		 * posts_list
		 *
		 * Implement shortcode to display list of posts
		 *
		 * @param 	none
		 * @return 	none
		 */
		static function posts_list($args, $options, $textdomain, $include_pre_post=1) {
			global $EGS_SHORTCODE_POSTS_DEFAULTS;

// eg_plugin_error_log('EG-Series-Common', 'Starting POSTS shortcode', $args);

//			if (is_singular()) {
				global $post;
				if ( $post && (post_password_required($post->ID) || ('private' == get_post_status($post->ID)  && !is_user_logged_in())) ) {
					return '';
				}
//			} // End of is_singular

//eg_plugin_error_log('EG-Series-Common', 'POSTS shortcode: Security Ok.');

			extract(shortcode_atts( $EGS_SHORTCODE_POSTS_DEFAULTS, $args ));
			// if (!isset($include_select)) $include_select=1;

			$post_templates = array(
				'ul' =>	array(
						'pre' 		=> ($include_pre_post ? '<ul class="egs-posts">' : ''),
						'loop'		=> '<li class="egs-posts-item">'.
										'<a  class="egs-posts-item-title" href="%POST_LINK%" title="%POST_NAME%">%POST_NAME%</a>'.
										'%POST_DATE%%POST_DESC%</li>',
						'post'		=> ($include_pre_post ? '</ul>' : ''),
						'post_date' => '<span class="egs-posts-item-date"> (%DATE_FORMAT%)</span>',
						'post_desc' => '<br /><span class="egs-posts-item-excerpt">%POST_EXCERPT%</span>'
					),
				'ol' =>	array(
						'pre' 		=> ($include_pre_post ? '<ol class="egs-posts">' : ''),
						'loop'		=> '<li class="egs-posts-item">'.
										'<a  class="egs-posts-item-title" href="%POST_LINK%" title="%POST_NAME%">%POST_NAME%</a>'.
										'%POST_DATE%%POST_DESC%</li>',
						'post'		=> ($include_pre_post ? '</ol>' : ''),
						'post_date' => '<span class="egs-posts-item-date"> (%DATE_FORMAT%)</span>',
						'post_desc' => '<br /><span class="egs-posts-item-excerpt">%POST_EXCERPT%</span>'
					),
				'select' =>	array(
						'pre' 	=> ($include_pre_post ? '<select onChange="if (this.value!=\'\') { window.location=this.value}" >' : ''),
						'loop'	=> '<option value="%POST_LINK%">%POST_NAME%'.($show_date?' (%POST_DATE%)':'').'</option>',
						'post'	=> ($include_pre_post ? '</select>' : ''),
						'post_date'  => '%DATE_FORMAT%'
					)
			);

			$string = '';
			$serie = self::get_the_serie($sid, $name, $id);
			if ($serie) {
			
					$series_posts = self::get_posts_of_a_serie($serie->term_id, $options, $orderby, $order);

					if ($series_posts) {
						$date_format = ( '' != $options['date_format'] ? $options['date_format'] : get_option('date_format') );
						$template = $post_templates[$listtype];

						$string .= self::replace_post_tokens($template, 'pre', FALSE, $args, $date_format, $textdomain)."\n";
						$num_loop = 1;
						foreach ($series_posts as $series_post) {
							$string .= self::replace_post_tokens($template, 'loop', $series_post, $args, $date_format, $textdomain)."\n";

							if (0 != $numposts && (++$num_loop) > $numposts)
								break;
						} // End of foreach series
						$string .= self::replace_post_tokens($template, 'post', FALSE, $args, $date_format, $textdomain)."\n";

					} // End of posts_found

			} // End of serie defined
			return ($string);
		} // End of posts_list

		/**
		 * list_of_cache
		 *
		 * Build and return list of cache entries
		 *
		 * @param 	none
		 * @return 	none
		 */
		static function list_of_cache($options, $textdomain) {

			global $wpdb;

			$cache_list = FALSE;
			$series = self::get_series_list($options, FALSE);

			$series_list = get_transient( EGS_PLUGIN_NAME.'-series' );
			if ( $series_list ) {
				$cache_list[0] = esc_html__( 'List of series' , $textdomain);
			}

			/* --- Get list of cache --- */
			$transient_list = $wpdb->get_results('SELECT option_name FROM '.$wpdb->options.' WHERE option_name like "_transient_'.EGS_PLUGIN_NAME.'-posts%"');
			if ( $transient_list ) {
				foreach ($transient_list as $value) {

					$serie_id = str_replace( '_transient_'.EGS_PLUGIN_NAME.'-posts-', '', $value->option_name );

					$cache_list[$serie_id] = esc_html__('Posts list for the serie ', $textdomain).$serie_id;
					if ( isset( $series[$serie_id] ) )
						$cache_list[$serie_id] .= ' ('.$series[$serie_id]->name.')';

				}
			}
			/*
			if ( FALSE !== $cache_list ) {
				$cache_list = '<ul><li>'.implode($cache_list,'</li><li>').'</li></ul>';
			}*/
			return ($cache_list);
		} // End of list_of_cache

	} // End of class EG_Series_Common

} // End of class_exists

?>