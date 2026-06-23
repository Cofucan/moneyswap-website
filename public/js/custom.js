!(function($) {
  "use strict";
 

  


/*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () { 
      var bg = $(this).data('setbg');
      $(this).css('background-image', 'url(' + bg + ')');
  });

  $(window).on('load', function () {
    $('#preloader-active').delay(450).fadeOut('slow');
    $('body').delay(450).css({
      'overflow': 'visible'
    });
  });


})(jQuery);