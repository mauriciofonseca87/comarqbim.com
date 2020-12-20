(function($) {
    'use strict';

    var stamp = {};
    qodef.modules.stamp = stamp;

    stamp.qodefInitProcess = qodefInitStamp;


    stamp.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitStamp()
    }

    /**
     * Inti stamp shortcode on appear
     */
    function qodefInitStamp() {
        var holder = $('.qodef-stamp-holder');

        if(holder.length) {
            holder.each(function(){
                var thisHolder = $(this),
                    appearingDelay = thisHolder.data('appearing-delay'),
                    stamp = thisHolder.children('.qodef-s-text'),
                    count = parseInt(stamp.data('count'), 10);

                stamp.children().each(function(i){
                    var transform = -90 + i * 270 / count,
                        transitionDelay = i * 60 / count * 10;

                    $(this).css({'transform': 'rotate(' + transform + 'deg)', 'transition-delay': transitionDelay + 'ms'});
                });

                if (thisHolder.hasClass('qodef-nested')) {
                    setTimeout(function(){
                        thisHolder.addClass('qodef-appear');

                        setTimeout(function(){
                            thisHolder.addClass('qodef-init');
                        }, 300);
                    }, appearingDelay);
                } else {
                    thisHolder.appear(function(){
                        setTimeout(function(){
                            thisHolder.addClass('qodef-appear');

                            setTimeout(function(){
                                thisHolder.addClass('qodef-init');
                            }, 300);
                        }, appearingDelay);
                    },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
                }
            });
        }
    }

})(jQuery);