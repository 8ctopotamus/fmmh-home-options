<?php

add_action('admin_menu', 'fmmh_home_options_admin');

function fmmh_home_options_admin() {
  add_submenu_page(
    'woocommerce',
    'FMMH Custom Home Options',
    'FMMH Custom Home Options',
    'manage_options',
    'fmmh-home-options',
    'fmmh_home_options_admin_html'
  );
}

function fmmh_home_options_admin_html() {
  if ( !current_user_can('manage_options') ) {
    return;
  }
  
  if ( isset($_GET['error']) ){
    echo '<p class="notice notice-error">' . $_GET['error'] . '</p>';
  }
  
  ?>    
    <div class="wrap">
      <div>
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

      <form action="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="fmmh_home_options_actions" />
        <input type="hidden" name="do" value="upload_csv" />
        <input type="hidden" name="redirect" value='admin.php?page=fmmh-home-options' />        
        <label for="csv_file">Select CSV to upload:</label>
        <input type="file" name="csv_file" id="csv_file">
        <input type="submit" value="Upload CSV" name="submit" class="button button-primary">
      </form>
      </div>

      <p id="loading">Loading...</p>

      <?php
        $args = [
          'post_type' => 'product',
          'posts_per_page' => -1,
          'meta_query' => [
            'meta_query' => array(
              array(
                'key' => FMMH_OPTION_METAKEY,
                'compare' => 'EXISTS',
              )
            ) 
          ]
        ];
        $search_query = new WP_Query( $args );
        if ( $search_query->have_posts() ):
          while ( $search_query->have_posts() ) {
            $search_query->the_post();
            include 'admin-option-item-template.php';
          }
          wp_reset_postdata(); 
        else:
          echo  '<p>No home options found.</p>';
        endif; 
      ?>
    </div> <!-- /.wrap -->
  <?php 
}