(function ($) {
	'use strict';
	
	var timeline = {};
	qodef.modules.timeline = timeline;
	
	timeline.qodefInitHorizontalTimeline = qodefInitHorizontalTimeline;
	
	
	timeline.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitHorizontalTimeline();
		qodefInitHorizontalTimelineCursor();
	}
	
	function qodefInitHorizontalTimeline() {
		var timelines = $('.qodef-horizontal-timeline');

		timelines.each(function () {
			var timeline = $(this),
				children = $(this).find('.qodef-ht-content-item'),
				childrenLength  = $(this).find('.qodef-ht-content-item').length,
                childrenHeight = 0,
				itemDelayCounter = 0,
				timelineWidth = childrenLength * children.first().width(),
				thisDraggableWrapper = timeline.parent(),
				draggableOffset = thisDraggableWrapper.offset(),
				box = {
					x1: draggableOffset.left + (thisDraggableWrapper.outerWidth() - timelineWidth),
					y1: draggableOffset.top + (thisDraggableWrapper.outerHeight() - timeline.outerHeight()),
					x2: draggableOffset.left,
					y2: draggableOffset.top
				};


			timeline.draggable({
				containment: [box.x1 + 0, box.y1, box.x2, box.y2 ],
				axis: "x"
			});

            timeline.css({'width': timelineWidth});
            timeline.waitForImages(function () {
                children.each(function() {
                    var thisItemHeight;
                    var thisItemImageHeight = $(this).find('.qodef-hti-content-image').outerHeight();
                    var thisItemTextHeight = $(this).find('.qodef-hti-content-value').outerHeight();

                    if(thisItemImageHeight > thisItemTextHeight) {
                        thisItemHeight = thisItemImageHeight;
                    } else {
                        thisItemHeight = thisItemTextHeight;
                    }

                    if (childrenHeight < thisItemHeight){
                        childrenHeight = thisItemHeight;
                    }
                });
                if (qodef.windowWidth > 600) {
                    timeline.css({'paddingTop': childrenHeight + 50, 'paddingBottom' : childrenHeight + 50});
                } else {
                    timeline.css({'paddingTop': childrenHeight + 20, 'paddingBottom' : childrenHeight + 20});
                }
            });

            timeline.appear(function() {
                children.each(function() {
                    itemDelayCounter += 0.1;
                    $(this).css({
                        'opacity': '1',
                        'transition': '.5s ' + itemDelayCounter + 's',
                        'transform': 'translateX(0) translateY(0)'
                    });
                });
            }, {accX: 0, accY: 50});
		});
	}

    function qodefInitHorizontalTimelineCursor() {
        var holder = $('.qodef-horizontal-timeline');
        if (holder.length && !qodef.htmlEl.hasClass('touch')) {
            qodef.body.append('<div class="qodef-ht-cursor-holder"><span class="qodef-ht-cursor-text">drag</span></div>');
            var customCursor = $('.qodef-ht-cursor-holder');

                holder.on('mousemove', function (e) {
                    customCursor.css({
                        top: e.clientY,
                        left: e.clientX
                    });
                });

                holder.on('mouseenter', function (e) {
                    customCursor.addClass('horizontal-timeline-hovering');
                }).on('mouseleave', function (e) {
                    customCursor.removeClass('horizontal-timeline-hovering');
                })
                .on('mousedown', function (e) {
                    customCursor.addClass('custom-cursor-clicked');
                }).on('mouseup', function (e) {
                    customCursor.removeClass('custom-cursor-clicked');
                })
        }
    }
	
})(jQuery);