<?php
/**
 * Auto setup post thumbnail if poster not set
 */
function wpsites_auto_set_featured_image() {
	global $post;
	$featured_image_exists = has_post_thumbnail( $post->ID );
	if ( ! $featured_image_exists ) {
		$attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1&order=ASC" );
		if ( $attached_image ) {
			foreach ( $attached_image as $attachment_id => $attachment ) {
				set_post_thumbnail( $post->ID, $attachment_id );
			}
		}
	}
}

add_action( 'save_post', 'wpsites_auto_set_featured_image' );


function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );

	if ( $image_set !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}

add_action( 'admin_init', 'wpb_imagelink_setup', 10 );


function get_meta_key_title_psp() {

	$tax_seo = get_option( 'psp_taxonomy_seo' );

	$current_term_id = get_queried_object()->term_id;;

	if ( is_tag() ) {
		if ( ! empty( $tax_seo['post_tag'][ $current_term_id ]['psp_meta'] ) ) {
			echo $tax_seo['post_tag'][ $current_term_id ]['psp_meta']['title'];
		}

	} else if ( is_category() ) {

		if ( ! empty( $tax_seo['category'][ $current_term_id ]['psp_meta'] ) ) {
			echo $tax_seo['category'][ $current_term_id ]['psp_meta']['title'];
		}
	} else if ( ! empty( $tax_seo['series'][ $current_term_id ]['psp_meta'] ) ) {
		echo $tax_seo['series'][ $current_term_id ]['psp_meta']['title'];
	} else {
		echo single_tag_title();
	}
}