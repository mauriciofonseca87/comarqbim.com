(function($) {
	'use strict';
	
	var visualEffectsHolder = {};
	qodef.modules.visualEffectsHolder = visualEffectsHolder;
	
	visualEffectsHolder.qodefVisualEffectsHolderAnimation = qodefVisualEffectsHolderAnimation;
	visualEffectsHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefVisualEffectsHolderAnimation();
	}
	
	function qodefVisualEffectsHolderAnimation() {

		var initVFX = function() {
                var items = $('.qodef-veh-uncover');

                items.appear(function() {
                    var item = $(this),
                        delay = item.data('animation-delay') ? parseInt(item.data('animation-delay')) : 0;

                    if (delay != 0) {
                        setTimeout(function() {
                            item.addClass('qodef-show-item');
                        }, delay);
                    } else {
                        item.addClass('qodef-show-item');
                    }
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
		}

    if (!qodef.htmlEl.hasClass('touch')) {
		var loader = $('.qodef-diefinnhutte-spinner');

		if (loader.length) {
			$(document).on('qodefLoaded', initVFX);
		} else {
			$(window).on('load', initVFX)
		}
    }

    }
	
})(jQuery);