<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       multidots.com
 * @since      1.0.0
 *
 * @package    E_Product_Feedback
 * @subpackage E_Product_Feedback/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    E_Product_Feedback
 * @subpackage E_Product_Feedback/admin
 * @author     VipulUpadala <vipulupadala@gmail.com>
 */
class E_Product_Feedback_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
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
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/e-product-feedback-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
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
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/e-product-feedback-admin.js', array('jquery'), $this->version, false);
        wp_register_script('custom-js2', plugins_url('js/second_custome.js', __FILE__), array(), true);
        wp_localize_script('custom-js2', 'ajaxurl2', array("ajaxparams2" => admin_url('admin-ajax.php')));
        wp_enqueue_script('custom-js2');
    }

}

require plugin_dir_path( __FILE__ ) .'partials/functionality_adminside.php';

