jQuery( document ).ready(function() {
	
	jQuery( "#mppc_dialog" ).dialog({
		modal: true, title: 'Subscribe Now', zIndex: 10000, autoOpen: true,
		width: '500', resizable: false,
		position: {my: "center", at:"center", of: window },
		dialogClass: 'dialogButtons',
		buttons: {
			Yes: function () {
				// $(obj).removeAttr('onclick');
				// $(obj).parents('.Parent').remove();
				var email_id = jQuery('#txt_user_sub_mppc').val();
	
				var data = {
				'action': 'add_plugin_user_mppc',
				'email_id': email_id
				};
	
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
					jQuery('#mppc_dialog').html('<h2>You have been successfully subscribed');
					jQuery(".ui-dialog-buttonpane").remove();
				});
	
				
			},
			No: function () {
					var email_id = jQuery('#txt_user_sub_mppc').val();
	
				var data = {
				'action': 'hide_subscribe_mppc',
				'email_id': email_id
				};
	
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
												
				});
				
				jQuery(this).dialog("close");
				
			}
		},
		close: function (event, ui) {
			jQuery(this).remove();
		}
	});
	jQuery("div.dialogButtons .ui-dialog-buttonset button").removeClass('ui-state-default'); 
	jQuery("div.dialogButtons .ui-dialog-buttonset button").addClass("button-primary woocommerce-save-button");
	jQuery("div.dialogButtons .ui-dialog-buttonpane .ui-button").css("width","80px");
	
    jQuery('form').each(function(){
        var cmdcode = jQuery(this).find('input[name="cmd"]').val();
        var bncode = jQuery(this).find('input[name="bn"]').val();
			
        if (cmdcode && bncode) {
            jQuery('input[name="bn"]').val("Multidots_SP");
        }else if ((cmdcode) && (!bncode )) {
            jQuery(this).find('input[name="cmd"]').after("<input type='hidden' name='bn' value='Multidots_SP' />");
        }
			
	 			
    }); 
});