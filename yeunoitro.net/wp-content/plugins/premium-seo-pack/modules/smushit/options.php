<?php
/**
 * module return as json_encode
 * http://www.aa-team.com
 * ======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
global $psp;
echo json_encode(
	array(
		$tryed_module['db_alias'] => array(
			/* define the form_messages box */
			'smushit' => array(
				'title' 	=> __('Smushit', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> true, // true|false
				'style' 	=> 'panel', // panel|panel-widget

				// create the box elements array
				'elements'	=> array(

					array(
						'type' 		=> 'message',
						
						'html' 		=> __('
							<p><strong>Yahoo Smush.it API</strong> uses optimization techniques specific to image format to remove unnecessary bytes from image files. It is a "lossless" tool, which means it optimizes the images without changing their look or visual quality.</p>
							<ul>
								<li>The Yahoo Smush.it service will download the image via the URL and will then return a URL to the new version of the image, which will be downloaded and will replace the original image on your server.</li>
								<li>The image must be less than 1 megabyte in size. This is a limit of the Yahoo Smush.it service.</li>
								<li>The image must be accessible from non-https URL. This is a limit of the Yahoo Smush.it service.</li>
								<li>The Yahoo Smush.it service needs to download the image via a URL and the image needs to be on a public server and not a local local development system. This is a limit of the Yahoo Smush.it service.</li>
								<li>The image must be local to the site, not stored on a CDN (Content Delivery Networks).</li>
							</ul>
						', $psp->localizationName),
					),
					
					'resp_timeout' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '60',
						'size' 		=> 'large',
						'force_width'=> '150',
						'title' 	=> __('Response timeout: ', $psp->localizationName),
						'desc' 		=> __('enter the maximum number of seconds you want to wait for response from Smush.it service.', $psp->localizationName)
					),
					'do_upload' => array(
						'type' 		=> 'select',
						'std' 		=> 'yes',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Smush.it on Upload: ', $psp->localizationName),
						'desc' 		=> __('smush.it on media image upload', $psp->localizationName),
						'options'	=> array(
							'yes' 		=> __('YES', $psp->localizationName),
							'no' 		=> __('NO', $psp->localizationName)
						)
					),
					'same_domain_url' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Image same domain: ', $psp->localizationName),
						'desc' 		=> __('image url must be on same domain as website home url!', $psp->localizationName),
						'options'	=> array(
							'yes' 		=> __('YES', $psp->localizationName),
							'no' 		=> __('NO', $psp->localizationName)
						)
					)

				)
			)
			
		)
	)
);