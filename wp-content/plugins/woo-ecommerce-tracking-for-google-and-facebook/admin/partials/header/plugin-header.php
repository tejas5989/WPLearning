<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
$plugin_name = WSFL_PLUGIN_NAME;
$plugin_version = WSFL_PLUGIN_VERSION;
?>
<div id="dotsstoremain">
    <div class="all-pad">
        <header class="dots-header">
            <div class="dots-logo-main">
                <img  src="<?php echo esc_attr ( WSFL_PLUGIN_URL . '/admin/images/WSFL.png' ); ?>">
            </div>
            <div class="dots-header-right">
                <div class="logo-detail">
                    <strong><?php echo esc_attr( $plugin_name ); ?></strong>
                    <span>Free Version <?php echo esc_attr( $plugin_version ); ?></span>
                </div>
                <div class="button-dots">
                    <span class="support_dotstore_image"><a href="https://store.multidots.com/woocommerce-enhanced-ecommerce-analytics-integration-with-conversion-tracking" target="_blank"><img  src="<?php echo esc_attr( site_url('wp-content/plugins/woo-ecommerce-tracking-for-google-and-facebook/admin/images/upgrade_new.png') ); ?>"> </a></span>
                    <span class="support_dotstore_image"><a  target="_blank" href="https://store.multidots.com/dotstore-support-panel/" > <img   src="<?php echo esc_attr( site_url('wp-content/plugins/woo-ecommerce-tracking-for-google-and-facebook/admin/images/support_new.png') ); ?>"></a></span>
                </div>
            </div>
            <?php
            $site_url = "admin.php?page=woo-ecommerce-tracking-for-google-and-facebook&tab=";

            $get_val_tab = ($name = filter_input(INPUT_GET, 'tab')) ? $name : '';


            if ( !empty($get_val_tab) && 'premiuam_version' === $get_val_tab  ) {
                $premiuam_version = "active";
            } else {
                $premiuam_version = "";
            }
            if (!empty( $get_val_tab ) && 'wc_tracking_for_google_and_facebook' === $get_val_tab ) {
                $wc_tracking_for_google_and_facebook = "active";
            } else {
                $wc_tracking_for_google_and_facebook = "";
            }
            if (!empty($get_val_tab) && 'premium_wc_tracking_for_google_and_facebook' === $get_val_tab ) {
                $premium_wc_tracking_for_google_and_facebook = "active";
            } else {
                $premium_wc_tracking_for_google_and_facebook = "";
            }
            if (!empty($get_val_tab)  && 'wc_tracking_for_google_and_facebook_get_started_method' === $get_val_tab ) {
                $wc_tracking_for_google_and_facebook_get_started_method = "active";
            } else {
                $wc_tracking_for_google_and_facebook_get_started_method = "";
            }
            if (!empty($get_val_tab) && 'introduction_ecommerce_analytics' === $get_val_tab ) {
                $introduction_ecommerce_analytics = "active";
            } else {
                $introduction_ecommerce_analytics = "";
            }
            ?>
            <div class="dots-menu-main">
                <nav>
                    <ul>
                        <li>
                            <a class="dotstore_plugin <?php echo esc_attr( $wc_tracking_for_google_and_facebook ); ?>"  href="<?php echo esc_url( $site_url . 'wc_tracking_for_google_and_facebook' ); ?>">Ecommerce Tracking Settings</a>
                        </li>

                        <li>
                            <a class="dotstore_plugin <?php echo esc_attr( $premium_wc_tracking_for_google_and_facebook ); ?>"  href="<?php echo esc_url( $site_url . 'premium_wc_tracking_for_google_and_facebook' ); ?>">Premium Version</a>
                        </li>

                        <li>
                            <a class="dotstore_plugin <?php echo esc_attr( $wc_tracking_for_google_and_facebook_get_started_method ); ?> <?php echo esc_attr( $introduction_ecommerce_analytics ); ?>"  href="<?php echo esc_url( $site_url . 'wc_tracking_for_google_and_facebook_get_started_method' ); ?>">About Plugin</a>
                            <ul class="sub-menu">
                                <li><a  class="dotstore_plugin <?php echo esc_attr( $wc_tracking_for_google_and_facebook_get_started_method ); ?>"  href="<?php echo esc_url( $site_url . 'wc_tracking_for_google_and_facebook_get_started_method' ); ?>">Getting Started</a></li>
                                <li><a class="dotstore_plugin <?php echo esc_attr( $introduction_ecommerce_analytics ); ?>" href="<?php echo esc_url( $site_url . 'introduction_ecommerce_analytics' ); ?>">Quick info</a></li>
                                <li><a  target="_blank" href="https://store.multidots.com/suggest-a-feature/">Suggest A Feature</a></li>
                            </ul>
                        </li>

                        <li>
                            <a class="dotstore_plugin <?php // echo $wc_lite_extra_shipping_dotstore_contact_support_method;           ?>"  href="#">Dotstore</a>
                            <ul class="sub-menu">
                                <li><a target="_blank" href="https://store.multidots.com/go/Flatrate-newui-woocommerce-Plugins">WooCommerce Plugins</a></li>
                                <li><a target="_blank" href="https://store.multidots.com/go/flatrate-newui-Wordpress-Plugins">Wordpress Plugins</a></li><br>
                                <li><a target="_blank" href="https://store.multidots.com/go/flatrate-newui-Wordpress-Plugins">Free Plugins</a></li>
                                <li><a target="_blank" href="https://store.multidots.com/go/flatrate-newui-theme">Free Themes</a></li>
                                <li><a target="_blank" href="https://store.multidots.com/dotstore-support-panel/">Contact Support</a></li>
                            </ul>
                        </li>

                    </ul>

                    </li>

                </nav>
            </div>
        </header>