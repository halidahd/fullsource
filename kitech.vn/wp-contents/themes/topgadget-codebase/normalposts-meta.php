<div class="meta_author-area">

	<div class="metainfoleft">
		<div class="home-category"><?php the_category(); ?></div>
		<div class="info">
			<?php _e( "Posted on", "mm" ); ?>  <span class="date"> <?php the_time( 'd/m/Y' ) ?>  </span>
			<!--			--><?php //_e("by", "mm"); ?><!--   <a href="-->
			<?php //echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?><!--" title="-->
			<?php //printf( esc_attr__( 'View all posts by %s', 'mm'), get_the_author() ); ?><!--">-->
			<?php //the_author(); ?><!--</a> -->
		</div>
		<div class="cb"></div>
	</div>

	<div class="meta-info-right">
		<div class="socialcount">
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style ">
				<!--			<div class="fb-like addthis_button_facebook" data-layout="button_count" data-share="false" data-show-faces="false"></div>-->
				<!--		<a class="addthis_button_facebook" href="--><?php //the_permalink(); ?><!--" title="-->
				<?php //the_title(); ?><!-- - --><?php //the_permalink(); ?><!--"></a>-->
				<!--		<a class="addthis_button_twitter" addthis:url="-->
				<?php //the_permalink(); ?><!--" addthis:title="--><?php //the_title(); ?><!-- - -->
				<?php //the_permalink(); ?><!--"></a>-->
				<!--		<a class="addthis_button_google_plusone_share" href="-->
				<?php //the_permalink(); ?><!--" title="--><?php //the_title(); ?><!-- - -->
				<?php //the_permalink(); ?><!--"></a>-->
				<!--		<a class="addthis_button_pinterest_share" addthis:url="-->
				<?php //the_permalink(); ?><!--" addthis:title="--><?php //the_title(); ?><!-- - -->
				<?php //the_permalink(); ?><!--"></a>-->
				<!--		<a class="addthis_button_compact" href="--><?php //the_permalink(); ?><!--" title="-->
				<?php //the_title(); ?><!-- - --><?php //the_permalink(); ?><!--"></a>-->
			</div>
			<!-- AddThis Button END -->
		</div>

		<!--		<span class="comments-link">-->
		<?php //comments_popup_link( __( '#0', '_s' ), __( '#1', '_s' ), __( '#%', '_s' ) ); ?><!--</span>-->
	</div>

	<div class="cb"></div>

</div>
