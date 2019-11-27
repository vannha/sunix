(function( $ ) {
  "use strict";
  $(document).ready(function(){
    $('.red-animate').each(function() {
      var anim_in = $(this).data('anim-in'),
          anim_out = $(this).data('anim-out');
      $(this).waypoint(function(direction) {
        if (direction === 'down') {
          // reveal our content
          $(this).addClass(anim_in);
          $(this).removeClass(anim_out);
        } else if (direction === 'up') {
          // hide our content
          $(this).addClass(anim_out);
          $(this).removeClass(anim_in);
        }
      }, { offset: '100%' });
    });
  });
})(jQuery);