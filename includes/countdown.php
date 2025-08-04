<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package elevate-alerts
 */

 $date = get_option( "elevate_alerts_notice_countdown_date", false );
 $time = get_option( "elevate_alerts_notice_countdown_time", false );

 
 
 if( $date && preg_match( '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/', $time ) ):
    
    $originalTime = new DateTimeImmutable( sprintf( "%s Europe/London", gmdate("Y-m-d H:i:s") ) );
    $targedTime = new DateTimeImmutable( sprintf( "%s %s Europe/London", sanitize_text_field( $date ), sanitize_text_field( $time ) ) );
    $interval = $originalTime->diff($targedTime);
    $status = get_option( "elevate_alerts_notice_countdown_status", "0" );


    printf( 
        "<div class='elevate-alerts-countdown %s'>
            <div class='elevate-alerts-countdown__element elevate-alerts-countdown__days'><span class='value'>%d</span> <span class='unit'>%s</span> </div>
            <div class='elevate-alerts-countdown__element elevate-alerts-countdown__hours'><span class='value'>%d</span> <span class='unit'>%s</span></div>
            <div class='elevate-alerts-countdown__element elevate-alerts-countdown__minutes'><span class='value'>%d</span> <span class='unit'>%s</span></div>
            <div class='elevate-alerts-countdown__element elevate-alerts-countdown__seconds'><span class='value'>%d</span> <span class='unit'>%s</span></div>
        </div>",
        esc_attr( ! (bool) $status ? "elevate-alerts-countdown--invisible" : "" ),
        absint( $interval->days ),
        esc_html( _n( "Day", "Days", $interval->days, 'elevate-alerts' ) ),
        absint( $interval->format( "%H" ) ),
        esc_html( _n( "Hour", "Hours", $interval->h, 'elevate-alerts' ) ),
        absint( $interval->format( "%I" ) ),
        esc_html( _n( "Minute", "Minutes", $interval->i, 'elevate-alerts' ) ),
        absint( $interval->format( "%S" ) ),
        esc_html( _n( "Second", "Seconds", $interval->s, 'elevate-alerts' ) )

    );

endif;