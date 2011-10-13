<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">
	<?php wp_list_comments(array('reply_text' => 'Leave a Reply &raquo;')); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
		<div class="clear"></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

	<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?> <small><?php cancel_comment_reply_link('cancel'); ?></small></h3>

	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>
	
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( $user_ID ) : ?>
		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
	<?php else : ?>
		<div>
			<label for="author">Name</label>
			<input class="input" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /> <?php if ($req) echo "<small class='red'>* Required</small>"; ?>
		</div>
		<div>
			<label for="email">Email</label>
			<input class="input" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /> <?php if ($req) echo "<small class='red'>* Required, Private</small>"; ?>
		</div>
		<div>
			<label for="url">Website</label>				
			<input class="input" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
		</div>
	<?php endif; ?>

		<div>
			<label for="comment">Comment</label>
			<textarea name="comment" id="comment" cols="40" rows="5" tabindex="4"></textarea>
		</div>
		<div>
			<label for="submit">&nbsp;</label>
			<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
		</div>
		<?php comment_id_fields(); ?>

		<?php do_action('comment_form', $post->ID); ?>
	</form>
	
	<?php endif; // If registration required and not logged in ?>

</div> <!-- end respond -->

<?php endif; // if you delete this the sky will fall on your head ?>
