<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description : Create Product_feedback Custome post type.
 * Function Name : e_product_feedback_post_type().
 * @hook : init;
 */
add_action( 'init', 'e_product_feedback_post_type' );

function e_product_feedback_post_type() {
	register_post_type( 'Product_Feedback', array(
			'labels'        => array(
				'name'               => 'Product_Feedback',
				'singular_name'      => 'Product_Feedback',
				'add_new'            => 'Add New',
				'add_new_item'       => 'Add New Product_Feedback',
				'edit'               => 'Edit',
				'edit_item'          => 'Edit Product_Feedback',
				'new_item'           => 'New Product_Feedback',
				'view'               => 'View',
				'view_item'          => 'View Product_Feedback',
				'search_items'       => 'Search Product_Feedback',
				'not_found'          => 'No Product_Feedback found',
				'not_found_in_trash' => 'No Product_Feedback found in Trash',
				'parent'             => 'Parent Product_Feedback'
			),
			'public'        => true,
			'menu_position' => 15,
			'supports'      => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
			'taxonomies'    => array( '' ),
			'menu_icon'     => plugins_url( 'e-product-feedback/admin/img/site-icon-crop.jpg' ),
			'has_archive'   => true
		)
	);
}

/**
 * Description : Add Admin penal in add menu.
 * Function Name : my_menu_pages().
 * @hook : admin_menu.
 */
add_action( 'admin_menu', 'my_menu_pages' );

function my_menu_pages() {
	add_menu_page( 'Product Feedback', 'Product Feedback', 'manage_options', 'Settings', 'my_menu_output' );
}

function my_menu_output() {

	require plugin_dir_path( __FILE__ ) . 'option_settings.php';
}

/**
 * Descripion : Add to cart button after new button add.
 * Function Name :my_add_button().
 * @hook : woocommerce_after_add_to_cart_button.
 */
add_action( 'woocommerce_after_add_to_cart_button', 'add_button' );

function add_button() {
	global $product;
	$product_id   = $product->get_id();
	$pop_status   = get_option( 'popup_status' );
	$butoon_label = get_option( 'btl_label' );
	if ( ! empty( $butoon_label ) ) {
		$btn_label = $butoon_label;
	} else {
		$btn_label = "Add Feedback";
	}
	if ( '1' === $pop_status || ! empty( $pop_status ) ) {
		add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
	} else {
		echo '<input type="button" style="width:190px;height: 50px;margin-top: 10px" id="add_btn" value="' . esc_html_e( $btn_label ) . '" onclick="popup_msg( "' . esc_html_e( $product_id ) . '", "' . esc_html_e( $pop_status ) . '");/>';


		$html_code = '';
		$html_code .= '<div id="divForm" style="display:none;">
        
        <form action="" method="post">
            First Name <br/> <input id="f_name_1" type="text" class="pfb_input"  name="first_name"  placeholder="Enter First Name" required="required" /><spam></spam><br />
            Last Name <br/> <input type="text" id="l_name_1" class="pfb_input" name="last_name" placeholder="Enter Last Name" /></p><br />
            Email ID <br/> <input type="email" id="u_email_1" class="pfb_input" name="email" placeholder="Enter Your Email id" /></p><br />
            Phone No <br/> <input type="text" id="phone_num_1" class="pfb_input" name="phone_number" placeholder="Enter Your Phone Number" /><br />
            Comment <br/> <textarea id="u_comment_1" name="comment" placeholder="Enter Your Comment Please"></textarea><br />
            <input type="hidden" id="product_store">    
            <input type="button" id="custome_post_store" onclick="submit_all_data();" name="submit_btn" value="Submit Data" />
        </form>

    </div>';
		echo esc_html_e( $html_code );
	}
}

/**
 * Description : Store Data In Custome Post.
 * Function Name : insert_in_custome_post_data().
 * @hook : wp_ajax_insert_in_custome_post_data.
 */
add_action( 'wp_ajax_insert_in_custome_post_data', 'insert_in_custome_post_data' );
add_action( 'wp_ajax_nopriv_insert_in_custome_post_data', 'insert_in_custome_post_data' );

function insert_in_custome_post_data() {
	//$first_name = $_REQUEST['first_name'];
	$first_name = ( $key = filter_input( INPUT_REQUEST, 'first_name' ) ) ? $key : '';
	//$last_name = $_REQUEST['second_name'];
	$last_name = ( $key = filter_input( INPUT_REQUEST, 'second_name' ) ) ? $key : '';
	//$user_email = $_REQUEST['user_email'];
	$user_email = ( $key = filter_input( INPUT_REQUEST, 'user_email' ) ) ? $key : '';
	//$phone_number = $_REQUEST['phone_number'];
	$phone_number = ( $key = filter_input( INPUT_REQUEST, 'phone_number' ) ) ? $key : '';
	//$product_comment = $_REQUEST['comment'];
	$product_comment = ( $key = filter_input( INPUT_REQUEST, 'comment' ) ) ? $key : '';
	//$product_id = $_REQUEST['product_id'];
	$product_id   = ( $key = filter_input( INPUT_REQUEST, 'product_id' ) ) ? $key : '';
	$product_name = get_the_title( $product_id );
	$p_id         = wp_insert_post( array( 'post_title'   => $first_name . '-' . $product_name,
	                                       'post_type'    => 'product_feedback',
	                                       'post_content' => '',
	                                       'post_status'  => 'publish',
	) );
	add_post_meta( $p_id, 'User_First_Name', $first_name );
	add_post_meta( $p_id, 'User_Last_Name', $last_name );
	add_post_meta( $p_id, 'User_Phone_Number', $phone_number );
	add_post_meta( $p_id, 'User_Email_Id', $user_email );
	add_post_meta( $p_id, 'Product_Comment', $product_comment );
	add_post_meta( $p_id, 'Product_id', $product_id );
	//Send Admin Mail.
	$to          = get_option( 'admin_email' );
	$subject     = "Product Feedback";
	$discription = "Product ID : " . $product_id . "<br/>Product Name : " . $product_name . "<br/>User Name : " . $first_name;
	wp_mail( $to, $subject, $discription );
	die();
}

/**
 *
 * @param type $tabs
 *
 * @return type
 * Description : Woocomerce in add New Product Feedback.
 * Function Name : woo_new_product_tab
 * @hook : woocommerce_product_tabs
 */
function woo_new_product_tab( $tabs ) {

	// Adds the new tab

	$tabs['test_tab'] = array(
		'title'    => __( 'Product Feedback', 'woocommerce' ),
		'priority' => 50,
		'callback' => 'add_product_feedback_tab'
	);

	return $tabs;
}

function add_product_feedback_tab() {
	global $product;
	$product_id = $product->get_id();
	$html_code  = '';
	$html_code .= '<div id="divForm">
        <form action="" method="post">
            First Name <br/> <input id="f_name_1" type="text" class="test_md"  name="first_name"  placeholder="Enter First Name" required=""><br/>
            Last Name <br/> <input type="text" id="l_name_1"  name="last_name" placeholder="Enter Last Name"><br/>
            Email ID <br/> <input type="email" id="u_email_1" name="email" placeholder="Enter Your Email id"><br/>
            Phone No <br/> <input type="text" id="phone_num_1" name="phone_number" placeholder="Enter Your Phone Number"><br/>
            Comment <br/> <textarea id="u_comment_1" name="comment" placeholder="Enter Your Comment Please"></textarea><br/>
            <input type="hidden" id="tab_product_id" value="' . $product_id . '">    
            <input type="button" id="custome_post_store" onclick="submit_all_data();" name="submit_btn" value="Submit Data" >
        </form>

    </div>';
	echo esc_attr_e( $html_code );
}

/**
 * Description Admin Option Setting Save Ajax call.
 * Function Name : setting_data_save().
 * @hook :wp_ajax,wp_ajax_nopriv
 */
add_action( 'wp_ajax_setting_data_save', 'setting_data_save' );
add_action( 'wp_ajax_nopriv_setting_data_save', 'setting_data_save' );

function setting_data_save() {
	//$p_status = $_REQUEST['pop_status'];
	$p_status = ( $key = filter_input( INPUT_REQUEST, 'pop_status' ) ) ? $key : '';
	//$s_status = $_REQUEST['set_status'];
	$s_status = ( $key = filter_input( INPUT_REQUEST, 'set_status' ) ) ? $key : '';
	//$btn_label = $_REQUEST['btn_label'];
	$btn_label = ( $key = filter_input( INPUT_REQUEST, 'btn_label' ) ) ? $key : '';
	update_option( 'popup_status', $p_status );
	update_option( 'setform_status', $s_status );
	update_option( 'button_label', $btn_label );
}
