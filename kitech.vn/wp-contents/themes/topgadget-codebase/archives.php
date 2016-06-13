<?php
/* Template Name: Archive Page */

get_header(); ?>

<div id="content-wrapper" class="site-content">
	<div id="content" role="main">
		<section>
			<style>.post-wrapper-parent {
					margin-top: 0px !important;
				}

				.zc a {
					color: #444
				}

				#thearchivelist a {
					color: #555
				}

				#thearchivelist {
					width: 139px;
					float: left;
				}

				#thearchivelist ul li {
					list-style: none;
					border-bottom: 1px solid #f6f6f6;
					padding: 3px 0;
					font-size: 13px
				}

				#thearchivelist ul h4 {
					font-weight: bold;
					font-size: 16px !important;
					padding: 0 3px 0 0 !important;
					margin: 0px 0 5px 0 !important;
					border-bottom: 1px solid #ddd
				}

				#thearchivelist ul, .zc ul {
					margin: 7px 0 0 10px;
				}

				.zc ul {
					list-style: none;
				}

				.zc ul li {
					list-style: circle;
					border-bottom: 1px solid #eee;
					padding: 7px 0;
					font-size: 13px
				}

				.zc {
					width: 480px;
					float: right;
				}</style>
			<div id="thearchivelist">
				<ul><h4><?php _e( "Pages", "mm" ); ?>:</h4>
					<?php wp_list_pages( 'title_li=' ); ?>
				</ul>
				<br/>
				<ul><h4><?php _e( "By Month", "mm" ); ?>:</h4>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
				<br/>
				<ul><h4><?php _e( "By Category", "mm" ); ?>:</h4>
					<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
				</ul>
				<br/>
			</div>
			<div class="zc">
				<h4 style="font-weight:bold;margin: 8px 0 9px 0 !important;font-size: 17px !important;border-bottom: 1px solid #ddd;padding: 0 0px 0 0 !important;"><?php _e( "Browse Last 45 Articles:", "mm" ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=postbypost&limit=45' ); ?>
				</ul>
			</div>
			<div class="clr"></div>

		</section>
	</div>
	<!-- #content -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
