/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//popup form Opent This function throw.
function popup_msg(id) {
    jQuery('#product_store').val(id);
    $.fancybox({
        content: $("#divForm"),
        autoSize: false,
        width: "500px",
        padding: [40, 40, 0, 40],
    });
}

//popup form Submit all data save this function throw.
function submit_all_data() {
    var first_name = $('#f_name_1').val();
    var last_name = $('#l_name_1').val();
    var user_email = $('#u_email_1').val();
    var phone_number = $('#phone_num_1').val();
    var user_comment = $('#u_comment_1').val();
    var product_id = $('#product_store').val();

    if (!(product_id)) {
        product_id = $('#tab_product_id').val();
    }
    var counter = 0;
    $(".pfb_input").each(function() {
        if ($(this).val() === "") {
            $(this).addClass("redClass");
            //$(this).css("border-color", "red"); 

            $(this).next().append("*");
            $(this).next().css("color", "red");
            counter++;
        }

    });
    $(".pfb_input").blur(function() {
        if ($(this).val()) {
            $(this).removeClass('redClass');
            $(this).next().html('');
        }
    });
    if (counter > 0) {
        $(".pfb_input").each(function() {
            if ($(this).val() === "") {

            }
        });
    } else {
        $.ajax({
            url: ajaxurl.ajaxparams,
            type: 'POST',
            data: {
                action: 'insert_in_custome_post_data',
                first_name: first_name, second_name: last_name, user_email: user_email, phone_number: phone_number, comment: user_comment, product_id: product_id
            },
            success: function(data) {
                $('#msg_suucess').html("Success Fully Insert Data !");
            },
        });
    }

    //$.fancybox.close();
}

