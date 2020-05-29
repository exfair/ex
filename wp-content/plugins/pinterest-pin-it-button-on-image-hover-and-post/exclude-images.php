<hr>
<div>
	<h3><?php esc_html_e('To Exclude the image(s) from Pin Button On Image Hover. Please add image(s) URL below:', WEBLIZAR_PINIT_TD); ?></h3>
	<input id="no-pin-image-url" name="no-pin-image-url" type="text" value="" placeholder="<?php esc_attr_e('Provide Image SRC URL', WEBLIZAR_PINIT_TD); ?>">
	<?php wp_nonce_field( 'pinit_exclude_nonce_action', 'pinit_exclude_nonce_field' ); ?>
	<button id="add-pin-image-url" name="add-pin-image-url" class="button button-primary" type="button" onclick="return SaveNoPinImage(this.value);"><strong><i class="fas fa-plus"></i>&nbsp;&nbsp;<?php esc_html_e('Add', WEBLIZAR_PINIT_TD); ?></strong></button>
	<i id="loading-2" name="loading-2" style="display: none;" class="fas fa-cog fa-spin fa-2x"></i>
	<p class="alert"><strong><?php esc_html_e('Note', WEBLIZAR_PINIT_TD); ?>:</strong> <?php esc_html_e('Refresh the page to see new added URLs.', WEBLIZAR_PINIT_TD); ?> <button id="refersh-page" name="refersh-page" class="button button-primary" type="button" onclick="return location.reload();"><strong><span class="dashicons dashicons-update"></span><?php esc_html_e('Refesh', WEBLIZAR_PINIT_TD); ?></strong></button></p>
</div>
<hr>
<div>
	<?php
	$all_exclude_images = NULL;
	$all_exclude_images = get_option('exclude_pin_it_images');
	//print_r($all_exclude_images);

	?>
	<table class="table">
		<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col"><?php esc_html_e('URL', WEBLIZAR_PINIT_TD); ?></th>
			<th scope="col" class="text-center"><input type="checkbox" id="select-all" name="select-all[]" value="-1" /></th>
		</tr>
		</thead>
		<tbody>
		<?php
		//if($all_exclude_images != ''){
			if(is_array($all_exclude_images) && count($all_exclude_images)) {
				$count = 1;
				foreach($all_exclude_images as $exclude_key => $exclude_image) {
					if($exclude_image) {
			?>
			<tr id="<?php echo esc_attr($exclude_key); ?>">
				<th scope="row"><?php echo esc_html($count); ?></th>
				<td><?php echo esc_html($exclude_image); ?></td>
				<th scope="col" class="text-center"><input type="checkbox" id="select-all" name="select-all[]" value="<?php echo esc_attr($exclude_key); ?>" /></th>
			</tr>
			<?php
					$count++;
					}
				}
			}
		//}
		 else {
			echo '<tr><td colspan="3">No URL(s) Added Yet.</td></tr>';
		}
		?>
		</tbody>
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col"><?php esc_html_e('URL', WEBLIZAR_PINIT_TD); ?></th>
				<th scope="col" class="text-center"><input type="checkbox" id="select-all" name="select-all[]" value="-1" /></th>
			</tr>
		</thead>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th class="text-center"><button type="button" id="delete-all" name="delete-all" title="Delte All" onclick="return DeleteAllImg();"><i class="fas fa-trash"></i></button></th>
		</tr>

	</table>
</div>

<script>
// select all check box
jQuery("#select-all").click(function(){
    jQuery('input:checkbox').not(this).prop('checked', this.checked);
});

// delete checked urls
function DeleteAllImg(){
	var img_ids = [];
	jQuery(':checkbox:checked').each(function(i){
	  img_ids[i] = jQuery(this).val();
	});
	console.log(img_ids);
	console.log(img_ids.length);
	if(img_ids.length){

		// remove deleted row from table
		jQuery.each( img_ids, function( key, value ) {
			//alert( value );
			jQuery("#"+value).fadeOut(1500);
		});

		jQuery.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				action: "delete_exclude_images",
				img_ids: img_ids,
				pinit_exclude_nonce_field: jQuery("input#pinit_exclude_nonce_field").val(),
			},
			dataType: 'html',
			complete : function() {  },
			success: function(data) {

			}
		});
	}
}

//save image url
function SaveNoPinImage(){
	var img_url = jQuery("#no-pin-image-url").val();

	if(!img_url) {
		jQuery("#no-pin-image-url").focus();
		return false;
	}

	jQuery('button#add-pin-image-url').hide();
	jQuery('#loading-2').show();
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: {
			action: "exclude_image",
			img_url: img_url,
			pinit_exclude_nonce_field: jQuery("input#pinit_exclude_nonce_field").val(),
		},
		dataType: 'html',
		complete : function() {  },
		success: function(data) {
			jQuery('#loading-2').hide();
			jQuery('button#add-pin-image-url').show();
			jQuery("#no-pin-image-url").val("");
			jQuery("#no-pin-image-url").focus();
		}
	});
}
</script>
