(function($) {
    $(window).load(function() {

        $("#wcetsmfree_dialog").dialog({
            modal: true, title: 'Subscribe To Our Newsletter', zIndex: 10000, autoOpen: true,
            width: '600', resizable: false,
            position: {my: "center", at: "center", of: window},
            dialogClass: 'dialogButtons',
            buttons: [
                {
                    id: "Delete",
                    text: "Subscribe Me",
                    click: function() {
                        // $(obj).removeAttr('onclick');
                        // $(obj).parents('.Parent').remove();
                        var email_id = jQuery('#txt_user_sub_wcetsm').val();
                        var data = {
                            'action': 'add_plugin_user_wetfgfree',
                            'email_id': email_id
                        };
                        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                        jQuery.post(ajaxurl, data, function(response) {
                            jQuery('#wcetsmfree_dialog').html('<h2>You have been successfully subscribed');
                            jQuery(".ui-dialog-buttonpane").remove();
                        });
                    }
                },
                {
                    id: "No",
                    text: "No, Remind Me Later",
                    click: function() {

                        jQuery(this).dialog("close");
                    }
                },
            ]
        });

        jQuery("div.dialogButtons .ui-dialog-buttonset button").removeClass('ui-state-default');
        jQuery("div.dialogButtons .ui-dialog-buttonset button").addClass("button-primary woocommerce-save-button");
        //End Subscribe Functionality

        $('span.enable_ecommerce_tracking_disctiption_tab').click(function(event) {
            event.preventDefault();
            var data = $(this);
            $(this).next('p.description').toggle();
            //$('span.advance_extra_flate_rate_disctiption_tab').next('p.description').toggle();

        });

    });

})(jQuery);
