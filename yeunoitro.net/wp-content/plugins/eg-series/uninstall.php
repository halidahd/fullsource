<?php
/**
 * @package Internals
 *
 * Code used when the plugin is removed (not just deactivated but actively deleted through the WordPress Admin).
 */

if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();

	/**
	 * Define constants
	 */
	define('EGS_TAXONOMY',			'series'	);
	define('EGS_PLUGIN_NAME', 		'EG-Series'	);
	define('EGS_OPTIONS_ENTRY',		'EG-Series-Options'	);
	define('EGS_SERIES_WIDGET_ID', 	'eg-series-series' );
	define('EGS_POSTS_WIDGET_ID', 	'eg-series-posts' );

	/**
	 * Get all series
	 */
	global $wpdb;

	$term_ids          = array();
	$term_taxonomy_ids = array();

	$options = get_option(EGS_OPTIONS_ENTRY);
	if ( isset($options) && $options['uninstall_del_series']) {

		$query = $wpdb->prepare('SELECT term_id, term_taxonomy_id FROM '. $wpdb->term_taxonomy .' WHERE taxonomy = %s', EGS_TAXONOMY);
		$ids = $wpdb->get_results($query);

		if ( $ids && is_array($ids) && 0 < sizeof($ids) ) {

			foreach ($ids as $values) {
				if (! isset($term_ids[$values->term_id]) )
					$term_ids[$values->term_id] = $values->term_id;

				if (! isset($term_taxonomy_ids[$values->term_taxonomy_id]) )
				$term_taxonomy_ids[$values->term_taxonomy_id] = $values->term_taxonomy_id;
			}

			if ( 0 < sizeof($term_taxonomy_ids) ) {
				$query = $wpdb->prepare( 'DELETE FROM '.$wpdb->term_relationships.' WHERE term_taxonomy_id in ( %s )', implode(',', $term_taxonomy_ids) );
				$wpdb->query($query);

				$query = $wpdb->prepare( 'DELETE FROM '.$wpdb->term_taxonomy.' WHERE term_taxonomy_id in ( %s )', implode(',', $term_taxonomy_ids) );
				$wpdb->query($query);
			}

			if ( 0 < sizeof($term_ids) ) {
				$query = $wpdb->prepare( 'DELETE FROM '.$wpdb->terms.' WHERE term_id in ( %s )', implode(',', $term_ids) );
				$wpdb->query($query);
			}
		} // End of ids found
	} // End of if uninstall_del_series

	/**
	 * Clear cache entries
	 */
	delete_transient(EGS_PLUGIN_NAME.'-series');
	if ( 0 < sizeof($term_ids) ) {
		foreach ($term_ids as $serie_id) {
			delete_transient(EGS_PLUGIN_NAME.'-posts-'.$serie_id);
			// echo 'Delete '.EGS_PLUGIN_NAME.'-posts-'.$serie_id;
		}
	}

	/**
	 * Clear options
	 */
	if ( isset($options) && $options['uninstall_del_options']) {
		delete_option(EGS_OPTIONS_ENTRY);
		// echo 'delete_option('.EGS_OPTIONS_ENTRY.')';

		delete_option( 'widget_'.EGS_SERIES_WIDGET_ID );
		// echo 'delete_option( widget_'.EGS_SERIES_WIDGET_ID.' )';

		delete_option( 'widget_'.EGS_POSTS_WIDGET_ID );
		// echo 'delete_option( widget_'.EGS_POSTS_WIDGET_ID.' )';

	} // End of if uninstall_del_options
?>