(function($) {
    'use strict';

    var iconWithText = {};
    qodef.modules.iconWithText = iconWithText;

    iconWithText.qodefInitIconWithText = qodefInitIconWithText;


    iconWithText.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitIconWithText()
    }

    /**
     * Inti icon with text shortcode on appear
     */
    function qodefInitIconWithText() {
        var holder = $('.qodef-iwt');

        if(holder.length) {
            holder.each(function(){
                var thisHolder = $(this);

                thisHolder.find('.qodef-iwt-icon a').on('mouseenter', function () {
                    thisHolder.addClass('qodef-iwt-icon-hover');
                }).on('mouseleave', function () {
                    thisHolder.removeClass('qodef-iwt-icon-hover');
                })
            });
        }
    }
})(jQuery);