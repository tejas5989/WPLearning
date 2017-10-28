<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       multidots.com
 * @since      1.0.0
 *
 * @package    E_Product_Feedback
 * @subpackage E_Product_Feedback/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    E_Product_Feedback
 * @subpackage E_Product_Feedback/public
 * @author     VipulUpadala <vipulupadala@gmail.com>
 */
class E_Product_Feedback_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in E_Product_Feedback_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The E_Product_Feedback_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/e-product-feedback-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'fancybox', plugin_dir_url( __FILE__ ) . 'css/fancybox.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in E_Product_Feedback_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The E_Product_Feedback_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/e-product-feedback-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'jquery-1.8.2', plugin_dir_url( __FILE__ ) . 'js/jquery-1.8.2.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'jquery.fancybox', plugin_dir_url( __FILE__ ) . 'js/jquery.fancybox.pack.js', array( 'jquery' ), $this->version, false );
		wp_register_script( 'custom-js', plugins_url( 'js/custom.js', __FILE__ ), array(), true );
		wp_localize_script( 'custom-js', 'ajaxurl', array( "ajaxparams" => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'custom-js' );
	}

}

