<?php

if (! class_exists('EG_Series_Series_Widget')) {

	define('EGS_SERIES_WIDGET_ID', 'eg-series-series' );

	Class EG_Series_Series_Widget extends EG_Widget_211 {

		/**
		 * __construct
		 *
		 * Constructor of the widget. Define parameters
		 *
		 * @package EG-Series
		 * @since 	1.0
		 *
		 * @param 	none
		 * @return	none
		 *
		 */
		function __construct() {
			global $EGS_SHORTCODE_SERIES_DEFAULTS;

			// widget settings
			$widget_ops = array('classname' => 'widget_eg_series_series',
								'description' => esc_html__('Display series or groups of posts', EGS_TEXTDOMAIN )
							);

			// create the widget
			parent::__construct(EGS_SERIES_WIDGET_ID, 'EG-Series Widget', $widget_ops);

			$this->fields = array(
					'title'		 => array( 'type' => 'text',  'label' => 'Title'),
					'listtype'	 => array( 'type' => 'select','label' => 'List format','list' => array(
											'select' => 'Select',
											'ul'     => 'Simple list',
											'ol' 	 => 'Ordered list')),
					'number' 	 => array( 'type' => 'numeric',  'label' => 'Number of series to display'),
					'numposts'	 => array( 'type' => 'checkbox', 'label' => 'Number of posts',
											'list' => array( 'Display number of posts?') ),
					'hide_empty' => array( 'type' => 'checkbox', 'label' => 'Empty series',
											'list' => array( 'Hide empty series (series with no posts)?') ),
					'width' 	 => array( 'type' => 'numeric',  'label' => 'Width'),
					'more' 		 => array( 'type' => 'numeric',  'label' => 'Page or Post id where all series are displayed')
			);

			$this->default_options			= $EGS_SHORTCODE_SERIES_DEFAULTS;
			$this->default_options['title'] = esc_html__('Series', EGS_TEXTDOMAIN );
			$this->textdomain 				= EGS_TEXTDOMAIN;

		} // End of constructor

		/**
		 * widget
		 *
		 * Display the widget
		 *
		 * @package EG-Series
		 * @since 	1.0
		 *
		 * @param 	array	$args		sidebar parameters
		 * @param	array	$instance	widget parameters
		 * @return	none
		 *
		 */
		function widget($args, $instance) {

			$output = '';

			/* --- Extract parameters --- */
			extract($args);

			$plugin_options = get_option(EGS_OPTIONS_ENTRY);
			$values = wp_parse_args( (array) $instance, $this->default_options );

			$output =  EG_Series_Common::series_list(array_merge($values, array('auto_submit' => 1, 'listposts' => 0)),
													$plugin_options,
													$this->textdomain);

			if ( $output != '' ) {
				$title = apply_filters('widget_title', $values['title'], $values, $this->id_base);
				echo $before_widget.
					('' != $title ? $before_title.esc_html__($title, $this->textdomain).$after_title:'').
					$output.
					$after_widget;
			} // End of $output != ''

		} // End of widget

	} // End of class

} // End of class_exists EG_Series_Series_Widget




if (! class_exists('EG_Series_Posts_Widget')) {

	define('EGS_POSTS_WIDGET_ID', 'eg-series-posts' );

	Class EG_Series_Posts_Widget extends EG_Widget_211 {

		/**
		 * __construct
		 *
		 * Constructor of the widget. Define parameters
		 *
		 * @package EG-Series
		 * @since 	1.0
		 *
		 * @param 	none
		 * @return	none
		 *
		 */
		function __construct() {
			global $EGS_SHORTCODE_POSTS_DEFAULTS;

			// widget settings
			$widget_ops = array('classname' => 'widget_eg_series_posts',
								'description' => esc_html__('Display posts of the same serie than the current post', EGS_TEXTDOMAIN ));

			// create the widget
			parent::__construct(EGS_POSTS_WIDGET_ID, 'EG-Series Posts Widget', $widget_ops);

			$this->fields = array(
					'title' 		 => array( 'type' => 'text',      'label' => 'Title'),
					'use_serie_name' => array( 'type' => 'checkbox',  'label' => 'or ',
												'list' => array( 'use serie name as title' )),
					'listtype' 		 => array( 'type' => 'select',    'label' => 'List format',
												'list' => array('select' => 'Select', 'ul' => 'Simple list', 'ol' => 'Ordered list')),
					'width' 		 => array( 'type' => 'numeric',   'label' => 'Width'),
					'orderby' 	     => array( 'type' => 'select',    'label' => 'Order by ',
												'list' => array('title'  => 'Title','date' => 'Date', 'menu_order' => 'User order')),
					'order' 	     => array( 'type' => 'select',    'label' => 'Sort order',
												'list' => array('ASC'  => 'Ascending','DESC' => 'Descending')),
					'show_date'      => array( 'type' => 'checkbox', 'label' => 'Date',
												'list' => array( 'Show date' )),
					'expand' 	     => array( 'type' => 'checkbox',  'label' => 'Details',
												'list' => array( 'Show posts excerpt' ))
			);

			$this->default_options						= $EGS_SHORTCODE_POSTS_DEFAULTS;
			$this->default_options['title'] 			= esc_html__('Posts of the same serie', EGS_TEXTDOMAIN );
			$this->default_options['use_serie_name'] 	= 0;
			$this->textdomain 							= EGS_TEXTDOMAIN;

		} // End of constructor

		/**
		 * widget
		 *
		 * Display the widget
		 *
		 * @package EG-Series
		 * @since 	1.0
		 *
		 * @param 	array	$args		sidebar parameters
		 * @param	array	$instance	widget parameters
		 * @return	none
		 *
		 */
		function widget($args, $instance) {

			$output = '';

			if ( is_singular() ) {
				/* --- Extract parameters --- */
				extract($args);

				$plugin_options = get_option(EGS_OPTIONS_ENTRY);

				$values = wp_parse_args( (array) $instance, $this->default_options );

				$output =  EG_Series_Common::posts_list($values, $plugin_options, $this->textdomain, 1);
				if ( '' != $output && $values['use_serie_name'] ) {
					global $post;
					$terms = get_the_terms($post->ID, EGS_TAXONOMY );
					$serie = reset($terms);
					$values['title'] = $serie->name;
				}
			} // End of singular

			if ( $output != '' ) {
				$title = apply_filters('widget_title', $values['title'], $values, $this->id_base);
				echo $before_widget.
					('' != $title ? $before_title.esc_html__($title, $this->textdomain).$after_title:'').
					$output.
					$after_widget;
			} // End of $output != ''

		} // End of widget

	} // End of class

} // End of class_exists EG_Series_Posts_Widget

function EG_Series_Series_Widgets_init() {
	register_widget('EG_Series_Series_Widget');
	register_widget('EG_Series_Posts_Widget');
}
add_action('init', 'EG_Series_Series_Widgets_init', 1);

?>