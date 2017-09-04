<script type="text/javascript">
jQuery( function( $ ) {

	var $unique = $( 'input.dl-checkbox' );
	$unique.click( function() {
		$unique.removeAttr( 'checked' );
		$( this ).attr( 'checked', true );
	} );

	$('#wolf-insert').click(function() {    

		var text = $( '#text' ).val();
		var link = $( '#link' ).val();
		var color = $( '#color' ).val();
		var size = $( '#size' ).val();
		var type = $( '#type' ).val();
		var tagline = $( '#tagline' ).val();

		if (link=='') link = '#';
		
		var output = '';
		
		// setup the output of our shortcode
		output = '[wolf_button ';
		output += 'url="' +link + '"';
		output += ' color="' +color + '"';
		output += ' type="' +type + '"';
		output += ' size="' +size + '"';
		if ( $('#target').is(":checked") ) { output += ' target="_blank"' ; }
		if ( $('#download').is(":checked") ) { output += ' download="true"' ; }
		if ( $('#download_pdf').is(":checked") ) { output += ' download_pdf="true"'; }
		if ( tagline !== '' ) { output += ' tagline="' + tagline + '"'; }
		output += ']'+ text + '[/wolf_button]';
			
		if ( window.tinyMCE) {
			window.parent.send_to_editor(output);
			tb_remove();
			return false;
		}
	} );
} );
</script>
<div id="wolf-popup-head"><strong><?php _e('Insert a Button', 'wolf'); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="text"><?php _e('Text', 'wolf'); ?></label></th>
					<td><input type="text" name="text" id="text" class="regular-text" value="<?php _e('Button', 'wolf'); ?>"></td>
				</tr>

				<tr>
					<th><label for="tagline"><?php _e('Tagline (optional)', 'wolf'); ?></label></th>
					<td><input type="text" name="tagline" id="tagline" class="regular-text"></td>
				</tr>

				<tr>
					<th><label for="link"><?php _e('Link', 'wolf'); ?></label></th>
					<td><input type="text" name="link" id="link" class="regular-text">
						<p class="description">http://www.example.com</p>
					</td>
				</tr>

				<tr>
					<th><label for="color"><?php _e('Color', 'wolf'); ?></label></th>
					<td>
						<select name="color" id="color">
							<option value="yellow"><?php _e('yellow', 'wolf'); ?></option>
							<option value="white"><?php _e('white', 'wolf'); ?></option>
							<option value="black"><?php _e('black', 'wolf'); ?></option>
							<option value="red"><?php _e('red', 'wolf'); ?></option>
							<option value="green"><?php _e('green', 'wolf'); ?></option>
							<option value="green-2"><?php _e('green 2', 'wolf'); ?></option>
							<option value="purple"><?php _e('purple', 'wolf'); ?></option>
							<option value="blue"><?php _e('blue', 'wolf'); ?></option>
						</select>
					</td>
				</tr>

				<tr>
					<th><label for="type"><?php _e('Type', 'wolf'); ?></label></th>
					<td>
						<select name="type" id="type">
							<option value="flat"><?php _e('Flat', 'wolf'); ?></option>
							<option value="square"><?php _e('Square', 'wolf'); ?></option>
							<option value="round"><?php _e('Round', 'wolf'); ?></option>
						</select>
					</td>
				</tr>

				<tr>
					<th><label for="size"><?php _e('Size', 'wolf'); ?></label></th>
					<td>
						<select name="size" id="size">
							<option value="small"><?php _e('Small', 'wolf'); ?></option>
							<option value="medium"><?php _e('Medium', 'wolf'); ?></option>
							<option value="big"><?php _e('Big', 'wolf'); ?></option>
						</select>
					</td>
				</tr>

				<tr>
					<th><?php _e('Download button', 'wolf'); ?></th>
					<td>
						<fieldset>
						<label for="download">
							<input class="dl-checkbox" name="download" type="checkbox" id="download">
						</label><br />
						</fieldset>
					</td>
				</tr>

				<tr>
					<th><?php _e('Download button PDF', 'wolf'); ?></th>
					<td>
						<fieldset>
						<label for="download_pdf">
							<input class="dl-checkbox" name="download_pdf" type="checkbox" id="download_pdf">
						</label><br />
						</fieldset>
					</td>
				</tr>

				<tr>
					<th><?php _e('Open link in a new tab', 'wolf'); ?></th>
					<td>
						<fieldset>
						<label for="target">
							<input name="target" type="checkbox" id="target">
						</label><br />
						</fieldset>
					</td>
				</tr>
				
			</tbody>
		</table>
		<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e('Insert', 'wolf'); ?>"></p>
	</form>
</div>