<?php
namespace Exchange_rates_ekantorpl;

interface Kw_header_interface{
    public static function kw_admin_menu($lang,$l,$time);
    public static function kw_styles($url_style,$url_awesome);
    public static function kw_jquery($url_jquery);
    public static function kw_wp_head($url_table,$time);
}

/**
 * Header class
 */
class Kw_header implements Kw_header_interface{
    
    public static function kw_admin_menu($lang,$l,$time){
        add_menu_page( $lang['table_name'], $lang['table_name'], 'manage_options', 'kursy-walut-ekantorpl', function() use ($lang,$l,$time){exchange_rates_ekantor_wyswietl1($lang,$l,$time);},plugins_url('../img/ekantor_logo.png',__FILE__) );
    }
    
    public static function kw_styles($url_style,$url_awesome){
        wp_enqueue_style( 'ekantor-style', $url_style );
        wp_enqueue_style( 'ekantor-style-font-awesome', $url_awesome );
    }
    
    public static function kw_jquery($url_jquery) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', $url_jquery);
        wp_enqueue_script( 'jquery' );
    }
        
    public static function kw_wp_head($table_url,$time) {
        ?>

        <script>
            jQuery(document).ready(function($) {
                jQuery.get( "<?php echo $table_url;?>", function( data ) {
                     jQuery( "#kw_currency_table" ).html( data );
                   });
            });   
            function currency_countdown() {
                    var i_table = document.getElementById('table_counter');
                    i_table.innerHTML = parseInt(i_table.innerHTML)-1;
                        if (i_table.innerHTML < 1) {
                            jQuery.get( "<?php echo $table_url;?>", function( data ) {
                                 jQuery( "#kw_currency_table" ).html( data );
                                 i_table.innerHTML=<?php echo $time; ?>;
                               });
                            }
                    }
                    setInterval(currency_countdown,1000);  
        </script>
        <?php
    }
    
}

