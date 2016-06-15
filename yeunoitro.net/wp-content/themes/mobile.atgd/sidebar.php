<?php if ( is_single() || is_search() )
{
	if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar-mobile' ) )
	{
		echo '...';
	}
} ?>
