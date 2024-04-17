$(function() {
    var x = 0;
    var tabx = 0;
    var xx = 0;
    var limit = $("ul").width() - $("div").width();
    $("ul").bind('touchstart', function(e) {
      var event = e.originalEvent;
      x = event.touches[0].screenX;
      tabx = $("ul").css("transform").replace(/[^0-9\-.,]/g, '').split(',')[4];
    });
    $("ul").bind('touchmove', function(e) {
      var event = e.originalEvent;
      xx = parseInt(tabx) + parseInt(event.touches[0].screenX - x);
      $("ul").css("transform", "translate(" + xx + "px, 0px)");
      event.preventDefault();
    });
    $("ul").bind('touchend', function(e) {
      if ((xx > 0) && (tabx <= 0)) {
        $("ul").css("transform", "translate(0px, 0px)");
      }
      if (Math.abs(xx) > limit) {
        $("ul").css("transform", "translate(" + -limit + "px, 0px)");
      }
    });
  
  });