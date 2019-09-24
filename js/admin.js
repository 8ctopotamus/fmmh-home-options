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
    var $self = $(this);
    // params.cellId = cell.id
    params.value = value
    // // save file
    $.post(ajax_url, params, function(response) {
      $self.addClass('success')
      // console.info('Response: ', response)
      setTimeout(() => $self.removeClass('success'), 1000)
    })
    .fail(function(err) {
      $self.addClass('failed')
      console.info('Error: ', err)
      setTimeout(() => $self.removeClass('failed'), 1000)
    })
    .done(() => setLoading(false));
    return value;
  };

  $editables.editable(handleCellEdit, {
    cancel    : 'Cancel',
    submit    : 'Save',
  });
})(jQuery);