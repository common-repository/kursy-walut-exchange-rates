<?php

//widget
class kursy_walut_ekantor_currency_table extends WP_Widget {

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
                    <table id="subtable-kw_ekantor_table"><tbody><tr><td style="width:40px;"><a href="https://ekantor.pl/kalkulator-walut/?utm_source=referral&utm_medium=wordpress&utm_campaign=wtyczka%20wp" target="_blank"><img src="https://lh3.googleusercontent.com/gSGqTeMqSnlbJg6H_OguzEnFx86RDWcA1r6eHMVJEnssv8m0GnO-wxhpIhSOqCPJMo_HljwItgpDKJFv8IdK9R0yOelPd3PyeTjWH5UVfaj15vPTyuOgUKFSrMmsJZ9bY--AO1pOvc17p8cHiy64H1TNWoVjG4Ggkb5ZphStp41e4Z_gdnmxq3PTssLW9kDChugIk2ZEFbez2-5QwLnAGB2AqHCPFmoXdoj4_n62h16D4jR-25amnHSkQfhuCFqqv9gEsGjga8a0bEwiuLzJk91RH4wSdrPrcxd4TdJMTE24x_LwyiAoff5WTBQA5MJufe3TFC6-4hdY-3-ABlT4rF1zPK2M0LwzU_6vqNGvMyz8SCksz0FY270jKiYvGhIF1PVB0pxbVTVPspZgRGKY4LQd1o7OC-QhdVs4T0DPqeLWZngTDg3KGAvy9CtBt3f1sBPltE6xgNyhmJkSRacsywtoaUk5B6lsSIhK8r7c5DU6neOkWHTnVpcNUsepIOqrAPi9hUy3jFWLJgqClHqYuUH0PAmpEoAdDg3BfUFrCI5khakbfLFgx4ywsxAWHUH1r5vTPf-8Cz7W_q86Vi2MxCsGQP8Ej44=s30-no" class="ekantor" alt="kursy walut" /></a></td>
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


function kursy_walut_ekantor_currency_table_function() {
	register_widget( 'kursy_walut_ekantor_currency_table' );
}

add_action( 'widgets_init', 'kursy_walut_ekantor_currency_table_function' );
//widget end