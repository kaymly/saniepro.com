;(function($) {

    "use strict";

    var tfProject = function() {
        var owl_carousel = $(".wrap-project-post.owl-carousel");
        if (owl_carousel.length > 0) {
            owl_carousel.each(function() {

                var
                $this = $(this),
                prev_icon = $this.data("prev_icon"),
                next_icon = $this.data("next_icon");

                var loop = false;
                if ($this.data("loop") == 'yes') {
                    loop = true;
                }

                var arrow = false;
                if ($this.data("arrow") == 'yes') {
                    arrow = true;
                } 

                var bullets = false;
                if ($this.data("bullets") == 'yes') {
                    bullets = true;
                }

                var auto = false;
                if ($this.data("auto") == 'yes') {
                    auto = true;
                }  

                var $this = $(this),
                    $items = ($this.data('items')) ? $this.data('items') : 1,
                    $autospeed = ($this.attr('data-autospeed')) ? $this.data('autospeed') : 3500,
                    $smartspeed = ($this.attr('data-smartspeed')) ? $this.data('smartspeed') : 950,
                    $autohgt = ($this.data('autoheight')) ? $this.data('autoheight') : false,
                    $space = ($this.attr('data-space')) ? $this.data('space') : 15;

                $(this).owlCarousel({
                    loop: loop,                    
                    dots: bullets,
                    autoplayTimeout: $autospeed,
                    smartSpeed: $smartspeed,
                    autoHeight: $autohgt,
                    margin: $space,
                    nav: arrow,
                    navText : ["<i class=\""+prev_icon+"\"></i>","<i class=\""+next_icon+"\"></i>"],
                    autoplay: auto,
                    autoplayHoverPause: true,
                    items: $items,
                    responsive: {
                        0: {
                            items: ($this.data('xs-items')) ? $this.data('xs-items') : 1,
                            nav: false,
                            center: false,
                        },
                        600: {
                            items: ($this.data('sm-items')) ? $this.data('sm-items') : 2,
                            nav: false,
                            center: false,
                        },
                        1000: {
                            items: ($this.data('md-items')) ? $this.data('md-items') : 2,
                            center: false,
                        },
                        1240:{
                            items: $items
                        }
                    },
                });
            });
        }
    }

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tfproject.default', tfProject );
    });

})(jQuery);
