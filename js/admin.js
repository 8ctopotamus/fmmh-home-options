(function($) {
  $('.edit').editable('http://www.example.com/save.php', {
    indicator : 'Saving...',
    tooltip   : 'Click to edit...',
    cancel    : 'Cancel',
    submit    : 'Save',
  });
})(jQuery)