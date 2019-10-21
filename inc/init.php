<?php 

define('FMMH_OPTION_METAKEY', '_fmmhCustomHomeOptions');

add_action( 'rest_api_init', 'create_api_posts_meta_field' );
function create_api_posts_meta_field() {
 // register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
  register_rest_field( 'product', FMMH_OPTION_METAKEY, array(
    'get_callback' => 'get_post_meta_for_api',
    'show_in_rest' => true
  ));
}

function get_post_meta_for_api( $object ) {
 $post_id = $object['id'];
 return get_post_meta( $post_id );
}

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