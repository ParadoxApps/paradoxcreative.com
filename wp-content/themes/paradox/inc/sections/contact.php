<?php if(get_row_layout() == "contact"): ?>

<div class="container">

	<div class="row">
		<div class="col-xs-12 col-sm-<?php echo get_sub_field('small_medium_large_device_columns', get_the_ID());?> col-sm-offset-<?php echo (12 - get_sub_field('small_medium_large_device_columns', get_the_ID()))/2;?>">
			<form id="contact-form" action="/" method="post">
				<div class="row">	
					<div class="col-xs-12 formContainer">
						<input type="text" name="name" id="name" value="" class="requiredField" placeholder="Name">
					</div>
					<div class="col-xs-12 formContainer">
						<input type="text" name="email" id="email" value="" class="requiredField email" placeholder="Email">
					</div>
					<div class="col-xs-12 formContainer">
						<textarea name="message" id="message" rows="20" cols="30" class="requiredField" placeholder="Briefing"></textarea>
					</div>
					<div class="col-xs-12 formContainer">
						<input type="hidden" name="submitted" id="submitted" class="button" value="SEND"><button id="submit" class="btn btn-lg" type="submit">Send</button>
					</div>
					<div class="col-xs-12 formContainer">
						<p id="error" data-alert="" class="alert"><?php echo get_sub_field('error_message', get_the_ID()) ?></p>
						<p id="thanks" data-alert="" class="alert alert-success"><?php echo get_sub_field('success_message', get_the_ID()) ?></p>
						<p id="timedout" data-alert="" class="alert">The connection to the server timed out.</p>
						<p id="state" data-alert="" class="alert"></p>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<?php $aux = 0;
	
	if(get_sub_field('email', get_the_ID())):
		$aux++;
	endif;
	if(get_sub_field('location', get_the_ID())):
		$aux++;
	endif;
	if(get_sub_field('phone', get_the_ID())):
		$aux++;
	endif;
	
	?>

	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
			<div class="contact-info">
				<div class="row">
					<?php if(get_sub_field('email', get_the_ID())):?>
						<div class="col-sm-<?php echo 12 / $aux; ?> contact">
							<div class="icon">
								<a><i class="icon-envelope icon-3x"></i></a>	
							</div>
							<p><?php echo get_sub_field('email', get_the_ID());?></p>
						</div>
					<?php endif; ?>
					<?php if(get_sub_field('location', get_the_ID())):?>
						<div class="col-sm-<?php echo 12 / $aux; ?> contact">
							<div class="icon">
								<a href="<?php echo get_sub_field('location_link', get_the_ID());?>" target="_blank"><i class="icon-map-marker icon-3x"></i></a>	
							</div>
							<p><?php echo get_sub_field('location', get_the_ID());?></p>
						</div>
					<?php endif; ?>
					<?php if(get_sub_field('phone', get_the_ID())):?>
						<div class="col-sm-<?php echo 12 / $aux; ?> contact">
							<div class="icon">
								<a><i class="icon-phone icon-3x"></i></a>	
							</div>
							<p><?php echo get_sub_field('phone', get_the_ID());?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

</div>
			
	<script>

		/*-----------------------------------------------------------------------------------*/
		/*	Contacts
		/*-----------------------------------------------------------------------------------*/	
			
		/* Validation Form with AJAX while typing for inputs */
		jQuery('input').bind('input propertychange', function() {
			jQuery(this).parent().find('.error').remove();
			jQuery(this).parent().find('.valid').remove();
		    if( jQuery(this).attr('id') == 'email' ){
				var checkEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (jQuery(this).val() == "" || jQuery(this).val() == " ") {
					jQuery(this).after("<span class='error'><i class='icon-remove icon-2x'></i></span>");
					jQuery(this).parent().find('.error').fadeIn('slow');
				} else if (!checkEmail.test(jQuery(this).val())) { 
					jQuery(this).after("<span class='error'><i class='icon-remove icon-2x'></i></span>");
					jQuery(this).parent().find('.error').fadeIn('slow');
				} else {
					jQuery(this).after("<span class='valid'><i class='icon-ok icon-2x'></i></span>");
					jQuery(this).parent().find('.valid').fadeIn('slow');	
				}    
		    } else {
				if(jQuery(this).val() == "" || jQuery(this).val() == " "){
					jQuery(this).after("<span class='error'><i class='icon-remove icon-2x'></i></span>");
					jQuery(this).parent().find('.error').fadeIn('slow');			   
				} else {
					jQuery(this).after("<span class='valid'><i class='icon-ok icon-2x'></i></span>");
					jQuery(this).parent().find('.valid').fadeIn('slow');	
				}
		    }
		});
		
		/* Validation Form with AJAX while typing for textarea */
		jQuery('textarea').bind('input propertychange', function() {
			jQuery(this).parent().find('.error').remove();
			jQuery(this).parent().find('.valid').remove();	
			if(jQuery(this).val() == "" || jQuery(this).val() == " "){
				jQuery(this).after("<span class='error'><i class='icon-remove icon-2x'></i></span>");
				jQuery(this).parent().find('.error').fadeIn('slow');			   
			} else {
				jQuery(this).after("<span class='valid'><i class='icon-ok icon-2x'></i></span>");
				jQuery(this).parent().find('.valid').fadeIn('slow');	
			}
		});	
		
		
		/* Validation Form with AJAX on Submit */
		jQuery('#submit').click(function(){
			jQuery('span.error').fadeOut('slow');
			jQuery('span.valid').fadeOut('slow');
			jQuery('#thanks').hide();
			jQuery('#error').hide();
			jQuery('#timedout').hide();
			jQuery('#state').hide();
			
			var error = false;
			
			var name = jQuery('#name').val(); 
			if(name == "" || name == " ") {
				jQuery('#name').after("<span class='error'><i class='icon-remove icon-2x'></i></span>");
				jQuery('#name').parent().find('.error').fadeIn('slow');
				error = true; 
			} else {
				jQuery('#name').after("<span class='valid'><i class='icon-ok icon-2x'></i></span>");
				jQuery('#name').parent().find('.valid').fadeIn('slow');			
			}
			
			var checkEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
			var email = jQuery('#email').val();
			if (email == "" || email == " ") {
				jQuery('#email').after("<span class='error'><i class='icon-remove icon-2x'></i></span>");
				jQuery('#email').parent().find('.error').fadeIn('slow');
				error = true;
			} else if (!checkEmail.test(email)) { 
				jQuery('#email').after("<span class='error'><i class='icon-remove icon-2x'></i></span>");
				jQuery('#email').parent().find('.error').fadeIn('slow');
				error = true;
			} else {
				jQuery('#email').after("<span class='valid'><i class='icon-ok icon-2x'></i></span>");
				jQuery('#email').parent().find('.valid').fadeIn('slow');			
			}
			
			var message = jQuery('#message').val(); 
			if(message == "" || message == " ") {
				jQuery('#message').after("<span class='error'><i class='icon-remove icon-2x'></i></span>");
				jQuery('#message').parent().find('.error').fadeIn('slow');
				error = true; 
			} else {
				jQuery('#message').after("<span class='valid'><i class='icon-ok icon-2x'></i></span>");
				jQuery('#message').parent().find('.valid').fadeIn('slow');			
			}
			
			if(error == true) {
				jQuery('#error').fadeIn('slow');
				setTimeout(function() {
				    jQuery('#error').fadeOut('slow');
				}, 3000);
				return false;
			}
			
			var data_string = jQuery('#contact-form').serialize();
			
			jQuery.ajax({
				type: "POST",
				url: templateUrl+"/inc/sendMail.php",
				data: {name:name,email:email,message:message,emailTo:'<?= get_sub_field("email", get_the_ID()) ?>'}, 
				timeout: 6000,
				error: function(request,error) {
					if (error == "timeout") {
						jQuery('#timedout').fadeIn('slow');
						setTimeout(function() {
						    jQuery('#timedout').fadeOut('slow');
						}, 3000);
					}
					else {
						jQuery('#state').fadeIn('slow');
						jQuery("#state").html('The following error occured: ' + error + '');
						setTimeout(function() {
						    jQuery('#state').fadeOut('slow');
						}, 3000);
					}
				},
				success: function() {
					jQuery('span.valid').remove();
					jQuery('#thanks').fadeIn('slow');
					jQuery('input').val('');
					jQuery('textarea').val('');
					setTimeout(function() {
					    jQuery('#thanks').fadeOut('slow');
					}, 3000);
				}
			});
			
			return false;
		});
	</script>

<?php else: ?>

	<!-- warning -->
	<div>
		<h2><?php _e( 'You have selected Contact Options so please make sure you change all the required fields!<br>Edit this to be sure.', 'cotton' ); ?></h2>
	</div>
	<!-- /warning -->

<?php endif; ?>