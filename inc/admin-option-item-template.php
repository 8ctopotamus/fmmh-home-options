<?php

$customOptions = get_post_meta($postId, FMMH_OPTION_METAKEY, $metaVal);

?>

<hr/>

<a href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" title="<?php the_title(); ?>">
  <h3><?php the_title(); ?></h3>
</a>

<table class="widefat">
  <tbody>
    <?php
      // foreach($customOptions as $option) {
        // echo '<tr>';
        // echo '<td><h5>' . $option['name'] . '</h5></td>';
        // echo '</tr>';
        // echo '<tr>';
        // foreach ($option['choices'] as $choice) {
        //   echo '<td>' . $choice['name'] . '</td>';
        //   echo '<td>' . $choice['description'] . '</td>';
        //   echo '<td>' . $choice['price'] . '</td>';
        // }
        // echo '</tr>';
      // }
      var_dump($customOptions);  
    ?>
  </tbody>
</table>


<hr/>
