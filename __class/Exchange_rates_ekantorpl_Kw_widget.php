<?php

/**
 * Widget class
 */
class Exchange_rates_ekantorpl_Kw_widget extends \WP_Widget {

	function __construct() {
            // Instantiate the parent object
            global $lang;
		parent::__construct( false, $lang['table_name'] );
	}

	function widget( $args, $instance ) {
            global $time;
            global $lang;
		
		echo '<div id="text-2" class="widget widget_text"><h3 class="widgettitle_kursywalut">'.$lang['table_name'].'</h3>';	
                echo '<div id="kw_currency_table"></div>';
                echo '<div id="currency-table-bottom">
                    <table id="subtable-kw_ekantor_table"><tbody><tr><td style="width:40px;"><a href="https://ekantor.pl/kalkulator-walut/" target="_blank"><img src="'.plugins_url( 'img/ekantor_logo_wp_male.png' , __DIR__ ).'" class="ekantor" alt="kursy walut" /></a></td>
                    <td>'.$lang['currency_vendor'].' | '.$lang['refreshes'].' <span id="table_counter">'.$time.'</span></td></tr></tbody></table>
                </div>';
		echo '</div>';
            // Widget output
	}

	function update( $new_instance, $old_instance ) {
            // Save widget options
            $instance = array();
                return $instance;
	}

	function form( $instance ) {
            // Output admin widget options form
	}
}


//widget end