<?php // Silence is golden

/**
 * Start session if not
 *
 * @since    1.0.0
 */

add_action('init', 'ecommerce_tracking_session_start', 1);
function ecommerce_tracking_session_start() {
	global $woocommerce;
	if ( ! session_id() ) {
		session_start();
	}
}