<?php
$error = __('You need a minimum of one slide', 'wolf');
?>
<script type="text/javascript">
jQuery(function($) {

	$("#wolf-popup").on('click', '#add-slide', function() {
 		if($('.box').length>1){
 			$('.box:last-child').clone().appendTo('#newfields');
 			
 		}else{
 			$('.box').clone().appendTo('#newfields');
 		}
 		$('.box:last-child').find('.slide-cite').val('');
 		return false;
 	});

 	$("#wolf-popup").on('click', '.close', function(){
 		box = $(this).parent('div');
  		if($('.box').length>1){
  			box.remove();
  		}else{
  			alert('<?php echo $error; ?>');
  		}
 		return false;
 	});

	$('#wolf-insert').click(function() {    
		
		var height = jQuery('#slide-height').val();
		
		//alert(nb);

		var output ='';
		output = '[wolf_testimonials_start]';

		jQuery('.box').each(function(){	
			cite = jQuery(this).find('.slide-cite').val();
			content = jQuery(this).find('.slide').val();
			output += '[wolf_testimonial_slide cite="' +cite;
			output += '"]';
			output +=   content;
			output += '[/wolf_testimonial_slide]';
		 });
		//endforeach
		output += '[wolf_testimonials_end]';

			
		if(window.tinyMCE){
			
			window.parent.send_to_editor(output);
			//window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, output);
			tb_remove();
			return false;
		}
	});
});
</script>
<div id="wolf-popup-head"><strong><?php _e('Insert testimonials', 'wolf'); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">
				
			<div class="box">
							
				<fieldset class="wolf-section-field">
					<label><?php _e('Slide content', 'wolf'); ?></label>
					<textarea name="slide-content" class="slide" id="slide0" cols="30" rows="10"></textarea>
				</fieldset>
				<fieldset class="wolf-section-field">
					<label><?php _e('Quote signature', 'wolf'); ?></label>
					<input type="text" name="slide-cite" class="slide-cite" value="" id="slide-cite0">
				</fieldset>
				<a href="#" class="close"><?php _e('Remove', 'wolf'); ?></a>	
				<hr>					
			</div>
			<div id="newfields"></div>
			
			
			<p>
				<a href="#" id="add-slide" class="add"><?php _e('Add another slide', 'wolf'); ?></a>
			</p>

			<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e('Insert testimonials', 'wolf'); ?>"></p>
		</form>
</div>