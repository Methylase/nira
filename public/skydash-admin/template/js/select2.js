(function($) {
  'use strict';

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }

  if ($(".amenities").length) {
    $(".amenities").select2({
      multiple: true,
      placeholder: "Select amenities",
      allowClear: true
    });
  }
})(jQuery);