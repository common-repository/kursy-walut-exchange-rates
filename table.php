<?php
/**
 *  * @author ekantor.pl
 */

/**
 * Load currency data
 */
session_start();

function curl_get($url,$time,$cert_verify)
{
    $c = curl_init();  
    curl_setopt($c,CURLOPT_URL,$url);
    
    if(isset($time) && is_numeric($time)){
        curl_setopt($c, CURLOPT_TIMEOUT, $time);
    }
    if(isset($cert_verify) && is_numeric($time)){
        if($cert_verify==1){
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, true);
        }else{
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);            
        }
    }
    
    curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($c);
    if($output === false){$output='curl error';}
    curl_close($c);
  
    return $output;
}

$xml = simplexml_load_string(curl_get('https://ekantor.pl/api/kursy.xml', 10, 0));

/**
 * Function load currency from ekantor.pl
 * 
 * @param array $xml Dubstitutes data from XML
 * @param string $currency Code currency (EUR,CHF,GBP,USD)
 * @param int $param If 1 - buy, if 2 - sell
 */
function exchange_rates_ekantor_load_currency($xml,$currency,$param){
    foreach($xml->pozycja as $val){    
        if($val->kod_waluty==$currency && $param==1){
            $result = (float)$val->kurs_kupna;
        }
        if($val->kod_waluty==$currency && $param==2){
            $result = (float)$val->kurs_sprzedazy;
        }
    }
    $result = (float)$result;
    return number_format($result, 4, '.', '');
}

function exchange_rates_ekantor_arrow($currency,$param,$data){

    if(isset($_SESSION[$currency.'_'.$param])){
        if($_SESSION[$currency.'_'.$param]<$data){
            $result='<i class="fa fa-arrow-up" aria-hidden="true" style="color:green;"></i>';
        }
        elseif($_SESSION[$currency.'_'.$param]>$data){
            $result='<i class="fa fa-arrow-down" aria-hidden="true" style="color:red;"></i>';
        }
        elseif($_SESSION[$currency.'_'.$param]==$data){
            $result='-';
        }
    }
    else{
       $result='';
    }
	$_SESSION[$currency.'_'.$param]=$data;
	
    return $result;
}

/**
 * Get time
 */
if(isset($_GET['t'])){
    if($_GET['t']==1){$time='60';}
    elseif($_GET['t']==2){$time='300';}
    elseif($_GET['t']==3){$time='600';}
    else{$time='600';}
}
else{
   $time='600';
}

/**
 * Get langauge
 */
require_once('lang.php');
if(isset($_GET['l'])){
    if($_GET['l']=='pl'){$lang=$lang_pl;}
    elseif($_GET['l']=='en'){$lang=$lang_en;}
    else{$lang=$lang_pl;}
}
else{
   $lang=$lang_pl;
}


/**
 * Print table
 */
?>
<table class="table kw_ekantor_table" style="margin-bottom:3px !important;">
    <tbody>
        <tr><th><?php echo $lang['currency'];?></th><th><?php echo $lang['rate_buy'];?></th><th><?php echo $lang['rate_sell'];?></th></tr>
        <tr><td><div class="flag" id="kw_flag_eur"></div> EUR</td><td><?php $currency='EUR'; $param=1; $data=exchange_rates_ekantor_load_currency($xml, $currency, $param); echo exchange_rates_ekantor_arrow($currency, $param, $data);?> <?php echo $data;?></td><td><?php $currency='EUR'; $param=2; $data=exchange_rates_ekantor_load_currency($xml, $currency, $param); echo exchange_rates_ekantor_arrow($currency, $param, $data);?> <?php echo $data;?></td></tr>
        <tr><td><div class="flag" id="kw_flag_usd"></div> USD</td><td><?php $currency='USD'; $param=1; $data=exchange_rates_ekantor_load_currency($xml, $currency, $param); echo exchange_rates_ekantor_arrow($currency, $param, $data);?> <?php echo $data;?></td><td><?php $currency='USD'; $param=2; $data=exchange_rates_ekantor_load_currency($xml, $currency, $param); echo exchange_rates_ekantor_arrow($currency, $param, $data);?> <?php echo $data;?></td></tr>
        <tr><td><div class="flag" id="kw_flag_chf"></div> CHF</td><td><?php $currency='CHF'; $param=1; $data=exchange_rates_ekantor_load_currency($xml, $currency, $param); echo exchange_rates_ekantor_arrow($currency, $param, $data);?> <?php echo $data;?></td><td><?php $currency='CHF'; $param=2; $data=exchange_rates_ekantor_load_currency($xml, $currency, $param); echo exchange_rates_ekantor_arrow($currency, $param, $data);?> <?php echo $data;?></td></tr>
        <tr><td><div class="flag" id="kw_flag_gbp"></div> GBP</td><td><?php $currency='GBP'; $param=1; $data=exchange_rates_ekantor_load_currency($xml, $currency, $param); echo exchange_rates_ekantor_arrow($currency, $param, $data);?> <?php echo $data;?></td><td><?php $currency='GBP'; $param=2; $data=exchange_rates_ekantor_load_currency($xml, $currency, $param); echo exchange_rates_ekantor_arrow($currency, $param, $data);?> <?php echo $data;?></td></tr>
    </tbody>
</table>