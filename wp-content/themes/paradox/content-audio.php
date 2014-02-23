<?php 
/**
 * The template for displaying audio post format
 */ 
 ?>
 
<?php if(get_field('file_source',$post->ID) == 'Upload'): ?>
	
	<?php $link = get_field('upload_audio_file', get_the_ID()); ?>

<?php elseif(get_field('file_source',$post->ID) == 'Link'): ?>

	<?php $link = get_field('audio_file_link', get_the_ID()); ?>

<?php endif; ?>


<script type="text/javascript">

    jQuery(document).ready(function($){

        if( $().jPlayer ) {
            $("#jquery-jplayer-audio-<?php echo get_the_ID();?>").jPlayer({
                ready: function () {
                    $(this).jPlayer("setMedia", {
                    	poster: "<?php echo get_field('image_audio', get_the_ID()); ?>",
                    	mp3: "<?php echo $link; ?>",
                    	end: ""
                    });
                },
                size: {
                    width: "100%",
                    height: "auto"
                },
                preload: 'auto',
                swfPath: "<?php echo get_template_directory_uri() . '/js'; ?>",
                cssSelectorAncestor: "#jp-audio-interface-<?php echo get_the_ID();?>",
                supplied: "mp3"
            });
        
        }
        
    });
    
</script>

<div id="jquery-jplayer-audio-<?php echo get_the_ID();?>" class="jp-jplayer"></div>

<div id="jp-container-<?php echo get_the_ID();?>" class="jp-audio">
    <div class="jp-type-single">
        <div id="jp-audio-interface-<?php echo get_the_ID();?>" class="jp-interface">
            <ul class="jp-controls">
                <li><a href="#" class="jp-play" tabindex="1" title="play" style="display: block;">play</a></li>
                <li><a href="#" class="jp-pause" tabindex="1" title="pause" style="display: none;">pause</a></li>
                <li><a href="#" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                <li><a href="#" class="jp-unmute" tabindex="1" title="unmute" style="display: none;">unmute</a></li>
            </ul>
            <div class="jp-progress">
                <div class="jp-seek-bar">
                    <div class="jp-play-bar"></div>
                </div>
            </div>
            <div class="jp-volume-bar">
                <div class="jp-volume-bar-value"></div>
            </div>
        </div>
    </div>
</div>