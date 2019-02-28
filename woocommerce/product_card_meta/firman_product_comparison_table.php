<?php
/*
PLUGIN NAME: Product comparison table
AUTHOR: bluefoxDev
VERSION: 1.0
*/
  if(!function_exists('display_record')){
    function display_record(){
        echo '<table class=table-responsive>';
        echo '<tr>';
            echo '<td>';
            echo "This is table information";
            echo '<td>';
        echo '</tr>';
        echo '</table>';
        }
    }
add_shortcode('your-product-here','display_record');