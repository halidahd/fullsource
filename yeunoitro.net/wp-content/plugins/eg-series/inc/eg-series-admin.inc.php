<?php

if (! class_exists('EG_Series_Admin')) {

	/**
	 * Class EG_Series_Admin
	 *
	 * Implement a shortcode to display the list of attachments in a post.
	 *
	 * @package EG-Series
	 */
	Class EG_Series_Admin extends EG_Plugin_133 {

		var $bulk_edit_hook;

		/**
		 * init
		 *
		 * Manage hooks, and create taxonomy
		 *
		 * @param 	none
		 * @return 	none
		 */
		function init() {

			EG_Series_Common::create_taxonomy($this->textdomain, $this->options);

			if ($this->options['display_columns']) {
				$post_type = isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : 'post';

				if ('post' == $post_type) {
					add_filter('manage_posts_columns', 		 array($this, 'post_list_columns_head'));
					add_action('manage_posts_custom_column', array($this, 'post_list_columns_content'), 10, 2);
				} // End of post_type = post or page
				else {
					if (in_array($post_type, $this->options['custom_post_types'])) {
						add_filter("manage_{$post_type}_posts_columns", array($this, 'post_list_columns_head') );
						add_action("manage_{$post_type}_posts_custom_column", array($this, 'post_list_columns_head'), 10, 2 );
					} // End of post_type managed by EG-Series
				} // End of post_type != page and post
			} // End of display columns

			if ($this->options['display_dashboard'])
				add_action('right_now_content_table_end', array($this, 'display_num_series_dashboard')) ;

			add_action('wp_ajax_eg_series_update', array($this, 'bulk_posts_series_update') );

			// If user requests button for TinyMCE, record it
			if ($this->options['tinymce_button']) {
				$this->add_tinymce_button( 'egs_shortcode', 'inc/tinymce/eg_series_plugin.js');
			}

		} // End of init

		/**
		 * post_list_columns_head
		 *
		 */
		function post_list_columns_head($defaults) {

			if ( is_array( $defaults) ) 
				return array_merge( $defaults, array(EGS_TAXONOMY => EGS_TAXONOMY_LABEL) );
			else 
				return ( $defaults);

		} // End of post_list_columns_head

		/**
		 * post_list_columns_content
		 *
		 */
		function post_list_columns_content($column_name, $post_ID) {
			if ($column_name == EGS_TAXONOMY) {
				$series_list = get_the_terms( $post_ID, EGS_TAXONOMY );
				if ($series_list) {
					$series_name = array();
					foreach ($series_list as $serie) {
						$series_name[] = $serie->name;
					}
					echo htmlspecialchars(implode(',', $series_name));
				} // End of this post has a serie
			} // End of column EG-Series
		} // End of post_list_columns_content

		/**
		 * admin_menu
		 *
		 * Add all menus and associated functions (load, enqueue_scripts, ...)
		 *
		 * @param 	none
		 * @return 	none
		 */
		function admin_menu() {

			parent::admin_menu();

			$this->bulk_edit_hook = add_submenu_page(
				'edit.php',
				esc_html__($this->name.' Bulk Edit', $this->textdomain),
				esc_html__($this->name.' Bulk Edit', $this->textdomain),
				$this->options['access_level'],
				'egs_post_edit',
				array($this, 'bulk_edition')
			);
			add_action( 'load-' .   $this->bulk_edit_hook,	array($this, 'bulk_edition_load' )				);
			add_action( 'admin_enqueue_scripts', 			array($this, 'admin_enqueue_scripts' )			);

		} // End of admin_menu

		/**
		 * admin_enqueue_scripts
		 *
		 * Load scripts, and prepare the display of the Series Bulk Editor
		 *
		 * @param 	none
		 * @return 	none
		 */
		function admin_enqueue_scripts($hook) {

			if ($this->bulk_edit_hook == $hook) {
				wp_enqueue_script('postbox');
				wp_enqueue_script($this->name.'-postboxes',
								$this->url.'/inc/js/egs-postboxes.js',
								array('postbox'),
								$this->version,
								TRUE);

				wp_enqueue_script('eg-series', $this->url.'inc/js/eg-series.js', array('jquery-ui-sortable'), $this->version, TRUE);
				wp_localize_script('eg-series', 'egSeriesSetup', array(
					'ajax_url'		 => admin_url('admin-ajax.php'),
					'UpdateSeries' 	 => 'eg_series_update',
					'nonce' 		 => wp_create_nonce( 'egseries-ajax' )
					)
				);

				wp_enqueue_style( $this->name.'bulk-edit', $this->url.'css/egseries_bulk_editor.css', null, $this->version );
			}  // End of if bulk edit page


		} // End of admin_enqueue_scripts


		function update_posts_order($posts) {
			global $wpdb;

			$sql = "UPDATE $wpdb->posts SET menu_order = CASE "."\n";
			foreach ($posts as $id => $menu_order) {
				$sql .= ' WHEN ID='.$id.' THEN '.$menu_order."\n";
			}
			$sql .= ' END'."\n".
				' WHERE ID IN ('.implode(',', array_keys($posts)).')';

			$wpdb->query($sql);

		} // End of update_posts_order

		/**
		 * bulk_posts_series_update
		 *
		 * Ajax function. Update series according actions in the admin interface
		 *
		 * @param 	none
		 * @return 	string		error code | message
		 */
		function bulk_posts_series_update() {

			$default_params = array(
				'action' 			=> '',
				'serie'	 			=> 0,
				'posts'	 			=> 0,
				'eg_series_nonce'	=> ''
			);

// eg_plugin_error_log($this->name, '$_POST:', $_POST);

			//$params = wp_parse_args($_POST, $default_params);
			extract( wp_parse_args($_POST, $default_params) );

			$error_code = 0;
			$msg = esc_html__('Serie successfully updated', $this->textdomain);
			if (! check_ajax_referer('egseries-ajax', 'eg_series_nonce', FALSE)) {
				$error_code = 3;
				$msg = esc_html__('Error, security check failed', $this->textdomain);
			}
			else if ( ! current_user_can($this->options['access_level']) ) {
				$error_code = 4;
				$msg = esc_html__('Error, access denied', $this->textdomain);
			}
			elseif ('' != $serie && $serie_id = absint(substr($serie, strlen('serie-'))) ) {

			    $current_post_list = EG_Series_Common::get_posts_of_a_serie($serie_id, $this->options, 'menu_order', 'asc');

				$current_posts = array();
				if (is_array($current_post_list) && sizeof($current_post_list)>0) {
					foreach ($current_post_list as $post) {
						$current_posts[$post->ID] = $post->menu_order;
					} // End of foreach

				} // End of $current_post_list not empty

				$new_posts = array();
				if (is_array($posts) && sizeof($posts)>0) {
					foreach ($posts as $key => $value) {
						if ( '' != trim($value) ) {
							$post_id = substr($value, strlen('post-'));
							$new_posts[$post_id] = $key;
						}
					} // End of foreach
				} // End of $posts not empty

// eg_plugin_error_log($this->name, 'New posts', $new_posts);

				$posts_to_keep   = array_intersect_key($current_posts, 	$new_posts);
				$posts_to_delete = array_diff_key($current_posts, $posts_to_keep);
				$posts_to_add    = array_diff_key($new_posts, $posts_to_keep);

// eg_plugin_error_log($this->name, 'posts_to_keep', $posts_to_keep);
// eg_plugin_error_log($this->name, 'posts_to_delete', $posts_to_delete);
// eg_plugin_error_log($this->name, 'posts_to_add', $posts_to_add);

				foreach ($posts_to_delete as $post_id => $order) {

					wp_delete_object_term_relationships($post_id, EGS_TAXONOMY);
				}
				foreach ($posts_to_add as $post_id => $order) {
					$result = wp_set_object_terms($post_id, $serie_id, EGS_TAXONOMY);
				}

				clean_object_term_cache($serie_id, EGS_TAXONOMY);
				delete_transient(EGS_PLUGIN_NAME.'-posts-'.$serie_id);

				// Re-order the list
				if (sizeof($new_posts)>0) {
					$this->update_posts_order($new_posts);
				}
			} // End of serie defined
			die ($error_code.'|'.$msg);
		} // End of bulk_posts_series_update


		function bulk_edition_load() {

		} // End of bulk_edition_load

		function bulk_edition_display_series($dummy, $box) {

			$serie_id = (int)substr($box['id'], strlen('seriebox-'));
			$posts = EG_Series_Common::get_posts_of_a_serie($serie_id, $this->options, 'menu_order', 'ASC');

			$output = '<ul id="serie-'.$serie_id.'" class="eg-series egs-sortable">';
			if ( is_array($posts) && sizeof($posts)>0 ) {
				foreach ($posts as $post) {
					$output .= '<li id="post-'.$post->ID.'">'.esc_html($post->post_title).'</li>';
				} // End of foreach
			} // End of is_array
			$output .= '<br />'.'</ul>';
			echo $output;

		} // End of bulk_edition_display_series

		function bulk_edition_display_posts($serie_ids, $box) {

			/**
			 * Analyze parameters
			 */
			$default_params = array(
					'm'			=> 0,
					'cat'		=> 0,
					'ps'		=> 'any',
					'pt'		=> 'any',
					'paged'		=> 1
				);
			$params = wp_parse_args($_GET, $default_params);

			// Build posts filters
			$filter_categories = wp_dropdown_categories( array(
						'show_option_all'    => esc_html__('View all categories', $this->textdomain),
						'orderby'            => 'name',
						'show_count'         => 1,
						'hide_empty'         => 1,
						'echo'               => 0,
						'selected'           => $params['cat'])
				);

			$status_list = array(
				'any'		=> 'All',
				'future'	=> 'Future',
				'publish'	=> 'Published',
				'pending'	=> 'Pending',
				'draft'		=> 'Draft');

			$filter_status = '';
			foreach ($status_list as $status => $label) {
				$filter_status .= '<li>'.
								'<input type="radio" name="ps" value="'.$status.'" '.
								checked( $params['ps'], $status, false).' /> '.
								esc_html__($label).
								'&nbsp;&nbsp;&nbsp;&nbsp;</li>'."\n";
			}

			$filter_post_types = '';
			/* Get list of post type attached to the series taxonomy */
			EG_Series_Common::get_post_custom_types($this->options_entry, $this->options,
										$list_of_custom_post_type, $selected_custom_post_type);

			if (sizeof($selected_custom_post_type) > 0) {
				$filter_post_types = '<select name="pt">'."\n".
									'<option value="any" '.selected('any', $params['pt'], false).' >'.esc_html__('Show all types', $this->textdomain).'</option>'."\n";
				// $managed_post_types = wp_list_pluck($manage_post_types, 'label');
				foreach ($selected_custom_post_type as $value) {
					$filter_post_types .= '<option value="'.$value.'" '.selected($value, $params['pt'], false).' >'.esc_html($list_of_custom_post_type[$value]).'</option>';
				}
				$filter_post_types .= '</select>'."\n";
			}

			$args = array(
				'cat' 				=> $params['cat'],
				'post_status'		=> $params['ps'],
				'post_type'			=> ('any' == $params['pt'] ? $selected_custom_post_type : $params['pt']),
				'posts_per_page'	=> 25,
				'orderby'			=> 'date',
				'order'				=> 'desc',
				'tax_query'			=> array(
					array(
						'taxonomy' 	=> EGS_TAXONOMY,
						'field' 	=> 'id',
						'terms' 	=> $serie_ids,
						'operator' 	=> 'NOT IN'
					)
				)
			);
			if ('' != $params['m']) {
				$args['year'] 	  = intval(substr($params['m'], 0, 4));
				$args['monthnum'] = intval(substr($params['m'],4));
			}

			$query = new WP_Query($args);

			$page_links = paginate_links(array(
						'base'		=> add_query_arg( 'paged', '%#%' ), /* '%_%', */
						/* 'format'    => '?paged=%#%', */
						'total'     => $query->max_num_pages,
						'current'   => max( 1, $params['paged'])
					)
				);
?>
			<h3><?php esc_html_e('Filters', $this->textdomain); ?></h3>
			<form method="GET" action="">
				<input type="hidden" name="page" value="egs_post_edit" />
				<ul class="subsubsub">
					<?php echo $filter_status; ?>
				</ul>
				<div class="tablenav top">
					<div class="alignleft">
						<?php echo $filter_post_types; ?>
						<?php echo $filter_categories; ?>
						<?php echo $this->months_dropdown($params['m']); ?>
						<input name="s" class="button" type="submit" value="<?php esc_html_e('Filter'); ?>" />
					</div>
				</div>
			</form>
			<br />
<?php
			echo '<h3>'.esc_html__('Posts', $this->textdomain).'</h3>'."\n";
			if (0 == $query->found_posts) {
				echo '<p>'.esc_html__('No post found with the current filters', $this->textdomain).'</p>'."\n";
			}
			else {
?>
			<div class="tablenav top">
				<div class="alignright tablenav-pages">
					<?php echo $page_links; ?>
				</div>
				<br class="clear" />
			</div>
<?php
				echo '<ul id="posts-list" class="egs-sortable">'."\n";
				while( $query->have_posts() ) {
					$query->the_post();
					echo '<li id="post-'.get_the_ID().'" >'.get_the_title().' - '.get_the_date().'</li>';
				} // End of while
				echo '</ul>'."\n";
			} // End of posts found
		} // End of bulk_edition_display_posts

		function months_dropdown( /*$post_type*/ ) {
			global $wpdb, $wp_locale;

			$months = $wpdb->get_results( 'SELECT DISTINCT YEAR( post_date ) AS year, MONTH( post_date ) AS month '.
										"FROM $wpdb->posts ".
										'ORDER BY post_date DESC' );
/* WHERE post_type = %s */
// eg_plugin_error_log($this->name, 'Number of months found', count( $months ));
			$string = '';
			$m = isset( $_GET['m'] ) ? (int) $_GET['m'] : 0;
			if ( count( $months ) > 0) {
				$string = '<select name="m">'.
						'<option '.selected( $m, 0, false ). 'value="0">'.esc_html__( 'Show all dates' ).'</option>';
			}
			foreach ( $months as $arc_row ) {
				if ( 0 != $arc_row->year ) {
					// $month = zeroise( $arc_row->month, 2 );*/
					$month = $arc_row->month;
					$year = $arc_row->year;
					$string .= '<option '.selected( $m, $year . $month, false ).' value="'.esc_attr( $arc_row->year . $month ).'">'.
									 $wp_locale->get_month( $month ).' '.$year.
								'</option>';
				} // End of
			} // End of foreach
			$string .= '</select>';
			return ($string);
		} // End of months_dropdown


		/**
		 * bulk_edition
		 *
		 * Manage series
		 *
		 * @param 	none
		 * @return 	none
		 */
		function bulk_edition() {

			/**
			 * Build the metaboxes for series
			 *
			 */

			// Get the list of series
			$series_list = EG_Series_Common::get_series_list($this->options);

			// Add metaboxes (1 per serie)
			$series_ids  = array();
			if ( $series_list and sizeof($series_list)>0 ) {
				foreach ($series_list as $key => $serie) {
					add_meta_box('seriebox-'.$serie->term_id,
									$serie->name,
									array($this, 'bulk_edition_display_series'),
									$this->bulk_edit_hook,
									'side',
									'core'
								);
					$series_ids[] = $serie->term_id;
				} // End of forach
			} // End of series_list not empty

			/**
			 * Add metabox for posts
			 *
			 */
			add_meta_box('eg-series-posts-list',
						esc_html__('Available posts', $this->textdomain),
						array($this, 'bulk_edition_display_posts'),
						$this->bulk_edit_hook,
						'normal',
						'core'
					);

?>
			<div class="wrap">
			<?php screen_icon(); ?>
				<h2><?php _e('EG-Series Bulk Edit', $this->textdomain); ?></h2>
				<div id="ajax-wait" class="updated"><p>
					<img height="16" width="16" src="<?php echo admin_url('images/loading.gif'); ?>"/> <?php _e('Processing, please wait ...', $this->textdomain); ?>
				</p></div>
				<div id="ajax-response"> </div>
				<div class="egs-stuff">
					<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
					<div class="egs-body">
						<div class="egs-posts-container metabox-holder">
							<?php do_meta_boxes($this->bulk_edit_hook, 'normal', /* $series_slug */ $series_ids); ?>
						</div>
						<div class="egs-series-container metabox-holder">
							<?php
							if (sizeof($series_ids)>0) {
								do_meta_boxes($this->bulk_edit_hook, 'side', FALSE);
							}
							?>
						</div>
						<br class="clear" />
					</div>
				</div>
			</div>

<?php
		} // End of bulk_edition

		/**
		 * display_num_series_dashboard
		 *
		 * display the number of series in the dashboard
		 *
		 * @param 	none
		 * @return 	none
		 */
		function display_num_series_dashboard() {
			echo '<tr>'.
				'<td class="first b"><a href="'.admin_url('edit-tags.php?taxonomy=series').'">'.number_format_i18n( wp_count_terms(EGS_TAXONOMY) ).'</a></td>'.
				'<td class="t"><a href="'.admin_url('edit-tags.php?taxonomy=series').'">'.EGS_TAXONOMY_LABEL.'</a></td>'.
				'</tr>';
		} // End of display_num_series_dashboard

		/**
		 * add_menu_to_admin_bar
		 *
		 * Add a menu for EG-Series in the admin bar
		 *
		 * @package EG-Seriess
		 * @since 	2.1.0
		 *
		 * @param 	object	$wp_admin_bar		the admin bar
		 * @return none
		 *
		 */
		function add_menu_to_admin_bar($wp_admin_bar) {

			$this->adminbar_menu[] = array(
				'menu' => array(
						'id' 	 => sanitize_title($this->name).'-bulkedit',
						'title'  => esc_html__($this->name.' Bulk Edit', $this->textdomain),
						'href' 	 => admin_url('edit.php?page=egs_post_edit')),
				'cap'  => $this->options['access_level']
			);

			$this->adminbar_menu[] = array(
				'menu' => array(
						'id' 	 => sanitize_title($this->name).'-edit',
						'title'  => esc_html__($this->name.' Edit', $this->textdomain),
						'href' 	 => admin_url('edit-tags.php?taxonomy=series')),
				'cap'  => $this->options['access_level']
			);

			parent::add_menu_to_admin_bar($wp_admin_bar);
		} // End of add_menu_to_admin_bar

		/**
		 * options_validation
		 *
		 * Validate outputs
		 *
		 * @package EG-Plugin
		 * @since 	1.0
		 * @param	array	input	list of fields of the option form
		 * @return	string			all updated options
		 *
		 */
		function options_validation($inputs) {
			$all_options = parent::options_validation($inputs);

			if ( FALSE !== $this->changed_options && 0 < sizeof($this->changed_options)) {

				/* --- Delete cache if the user changes the url type --- */
				if ( isset( $this->changed_options['series_url'] ) ) {
					$cache_id = EGS_PLUGIN_NAME.'-series';
					delete_transient($cache_id);
				}

			} // End of check changed options

			return ($all_options);
		} // End of function options_validation

		/**
		 * clear_cache
		 *
		 * Delete cache (list of series)
		 *
		 * @param 	none
		 * @return 	none
		 */
		function clear_cache_series($term_id = 0) {
			delete_transient(EGS_PLUGIN_NAME.'-series');
		}


		/**
		 * clear_cache_posts
		 *
		 * Delete cache (list of posts)
		 *
		 * @param 	none
		 * @return 	none
		 */
		function clear_cache_posts($object_id, $terms, $tt_ids, $taxonomy, $append=false, $old_tt_ids=0) {

			if ( EGS_TAXONOMY == $taxonomy ) {

				sort($tt_ids);
				sort($old_tt_ids);

				// add a serie
				$diff1 = array_diff( $tt_ids, $old_tt_ids);
				if ( 0 != sizeof( $diff1 ) ) {

					foreach ( $terms as $value ) {

						$term = get_term_by('name', $value, EGS_TAXONOMY);
						if ( $term ) {
							$cache_id 	= EGS_PLUGIN_NAME.'-posts-'.$term->term_id;
							delete_transient($cache_id);
// eg_plugin_error_log('EGS', 'Delete transient', 	$cache_id);
						}
					} // End of foreach
				} // End of add a serie

				// Delete a serie => in this case $terms = empty
				$diff2 = array_diff( $old_tt_ids, $tt_ids);
				if ( 0 != sizeof( $diff2 ) ) {

					foreach ( $diff2 as $value ) {

						$term_removed = get_term_by( 'term_taxonomy_id', $value, EGS_TAXONOMY);
						if ( $term_removed ) {
							$cache_id 	= EGS_PLUGIN_NAME.'-posts-'.$term_removed->term_id;
							delete_transient($cache_id);
// eg_plugin_error_log('EGS', 'Delete transient', 	$cache_id);
						}
					} // End of foreach $diff2
				} // End of add a serie
			} // End of if taxonomy=serie
		} // End of function

		/**
		 * load
		 *
		 * Load the plugin
		 *
		 * @param 	none
		 * @return 	none
		 */
		function load() {
			parent::load();

			add_action('init', array( $this, 'init'));
			add_action( 'created_'.EGS_TAXONOMY, array( $this, 'clear_cache_series' ) );
			add_action( 'updated_'.EGS_TAXONOMY, array( $this, 'clear_cache_series' ) );
			add_action( 'delete_'.EGS_TAXONOMY, array( $this, 'clear_cache_series' ) );
			add_action( 'set_object_terms', array( $this, 'clear_cache_posts'), 10, 6 );
		} // End of load

	} // End of Class

} // End of if class_exists

$eg_series_admin = new EG_Series_Admin(
							'EG-Series',
							EGS_VERSION,
							EGS_OPTIONS_ENTRY,
							EGS_TEXTDOMAIN,
							EGS_COREFILE,
							$EGS_DEFAULT_OPTIONS);
$eg_series_admin->add_options_page(EGS_OPTIONS_PAGE_ID, 'EG-Series Settings', 'eg-series-settings.inc.php');
$eg_series_admin->load();
?>