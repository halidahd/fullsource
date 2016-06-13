<?php

get_header(); ?>

<div id="content-wrapper" class="site-content">
	<div id="content" role="main">
		<section>
			<div style="font-family:'Lora', Georgia,Sans-serif; font-size: 20px;margin-top: 8px;line-height:27px">
				<center><h2><?php _e( "*404* - Not Found", "mm" ); ?> </h2></center>
				<br/>
				<?php _e( "Sorry, we can't find the content you're looking for at this URL. Please navigate from the navigation menu on top or try searching below..", "mm" ); ?>
				<br/><br/>
				<center> <?php get_search_form(); ?> </center>


			</div>
		</section>
	</div>
	<!-- #content -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
