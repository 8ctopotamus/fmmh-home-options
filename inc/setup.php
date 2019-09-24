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
// function tpeo_wp_admin_assets( $hook ) {
//   wp_register_style('tpeo_admin_styles', plugin_dir_url( __DIR__ ) . '/css/admin.css', false, '1.0.0');
//   wp_register_script('tpeo_admin_js', plugin_dir_url( __DIR__ ) . '/js/admin.js', '', '', true);
//   if ( $hook === 'woocommerce_page_thinkpawsitive-export-orders' ) {
//     wp_enqueue_style( 'tpeo_admin_styles' );
//     wp_enqueue_script( 'tpeo_admin_js' );
//   }
// }
// add_action( 'admin_enqueue_scripts', 'tpeo_wp_admin_assets' );