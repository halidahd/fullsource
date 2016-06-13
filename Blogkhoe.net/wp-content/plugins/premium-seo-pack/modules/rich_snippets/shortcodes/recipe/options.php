<?php

global $psp;

require($psp->cfg['paths']['plugin_dir_path'] . 'modules/rich_snippets/' . 'lists.inc.php');

echo json_encode(
	array(
		array(

			/* recipe shortcode */
			'psp_rs_recipe' => array(
				'title' 	=> __('Insert Recipe Shortcode', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> false, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				'exclude_empty_fields'	=> true,
				'shortcode'	=> '[psp_rs_recipe {atts}]',

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
					,'image' => array(
						'type' 		=> 'upload_image',
						'size' 		=> 'large',
						'title' 	=> 'Recipe Image',
						'value' 	=> 'Upload image',
						'thumbSize' => array(
							'w' => '100',
							'h' => '100',
							'zc' => '2',
						),
						'desc' 		=> 'select recipe image'
					)
					,'description' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Description:', $psp->localizationName),
						'desc' 		=> __('enter description', $psp->localizationName)
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
					,'prephours' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Preparation hours:', $psp->localizationName),
						'desc' 		=> __('enter preparation duration - hours', $psp->localizationName)
					)
					,'prepmins' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Preparation mins:', $psp->localizationName),
						'desc' 		=> __('enter preparation duration - mins', $psp->localizationName)
					)
					,'cookhours' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Cook hours:', $psp->localizationName),
						'desc' 		=> __('enter cook duration - hours', $psp->localizationName)
					)
					,'cookmins' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Cook mins:', $psp->localizationName),
						'desc' 		=> __('enter cook duration - mins', $psp->localizationName)
					)
					
					,'yield' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Recipe Yield:', $psp->localizationName),
						'desc' 		=> __('The quantity produced by the recipe (for example, number of people served, number of servings, etc)', $psp->localizationName)
					)
					,'calories' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Calories:', $psp->localizationName),
						'desc' 		=> __('The number of calories', $psp->localizationName)
					)
					,'fatcount' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Fat count:', $psp->localizationName),
						'desc' 		=> __('The number of grams of fat', $psp->localizationName)
					)
					,'sugarcount' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Sugar count:', $psp->localizationName),
						'desc' 		=> __('The number of grams of sugar', $psp->localizationName)
					)
					,'saltcount' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Salt count:', $psp->localizationName),
						'desc' 		=> __('The number of milligrams of sodium', $psp->localizationName)
					)
					,'instructions' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Instructions:', $psp->localizationName),
						'desc' 		=> __('The steps to make the dish', $psp->localizationName)
					)

				)
			) // end shortcode
			
		)
	)
);

?>