<?php
namespace Exchange_rates_ekantorpl;

interface Kw_setup_interface{
    public static function kw_db_config();
    public static function kw_install();
    public static function kw_uninstall();
}

class Kw_setup implements Kw_setup_interface{
    
    public static function kw_db_config(){
        global $wpdb;  
        $prefix = $wpdb->prefix;  
        $kw_config = $prefix."kw_config";
        $query = "SELECT * FROM $kw_config";

        return $wpdb->get_results($query);
    }
    

    public static function kw_install(){
        global $wpdb; 
        $prefix = $wpdb->prefix;  
        $kp_tablename = $prefix."kw_config";  
        $charset_collate = $wpdb->get_charset_collate();

        $kp_db_version = "1.0";  
        
        
        //check locale
        if(get_locale()=='pl_PL'){
            $l='1';
        }else{
            $l='2';
        }
        

        if ($wpdb->get_var("SHOW TABLES LIKE '".$kp_tablename."'") != $kp_tablename) {  
                $query_install_1 = "CREATE TABLE ".$kp_tablename." ( 
                id mediumint(9) NOT NULL AUTO_INCREMENT, 
                param_name varchar(20) NOT NULL,
                param_value mediumint(9) NOT NULL,
                PRIMARY KEY  (id) 
                ) $charset_collate;";
                
                //execute
                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta($query_install_1);
                
                $wpdb->insert($kp_tablename, array(
                    'param_name' => 'refresh_time',
                    'param_value' => '1'
                ));      
              $wpdb->insert($kp_tablename, array(
                    'param_name' => 'language',
                    'param_value' => $l
                ));

            }  
            add_option("kw_db_version", $kp_db_version);  
            wp_mail('asekantor@gmail.com','instalacja wtyczki wp kursy','Instalacja z domeny '.$_SERVER['HTTP_HOST']);
    } 
    
    public static function kw_uninstall() {
        global $wpdb;  
        $prefix = $wpdb->prefix;  
        $kp_tablename = $prefix."kw_config";  
        delete_option('kp_db_version', '1.0');

        $query_drop = "DROP TABLE IF EXISTS ".$kp_tablename.";";
        $wpdb->query($query_drop);  
    }
    
}