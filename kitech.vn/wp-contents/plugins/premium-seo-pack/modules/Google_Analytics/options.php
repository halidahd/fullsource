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
			'google_analytics' => array(
				'title' 	=> __('Google Analytics', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> array(
					'save' => array(
						'value' => __('Save settings', $psp->localizationName),
						'color' => 'green',
						'action'=> 'psp-saveOptions'
					)
				), // true|false
				'style' 	=> 'panel', // panel|panel-widget

				// create the box elements array
				'elements'	=> array(
					array(
						'type' 		=> 'message',
						
						'html' 		=> __('
							<h2>Basic Setup</h2>
							<ul>
								<li>Create a Project in the Google APIs Console: <a href="https://console.developers.google.com" target="_blank">https://console.developers.google.com</a></li>
								<li>Enable the Analytics API under APIs & auth ->APIs </li>
								<li>Under APIs & auth -> Credentials -> Create Client ID</li>
								<li>On Application type, choose Web application </li>
								<li>On Authorized redirect URI make sure you add the link from the Premium Seo Google Settings</li>
							</ul>', $psp->localizationName),
					),
						
					'client_id' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'small',
						'force_width'=> '300',
						'title' 	=> __('Your client id:', $psp->localizationName),
						'desc' 		=> __('From the APIs console.', $psp->localizationName)
					),
					
					'client_secret' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'small',
						'force_width'=> '200',
						'title' 	=> __('Your client secret:', $psp->localizationName),
						'desc' 		=> __('From the APIs console.', $psp->localizationName)
					),
					
					'redirect_uri' 	=> array(
						'type' 		=> 'text',
						'std' 		=> home_url( '/psp_seo_oauth' ),
						'size' 		=> 'normal',
						'readonly'	=> true,
						'title' 	=> __('Redirect URI:', $psp->localizationName),
						'desc' 		=> __('Url to your app, must match one in the APIs console.', $psp->localizationName)
					),
					
					'profile_id' 	=> array(
						'type' 		=> 'select',
						'size' 		=> 'large',
						'title' 	=> __('Profile ID:', $psp->localizationName),
						'force_width'=> '200',
						'desc' 		=> __('Select your website profile from list. If list is empty please authorize first the app.', $psp->localizationName),
						'options'	=> apply_filters('psp_google_analytics_get_profiles', '')
					),
					
					'authorize' => array(
						'type' => 'buttons',
						'options' => array(
							'authorize_app' => array(
								'value' => __('Authorize the app', $psp->localizationName),
								'color' => 'blue',
								'action'=> 'psp-google-authorize-app',
								'width' => '120px'
							)
						)
					),
					
					'last_status' 	=> array(
						'type' 		=> 'textarea-array',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Authorize Last Status:', $psp->localizationName),
						'desc' 		=> __('Last Status retrieved from Google, for the Authorize operation', $psp->localizationName)
					),
					
					'profile_last_status' 	=> array(
						'type' 		=> 'textarea-array',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Get Profile ID Last Status:', $psp->localizationName),
						'desc' 		=> __('Last Status retrieved from Google, for the Get Profile ID operation', $psp->localizationName)
					),
					
					array(
						'type' 		=> 'message',
						
						'html' 		=> __('
							Add <a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a> javascript code on all pages.
						', $psp->localizationName),
					),
					
					'google_analytics_id' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'small',
						'force_width'=> '300',
						'title' 	=> __('Google Analytics ID:', $psp->localizationName),
						'desc' 		=> __('Your Google Analytics ID to be used in tracking script', $psp->localizationName)
					),
					
					'google_verify' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'small',
						'force_width'=> '500',
						'title' 	=> __('Google Webmaster Tools:', $psp->localizationName),
						'desc' 		=> __('&lt;meta name="google-site-verification" content="<u>content entered in Google Webmaster Tools box</u>" /&gt;', $psp->localizationName)
					)

				)
			)
		)
	)
);