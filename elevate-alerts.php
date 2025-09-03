<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
* Plugin Name: Elevate Alerts - Attractive Notification Banners
* Plugin URI:          https://github.com/moustafa-brahimi/elevate-alerts
* Description: Create elegant, customizable notification banners with countdown timers for announcements, promotions, and important messages. Fully integrated with WordPress Customizer for easy styling and content management.
* Requires at least:   5.0
* Tested up to:        6.8
* Requires PHP:        7.4
* Version: 1.0.2
* Author: Moustafa Brahimi
* Author URI:          https://github.com/moustafa-brahimi
* Text Domain:         elevate-alerts
* Domain Path:         /languages
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define( "ELEVATE_ALERTS_URL", plugins_url("",__FILE__) );
define( "ELEVATE_ALERTS_PATH", plugin_dir_path(__FILE__) );

function elevate_alerts_enqueue_scripts() {
    wp_enqueue_style('elevate-alerts-style', plugins_url('assets/dist/css/style.css', __FILE__), array(), '1.0.0');
    wp_enqueue_script( 'elevate-alerts-script', plugins_url('assets/dist/js/bundle.js', __FILE__), array(), "1.0.0", true );

    $date = get_option( "elevate_alerts_notice_countdown_date", false );
    $time = get_option( "elevate_alerts_notice_countdown_time", false );
    $current_date = gmdate("Y-m-d H:i:s");

    $elevate_alerts_countdown = [ 
        "currentDate" => $current_date,
        "targetedDate" => "none" 
    ];

    if( $date && $time && preg_match( '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/', $time ) ):
        $elevate_alerts_countdown[ "targetedDate"] = sprintf( "%s %s", sanitize_text_field( $date ), sanitize_text_field( $time ) );
    endif;

    wp_localize_script( 'elevate-alerts-script', "elevateAlertsCountdown", $elevate_alerts_countdown);

}

add_action( 'wp_enqueue_scripts', 'elevate_alerts_enqueue_scripts' );


function elevate_alerts_admin_enqueue_scripts() {
    wp_enqueue_style('elevate-alerts-admin-style', plugins_url('assets/dist/css/admin.css', __FILE__), array(), '1.0.0');
}

add_action( 'admin_enqueue_scripts', 'elevate_alerts_admin_enqueue_scripts' );


function elevate_alerts_add_to_header() {

    include(plugin_dir_path(__FILE__) . '/template-parts/notice.php');

}

add_action('wp_footer', 'elevate_alerts_add_to_header');

// ================ Admin Notice for Kirki Recommendation =======================

/**
 * Display admin notice for Kirki plugin recommendation
 */
function elevate_alerts_admin_notice() {
    // Only show to users who can install plugins
    if (!current_user_can('install_plugins')) {
        return;
    }

    // Check if Kirki is already active
    if (class_exists('Kirki')) {
        return;
    }

    // Get the install plugin URL for Kirki
    $kirki_slug = 'kirki';
    $install_url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => 'install-plugin',
                'plugin' => $kirki_slug
            ),
            admin_url('update.php')
        ),
        'install-plugin_' . $kirki_slug
    );

    // Check if Kirki is installed but not activated
    $plugins = get_plugins();
    $kirki_installed = false;
    foreach ($plugins as $plugin_path => $plugin_data) {
        if (strpos($plugin_path, 'kirki.php') !== false || $plugin_data['Name'] === 'Kirki Customizer Framework') {
            $kirki_installed = true;
            $activate_url = wp_nonce_url(
                add_query_arg(
                    array(
                        'action' => 'activate',
                        'plugin' => urlencode($plugin_path)
                    ),
                    admin_url('plugins.php')
                ),
                'activate-plugin_' . $plugin_path
            );
            break;
        }
    }

    // Create the notice message
    if ($kirki_installed) {
        $button = '<a href="' . esc_url($activate_url) . '" class="button button-primary">' . esc_html__('Activate Kirki', 'elevate-alerts') . '</a>';
        $message = esc_html__('Elevate Alerts recommends the Kirki Customizer Framework plugin to enable all customization features.', 'elevate-alerts');
    } else {
        $button = '<a href="' . esc_url($install_url) . '" class="button button-primary">' . esc_html__('Install Kirki', 'elevate-alerts') . '</a>';
        $message = esc_html__('Elevate Alerts recommends the Kirki Customizer Framework plugin to enable all customization features.', 'elevate-alerts');
    }

    echo '<div class="notice notice-warning is-dismissible"><p>' . esc_html($message) . ' ' . wp_kses($button, array('a' => array('href' => array(), 'class' => array()))) . '</p></div>';
}

add_action('admin_notices', 'elevate_alerts_admin_notice');


// ======================= Kirki ==========================

//  ============== Customizer ================ // 
 


function elevate_alerts_customizer_controls() {
    if (class_exists("Kirki")) {
        require_once plugin_dir_path(__FILE__) . "/includes/customizer.php";
    } else {
        // Add a simple notice to the customizer when Kirki is not active
        add_action('customize_register', function($wp_customize) {
            $wp_customize->add_section('elevate_alerts_notice_section', [
                'title' => __('Elevate Alerts', 'elevate-alerts'),
                'priority' => 1,
                'description' => sprintf(
                    /* translators: %1$s: opening link tag, %2$s: closing link tag */
                    __('For enhanced customization options, we recommend installing the %1$sKirki Customizer Framework%2$s plugin.', 'elevate-alerts'),
                    '<a href="' . admin_url('plugins.php') . '">',
                    '</a>'
                ),
            ]);
        });
    }
}

add_action( 'after_setup_theme', "elevate_alerts_customizer_controls" );


// CountDown Shortcode

function elevate_alerts_countdown_shortcode_function() {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'includes/countdown.php');
    return ob_get_clean();
}

add_shortcode('elevate_alerts_countdown_shortcode', 'elevate_alerts_countdown_shortcode_function');
