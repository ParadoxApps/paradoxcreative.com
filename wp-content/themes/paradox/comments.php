<div id="comments" class="comments">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<?php if (post_password_required()) : ?>
				<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'cotton' ); ?></p>
			</div>
			
				<?php return; endif; ?>
			
			<?php if (have_comments()) : ?>
			
<!-- 				<h2><?php comments_number(); ?></h2> -->
			
				<ul class="comments-list">
					<?php wp_list_comments('type=comment&callback=cottoncomments'); // Custom callback in functions.php ?>
				</ul>
			
			<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
				
				<p><?php _e( 'Comments are closed here.', 'cotton' ); ?></p>
				
			<?php endif; ?>
			
			</div>
		</div>
	</div>
</div>