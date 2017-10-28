<?php
/*
Plugin Name: Mass Pages/Posts Creator
Plugin URI: http://www.multidots.com/
Description: Mass Pages/Posts Creator is a plugin which provide a simplest interface by which user can create multiple Pages/Posts at a time.
Version: 1.1.3
Author: dots
Author URI: http://www.multidots.com/
*/

add_action( 'admin_enqueue_scripts', 'mpc_load_my_script' );

function mpc_load_my_script() {

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-dialog' );
	wp_enqueue_script( 'custom-js', plugin_dir_url( __FILE__ ) . 'js/custom.js', array(), 'all' );

}

add_action('admin_enqueue_scripts', 'mpc_styles'); 

add_action('admin_init', 'welcome_mass_page_creator_screen_do_activation_redirect');
add_action('admin_menu', 'welcome_pages_screen_mass_page_creator');
add_action('mass_page_post_creator_about', 'mass_page_post_creator_about');
add_action('mass_page_post_creator_other_plugins', 'mass_page_post_creator_other_plugins');
add_action('admin_print_footer_scripts', 'mass_page_creator_pointers_footer');
add_action('admin_menu', 'welcome_screen_mass_page_creator_remove_menus', 999 ); 


function welcome_mass_page_creator_screen_do_activation_redirect ( ) {  
	
	if (!get_transient('_mass_page_post_creator_welcome_screen')) {
			return;
		}
		
		// Delete the redirect transient
		delete_transient('_mass_page_post_creator_welcome_screen');

		// if activating from network, or bulk
		if (is_network_admin() || isset($_GET['activate-multi'])) {
			return;
		}
		// Redirect to extra cost welcome  page
		wp_safe_redirect(add_query_arg(array('page' => 'mass-page-post-creator&tab=about'), admin_url('index.php')));

} 

function welcome_pages_screen_mass_page_creator ( ){ 
	add_dashboard_page(
		'Mass-Pages/Posts-Creator Dashboard', 'Mass Pages/Posts Creator Dashboard', 'read', 'mass-page-post-creator',  'welcome_screen_content_mass_page_creator');
	
} 

function welcome_screen_mass_page_creator_remove_menus (){ 
	remove_submenu_page( 'index.php', 'mass-page-post-creator' );
}

function welcome_screen_content_mass_page_creator ( ) { 
	wp_enqueue_style( 'wp-pointer' );
	wp_enqueue_script( 'wp-pointer' );
	?>
	
	<div class="wrap about-wrap">
            <h1 style="font-size: 2.1em;"><?php printf(__('Welcome to Mass Pages/Posts Creator', 'mass-pagesposts-creator')); ?></h1>

            <div class="about-text woocommerce-about-text">
        <?php
        $message = '';
        printf(__('%s Mass Pages/Posts Creator is a plugin which provide a simplest interface by which user can create multiple Pages/Posts at a time.', 'mass-pagesposts-creator'), $message);
        ?>
                <img class="version_logo_img" src="<?php echo plugin_dir_url(__FILE__) . 'images/mass-pagesposts-creator.png'; ?>">
            </div>

        <?php
        $setting_tabs_wc = apply_filters('mass_page_post_creator_setting_tab', array("about" => "Overview", "other_plugins" => "Checkout our other plugins" ));
        $current_tab_wc = (isset($_GET['tab'])) ? $_GET['tab'] : 'general';
        $aboutpage = isset($_GET['page'])
        ?>
            <h2 id="woo-extra-cost-tab-wrapper" class="nav-tab-wrapper">
            <?php
            foreach ($setting_tabs_wc as $name => $label)
            echo '<a  href="' . home_url('wp-admin/index.php?page=mass-page-post-creator&tab=' . $name) . '" class="nav-tab ' . ( $current_tab_wc == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
            ?>
            </h2>
                <?php
                foreach ($setting_tabs_wc as $setting_tabkey_wc => $setting_tabvalue) {
                	switch ($setting_tabkey_wc) {
                		case $current_tab_wc:
                			do_action('mass_page_post_creator_' . $current_tab_wc);
                			break;
                	}
                }
                ?>
            <hr />
            <div class="return-to-dashboard">
                <a href="<?php echo home_url('/wp-admin/admin.php?page=mass-pages-posts-creator'); ?>"><?php _e('Go to Mass Pages/Posts Creator Settings', 'mass-pagesposts-creator'); ?></a>
            </div>
        </div>
        
        <?php 
        	global  $wpdb;	
    		$current_user = wp_get_current_user();
        	if (!get_option('mppc_plugin_notice_shown')) {
				echo '<div id="mppc_dialog" title="Basic dialog"> <p> Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free! </p> <p><input type="text" id="txt_user_sub_mppc" class="regular-text" name="txt_user_sub_mppc" value="'.$current_user->user_email.'"></p></div>';
			}
        ?>
        
        
	
<?php }


function mass_page_post_creator_about ( ){ ?>
	<div class="changelog">
            </br>
           	<style type="text/css">
				p.mass_page_post_creator_overview {max-width: 100% !important;margin-left: auto;margin-right: auto;font-size: 15px;line-height: 1.5;}.mass_page_post_creator_content_ul ul li {margin-left: 3%;list-style: initial;line-height: 23px;}
			</style>  
            <div class="changelog about-integrations">
                <div class="wc-feature feature-section col three-col">
                    <div>
                        <p class="mass_page_post_creator_overview"><?php _e('Mass Pages Posts Creator through which User can create Pages/Posts easily by the simplest interface which provide all the attribute which are necessary while creating a Pages/Posts. One unique functionality added to this plugin is user can also add Postfix & Prefix word for all Pages/Posts which is common for all. This plugin will include all attribute like status, parent page, template, type, comments status, author, etc.. which will make easy to user while creating Pages/Posts.', 'mass-pagesposts-creator'); ?></p>
                        
                     	<p class="mass_page_post_creator_overview"><strong>Key Features: </strong></p>
                         <div class="mass_page_post_creator_content_ul">
                        	<ul>
								<li>Create hundreds of pages or posts with a single click</li>
								<li>Allows you to enter prefix and postfix keywords for the name of pages or posts</li>
								<li>You can specify range or comma separated values to create posts in bulk</li>
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 

} 

function  mass_page_post_creator_other_plugins ( ) { 
	
		global $wpdb;
         $url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/checkout_other_plugin.php';
    	 $response = wp_remote_post( $url, array('method' => 'POST',
    	'timeout' => 45,
    	'redirection' => 5,
    	'httpversion' => '1.0',
    	'blocking' => true,
    	'headers' => array(),
    	'body' => array('plugin' => 'advance-flat-rate-shipping-method-for-woocommerce'),
    	'cookies' => array()));
    	
    	$response_new = array();
    	$response_new = json_decode($response['body']);
		$get_other_plugin = maybe_unserialize($response_new);
		
		$paid_arr = array();
		?>

        <div class="plug-containter">
        	<div class="paid_plugin">
        	<h3>Paid Plugins</h3>
	        	<?php foreach ($get_other_plugin as $key=>$val) { 
	        		if ($val['plugindesc'] =='paid') {?>
	        			
	        			
	        		   <div class="contain-section">
	                <div class="contain-img"><img src="<?php echo $val['pluginimage']; ?>"></div>
	                <div class="contain-title"><a target="_blank" href="<?php echo $val['pluginurl'];?>"><?php echo $key;?></a></div>
	            </div>	
	        			
	        			
	        		<?php }else {
	        			
	        			$paid_arry[$key]['plugindesc']= $val['plugindesc'];
	        			$paid_arry[$key]['pluginimage']= $val['pluginimage'];
	        			$paid_arry[$key]['pluginurl']= $val['pluginurl'];
	        			$paid_arry[$key]['pluginname']= $val['pluginname'];
	        		
	        	?>
	        	
	         
	            <?php } }?>
           </div>
           <?php if (isset($paid_arry) && !empty($paid_arry)) {?>
           <div class="free_plugin">
           	<h3>Free Plugins</h3>
                <?php foreach ($paid_arry as $key=>$val) { ?>  	
	            <div class="contain-section">
	                <div class="contain-img"><img src="<?php echo $val['pluginimage']; ?>"></div>
	                <div class="contain-title"><a target="_blank" href="<?php echo $val['pluginurl'];?>"><?php echo $key;?></a></div>
	            </div>
	            <?php } }?>
           </div>
          
        </div>
        <?php

}

function  mass_page_creator_pointers_footer ( ) { 
	$admin_pointers = mass_page_creator_pointers_admin_pointers();
	    ?>
	    <script type="text/javascript">
	        /* <![CDATA[ */
	        ( function($) {
	            <?php
	            foreach ( $admin_pointers as $pointer => $array ) {
	               if ( $array['active'] ) {
	                  ?>
	            $( '<?php echo $array['anchor_id']; ?>' ).pointer( {
	                content: '<?php echo $array['content']; ?>',
	                position: {
	                    edge: '<?php echo $array['edge']; ?>',
	                    align: '<?php echo $array['align']; ?>'
	                },
	                close: function() {
	                    $.post( ajaxurl, {
	                        pointer: '<?php echo $pointer; ?>',
	                        action: 'dismiss-wp-pointer'
	                    } );
	                }
	            } ).pointer( 'open' );
	            <?php
	         }
	      }
	      ?>
	        } )(jQuery);
	        /* ]]> */
	    </script>
	    <?php
}

function mass_page_creator_pointers_admin_pointers ( ) { 
	
	$dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
    $version = '1_0'; // replace all periods in 1.0 with an underscore
    $prefix = 'mass_page_creator_pointers_admin_pointers' . $version . '_';

    $new_pointer_content = '<h3>' . __( 'Welcome to  Mass Pages/Posts Creator' ) . '</h3>';
    $new_pointer_content .= '<p>' . __( 'Mass Pages/Posts Creator is a plugin which provide a simplest interface by which user can create multiple Pages/Posts at a time.' ) . '</p>';

    return array(
        $prefix . 'mass_page_creator_pointers_admin_pointers' => array(
            'content' => $new_pointer_content,
            'anchor_id' => '#toplevel_page_mass-pages-posts-creator',
            'edge' => 'left',
            'align' => 'left',
            'active' => ( ! in_array( $prefix . 'mass_page_creator_pointers_admin_pointers', $dismissed ) )
        )
    );

} 


function mpc_styles() {

	// wp_register_style( 'custom_wp_admin_css', plugins_url('mass-pagesposts-creator/css/style.css'));
	// wp_enqueue_style( 'custom_wp_admin_css' );
	wp_enqueue_style( 'style-css', plugin_dir_url( __FILE__ ) . 'css/style.css', array('wp-jquery-ui-dialog'),'1.1.1', 'all' );

}

function mpc_pages_posts_creator() {
	
	//add_submenu_page( 'options-general.php', 'Mass Pages/Posts Creator', 'Mass Pages/Posts Creator', 'administrator', 'mass-pages-posts-creator.php', 'mpc_create' );
	add_menu_page('Mass Pages/Posts Creator', 'Mass Pages/Posts Creator Page', 'manage_options', 'mass-pages-posts-creator', 'mpc_create');
}

add_action( 'admin_menu', 'mpc_pages_posts_creator' );

/*add_action( 'wp_enqueue_scripts', 'load_custom_js' );  

function load_custom_js() {
	wp_register_script('myplugin',  plugins_url('mass-pagesposts-creator/js/custom.js'));
}*/


if (in_array( 'woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))) {
	add_filter('woocommerce_paypal_args','paypal_bn_code_filter_mass_pagesposts_creator', 99, 1);
}

function paypal_bn_code_filter_mass_pagesposts_creator ($paypal_args) {
	$paypal_args['bn'] = 'Multidots_SP';
	return $paypal_args;
}


function mpc_create() { 
	global $wpdb;
	
	$current_user = wp_get_current_user();
	
	if (!get_option('mppc_plugin_notice_shown')) {
		echo '<div id="mppc_dialog" title="Basic dialog"> <p> Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free! </p> <p><input type="text" id="txt_user_sub_mppc" class="regular-text" name="txt_user_sub_mppc" value="'.$current_user->user_email.'"></p></div>';
	}
	
	$parent_pages= $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts WHERE post_parent=0 AND post_type='page' AND post_status='publish' ORDER BY menu_order ASC" ); ?>
	
	<div class="wrap">
	
		<form id="createForm" method="post" class="">
			<h2>Mass Pages/Posts Creator</h2>
			<table class="form-table">	
				<tr class="page_prefix_tr">
					<th>Prefix of Pages/Posts</th>
					<td><input type="text" class="regular-text" value="" id="page_prefix" name="page_prefix"></td>
				</tr>
				<tr class="page_post_tr">
					<th>Postfix of Pages/Posts</th>
					<td><input type="text" class="regular-text" value="" id="page_postfix" name="page_postfix"></td>
				</tr>
				<tr class="pages_list_tr">
					<th>List of Pages/Posts</br>(Coma Seperated) <b>(*)</b></th>
					<td><textarea class="code" id="pages_list" cols="60" rows="5" name="pages_list"></textarea><p class="description">eg. Test1, Test2, test3, test4, test5</p></td>
				</tr>
				<tr class="pages_content_tr">
					<th>Content of Pages/Posts</th>
					<td><textarea class="code" id="pages_content" cols="60" rows="5" name="pages_content"></textarea><p class="description">eg. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p></td>
				</tr>
				<tr class="excerpt_content_tr">
					<th>Excerpt Content</th>
					<td><textarea class="code" id="excerpt_content" cols="60" rows="5" name="excerpt_content"></textarea><p class="description">eg. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p></td>
				</tr>
				<tr class="type_tr">
					<th>Type <b>(*)</b></th>
					<td>
						<select id="type">
							<option value="none">Select Type</option>
							<option value="page">Page</option>
							<option value="post">Post</option>
						</select>
					</td>
				</tr>
				<tr class="parent_page_id_tr">
					<th>Parent Pages </th>
					<td>
						<select id="parent_page_id">
							<option value="">Select Page</option>    
							<?php foreach($parent_pages as $pages) { ?>
								<option value="<?php echo $pages->ID ?>"><?php echo $pages->post_title; ?></option>    
								<?php $subpages = get_pages( array( 'child_of' => $pages->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) ); 
								if (isset($subpages) || !empty($subpages)) {
									foreach( $subpages as $subpage ) { ?>
										<option style="margin-left: 10px;"value="<?php echo $subpage->ID; ?>"><?php echo ' -- '.$subpage->post_title; ?></option>    		
										<?php $childsubpages = get_pages( array( 'child_of' => $subpage->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) ); 
										if (isset($childsubpages) || !empty($childsubpages)) {
											foreach( $childsubpages as $childsubpage ) { ?>
												<option style="margin-left: 30px;"value="<?php echo $childsubpage->ID; ?>"><?php echo ' -- '.$childsubpage->post_title; ?></option>    		
											<?php }
										}
									}
								}
							} ?>
						</select>
					</td>
				</tr>
				<tr class="template_name_tr">
					<th>Templates  </th>
					<td>
						<?php $templates = get_page_templates(); ?>
						<select id="template_name">
							<option value="">Select Template</option>
							<?php foreach ( $templates as $template_name => $template_filename ) { ?>
							<option value="<?php echo $template_filename; ?>"><?php echo $template_name; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr class="page_status_tr">
					<th>Pages/Posts Status </th>
					<td>
						<select id="page_status">
						<option value="publish">Publish</option>
						<option value="pending">Pending</option>
						<option value="draft">Draft</option>
						<option value="auto-draft">Auto Draft</option>
						<option value="future">Future</option>
						<option value="private">Private</option>
						<option value="inherit">Inherit</option>
						<option value="trash">Trash</option>
						</select>
					</td>
				</tr>
				<tr class="comment_status_tr">
					<th>Pages/Posts Comment Status </th>
					<td>
						<select id="comment_status">
							<option value="">Select Comment Status </option>
							<option value="open"> Open </option>
							<option value="closed"> Closed </option>
						</select>
					</td>
				</tr>
				<tr class="authors_tr">
					<th>Author</th>
					<td>
						<?php $authors = get_users(); ?>
						<select id="authors">
							<option value="">Select Author </option>
							<?php foreach ($authors as $single_user) { ?>
							<option value="<?php echo  $single_user->ID; ?>"><?php echo  $single_user->user_login; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</table>
			<p class="submit"><input type="button" id="btn_submit" class="button button-primary" name="btn_submit" value="Create"/></p>
		</form>	
		<div id="message"></div>
		<div id="result"></div>
	</div>
	<style type="text/css"></style>
	<script type="text/javascript">
	
		jQuery(document).ready(function() {
			
			jQuery("#type").change(function() {
				
				var type = jQuery("#type").val();
				
				if(type == 'post'){
					jQuery(".parent_page_id_tr").hide();
					jQuery(".template_name_tr").hide();
				} else {
					jQuery(".parent_page_id_tr").show();
					jQuery(".template_name_tr").show();
				}
				
			});
			
		});
		
		jQuery("#btn_submit").click(function(e) {
			
			var prefix_word = jQuery("#page_prefix").val();
			var pages_list = jQuery("#pages_list").val();
			var pages_content = jQuery("#pages_content").val();
			var parent_page_id = jQuery("#parent_page_id").val();
			var template_name = jQuery("#template_name").val();
			var type = jQuery("#type").val();
			var postfix_word = jQuery("#page_postfix").val();
			var comment_status = jQuery("#comment_status").val();
			
			var page_status = jQuery("#page_status").val();
			var authors = jQuery("#authors").val();
			var excerpt_content = jQuery("#excerpt_content").val();
			
			if(pages_list.length == 0){
			alert('Please enter list of Pages..');
			event.preventDefault();
			return false;
			}
			
			if(type == 'none'){
			alert('Please select the type..');
			event.preventDefault();
			return false;
			}
			
			jQuery.ajax({
				type:'POST',
				data:{
					action:'mpc_ajax_action',
					prefix_word: prefix_word,
					postfix_word: postfix_word,
					pages_list: pages_list,
					pages_content: pages_content,
					parent_page_id: parent_page_id,
					template_name: template_name,
					type: type,
					page_status: page_status,
					authors: authors,
					excerpt_content: excerpt_content,
					comment_status: comment_status
				},
				url: "admin-ajax.php",
				dataType: 'html',
				success: function(response) {
					if(response) {
						jQuery("#createForm").css("display","none"); 
						jQuery("#message").addClass('view');
						jQuery('html,body').animate({scrollTop: 0},'slow');
						jQuery("#message").html('Pages/Posts Succesfully Created.. ');
						jQuery("#result").append(response);
					} else {
						jQuery("#message").addClass('view');
						jQuery("#message").html('Something goes wrong..');
					}
				}
			});
			
		});
	</script>
<?php } 

add_action( 'wp_ajax_add_plugin_user_mppc', 'wp_add_plugin_userfn' );
add_action( 'wp_ajax_hide_subscribe_mppc', 'hide_subscribe_mppcfn' );

function wp_add_plugin_userfn() {

	$email_id= $_POST['email_id'];
	$log_url = $_SERVER['HTTP_HOST'];
	$cur_date = date('Y-m-d');
	$url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/wp-add-plugin-users.php';
	$response = wp_remote_post( $url, array('method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array('user'=>array('user_email'=>$email_id,'plugin_site' => $log_url,'status' => 1,'plugin_id' => '9','activation_date'=>$cur_date)),
		'cookies' => array()));
	update_option('mppc_plugin_notice_shown', 'true');

}

function hide_subscribe_mppcfn() {
	$email_id= $_POST['email_id'];
	update_option('mppc_plugin_notice_shown', 'true');
}

function mpc_ajax_action() {
	global $wpdb;
	$html = '';
	$prefix_word = sanitize_text_field($_POST['prefix_word']);
	$postfix_word = sanitize_text_field($_POST['postfix_word']);
	$pages_content = sanitize_text_field($_POST['pages_content']);
	$parent_page_id = $_POST['parent_page_id'];
	$template_name = sanitize_text_field($_POST['template_name']);
	$type = sanitize_text_field($_POST['type']);
	$page_status = sanitize_text_field($_POST['page_status']);
	$authors = sanitize_text_field($_POST['authors']);
	$excerpt_content = sanitize_text_field($_POST['excerpt_content']);
	$comment_status = sanitize_text_field($_POST['comment_status']);
	
	$pages_list = sanitize_text_field($_POST['pages_list']);
	$page_list = explode(",", $pages_list);
	$html .= "<table cellpadding='0' cellspacing='0' >";
	$html .= "<thead><tr><th>Page/Post Id</th><th>Page/Post Name</th><th>Page/Post Status</th><th>URL</th></tr></thead><tbody>";
	
	foreach ($page_list as $page_name) {
		$my_post = array(
			'post_title'     => $prefix_word.' '.$page_name.' '.$postfix_word,
			'post_type'      => $type,
			'post_content'   => $pages_content,
			'post_author'    => $authors,
			'post_parent'    => $parent_page_id,
			'post_status'    => $page_status,
			'post_excerpt'   => $excerpt_content,
			'comment_status' => $comment_status
		);
		
		$last_insert_id = wp_insert_post($my_post);
		
		$url = get_permalink($last_insert_id);
		
		$html .= "<tr>";
		
		$html .= "<td> $last_insert_id</td> <td>".esc_html($page_name)." </td> <td class='status'> Ok </td><td> <a href='".esc_url($url)."' target='_blank'>".esc_url($url)."</a> </td>";	
		$html .= "</tr>";	
		add_post_meta( $last_insert_id , '_wp_page_template', $template_name);
	
	}
	
	$html .= "</tbody><table>";
	echo $html;
	wp_die(); 
}

add_action( 'wp_ajax_mpc_ajax_action', 'mpc_ajax_action' );
add_action( 'wp_ajax_nopriv`_mpc_ajax_action', 'mpc_ajax_action' );


function myplugin_activate() {  
	
	global $wpdb,$woocommerce;
	set_transient( '_mass_page_post_creator_welcome_screen', true, 30 );

}
register_activation_hook( __FILE__, 'myplugin_activate' );

function myplugin_deactivate() {
	
}

register_deactivation_hook( __FILE__, 'myplugin_deactivate' );