jQuery.noConflict();
jQuery(document).ready(function($){
	$('.toplinksitems').on('click','.top-link-cart',function() {
		if(!jQuery('.toplinksitems .ajaxcart').hasClass('slidedown')){
			$(".toplinksitems  .block").not(".toplinksitems  .ajaxcart").removeClass('slidedown');
			jQuery('.toplinksitems .ajaxcart').css('display','block');
			jQuery('.toplinksitems .ajaxcart').addClass('slidedown');
			return false;
		}else{
			jQuery('.toplinksitems .ajaxcart').removeClass('slidedown').delay(600).fadeOut('slow');
			return false;
		}
	});
	$('.carticon').on('click',function() {
		$('.toplinksitems .top-link-cart').trigger('click');
		$('html, body').animate({scrollTop: $(".toplinksitems").offset().top  }, 1000);
	});
	$('.toplinksitems').on('click', ".closecart",function() {
		jQuery('.toplinksitems .ajaxcart').removeClass('slidedown').delay(600).fadeOut('slow');
	});
	$('.toplinksitems').on('click','a.topwishlista',function(event) {
		if(!($('.toplinksitems .ajaxwishlist').length>0))
		return true;
		event.preventDefault();
		
		//console.log(jQuery('.toplinksitems .ajaxwishlist').hasClass('slidedown'));
		if(!(jQuery('.toplinksitems .ajaxwishlist').hasClass('slidedown'))){
			
			$(".toplinksitems  .block").not(".toplinksitems  .ajaxwishlist").removeClass('slidedown');
			jQuery('.toplinksitems .ajaxwishlist').css('display','block');
			jQuery('.toplinksitems .ajaxwishlist').addClass('slidedown');
			
			return false;
		}else{
			jQuery('.toplinksitems .ajaxwishlist').removeClass('slidedown').delay(600).fadeOut('slow');
			//console.log(jQuery('.toplinksitems .ajaxwishlist'+1).hasClass('slidedown'));
			return false;
		}
		return false;
	});
	$('.toplinksitems').on('click', ".closewishlist",function() {
		jQuery('.toplinksitems .ajaxwishlist').removeClass('slidedown').delay(600).fadeOut('slow');
	});
	
	$('.category-products .link-wishlist').click(function (e) {
 			e.preventDefault();
 			if($('.a-login').length){
 				window.location.replace($('.a-login').attr('href'));
 				return false;
 			}
 			var acturl = $(this).attr('href');
			var surl = acturl.replace("wishlist/index/add", "ajax/index/addwish");
 			$(this).addClass('wishlistwait');
 			try {
             jQuery.ajax( {
                 url : surl,
                 dataType : 'json',
                 success : function(data) {
					
 					if(data.status=="ERROR"){
						//alert(data.message);
						$('.a-login').trigger('click');
 					}else{
 						if(jQuery('.toplinksitems .links')){
                                     jQuery('.toplinksitems .links').replaceWith(data.toplink);
                            }
 						   if(jQuery('.toplinksitems .block-wishlist')){
                                     jQuery('.toplinksitems .block-wishlist').replaceWith(data.sidebar);
 									 jQuery('.toplinksitems .block-wishlist').addClass('blink');
                            }
							jQuery('.ajaxwishlist .ajaxsuccessmsg').html(data.message);
								jQuery('.toplinksitems .ajaxwishlist .message').show();
								if(jQuery('body').hasClass('fixed-menu')){
									jQuery('html, body').animate({scrollTop: jQuery(".toplinksitems").offset().top  }, 1000);
								}
								jQuery('.toplinksitems .block-wishlist').addClass('slidedown');
								setTimeout(function() {jQuery('.toplinksitems .ajaxwishlist .message').fadeOut('slow'); }, 5000);
							//$('.wishlistsuccess').center();
							//jQuery('.witem').html(data.message);
							//jQuery('.wishlistsuccess').addClass('slidedown');
 					}
 					
 					$('.link-wishlist').removeClass('wishlistwait');
 					
 					//console.log(data);
 					setTimeout(function () {
                             jQuery('.sidebar .block-wishlist').removeClass('blink');
							 jQuery('.wishlistsuccess').removeClass('slidedown');
                         }, 5000);
                   // jQuery('#ajax_loader'+id).hide();
                     //setAjaxData(data,false);          
                 }
             });
         } catch (e) {
        }
			
 			return  false;
	  
         });
		 $('.closesuccess').click(function () {
			  jQuery('.wishlistsuccess').removeClass('slidedown');
		 });	
		//Add product from category listing to cart 
        $('.category-products .btn-cart').click(function () {
            var formaction = $(this).parent('form').attr('action');
            var quantity = $(this).parent('form').find('.qty').val();
//  e.preventDefault();
// alert(quantity+formaction);
            var btncl = $(this);
            if (quantity < 1)
                return false;
            btncl.addClass('wait');
            btncl.find('.ajax_loader').show();

            url = formaction.replace("checkout/cart", "ajax/index"); // New Code
            var data = $(this).parent('form').serialize();
            data += '&isAjax=1';
            jQuery('#ajax_loader').show();
            try {
                jQuery.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'post',
                    data: data,
                    success: function (data) {
                        // jQuery('#ajax_loader').hide();
                        btncl.find('.ajax_loader').hide();
                        // alert(data.status + ": " + data.message);
                        if (jQuery('.toplinksitems .block-cart')) {
                            jQuery('.toplinksitems .block-cart').replaceWith(data.sidebar);
                        }
                        //console.log(data.toplink);
                        if (jQuery('.toplinksitems .links')) {
                            jQuery('.toplinksitems .links').replaceWith(data.toplink);
                        }
                        jQuery('.toplinksitems .ajaxcart .message').show();
                        if (jQuery('body').hasClass('fixed-menu')) {

                            jQuery('html, body').animate({scrollTop: jQuery(".toplinksitems").offset().top}, 1000);
                        }
                        jQuery('.toplinksitems .block-cart').addClass('slidedown');
                        btncl.removeClass('wait');
                        setTimeout(function () {
                            jQuery('.toplinksitems .ajaxcart .message').fadeOut('slow');
                        }, 5000);
                        //jQuery('.top_link .block-cart').slideToggle('slow');
                        /*if (button && button != 'undefined') {
                         button.disabled = false;
                         }*/
                    }
                });
            } catch (e) {
            }

            return  false;

        });
	//add wishlist item on product page
	$('.product-view .link-wishlist').click(function (e) {
			e.preventDefault();
			if($('.a-login').length){
				window.location.replace($('.a-login').attr('href'));
				return false;
			}
			var acturl = $(this).attr('href');
			var surl = acturl.replace("wishlist/index/add", "ajax/index/addwish");
			$(this).addClass('wishlistwait');
			try {
            jQuery.ajax( {
                url : surl,
                dataType : 'json',
                success : function(data) {
					if(data.status=="ERROR"){
						alert(data.message);
					}else{
						if(jQuery('.toplinksitems .links')){
                             jQuery('.toplinksitems .links').replaceWith(data.toplink);
                        }
						jQuery('.toplinksitems .ajaxwishlist .ajaxsuccessmsg').html(data.message);
						jQuery('.toplinksitems .ajaxwishlist .message').show();
						if(jQuery('.toplinksitems .block-wishlist')){
                            jQuery('.toplinksitems .block-wishlist').replaceWith(data.sidebar);
							jQuery('.toplinksitems .block-wishlist').addClass('slidedown');
                         }
					}
					$('.product-view .link-wishlist').removeClass('wishlistwait');
					 if (jQuery('body').hasClass('fixed-menu')) {

                            jQuery('html, body').animate({scrollTop: jQuery(".toplinksitems").offset().top}, 1000);
                        }
					setTimeout(function() {jQuery('.toplinksitems .ajaxwishlist .message').fadeOut('slow'); }, 5000);
					//console.log(data);
					//setTimeout(function () {
                            //jQuery('.sidebar .block-wishlist').removeClass('blink');
                       // }, 5000);
                   // jQuery('#ajax_loader'+id).hide();
                    //setAjaxData(data,false);          
                }
            });
        } catch (e) {
        }
			
			return  false;

        });
	//Remove single wishlist item from cart
	$('.toplinksitems').on('click','.ajaxwishlist .mini-products-list .btn-remove',function() {
		$(this).parents('li.item').addClass('dim');
		var formaction = $(this).attr('href');
		//$(this).parents('li.item').addClass('dim');
		 url = formaction.replace("wishlist/index/remove","ajax/index/removewishlist");
		 data = 'isAjax=1'; 
		  try {
                    jQuery.ajax({
                          url: url,
                          dataType: 'json',
                          type : 'post',
                          data: data,
                          success: function(data){
							    if(jQuery('.toplinksitems .block-wishlist')){
                                    jQuery('.toplinksitems .block-wishlist').replaceWith(data.sidebar);
                                }
                                if(jQuery('.toplinksitems .links')){
                                    jQuery('.toplinksitems .links').replaceWith(data.toplink);
                                }
								jQuery('.toplinksitems .ajaxwishlist .ajaxsuccessmsg').html(data.message);
								jQuery('.toplinksitems .ajaxwishlist .message').show();
								/*if(jQuery('body').hasClass('fixed-menu')){
									jQuery('html, body').animate({scrollTop: jQuery(".toplinksitems").offset().top  }, 1000);
								}*/
								jQuery('.toplinksitems .block-wishlist').addClass('slidedown');
								setTimeout(function() {jQuery('.toplinksitems .ajaxwishlist .message').fadeOut('slow'); }, 5000);
                          }
                    });
                } catch (e) {
					
                }
        		return  false;  
	});
	
	//Add single wishlist Items to cart
	$('.toplinksitems').on('click','.ajaxwishlist .mini-products-list .wishlistminicart',function() {	
		var url = $(this).attr('data-url');
		var id = $(this).parent('.product-details').attr('id');
		itemId =parseInt(id);
        url = url.gsub('%item%', itemId);
		var block = $('#'+id);
		var qty = block.find('.qty').val();
		var qtyname = block.find('.qty').attr('name');
		 
		if (qty) {
			var separator = (url.indexOf('?') >= 0) ? '&' : '?';
		 	url += separator + qtyname + '=' + encodeURIComponent(qty);
		}
               // setLocation(url);
			   url = url.replace('wishlist/index','ajax/index'); // New Code
               // var data = jQuery('#wishlist-view-form').serialize();
			    var data ='';
                data += '&isAjax=1';   
				var btncl = $(this);
           
            btncl.addClass('wait');
            btncl.find('.ajax_loader').show();
                jQuery('#ajax_loader').show();
				
                try {
                    jQuery.ajax({
                          url: url,
                          dataType: 'json',
                          type : 'post',
                          data: data,
                          success: function(data){
                                jQuery('#ajax_loader').hide();
								 btncl.find('.ajax_loader').hide();
                               // alert(data.status + ': ' + data.message);
							   if(jQuery('.toplinksitems .block-cart')){
                                    jQuery('.toplinksitems .block-wishlist').replaceWith(data.wishlist);
                                }
								
							    if(jQuery('.toplinksitems .block-cart')){
                                    jQuery('.toplinksitems .block-cart').replaceWith(data.sidebar);
                                }
								//console.log(data.toplink);
                                if(jQuery('.toplinksitems .links')){
                                    jQuery('.toplinksitems .links').replaceWith(data.toplink);
                                }
								jQuery('.toplinksitems .ajaxcart .message').show();
								if(jQuery('body').hasClass('fixed-menu')){
									
									jQuery('html, body').animate({scrollTop: jQuery('.toplinksitems').offset().top  }, 1000);
								}
								jQuery('.toplinksitems .block-wishlist').removeClass('slidedown');
								jQuery('.toplinksitems .block-cart').addClass('slidedown');
								//jQuery('#item_'+itemId).fadeOut('slow');
								
								
								setTimeout(function() {jQuery('.toplinksitems .ajaxcart .message').fadeOut('slow'); }, 5000);
								//jQuery('.top_link .block-cart').slideToggle('slow');
								
                          }
                    });
                } catch (e) {
                }
		
		return false;
	});
	//Add all wishlist Items to cart
	$('.toplinksitems').on('click','.ajaxwishlist .miniwishlink',function(event) {	
		event.preventDefault();
		var i =[];
		jQuery('.ajaxwishlist #wishlist-sidebar > li').each(function (index){
                var idxStr = jQuery(this).find('input.qty').attr('name');
                var idx = idxStr.replace( /[^\d.]/g, '' );
				var qval = jQuery(this).find('input.qty').val();
				var obj = {};
   				obj[idx] = qval;
   				i.push(obj);
         });
		var wishlist_id = $('#ajax_wishlist_id').val();
         // console.log(JSON.stringify(i));
		  
		  var url = $(this).attr('data-url');
		
		if (wishlist_id) {
			var separator = (url.indexOf('?') >= 0) ? '&' : '?';
		 	url += separator + 'wishlist_id' + '=' + encodeURIComponent(wishlist_id);
			url += '&qty' + '=' + encodeURIComponent(JSON.stringify(i));
		}
               // setLocation(url);
			   url = url.replace('wishlist/index','ajax/index'); // New Code
               // var data = jQuery('#wishlist-view-form').serialize();
			    var data ='';
                data += '&isAjax=1';   
                jQuery('#ajax_loader').show();
				
                try {
                    jQuery.ajax({
                          url: url,
                          dataType: 'json',
                          type : 'post',
                          data: data,
                          success: function(data){
                                jQuery('#ajax_loader').hide();
								
                               // alert(data.status + ': ' + data.message);
							   if(jQuery('.toplinksitems .block-cart')){
                                    jQuery('.toplinksitems .block-wishlist').replaceWith(data.wishlist);
                                }
								
							    if(jQuery('.toplinksitems .block-cart')){
                                    jQuery('.toplinksitems .block-cart').replaceWith(data.sidebar);
                                }
								//console.log(data.toplink);
								var toplinks = data.toplink;
								toplinks = toplinks.replace(/ *?\([^)]*\) */g, "");
								//toplinks = toplinks.replace(/\([^\)]+\)/, '(replaced)');
                                if(jQuery('.toplinksitems .links')){
                                    jQuery('.toplinksitems .links').replaceWith(toplinks);
                                }
								jQuery('.toplinksitems .ajaxcart .message .ajaxsuccessmsg').html(data.message)
								
								jQuery('.toplinksitems .ajaxcart .message').show();
								if(jQuery('body').hasClass('fixed-menu')){
									
									jQuery('html, body').animate({scrollTop: jQuery('.toplinksitems').offset().top  }, 1000);
								}
								jQuery('.toplinksitems .block-wishlist').removeClass('slidedown');
								jQuery('.toplinksitems .block-cart').addClass('slidedown');
								//jQuery('#item_'+itemId).fadeOut('slow');
								
								
								setTimeout(function() {jQuery('.toplinksitems .ajaxcart .message').fadeOut('slow'); }, 5000);
								//jQuery('.top_link .block-cart').slideToggle('slow');
								
                          }
                    });
                } catch (e) {
                }
		  
		return false;
	});
	
	
	
});