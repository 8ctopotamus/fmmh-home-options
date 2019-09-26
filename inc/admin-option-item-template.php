<?php $slug = get_post_field( 'post_name', get_the_ID() ); ?>

<div id="<?php echo $slug; ?>" class="home">
  <a href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" title="<?php the_title(); ?>">
    <h3><?php the_title(); ?></h3>
  </a>

  <?php $customOptions = get_post_meta(get_the_ID(), FMMH_OPTION_METAKEY, $metaVal);

  // echo '<pre>';
  // var_dump($customOptions);
  // echo '</pre>';

  ?>

  <!-- Used for updating post meta -->
  <div data-slug="<?php echo $slug; ?>" class="json-container">';
    <?php echo json_encode($customOptions); ?>
  </div>

  <?php foreach($customOptions[0] as $option => $choices) { ?>
    <h4 class="option-title"><?php echo $option; ?></h4>
    <div class="table-wrap">
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
          <?php 
            foreach ($choices as $choice) {
              $idx = 0;
              echo '<tr data-idx="' . $idx . '">';
              echo '<td class="edit">' . $choice["choice_name"] . '</td>';
              echo '<td class="edit">' . $choice["choice_description"] . '</td>';
              echo '<td class="edit">' . $choice["price"] . '</td>';
              echo '<td class="edit">' . $choice["image_url"] . '</td>';
              echo '<td class="edit">' . $choice["recommended"] . '</td>';
              echo '<td class="edit">' . $choice["length"] . '</td>';
              echo '<td class="edit">' . $choice["width"] . '</td>';
              echo '</tr>';
              $idx++;
            }
          ?>
        </tbody>
      </table>
    </div>
  <?php } ?>
</div>