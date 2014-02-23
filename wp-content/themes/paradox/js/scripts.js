// DOM Ready
	
$(function() {
	// SVG fallback
	// toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script#update
	if (!Modernizr.svg) {
		var imgs = document.getElementsByTagName('img');
		var dotSVG = /.*\.svg$/;
		for (var i = 0; i != imgs.length; ++i) {
			if(imgs[i].src.match(dotSVG)) {
				imgs[i].src = imgs[i].src.slice(0, -3) + "png";
			}
		}
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Header
	/*-----------------------------------------------------------------------------------*/
	
	/* Starting Animation on Load */

	jQuery('#logo').fadeIn(600, function() {
		jQuery('#caption').animate({opacity: '1', 'padding-top': '0'}, 500,function() {
			jQuery('#sub-caption').animate({opacity: '1', 'padding-top': '0'}, 500,function() {
				if(jQuery(window).width()<767){	
					jQuery('#explore').animate({opacity: '1', 'margin-top': '2em'}, 1000);
				} else {
					jQuery('#explore').animate({opacity: '1', 'margin-top': '4em'}, 1000);
				}
			});
		});
	});
	
	/*-----------------------------------------------------------------------------------*/
	/*	Navigation
	/*-----------------------------------------------------------------------------------*/
	
	if (jQuery('body').hasClass('home')) {
		
		var animate='down';		

		jQuery(window).bind('scroll', function () {
		
			/* Animation for Top Navigation */
			var scrollTop = jQuery(window).scrollTop();
			
				if (scrollTop > jQuery('#header').height()-53 && animate == 'down') {
					animate='up';
					jQuery('#top-bar').stop().animate({top:'0'}, 300);
				} else if(scrollTop < jQuery('#header').height()-53 && animate == 'up'){
					animate='down';
					jQuery('#top-bar').stop().animate({top:'-75px'}, 300);
				}
			
			/* Update Section on Top-Bar */
			jQuery('section').each(function(){
				if (scrollTop > jQuery(this).offset().top-53){
					var section = jQuery(this).attr('id');
					$("#top-navigation ul li").each(function(){
						if(section == jQuery(this).find('a').attr('href').replace("#","") && jQuery(this).not('.active')){
							$("#top-navigation ul li").removeClass('active');
							jQuery(this).addClass('active');
						}
					});
				}
			});
		});
	
		/* Responsive Menu Click */
		jQuery('#menu-mobile').click(function(){
			if ( jQuery("#top-navigation ul").is(":visible") ) {
			    jQuery("#top-navigation ul").slideUp(500);
			   	jQuery('#menu-mobile').removeClass('active');
			} else { 
			   	jQuery("#top-navigation ul").slideDown(500);
			   	jQuery('#menu-mobile').addClass('active');
			}
		});
		
		/* On Resize show menu on desktop if hidden */
		jQuery(window).resize(function() {
			jQuery("#top-bar").css('width', $(window).width());
			jQuery("#top-bar > .container").css('margin', '0 auto');

		    if(jQuery(window).width()>992){	
				if (jQuery("#top-navigation ul").is(":hidden") ) {
				    jQuery("#top-navigation ul").show();
				   	jQuery('#menu-mobile').removeClass('active');		
				}
		    } else {
		    	if (jQuery("#top-navigation ul").is(":visible") ) {
				    jQuery("#top-navigation ul").hide();
				   	jQuery('#menu-mobile').removeClass('active');		
				}
		    }
		});
	
		/*-----------------------------------------------------------------------------------*/
		/*	Smooth Scroll - Navigation + .scroll items
		/*-----------------------------------------------------------------------------------*/
		
		jQuery('#top-navigation li').bind('click',function(event){
		    var anchor = jQuery(this).find('a');
		    
		    jQuery('#top-navigation li').removeClass('active');
		    jQuery(this).addClass('active');
		    
		    if(jQuery(window).width()<=767){
			    jQuery('html, body').stop().animate({
			        scrollTop: jQuery(anchor.attr('href')).offset().top-43
			    }, 1500,'easeInOutExpo');	
			    jQuery("#top-navigation ul").slideUp(500);
				jQuery('#menu-mobile').removeClass('active');
		    } else {
			    jQuery('html, body').stop().animate({
			        scrollTop: jQuery(anchor.attr('href')).offset().top-52
			    }, 1500,'easeInOutExpo');			    
		    }
		    
		    event.preventDefault();
		});
		
		jQuery('.scroll').bind('click',function(event){
		    
		    if (jQuery(this).hasClass('header')){
		    	console.log('cenas');
			    jQuery('html, body').stop().animate({
			        scrollTop: 0
			    }, 1500,'easeInOutExpo');
		    } else {
				if(jQuery(window).width()<=767){	
				    jQuery('html, body').stop().animate({
				        scrollTop: jQuery('#header').height()-43
				    }, 1500,'easeInOutExpo');
				    jQuery("#top-navigation ul").slideUp(500);
					jQuery('#menu-mobile').removeClass('active');
			    } else {
				    jQuery('html, body').stop().animate({
				        scrollTop: jQuery('#header').height()-52
				    }, 1500,'easeInOutExpo');			    
			    }
		    }
		    		    
		    event.preventDefault();
		});
		
		if(window.location.hash) {
		    jQuery('html, body').stop().animate({
		        scrollTop: jQuery(location.hash).offset().top-43
		    }, 1500,'easeInOutExpo');
		}
	
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Studio
	/*-----------------------------------------------------------------------------------*/
	
	if($(".swiper-container").length != 0) {	
		/* On Load swiper height should adjust to img size */
		jQuery('.swiper-slide img').load(function() {
			jQuery('.swiper-container').height(jQuery('.swiper-slide img').height());
			jQuery('.featured-post-gallery .swiper-container').height(jQuery(' .featured-post-gallery .swiper-slide img').height());
			jQuery('.swiper-wrapper').height(jQuery('.swiper-slide img').height());
		});
		
		/* On Resize swiper height should adjust to img size */
		jQuery(window).resize(function() {
			jQuery('.swiper-container').height(jQuery('.swiper-slide img').height());
			jQuery('.featured-post-gallery .swiper-container').height(jQuery(' .featured-post-gallery .swiper-slide img').height());
			jQuery('.swiper-wrapper').height(jQuery('.swiper-slide img').height());
		});
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Services
	/*-----------------------------------------------------------------------------------*/
	
	var curSkills = "";
	
	/* Services Animations */
	jQuery('.service').click(function(){
		if (jQuery(this).hasClass('active')){
			jQuery('.service').removeClass('active');
			jQuery("#"+curSkills+"-skills").slideUp(750, 'easeInOutExpo');
		} else {
			jQuery('.service').removeClass('active');
			jQuery(this).addClass('active');
			var target = jQuery(this).attr('id');
			if (curSkills == ""){
				jQuery("#"+target+"-skills").slideDown(750, 'easeInOutExpo');
			} else {
				jQuery("#"+curSkills+"-skills").slideUp(750, 'easeInOutExpo',function(){jQuery("#"+target+"-skills").slideDown(750, 'easeInOutExpo')});
			}
			curSkills =jQuery(this).attr('id');
			jQuery('html, body').stop().animate({
			    scrollTop: jQuery('#services-list').offset().top-100
			}, 1000,'easeInOutExpo');
			
			jQuery("#"+target+"-skills .expand").each(function() {
				jQuery(this).css({width:0}).animate({width:jQuery(this).attr('data-width')}, 2000);
			});
		}
	});
	
	/*-----------------------------------------------------------------------------------*/
	/*	Works
	/*-----------------------------------------------------------------------------------*/
	
	/* Works Top Bar */
	jQuery(window).bind('scroll', function () {
		var scrollTop = jQuery(window).scrollTop();
		
		if($('#project-details').length != 0) {
			if (scrollTop > jQuery('#project-details').offset().top-125) {
				jQuery('#project-top-bar').addClass('fixed').stop().animate({top:0},500);
			} else if(scrollTop < jQuery('#project-details').offset().top-125){
				jQuery('#project-top-bar').stop().animate({top:'-60px'},500,function(){
					jQuery('#project-top-bar').removeClass('fixed');
				});
			}
		}
	});

	/* If we're on medium or large device animate next and previous project name while hovering arrow's */
	if(jQuery(window).width()>767){	
		jQuery('#next-project').mouseenter(function() {
			jQuery("#next-project-name").stop().animate({"right":"80px","opacity":"1"}, 500);
		}).mouseleave(function() {
			jQuery("#next-project-name").animate({"right":"110px","opacity":"0"}, 500);
		});
		jQuery('#previous-project').mouseenter(function() {
			jQuery("#previous-project-name").stop().animate({"left":"80px","opacity":"1"}, 500);
		}).mouseleave(function() {
			jQuery("#previous-project-name").animate({"left":"110px","opacity":"0"}, 500);
		});
	}
	
	/* Creates the filter menu for mobile version */
	$('.work-filter ul').each(function(){
		var select=$(document.createElement('select')).insertBefore($(this).parent()).addClass('visible-xs');;
		$('>li', this).each(function(){
			option=$(document.createElement('option')).appendTo(select).val(this.href).html($(this).html()).addClass($(this).attr('data-filter'));
		});
	});
	
	/* Filtering for Select */
	$('select').on('change',function(){
		jQuery('.work-container').mixitup('filter',jQuery(this).find('option:selected').attr('class'));
	}); 
	
	/*-----------------------------------------------------------------------------------*/
	/*	Social
	/*-----------------------------------------------------------------------------------*/
	
	if($(".social-feed").length != 0) {
	
		/* Initalize Flickr Feed */
		if (flickrID != ''){
			jQuery('#flickr').jflickrfeed({
				limit: 12,
				qstrings: {
					id: flickrID
				},
				itemTemplate: '<div class="col-xs-3 col-sm-2 flickr-photo"><a href="{{image_b}}"target="_blank"> <img src="{{image_m}}" alt="{{title}}" /> </a></div>'
			});
		}
		
		/* Initalize Instagram Feed */
		if (instagramUser != ''){
			jQuery.fn.spectragram.accessData={accessToken:'2136707.12e2743.9576ae17af4e4ad4aebf6b72433c01fd',clientID:'12e27430fe054c72839c5f16f86177e1'};
			
			jQuery('#instagram').spectragram('getUserFeed',{
			    query: instagramUser,
			    max: 12
			});
		}
	
		/* Initalize Twitter Feed */
		if (twitterUser != ''){
			jQuery('#twitter').tweetable({
				username: twitterUser, 
				time: true,
				limit: 5,
				replies: false,
				loading: 'Patience is an art...' ,
				position: 'append',
				failed: "Sorry, twitter is currently unavailable for this user.",
				html5: true,
				onComplete:function($ul){
					$('time').timeago();
					var ul = $("#twitter").find(".tweetList");
					var ticker = function() {
					setTimeout(function() {
						var top = ul.position().top;
						var h = ul.height();
						var incr = (h / ul.children().length);
						var newTop = top - incr;
						if (h + newTop <= 0) newTop = 0;
						ul.animate( {top: newTop}, 500 );
						ticker();
					}, 7500);
					};
					ticker();
				}
			});	
		}
	
	
		jQuery('.button-feed').first().addClass('active');
		
		var target = jQuery('.button-feed').first().attr('id');
		target = target.replace("-feed","");
		jQuery("#"+target).addClass('active');
	
		/* Click's on Social Feed Icon */	
		jQuery('.social-feed li').click(function(){
			jQuery('.social-feed li').removeClass('active');
			jQuery(this).addClass('active');
			$("#twitter").find(".tweetList").css('top', '0');
			if(jQuery(this).attr('id') == 'instagram-feed'){
				jQuery('.feed').hide();
				jQuery('#instagram').fadeIn(1000);
			} else if ($(this).attr('id') == 'twitter-feed') {
				$('.feed').hide();
				$('#twitter').fadeIn();
			} else if (jQuery(this).attr('id') == 'flickr-feed') {
				jQuery('.feed').hide();
				jQuery('#flickr').fadeIn(1000);
			}
		});	
	
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Blog
	/*-----------------------------------------------------------------------------------*/

	if($('#featured-posts-container').length != 0) {
		var container = document.querySelector('#featured-posts-container');
		var mansonry;

		imagesLoaded( container, function() {
			mansonry = new Masonry( container, {
				itemSelector: '.featured-post'
			});
		});
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Animations
	/*-----------------------------------------------------------------------------------*/	
	
	if (jQuery('body').hasClass('single-portfolio')) {
		jQuery("#page").fadeIn(750);
	}
	
	if (jQuery('body').hasClass('single-post')) {
		jQuery("#page").fadeIn(500);
		
		if(window.location.href.indexOf("#respond") > -1) {
		   jQuery('#comment').show();
		}
		
		jQuery('#show-comments').click(function(){
			if( $('#make-comment').is(':visible') ) {
			    jQuery('#make-comment').hide();
			    jQuery(this).removeClass('active');
			}
			else {
				jQuery('#make-comment').show();
				jQuery(this).addClass('active');
			}
		});
		
		if(window.location.hash) {
		    if (location.hash == '#respond'){
		    	jQuery('#show-comments').click();
		    }
		}
	}
	 
	/*-----------------------------------------------------------------------------------*/
	/*	Loading of pages
	/*-----------------------------------------------------------------------------------*/	

	jQuery('.load').click(function(){
		event.preventDefault();
		href = jQuery(this).attr("href");
    	jQuery("#page").fadeOut(150, function(){
			window.location.href = href;
		});
	});
	
	/*-----------------------------------------------------------------------------------*/
	/*	Offcanvas Navigation
	/*-----------------------------------------------------------------------------------*/	
		
	if (jQuery('.show-offcanvas').is(':visible')) {
	
		/* Off-canvas Menu Click */
		jQuery('.show-offcanvas').click(function(){
			if ( jQuery("#offcanvas-navigation").hasClass('active') ) {
				if (jQuery('body').hasClass('single-portfolio')) {
					jQuery("#offcanvas .show-offcanvas").hide();
					jQuery("#project-top-bar .show-offcanvas").show();
				}
			    jQuery("#page").removeClass('move');
			    jQuery("#offcanvas-navigation, .show-offcanvas").removeClass('active');
			    jQuery("body").css("overflow-y", "auto");
			} else { 
				if (jQuery('body').hasClass('single-portfolio')) {
					jQuery("#offcanvas .show-offcanvas").show();
					jQuery("#project-top-bar .show-offcanvas").hide();
				}
			   	jQuery("#page").addClass('move');
			   	jQuery("#offcanvas-navigation, .show-offcanvas").addClass('active');
			   	jQuery("body").css("overflow-y", "hidden");
			}
		});	
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Widgets Titles Click
	/*-----------------------------------------------------------------------------------*/	

	jQuery('.sidebar-widget h3').click(function(){

		if (jQuery(this).parent().find('div.collapse').is(':visible')) {
			$(this).removeClass('active');
			jQuery(this).parent().find('div.collapse').css('display','none');
		} else {
			$(this).addClass('active');
			jQuery(this).parent().find('div.collapse').css('display','block');
		}
	});

});
