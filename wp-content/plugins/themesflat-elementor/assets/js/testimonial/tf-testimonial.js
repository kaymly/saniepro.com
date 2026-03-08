;(function($) {

    "use strict";

    var testimonial_Carousel = function() {
        if ( $().owlCarousel ) {
            $('.tf-testimonial-carousel').each(function(){
                var
                $this = $(this),
                item = $this.data("column"),
                item2 = $this.data("column2"),
                item3 = $this.data("column3"),
                spacer = Number($this.data("spacer")),
                prev_icon = $this.data("prev_icon"),
                next_icon = $this.data("next_icon"),
                index_active = $this.data("index_active");

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

                $this.find('.owl-carousel').owlCarousel({
                    loop: loop,
                    margin: spacer,
                    nav: arrow,
                    dots: bullets,
                    autoplay: auto,
                    autoplayTimeout: 5000,
                    smartSpeed: 850,
                    autoplayHoverPause: true,
                    navText : ["<i class=\""+prev_icon+"\"></i>","<i class=\""+next_icon+"\"></i>"],
                    responsive: {
                        0:{
                            items:item3
                        },
                        768:{
                            items:item2
                        },
                        1000:{
                            items:item
                        }
                    }
                });
                
                indexActiveAddClasses();

                $this.find('.owl-carousel').on('translated.owl.carousel', function(event) {
                    indexActiveAddClasses();
                });
                function indexActiveAddClasses(){
                    $this.find('.owl-carousel .owl-stage .owl-item').removeClass('indexActiveItem'); 
                    $this.find('.owl-carousel .owl-stage .owl-item.active').each(function(index){                         
                        if (index === index_active) {
                            $(this).addClass('indexActiveItem');
                        }
                    });
                }             

            });
        }
    }

    var testimonialTypeGroup_Carousel = function() {
        if ( $().owlCarousel ) {
            $('.tf-testimonial-carousel-type-group.style-1').each(function(){
                var
                $this = $(this),
                spacer = Number($this.data("spacer")),
                prev_icon = $this.data("prev_icon"),
                next_icon = $this.data("next_icon");

                var arrow = false;
                if ($this.data("arrow") == 'yes') {
                    arrow = true;
                } 

                var testimonial = $this.find('.owl-carousel.testimonial');
                var thumbs = $this.find('.owl-carousel.thumbs'); 
                var syncedSecondary = true;             

                testimonial.owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 0,
                    autoplayTimeout: 5000,
                    smartSpeed: 850,
                    slideSpeed: 500,
                    nav: arrow,
                    dots: false,
                    navText : ["<i class=\""+prev_icon+"\"></i>","<i class=\""+next_icon+"\"></i>"]
                }).on("changed.owl.carousel", syncPosition);

                function syncPosition(el) {
                    //console.log(el);
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }
                    thumbs.find(".owl-item").removeClass("current").eq(current).addClass("current");
                    var onscreen = thumbs.find(".owl-item.active").length - 1;
                    //console.log(onscreen)
                    var start = thumbs.find(".owl-item.active").first().index();
                    var end = thumbs.find(".owl-item.active").last().index();
                    //console.log(end);
                    if (current > end) {
                        thumbs.data("owl.carousel").to(current, 1000, true);
                    }
                    if (current < start) {
                        thumbs.data("owl.carousel").to(current - onscreen, 1000, true);
                    }
                }

                thumbs.on("initialized.owl.carousel", function() {
                    thumbs.find(".owl-item").eq(0).addClass("current");
                }).owlCarousel({
                    items: 1,
                    margin: 0,
                    dots: false,
                    nav: false,
                    autoplayTimeout: 5000,
                    smartSpeed: 850,
                    slideSpeed: 500,
                    slideBy: 1,
                    navText : ["<i class=\""+prev_icon+"\"></i>","<i class=\""+next_icon+"\"></i>"]                    
                }).on("changed.owl.carousel", syncPosition2);

                function syncPosition2(el) {
                    if (syncedSecondary) {
                        var number = el.item.index;
                        testimonial.data("owl.carousel").to(number, 1000, true);
                    }
                }  

                thumbs.on("click", ".owl-item", function(e) {
                    e.preventDefault();
                    var number = $(this).index();
                    testimonial.data("owl.carousel").to(number, 1000, true);
                });
            });

            $('.tf-testimonial-carousel-type-group.style-2').each(function(){
                var
                $this = $(this),
                spacer = Number($this.data("spacer")),
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

                $this.find('.owl-carousel').owlCarousel({
                    loop: loop,
                    margin: spacer,
                    nav: arrow,
                    dots: bullets,
                    autoplay: auto,
                    autoplayTimeout: 5000,
                    smartSpeed: 850,
                    autoplayHoverPause: true,
                    navText : ["<i class=\""+prev_icon+"\"></i>","<i class=\""+next_icon+"\"></i>"],
                    responsive: {
                        0:{
                            items:1
                        },
                        768:{
                            items:2
                        },
                        1000:{
                            items:2
                        }
                    }
                });           

            });
        }
    }

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tf-testimonial-carousel.default', testimonial_Carousel );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tf-testimonial-carousel-type-group.default', testimonialTypeGroup_Carousel );
    });

})(jQuery);
