<?php
class Harriswebworks_Ajaxcart_Block_Customer_Wishlist_Item_Column_Cart extends Mage_Wishlist_Block_Customer_Wishlist_Item_Column_Cart
{
// some code
 public function getJs()
    {
        $js = "
            function addWItemToCart(itemId) {
                var url = '" . $this->getItemAddToCartUrl('%item%') . "';
                url = url.gsub('%item%', itemId);
                var form = $('wishlist-view-form');
                if (form) {
                    var input = form['qty[' + itemId + ']'];
                    if (input) {
                        var separator = (url.indexOf('?') >= 0) ? '&' : '?';
                        url += separator + input.name + '=' + encodeURIComponent(input.value);
                    }
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
                                if(jQuery('.toplinksitems .links')){
                                    jQuery('.toplinksitems .links').replaceWith(data.toplink);
                                }
								jQuery('.toplinksitems .ajaxcart .message').show();
								if(jQuery('body').hasClass('fixed-menu')){
									
									jQuery('html, body').animate({scrollTop: jQuery('.toplinksitems').offset().top  }, 1000);
								}
								jQuery('.toplinksitems .block-cart').addClass('slidedown');
								//jQuery('#item_'+itemId).fadeOut('slow');
								jQuery('#item_'+itemId).remove();
								  var n = jQuery('#wishlist-table tbody tr').length;
								  if(!(n>0)){
									  var replacetext = '<p class=\"wishlist-empty\">You have no items in your wishlist.</p>';
									  jQuery('#wishlist-table').replaceWith(replacetext);
									  jQuery('#wishlist-view-form .buttons-set').html('');
									  }
								setTimeout(function() {jQuery('.toplinksitems .ajaxcart .message').fadeOut('slow'); }, 5000);
								//jQuery('.top_link .block-cart').slideToggle('slow');
								
                          }
                    });
                } catch (e) {
                }
			   
            }
        ";

       // $js .= parent::getJs();
        return $js;
    }
}