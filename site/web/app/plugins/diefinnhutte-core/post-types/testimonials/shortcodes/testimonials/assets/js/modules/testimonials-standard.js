(function($) {
    'use strict';

    var testimonialsStandard = {};
    qodef.modules.qodefInitTestimonialsStandard = qodefInitTestimonialsStandard;

    testimonialsStandard.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        //qodefInitTestimonialsStandard();
    }

    /**
     * Initializes testimonials standard background image logic
     */

    function qodefInitTestimonialsStandard() {
        var holders = $('.qodef-testimonials-standard');

        if(holders.length) {
            holders.each(function(){
                var thisTestimonials = $(this),
                    activeItem = thisTestimonials.find('.owl-item.active .qodef-testimonial-content'),
                    activeItemId = activeItem.attr('data-index'),
                    textItem = thisTestimonials.find('.qodef-testimonial-image[data-index="'+activeItemId+'"]');

                textItem.css({'opacity': 1, 'transform': 'translateY(0)', 'transition': 'opacity .5s,transform .6s'});
            });
        }
    }

})(jQuery);