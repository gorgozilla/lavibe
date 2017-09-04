<script type="text/javascript">
jQuery(function($) {

	$('#wolf-insert').click(function() {    

		var src = $('#src').val();
		var height = $('#height').val();
		var width = $('#width').val();

		var output = '';
		
		// setup the output of our shortcode
		output = '[wolf_googlemap ';
		output += 'src="' +src + '"';
		if(height!=''){
			output += ' height="' +height + '"';
		}

		if(width!=''){
			output += ' width="' +width + '"';
		}

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
<div id="wolf-popup-head"><strong><?php _e('Insert a map', 'wolf'); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="width"><?php _e('Width', 'wolf'); ?></label></th>
					<td><input type="text" name="width" id="width" class="regular-text" value="">
						<p class="description"><?php _e('Leave empty for full width', 'wolf'); ?></p>
					</td>
				</tr>

				<tr>
					<th><label for="height"><?php _e('Height', 'wolf'); ?></label></th>
					<td><input type="text" name="height" id="height" class="regular-text"></td>
				</tr>

				<tr>
					<th><label for="src"><?php _e('Src', 'wolf'); ?></label></th>
					<td><input type="text" name="src" id="src" class="regular-text"><br>
						<a href="http://media.wpwolf.com/screenshots/googlemap-src.jpg" target="_blank"><?php _e('Where to find it?', 'wolf'); ?></a>
					</td>
				</tr>
				
			</tbody>
		</table>
		<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e('Insert', 'wolf'); ?>"></p>
	</form>
</div>