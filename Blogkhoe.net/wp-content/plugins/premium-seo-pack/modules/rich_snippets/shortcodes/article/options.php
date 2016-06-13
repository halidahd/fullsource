<?php

global $psp;

require($psp->cfg['paths']['plugin_dir_path'] . 'modules/rich_snippets/' . 'lists.inc.php');

echo json_encode(
	array(
		array(

			/* article shortcode */
			'psp_rs_article' => array(
				'title' 	=> __('Insert Article Shortcode', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> false, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				'exclude_empty_fields'	=> true,
				'shortcode'	=> '[psp_rs_article {atts}]',

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
						'title' 	=> 'Article Image',
						'value' 	=> 'Upload image',
						'thumbSize' => array(
							'w' => '100',
							'h' => '100',
							'zc' => '2',
						),
						'desc' 		=> 'select article image'
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
					,'publisher' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Publisher:', $psp->localizationName),
						'desc' 		=> __('enter publisher', $psp->localizationName)
					)
					,'pubdate' => array(
						'type' 		=> 'date',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Published Date:', $psp->localizationName),
						'desc' 		=> __('enter published date', $psp->localizationName)
					)
					,'article_body' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Article Body:', $psp->localizationName),
						'desc' 		=> __('enter article body', $psp->localizationName)
					)
					,'article_section' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Article Section:', $psp->localizationName),
						'desc' 		=> __('enter article section', $psp->localizationName)
					)

				)
			) // end shortcode
			
		)
	)
);

?>