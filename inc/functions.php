<?php

// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//       echo "File is an image - " . $check["mime"] . ".";
//       $uploadOk = 1;
//   } else {
//       echo "File is not an image.";
//       $uploadOk = 0;
//   }
// }

function csv_to_postmeta() {
  // $postId = 10813;
// $metaKey = '_fmmhCustomHomeOptions';
// $metaVal = [

//   [
//     'name' => 'Siding',
//     'choices' => [
//       [
//         'name' => 'Standard Vinyl',
//         'description' => 'This is your ordinary old cheap vinyl siding',
//         'price' => 100.00,
//         'image_URL' => '/wp-content/uploads/2018/12/Manufactured-the-satisfaction-97TRU28483RH-20161130-1053488711314-1024x683.jpg',
//         'recommendedOrPrechecked' => false,
//         'length' => 56,
//         'width' => 14
//       ],
//       [
//         'name' => 'Smart Panel Siding',
//         'description' => 'Durable and beautiful, this plank siding will keep your home beautiful for years to come.',
//         'price' => 200.00,
//         'image_URL' => '/wp-content/uploads/2018/12/Manufactured-JUBILATION-42TRU28603RH-20170601-1218119073949-1080x675.jpg',
//         'recommendedOrPrechecked' => true,
//         'length' => 56,
//         'width' => 14
//       ],
//     ]
//   ],
//     [
//     'name' => 'Siding Type 2',
//     'choices' => [
//       [
//         'name' => 'Standard Vinyl',
//         'description' => 'This is your ordinary old cheap vinyl siding',
//         'price' => 100.00,
//         'image_URL' => '/wp-content/uploads/2018/12/Manufactured-the-satisfaction-97TRU28483RH-20161130-1053488711314-1024x683.jpg',
//         'recommendedOrPrechecked' => false,
//         'length' => 56,
//         'width' => 14
//       ],
//       [
//         'name' => 'Smart Panel Siding',
//         'description' => 'Durable and beautiful, this plank siding will keep your home beautiful for years to come.',
//         'price' => 200.00,
//         'image_URL' => '/wp-content/uploads/2018/12/Manufactured-JUBILATION-42TRU28603RH-20170601-1218119073949-1080x675.jpg',
//         'recommendedOrPrechecked' => true,
//         'length' => 56,
//         'width' => 14
//       ],
//     ]
//   ]
// ];


// add_post_meta($postId, $metaKey, $metaVal, false);
// update_post_meta($postId, $metaKey, $metaVal, false);
// delete_post_meta($post_id, $meta_key, $meta_value);
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