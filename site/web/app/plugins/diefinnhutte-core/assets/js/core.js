(function ($) {
	'use strict';
	
	var rating = {};
	qodef.modules.rating = rating;

    rating.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCommentRating();
	}
	
	function qodefInitCommentRating() {
		var ratingHolder = $('.qodef-comment-form-rating');

        var addActive = function (stars, ratingValue) {
            for (var i = 0; i < stars.length; i++) {
                var star = stars[i];
                if (i < ratingValue) {
                    $(star).addClass('active');
                } else {
                    $(star).removeClass('active');
                }
            }
        };

		ratingHolder.each(function() {
		    var thisHolder = $(this),
                ratingInput = thisHolder.find('.qodef-rating'),
                ratingValue = ratingInput.val(),
                stars = thisHolder.find('.qodef-star-rating');

                addActive(stars, ratingValue);

            stars.on('click', function () {
                ratingInput.val($(this).data('value')).trigger('change');
            });

            ratingInput.change(function () {
                ratingValue = ratingInput.val();
                addActive(stars, ratingValue);
            });
        });
	}
	
})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    qodef.modules.portfolio = portfolio;
	
    portfolio.qodefOnWindowLoad = qodefOnWindowLoad;
	
    $(window).on('load', qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefPortfolioSingleFollow().init();
	}
	
	var qodefPortfolioSingleFollow = function () {
		var info = $('.qodef-follow-portfolio-info .qodef-portfolio-single-holder .qodef-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.qodef-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .qodef-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0,
				constant = 30; //30 to prevent mispositioned
		}
		
		var infoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				if (qodef.scroll >= infoHolderOffset - headerHeight - qodefGlobalVars.vars.qodefAddForAdminBar - constant) {
					var marginTop = qodef.scroll - infoHolderOffset + qodefGlobalVars.vars.qodefAddForAdminBar + headerHeight + constant;
					// if scroll is initially positioned below mediaHolderHeight
					if (marginTop + infoHolderHeight > mediaHolderHeight) {
						marginTop = mediaHolderHeight - infoHolderHeight + constant;
					}
					info.stop().animate({
						marginTop: marginTop
					});
				}
			}
		};
		
		var recalculateInfoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				//Calculate header height if header appears
				if (qodef.scroll > 0 && header.length) {
					headerHeight = header.height();
				}
				
				var headerMixin = headerHeight + qodefGlobalVars.vars.qodefAddForAdminBar + constant;
				if (qodef.scroll >= infoHolderOffset - headerMixin) {
					if (qodef.scroll + infoHolderHeight + headerMixin + 2 * constant < infoHolderOffset + mediaHolderHeight) {
						info.stop().animate({
							marginTop: (qodef.scroll - infoHolderOffset + headerMixin + 2 * constant)
						});
						//Reset header height
						headerHeight = 0;
					} else {
						info.stop().animate({
							marginTop: mediaHolderHeight - infoHolderHeight
						});
					}
				} else {
					info.stop().animate({
						marginTop: 0
					});
				}
			}
		};
		
		return {
			init: function () {
				infoHolderPosition();
				$(window).scroll(function () {
					recalculateInfoHolderPosition();
				});
			}
		};
	};

})(jQuery);
(function($) {
    'use strict';
	
	var accordions = {};
	qodef.modules.accordions = accordions;
	
	accordions.qodefInitAccordions = qodefInitAccordions;
	
	
	accordions.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function qodefInitAccordions(){
		var accordion = $('.qodef-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('qodef-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('qodef-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.qodef-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('mouseenter mouseleave',function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	qodef.modules.animationHolder = animationHolder;
	
	animationHolder.qodefInitAnimationHolder = qodefInitAnimationHolder;
	
	
	animationHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function qodefInitAnimationHolder(){
		var elements = $('.qodef-grow-in, .qodef-fade-in-down, .qodef-element-from-fade, .qodef-element-from-left, .qodef-element-from-right, .qodef-element-from-top, .qodef-element-from-bottom, .qodef-flip-in, .qodef-x-rotate, .qodef-z-rotate, .qodef-y-translate, .qodef-fade-in, .qodef-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	qodef.modules.button = button;
	
	button.qodefButton = qodefButton;
	
	
	button.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var qodefButton = function() {
		//all buttons on the page
		var buttons = $('.qodef-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function ($) {
	'use strict';
	
	var cardsGallery = {};
	qodef.modules.cardsGallery = cardsGallery;
	
	
	cardsGallery.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(window).on('load', qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefInitCardsGallery();
	}
	
	/*
	 **	Init cards gallery shortcode
	 */
	function qodefInitCardsGallery() {
		var holder = $('.qodef-cards-gallery');
		
		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					cards = thisHolder.find('.qodef-cg-card');
				
				cards.each(function () {
					var card = $(this);
					
					card.on('click', function () {
						if (!cards.last().is(card)) {
							card.addClass('qodef-out qodef-animating').siblings().addClass('qodef-animating-siblings');
							card.detach();
							card.insertAfter(cards.last());
							
							setTimeout(function () {
								card.removeClass('qodef-out');
							}, 200);
							
							setTimeout(function () {
								card.removeClass('qodef-animating').siblings().removeClass('qodef-animating-siblings');
							}, 1200);
							
							cards = thisHolder.find('.qodef-cg-card');
							
							return false;
						}
					});
				});
				
				if (thisHolder.hasClass('qodef-bundle-animation') && !qodef.htmlEl.hasClass('touch')) {
					thisHolder.appear(function () {
						thisHolder.addClass('qodef-appeared');
						thisHolder.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
							$(this).addClass('qodef-animation-done');
						});
					}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	qodef.modules.countdown = countdown;
	
	countdown.qodefInitCountdown = qodefInitCountdown;
	
	
	countdown.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function qodefInitCountdown() {
		var countdowns = $('.qodef-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	qodef.modules.counter = counter;
	
	counter.qodefInitCounter = qodefInitCounter;
	
	
	counter.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function qodefInitCounter() {
		var counterHolder = $('.qodef-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.qodef-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('qodef-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	qodef.modules.customFont = customFont;
	
	customFont.qodefCustomFontResize = qodefCustomFontResize;
	customFont.qodefCustomFontTypeOut = qodefCustomFontTypeOut;
	
	
	customFont.qodefOnDocumentReady = qodefOnDocumentReady;
	customFont.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).on('load', qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function qodefCustomFontResize() {
		var holder = $('.qodef-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.qodef-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function qodefCustomFontTypeOut() {
		var qodefTyped = $('.qodef-cf-typed');
		
		if (qodefTyped.length) {
			qodefTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.qodef-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.qodef-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.qodef-cf-typed-1').text(),
					string_2 = thisTyped.find('.qodef-cf-typed-2').text(),
					string_3 = thisTyped.find('.qodef-cf-typed-3').text(),
					string_4 = thisTyped.find('.qodef-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';

	var elementsHolder = {};
	qodef.modules.elementsHolder = elementsHolder;

	elementsHolder.qodefInitElementsHolderResponsiveStyle = qodefInitElementsHolderResponsiveStyle;


	elementsHolder.qodefOnDocumentReady = qodefOnDocumentReady;

	$(document).ready(qodefOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitElementsHolderResponsiveStyle();
	}

	/*
	 **	Elements Holder responsive style
	 */
	function qodefInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.qodef-elements-holder');

		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.qodef-eh-item'),
					style = '',
					responsiveStyle = '';

				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';

					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1367-1600') !== 'undefined' && thisItem.data('1367-1600') !== false) {
						largeLaptop = thisItem.data('1367-1600');
					}
					if (typeof thisItem.data('1025-1366') !== 'undefined' && thisItem.data('1025-1366') !== false) {
						smallLaptop = thisItem.data('1025-1366');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}

					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.qodef-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.qodef-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}

                    if (typeof qodef.modules.common.qodefOwlSlider === "function") { // if owl function exist
                        var owl = thisItem.find('.qodef-owl-slider');
                        if (owl.length) { // if owl is in elements holder
                            setTimeout(function () {
                                owl.trigger('refresh.owl.carousel'); // reinit owl
                            }, 100);
                        }
                    }

				});

				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}

				if(style.length) {
					$('head').append(style);
				}

			});
		}
	}

})(jQuery);
(function ($) {
	'use strict';
	
	var fullScreenImageSlider = {};
	qodef.modules.fullScreenImageSlider = fullScreenImageSlider;
	
	
	fullScreenImageSlider.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(window).on('load', qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefInitFullScreenImageSlider();
	}
	
	/**
	 * Init Full Screen Image Slider Shortcode
	 */
	function qodefInitFullScreenImageSlider() {
		var holder = $('.qodef-fsis-slider');
		
		if (holder.length) {
			holder.each(function () {
				var sliderHolder = $(this),
					mainHolder = sliderHolder.parent(),
					prevThumbNav = mainHolder.children('.qodef-fsis-prev-nav'),
					nextThumbNav = mainHolder.children('.qodef-fsis-next-nav'),
					maskHolder = mainHolder.children('.qodef-fsis-slider-mask');
				
				mainHolder.addClass('qodef-fsis-is-init');
				
				qodefImageBehavior(sliderHolder);
				qodefPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, -1); // -1 is arbitrary value because 0 can be index of item
				
				sliderHolder.on('drag.owl.carousel', function () {
					setTimeout(function () {
						if (!maskHolder.hasClass('qodef-drag') && !mainHolder.hasClass('qodef-fsis-active')) {
							maskHolder.addClass('qodef-drag');
						}
					}, 200);
				});
				
				sliderHolder.on('dragged.owl.carousel', function () {
					setTimeout(function () {
						if (maskHolder.hasClass('qodef-drag')) {
							maskHolder.removeClass('qodef-drag');
						}
					}, 300);
				});
				
				sliderHolder.on('translate.owl.carousel', function (e) {
					qodefPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, e.item.index);
				});
				
				sliderHolder.on('translated.owl.carousel', function () {
					qodefImageBehavior(sliderHolder);
					
					setTimeout(function () {
						maskHolder.removeClass('qodef-drag');
					}, 300);
				});
			});
		}
	}
	
	function qodefImageBehavior(sliderHolder) {
		var activeItem = sliderHolder.find('.owl-item.active'),
			imageHolder = sliderHolder.find('.qodef-fsis-item');
		
		imageHolder.removeClass('qodef-fsis-content-image-init');
		
		qodefResetImageBehavior(sliderHolder);
		
		if (activeItem.length) {
			var activeImageHolder = activeItem.find('.qodef-fsis-item'),
				activeItemImage = activeImageHolder.children('.qodef-fsis-image');
			
			setTimeout(function () {
				activeImageHolder.addClass('qodef-fsis-content-image-init');
			}, 100);
			
			activeItemImage.off().on('mouseenter', function () {
				activeImageHolder.addClass('qodef-fsis-image-hover');
			}).on('mouseleave', function () {
				activeImageHolder.removeClass('qodef-fsis-image-hover');
			}).on('click', function () {
				if (activeImageHolder.hasClass('qodef-fsis-active-image')) {
					sliderHolder.trigger('play.owl.autoplay');
					sliderHolder.parent().removeClass('qodef-fsis-active');
					activeImageHolder.removeClass('qodef-fsis-active-image');
				} else {
					sliderHolder.trigger('stop.owl.autoplay');
					sliderHolder.parent().addClass('qodef-fsis-active');
					activeImageHolder.addClass('qodef-fsis-active-image');
				}
			});
			
			//Close on escape
			$(document).keyup(function (e) {
				if (e.keyCode === 27) { //KeyCode for ESC button is 27
					sliderHolder.trigger('play.owl.autoplay');
					sliderHolder.parent().removeClass('qodef-fsis-active');
					activeImageHolder.removeClass('qodef-fsis-active-image');
				}
			});
		}
	}
	
	function qodefPrevNextImageBehavior(sliderHolder, prevThumbNav, nextThumbNav, itemIndex) {
		var activeItem = itemIndex === -1 ? sliderHolder.find('.owl-item.active') : $(sliderHolder.find('.owl-item')[itemIndex]),
			prevItemImage = activeItem.prev().find('.qodef-fsis-image').css('background-image'),
			nextItemImage = activeItem.next().find('.qodef-fsis-image').css('background-image');
		
		if (prevItemImage.length) {
			prevThumbNav.css({'background-image': prevItemImage});
		}
		
		if (nextItemImage.length) {
			nextThumbNav.css({'background-image': nextItemImage});
		}
	}
	
	function qodefResetImageBehavior(sliderHolder) {
		var imageHolder = sliderHolder.find('.qodef-fsis-item');
		
		if (imageHolder.length) {
			imageHolder.removeClass('qodef-fsis-active-image');
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var fullScreenSections = {};
	qodef.modules.fullScreenSections = fullScreenSections;
	
	fullScreenSections.qodefInitFullScreenSections = qodefInitFullScreenSections;
	
	
	fullScreenSections.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitFullScreenSections();
	}
	
	/*
	 **	Init full screen sections shortcode
	 */
	function qodefInitFullScreenSections(){
		var fullScreenSections = $('.qodef-full-screen-sections');
		
		if(fullScreenSections.length){
			fullScreenSections.each(function() {
				var thisFullScreenSections = $(this),
					fullScreenSectionsWrapper = thisFullScreenSections.children('.qodef-fss-wrapper'),
					fullScreenSectionsItems = fullScreenSectionsWrapper.children('.qodef-fss-item'),
					fullScreenSectionsItemsNumber = fullScreenSectionsItems.length,
					fullScreenSectionsItemsHasHeaderStyle = fullScreenSectionsItems.hasClass('qodef-fss-item-has-style'),
					enableContinuousVertical = false,
					enableNavigationData = '',
					enablePaginationData = '';
				
				var defaultHeaderStyle = '';
				if (qodef.body.hasClass('qodef-light-header')) {
					defaultHeaderStyle = 'light';
				} else if (qodef.body.hasClass('qodef-dark-header')) {
					defaultHeaderStyle = 'dark';
				}
				
				if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
					enableContinuousVertical = true;
				}
				if (typeof thisFullScreenSections.data('enable-navigation') !== 'undefined' && thisFullScreenSections.data('enable-navigation') !== false) {
					enableNavigationData = thisFullScreenSections.data('enable-navigation');
				}
				if (typeof thisFullScreenSections.data('enable-pagination') !== 'undefined' && thisFullScreenSections.data('enable-pagination') !== false) {
					enablePaginationData = thisFullScreenSections.data('enable-pagination');
				}
				
				var enableNavigation = enableNavigationData !== 'no',
					enablePagination = enablePaginationData !== 'no';
				
				fullScreenSectionsWrapper.fullpage({
					sectionSelector: '.qodef-fss-item',
					scrollingSpeed: 1200,
					verticalCentered: false,
					continuousVertical: enableContinuousVertical,
					navigation: enablePagination,
					onLeave: function(index, nextIndex, direction){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle($(fullScreenSectionsItems[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, nextIndex);
						}
					},
					afterRender: function(){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle(fullScreenSectionsItems.first().data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, 1);
							thisFullScreenSections.children('.qodef-fss-nav-holder').css('visibility','visible');
						}
						
						fullScreenSectionsWrapper.css('visibility','visible');
					}
				});
				
				setResposniveData(thisFullScreenSections);
				
				if(enableNavigation) {
					thisFullScreenSections.find('#qodef-fss-nav-up').on('click', function() {
						$.fn.fullpage.moveSectionUp();
						return false;
					});
					
					thisFullScreenSections.find('#qodef-fss-nav-down').on('click', function() {
						$.fn.fullpage.moveSectionDown();
						return false;
					});
				}
			});
		}
	}
	
	function checkFullScreenSectionsItemForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + default_header_style + '-header');
		} else {
			qodef.body.removeClass('qodef-light-header qodef-dark-header');
		}
	}
	
	function checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, index){
		var thisHolder = thisFullScreenSections,
			thisHolderArrowsUp = thisHolder.find('#qodef-fss-nav-up'),
			thisHolderArrowsDown = thisHolder.find('#qodef-fss-nav-down'),
			enableContinuousVertical = false;
		
		if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
			enableContinuousVertical = true;
		}
		
		if (index === 1 && !enableContinuousVertical) {
			thisHolderArrowsUp.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(index !== fullScreenSectionsItemsNumber){
				thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else if (index === fullScreenSectionsItemsNumber && !enableContinuousVertical) {
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(fullScreenSectionsItemsNumber === 2){
				thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else {
			thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
		}
	}
	
	function setResposniveData(thisFullScreenSections) {
		var fullScreenSections = thisFullScreenSections.find('.qodef-fss-item'),
			responsiveStyle = '',
			style = '';
		
		fullScreenSections.each(function(){
			var thisSection = $(this),
				itemClass = '',
				imageLaptop = '',
				imageTablet = '',
				imagePortraitTablet = '',
				imageMobile = '';
			
			if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
				itemClass = thisSection.data('item-class');
			}
			if (typeof thisSection.data('laptop-image') !== 'undefined' && thisSection.data('laptop-image') !== false) {
				imageLaptop = thisSection.data('laptop-image');
			}
			if (typeof thisSection.data('tablet-image') !== 'undefined' && thisSection.data('tablet-image') !== false) {
				imageTablet = thisSection.data('tablet-image');
			}
			if (typeof thisSection.data('tablet-portrait-image') !== 'undefined' && thisSection.data('tablet-portrait-image') !== false) {
				imagePortraitTablet = thisSection.data('tablet-portrait-image');
			}
			if (typeof thisSection.data('mobile-image') !== 'undefined' && thisSection.data('mobile-image') !== false) {
				imageMobile = thisSection.data('mobile-image');
			}
			
			if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {
				
				if (imageLaptop.length) {
					responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-fss-item." + itemClass + " { background-image: url(" + imageLaptop + ") !important; } }";
				}
				if (imageTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imageTablet + ") !important; } }";
				}
				if (imagePortraitTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 800px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imagePortraitTablet + ") !important; } }";
				}
				if (imageMobile.length) {
					responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imageMobile + ") !important; } }";
				}
			}
		});
		
		if (responsiveStyle.length) {
			style = '<style type="text/css">' + responsiveStyle + '</style>';
		}
		
		if (style.length) {
			$('head').append(style);
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	qodef.modules.googleMap = googleMap;
	
	googleMap.qodefShowGoogleMap = qodefShowGoogleMap;
	
	
	googleMap.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function qodefShowGoogleMap(){
		var googleMap = $('.qodef-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.qodef-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "qodef-map-"+ uniqueId;
				
				qodefInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function qodefInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'qodef-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('qodef-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			qodefInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function qodefInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var icon = {};
	qodef.modules.icon = icon;
	
	icon.qodefIcon = qodefIcon;
	
	
	icon.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var qodefIcon = function() {
		var icons = $('.qodef-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('qodef-icon-animation')) {
				icon.appear(function() {
					icon.parent('.qodef-icon-animation-holder').addClass('qodef-icon-animation-show');
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.qodef-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	qodef.modules.iconListItem = iconListItem;
	
	iconListItem.qodefInitIconList = qodefInitIconList;
	
	
	iconListItem.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var qodefInitIconList = function() {
		var iconList = $('.qodef-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('qodef-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var pieChart = {};
	qodef.modules.pieChart = pieChart;
	
	pieChart.qodefInitPieChart = qodefInitPieChart;
	
	
	pieChart.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function qodefInitPieChart() {
		var pieChartHolder = $('.qodef-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.qodef-pc-percentage'),
					barColor = '#000000',
					trackColor = '#f6f3f3',
					lineWidth = 4,
					size = 178;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.qodef-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var process = {};
	qodef.modules.process = process;
	
	process.qodefInitProcess = qodefInitProcess;
	
	
	process.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProcess()
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function qodefInitProcess() {
		var holder = $('.qodef-process-holder');
		
		if(holder.length) {
			holder.each(function(){
				var thisHolder = $(this);
				
				thisHolder.appear(function(){
					thisHolder.addClass('qodef-process-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	qodef.modules.progressBar = progressBar;
	
	progressBar.qodefInitProgressBars = qodefInitProgressBars;
	
	
	progressBar.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function qodefInitProgressBars() {
		var progressBar = $('.qodef-progress-bar');
		
		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.qodef-pb-content'),
					progressBar = thisBar.find('.qodef-pb-percent'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function () {
					qodefInitToCounterProgressBar(progressBar, percentage);
					
					thisBarContent.css('width', '0%').animate({'width': percentage + '%'}, 2000);
					
					if (thisBar.hasClass('qodef-pb-percent-floating')) {
						progressBar.css('left', '0%').animate({'left': percentage + '%'}, 2000);
					}
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function qodefInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);
		
		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var roadmap = {};
	qodef.modules.roadmap = roadmap;

	roadmap.qodefInitRoadmap = qodefInitRoadmap;

	roadmap.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitRoadmap();
	}

	function qodefInitRoadmap() {
		var roadmap = $('.qodef-roadmap');
		
		if (roadmap.length) {
			roadmap.each(function () {
				var thisRoadmap = $(this),
					roadMapHolder = thisRoadmap.find('.qodef-roadmap-holder'),
					roadmapItemsHolder = thisRoadmap.find('.qodef-roadmap-inner-holder'),
					roadmapItems = thisRoadmap.find('.qodef-roadmap-item'),
					visibleItems = 5,
					roadmapInitalWidth = thisRoadmap.width(),
					roadmapHolderWidth = 0,
					itemsWidth,
					itemsHeight = 0,
					itemReached = roadmapItems.filter('.qodef-roadmap-reached-item').last(),
					prevArrow = thisRoadmap.find('.qodef-rl-arrow-left'),
					nextArrow = thisRoadmap.find('.qodef-rl-arrow-right'),
					firstActive,
					lastActive,
					translateCurrent = 0,
					moving = false;

				itemReached.siblings().remove('qodef-roadmap-reached-item');
				itemReached.prevAll().addClass('qodef-roadmap-passed-item');

				//set width for items and holder, also set classes and first and last active items
				var setWidths = function(){
					roadmapInitalWidth = thisRoadmap.width();

					if (qodef.windowWidth > 1024) {
						visibleItems = 5;
					} else if (qodef.windowWidth > 680) {
						visibleItems = 3;
					} else {
						visibleItems = 1;
					}

					itemsWidth = roadmapInitalWidth/visibleItems;

					roadmapItems.each(function () {
						var thisItem = $(this),
							thisItemHeight;

						thisItem.width(itemsWidth);
						roadmapHolderWidth += itemsWidth;

						//needs to be here in order to calculate height right because of the width
						thisItemHeight = thisItem.find('.qodef-roadmap-item-content-holder').outerHeight();

						if (itemsHeight < thisItemHeight){
							itemsHeight = thisItemHeight;
						}
					});

					roadmapItemsHolder.width(roadmapHolderWidth);
					thisRoadmap.css({'paddingTop': itemsHeight + 70, 'paddingBottom' : itemsHeight + 70});

					//if firstactive set change them accordingly
					if (typeof firstActive != 'undefined') {
						roadmapItems.removeClass('qodef-roadmap-active-item');
						firstActive.addClass('qodef-roadmap-active-item');
						for (var i = 0; i < visibleItems - 1; i++) {
							firstActive.nextAll().eq(i).addClass('qodef-roadmap-active-item');
						}
						lastActive = roadmapItems.filter('.qodef-roadmap-active-item').last();
					} else {
						roadmapItems.eq(visibleItems).prevAll().addClass('qodef-roadmap-active-item');
						firstActive = roadmapItems.filter('.qodef-roadmap-active-item').first();
						lastActive = roadmapItems.filter('.qodef-roadmap-active-item').last();
					}
				};

				//movement for provided step (> 0 to the right, < 0 to the left)
				var moveRoadmap = function(step, timeout){
					var nextItem;
					//prevent multiple clicks while animating with moving  var
					if (!moving) {
						//grab item to be moved to
						if (step >= 1) {
							nextItem = lastActive.nextAll().eq(step - 1);
						} else {
							nextItem = firstActive.prevAll().eq(Math.abs(step) - 1);
						}
						if (nextItem.length) {
							moving = true;

							//adjust classes according to currently moved to item
							roadmapItems.removeClass('qodef-roadmap-active-item');
							nextItem.addClass('qodef-roadmap-active-item');
							if (step >= 1) {
								for (var i = 0; i < visibleItems - 1; i++) {
									nextItem.prevAll().eq(i).addClass('qodef-roadmap-active-item');
								}
							} else {
								for (var i = 0; i < visibleItems - 1; i++) {
									nextItem.nextAll().eq(i).addClass('qodef-roadmap-active-item');
								}
							}

							//set new first and last active items
							firstActive = roadmapItems.filter('.qodef-roadmap-active-item').first();
							lastActive = roadmapItems.filter('.qodef-roadmap-active-item').last();

							//move holder and set var moving to false
							translateCurrent -= step*itemsWidth;
							roadmapItemsHolder.css({'transform': 'translateX(' + translateCurrent + 'px)'});
							setTimeout(function () {
								moving = false;
							}, timeout);
						}
					}
				};

				//move holder to provided item
				var moveTo = function(item){
					var firstActiveIndex = firstActive.index(),
						lastActiveIndex = lastActive.index(),
						goToIndex = item.index(),
						moveStep = 0,
						middle;

					middle = (firstActiveIndex + lastActiveIndex) / 2;

					//if first or second item, go to third item
					//else if last or one before, go to third form the back
					//else go to the desired
					if ( goToIndex < Math.floor(visibleItems/2)) {
						moveStep = firstActiveIndex - 2;
					} else if (goToIndex > roadmapItems.length - 1 - Math.floor(visibleItems/2)) {
						moveStep = roadmapItems.length - 1 - lastActiveIndex;
					} else {
						moveStep = goToIndex - middle;
					}
					moveRoadmap(moveStep, 0);
				}

				//adjust translate so it wouldn't be stopped in the middle of items
				var resizeTranslateAdj = function(){
					var adjustment = firstActive.index()*itemsWidth;

					translateCurrent = -adjustment;
					roadmapItemsHolder.css({'transform': 'translateX(' + translateCurrent + 'px)'});
				}

				//inital set of widths and items
				setWidths();

				//move to reached item
				moveTo(itemReached);

				//bind movement for prev and next arrow
				nextArrow.on("click", function () {
					moveRoadmap(1, 200); //init movement to to right
				});
				prevArrow.on("click", function () {
					moveRoadmap(-1, 200); //init movement to to right
				});

				//adjustments on resize
				$(window).resize(function(){
					setWidths();
					resizeTranslateAdj();
				});

                $('.qodef-roadmap-item-content-holder').css('opacity', 0);
                $('.qodef-roadmap-item-above .qodef-roadmap-item-content-holder').css('transform', 'translateY(20px)');
                $('.qodef-roadmap-item-below .qodef-roadmap-item-content-holder').css('transform', 'translateY(-20px)');
			});


			roadmap.appear(function () {
				$('.qodef-roadmap-item-content-holder').each(function(i) {
					var fadeInTime = .2 + i/5;

					$(this).css({
						'opacity' : 1,
						'transform': 'translateY(0)',
                        'transition':'transform .25s ease-in-out '+ fadeInTime +'s, opacity .25s ease-in-out '+ fadeInTime +'s '
					})
				})
			})

        }


	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var tabs = {};
	qodef.modules.tabs = tabs;
	
	tabs.qodefInitTabs = qodefInitTabs;
	
	
	tabs.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function qodefInitTabs(){
		var tabs = $('.qodef-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.qodef-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.qodef-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.qodef-tabs a.qodef-external-link').off('click');
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';
    
    var textMarquee = {};
    qodef.modules.textMarquee = textMarquee;
    
    textMarquee.qodefInitTextMarquee = qodefInitTextMarquee;
	textMarquee.qodefTextMarqueeResize = qodefTextMarqueeResize;
    
    textMarquee.qodefOnDocumentReady = qodefOnDocumentReady;
    
    $(document).ready(qodefOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefTextMarqueeResize();
        qodefInitTextMarquee();
    }
    
    /**
     * Init Text Marquee effect
     */
    function qodefInitTextMarquee() {
        var textMarqueeShortcodes = $('.qodef-text-marquee');

        if (textMarqueeShortcodes.length) {
            textMarqueeShortcodes.each(function(){
                var textMarqueeShortcode = $(this),
                    marqueeElements = textMarqueeShortcode.find('.qodef-marquee-element'),
                    originalText = marqueeElements.filter('.qodef-original-text'),
                    auxText = marqueeElements.filter('.qodef-aux-text');

                var calcWidth = function(element) {
                    var width;

                    if (textMarqueeShortcode.outerWidth() > element.outerWidth()) {
                        width = textMarqueeShortcode.outerWidth();
                    } else {
                        width = element.outerWidth();
                    }

                    return width;
                };

                var marqueeEffect = function () {
	                qodefRequestAnimationFrame();
	                
                    var delta = 1, //pixel movement
                        speedCoeff = 0.8, // below 1 to slow down, above 1 to speed up
                        marqueeWidth = calcWidth(originalText);
                    marqueeElements.css({'width':marqueeWidth}); // set the same width to both elements
                    auxText.css('left', marqueeWidth); //set to the right of the initial marquee element

                    //movement loop
                    marqueeElements.each(function(i){
                        var marqueeElement = $(this),
                            currentPos = 0;

                        var qodefInfiniteScrollEffect = function() {
                            currentPos -= delta;

                            //move marquee element
                            if (marqueeElement.position().left <= -marqueeWidth) {
                                marqueeElement.css('left', parseInt(marqueeWidth - delta));
                                currentPos = 0;
                            }

                            marqueeElement.css('transform','translate3d('+speedCoeff*currentPos+'px,0,0)');
	
	                        requestNextAnimationFrame(qodefInfiniteScrollEffect);

                            $(window).resize(function(){
                                marqueeWidth = calcWidth(originalText);
                                currentPos = 0;
                                originalText.css('left',0);
                                auxText.css('left', marqueeWidth); //set to the right of the inital marquee element
                            });
                        }; 
                            
                        qodefInfiniteScrollEffect();
                    });
                };

                marqueeEffect();
            });
        }
    }
    
    /*
     * Request Animation Frame shim
     */
	function qodefRequestAnimationFrame() {
		window.requestNextAnimationFrame =
			(function () {
				var originalWebkitRequestAnimationFrame = undefined,
					wrapper = undefined,
					callback = undefined,
					geckoVersion = 0,
					userAgent = navigator.userAgent,
					index = 0,
					self = this;
				
				// Workaround for Chrome 10 bug where Chrome
				// does not pass the time to the animation function
				
				if (window.webkitRequestAnimationFrame) {
					// Define the wrapper
					
					wrapper = function (time) {
						if (time === undefined) {
							time = +new Date();
						}
						
						self.callback(time);
					};
					
					// Make the switch
					
					originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;
					
					window.webkitRequestAnimationFrame = function (callback, element) {
						self.callback = callback;
						
						// Browser calls the wrapper and wrapper calls the callback
						originalWebkitRequestAnimationFrame(wrapper, element);
					};
				}
				
				// Workaround for Gecko 2.0, which has a bug in
				// mozRequestAnimationFrame() that restricts animations
				// to 30-40 fps.
				
				if (window.mozRequestAnimationFrame) {
					// Check the Gecko version. Gecko is used by browsers
					// other than Firefox. Gecko 2.0 corresponds to
					// Firefox 4.0.
					
					index = userAgent.indexOf('rv:');
					
					if (userAgent.indexOf('Gecko') !== -1) {
						geckoVersion = userAgent.substr(index + 3, 3);
						
						if (geckoVersion === '2.0') {
							// Forces the return statement to fall through
							// to the setTimeout() function.
							
							window.mozRequestAnimationFrame = undefined;
						}
					}
				}
				
				return window.requestAnimationFrame   ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame    ||
					window.oRequestAnimationFrame      ||
					window.msRequestAnimationFrame     ||
					
					function (callback, element) {
						var start,
							finish;
						
						window.setTimeout( function () {
							start = +new Date();
							callback(start);
							finish = +new Date();
							
							self.timeout = 1000 / 60 - (finish - start);
							
						}, self.timeout);
					};
				}
			)();
	}

	/*
	 **	Text Marquee resizing style
	 */
	function qodefTextMarqueeResize() {
		var holder = $('.qodef-text-marquee');

		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';

				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}

				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}

				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}

				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {

					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-text-marquee." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-text-marquee." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.qodef-text-marquee." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-text-marquee." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}

				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}

				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    var uncoveringSections = {};
    qodef.modules.uncoveringSections = uncoveringSections;

    uncoveringSections.qodefInitUncoveringSections = qodefInitUncoveringSections;


    uncoveringSections.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitUncoveringSections();
    }

    /*
     **	Init full screen sections shortcode
     */
    function qodefInitUncoveringSections(){
        var uncoveringSections = $('.qodef-uncovering-sections');

        if(uncoveringSections.length){
            uncoveringSections.each(function() {
                var thisUS = $(this),
                    thisCurtain = uncoveringSections.find('.curtains'),
                    curtainItems = thisCurtain.find('.qodef-uss-item'),
                    curtainShadow = uncoveringSections.find('.qodef-fss-shadow');
                var body = qodef.body;
                var defaultHeaderStyle = '';
                if (body.hasClass('qodef-light-header')) {
                    defaultHeaderStyle = 'light';
                } else if (body.hasClass('qodef-dark-header')) {
                    defaultHeaderStyle = 'dark';
                }

                body.addClass('qodef-uncovering-section-on-page');
                if(qodefPerPageVars.vars.qodefHeaderVerticalWidth > 0 && qodef.windowWidth > 1024) {
                    curtainItems.css({
                        left : qodefPerPageVars.vars.qodefHeaderVerticalWidth,
                        width: 'calc(100% - ' + qodefPerPageVars.vars.qodefHeaderVerticalWidth + 'px)'
                    });

                    curtainShadow.css({
                        left : qodefPerPageVars.vars.qodefHeaderVerticalWidth,
                        width: 'calc(100% - ' + qodefPerPageVars.vars.qodefHeaderVerticalWidth + 'px)'
                    });
                }

                thisCurtain.curtain({
                    scrollSpeed: 400,
                    nextSlide: function() { checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle); },
                    prevSlide: function() { checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);}
                });

                checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);
                setResposniveData(thisCurtain);

                thisUS.addClass('qodef-loaded');
            });
        }
    }

    function checkFullScreenSectionsItemForHeaderStyle(thisUncoveringSections, default_header_style) {
        var section_header_style = thisUncoveringSections.find('.current').data('header-style');
        if (section_header_style !== undefined && section_header_style !== '') {
            qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + section_header_style + '-header');
        } else if (default_header_style !== '') {
            qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + default_header_style + '-header');
        } else {
            qodef.body.removeClass('qodef-light-header qodef-dark-header');
        }
    }

    function setResposniveData(thisUncoveringSections) {
        var uncoveringSections = thisUncoveringSections.find('.qodef-uss-item'),
            responsiveStyle = '',
            style = '';

        uncoveringSections.each(function(){
            var thisSection = $(this),
                thisSectionImage = thisSection.find('.qodef-uss-image-holder'),
                itemClass = '',
                imageLaptop = '',
                imageTablet = '',
                imagePortraitTablet = '',
                imageMobile = '';

            if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
                itemClass = thisSection.data('item-class');
            }

            if (typeof thisSectionImage.data('laptop-image') !== 'undefined' && thisSectionImage.data('laptop-image') !== false) {
                imageLaptop = thisSectionImage.data('laptop-image');
            }
            if (typeof thisSectionImage.data('tablet-image') !== 'undefined' && thisSectionImage.data('tablet-image') !== false) {
                imageTablet = thisSectionImage.data('tablet-image');
            }
            if (typeof thisSectionImage.data('tablet-portrait-image') !== 'undefined' && thisSectionImage.data('tablet-portrait-image') !== false) {
                imagePortraitTablet = thisSectionImage.data('tablet-portrait-image');
            }
            if (typeof thisSectionImage.data('mobile-image') !== 'undefined' && thisSectionImage.data('mobile-image') !== false) {
                imageMobile = thisSectionImage.data('mobile-image');
            }


            if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {

                if (imageLaptop.length) {
                    responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-uss-item." + itemClass + " .qodef-uss-image-holder { background-image: url(" + imageLaptop + ") !important; } }";
                }
                if (imageTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-uss-item." + itemClass + " .qodef-uss-image-holder { background-image: url( " + imageTablet + ") !important; } }";
                }
                if (imagePortraitTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 800px) {.qodef-uss-item." + itemClass + " .qodef-uss-image-holder { background-image: url( " + imagePortraitTablet + ") !important; } }";
                }
                if (imageMobile.length) {
                    responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-uss-item." + itemClass + " .qodef-uss-image-holder { background-image: url( " + imageMobile + ") !important; } }";
                }
            }
        });

        if (responsiveStyle.length) {
            style = '<style type="text/css">' + responsiveStyle + '</style>';
        }

        if (style.length) {
            $('head').append(style);
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	var verticalSplitSlider = {};
	qodef.modules.verticalSplitSlider = verticalSplitSlider;
	
	verticalSplitSlider.qodefInitVerticalSplitSlider = qodefInitVerticalSplitSlider;
	
	
	verticalSplitSlider.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitVerticalSplitSlider();
	}
	
	/*
	 **	Vertical Split Slider
	 */
	function qodefInitVerticalSplitSlider() {
		var slider = $('.qodef-vertical-split-slider'),
			progressBarFlag = true;
		
		if (slider.length) {
			if (qodef.body.hasClass('qodef-vss-initialized')) {
				qodef.body.removeClass('qodef-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(qodef.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (qodef.body.hasClass('qodef-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (qodef.body.hasClass('qodef-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.qodef-vss-ms-section',
				leftSelector: '.qodef-vss-ms-left',
				rightSelector: '.qodef-vss-ms-right',
				afterRender: function () {
					qodefCheckVerticalSplitSectionsForHeaderStyle($('.qodef-vss-ms-left .qodef-vss-ms-section:first-child').data('header-style'), defaultHeaderStyle);
					qodef.body.addClass('qodef-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						contactForm7.each(function(){
							var thisForm = $(this);
							
							thisForm.find('.wpcf7-submit').off().on('click', function(e){
								e.preventDefault();
								wpcf7.submit(thisForm);
							});
						});
					}
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="qodef-vss-responsive"></div>'),
						leftSide = slider.find('.qodef-vss-ms-left > div'),
						rightSide = slider.find('.qodef-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.qodef-vss-responsive .qodef-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'qodef-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof qodef.modules.animationHolder.qodefInitAnimationHolder === "function") {
						qodef.modules.animationHolder.qodefInitAnimationHolder();
					}
					
					if (typeof qodef.modules.button.qodefButton === "function") {
						qodef.modules.button.qodefButton().init();
					}
					
					if (typeof qodef.modules.elementsHolder.qodefInitElementsHolderResponsiveStyle === "function") {
						qodef.modules.elementsHolder.qodefInitElementsHolderResponsiveStyle();
					}
					
					if (typeof qodef.modules.googleMap.qodefShowGoogleMap === "function") {
						qodef.modules.googleMap.qodefShowGoogleMap();
					}
					
					if (typeof qodef.modules.icon.qodefIcon === "function") {
						qodef.modules.icon.qodefIcon().init();
					}
					
					if (progressBarFlag && typeof qodef.modules.progressBar.qodefInitProgressBars === "function" && ($('.qodef-vss-ms-left .qodef-vss-ms-section.active').find('.qodef-progress-bar').length || $('.qodef-vss-ms-right .qodef-vss-ms-section.active').find('.qodef-progress-bar').length)){
						qodef.modules.progressBar.qodefInitProgressBars();
						progressBarFlag = false;
					}
				},
				onLeave: function (index, nextIndex) {
					if (progressBarFlag && typeof qodef.modules.progressBar.qodefInitProgressBars === "function" && ($('.qodef-vss-ms-left .qodef-vss-ms-section.active').find('.qodef-progress-bar').length || $('.qodef-vss-ms-right .qodef-vss-ms-section.active').find('.qodef-progress-bar').length)){
						setTimeout(function(){
							qodef.modules.progressBar.qodefInitProgressBars();
						},700); // scrolling speed is 700

						progressBarFlag = false;
					}

					qodefIntiScrollAnimation(slider, nextIndex);
					qodefCheckVerticalSplitSectionsForHeaderStyle($($('.qodef-vss-ms-left .qodef-vss-ms-section')[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (qodef.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (qodef.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	function qodefIntiScrollAnimation(slider, nextIndex) {
		
		if (slider.hasClass('qodef-vss-scrolling-animation')) {
			
			if (nextIndex > 1 && !slider.hasClass('qodef-vss-scrolled')) {
				slider.addClass('qodef-vss-scrolled');
			} else if (nextIndex === 1 && slider.hasClass('qodef-vss-scrolled')) {
				slider.removeClass('qodef-vss-scrolled');
			}
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function qodefCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + default_header_style + '-header');
		} else {
			qodef.body.removeClass('qodef-light-header qodef-dark-header');
		}
	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var workflow = {};
	qodef.modules.workflow = workflow;

    workflow.qodefWorkflow = qodefWorkflow;


    workflow.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
        qodefWorkflow();
	}

    function qodefWorkflow() {
        var workflowShortcodes = $('.qodef-workflow');
        if (workflowShortcodes.length) {
            workflowShortcodes.each(function () {
                var workflowShortcode = $(this);
                if (workflowShortcode.hasClass('qodef-workflow-animate')) {
                    var workflowItems = workflowShortcode.find('.qodef-workflow-item');

                    workflowShortcode.appear(function () {
                        workflowShortcode.addClass('qodef-appeared');
                        setTimeout(function () {
                            workflowItems.each(function (i) {
                                var workflowItem = $(this);
                                setTimeout(function () {
                                    workflowItem.addClass('qodef-appeared');
                                }, 350 * i);
                            });
                        }, 350);
                    }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

                }
            });
        }
    }
	
})(jQuery);
(function($) {
    'use strict';

    var portfolioList = {};
    qodef.modules.portfolioList = portfolioList;

    portfolioList.qodefOnWindowLoad = qodefOnWindowLoad;
    portfolioList.qodefOnWindowScroll = qodefOnWindowScroll;
    portfolioList.qodefOnDocumentReady = qodefOnDocumentReady;

    $(window).on('load', qodefOnWindowLoad);
    $(window).scroll(qodefOnWindowScroll);
    $(window).ready(qodefOnDocumentReady);

    /*
	 All functions to be called on $(document).ready() should be in this function
	 */
    function qodefOnDocumentReady() {
        qodefDynamicBackgroundColor();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodefInitSmallListPaddingResponsive();
        qodefInitPortfolioJustifiedGallery();
        qodefInitPortfolioFilter();
        qodefInitPortfolioListAnimation();
        qodefInitPortfolioVerticalItemShowcase();
	    qodefInitPortfolioPagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
	    qodefInitPortfolioPagination().scroll();
    }

    function qodefInitSmallListPaddingResponsive() {
        var portList = $('.qodef-portfolio-list-holder.qodef-pl-standard-small-images');
        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.qodef-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this),
                        style = '',
                        itemClass = '',
                        responsiveStyle = '',
                        largeLaptop = '',
                        smallLaptop = '',
                        ipadLandscape = '',
                        ipadPortrait = '',
                        mobileLandscape = '',
                        mobilePortrait = '';

                    if (typeof thisArticle.data('item-class') !== 'undefined' && thisArticle.data('item-class') !== false) {
                        itemClass = thisArticle.data('item-class');
                    }
                    if (typeof thisArticle.data('1367-1600') !== 'undefined' && thisArticle.data('1367-1600') !== false) {
                        largeLaptop = thisArticle.data('1367-1600');
                    }
                    if (typeof thisArticle.data('1025-1366') !== 'undefined' && thisArticle.data('1025-1366') !== false) {
                        smallLaptop = thisArticle.data('1025-1366');
                    }
                    if (typeof thisArticle.data('769-1024') !== 'undefined' && thisArticle.data('769-1024') !== false) {
                        ipadLandscape = thisArticle.data('769-1024');
                    }
                    if (typeof thisArticle.data('681-768') !== 'undefined' && thisArticle.data('681-768') !== false) {
                        ipadPortrait = thisArticle.data('681-768');
                    }
                    if (typeof thisArticle.data('680') !== 'undefined' && thisArticle.data('680') !== false) {
                        mobileLandscape = thisArticle.data('680');
                    }

                    if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

                        if(largeLaptop.length) {
                            responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.qodef-pl-standard-small-images ."+itemClass+" { padding: "+largeLaptop+" !important; } }";
                        }
                        if(smallLaptop.length) {
                            responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.qodef-pl-standard-small-images ."+itemClass+" { padding: "+smallLaptop+" !important; } }";
                        }
                        if(ipadLandscape.length) {
                            responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.qodef-pl-standard-small-images ."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
                        }
                        if(ipadPortrait.length) {
                            responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.qodef-pl-standard-small-images ."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
                        }
                        if(mobileLandscape.length) {
                            responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-pl-standard-small-images ."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
                        }
                    }

                    if(responsiveStyle.length) {
                        style = '<style type="text/css">'+responsiveStyle+'</style>';
                    }

                    if(style.length) {
                        $('head').append(style);
                    }

                    thisPortList.addClass('qodef-visible');
                });
            });
        }
    }

    /**
     * Initializes portfolio list article animation
     */
    function qodefInitPortfolioListAnimation(){
        var portList = $('.qodef-portfolio-list-holder.qodef-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisList = $(this),
                    articles = thisList.find('article');

                articles.each(function (i) {
                    var item = $(this).find('.qodef-pli-image');

                    item.css('transition-delay', i*100+'ms');
                });

                articles.appear(function(){
                    var article = $(this);

                    article
                        .addClass('qodef-item-show')
                        .one(qodef.transitionEnd, function(){
                            article.addClass('qodef-item-shown');
                        })
                })
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function qodefInitPortfolioFilter(){
        var filterHolder = $('.qodef-portfolio-list-holder .qodef-pl-filter-holder.qodef-pl-regular-filter');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.qodef-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.qodef-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('qodef-pl-pag-load-more') ? true : false,
                    parentCategories = thisFilterHolder.find('.parent-filter'),
                    children = thisFilterHolder.find('.qodef-pl-filter-child-categories');

                parentCategories.on('click', function(){
                    var activeParent = $(this);
                    var parentId = activeParent.data('group-id');

                    children.each(function() {
                        if(parentId == -1) {
                            $(this).fadeOut();
                        }
                        else if($(this).data('parent-id') == parentId) {
                            $(this).fadeIn();
                        }
                        else {
                            $(this).fadeOut();
                        }
                    });
                });

                thisFilterHolder.find('.qodef-pl-filter:first').addClass('qodef-pl-current');
	            
	            if(thisPortListHolder.hasClass('qodef-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.qodef-pl-filter').on('click', function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false,
                        filterClasses = filterClassName.split(', .');

                    $.each(filterClasses, function(i, value){
                        if (thisPortListInner.children().hasClass(value)) {
                            portListHasArticles = true;
                            return;
                        }
                    });

                    thisFilter.parent().children('.qodef-pl-filter').removeClass('qodef-pl-current');
                    thisFilter.addClass('qodef-pl-current');
	
	                if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
		                qodefInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
	                } else {
		                filterValue = filterValue.length === 0 ? '*' : filterValue;
                   
                        thisFilterHolder.parent().children('.qodef-pl-inner').isotope({ filter: filterValue });
	                    qodef.modules.common.qodefInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function qodefInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.qodef-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'diefinnhutte_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.qodef-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('qodef-showing qodef-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: qodefGlobalVars.vars.qodefAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);
                        var filterClasses = filterClassName.split(', .');

                        $.each(filterClasses, function(i, value){
                            if (!!thisPortListInner.children().hasClass(value)) {
                                portListHasArticles = true;
                                return;
                            }
                        });

                        if(portListHasArticles) {
                            setTimeout(function() {
	                            qodef.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.qodef-masonry-grid-sizer').width(), true);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('qodef-showing qodef-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    qodefInitPortfolioListAnimation();
	                                qodef.modules.common.qodefInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('qodef-showing qodef-filter-trigger');
                            qodefInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }

    function qodefInitPortfolioVerticalItemShowcase() {
        var portList = $('.qodef-pl-vertical-showcase');

        if (portList.length) {
            portList.each(function () {
                var holder = $(this),
                    item = holder.find('.qodef-pl-item'),
                    backgroundImagesHolder = holder.find('.qodef-pl-showcase-right'),
                    backgroundImages = backgroundImagesHolder.find('.qodef-pli-image'),
                    indexCounterImg = 0,
                    indexCounterItem = 0;

                backgroundImages.each(function() {
                    $(this).attr('img-index', indexCounterImg);
                    $(this).data('img-index', indexCounterImg);
                    indexCounterImg++;
                });

                item.each(function() {
                    $(this).attr('item-index', indexCounterItem);
                    $(this).data('item-index', indexCounterItem);
                    indexCounterItem++;
                });
            });
        }
    }

    /*
    * Init Element in View
    */
    function qodefElementInView(element) {
        var checkView = function() {
            if (qodef.scroll > element.offset().top - (0.67 * qodef.windowHeight) && qodef.scroll < element.offset().top + element.height()) {
                if (!element.hasClass('qodef-in-view')) {
                    element.addClass('qodef-in-view');
                }
            } else {
                if (element.hasClass('qodef-in-view')) {
                    element.removeClass('qodef-in-view');
                }
            }
        }

        $(window).scroll(function(){
            checkView();
        });

        checkView();
    }

    /**
     * Dynamic Background Color
     */
    function qodefDynamicBackgroundColor() {
        var Intances = $('.qodef-pl-showcase-right .qodef-pli-image');

        if (Intances.length) {
            var leftHolder =  $('.qodef-pl-showcase-left'),
                scrollBuffer = qodef.scroll,
                scrollingDown = true,
                currentScroll, instancesInView, activeEl, currentIndex;

            Intances.each(function() {
                var thisInstance = $(this);
                thisInstance.appear(function () {
                    thisInstance.addClass('qodef-appeared');
                });
            });

            //add bgrnd divs
            Intances.each(function(){
                qodefElementInView($(this));
            });

            //calculate scroll direction
            var scrollDirection = function() {
                currentScroll = qodef.scroll;

                if (currentScroll > scrollBuffer){
                    scrollingDown = true;
                } else {
                    scrollingDown = false;
                }
                scrollBuffer = currentScroll;
            };

            Intances.filter('.qodef-in-view').addClass('qodef-active');
            //colors change logic
            $(window).on('scroll', function() {
                scrollDirection();
                instancesInView = Intances.filter('.qodef-in-view');

                if (instancesInView.length) {
                    leftHolder.find('article').css({"opacity": "0", "z-index": "100"});
                    instancesInView.removeClass('qodef-active');

                    if (scrollingDown) {
                        activeEl = instancesInView.last();
                    } else {
                        activeEl = instancesInView.first();
                    }

                    activeEl.addClass('qodef-active');
                    currentIndex = activeEl.data('img-index');
                    leftHolder.find('article[item-index="'+ currentIndex +'"]').css({"opacity": "1", "z-index": "2002"});
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function
	qodefInitPortfolioPagination(){
		var portList = $('.qodef-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.qodef-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.qodef-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisPortList.hasClass('qodef-pl-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.qodef-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
				thisPortList.addClass('qodef-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.qodef-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages === 0){
				if(thisPortList.hasClass('qodef-pl-pag-standard')) {
					loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
					thisPortList.addClass('qodef-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('qodef-showing');
				}
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'diefinnhutte_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('qodef-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							qodefInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('qodef-pl-masonry')){
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter')) {
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									qodefInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('qodef-pl-masonry')){
								    if(pagedLink === 1) {
                                        qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        qodefInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
								} else if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter') && pagedLink !== 1) {
									qodefInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
								    if (pagedLink === 1) {
                                        qodefInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        qodefInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                    }
								}
							});
						}
						
						if(thisPortList.hasClass('qodef-pl-infinite-scroll-started')) {
							thisPortList.removeClass('qodef-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.qodef-pl-load-more-holder').hide();
			}
		};
		
		var qodefInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.qodef-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.qodef-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.qodef-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.qodef-pag-next a');
			
			standardPagNumericItem.removeClass('qodef-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('qodef-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var qodefInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
			qodef.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.qodef-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPortfolioListAnimation();
				qodef.modules.common.qodefInitParallax();
				qodef.modules.common.qodefPrettyPhoto();
			}, 1000);
		};
		
		var qodefInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			qodefInitPortfolioListAnimation();
			qodef.modules.common.qodefInitParallax();
			qodef.modules.common.qodefPrettyPhoto();
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
			qodef.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.qodef-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPortfolioListAnimation();
				qodef.modules.common.qodefInitParallax();
				qodef.modules.common.qodefPrettyPhoto();
			}, 1000);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisPortListInner.append(responseHtml);
			qodefInitPortfolioListAnimation();
			qodef.modules.common.qodefInitParallax();
			qodef.modules.common.qodefPrettyPhoto();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
            getMainPagFunction: function(thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
		};
	}

    function qodefInitPortfolioJustifiedGallery(){
        var portfolioJustifiedLists = $('.qodef-portfolio-list-holder.qodef-pl-justified-gallery ');

        if(portfolioJustifiedLists.length){
            portfolioJustifiedLists.each(function(){
                var portfolioJustifiedList = $(this),
                    spacing = typeof portfolioJustifiedList.data('space-value') !== 'undefined' ? portfolioJustifiedList.data('space-value') : 60,
                    rowHeight = typeof portfolioJustifiedList.data('row-height') !== 'undefined' ? portfolioJustifiedList.data('row-height') : 200,
                    lastRow = typeof portfolioJustifiedList.data('last-row') !== 'undefined' ? portfolioJustifiedList.data('last-row') : 'nojustify',
                    justifyThreshold = typeof portfolioJustifiedList.data('justify-threshold') !== 'undefined' ? portfolioJustifiedList.data('justify-threshold') : 0.75;

                if(qodef.windowWidth > 1024 && qodef.windowWidth < 1300 && rowHeight > 300) {
                    rowHeight = 300;
                }
                var thisPortfolioJustifiedListChildren = portfolioJustifiedList.children('.qodef-pl-inner');
                thisPortfolioJustifiedListChildren.waitForImages(function() {
                    thisPortfolioJustifiedListChildren.justifiedGallery({
                        captions: false,
                        rowHeight: rowHeight,
                        margins: spacing,
                        border: 0,
                        lastRow: lastRow,
                        justifyThreshold: justifyThreshold,
                        selector: '> article'
                    }).on('jg.complete jg.rowflush', function() {
                        var deducted = false;
                        portfolioJustifiedList.find('article').addClass('show').each(function() {
                            $(this).height(Math.round($(this).height()));
                            if (!deducted && $(this).width() == 0) {
                                portfolioJustifiedList.height(portfolioJustifiedList.height() - $(this).height() - spacing);
                                deducted = true;
                            }
                        });
                        portfolioJustifiedList.css('opacity', '1');
                    });
                    initPortfolioJustifiedGalleryFilter(portfolioJustifiedList, thisPortfolioJustifiedListChildren, false);
                });
            });
        }
    }

    function initPortfolioJustifiedGalleryFilter(portfolioJustifiedList, portfolioJustifiedListChildren, loadMore){
        if (portfolioJustifiedList.hasClass('qodef-pl-has-filter')) {
            var filterHolder = portfolioJustifiedList.find('.qodef-pl-filter-holder.qodef-pl-justified-filter'),
                filterItems = filterHolder.find('li'),
                parentCategories = filterHolder.find('.parent-filter'),
                children = filterHolder.find('.qodef-pl-filter-child-categories');

            var currentItem;
            if (parentCategories.length) {
                parentCategories.each(function () {
                    if ($(this).hasClass('qodef-pl-current')) {
                        currentItem = $(this);
                    }
                })
            }

            parentCategories.on('click', function(){
                var activeParent = $(this);
                var parentId = activeParent.data('group-id');

                children.each(function() {
                    if(parentId == -1) {
                        $(this).fadeOut();
                    }
                    else if($(this).data('parent-id') == parentId) {
                        $(this).fadeIn();
                    }
                    else {
                        $(this).fadeOut();
                    }
                });
            });

            if (typeof (currentItem) !== 'undefined') {
                //filter items after ajax pagination call
                qodefPortfolioFilterJustifiedGallery(portfolioJustifiedList, portfolioJustifiedListChildren, filterItems, currentItem, loadMore);
            } else {
                //filter items initially
                parentCategories.first().addClass('qodef-pl-current');
            }

            //filter articles on click event
            filterHolder.find('li').on('click', function () {
                qodefPortfolioFilterJustifiedGallery(portfolioJustifiedList, portfolioJustifiedListChildren, filterItems, $(this), false);
            });
        }
    }

    function qodefPortfolioFilterJustifiedGallery(portfolioJustifiedList, portfolioJustifiedListChildren, filterItems, filterItem, loadMore){

        var selector = filterItem.attr('data-filter'),
            articles = portfolioJustifiedListChildren.find('article'),
            hasLoadMore = !!portfolioJustifiedList.is('.qodef-pl-pag-load-more, .qodef-pl-pag-infinite-scroll'),
            hasStandard = !!portfolioJustifiedList.is('.qodef-pl-pag-standard');

        portfolioJustifiedListChildren.removeClass('qodef-no-elements');
        var transitionDuration = 200;

        if(loadMore && selector !== '') {
            articles.not(selector).css({
                'opacity': '0'
            });
        } else if(!loadMore && selector === '') {
            selector = '.qodef-pl-item';
            articles.css({
                'opacity': '0'
            });
        } else if(selector !== '') {
            articles.not(selector).css({
                'opacity': '0'
            });
        }

        var selectorClassName = selector.substring(1),
            hasArticles = !!portfolioJustifiedListChildren.children().hasClass(selectorClassName);


        filterItems.removeClass("qodef-pl-current");
        filterItem.addClass("qodef-pl-current");

        if(hasStandard && !hasArticles) {
            portfolioJustifiedListChildren.addClass('qodef-no-elements');
        }
        else if(hasLoadMore && !hasArticles) {
            qodefInitLoadMoreItemsPortfolioJustifiedFilter(portfolioJustifiedList, portfolioJustifiedListChildren, selector, selectorClassName);
        } else {
            setTimeout(function () {
                articles.filter(selector).css({
                    'opacity': ''
                });
                var spacing = typeof portfolioJustifiedList.data('space-value') !== 'undefined' ? portfolioJustifiedList.data('space-value') : 60,
                    rowHeight = typeof portfolioJustifiedList.data('row-height') !== 'undefined' ? portfolioJustifiedList.data('row-height') : 200,
                    lastRow = typeof portfolioJustifiedList.data('last-row') !== 'undefined' ? portfolioJustifiedList.data('last-row') : 'nojustify',
                    justifyThreshold = typeof portfolioJustifiedList.data('justify-threshold') !== 'undefined' ? portfolioJustifiedList.data('justify-threshold') : 0.75;
                if(qodef.windowWidth > 1024 && qodef.windowWidth < 1300 && rowHeight > 220) {
                    rowHeight = 220;
                }
                portfolioJustifiedListChildren.css('transition', 'height ' + transitionDuration + 'ms ease').justifiedGallery({
                    selector: '> article' + (selector ? selector : ''),
                    rowHeight: rowHeight,
                    margins: spacing,
                    lastRow: lastRow,
                    justifyThreshold: justifyThreshold
                });
            }, 1.1 * transitionDuration);

            setTimeout(function () {
                articles.css('opacity', '');
                portfolioJustifiedListChildren.css('transition', '');
            }, 2.2 * transitionDuration);

            return false;
        }
    }

    function qodefInitLoadMoreItemsPortfolioJustifiedFilter(portfolioJustifiedList, portfolioJustifiedListChildren, selector, selectorClassName){

        var maxNumPages = 0;

        if (typeof portfolioJustifiedList.data('max-num-pages') !== 'undefined' && portfolioJustifiedList.data('max-num-pages') !== false) {
            maxNumPages = portfolioJustifiedList.data('max-num-pages');
        }

        var	loadMoreData = qodef.modules.common.getLoadMoreData(portfolioJustifiedList),
            nextPage = loadMoreData.nextPage,
            ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreData, 'qodef_core_portfolio_ajax_load_more'),
            loadingItem = portfolioJustifiedList.find('.qodef-sp-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('qodef-showing qodef-filter-trigger');
            portfolioJustifiedListChildren.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: qodefGlobalVars.vars.qodefAjaxUrl,
                success: function (data) {
                    nextPage++;
                    portfolioJustifiedList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    portfolioJustifiedListChildren.append(responseHtml);
                    portfolioJustifiedListChildren.waitForImages(function() {
                        portfolioJustifiedListChildren.justifiedGallery('norewind');
                    });

                    var hasArticles = !!portfolioJustifiedListChildren.children().hasClass(selectorClassName);

                    if(hasArticles) {
                        setTimeout(function() {
                            initPortfolioJustifiedGalleryFilter(portfolioJustifiedList, portfolioJustifiedListChildren, false);
                            loadingItem.removeClass('qodef-showing qodef-filter-trigger');

                            setTimeout(function() {
                                portfolioJustifiedListChildren.css('opacity', '1');
                                qodefInitPortfolioListAnimation();
                                qodef.modules.common.qodefInitParallax();
                            }, 150);
                        }, 400);
                    } else {
                        loadingItem.removeClass('qodef-showing qodef-filter-trigger');
                        qodefInitLoadMoreItemsPortfolioJustifiedFilter(portfolioJustifiedList, portfolioJustifiedListChildren, selector, selectorClassName);
                    }
                }
            });
        }
    }

})(jQuery);
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