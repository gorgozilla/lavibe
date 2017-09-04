<script type="text/javascript">
jQuery(function($) {

	$('input.option').change(function(){
		nb = $('input.option:checked').length;
		if(nb > 1){
			$('input.option').attr('checked', false)
			$(this).attr('checked', true);
		}
	});


	$('#wolf-insert').click(function() {    

		var html = tinyMCE.activeEditor.selection.getContent();

		var col = $('#col').val();	

		output = '[wolf_';
		output += col;
		
		if( $('#alpha').is(":checked")){ output += ' class="first"' ; }
		else if( $('#omega').is(":checked")){ output += ' class="last"' ; }

		output += ']'+ html + '[/wolf_';
		output += col;
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
<div id="wolf-popup-head"><strong><?php _e('Insert Columns', 'wolf'); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="column"><?php _e('Column', 'wolf'); ?></label></th>
					<td>
						<select name="col" id="col">
							<option value="col_6"  selected="selected">col_6 (one half)</option>
							<option value="col_4">col_4 (one third)</option>
							<option value="col_3">col_3 (one fourth)</option>
							<option value="col_12">col_12 (full)</option>
							<option value="col_11">col_11</option>
							<option value="col_10">col_10</option>
							<option value="col_9">col_9</option>
							<option value="col_8">col_8</option>
							<option value="col_7">col_7</option>
							<option value="col_5">col_5</option>
							<option value="col_2">col_2</option>
							<option value="col_1">col_1</option>
						</select>
					</td>
				</tr>

				<tr>
					<th>First</th>
					<td><fieldset>
					<label for="last">
					<input class="option" name="wolf-checkbox[]" type="checkbox" id="alpha">
					</label><br />
					</fieldset></td>
				</tr>
				<tr>
					<th>Last</th>
					<td><fieldset>
					<label for="last">
					<input class="option" name="wolf-checkbox[]" type="checkbox" id="omega">
					</label><br />
					</fieldset></td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e('Wrap selected paragraph', 'wolf'); ?>"></p>
	</form>
	<p class="help"><?php _e('A row consists of a series of columns (col_X) that add up to 12. <br>
		So, a row of 3+3+3+3 or 4+4+4 or 2+3+5+2, anything that adds to 12 will be the full width of the page.', 'wolf'); ?></p>
	<p class="help"><?php _e('Check the "First" checkbox if your column is the first of the row<br>
		and check the "Last" checkbox if your column is the last of the row.', 'wolf'); ?>
	</p>
</div>