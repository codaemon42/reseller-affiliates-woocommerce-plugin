(function($) {
    
    setInterval(()=>{
        $('.woocommerce-checkout-review-order-table').hide();
        console.log('increasing');
    },500)
    
    //$('.order-total .woocommerce-Price-amount').click
    var length = ($('#resell-content .resell_section').length);
    var i;
    var cartAmount = 1;
    var cartPrice = 0;
    var CartTotal = 0;
    var subTotal = 0;
    $('#resell').click(function(){
    for (i = 1; i <= length; i++){

            //alert('#resell'+i);
            //var shipping = $('.woocommerce-shipping-totals  .amount').text();
            var shipping = $('#shipping_method .amount').text();//different for one page checkout plugin
            //console.log("shipping: "+shipping);
            var shippingPrice = parseInt(shipping.substring(2,shipping.length));
            console.log("shippingprice: "+shippingPrice);
            cartAmount = $('#resell_cart_quantity'+i).val();
                console.log('cartAmount'+i+': '+cartAmount);
            cartPrice = parseInt($('#resell_price'+i).val());
                console.log('cartPrice'+i+': '+cartPrice);
            cartTotal = cartAmount*cartPrice;
                console.log('cartTotal'+i+': '+cartTotal);
            subTotal += (cartAmount*cartPrice);
                console.log('subTotal: '+subTotal);
             var total =  subTotal + shippingPrice ;
             console.log('total: '+total);
            // $('.cart-subtotal .amount').text(subTotal);
            $('.resell_shipping_total_price').text(shippingPrice);
                console.log('shippingPrice:'+ shippingPrice);
             $('.resell_sub_total_price').text(subTotal);
             $('.order-total .amount').text(total);
             $('.resell_total_price').text(total);
            // console.log($.type($('#resell_price'+i).val()));
        }
        cartAmount = 1;
        cartPrice = 0;
        CartTotal = 0;
        subTotal = 0;
    });

    $('#resell-menu').click(function(){
        var reseller_url_id = $(".affiliates-dashboard-overview-link code").text();
        console.log(reseller_url_id);
        console.log(local_reseller.shop_url);
        window.location.href = local_reseller.shop_url+"/"+reseller_url_id;
    });
    //console.log("test");
    // $('#resell_clear').click(function(){
    //     var shipping = $('.woocommerce-shipping-totals  .amount').text();
    //     var shippingPrice = parseInt(shipping.substring(1,shipping.length));
    //     $('.cart-subtotal .amount').text($('#resell_price').val());
    //     var cartPrice = parseInt($('#resell_price').val());
    //     var total =  cartPrice + shippingPrice ;
    //     $('.order-total .amount').text(total);
    //     $('.resell_sub_total_price').text(total);
    //     console.log($.type($('#resell_price').val()));
    // });

    // .woocommerce-checkout-review-order-table{
    //     display: none;
    // }

  })( jQuery );