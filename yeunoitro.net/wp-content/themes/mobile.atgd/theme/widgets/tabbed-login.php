<?php

/*-----------------------------------------------------*/
/* Tabbed Login Widget                                 */
/* http://wordpress.org/extend/plugins/tabbed-login/   */
/* Vivek Marakana <http://htmlcsstutor.com>            */
/* Modified by James Dimick for WPZOOM.                */
/*-----------------------------------------------------*/

class Wpzoom_Tabbed_Login extends WP_Widget {

	function Wpzoom_Tabbed_Login() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-login tabbed-login-widget', 'description' => 'Display Tabbed Login/Register/LostPassword form in sidebar.' );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'wpzoom-tabbed-login-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-tabbed-login-widget', 'WPZOOM: Tabbed Login Widget', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Before widget (defined by themes). */
		echo $before_widget;
?>



<div id="login-register-password">

	<?php global $user_ID, $user_identity,$current_url;
		  $current_url='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];		
	get_currentuserinfo(); if (!$user_ID) { ?>

	<ul class="tabs_login">
		<li class="active_login"><a href="#login" ><?php _e('Login', 'wpzoom'); ?></a></li>
		<?php  if(get_option('users_can_register')) { ?>  
		<li><a href="#register"><?php _e('Register', 'wpzoom') ?></a></li>
		<?php }; ?>
		<li><a href="#forgot_password"><?php _e('Forgot', 'wpzoom'); ?></a></li>
	</ul>
	<div class="tab_container_login">
		<div id="login" class="tab_content_login">

			<?php $register = $_GET['register']; $reset = $_GET['reset']; if ($register == true) { ?>

			<h3><?php _e('Success!', 'wpzoom'); ?></h3>
			<p><?php _e('Check your email for the password and then return to log in.', 'wpzoom'); ?></p>

			<?php } elseif ($reset == true) { ?>
			
			<h3><?php _e('Success!', 'wpzoom'); ?></h3>
			<p><?php _e('Check your email to reset your password.', 'wpzoom'); ?></p>

			<?php } else { ?>

			<h3><?php _e('Have an account?', 'wpzoom'); ?></h3>

			<?php } ?>

			<form method="post" action="<?php echo home_url(); ?>/wp-login.php" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username', 'wpzoom'); ?>: </label>
					<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" />
				</div>
				<div class="password">
					<label for="user_pass"><?php _e('Password', 'wpzoom'); ?>: </label>
					<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />
				</div>				
				<div class="login_fields">
					<div class="rememberme">
						<label for="rememberme">
							<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /><?php _e(' Remember me', 'wpzoom'); ?>
						</label>
					</div>
					<?php do_action('login_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Login', 'wpzoom'); ?>" tabindex="14" class="user-submit" />
					<input type="hidden" name="redirect_to" value="<?php echo $current_url; ?>" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>
		
		<?php  if(get_option('users_can_register')) { ?>  
		
		<div id="register" class="tab_content_login" style="display:none;">
			<h3><?php _e('Register for this site!', 'wpzoom'); ?></h3>
			<p><?php _e('Sign up now for the good stuff.', 'wpzoom'); ?></p>
			<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username', 'wpzoom'); ?>: </label>
					<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" />
				</div>
				<div class="password">
					<label for="user_email"><?php _e('Your Email', 'wpzoom'); ?>: </label>
					<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" />
				</div>
				<div class="login_fields">
					<?php do_action('register_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Sign up!', 'wpzoom'); ?>" class="user-submit" tabindex="103" />
					<?php $register = $_GET['register']; if($register == true) { echo '<p>Check your email for the password!</p>'; } ?>
					<input type="hidden" name="redirect_to" value="<?php echo $current_url; ?>?register=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>
		
		<?php }; ?>
		
		<div id="forgot_password" class="tab_content_login" style="display:none;">
			<h3><?php _e('Lost Your Password?', 'wpzoom'); ?></h3>
			<p><?php _e('Enter your username or email to reset your password.', 'wpzoom'); ?></p>
			<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login" class="hide"><?php _e('Username or Email', 'wpzoom'); ?>: </label>
					<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
				</div>
				<div class="login_fields">
					<?php do_action('login_form', 'resetpass'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Reset my password', 'wpzoom'); ?>" class="user-submit" tabindex="1002" />
					<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>'.__('A message was sent to your email address.','wpzoom').'</p>'; } ?>
					<input type="hidden" name="redirect_to" value="<?php echo $current_url; ?>?reset=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>
	</div>

	<?php } else { // is logged in ?>

	<div class="sidebox">
		<h3 class="title"><?php _e('Welcome, ', 'wpzoom'); ?> <?php echo $user_identity; ?></h3><div class="clear"></div>
		<?php if (version_compare($GLOBALS['wp_version'], '2.5', '>=')){
			if (get_option('show_avatars')){
		?>
		<div class="usericon">
			<?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 50); ?>
		</div>
		<?php  }else{?>		
		<style type="text/css">.userinfo p{margin-left: 0px !important;text-align:center;}.userinfo{width:100%;}</style>
		<?php }}?>	
		<div class="userinfo">
			<p><?php _e('You are logged in as ', 'wpzoom'); ?> <strong><?php echo $user_identity; ?></strong></p>
			<p>
				<a href="<?php echo wp_logout_url($current_url); ?>"><?php _e('Log out', 'wpzoom'); ?></a> | 
				<?php if (current_user_can('manage_options')) { 
					echo '<a href="' . admin_url() . '">' . __('Admin', 'wpzoom') . '</a>'; } else { 
					echo '<a href="' . admin_url() . 'profile.php">' . __('Profile', 'wpzoom') . '</a>'; } ?>

			</p>
		</div>
		<?php if ( function_exists('wpfp_list_favorite_posts') ) wpfp_list_favorite_posts(); ?>
	</div>

	<?php } ?>

</div>

<?php
		echo $after_widget;
	}
	
	function form( $instance ) {
	?>
		<p>
			<?php _e('No option available for this widget.', 'wpzoom'); ?>
			<br/><strong><?php _e('Note : Do not put the same widget twice in a page.', 'wpzoom'); ?></strong>
		</p>

	<?php
	}
}

function wpzoom_register_tl_widget() {
	register_widget('Wpzoom_Tabbed_Login');
}
add_action('widgets_init', 'wpzoom_register_tl_widget');
?>