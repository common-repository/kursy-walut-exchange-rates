<?php

namespace Exchange_rates_ekantorpl;

interface Kw_main_interface{
    public static function admin_widget_menu($links);
}

class Kw_main implements Kw_main_interface{
    public static function admin_widget_menu($links){
        $mylinks = array(
        '<a href="' . admin_url( 'admin.php?page=kursy-walut-ekantorpl' ) . '">Settings</a>',
        );
       return array_merge( $links, $mylinks );
    }
    
    public static function settings_page($lang,$l,$time){
        global $wpdb;
        global $_POST;
        $prefix = $wpdb->prefix; 
        $kp_tablename = $prefix."kw_config";  

        ?>
        <br />
        <h1><?php echo $lang['table_name'];?></h1>
        <form method="post">
            <?php echo $lang['select_lang'];?>
            <select name="lang">
                <option value="1" <?php if($l=='pl'){echo 'selected';} ?>>PL</option>
                <option value="2" <?php if($l=='en'){echo 'selected';} ?>>EN</option>
            </select>
            <?php echo $lang['select_time'];?>
            <select name="time">
                <option value="1" <?php if($time=='60'){echo 'selected';} ?>>1 min</option>
                <option value="2" <?php if($time=='300'){echo 'selected';} ?>>5 min</option>
                <option value="3" <?php if($time=='600'){echo 'selected';} ?>>10 min</option>
            </select>
            <input type="hidden" name="csrf" value="<?php echo $csrf;?>" />
            <input type="submit" value="Ok" />
        </form>
        <?php
            global $wpdb;
            //handler settings
            //set 
            if(isset($_POST['lang']) && isset($_POST['time'])){

                $select_lang=$_POST['lang'];
                $select_time=$_POST['time'];
                if($select_lang==1 || $select_lang==2){
                    $select_lang=$_POST['lang'];
                }
                else{
                    $select_lang=1;
                }

                if($select_time==1 || $select_time==2 || $select_time==3){
                    $select_time=$_POST['time'];
                }
                else{
                    $select_time=1;
                }

                $wpdb->update(
                        $kp_tablename, 
                        array( 
                                'param_value' => $select_time,
                        ), 
                        array( 'param_name' => 'refresh_time' )
                );
                $wpdb->update(
                        $kp_tablename, 
                        array( 
                                'param_value' => $select_lang,
                        ), 
                        array( 'param_name' => 'language' )
                );
                if($select_lang==1){echo '<div style="font-size:25px;margin-top:20px;">Ok. Kliknij <a href="admin.php?page=kursy-walut-ekantorpl">tutaj</a> aby zobaczyć zmiany</div>';}
                if($select_lang==2){echo '<div style="font-size:25px;margin-top:20px;">Ok. Click <a href="admin.php?page=kursy-walut-ekantorpl">here</a> to see the changes</div>';}
            }
    }
    
    public static function kw_shortcode($time,$lang){
        echo '<div id="kw_currency_table"></div>';
        echo '<div id="currency-table-bottom">
            <table id="subtable-kw_ekantor_table"><tbody><tr><td style="width:40px;"><a href="https://ekantor.pl/kalkulator-walut/" target="_blank"><img src="'.plugins_url( 'img/ekantor_logo_wp_male.png' , __DIR__ ).'" class="ekantor" alt="kursy walut" /></a></td>
            <td>'.$lang['currency_vendor'].' | '.$lang['refreshes'].' <span id="table_counter">'.$time.'</span></td></tr></tbody></table>
        </div>';
    }
    
}
