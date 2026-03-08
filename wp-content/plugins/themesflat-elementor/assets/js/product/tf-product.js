;(function($) {

    "use strict";

    /*var testimonial_Carousel = function() {
        if ( $().owlCarousel ) {
            $('.tf-products.has-carousel').each(function(){
                var
                $this = $(this),
                item = $this.data("column"),
                item2 = $this.data("column2"),
                item3 = $this.data("column3"),
                row = $this.data("row"),
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

                var el = $this.find('.owl-carousel');
                var carousel;
                var carouselOptions = {
                    loop: loop,
                    margin: spacer,
                    nav: arrow,
                    dots: bullets,
                    autoplay: auto,
                    autoplayTimeout: 5000,
                    smartSpeed: 850,
                    autoplayHoverPause: true,
                    navText : ["<i class=\""+prev_icon+"\"></i>","<i class=\""+next_icon+"\"></i>"],
                    slideBy: 'page',
                    responsive: {
                        0: {
                            items:item3,
                            rows: row //custom option not used by Owl Carousel, but used by the algorithm below
                        },
                        768: {
                            items:item2,
                            rows: row //custom option not used by Owl Carousel, but used by the algorithm below
                        },
                        991: {
                            items:item,
                            rows: row //custom option not used by Owl Carousel, but used by the algorithm below
                        }
                    }
                };

                //Taken from Owl Carousel so we calculate width the same way
                var viewport = function() {
                    var width;
                    if (carouselOptions.responsiveBaseElement && carouselOptions.responsiveBaseElement !== window) {
                        width = $(carouselOptions.responsiveBaseElement).width();
                    } else if (window.innerWidth) {
                        width = window.innerWidth;
                    } else if (document.documentElement && document.documentElement.clientWidth) {
                        width = document.documentElement.clientWidth;
                    } else {
                        console.warn('Can not detect viewport width.');
                    }
                    return width;
                };

                var severalRows = false;
                var orderedBreakpoints = [];
                for (var breakpoint in carouselOptions.responsive) {
                    if (carouselOptions.responsive[breakpoint].rows > 1) {
                        severalRows = true;
                    }
                    orderedBreakpoints.push(parseInt(breakpoint));
                }

                //Custom logic is active if carousel is set up to have more than one row for some given window width
                if (severalRows) {
                    orderedBreakpoints.sort(function(a, b) {
                        return b - a;
                    });
                    var slides = el.find('[data-slide-index]');
                    var slidesNb = slides.length;
                    if (slidesNb > 0) {
                        var rowsNb;
                        var previousRowsNb = undefined;
                        var colsNb;
                        var previousColsNb = undefined;

                        //Calculates number of rows and cols based on current window width
                        var updateRowsColsNb = function() {
                            var width = viewport();
                            for (var i = 0; i < orderedBreakpoints.length; i++) {
                                var breakpoint = orderedBreakpoints[i];
                                if (width >= breakpoint || i == (orderedBreakpoints.length - 1)) {
                                    var breakpointSettings = carouselOptions.responsive['' + breakpoint];
                                    rowsNb = breakpointSettings.rows;
                                    colsNb = breakpointSettings.items;
                                    break;
                                }
                            }
                        };

                        var updateCarousel = function() {
                            updateRowsColsNb();

                            //Carousel is recalculated if and only if a change in number of columns/rows is requested
                            if (rowsNb != previousRowsNb || colsNb != previousColsNb) {
                                var reInit = false;
                                if (carousel) {
                                    //Destroy existing carousel if any, and set html markup back to its initial state
                                    carousel.trigger('destroy.owl.carousel');
                                    carousel = undefined;
                                    slides = el.find('[data-slide-index]').detach().appendTo(el);
                                    el.find('.fake-col-wrapper').remove();
                                    reInit = true;
                                }


                                //This is the only real 'smart' part of the algorithm

                                //First calculate the number of needed columns for the whole carousel
                                var perPage = rowsNb * colsNb;
                                var pageIndex = Math.floor(slidesNb / perPage);
                                var fakeColsNb = pageIndex * colsNb + (slidesNb >= (pageIndex * perPage + colsNb) ? colsNb : (slidesNb % colsNb));

                                //Then populate with needed html markup
                                var count = 0;
                                for (var i = 0; i < fakeColsNb; i++) {
                                    //For each column, create a new wrapper div
                                    var fakeCol = $('<div class="fake-col-wrapper"></div>').appendTo(el);
                                    for (var j = 0; j < rowsNb; j++) {
                                        //For each row in said column, calculate which slide should be present
                                        var index = Math.floor(count / perPage) * perPage + (i % colsNb) + j * colsNb;
                                        if (index < slidesNb) {
                                            //If said slide exists, move it under wrapper div
                                            slides.filter('[data-slide-index=' + index + ']').detach().appendTo(fakeCol);
                                        }
                                        count++;
                                    }
                                }
                                //end of 'smart' part

                                previousRowsNb = rowsNb;
                                previousColsNb = colsNb;

                                if (reInit) {
                                    //re-init carousel with new markup
                                    carousel = el.owlCarousel(carouselOptions);
                                }
                            }
                        };

                        //Trigger possible update when window size changes
                        $(window).on('resize', updateCarousel);

                        //We need to execute the algorithm once before first init in any case
                        updateCarousel();
                    }
                }

                //init
                carousel = el.owlCarousel(carouselOptions);

            });
        }
    }*/

    var testimonial_Carousel = function() {
        if ( $().owlCarousel ) {
            $('.tf-products.has-carousel').each(function(){
                var
                $this = $(this),
                item = $this.data("column"),
                item2 = $this.data("column2"),
                item3 = $this.data("column3"),
                row = $this.data("row"),
                spacer = Number($this.data("spacer")),
                prev_icon = $this.data("prev_icon"),
                next_icon = $this.data("next_icon");

                var loop = false;
                if ($this.data("loop") == 'yes') {
                    loop = true;
                }

                var auto = false;
                if ($this.data("auto") == 'yes') {
                    auto = true;
                } 

                var arrow = false;
                if ($this.data("arrow") == 'yes') {
                    arrow = true;
                } 

                var bullets = false;
                if ($this.data("bullets") == 'yes') {
                    bullets = true;
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

            });
        }
    }

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tf-woo-products.default', testimonial_Carousel );
    });

})(jQuery);
