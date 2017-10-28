<?php
/**
 * Admin panel form here.
 */
?>
<div style="padding: 30px 10px 40px 10px;font-size: 20px;font-weight: bold;font-family: time new roman">
    Settings for Product Feedback.
</div>
<div style="width:48%;background-color: #ffffff; padding:50px;border-radius: 5px;font-family: time new roman">
	<?php
	//get value for all settings.
	$pop_status = get_option( 'popup_status' );
	$set_status = get_option( 'setform_status' );
	$btn_lbl    = get_option( 'button_label' );
	?>
    <form action="" method="post" style="font-size: 18px">
        <input id="pop_option" type="checkbox" name="popup" <?php
		if ( 1 === $pop_status ) {
			echo "checked";
		} else {
			echo "";
		}
		?>> Do You Want Disable Popup Registration From.<br/><br/>
        <input id="set_option" type="checkbox" name="setpage" <?php
		if ( 1 === $set_status ) {
			echo "checked";
		} else {
			echo "";
		}
		?>> Add Your Url Page In Add Registration From.<br/><br/>
        You Can Change Add To cart Below Button Label.
        <input id="btl_option2" type="text" name="btnlbl" style="height: 35px" value="<?php
		if ( isset( $btn_lbl ) ) {
			echo esc_attr_e( $btn_lbl );
		}
		?>"><br/><br/>
    </form>
    <input type="button" name="settings" value="Submit" onclick="my_fun()"
           style="width: 150px;height: 40px;font-size: 22px;font-weight: bold;font-family: time new roman;border-radius: 8px;">

</div>

<script>
    function my_fun() {
        var pop_status;
        var set_status;
        var btn_label = jQuery('#btl_option2').val();
        if (jQuery('#pop_option').is(":checked")) {
            pop_status = 1;
        } else {
            pop_status = 0;
        }
        if (jQuery('#set_option').is(":checked")) {
            set_status = 1;
        } else {
            set_status = 0;
        }
        jQuery.ajax({
            url: ajaxurl2.ajaxparams2,
            type: 'POST',
            data: {
                action: 'setting_data_save',
                pop_status: pop_status, set_status: set_status, btn_label: btn_label
            },
            success: function (data) {

            },
        });
    }
</script>