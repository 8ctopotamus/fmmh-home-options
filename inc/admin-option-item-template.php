<div class="home">
  <a href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" title="<?php the_title(); ?>">
    <h3><?php the_title(); ?></h3>
  </a>
  <?php 
  $customOptions = get_post_meta(get_the_ID(), FMMH_OPTION_METAKEY, $metaVal);
  foreach($customOptions[0] as $key => $val) { ?>
    <h4><?php echo $key; ?></h4>
    <table class="widefat">
      <thead>
        <tr>
          <th>choice_name</th>
          <th>choice_description</th>
          <th>price</th>
          <th>image_url</th>
          <th>recommended</th>
          <th>length</th>
          <th>width</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($val as $option) {
          foreach ($option as $choice) {
            echo '<tr>';
            echo '<td>' .$choice["choice_name"] . '</td>';
            echo '<td>' .$choice["choice_description"] . '</td>';
            echo '<td>' .$choice["price"] . '</td>';
            echo '<td>' .$choice["image_url"] . '</td>';
            echo '<td>' .$choice["recommended"] . '</td>';
            echo '<td>' .$choice["length"] . '</td>';
            echo '<td>' .$choice["width"] . '</td>';
            echo '</tr>';
          }
        } ?>
      </tbody>
    </table>
  <?php } ?>
</div>