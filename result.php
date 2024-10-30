<?php
//manulay load class
require_once("__class/kw_setup.php");
use Exchange_rates_ekantorpl\Kw_setup;

$result = Kw_setup::kw_db_config();

foreach($result as $val){
    //get language
    if($val->param_name=='language' && $val->param_value==1){$lang=$lang_pl;$l='pl';}
    if($val->param_name=='language' && $val->param_value==2){$lang=$lang_en;$l='en';}
    //get time refresh
    if($val->param_name=='refresh_time' && $val->param_value==1){$time=60;} //60s
    if($val->param_name=='refresh_time' && $val->param_value==2){$time=300;} //300s
    if($val->param_name=='refresh_time' && $val->param_value==3){$time=600;} //600s
}