<?php //if ( comments_open() ) : ?>
<div id="respond">
	<h3><?php comment_form_title( __( 'Để lại một bình luận', 'mm' ) ); ?></h3>

	<div id="respond-content">
		<div class="fb-comments" xid="<?php echo $post->ID; ?>" data-href="<?php echo get_permalink(); ?>"
			 data-width="100%" data-numposts="5"></div>
	</div>
</div>
<?php //endif; // if you delete this the sky will fall on your head ?>

<?php
//// Do not delete these lines
//	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
//		die ('Please do not load this page directly. Thanks!');
//	if ( post_password_required() ) {
?>
<!--		<p class="no-comments">This post is password protected. Enter the password to view comments.</p>-->
<!--	--><?php
//		return;
//	}
//
?>
<!-- You can start editing here. -->
<?php //if ( have_comments() ) : ?>
<!--	<h3 class="numberofcomments"><span>--><?php //comments_popup_link( __( 'No Comments', 'mm' ), __( '1 Comment', 'mm' ), __( '% Comments', 'mm' ) ); ?><!-- --><?php //_e("so far. Feel free to join this conversation.", "mm"); ?><!--</span></h3>-->
<!--	<div id="comments"><div id="comments-content">-->
<!--	<ol class="commentlist">-->
<!--		--><?php //wp_list_comments('type=comment&avatar_size=60&callback=thecomment'); ?>
<!--	</ol>-->
<!--	<div class="comments-navigation">-->
<!--	    <div class="alignleft">--><?php //previous_comments_link(); ?><!--</div>-->
<!--	    <div class="alignright">--><?php //next_comments_link(); ?><!--</div>-->
<!--	</div>-->
<!--	</div></div>-->
<?php //else : // this is displayed if there are no comments so far ?>
<!--	--><?php //if ( comments_open() ) : ?><!-- -->
<!--		<!-- If comments are open, but there are no comments. -->
<!--	 --><?php //else : // comments are closed ?>
<!--		<!-- If comments are closed. -->
<!--	 -->
<!-- -->
<!--	--><?php //endif; ?>
<?php //endif; ?>
<?php //if ( comments_open() ) : ?>
<!--<div id="respond"> -->
<!--	<h3>--><?php //comment_form_title( __('Leave A Response','mm' ) ); ?><!--</h3>-->
<!--	<div id="respond-content">-->
<!--	<p class="cancel-comment-reply">--><?php //cancel_comment_reply_link(); ?><!--</p>-->
<!--	--><?php //if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<!--	<p>--><?php //_e("You must be", "mm"); ?><!--  <a href="--><?php //echo wp_login_url( get_permalink() ); ?><!--">--><?php //_e("logged in", "mm"); ?><!-- </a> --><?php //_e("to post a comment.", "mm"); ?><!-- </p>-->
<!--	--><?php //else : ?>
<!--	<form action="--><?php //echo get_option('siteurl'); ?><!--/wp-comments-post.php" method="post">-->
<!--		--><?php //if ( is_user_logged_in() ) : ?>
<!--		<p>--><?php //_e("Logged in as", "mm"); ?><!--  <a href="--><?php //echo get_option('siteurl'); ?><!--/wp-admin/profile.php">--><?php //echo $user_identity; ?><!--</a>. <a href="--><?php //echo wp_logout_url(get_permalink()); ?><!--" title="Log out of this account">--><?php //_e("Log out &raquo;", "mm"); ?><!-- </a></p>-->
<!--		<div id="comment-textarea-admin">-->
<!--			<label for="comment">--><?php //_e("Comment", "mm"); ?><!--</label>-->
<!--			<textarea name="comment" id="comment" cols="50" rows="4" tabindex="4" class="textarea-comment"></textarea>-->
<!--		</div>-->
<!--		<div id="comment-submit-admin">-->
<!--			<p><input name="submit" type="submit" id="submitcomment" tabindex="5" value=" --><?php //_e("Post Comment", "mm"); ?><!-- " class="comment-submit" /></p>-->
<!--			--><?php //comment_id_fields(); ?>
<!--			--><?php //do_action('comment_form', $post->ID); ?>
<!--		</div>-->
<!--		--><?php //else : ?><!-- -->
<!--		<div id="comment-input">-->
<!--			<label for="author">--><?php //_e("Name", "mm"); ?><!-- <span class="req">--><?php //_e("(required)", "mm"); ?><!--</span></label>-->
<!--			<input type="text" name="author" id="author" value="--><?php //echo esc_attr($comment_author); ?><!--" size="22" tabindex="1" --><?php //if ($req) echo "aria-required='true'"; ?><!-- class="input-name" />-->
<!--			<label for="email">--><?php //_e("Email", "mm"); ?><!--  <span class="req">--><?php //_e("(required)", "mm"); ?><!--</span></label>-->
<!--			<input type="text" name="email" id="email" value="--><?php //echo esc_attr($comment_author_email); ?><!--" size="22" tabindex="2" --><?php //if ($req) echo "aria-required='true'"; ?><!-- class="input-email"  />-->
<!--			<label for="url">--><?php //_e("Website", "mm"); ?><!-- </label>-->
<!--			<input type="text" name="url" id="url" value="--><?php //echo esc_attr($comment_author_url); ?><!--" size="22" tabindex="3" class="input-website" />-->
<!--		</div>-->
<!--		<div id="comment-textarea">-->
<!--			<label for="comment">--><?php //_e("Comment", "mm"); ?><!-- </label>-->
<!--			<textarea name="comment" id="comment" cols="39" rows="4" tabindex="4" class="textarea-comment"></textarea>-->
<!--		</div>-->
<!--		<div id="comment-submit">-->
<!--			<p><input name="submit" type="submit" id="submitcomment" tabindex="5" value=" --><?php //_e("Post Comment", "mm"); ?><!-- " class="comment-submit" /></p>-->
<!--			--><?php //comment_id_fields(); ?>
<!--			--><?php //do_action('comment_form', $post->ID); ?>
<!--		</div>-->
<!--		--><?php //endif; ?>
<!--	</form>-->
<!--	</div>-->
<!--	--><?php //endif; // If registration required and not logged in ?>
<!--</div>-->
<?php //endif; // if you delete this the sky will fall on your head ?>
