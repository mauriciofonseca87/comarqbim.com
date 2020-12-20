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