<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
* Plugin Name: Elevate Alerts
* Plugin URI:          https://wordpress.org/plugins/elevate-alerts/
* Description: Create elegant, customizable notification banners with countdown timers for announcements, promotions, and important messages. Fully integrated with WordPress Customizer for easy styling and content management.
* Requires at least:   5.0
* Tested up to:        6.8
* Requires PHP:        7.4
* Version: 1.0.0
* Author: Moustafa Brahimi
* Author URI:          https://github.com/moustafa-brahimi
* Text Domain:         elevate-alerts
* Domain Path:         /languages
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Network: false
* Requires Plugins: kirki
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

// ================ including & configuring tgm =======================

require( plugin_dir_path( __FILE__ ) . 'includes/TGM-Plugin-Activation-2.6.1-elevate-alerts/class-tgm-plugin-activation.php' );


if( !function_exists( "elevate_alerts_register_required_plugins" ) ):

    function elevate_alerts_register_required_plugins() {

    
        $plugins = array(


            array(
                'name'      => __( 'Kirki Customizer Framework', 'elevate-alerts'),
                'slug'      => 'kirki',
                'required'  => true,
            ),


        );


        $config = array(

            'id'           => 'elevate-alerts',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'plugins.php',            // Parent menu slug.
            'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',     

        );

	    tgmpa( $plugins, $config );

    }

endif;


add_action( 'tgmpa_register', 'elevate_alerts_register_required_plugins' );


// ======================= Kirki ==========================

//  ============== Customizer ================ // 
 


function elevate_alerts_customizer_controls() {
    if( class_exists( "Kirki" ) ):
        require_once plugin_dir_path( __FILE__ ) . "/includes/customizer.php";
    endif;
}

add_action( 'after_setup_theme', "elevate_alerts_customizer_controls" );


// CountDown Shortcode

function elevate_alerts_countdown_shortcode_function() {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'includes/countdown.php');
    return ob_get_clean();
}

add_shortcode('elevate_alerts_countdown_shortcode', 'elevate_alerts_countdown_shortcode_function');
