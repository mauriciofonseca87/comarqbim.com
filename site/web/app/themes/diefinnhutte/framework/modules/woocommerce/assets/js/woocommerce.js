(function($) {
    'use strict';

    var woocommerce = {};
    qodef.modules.woocommerce = woocommerce;

    woocommerce.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitQuantityButtons();
        qodefInitSelect2();
	    qodefInitSingleProductLightbox();
        qodefInitProductListFilter().init();
    }

    function qodefInitProductListFilter(){
        var productList = $('.qodef-pl-holder');
        var queryParams = {};

        var initFilterClick = function(thisProductList){
            var links = thisProductList.find('.qodef-pl-categories a, .eltdf-pl-ordering a');

            links.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var clickedLink = $(this);
                if(!clickedLink.hasClass('active')) {
                    initMainPagFunctionality(thisProductList, clickedLink);
                }
            });
        }

        //used for replacing content after ajax call
        var qodefReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.html(responseHtml);
            loader.fadeOut();
            thisProductListInner.removeClass('qodef-ajax-loading');
        };

        //used for replacing content after ajax call
        var qodefReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.find('.qodef-pli').remove();

            thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            setTimeout(function() {
                thisProductListInner.isotope('layout');
                loader.fadeOut();
            }, 400);
        };

        //used for storing parameters in global object
            var qodefReturnOrderingParemeters = function(queryParams, data){

            for (var key in data) {
                queryParams[key] = data[key];
            }

            //store ordering parameters
            // // switch(queryParams.ordering) {
            // //     case 'menu_order':
            // //         queryParams.metaKey = '';
            // //         queryParams.order = 'asc';
            // //         queryParams.orderby = 'menu_order title';
            // //         break;
            // //     case 'popularity':
            // //         queryParams.metaKey = 'total_sales';
            // //         queryParams.order = 'desc';
            // //         queryParams.orderby = 'meta_value_num';
            // //         break;
            // //     case 'rating':
            // //         queryParams.metaKey = '_wc_average_rating';
            // //         queryParams.order = 'desc';
            // //         queryParams.orderby = 'meta_value_num';
            // //         break;
            // //     case 'newness':
            // //         queryParams.metaKey = '';
            // //         queryParams.order = 'desc';
            // //         queryParams.orderby = 'date';
            // //         break;
            // //     case 'price':
            // //         queryParams.metaKey = '_price';
            // //         queryParams.order = 'asc';
            // //         queryParams.orderby = 'meta_value_num';
            // //         break;
            // //     case 'price-desc':
            // //         queryParams.metaKey = '_price';
            // //         queryParams.order = 'desc';
            // //         queryParams.orderby = 'meta_value_num';
            // //         break;
            // }

            return queryParams;
        };

        var initMainPagFunctionality = function(thisProductList, clickedLink){
            var thisProductListInner = thisProductList.find('.qodef-pl-outer');

            var loadData = qodef.modules.common.getLoadMoreData(thisProductList),
                loader = thisProductList.find('.qodef-prl-loading');

			var nonceHolder = thisProductList.find('input[name*="qodef_product_ajax_load_category_nonce_"]');

			loadData.product_ajax_load_category_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadData.product_ajax_load_category_nonce = nonceHolder.val();

            //store parameters in global object
            qodefReturnOrderingParemeters(queryParams, clickedLink.data());

            //set paremeters for new query passed through ajax
            loadData.category = queryParams.category !== undefined ? queryParams.category : '';
            loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';

            loader.fadeIn();
            thisProductListInner.addClass('qodef-ajax-loading');
            var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadData, 'qodef_product_ajax_load_category');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: qodefGlobalVars.vars.qodefAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data),
                        responseHtml =  response.html;

                    thisProductList.waitForImages(function(){
                        clickedLink.parent().siblings().find('a').removeClass('active');
                        clickedLink.addClass('active');
                        if(thisProductList.hasClass('qodef-masonry-layout')) {
                            qodefReplaceMasonryContent(thisProductListInner, loader, responseHtml);
                        }else{
                            qodefReplaceStandardContent(thisProductListInner, loader, responseHtml);
                        }
                    });

                }
            });
        }

        var initMobileFilterClick = function(cliked, holder){
            cliked.on('click',function(){
                if(qodef.windowWidth <= 768) {
                    if(!cliked.hasClass('opened')){
                        cliked.addClass('opened');
                        holder.slideDown();
                    }else{
                        cliked.removeClass('opened');
                        holder.slideUp();
                    }
                }
            });
        }

        return {
            init: function () {
                if (productList.length) {
                    productList.each(function () {
                        var thisProductList = $(this);
                        initFilterClick(thisProductList);

                        initMobileFilterClick(thisProductList.find('.qodef-pl-ordering-outer h6'), thisProductList.find('.qodef-pl-ordering'));
                        initMobileFilterClick(thisProductList.find('.qodef-pl-categories-label'),thisProductList.find('.qodef-pl-categories-label').next('ul'));
                    });
                }
            },

        }
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function qodefInitQuantityButtons() {
		$(document).on('click', '.qodef-quantity-minus, .qodef-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.qodef-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('qodef-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function qodefInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.qodef-woocommerce-page .qodef-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function qodefInitSingleProductLightbox() {
		var item = $('.qodef-woo-single-page.qodef-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof qodef.modules.common.qodefPrettyPhoto === "function") {
				qodef.modules.common.qodefPrettyPhoto();
			}
		}
	}

})(jQuery);