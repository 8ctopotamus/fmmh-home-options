<?php

function ajax_update_postmetadata() {
  echo 'Yoyoyo';
}

function get_post_id_by_slug( $slug, $post_type = "post" ) {
  $query = new WP_Query(
  array(
    'name'   => $slug,
    'post_type'   => $post_type,
    'numberposts' => 1,
    'fields'      => 'ids',
  ) );
  $posts = $query->get_posts();
  return array_shift( $posts );
}

function delete_all_custom_postmeta() {
  $args = [
    'post_type' => 'product',
    'posts_per_page' => -1,
  ];
  $the_query = new WP_Query( $args );
  if ( $the_query->have_posts() ):
    while ( $the_query->have_posts() ): $the_query->the_post();
      delete_post_meta(get_the_ID(), FMMH_OPTION_METAKEY);
    endwhile;
  endif;
}

function save_custom_postmeta($data) {
  delete_all_custom_postmeta();
  // Add the new data
  foreach($data as $key => $val) {
    $id = get_post_id_by_slug($key, 'product');

    var_dump($val);

    add_post_meta($id, FMMH_OPTION_METAKEY, $val, false);
  }
}

function parse_csv($fileHandle) {
  $data = [];
  $count = 0;
  while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
    // skip headers row
    if ($count > 0) {
      $slug = $row[0];
      $option = $row[1];
      $choice = [
        'choice_name' => $row[2],
        'choice_description' => $row[3],
        'price' => $row[4],
        'image_url' => $row[5],
        'recommended' => $row[6],
        'length' => $row[7],
        'width' => $row[8],
      ];
      if (!isset($data[$slug][$option])) {
        $data[$slug][$option] = [
          'choices' => []
        ];
      }
      $data[$slug][$option]['choices'][] = $choice;
    }
    $count++;
  }
  return $data;
}

function upload_csv() {
  if( isset($_POST["submit"]) && $_FILES['csv_file']['size'] > 0 ) {
    $csv = $_FILES['csv_file']['tmp_name'];
    $fileHandle = fopen($csv, "r");
    $formattedCSVData = parse_csv($fileHandle);
    save_custom_postmeta($formattedCSVData);
  } else {
    echo 'Server error.';
    http_response_code(500);
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;  
}

function render_CSV_table($filepath) {
  $fileHandle = fopen($filepath, "r");
  $html = '<table>';
  while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
    $html .= '<tr>';
    foreach ($row as $col ) {
      $html .= '<td>';
      $html .= $col;
      $html .= '</td>';      
    }
    $html .= '</tr>';
  }
  $html .= '<table>';
  return $html;
}


