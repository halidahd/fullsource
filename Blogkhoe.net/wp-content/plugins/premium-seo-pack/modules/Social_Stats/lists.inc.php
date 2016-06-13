<?php

global $psp;

$psp_socialsharing_position = array();
$psp_socialsharing_position['horizontal'] = array(
	'left'			=> __('Left', $psp->localizationName),
	'right'			=> __('Right', $psp->localizationName),
	'center'		=> __('Center', $psp->localizationName)
);
$psp_socialsharing_position['vertical'] = array(
	'top'			=> __('Top', $psp->localizationName),
	'bottom'		=> __('Bottom', $psp->localizationName),
	'center'		=> __('Center', $psp->localizationName)
);

$psp_socialsharing_margin = array(
	'horizontal'	=> __('Horizontal', $psp->localizationName),
	'vertical'		=> __('Vertical', $psp->localizationName)
);

$psp_socialsharing_opt = array();
$psp_socialsharing_opt['btnsize'] = array(
	'normal'		=> __('Normal', $psp->localizationName),
	'large'			=> __('Large', $psp->localizationName)
);
$psp_socialsharing_opt['viewcount'] = array(
	'no'			=> __('No', $psp->localizationName),
	'yes'			=> __('Yes', $psp->localizationName)
);
$psp_socialsharing_opt['withtext'] = array(
	'no'			=> __('No', $psp->localizationName),
	'yes'			=> __('Yes', $psp->localizationName)
);
$psp_socialsharing_opt['withmore'] = array(
	'no'			=> __('No', $psp->localizationName),
	'yes'			=> __('Yes', $psp->localizationName)
);

$psp_socialsharing_opt['contact'] = array(
	'text_print'	=> array( 'title' => __('Print text', $psp->localizationName), 'std' => __('Print', $psp->localizationName) ),
	'text_email'	=> array( 'title' => __('Email text', $psp->localizationName), 'std' => __('Email', $psp->localizationName) ),
	'email'			=> array( 'title' => __('Email address', $psp->localizationName), 'std' => __('', $psp->localizationName) )
);

$psp_socialsharing_exclude = array(
	'include'		=> array( 'title' => __('Include only', $psp->localizationName), 'std' => __('', $psp->localizationName), 'desc' => __('Include only: the exclusive post, pages IDs list where you want the social share toolbar to appear (separate IDs by ,)', $psp->localizationName) ),
	'exclude'		=> array( 'title' => __('Exclude', $psp->localizationName), 'std' => __('', $psp->localizationName), 'desc' => __('Exclude: the post, pages IDs list where you don\'t want the social share toolbar to appear (separate IDs by ,)', $psp->localizationName) )
);

$psp_socialsharing_design['background_color'] = array( 'title' => __('Background color', $psp->localizationName), 'std' => __('', $psp->localizationName) );

$psp_socialsharing_design['make_floating'] = array(
	'no'			=> __('No', $psp->localizationName),
	'yes'			=> __('Yes', $psp->localizationName)
);

$psp_socialsharing_design['floating_beyond_content'] = array(
	'no'			=> __('No', $psp->localizationName),
	'yes'			=> __('Yes', $psp->localizationName)
);