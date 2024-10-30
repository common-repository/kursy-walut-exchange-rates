<?php
//manulay load class
require_once("__class/kw_setup.php");
require_once("__class/kw_header.php");
require_once("__class/kw_main.php");
require_once("__class/Exchange_rates_ekantorpl_Kw_widget.php");
use Exchange_rates_ekantorpl\Kw_setup;
use Exchange_rates_ekantorpl\Kw_header;
use Exchange_rates_ekantorpl\Kw_main;

//db config
function exchange_rates_ekantor_install () {
        Kw_setup::kw_install();
    } 
register_activation_hook(__DIR__.'/kursy-walut-ekantorpl.php', 'exchange_rates_ekantor_install');
    
function exchange_rates_ekantor_delete(){
    Kw_setup::kw_uninstall();
    }	
register_uninstall_hook(__DIR__.'/kursy-walut-ekantorpl.php', 'exchange_rates_ekantor_delete' );


//add menu
function exchange_rates_ekantor_menu($lang,$l,$time){
    Kw_header::kw_admin_menu($lang,$l,$time);
}
add_action('admin_menu', function() use ($lang,$l,$time){exchange_rates_ekantor_menu($lang,$l,$time);});

//style header init
function exchange_rates_ekantor_styles(){
    Kw_header::kw_styles(plugins_url( 'css/style.css' , __FILE__ ),plugins_url( 'css/font-awesome.min.css' , __FILE__ ));
}
add_action( 'wp_enqueue_scripts', 'exchange_rates_ekantor_styles' );
add_action('admin_head', 'exchange_rates_ekantor_styles');

//custom jquery
function exchange_rates_ekantor_jquery() {
    Kw_header::kw_jquery(plugins_url('js/jquery-1.12.4.min.js',__FILE__));
}    
add_action('wp_enqueue_scripts', 'exchange_rates_ekantor_jquery');

//script header init 2
function exchange_rates_ekantor_header($time,$l){
    $table_url = plugins_url('table.php?t='.$time.'&l='.$l, __FILE__);
    Kw_header::kw_wp_head($table_url,$time);
}
add_action('wp_head', function() use ($time,$l){exchange_rates_ekantor_header($time,$l);});

//settings link
function exchange_rates_ekantor_setting_link ( $links ) {
    return Kw_main::admin_widget_menu($links);
}
add_filter( 'plugin_action_links_' . 'kursy-walut-exchange-rates/kursy-walut-ekantorpl.php', 'exchange_rates_ekantor_setting_link' );


//setting page
function exchange_rates_ekantor_wyswietl1($lang,$l,$time)
{
    Kw_main::settings_page($lang, $l, $time);
}

//wideg init
function exchange_rates_ekantor_currency_table() {
	register_widget( 'Exchange_rates_ekantorpl_Kw_widget' );
}
add_action( 'widgets_init', 'exchange_rates_ekantor_currency_table' );

//shortcode
function exchange_rates_ekantor_shortcode($time,$lang){
    Kw_main::kw_shortcode($time,$lang);
}
add_shortcode('kw_currency_table', function() use($time,$lang){exchange_rates_ekantor_shortcode($time,$lang);});	