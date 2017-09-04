<script type="text/javascript">
jQuery(function($) {

	$('#wolf-insert').click(function() {    

		var count = $('#count').val();
		var category = $('#category').val();
		var tag = $('#tag').val();

		var output = '';
		
		// setup the output of our shortcode
		output = '[wolf_last_posts';
		if ( count !== '') { output += ' count="' + count + '"' ; }
		if ( category !== '') { output += ' category="' + category + '"' ; }
		if ( tag !== '') { output += ' tag="' + tag + '"' ; }
		output += ']';
			
		if ( window.tinyMCE ) {
			
			window.parent.send_to_editor(output);
			tb_remove();
			return false;
		}
	});
});
</script>
<div id="wolf-popup-head"><strong><?php _e( 'Last Posts', 'wolf' ); ?></strong></div>
<div id="wolf-popup">
	<form action="#" method="get">
		<p><em><?php _e( 'All fields are optional', 'wolf' ); ?></em></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="count"><?php _e('Count (default is posts per page)', 'wolf'); ?></label></th>
					<td><input type="text" name="count" id="count" class="regular-text"></td>
				</tr>

				<tr>
					<th><label for="category"><?php _e('Category slug(s) e.g: my-cateogry (seperate with commas)', 'wolf'); ?></label></th>
					<td><input type="text" name="category" id="category" class="regular-text"></td>
				</tr>

				<tr>
					<th><label for="tag"><?php _e('Tag slug(s) e.g: my-tag (seperate with commas)', 'wolf'); ?></label></th>
					<td><input type="text" name="tag" id="tag" class="regular-text"></td>
				</tr>
				
			</tbody>
		</table>
		<p class="submit"><input type="submit" id="wolf-insert" class="button-primary" value="<?php _e('Insert', 'wolf'); ?>"></p>
	</form>
</div>