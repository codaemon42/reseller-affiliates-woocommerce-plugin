<?php
/**
 * @package reseller
 * @version 1.0.0
 */
/*
Plugin Name: reseller Assistance by Mohaazon IT Solution
Plugin URI: https://woopearl.com/
Description: reseller assistance plugin for woocommerce and affiliate plugins.
Author: Naim-Ul-Hasan
Version: 1.0.0
Author URI: https://woopearl.com/
*/

// ob_start();
// error_reporting(0);

 // Setup
 define('RE_FILE_URL', __FILE__ );
 // Includes
 include('includes/activation.php');
 include('includes/deactivation.php');
 include('includes/enqueue.php');
 include('includes/checkout-addition.php');

 register_activation_hook( __FILE__, 're_reseller_activate_plugin');
 register_deactivation_hook( __FILE__, 're_reseller_deactivate_plugin');

 add_action('wp_enqueue_scripts', 're_enqueue_scripts');

 
 add_action( 'woocommerce_review_order_before_payment', 'ts_review_order_before_payment', 10 );



add_action( 'woocommerce_before_calculate_totals', 'add_custom_price', 20, 1);
    
    function add_custom_price( $cart_obj ) {
        if (is_checkout() || isset($_POST['woocommerce_checkout_place_order'])) {    
            //
            // This is necessary for WC 3.0+
            if ( is_admin() && ! defined( 'DOING_AJAX' ) )
                return;
    
            // Avoiding hook repetition (when using price calculations for example)
            if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
                return;
                
                global $woocommerce;
                $i = 1;
                foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $resell_price_input = 'resell_price'.$i;
                    $resell_cart_quantity_input = 'resell_cart_quantity'.$i;
                    if(isset($_POST[$resell_price_input])){

                        $resell_price = $_POST[$resell_price_input];

                        $resell_cart_quantity = $_POST[$resell_cart_quantity_input];

                        echo $cart_item['data']->set_price( $resell_price );
                        //$cart_item->set_quantity($cart_item_key, '10',$refresh_totals);
                        $woocommerce->cart->set_quantity($cart_item_key, $resell_cart_quantity);
                        echo $cart_item_key;
                        $i++;
                    }
                } 

    }
}

// add_action('woocommerce_before_main_content', 're_restrict_not_customer');
// function re_restrict_not_customer(){
//     if( !is_user_logged_in() || current_user_can('customer') ){
//         wp_redirect(site_url('/'));
//         exit;
//     }  
// }

add_action('affiliates_dashboard_before', 're_reseller_menu');
function re_reseller_menu(){
    if(is_user_logged_in()){
    ?>
        <a href="#" id="resell-menu" class="resell-menu">Go To Shop Page</a>
    <?php
    }
}

// On cart page
add_action( 'woocommerce_cart_collaterals', 'remove_cart_totals', 9 );
function remove_cart_totals(){
    // Remove cart totals block
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

    // Add back "Proceed to checkout" button (and hooks)
    echo '<div class="cart_totals">';
    do_action( 'woocommerce_before_cart_totals' );

    echo '<div class="wc-proceed-to-checkout">';
    do_action( 'woocommerce_proceed_to_checkout' );
    echo '</div>';

    do_action( 'woocommerce_after_cart_totals' );
    echo '</div><br clear="all">';
}