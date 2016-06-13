<?php if ( $meta_box = get_post_meta( $post->ID, 'dbt_select', true ) == 'Disable' ) { ?>

<?php } elseif ( $meta_box = get_post_meta( $post->ID, 'dbt_select', true ) == 'Enable' ) { ?>
	<?php  if ( $images = get_children( array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => 5,
		'post_mime_type' => 'image',
	) )
	) {
		?>

		<div class="home-gallery"><?php postimage( 'thumbnail' ); ?></div>
		<div class="home-gallery-button"><span><a
					href="<?php the_permalink(); ?>"><?php _e( 'View Gallery', 'mm' ); ?></a></span></div>

	<?php } else { ?>
	<?php } ?>
<?php } else { ?><?php } ?>