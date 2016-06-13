<?php
/**
 * module return as json_encode
 * http://www.aa-team.com
 * =======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
global $psp;
echo json_encode(
	array(
		$tryed_module['db_alias'] => array(
			/* define the form_messages box */
			'on_page_optimization' => array(
				'title' 	=> __('Mass Optimization', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> true, // true|false
				'style' 	=> 'panel', // panel|panel-widget

				// create the box elements array
				'elements'	=> array(
					/*'install_box' => array(
						'type' 	=> 'app',
						'path' 	=> '{plugin_folder_path}panel.php',
					)*/
					
					/*array(
						'type' 		=> 'message',
						
						'html' 		=> __('
							<h2>Mass Optimization</h2>
							<ul>
								<li></li>
							</ul>', $psp->localizationName)
					),*/
					
					'parse_shortcodes' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Parse content shortcodes:', $psp->localizationName),
						'desc' 		=> __('if you chose yes, the shortcodes in the page/post content are also parsed by optimization algorithm, but it will be more time consuming.', $psp->localizationName),
						'options'	=> array(
							'yes' => 'YES',
							'no' => 'NO'
						)
						
					),
					
					'charset' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Server Charset:', $psp->localizationName),
						'desc' 		=> __('Server Charset (used by php-query class)', $psp->localizationName)
					)
				)
			)
		)
	)
);