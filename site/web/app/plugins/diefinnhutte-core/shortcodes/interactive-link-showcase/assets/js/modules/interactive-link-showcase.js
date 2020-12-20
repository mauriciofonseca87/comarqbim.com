(function($) {
    'use strict';

    var interactiveLinkShowcase = {};
    qodef.modules.interactiveLinkShowcase = interactiveLinkShowcase;

    interactiveLinkShowcase.qodefInitInteractiveLinkShowcase = qodefInitInteractiveLinkShowcase;
    interactiveLinkShowcase.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitInteractiveLinkShowcase();
    }

    /**
     * Init item showcase shortcode
     */
    function qodefInitInteractiveLinkShowcase() {
        var interactiveLinkShowcase = $('.qodef-ils-holder');
	
	    if (interactiveLinkShowcase.length) {
		    interactiveLinkShowcase.each(function(){
			    var thisInteractiveLinkShowcase = $(this),
				    singleImage = thisInteractiveLinkShowcase.find('.qodef-ils-item-image'),
				    singleLink  = thisInteractiveLinkShowcase.find('.qodef-ils-item-link');
			    
			    singleImage.eq(0).addClass('qodef-active');
			    thisInteractiveLinkShowcase.find('.qodef-ils-item-link[data-index="0"]').addClass('qodef-active');
			
			    singleLink.children().on('touchstart mouseenter', function() {
				    var thisLink = $(this).parent(),
					    index = parseInt( thisLink.data('index'), 10 );
				
				    singleImage.removeClass('qodef-active').eq(index).addClass('qodef-active');
				    singleLink.removeClass('qodef-active');
				    thisInteractiveLinkShowcase.find('.qodef-ils-item-link[data-index="'+index+'"]').addClass('qodef-active');
			    });
		    });
	    }
    }

})(jQuery);