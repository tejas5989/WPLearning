<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       multidots.com
 * @since      1.0.0
 *
 * @package    E_Product_Feedback
 * @subpackage E_Product_Feedback/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    E_Product_Feedback
 * @subpackage E_Product_Feedback/includes
 * @author     VipulUpadala <vipulupadala@gmail.com>
 */
class E_Product_Feedback_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'e-product-feedback',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}


}
