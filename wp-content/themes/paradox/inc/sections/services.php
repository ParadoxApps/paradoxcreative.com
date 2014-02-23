<?php if(get_sub_field('what_you_do', get_the_ID())): ?>

	<?php
		$xsmall = get_sub_field('xsmall_device_columns', get_the_ID());
		$small = get_sub_field('small_device_columns', get_the_ID());
		$medium_large = get_sub_field('medium_device_columns', get_the_ID());
	?>

	<div class="container">
	
		<div class="row">
		
			<div id="services-list">
			
			<?php while(has_sub_field('what_you_do', get_the_ID())): ?>
				<div class="col-xs-<?php echo $xsmall; ?> col-sm-<?php echo $small; ?> col-md-<?php echo $medium_large; ?>">
					<div id="<?php echo str_replace(' ', '-', strtolower(get_sub_field('name', get_the_ID())));?>" class="service smooth">
						<?php if (get_sub_field('image', get_the_ID())): ?>
							<img  src="<?php echo the_sub_field('image', get_the_ID());?>" alt="<?php echo the_sub_field('name', get_the_ID());?>">	
						<?php endif; ?>
						<h5 class="hidden-xs"><?php echo the_sub_field('name', get_the_ID());?></h5>
						<p class="hidden-xs"><?php echo the_sub_field('description', get_the_ID());?></p>
					</div>
				</div>
			<?php endwhile; ?>
			
			</div>
		</div>
		<div class="row">
		
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php while(has_sub_field('what_you_do', get_the_ID())): ?>			
				    <ul id="<?php echo str_replace(' ', '-',strtolower(get_sub_field('name', get_the_ID())));?>-skills" class="skills-bar">
						<?php if(get_sub_field('skills', get_the_ID())): ?>						 
							<?php while(has_sub_field('skills', get_the_ID())): ?>
								<li><span class="expand" data-width="<?php echo the_sub_field('percentage', get_the_ID());?>%"></span><em><?php echo the_sub_field('name', get_the_ID());?></em></li>
							<?php endwhile; ?>
						<?php endif; ?>
				    </ul>
				<?php endwhile; ?>	
			</div>
		</div>
	</div>
								         
<?php else: ?>

	<!-- warning -->
	<div>
		<h2><?php _e( 'You have selected Services Section but you added no services!<br>Edit this and add your services.', 'cotton' ); ?></h2>
	</div>
	<!-- /warning -->

<?php endif; ?>