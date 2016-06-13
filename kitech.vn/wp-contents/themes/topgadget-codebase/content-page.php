<?php
/**
 * @package _s
 * @since _s 1.0
 */
?>
<div id="single-heading-content">
	<header class="entry-header-single">
		<h1 class="entry-title single-entry-title"> <?php the_title(); ?></h1>
	</header>
	<!-- .entry-header -->


	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', '_s' ) ); ?>
			<?php wp_link_pages( array( 'before'         => '<center style="background:#ddd; font-size: 14px;font-weight: bold;margin: 8px;padding: 7px 4px;"><strong>Pages:</strong>',
										'after'          => '</center>',
										'next_or_number' => 'number'
				) ); ?>
		</div>
		<!-- .entry-content -->
	</article>
	<!-- #post-<?php the_ID(); ?> -->


	<div class="cb"></div>

