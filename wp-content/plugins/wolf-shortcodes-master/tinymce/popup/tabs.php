<?php
$error = __('You need a minimum of one tab', 'wolf');
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
		output = '[wolf_tabgroup skin="';
		output += jQuery('#skin').val();
		output += '"]';
		

		jQuery('.box').each(function(){	
			 title = jQuery(this).find('.panel-title').val();
			 content = jQuery(this).find('.panel').val();
			 output += '[wolf_tab title="' +title;
			 output += '"]';
			 output +=   content;
			 output += '[/wolf_tab]';
		 });
		//endforeach
		output += '[/wolf_tabgroup]';

			
		if(window.tinyMCE){
			
			//alert(output);
			window.parent.send_to_editor(output);
			//window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, output);
			tb_remove();
			return false;
		}
	});
});
</script>
<div id="wolf-popup-head"><strong><?php _e('Insert Tabs', 'wolf'); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">

			<fieldset class="wolf-tab-field">
				<label><?php _e('Skin', 'wolf'); ?></label>
				<select name="skin" id="skin">
					<option value="light"><?php _e('Light', 'wolf'); ?></option>
					<option value="dark"><?php _e('Dark', 'wolf'); ?></option>
				</select>
			</fieldset>
			<hr>
		<div class="box">
			
			<fieldset class="wolf-tab-field">
				<label><?php _e('Tab title', 'wolf'); ?></label>
				<input type="text" name="panel-title" class="panel-title" value="" id="panel-title0">
			</fieldset>
		
		
		
			<fieldset class="wolf-tab-field">
				<label><?php _e('Tab content', 'wolf'); ?></label>
				<textarea name="panel-content" class="panel" id="panel0" cols="30" rows="10"></textarea>
			</fieldset>
			<a href="#" class="close"><?php _e('Remove', 'wolf'); ?></a>	
			<hr>					
		</div>
		<div id="newfields"></div>
		
		
		<p>
			<a href="#" id="add-panel" class="add"><?php _e('Add another tab', 'wolf'); ?></a>
		</p>

		<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e('Insert Tabs', 'wolf'); ?>"></p>
	</form>
</div>