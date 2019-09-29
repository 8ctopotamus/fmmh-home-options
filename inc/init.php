<?php 

define('FMMH_OPTION_METAKEY', '_fmmhCustomHomeOptions');

/*
** Set up wp_ajax requests for frontend UI.
** NOTE: _nopriv_ makes ajaxurl work for logged out users.
*/
add_action( 'wp_ajax_fmmh_home_options_actions', 'fmmh_home_options_actions' );
// add_action( 'wp_ajax_nopriv_fmmh_home_options_actions', 'fmmh_home_options_actions' );
function fmmh_home_options_actions() {
  include( plugin_dir_path( __DIR__ ) . 'inc/actions.php' );
}

/*
 * Admin scripts and styles
 */
function fmmh_home_options_wp_admin_assets( $hook ) {
  wp_register_style('fmmh_home_options_admin_styles', plugin_dir_url( __DIR__ ) . '/css/admin.css', false, '1.0.0');
  wp_register_script('jeditable', plugin_dir_url( __DIR__ ) . '/node_modules/jquery-jeditable/dist/jquery.jeditable.min.js', array('jquery'), '', true);
  wp_register_script('fmmh_home_options_admin_js', plugin_dir_url( __DIR__ ) . '/js/admin.js', array('jquery'), '', true);

  if ( $hook === 'woocommerce_page_fmmh-home-options' ) {
    wp_enqueue_style( 'fmmh_home_options_admin_styles' );
    wp_enqueue_script( 'jeditable' );
    wp_localize_script( 'fmmh_home_options_admin_js', 'wp_data', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
    ) );
    wp_enqueue_script( 'fmmh_home_options_admin_js' );
  }
}
add_action( 'admin_enqueue_scripts', 'fmmh_home_options_wp_admin_assets' );