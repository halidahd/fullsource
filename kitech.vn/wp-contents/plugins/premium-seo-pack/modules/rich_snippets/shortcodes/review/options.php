<?php

global $psp;

require($psp->cfg['paths']['plugin_dir_path'] . 'modules/rich_snippets/' . 'lists.inc.php');

echo json_encode(
	array(
		array(

			/* review shortcode */
			'psp_rs_review' => array(
				'title' 	=> __('Insert Review Shortcode', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> false, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				'exclude_empty_fields'	=> true,
				'shortcode'	=> '[psp_rs_review {atts}]',

				// create the box elements array
				'elements'	=> array(
				
					'name' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Name:', $psp->localizationName),
						'desc' 		=> __('enter name', $psp->localizationName)
					)
					,'url' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Website URL:', $psp->localizationName),
						'desc' 		=> __('enter website url', $psp->localizationName)
					)
					,'image' => array(
						'type' 		=> 'upload_image',
						'size' 		=> 'large',
						'title' 	=> 'Review Image',
						'value' 	=> 'Upload image',
						'thumbSize' => array(
							'w' => '100',
							'h' => '100',
							'zc' => '2',
						),
						'desc' 		=> 'select review image'
					)
					,'description' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Description:', $psp->localizationName),
						'desc' 		=> __('enter description', $psp->localizationName)
					)
					,'best_rating' => array(
						'type' 		=> 'ratestar',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Best Rating:', $psp->localizationName),
						'desc' 		=> __('select best rating', $psp->localizationName),
						'nbstars'	=> 5
					)
					,'worst_rating' => array(
						'type' 		=> 'ratestar',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Worst Rating:', $psp->localizationName),
						'desc' 		=> __('select worst rating', $psp->localizationName),
						'nbstars'	=> 5
					)
					,'current_rating' => array(
						'type' 		=> 'ratestar',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Current Rating:', $psp->localizationName),
						'desc' 		=> __('select current rating', $psp->localizationName),
						'nbstars'	=> 5
					)
					,'item_name' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Item Name:', $psp->localizationName),
						'desc' 		=> __('enter item name', $psp->localizationName)
					)
					,'review' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Review:', $psp->localizationName),
						'desc' 		=> __('enter review body', $psp->localizationName)
					)
					,'author' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Author:', $psp->localizationName),
						'desc' 		=> __('enter author', $psp->localizationName)
					)
					,'pubdate' => array(
						'type' 		=> 'date',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Published Date:', $psp->localizationName),
						'desc' 		=> __('enter published date', $psp->localizationName)
					)

				)
			) // end shortcode
			
		)
	)
);

?>