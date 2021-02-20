<?php
function re_enqueue_scripts(){
    //style
    wp_register_style('resell_mian_css', plugins_url('assets/css/main.css', RE_FILE_URL));
    wp_enqueue_style('resell_mian_css');

    //script
    wp_register_script(
        're_main_js',
        plugins_url('/assets/js/main.js', RE_FILE_URL),
        [],
        '1.0.0',
        true
    );
    wp_enqueue_script('re_main_js');
   
    wp_localize_script( 're_main_js', 'local_reseller', array(
        'shop_url' => site_url('/shop')
    ) );
}