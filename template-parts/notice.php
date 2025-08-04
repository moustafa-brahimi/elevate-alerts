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

      <?php if( get_option( 'elevate_alerts_notice_icon_status' ) ): ?>
                
        <?php $icon = get_option( "elevate_alerts_icon", "" ); ?>

        <?php if( $icon ): ?>
          
          <?php 
          $icon_path = ELEVATE_ALERTS_PATH . "assets/img/icons/" . sanitize_file_name( $icon ) . ".svg";
          
          // Security check: ensure the file exists and is within the expected directory
          if ( file_exists( $icon_path ) && strpos( realpath( $icon_path ), realpath( ELEVATE_ALERTS_PATH . "assets/img/icons/" ) ) === 0 ) {
              $svg_content = file_get_contents( $icon_path );
              // Add CSS class to the SVG for styling
              $svg_content = str_replace( '<svg', '<svg class="elevate-alerts-notice__icon"', $svg_content );
              echo wp_kses( $svg_content, array(
                  'svg' => array(
                      'class' => array(),
                      'aria-hidden' => array(),
                      'aria-labelledby' => array(),
                      'role' => array(),
                      'xmlns' => array(),
                      'width' => array(),
                      'height' => array(),
                      'viewbox' => array(),
                      'viewBox' => array(),
                      'fill' => array(),
                      'stroke' => array(),
                      'stroke-width' => array(),
                      'stroke-linecap' => array(),
                      'stroke-linejoin' => array(),
                  ),
                  'g' => array( 'fill' => array(), 'stroke' => array() ),
                  'title' => array( 'title' => array() ),
                  'path' => array( 
                      'd' => array(), 
                      'fill' => array(), 
                      'stroke' => array(),
                      'stroke-width' => array(),
                      'stroke-linecap' => array(),
                      'stroke-linejoin' => array(),
                  ),
                  'circle' => array(
                      'cx' => array(),
                      'cy' => array(),
                      'r' => array(),
                      'fill' => array(),
                      'stroke' => array(),
                      'stroke-width' => array(),
                  ),
                  'rect' => array(
                      'x' => array(),
                      'y' => array(),
                      'width' => array(),
                      'height' => array(),
                      'fill' => array(),
                      'stroke' => array(),
                      'stroke-width' => array(),
                  ),
                  'line' => array(
                      'x1' => array(),
                      'y1' => array(),
                      'x2' => array(),
                      'y2' => array(),
                      'stroke' => array(),
                      'stroke-width' => array(),
                  ),
              ) );
          }
          ?>
        
        <?php endif; ?>
      <?php endif; ?>

      <?php if( get_option( "elevate_alerts_notice_content" ) ): ?>
        <?php echo wp_kses_post( get_option( "elevate_alerts_notice_content" ) ); ?>

      <?php else: ?>
        
        <p class="elevate-alerts-notice__content">
          <?php echo esc_html( __( 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'elevate-alerts' ) ); ?>          
        </p>

      <?php endif; ?>

    </div> 

      <?php $status = get_option( "elevate_alerts_notice_button_status", "0" ); ?>
      <?php $text = get_option( "elevate_alerts_notice_button_text", __( "Buy Now", 'elevate-alerts' ) ); ?>
      <?php $open_in_new_tab = get_option( "elevate_alerts_button_url_target", false ); ?> 

      <a 
        class="elevate-alerts-notice__link <?php echo esc_attr( !$status ? "elevate-alerts-notice__link--invisible": "" ); ?>"
        href="<?php echo esc_url( get_option("elevate_alerts_button_url", "#") ); ?>"
        target="<?php echo esc_attr( $open_in_new_tab ? "_blank" : "_self" ) ?>"

      ><?php echo esc_html( $text ); ?></a>


    <button class="elevate-alerts-notice__close btn-close-notice" title="<?php esc_attr_e( "Collapse the notice", 'elevate-alerts' ); ?>">

      <i class="icon fa-solid fa-xmark"></i>

    </button>

  </div>

<?php endif; ?>
