<?php  if(!defined('ABSPATH')){die("You are silly human!");}
/*
Plugin Name: Index Product comparison table
Plugin URI: http://www.firmanpowerequipment.com/
Version: 1.0
Author: Bluefox Dev
Description: Small plugin for product comparison table  
*/

add_action('wp_enqueue_scripts', 'enqueue_template_for_index'); 


function enqueue_template_for_index(){
	wp_enqueue_script( 'angularjs-lib', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js', array(), '1.7.5', false );

	wp_enqueue_style('handlebar-library', plugins_url('assets/css/custom-compare-table.css', __FILE__), array(), '1.1.35');

	wp_enqueue_script('handlebar-library', plugins_url('assets/js/handlebars-v4.0.12.js', __FILE__));

	wp_enqueue_script('handlebar-template', plugins_url('assets/js/compare_table_index.js', __FILE__), array('jquery', 'angularjs-lib'), '2.3.63', false);

	wp_localize_script( 'handlebar-template', 'ajax_object', array( 'ajax_url' => admin_url('admin-ajax.php'), 'message'=>'Welcome to ajax', 'number'=>123));

}

add_action('wp_ajax_abcd',function(){

	$compare_data_ids = $_POST['data'];
	unset($_COOKIE['compare_data_ids']);
	SETCOOKIE ("compare_data_ids", $compare_data_ids, time()+3600, '/product-table/', $_SERVER['HTTP_HOST'] );

	wp_die();

}

);

add_action('wp_ajax_nopriv_abcd',function(){      

	$compare_data_ids = $_POST['data'];
	unset($_COOKIE['compare_data_ids']);
	SETCOOKIE ("compare_data_ids", $compare_data_ids, time()+3600, '/product-table/', $_SERVER['HTTP_HOST']);

	wp_die();}

);


  
  add_shortcode( 'compare_products', 'compare_products_checkbox_shortcode' );

function compare_products_checkbox_shortcode( $atts ) {
	$compare_data_ids = $_COOKIE['compare_data_ids'];
	if( empty( $compare_data_ids ) ){
		$content = '<div class="container" style="text-align:center;">';
		$content .= '<h3>Select 2 or more generators to compare!</h3>';
		$content .= '<span class="goback_archive_btn"><a href="/products"><button>Generator products</button></a></span>';
		$content .= '</div>';

		return $content;
	}
	$product_ids = explode( ',', $compare_data_ids );
	//var_dump($product_ids);

	$content = '<div class="container">';
        $content = '<div class="header-compare-table"><h2 style="text-align:center; color:orange">Compare Products<h2></div>';
	$content .= ' <section style="margin-top:60px; margin-bottom:100px;">';
	$content .= ' <ol class="compare_product"  style="border:0px!important">';

     $content .= '<div class="li_compare_prodcut"><h4 class ="product-header" ><div class="goback_btn">
                                 <button onclick="goBack()">Back</button>
                               <script>
                                function goBack() {
                                  window.history.back() 
                                    }
                            </script> </div>
      

                    </h4></div>';


	foreach ( $product_ids as $id ) {
		$card_model        = get_post_meta( $id, "card_model", true );
		$card_product_type = get_post_meta( $id, "card_product_type", true );
                $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
               $certification =  get_post_meta($id, "card_certification", true);


	   //	$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">Model #' . $card_model . '</span><br><span>' . $card_product_type . '</p></span><a href="' . get_the_permalink( $id ) . '"><img width="200px" height="auto" src="' . $imageid[0] . '"></a></p></li>';
              $content .= '<li class="li_compare_prodcut123 header-hover" id="" style="padding-top:15px"><p><span class="model_number_ab"><a href="' . get_the_permalink( $id ) . '"><img width="200px" height="auto" src="' . $imageid[0] . '"></a></span><br><span><a class="compare-h-title" href="'.get_the_permalink( $id ).'">' . get_the_title( $id ) . '</a></span></p></li>';

                
	}


	$content .= '</ol>';




$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Rating</h4></div>';

	foreach ( $product_ids as $id ) {
	      

		$content .= '<li class="li_compare_prodcut123 extra_style" style="background-color: #f6f6f6;"><p class="rating_index" ><span class="model_number_ab star-rating-compare"><span id="star_rating-'.$id.'"></span></span></p></li>';

                
	}


	$content .= '</ol>';



$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Price</h4></div>';

	foreach ( $product_ids as $id ) {
	      $product1 = wc_get_product( $id ); 
              $product1=$product1->get_price();

              $base = $product1;
             // $point= $base[-3..-2..-1];
              $value1= $base[-2..-1];
              $value2= $base[-1];
              $whole = floor($base);    
                                   
		
              $content .= '<li class="li_compare_prodcut123"><p><span class="dalar_sign">$</span><span class="price_index"> ' . $whole . '</span><span class="frac">' . $value1.'' .$value2.'</span></p></li>';
		  
	}
    
	$content .= '</ol>';




$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Certification</h4></div>';

	foreach ( $product_ids as $id ) {
	       $certification =  get_post_meta($id, "card_certification", true);

		$content .= '<li class="li_compare_prodcut123 extra_style" style="background-color: #f6f6f6;"><p><span class="model_number_ab">' . $certification . '</span></p></li>';
                
	}


	$content .= '</ol>';



$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Starting watts</h4></div>';

	foreach ( $product_ids as $id ) {
	       $starting_watts = get_post_meta($id, "card_start_watts", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' . $starting_watts . '</span></p></li>';
                
	}


	$content .= '</ol>';


$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Running watts</h4></div>';

	foreach ( $product_ids as $id ) {
	       $running_watts = get_post_meta($id, "card_running_watts", true);

		$content .= '<li class="li_compare_prodcut123  extra_style" style="background-color: #f6f6f6;"><p><span class="model_number_ab">' . $running_watts . '</span></p></li>';
                
	}


	$content .= '</ol>';


$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Starting method</h4></div>';

	foreach ( $product_ids as $id ) {
	       $starting_method = get_post_meta($id, "card_starting_method", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' . $starting_method . '</span></p></li>';
                
	}


	$content .= '</ol>';


$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Outlet</h4></div>';

	foreach ( $product_ids as $id ) {
	       $outlet = get_post_meta($id, "card_outlets", true);

		$content .= '<li class="li_compare_prodcut123 extra_style" style="background-color: #f6f6f6;"><p><span class="model_number_ab">' . $outlet . '</span></p></li>';
                
	}


	$content .= '</ol>';


$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Gasoline run time at 1/2 load</h4></div>';

	foreach ( $product_ids as $id ) {
	       $halfload = get_post_meta($id, "card_gas_run_half_load", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' .  $halfload . '</span></p></li>';
                
	}


	$content .= '</ol>';

$content .= ' <ol class="compare_product" >';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Gasoline run time at 1/4 load</h4></div>';

	foreach ( $product_ids as $id ) {
	       $one4load = get_post_meta($id, "card_gas_run_one4th_load", true);

		$content .= '<li class="li_compare_prodcut123 extra_style"  style="background-color: #f6f6f6;"><p><span class="model_number_ab">' .  $one4load . '</span></p></li>';
                
	}


	$content .= '</ol>';



$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Engine size</h4></div>';

	foreach ( $product_ids as $id ) {
	       $engine_size = get_post_meta($id, "card_engine_size", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' .  $engine_size . '</span></p></li>';
                
	}


	$content .= '</ol>';



          $content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Inverter(Y/N)</h4></div>';

	foreach ( $product_ids as $id ) {
	       $inverter = get_post_meta($id, "card_inverter", true);

		$content .= '<li class="li_compare_prodcut123 extra_style" style="background-color: #f6f6f6;"><p><span class="model_number_ab">' .  $inverter . '</span></p></li>';
                
	}


	$content .= '</ol>';


  $content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Parallel capacity</h4></div>';

	foreach ( $product_ids as $id ) {
	       $paracap = get_post_meta($id, "card_parallel_capacity", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' .  $paracap . '</span></p></li>';
                
	}

	$content .= '</ol>';


   $content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Card voltmeter</h4></div>';

	foreach ( $product_ids as $id ) {
	       $cardvolt = get_post_meta($id, "card_voltmeter", true);

		$content .= '<li class="li_compare_prodcut123 extra_style" style="background-color: #f6f6f6;"><p><span class="model_number_ab">' .  $cardvolt . '</span></p></li>';
                
	}

	$content .= '</ol>';


  $content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Gasoline Capacity</h4></div>';

	foreach ( $product_ids as $id ) {
	       $gascap = get_post_meta($id, "card_gasoline_capacity", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' .  $gascap . '</span></p></li>';
                
	}

	$content .= '</ol>';

 $content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Wheel kit</h4></div>';

	foreach ( $product_ids as $id ) {
	       $wheelkit = get_post_meta($id, "card_wheel_kit", true);

		$content .= '<li class="li_compare_prodcut123 extra_style" style="background-color: #f6f6f6;"><p><span class="model_number_ab">' .  $wheelkit . '</span></p></li>';
                
	}

	$content .= '</ol>';


 $content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Battery</h4></div>';

	foreach ( $product_ids as $id ) {
	       $battery = get_post_meta($id, "card_battery", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' .  $battery . '</span></p></li>';
                
	}

	$content .= '</ol>';


$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Dims</h4></div>';

	foreach ( $product_ids as $id ) {
	       $dims = get_post_meta($id, "card_dims", true);

		$content .= '<li class="li_compare_prodcut123 extra_style" style="background-color: #f6f6f6;"><p><span class="model_number_ab">' .  $dims . '</span></p></li>';
                
	}

	$content .= '</ol>';



$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Weight</h4></div>';

	foreach ( $product_ids as $id ) {
	       $weight = get_post_meta($id, "card_weight", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' .  $weight . '</span></p></li>';
                
	}

	$content .= '</ol>';


$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut extra_style" style="background-color: #f6f6f6;"><h4>Accessories</h4></div>';

	foreach ( $product_ids as $id ) {
	       $accessory = get_post_meta($id, "card_accessory", true);

		$content .= '<li class="li_compare_prodcut123 extra_style" style="background-color: #f6f6f6;"><p><span class="model_number_ab">' .  $accessory . '</span></p></li>';
                
	}

	$content .= '</ol>';



$content .= ' <ol class="compare_product">';
	$content .= '<div class="li_compare_prodcut"><h4>Warranty</h4></div>';

	foreach ( $product_ids as $id ) {
	       $warranty = get_post_meta($id, "card_warranty", true);

		$content .= '<li class="li_compare_prodcut123"><p><span class="model_number_ab">' .  $warranty . '</span></p></li>';
                
	}

	$content .= '</ol>';



/************ for ipad and desktop **************/

  $content .='<div class="table_container">';
 $content .='<div class="table_scroll">';
  $content .='<h2 style="text-align:center; border-bottom:100px;" class="table_title_heading">Compare products</h2>';
  $content .='<table class="table table-striped">';
  $content .='<thead>';
  $content .='<tr>';

 
               //  $currentID=get_the_id();
		// $rats = array($currentID,$post_id1, $post_id2, $post_id3);

               $content .='<th><button onclick="goBack()" class="goback_btn">Back</button><script>function goBack() {  window.history.back() }  </script></th>';

                foreach ($product_ids as $id ) {
		$card_model        = get_post_meta( $id, "card_model", true );
		$card_product_type = get_post_meta( $id, "card_product_type", true );
                $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
               $certification =  get_post_meta($id, "card_certification", true);

           //  $content .='<th><a href="' . get_the_permalink( $id ) . '"><img width="200px" height="auto" src="' . $imageid[0] . '"></a><br><span><a class="compare-h-title" href="'.get_the_permalink( $id ).'">' . get_the_title( $id ) . '</a></span></th>';
              $content .='<th><a href="' . get_the_permalink( $id ) . '"><img width="200px" height="auto" src="' . $imageid[0] . '"></a></th>';

	  }

    

     $content .='</tr>';

     $content .='<tr>';
   $content .='<th class="first_th_border_top"></th>';
      foreach ($product_ids as $id ) {
		
             $content .='<th class="first_th_border_top"><a class="compare-h-title" href="'.get_the_permalink( $id ).'">' . get_the_title( $id ) . '</a></th>';
   
	  }

     $content .='</tr>';


    $content .='</thead>';
    $content .='<tbody class="table_body_index">';
      $content .='<tr>';

             $content .='<td class="td_rating_border_top">Rating</td>';
             
		foreach($product_ids as $id){
                 $content .= '<td class="td_rating_border_top"><span class="star-rating-compare"></span><span id="star_rating-'.$id.'"></span></td>';

               }

      $content .='</tr>';
      $content .='<tr>';
      $content .='<td>Price</td>';


   	       foreach($product_ids as $id){

              $product1 = wc_get_product( $id ); 
              $product1=$product1->get_price();

              $base = $product1;

              if(empty($base)){
                 $content .='Hidden';
             }

            //  $whole = floor($base);    
            //  $fraction = $base - $whole; 
            //  $fraction = "$fraction" ; 

               $content .='<td><span class="dolar-sign">$</span><span class="price_index_Page"> ' .  $base . '</span></td>';    
		//$content .='<td>$<span class="price_single_Page"> ' . $whole . '</span><span class="frac_single">' .$fraction[2].'' .$fraction[3].'</span></td>';    
             } 
      

      $content .='</tr>';


      $content .='<tr>';

        $content .='<td>Certification</td>';

       foreach ($product_ids as $id ) {
	       $certification =  get_post_meta($id, "card_certification", true);
	       $content .='<td>' . $certification . '</td>';
                
           }
   
    $content .='</tr>';


      $content .='<tr>';

        $content .='<td>Starting watts</td>';

       foreach ($product_ids as $id ) {
	       $starting_watts = get_post_meta($id, "card_start_watts", true);

		$content .= '<td>' . $starting_watts . '</td>';
                
           }
   
    $content .='</tr>';


      $content .='<tr>';

        $content .='<td>Running watts</td>';

       foreach ($product_ids as $id ) {
	       $running_watts = get_post_meta($id, "card_running_watts", true);

		$content .= '<td>' . $running_watts . '</td>';
                
           }
   
    $content .='</tr>';


      $content .='<tr>';

        $content .='<td>Starting method</td>';

       foreach ($product_ids as $id ) {
	         $starting_method = get_post_meta($id, "card_starting_method", true);

		$content .= '<td>' . $starting_method . '</td>';
                
           }
   
    $content .='</tr>';


      $content .='<tr>';

        $content .='<td>Outlet</td>';

       foreach ($product_ids as $id ) {
	       	       $outlet = get_post_meta($id, "card_outlets", true);

		       $content .= '<td>' . $outlet . '</td>';
                
           }
   
    $content .='</tr>';


      $content .='<tr>';

        $content .='<td>Gasoline run time at 1/2 load</td>';

       foreach ($product_ids as $id ) {

	        $halfload = get_post_meta($id, "card_gas_run_half_load", true);

		$content .= '<td>' .  $halfload . '</td>';
                
           }
   
    $content .='</tr>';


      $content .='<tr>';

        $content .='<td>Gasoline run time at 1/4 load</td>';

       foreach ($product_ids as $id ) {

                $one4load = get_post_meta($id, "card_gas_run_one4th_load", true);

		$content .= '<td>' .  $one4load . '</td>';
                
           }
   
    $content .='</tr>';


      $content .='<tr>';

        $content .='<td>Engine size</td>';

       foreach ($product_ids as $id ) {

                 $engine_size = get_post_meta($id, "card_engine_size", true);

		$content .= '<td>' .  $engine_size . '</td>';
                
           }
   
    $content .='</tr>';



      $content .='<tr>';

        $content .='<td>Inverter (Y/N)</td>';

       foreach ($product_ids as $id ) {

                $inverter = get_post_meta($id, "card_inverter", true);

		$content .= '<td>' .  $inverter . '</td>';
                
           }
   
    $content .='</tr>';


         $content .='<tr>';

        $content .='<td>Parallel Capacity</td>';

       foreach ($product_ids as $id ) {

	       $paracap = get_post_meta($id, "card_parallel_capacity", true);

		$content .= '<td>' .  $paracap . '</td>';
                
           }
   
    $content .='</tr>';


         $content .='<tr>';

        $content .='<td>Card Voltmeter</td>';

       foreach ($product_ids as $id ) {

                 $cardvolt = get_post_meta($id, "card_voltmeter", true);

		$content .= '<td>' .  $cardvolt . '</td>';
                
                
           }
   
    $content .='</tr>';



        $content .='<tr>';

        $content .='<td>Gasoline capacity</td>';

       foreach ($product_ids as $id ) {

              $gascap = get_post_meta($id, "card_gasoline_capacity", true);

	     $content .= '<td>' .  $gascap . '</td>';
                
                
           }
   
    $content .='</tr>';


     $content .='<tr>';

        $content .='<td>Wheel kit</td>';

       foreach ($product_ids as $id ) {

	       $wheelkit = get_post_meta($id, "card_wheel_kit", true);

		$content .= '<td>' .  $wheelkit . '</td>';
                
                
           }
   
    $content .='</tr>';



         $content .='<tr>';

        $content .='<td>Battery</td>';

       foreach ($product_ids as $id ) {

                $battery = get_post_meta($id, "card_battery", true);

		$content .= '<td>' .  $battery . '</td>';
                
                
           }
   
    $content .='</tr>';


         $content .='<tr>';

        $content .='<td>Dims</td>';

       foreach ($product_ids as $id ) {

                $dims = get_post_meta($id, "card_dims", true);

		$content .= '<td>' .  $dims . '</td>';
                
                
           }
   
    $content .='</tr>';




        $content .='<tr>';

        $content .='<td>Weight</td>';

       foreach ($product_ids as $id ) {

                $weight = get_post_meta($id, "card_weight", true);

		$content .= '<td>' .  $weight . '</td>';
                
                
           }
   
    $content .='</tr>';


        $content .='<tr>';

        $content .='<td>Accessories</td>';

       foreach ($product_ids as $id ) {

                $accessory = get_post_meta($id, "card_accessory", true);

		$content .= '<td>' .  $accessory . '</td>';
                
                
                
           }
   
    $content .='</tr>';




        $content .='<tr>';

        $content .='<td>Warranty</td>';

       foreach ($product_ids as $id ) {

        $warranty = get_post_meta($id, "card_warranty", true);

        $content .= '<td>' .  $warranty . '</td>';
                           
           }
   
    $content .='</tr>';


    $content .='</tbody>';
    $content .='</table>';
    $content .='</div>';
    $content .='</div>';





	 return $content;

  
}




