<?php

function ajax_update_postmetadata() {
  if ( isset($_POST['data']) ) {
    $post_id = $_POST['post_id'];
    update_post_meta( $post_id, FMMH_OPTION_METAKEY, $_POST['data'][0] );
    http_response_code(200);
  } else {
    echo 'no data sent';
    http_response_code(500);
  }
}

function get_post_id_by_slug( $slug, $post_type = "post" ) {
  $query = new WP_Query( [
    'name' => $slug,
    'post_type' => $post_type,
    'numberposts' => 1,
    'fields'      => 'ids',
  ] );
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
  foreach($data as $key => $val) {
    $id = get_post_id_by_slug($key, 'product');
    add_post_meta($id, FMMH_OPTION_METAKEY, $val, false);
  }
}

function parse_csv($fileHandle) {
  $headers = [];
  $result = [];
  $count = 0;
  while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
    if ($count > 0) {
      $slug = $row[0];
      if (!$slug) continue;
      $option = $row[1];
      $choice = [];
      for ($i = 2; $i < count($headers); $i++) {
        if ( isset($row[$i]) ) {
          if ($headers[$i] === 'price' && $row[$i] === '') {
            $choice[$headers[$i]] = "Please call for pricing.";
            continue;
          } 
          $choice[$headers[$i]] = $row[$i];
        }
      }
      if (!isset($result[$slug][$option])) {
        $result[$slug][$option] = [];
      }
      $result[$slug][$option][] = $choice;
    } else {
      $headers = $row;
    }
    $count++;
  }

  var_dump($result);

  return $result;
}

function upload_csv() {
  if ( isset($_POST["submit"]) && $_FILES['csv_file']['size'] > 0 ) {
    $csv = $_FILES['csv_file']['tmp_name'];
    $fileHandle = fopen($csv, "r");
    $formattedCSVData = parse_csv($fileHandle);
    delete_all_custom_postmeta(); // out with the old...
    save_custom_postmeta($formattedCSVData); //...in with the new
  } else {
    echo 'No CSV provided.';
    http_response_code(500);
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;
}

// NOTE: use this to see the CSV data
// function render_CSV_table($filepath) {
//   $fileHandle = fopen($filepath, "r");
//   $html = '<table>';
//   while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
//     $html .= '<tr>';
//     foreach ($row as $col ) {
//       $html .= '<td>';
//       $html .= $col;
//       $html .= '</td>';      
//     }
//     $html .= '</tr>';
//   }
//   $html .= '<table>';
//   return $html;
// }


