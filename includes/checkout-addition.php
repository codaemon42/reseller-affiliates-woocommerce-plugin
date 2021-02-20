<?php    
function ts_review_order_before_payment(){ 
        $cart = WC()->cart;
        $i=1;
        ?>
        <div id="resell-content">
        <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $product = $cart_item['data'];
                $product_id = $cart_item['product_id'];
                $quantity = $cart_item['quantity'];
                $price = WC()->cart->get_product_price( $product );
                $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
                $link = $product->get_permalink( $cart_item );
                // Anything related to $product, check $product tutorial
                $meta = wc_get_formatted_cart_item_data( $cart_item );
                $item = $cart_item['data'];
                //print_r($item);
                if(!empty($item)){
                    $product = new WC_product($item->id);
                    //$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
                    ?>
                    <div style="width:100%; float: left">
                        <div style="width:75px !important; height:75px !important; float:left; overflow:hidden: border-radius:10px; box-shadow: 8px 8px 10px #00000073; margin: 5px"> 
                            <?php echo $product->get_image(); ?>
                        </div>
                        <div>
                            <span style="margin-right:10px !important;float: right; color:#fff;font-weight:bold"><?php echo $product->name; ?></span><br>
                            <span style="margin-right:10px  !important;float: right; color:#fff">original price ( <?php echo get_woocommerce_currency_symbol();?>): <span style="font-size:18px;font-weight:bold;margin-left:10px"><?php echo  $product->price; ?></span></span>
                        </div>
                    </div>
                    <div class="resell_section">

                        <!-- <p>Selling Item</p> -->
                        <div class="reselling_price_div">
                            <label class='resell_label' for='resell_cart_quantity<?php echo $i ?>'>Quantity : </label>
                            <input type='number' id='resell_cart_quantity<?php echo $i ?>' name='resell_cart_quantity<?php echo $i ?>' value='1'><br>
                        </div>
                        <div class="reselling_price_div">
                            <label class='resell_label' for='resell_product_amount<?php echo $i ?>'>Selling Price : </label>
                            <input type='number' id='resell_price<?php echo $i ?>' name='resell_price<?php echo $i ?>' value="0">
                        </div>
                        <!-- <div class="reselling_price_div">
                            <input type='button' value='SET' id='resell<?php echo $i ?>'>
                        </div> -->
                        <!-- <p class='resell_sub_total'>Sub Total Price (<?php echo get_woocommerce_currency_symbol();?>) : <span class='resell_sub_total_price'>0</span></p>      -->

                    <!-- <input type='button' id='resell_clear' name='resell_clear' class='re_btn_clear' value='CLEAR'> -->
                    </div>
                    <?php
                    $i++;
                        
                    // to display only the first product image uncomment the line bellow
                    // break;
                }
            }
        ?>
        </div>
                <div class="reselling_price_div">
                            <input type='button' value='SET' id='resell'>
                </div>
                <p class='resell_shipping_total'>Shipping cost (<?php echo get_woocommerce_currency_symbol();?>) : <span class='resell_shipping_total_price'>0</span></p>
                <hr>
                <p class='resell_sub_total'>Sub Total Price (<?php echo get_woocommerce_currency_symbol();?>) : <span class='resell_sub_total_price'>0</span></p>
                <hr>
                <p class='resell_total'>Sub Total Price (<?php echo get_woocommerce_currency_symbol();?>) : <span class='resell_total_price'>0</span></p>
        <?php
            
       
    }