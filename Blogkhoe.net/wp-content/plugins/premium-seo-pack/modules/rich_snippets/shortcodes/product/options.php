<?php

global $psp;

require($psp->cfg['paths']['plugin_dir_path'] . 'modules/rich_snippets/' . 'lists.inc.php');

echo json_encode(
	array(
		array(

			/* product shortcode */
			'psp_rs_product' => array(
				'title' 	=> __('Insert Product Shortcode', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> false, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				'exclude_empty_fields'	=> true,
				'shortcode'	=> '[psp_rs_product {atts}]',

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
						'title' 	=> 'Product Image',
						'value' 	=> 'Upload image',
						'thumbSize' => array(
							'w' => '100',
							'h' => '100',
							'zc' => '2',
						),
						'desc' 		=> 'select product image'
					)
					,'description' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Description:', $psp->localizationName),
						'desc' 		=> __('enter description', $psp->localizationName)
					)
					,'brand' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Brand:', $psp->localizationName),
						'desc' 		=> __('enter brand', $psp->localizationName)
					)
					,'manufacturer' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Manufacturer:', $psp->localizationName),
						'desc' 		=> __('enter manufacturer', $psp->localizationName)
					)
					,'model' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Model:', $psp->localizationName),
						'desc' 		=> __('enter model', $psp->localizationName)
					)
					,'prod_id' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Product ID:', $psp->localizationName),
						'desc' 		=> __('enter product id', $psp->localizationName)
					)
					,'price' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Price:', $psp->localizationName),
						'desc' 		=> __('enter price', $psp->localizationName)
					)
					,'currency' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Currency:', $psp->localizationName),
						'desc' 		=> __('ex: USD, CAD, GBP (full list is on <a href="http://en.wikipedia.org/wiki/ISO_4217" target="_blank">Wikipedia</a>', $psp->localizationName)
					)
					,'item_name' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Item Name:', $psp->localizationName),
						'desc' 		=> __('enter item name', $psp->localizationName)
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
					,'avg_rating' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Average Rating:', $psp->localizationName),
						'desc' 		=> __('The count of total number of ratings.', $psp->localizationName)
					)
					,'nb_reviews' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Number of Reviews:', $psp->localizationName),
						'desc' 		=> __('The count of total number of reviews.', $psp->localizationName)
					)
					,'condition' => array(
						'type' 		=> 'select',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '200',
						'title' 	=> __('Condition:', $psp->localizationName),
						'desc' 		=> 'select condition',
						'options'	=> array_merge( array('none' => __('Select condition', $psp->localizationName)), $psp_product_condition )
					)
					,'availability' => array(
						'type' 		=> 'select',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '200',
						'title' 	=> __('Availability:', $psp->localizationName),
						'desc' 		=> 'select availability',
						'options'	=> array_merge( array('none' => __('Select availability', $psp->localizationName)), $psp_product_availability )
					)

				)
			) // end shortcode
			
		)
	)
);

?>