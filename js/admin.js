(function($) {
  const { ajax_url } = wp_data;
  const $editables = $('.edit');
  const $loading = $('#loading');

  const setLoading = bool => bool ? $loading.show() : $loading.hide();

  const params = {
    "action": "fmmh_home_options_actions",
    "do": "ajax_update_postmetadata"
  };

  function handleCellEdit(value, settings) {
    setLoading(true);    
    const $self = $(this);
    const idx = $self.parent().data('idx');
    const propName = $self.data('column');
    const option = $self.closest('.table-wrap').prev('.option-title').text();
    const $home = $self.closest('.home');
    const id = $home.attr('id');
    const $jsonContainer = $home.find('.json-container');
    const optionsJson = JSON.parse($jsonContainer.text());

    optionsJson[0][option][idx][propName] = value;
    params.data = optionsJson;
    params.post_id = id;

    $.post(ajax_url, params, function(response) {
      $self.addClass('success');
      $jsonContainer.text(JSON.stringify(optionsJson));
      setTimeout(() => $self.removeClass('success'), 1000);
    })
    .fail(function(err) {
      $self.addClass('failed');
      console.info('Error: ', err);
      setTimeout(() => $self.removeClass('failed'), 1000);
    })
    .done(() => setLoading(false));

    return value;
  };

  $editables.editable(handleCellEdit, {
    cancel    : 'Cancel',
    submit    : 'Save',
  });

})(jQuery);