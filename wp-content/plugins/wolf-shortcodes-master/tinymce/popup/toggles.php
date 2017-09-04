<?php
$error = __('You need a minimum of one toggle', 'wolf');
?>
<script type="text/javascript">
jQuery(function($) {

	$("#wolf-popup").on('click', '#add-panel', function() {
 		if($('.box').length>1){
 			$('.box:last-child').clone().appendTo('#newfields');
 			
 		}else{
 			$('.box').clone().appendTo('#newfields');
 		}
 		$('.box:last-child').find('.panel-title').val('');
 		$('.box:last-child').find('.panel-open').prop('checked', false);
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
		
		var height = jQuery('#panel-height').val();
		var output ='';
		
		jQuery('.box').each(function(){	
			output += '[wolf_toggle';
			title = jQuery(this).find('.panel-title').val();
			content = jQuery(this).find('.panel').val();

			if( jQuery(this).find('.panel-open').is(":checked") ){
				output += ' open="true"';
			}else{
				output += ' open="false"';
			}

			output += ' title="' +title;
			output += '"]';
			output +=   content;
			output += '[/wolf_toggle]';
		 });
		//endforeach

			
		if(window.tinyMCE){

			window.parent.send_to_editor(output);
			//window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, output);
			tb_remove();
			return false;
		}
	});
});
</script>
<div id="wolf-popup-head"><strong><?php _e('Insert toggles', 'wolf'); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">
		<div class="box">
			<input type="checkbox" name="panel-open" class="panel-open" value="" id="panel-open0">
			<label><?php _e('Open by default ?', 'wolf'); ?></label>
			

			<fieldset class="wolf-section-field">
				<label><?php _e('Toggle title', 'wolf'); ?></label>
				<input type="text" name="panel-title" class="panel-title" value="" id="panel-title0">
			</fieldset>
		
			<fieldset class="wolf-section-field">
				<label><?php _e('Toggle content', 'wolf'); ?></label>
				<textarea name="panel-content" class="panel" id="panel0" cols="30" rows="10"></textarea>
			</fieldset>
			<a href="#" class="close"><?php _e('Remove', 'wolf'); ?></a>	
			<hr>					
		</div>
		<div id="newfields"></div>
		
		
		<p>
			<a href="#" id="add-panel" class="add"><?php _e('Add another toggle', 'wolf'); ?></a>
		</p>

		<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e('Insert Toggles', 'wolf'); ?>"></p>
	</form>
</div>