<?php  
/* 
Plugin Name: Kursy walut (Exchange rates) ekantor.pl 
Version: 1.0.9
Description: PL: Tabelka kursów walut na podstawie danych dostarczanych przez ekantor.pl || EN: Table of exchange rates on the basis of data provided by the ekantor.pl
Author: ekantor.pl
Author URI: https://ekantor.pl
Plugin URI: https://ekantor.pl
*/  
	
//Version controll
global $wp_version;  


$exit_msg = ' 
Min WordPress version to 2.5.';  

if (version_compare($wp_version, "2.5", "<"))  
{  
 exit($exit_msg);  
}  	

//lang defualt
require_once('lang.php');

//check locale
if(get_locale()=='pl_PL'){
    $lang=$lang_pl;
    $l='pl';
}else{
    $lang=$lang_en;
    $l='en';
}

//default time
$time=1;

//load result config
require_once("result.php");

//load hooks
require_once("hooks.php");

?>