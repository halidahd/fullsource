<?php
/**
 * Smushit Config file, return as json_encode
 * http://www.aa-team.com
 * ======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
 echo json_encode(
	array(
		'smushit' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 13,
				'title' => __('Smushit', $psp->localizationName)
				,'icon' => 'assets/menu_icon.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32.png',
				'url'	=> admin_url('admin.php?page=' . $psp->alias . "_smushit")
			),
			'description' => __('Smush.it uses optimization techniques specific to image format to remove unnecessary bytes from image files. It is a "lossless" tool, which means it optimizes the images without changing their look or visual quality', $psp->localizationName),
			'module_init' => 'init.php',
      	  	'help' => array(
				'type' => 'remote',
				'url' => 'http://docs.aa-team.com/premium-seo-pack/documentation/media-smushit/'
			),
			'load_in' => array(
				'backend' => array(
					'admin.php?page=psp_smushit',
					'admin-ajax.php',
					//'upload.php',
					'media-new.php'
				),
				'frontend' => false
			),
			'javascript' => array(
				'admin',
				'hashchange',
				'tipsy',
				'ajaxupload'
			),
			'css' => array(
				'admin'
			)
		)
	)
 );