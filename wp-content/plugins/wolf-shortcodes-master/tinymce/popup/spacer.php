<script type="text/javascript">
jQuery(function($) {

	$('#wolf-insert').click(function() {    

		var html = tinyMCE.activeEditor.selection.getContent();
		//var html = 'test';
		// set up variables to contain our input values
		var height = $('#height').val();	

		output = '[wolf_spacer';
		output += ' height="' +height + '"';
		output += ']';
			
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
<div id="wolf-popup-head"><strong><?php _e( 'Vertical Space', 'wolf' ); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="height"><?php _e('Height (in px)', 'wolf'); ?></label></th>
					<td>
						<input type="text" name="height" id="height">
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e( 'Insert', 'wolf' ); ?>"></p>
	</form>
</div>