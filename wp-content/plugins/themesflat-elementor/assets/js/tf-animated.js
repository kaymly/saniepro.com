(function( $ ) {
    "use strict";

    var themesflat_animation_fadeup = function (container, item) {
        $(window).scroll(function () {
            var windowBottom = $(this).scrollTop() + $(this).innerHeight();
            $(container).each(function (index, value) {
                var objectBottom = $(this).offset().top + $(this).outerHeight() * 0.1;
                
                if (objectBottom < windowBottom) { 
                    var seat = $(this).find(item);
                    for (var i = 0; i < seat.length; i++) {
                        (function (index) {
                            setTimeout(function () {
                                seat.eq(index).addClass('tfanimated');
                            }, 300 * index);
                        })(i);
                    }
                }
            });
        }).scroll();
    };
    var themesflat_animation_classes = function () {
        themesflat_animation_fadeup(".wrap-services-post", ".item");
        themesflat_animation_fadeup(".tf-posts", ".item");
        themesflat_animation_fadeup(".wrap-doctor-post", ".item");
        themesflat_animation_fadeup(".wrap-portfolios-post", ".item");        
        themesflat_animation_fadeup(".tf-animated", ".item-animated");
        themesflat_animation_fadeup("section", ".item-animated");
        themesflat_animation_fadeup(".tf-animated-twocolumn", ".item-animated");
        themesflat_animation_fadeup(".tf-animated-column-elementor", ".elementor-column");
        themesflat_animation_fadeup(".tf-animated-image-elementor", ".elementor-widget-container");
    };

    var themesflat_animation_mousemove = function (container, element) {
        $(container).mousemove(function(e){
            var amountMovedX = (e.pageX * 0.3 / 20);
            var amountMovedY = (e.pageY * 0.1 / 20);
            $(this).find(element).css({
              '-webkit-transform' : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
              '-moz-transform'    : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
              '-ms-transform'     : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
              '-o-transform'      : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
              'transform'         : 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)'
            });
        });
    };
    var themesflat_animation_mousemove_classes = function () {
        themesflat_animation_mousemove(".elementor-widget-wrap",".animated-hover");
        themesflat_animation_mousemove(".animated-hover",".bg-last");
    };

    $(function() {
        themesflat_animation_classes();
        themesflat_animation_mousemove_classes();
    });

})(jQuery);