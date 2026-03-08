;(function($) {

    "use strict";

    var tf_accordion = function() {
        $('.tf-accordion').each(function () {
            var args = {duration: 600};
            $(this).find('.accordion-content').hide();
            $(this).find('.tf-accordion-item .accordion-title.active').siblings('.accordion-content').show();
        
            $('.tf-accordion .accordion-title').on('click', function () {
                $('.tf-accordion .tf-accordion-item').removeClass('active');
                $(this).closest('.tf-accordion-item').toggleClass('active');

                if( !$(this).is('.active') ) {
                    $(this).closest('.tf-accordion').find('.accordion-title.active').toggleClass('active').next().slideToggle(args);
                    $(this).toggleClass('active');
                    $(this).next().slideToggle(args);
                } else {
                    $(this).toggleClass('active');
                    $(this).next().slideToggle(args);
                    $('.tf-accordion .tf-accordion-item').removeClass('active');
                }     
            });
        });
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tfaccordion.default', tf_accordion );
    });

})(jQuery);