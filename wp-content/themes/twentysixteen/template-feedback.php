<?php
/**
 * Template Name: Feedback
 * @package WordPress
 * @subpackage Firescience
 */

get_header(); ?>

<style>
    li{display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:30px;}
    .highlight, .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
    function highlightStar(obj) {
        removeHighlight();
        $('li').each(function(index) {
            $(this).addClass('highlight');
            if(index == $("li").index(obj)) {
                return false;
            }
        });
    }

    function removeHighlight() {
        $('li').removeClass('selected');
        $('li').removeClass('highlight');
    }

    function addRating(obj) {
        $('li').each(function(index) {
            $(this).addClass('selected');
            $('#rating').val((index+1));
            if(index == $("li").index(obj)) {
                return false;
            }
        });
    }

    function resetRating() {
        if($("#rating").val()) {
            $('li').each(function(index) {
                $(this).addClass('selected');
                if((index+1) == $("#rating").val()) {
                    return false;
                }
            });
        }
    }

    jQuery(document).on('click','.submit_feedback',function(){
        var form_data = jQuery('#feedback_form').serialize(); // <--- Important

        jQuery.ajax({
            type: 'POST',
            url:'<?php echo admin_url('admin-ajax.php'); ?>',
            data: ({action : 'feed_back_function','form_data' : form_data}),
            success: function(data) {
                var finaloutput = $.parseJSON(data);
                //$('.comparision-table .cc-compare-view').html(finaloutput.cardhtml);
                /*var result = Object.keys(finaloutput.com).map(function(e) {
                    return [Number(e), finaloutput.com[e]];
                });*/

                var arr = $.map(finaloutput.com, function(el) { return el; });
                console.log(arr);
                //alert(result);
            }
        });

    });
</script>

<form id="feedback_form">
   <label>Rate :-</label>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="hidden" name="rating" id="rating" />
    <ul onMouseOut="resetRating();">
        <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
        <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
        <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
        <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
        <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
    </ul>

    <?php
    //if ( !is_user_logged_in() ) {
     ?>
        <label> Name :- </label> <input class="name" name="name" type="textarea"/><br/><br/>
        <label> Email :- </label> <input class="email" name="email" type="textarea"/><br/><br/>
    <?php
    //}
    ?>

    <label> Comment :- </label> <input class="comment_box" name="comment_box" type="textarea"/><br/><br/>
    <input type="button" class="submit_feedback" name="submit_feedback" value="Submit"/><br/><br/><br/><br/>
    <label class="test"></label>
</form>
<?php
$user_comment_detail  = get_comment_meta( 1, 'usr_comment', true );
print_r($user_comment_detail );
?>
<?php //wp_mail('tejas.deshmukh@multidots.in',"Testing Mail","Testiong Content");?>
<?php get_footer(); ?>
