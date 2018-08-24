<? php wp_list_comments(); ?>
<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">Ввидите пароль.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = '';
?>

<br />
<?php if ($comments) : ?>

	<h4 id="comments">Обсуждение. <?php comments_number('Ïîêà íåò êîììåíòàðèåâ', 'Åñòü 1 êîììåíòàðèé', 'Îñòàâëåíî % êîììåíò.' );?></h4>

    <div class="commentlist alert alert-success">
		<?php wp_list_comments(avatar_size=64); ?>
	</div>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
   <p>Комментарии к этой записи закрыты</p>
	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
<br />
<div id="respond">
<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>Ïîæàëóéñòà,  <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">çàðåãèñòðèðóéòåñü </a> äëÿ êîììåíòèðîâàíèÿ.</p>
<?php else : ?>

<!--òóò ôîðìà-->
<h4>Оставить комментарий</h4>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form">

	<?php if ( $user_ID ) : ?>
	
	<p>Çäðàâñòâóéòå, <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Âûéòè">Âûõîä &raquo;</a></p>
	
	<?php else : ?>
	
	<label>Âàøå èìÿ*</label>
	<div class="input-prepend">
		<span class="add-on"><i class="icon-user"></i></span><input type="text" name="author" placeholder="Âàñÿ">
	</div>
				        
	<label>Âàø e-mail*</label>
	<div class="input-prepend">
		<span class="add-on"><i class="icon-envelope"></i></span><input type="text" name="email" placeholder="vasya@mail.ru">
	</div>
				        
	<label>Âàø ñàéò</label>
	<div class="input-prepend">
		<span class="add-on"><i class="icon-home"></i></span><input type="text" name="url" placeholder="http://vasya.ru">
	</div>
	
	<?php endif; ?>
	
	<textarea id="comment" style="display: none;" name="comment"></textarea>
	
	<label>Òåêñò ñîîáùåíèÿ</label>
	<textarea id="real-comment" name="real-comment"></textarea>
	
	<?php if( function_exists(checkbot_show) ) { checkbot_show(); } ?>
	<p><input name="submit" type="submit" id="submit" tabindex="5" value="Îòïðàâèòü" class="btn btn-success" />
	<?php comment_id_fields(); ?>
	</p>
	<?php do_action('comment_form', $post->ID); ?>

</form>
<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>