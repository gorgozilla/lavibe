<script type="text/javascript">
jQuery(function($) {

	$('#wolf-insert').click(function() {    

		var html = tinyMCE.activeEditor.selection.getContent();
		//var html = 'test';
		// set up variables to contain our input values
		var type = $('#notif').val();	

		output = '[wolf_notif';
		output += ' type="' +type + '"';
		output += ']'+ html + '[/wolf_notif]';
			
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
<div id="wolf-popup-head"><strong><?php _e('Notification Message', 'wolf'); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="notif"><?php _e('Type', 'wolf'); ?></label></th>
					<td>
						<select name="notif" id="notif">
							<option value="success"  selected="selected">Success</option>
							<option value="info">Info</option>
							<option value="tip">Tip</option>
							<option value="error">Error</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e('Wrap selected paragraph', 'wolf'); ?>"></p>
	</form>
</div>