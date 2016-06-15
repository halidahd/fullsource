<?php

if (! class_exists('EG_Series_Public')) {

	/**
	 * Class EG_Series_Public
	 *
	 * Implement a shortcode to display the list of series, or the list of posts for a serie.
	 *
	 * @package EG-Series
	 */
	Class EG_Series_Public extends EG_Plugin_133 {

		/**
		 * init
		 *
		 * Declare shortcode, and auto-shortcode
		 *
		 * @param 	none
		 * @return 	none
		 */
		function init() {
			EG_Series_Common::create_taxonomy($this->textdomain, $this->options);

			// Add the shortcodes
			add_shortcode($this->options['shortcode_list_posts'],  array(&$this,'posts_shortcode') );
			add_shortcode($this->options['shortcode_list_series'], array(&$this,'series_shortcode') );

			// Add the auto shortcode
			if ( $this->options['shortcode_auto'] > 0 ) {
				add_filter('the_content', array(&$this, 'shortcode_auto_content'));
				if ($this->options['shortcode_auto'] == 3) {
					add_filter('get_the_excerpt', array(&$this, 'shortcode_auto_excerpt'));
				}
			} // End of shortcode_auto
		} // End of init

		/**
		 * shortcode_auto_parameters
		 *
		 * Build a list of shortcode parameters, from the plugin options
		 *
		 * @return  array		list of parameters
		 */
		function shortcode_auto_parameters() {

			return ( array(
					'title'	    => esc_html__($this->options['shortcode_auto_title'], $this->textdomain),
					'titletag'  => $this->options['shortcode_auto_title_tag'],
					'listtype'  => $this->options['shortcode_auto_listtype'],
					'orderby'   => $this->options['shortcode_auto_orderby'],
					'order'	    => $this->options['shortcode_auto_order'],
					'show_date' => $this->options['shortcode_auto_show_date'],
					'expand'    => $this->options['shortcode_auto_expand']
				)
			);
		} // End of shortcode_auto_parameters

		/**
		 * shortcode_auto_excerpt
		 *
		 * Implement a shortcode to get the list of posts for a specified serie
		 *
		 * @param 	strong	$output	post_excerpt
		 * @return 	string	modified excerpt
		 */
		function shortcode_auto_excerpt($output) {
// eg_plugin_error_log($this->name, 'shortcode_auto_excerpt');
			if ($output &&
			    $this->shortcode_is_visible() &&
				$this->shortcode_auto_check_manual_shortcode($this->options['shortcode_list_posts'])) {

				$output = $this->post_shortcode($this->shortcode_auto_parameters()).$output;
			} // End of shortcode activated and visible
			return ($output);

		} // End of shortcode_auto_excerpt

		/**
		 * shortcode_auto_content
		 *
		 * Implement a shortcode to get the list of posts for a specified serie
		 *
		 * @param 	strong	$content	post_content
		 * @return 	string				modified post content
		 */
		function shortcode_auto_content($content = '') {
			global $post;
// eg_plugin_error_log($this->name, 'shortcode_auto_content');

			if ($this->options['shortcode_auto']  > 0 	&&
			 	$this->shortcode_is_visible() 			&&
				$this->shortcode_auto_check_manual_shortcode($this->options['shortcode_list_posts'])) {

// eg_plugin_error_log($this->name, 'Fire auto shortcode');

				$shortcode_output = $this->posts_shortcode($this->shortcode_auto_parameters());

				switch ($this->options['shortcode_auto']) {
					case 2: // At the end of post
						if (FALSE === strpos( $content, '#more-'.$post->ID) && FALSE === strpos($content, 'class="more-link"') )
							$content .= $shortcode_output;
					break;

					case 3: // Before the excerpt
						if (! $post->post_excerpt)
							$content = $shortcode_output . $content;
					break;

					case 4:
						if ($post->post_excerpt) {
							// Case of manual excerpt
							$content = $shortcode_output . $content;
						}
						else {
							// Case of teaser
							if(strpos($content, 'span id="more-')) {
								$parts = preg_split('/(<span id="more-[0-9]*"><\/span>)/', $content, -1,  PREG_SPLIT_DELIM_CAPTURE);
								$content = $parts[0].$parts[1].$shortcode_output.$parts[2];
							} // End of detect tag "more"
						} // End of teaser case
					break;
				} // End of switch
			} // End of shortcode is activated and visible
			return ($content);
		} // End of shortcode_auto_content


		/**
		 * series_shortcode
		 *
		 * Implement the series shortcode
		 *
		 * @param 	array		$args		list of shortcode parameters
		 * @return 	none
		 */
		function series_shortcode($args) {
			global $EGS_SHORTCODE_SERIES_DEFAULTS;

			$attrs  = shortcode_atts( $EGS_SHORTCODE_SERIES_DEFAULTS, $args );
			$output = EG_Series_Common::series_list($attrs, $this->options, $this->textdomain);
			if ( $output != '' ) {
				$output = $this->shortcode_title($output, $attrs['title'], $attrs['titletag']);
			}
			return ($output);
		} // End of series_shortcode

		/**
		 * posts_shortcode
		 *
		 * Implement the series shortcode
		 *
		 * @param 	array		$args		list of shortcode parameters
		 * @return 	none
		 */
		function posts_shortcode($args) {
			global $EGS_SHORTCODE_POSTS_DEFAULTS;

			$attrs  = shortcode_atts( $EGS_SHORTCODE_POSTS_DEFAULTS, $args );
			$output = EG_Series_Common::posts_list($attrs, $this->options, $this->textdomain);
			if ( $output != '' ) {
				$output = $this->shortcode_title($output, $attrs['title'], $attrs['titletag']);
			}
			return ($output);
		} // End of posts_shortcode


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
			add_action('init', array( &$this, 'init'));
		} // End of load

	} // End of Class

} // End of if class_exists

$eg_series_public = new EG_Series_Public(
							'EG-Series',
							EGS_VERSION,
							EGS_OPTIONS_ENTRY,
							EGS_TEXTDOMAIN,
							EGS_COREFILE,
							$EGS_DEFAULT_OPTIONS);
// $eg_series_public->add_stylesheet('css/eg-series.css');
$eg_series_public->load();
?>