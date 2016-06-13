<?php

global $psp;

require($psp->cfg['paths']['plugin_dir_path'] . 'modules/rich_snippets/' . 'lists.inc.php');

echo json_encode(
	array(
		array(

			/* person shortcode */
			'psp_rs_person' => array(
				'title' 	=> __('Insert Person Shortcode', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> false, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				'exclude_empty_fields'	=> true,
				'shortcode'	=> '[psp_rs_person {atts}]',

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
						'title' 	=> 'Person Image',
						'value' 	=> 'Upload image',
						'thumbSize' => array(
							'w' => '100',
							'h' => '100',
							'zc' => '2',
						),
						'desc' 		=> 'select person image'
					)
					,'orgname' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Organization:', $psp->localizationName),
						'desc' 		=> __('enter organization', $psp->localizationName)
					)
					,'jobtitle' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Job Title:', $psp->localizationName),
						'desc' 		=> __('enter job title', $psp->localizationName)
					)

					,'description' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Description:', $psp->localizationName),
						'desc' 		=> __('enter description', $psp->localizationName)
					)
					,'bday' => array(
						'type' 		=> 'date',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Birtday Date:', $psp->localizationName),
						'desc' 		=> __('enter birthday date', $psp->localizationName),
						
						'defaultDate'	=> date('Y-m-d', strtotime("-10 years")),
						'yearRange'		=> ( date('Y', strtotime("-90 years")) . ':' . date('Y', strtotime("-10 years")) )
					)
					,'street' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Street Address:', $psp->localizationName),
						'desc' 		=> __('enter street address', $psp->localizationName)
					)
					,'pobox' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('P.O. Box:', $psp->localizationName),
						'desc' 		=> __('enter p.o. box', $psp->localizationName)
					)
					,'city' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('City:', $psp->localizationName),
						'desc' 		=> __('enter city', $psp->localizationName)
					)
					,'state' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('State or Region:', $psp->localizationName),
						'desc' 		=> __('enter state or region', $psp->localizationName)
					)
					,'postalcode' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Postal code or Zipcode:', $psp->localizationName),
						'desc' 		=> __('enter postal code or zipcode', $psp->localizationName)
					)
					,'country' => array(
						'type' 		=> 'select',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '200',
						'title' 	=> __('Country:', $psp->localizationName),
						'desc' 		=> 'select country',
						'options'	=> array_merge( array('none' => __('Select country', $psp->localizationName)), $psp_countries_list )
					)
					,'map_latitude' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Latitude:', $psp->localizationName),
						'desc' 		=> __('enter latitude', $psp->localizationName)
					)
					,'map_longitude' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Longitude:', $psp->localizationName),
						'desc' 		=> __('enter longitude', $psp->localizationName)
					)
					,'email' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Email:', $psp->localizationName),
						'desc' 		=> __('enter email', $psp->localizationName)
					)
					,'phone' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Phone:', $psp->localizationName),
						'desc' 		=> __('enter phone', $psp->localizationName)
					)

				)
			) // end shortcode
			
		)
	)
);

?>