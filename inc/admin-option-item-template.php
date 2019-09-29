<?php $slug = get_post_field( 'post_name', get_the_ID() ); ?>

<div id="<?php the_ID(); ?>" class="home" data-slug="<?php echo $slug; ?>">
  <a href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" title="<?php the_title(); ?>">
    <h3><?php the_title(); ?></h3>
  </a>

  <?php $customOptions = get_post_meta(get_the_ID(), FMMH_OPTION_METAKEY, $metaVal); ?>

  <!-- Used for updating post meta -->
  <div data-slug="<?php echo $slug; ?>" class="json-container">
    <?php echo json_encode($customOptions); ?>
  </div>

  <?php foreach($customOptions[0] as $option => $choices) { ?>
    <h4 class="option-title"><?php echo $option; ?></h4>
    <div class="table-wrap">
      <table class="widefat">
        <tbody>
          <?php 
            $idx = 0;
            foreach ($choices as $choice) {
              $keys = array_keys($choice);
              if ( $idx === 0 ) { ?>
                <thead>
                  <tr>
                    <?php 
                      foreach($keys as $key) {
                        echo '<th>' . $key . '</th>';
                      } 
                    ?>
                  </tr>
                </thead>
              <?php }

              echo '<tr data-idx="' . $idx . '">';
              $vals = array_values($choice);
              $choiceIdx = 0;
              foreach($vals as $val) {
                echo '<td class="edit" data-column="' . $keys[$choiceIdx] . '">' . $val . '</td>';
                $choiceIdx++;
              } 
              echo '</tr>';

              // echo '<tr data-idx="' . $idx . '">';
              //   echo '<td class="edit" data-column="choice_name">' . $choice["choice_name"] . '</td>';
              //   echo '<td class="edit" data-column="choice_description">' . $choice["choice_description"] . '</td>';
              //   echo '<td class="edit" data-column="price">' . $choice["price"] . '</td>';
              //   echo '<td class="edit" data-column="image_url">' . $choice["image_url"] . '</td>';
              //   echo '<td class="edit" data-column="recommended">' . $choice["recommended"] . '</td>';
              //   echo '<td class="edit" data-column="length">' . $choice["length"] . '</td>';
              //   echo '<td class="edit" data-column="width">' . $choice["width"] . '</td>';
              // echo '</tr>';
              $idx++;
            }
          ?>
        </tbody>
      </table>
    </div>
  <?php } ?>
</div>