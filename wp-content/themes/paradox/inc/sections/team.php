<div class="container">
	
	<div class="row">

		<?php if(get_sub_field('members', get_the_ID())): ?>
		
			<?php
			$xsmall = get_sub_field('xsmall_device_columns', get_the_ID());
			$small = get_sub_field('small_device_columns', get_the_ID());
			$medium_large = get_sub_field('medium_device_columns', get_the_ID());
			?>
			
			<?php while(has_sub_field('members', get_the_ID())): ?>
			
				<div class="col-xs-<?php echo $xsmall ?> col-sm-<?php echo $small ?> col-md-<?php echo $medium_large ?> member">
					<div class="member-photo">
						<div class="image">
							<img src="<?php the_sub_field('photo', get_the_ID()); ?>" alt="<?php the_sub_field('name', get_the_ID()); ?>">
						</div>
						<div class="image-hover">
							<?php if (get_sub_field('photo_hover', get_the_ID()) != '') { ?>
								<img src="<?php the_sub_field('photo_hover', get_the_ID()); ?>" alt="<?php the_sub_field('name', get_the_ID()); ?>">
							<?php } else {?>
								<img src="<?php the_sub_field('photo', get_the_ID()); ?>" alt="<?php the_sub_field('name', get_the_ID()); ?>">
							<?php } ?>
						</div>
						<div class="member-hover hidden-xs hidden-sm">
							<div class="list-container">
								<ul class="list-inline social">
									<?php if(get_sub_field('social', get_the_ID())): ?>
										<?php while(has_sub_field('social', get_the_ID())): ?>
											<li><a href="<?php the_sub_field('link', get_the_ID()); ?>" target="_blank"><i class="icon-<?php echo strtolower(get_sub_field('media', get_the_ID()));?> icon-3x"></i></a></li>
										<?php endwhile; ?>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
					<h5><?php the_sub_field('name', get_the_ID()); ?></h5>
					<p><?php the_sub_field('role', get_the_ID()); ?></p>
					<div class="list-container visible-xs visible-sm">
						<ul class="list-inline">
							<?php if(get_sub_field('social', get_the_ID())): ?>
								<?php while(has_sub_field('social', get_the_ID())): ?>
									<li><a href="<?php the_sub_field('link', get_the_ID()); ?>" target="_blank"><i class="icon-<?php echo strtolower(get_sub_field('media', get_the_ID()));?> icon-2x"></i></a></li>
								<?php endwhile; ?>
							<?php endif; ?>
						</ul>
					</div>				
				</div>
				
			<?php endwhile; ?>
		
		<?php else: ?>
		
			<!-- warning -->
			<div>
				<h2><?php _e( 'You have selected Team Options but your team has no members yet!<br>Edit this and add some members to your team.', 'cotton' ); ?></h2>
			</div>
			<!-- /warning -->
		
		<?php endif; ?>
	</div>

</div>