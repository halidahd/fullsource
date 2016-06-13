<?php
if ( ! is_admin() ) {
	add_action( 'wp_print_scripts', 'm3_js' );
}
function m3_js() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'cameramin', get_bloginfo( 'template_directory' ) . '/js/camera.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jqueryeasing', get_bloginfo( 'template_directory' ) . '/js/jquery.easing.1.3.js', array( 'jquery' ) );
	wp_enqueue_script( 'js', get_bloginfo( 'template_directory' ) . '/js/js.js', array( 'jquery' ) );
	wp_enqueue_script( 'ddsmoothmenu1', get_bloginfo( 'template_directory' ) . '/js/ddsmoothmenu1.js', array( 'jquery' ) );
}