<?php
/*
Plugin Name: EG-Series
Plugin URI: http://www.emmanuelgeorjon.com/en/plugin-eg-series-1448/
Description: Better organize and highlight your posts by grouping them into series.
Version: 2.1.1
Author: Emmanuel GEORJON
Author http://www.emmanuelgeorjon.com/
License: GPL2
Text Domain: eg-series
Domain Path: /lang/
*/

/*  Copyright 2008-2014  Emmanuel GEORJON  (email : blog@emmanuelgeorjon.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('EGS_VERSION', 	'2.1.1');
define('EGS_COREFILE',	__FILE__);

if (! class_exists('EG_Plugin_133')) {
	require('lib/eg-plugin.inc.php');
}

if (! class_exists('EG_Widget_211')) {
	require_once('lib/eg-widgets.inc.php');
}

if (! class_exists('EG_Series_Common')) {
	require('inc/eg-series-common.inc.php');
}

if (is_admin()) {
	require_once('inc/eg-series-admin.inc.php');
}
else {
	require_once('inc/eg-series-public.inc.php');
}

require_once('inc/eg-series-widgets.inc.php');

?>