<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$is_collapsed = false;
if ( isset( $_COOKIE['collapsed'] ) ) {
    $is_collapsed = sanitize_text_field( wp_unslash( $_COOKIE['collapsed'] ) );
    $is_collapsed = ( 'true' === $is_collapsed );
}
?>
<?php if( get_option( 'elevate_alerts_notice_status', true ) && ! $is_collapsed ): ?>

  <div class="elevate-alerts-notice" id="elevate-alerts-notice">

    <?php echo do_shortcode( "[elevate_alerts_countdown_shortcode]" ); ?>
    
    <div class="elevate-alerts-notice__content"> 

      <?php if( get_option( "elevate_alerts_notice_content" ) ): ?>
        <?php echo wp_kses_post( get_option( "elevate_alerts_notice_content" ) ); ?>

      <?php else: ?>
        
        <p class="elevate-alerts-notice__content">
          <?php echo esc_html( __( 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'elevate-alerts' ) ); ?>          
        </p>

      <?php endif; ?>

    </div> 

      <?php $status = get_option( "elevate_alerts_notice_button_status", false ); ?>
      <?php $text = get_option( "elevate_alerts_notice_button_text", __( "Buy Now", 'elevate-alerts' ) ); ?>
      <?php $open_in_new_tab = get_option( "elevate_alerts_button_url_target", false ); ?> 

      <a 
        class="elevate-alerts-notice__link <?php echo esc_attr( ! (bool) $status ? "elevate-alerts-notice__link--invisible": "" ); ?>"
        href="<?php echo esc_url( get_option("elevate_alerts_button_url", "#") ); ?>"
        target="<?php echo esc_attr( $open_in_new_tab ? "_blank" : "_self" ) ?>"

      ><?php echo esc_html( $text ); ?></a>


    <button class="elevate-alerts-notice__close btn-close-notice" title="<?php esc_attr_e( "Collapse the notice", 'elevate-alerts' ); ?>">

      <i class="icon fa-solid fa-xmark"></i>

    </button>

  </div>

<?php endif; ?>
