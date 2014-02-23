<?php 
/**
 * The template for displaying video post format
 */ 
 ?>
 
<?php if (get_field('video_source',$post->ID) == 'Youtube/Vimeo'): ?>

    <?php echo $GLOBALS['wp_embed']->autoembed( get_field('youtube_vimeo_url',$post->ID) );?>

<?php else:?>

    <?php if(get_field('video_source',$post->ID) == 'Upload'): ?>
    
        <?php $link = get_field('upload_video_file',$post->ID); ?>

    <?php elseif(get_field('video_source',$post->ID) == 'Link'): ?>

        <?php $link = get_field('video_file_link',$post->ID); ?>

    <?php endif; ?>

    <script type="text/javascript">

        jQuery(document).ready(function($){
        
            if( $().jPlayer ) {
                $("#jquery-jplayer-video-<?php echo get_the_ID();?>").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {
                        	poster: "<?php echo get_field('image_video', get_the_ID()); ?>",
                            m4v: "<?php echo $link; ?>"
    					});
                    },
                    size: {
                        width: "100%",
                        height: "auto"
                    },
                    preload: 'auto',
                    swfPath: "<?php echo get_template_directory_uri() . '/js'; ?>",
                    cssSelectorAncestor: "#jp-video-container-<?php echo get_the_ID();?>",
                    supplied: "m4v"
                });

                $('#jquery-jplayer-video-<?php echo get_the_ID();?>').bind($.jPlayer.event.playing, function(event) {
                    $(this).add('#jp-video-interface-<?php echo get_the_ID();?>').hover( function() {
                        $('#jp-video-interface-<?php echo get_the_ID();?>').stop().animate({ opacity: 1 }, 400);
                    }, function() {
                        $('#jp-video-interface-<?php echo get_the_ID();?>').stop().animate({ opacity: 0 }, 400);
                    });
                });
                
                $('#jquery-jplayer-video-<?php echo get_the_ID();?>').bind($.jPlayer.event.pause, function(event) {
                    $('#jquery-jplayer-video-<?php echo get_the_ID();?>').add('#jp-video-interface-<?php echo get_the_ID();?>').unbind('hover');
                    $('#jp-video-interface-<?php echo get_the_ID();?>').stop().animate({ opacity: 1 }, 400);
                });
            }
        });
        
    </script>

    <div id="jp-video-container-<?php echo get_the_ID();?>" class="jp-video">
        <div class="jp-type-single">
        <div id="jquery-jplayer-video-<?php echo get_the_ID();?>" class="jp-jplayer"></div>
    		<div class="jp-gui">
    	        <div id="jp-video-interface-<?php echo get_the_ID();?>" class="jp-interface">
    	            <ul class="jp-controls">
    	                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
    	                <li><a href="#" class="jp-pause" tabindex="1" style="display: none;">pause</a></li>
    	                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
    	                <li><a href="#" class="jp-unmute" tabindex="1" style="display: none;">unmute</a></li>
    	            </ul>
    	            <div class="jp-progress">
    	                <div class="jp-seek-bar" style="width: 100%;">
    	                    <div class="jp-play-bar" style="width: 0%;"></div>
    	                </div>
    	            </div>
    	            <div class="jp-volume-bar">
    	                <div class="jp-volume-bar-value" style="width: 80%;"></div>
    	            </div>
    	        </div>
    	    </div>
        </div>
    </div>

<?php endif; ?>