<?php

/*
PLUGIN NAME: Single page comparison table
AUTHOR: bluefoxDev
VERSION: 1.0
*/

if(!defined('ABSPATH')) {die();}

class product_compare_table{
  
   public function __construct(){
        add_shortcode( 'your-product-here' ,array($this,'product_table'));
 	add_action('wp_enqueue_scripts', array($this,'enqueue_js_css_script'));    
          
     }
  


function enqueue_template_for_index(){
 
 wp_enqueue_script('angular-template', plugins_url('template/angular_template.js', __FILE__), array('jquery'), '1.0', false);  
  wp_localize_script( 'angular-template', 'external_var_name', array('ajaxurl' => admin_url('admin-ajax.php')));
  }

function enqueue_script_for_index(){
  wp_enqueue_script('ajax-js', plugins_url('js/ajax.js', __FILE__), array('jquery'), '10.25', false);  
  wp_localize_script( 'ajax-js', 'external_var_name', array('ajaxurl' => admin_url('admin-ajax.php')));
  }



function enqueue_js_css_script(){
 wp_enqueue_script('firman-comparison-table-js', plugins_url('js/comparison_table.js', __FILE__), array('jquery'), '1.2', true);
 wp_enqueue_style('firman-comparison-table-css', plugins_url('css/comparison_table.css', __FILE__), null, '1.54');
  }


 
public function product_table(){
    
Global $product, $post; 

if(is_single()){  

 $currentID=get_the_id();

$product1 = rwmb_meta( 'card_product1');
$product2 = rwmb_meta( 'card_product2' );
$product3 = rwmb_meta( 'card_product3');

$product1=intval($product1);

   if(empty($product1)){
     $post_id1=275;
      }else{
       $arg = array('p'=>$product1, 'post_type' =>'product',) ;
       $query = new wp_query($arg);
      if($query->have_posts()):while($query->have_posts()): $query->the_post(); 
        $post_id1 = $product1;
     endwhile; else : $post_id1=281; endif;
  }	


$product2=intval($product2);

   if(empty($product2)){
     $post_id2=274;
      }else{
       $arg = array('p'=>$product2, 'post_type' =>'product',) ;
       $query = new wp_query($arg);
      if($query->have_posts()):while($query->have_posts()): $query->the_post(); 
        $post_id2 = $product2;
     endwhile; else : $post_id2=281; endif;
  }	


$product3=intval($product3);
  //var_dump($product3);

   if(empty($product3)){
     $post_id3=276;
      }else{
       $arg = array('p'=>$product3, 'post_type' =>'product',) ;
       $query = new wp_query($arg);
      if($query->have_posts()):while($query->have_posts()): $query->the_post(); 
        $post_id3 = $product3;
     endwhile; else : $post_id3=281; endif;
  }	



$product = wc_get_product( $post_id1 );
//$product->get_regular_price();
//$product->get_sale_price();
$product->get_price();

$product1 = wc_get_product( $post_id2 ); 
$product1->get_price();

$product2 = wc_get_product( $post_id3 );
$product2->get_price();

//  $imageid_1 = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' );

  $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($post_id1), 'full' );
  $featureImage1=$imageid[0];

 $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($post_id2), 'full' );
  $featureImage2=$imageid[0];

 $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($post_id3), 'full' );
  $featureImage3=$imageid[0];

 


?> 





<div class="container">

      <section class="single_page_section">
         <div class="header_title_single"><h2>Compare Products</h2></div> 
         <ol class="compare_product2" style="border:0px">
                 <div class="li_compare_prodcut2"><a href="#compare-similar-items-up"><h4>[ Back to top ]</h4></a></div> 

           

           <?php 
                
		 $rats = array( $currentID,$post_id1, $post_id2, $post_id3);
             
               foreach ( $rats as $id ) {
		$card_model        = get_post_meta( $id, "card_model", true );
		$card_product_type = get_post_meta( $id, "card_product_type", true );
                $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
               $certification =  get_post_meta($id, "card_certification", true);

              echo '<li class="li_compare_prodcut1232 header-hover"  style="padding-top:15px"><p><span class="model_number_ab"><a href="' . get_the_permalink( $id ) . '"><img width="200px" height="auto" src="' . $imageid[0] . '"></a></span><br><span><a class="compare-h-title" href="'.get_the_permalink( $id ).'">' . get_the_title( $id ) . '</a></span></p></li>';
   
	  }

        ?>
              
              
            </ol>

         <ol class="compare_product2" style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             
             <div class="li_compare_prodcut2"><div class="com_header"><b>Rating</b></div></div>
          
             <?php

		
   		foreach($rats as $id){
                echo '<li class="li_compare_prodcut1232 star-rating-compare"><span class="ratt" id="star_rating-'.$id.'"></span></li>';
            
               }

            ?>

            
           </ol>

    <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Price</b></div></div>

   
         <?php

            $pr = array(get_the_id(),$post_id1, $post_id2, $post_id3); 
   	  	 foreach($pr as $id){

              $product1 = wc_get_product( $id ); 
              $product1=$product1->get_price();

              $base = $product1;
              $whole = floor($base);    
              $fraction = $base - $whole; 
              $fraction = "$fraction" ; 
                        
		echo '<li class="li_compare_prodcut1232 p_amount" ><p><span class="dalar_sign2">$</span><span class="price_single_Page"> ' . $whole . '</span><span class="frac_single">' .$fraction[2].'' .$fraction[3].'</span></p></li>';    
             } 
        ?>
          
          </ol>



       <ol class="compare_product2"  style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;" >
             <div class="li_compare_prodcut2"><div class="com_header"><b>Certification</b></div></div>
             <li class="li_compare_prodcut1232" ><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_certification", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_certification", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_certification", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_certification", true);?></div></li>
          </ol>



          <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Starting Watts</b></div></div>
             <li class="li_compare_prodcut1232" ><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_start_watts", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_start_watts", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_start_watts", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_start_watts", true);?></div></li>
          </ol>


          <ol class="compare_product2"  style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Running Watts</b></div></div>
             <li class="li_compare_prodcut1232" ><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_running_watts", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_running_watts", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_running_watts", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_running_watts", true);?></div></li>
          </ol>


         <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Starting method</b></div></div>
             <li class="li_compare_prodcut1232" ><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_starting_method", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_starting_method", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_starting_method", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_starting_method", true);?></div></li>
          </ol>


         <ol class="compare_product2"  style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Outlets</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_outlets", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_outlets", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_outlets", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_outlets", true);?></div></li>

          </ol>


         
       <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Gasoline run time at 1/2 load</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_gas_run_half_load", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_gas_run_half_load", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_gas_run_half_load", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_gas_run_half_load", true);?></div></li>

          </ol>

       <ol class="compare_product2"  style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Gasoline run time at 1/4 load</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_gas_run_one4th_load", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_gas_run_one4th_load", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_gas_run_one4th_load", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_gas_run_one4th_load", true);?></div></li>
          </ol>

        <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Engine size</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_engine_size", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_engine_size", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_engine_size", true);?></div></li>
            <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_engine_size", true);?></div></li>

          </ol>


       <ol class="compare_product2" style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Inverter</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_inverter", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_inverter", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_inverter", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_inverter", true);?></div></li>
          </ol>


       <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Parallel Capacity</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_parallel_capacity", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_parallel_capacity", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_parallel_capacity", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_parallel_capacity", true);?></div></li>

          </ol>


        <ol class="compare_product2" style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Voltmeter</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_voltmeter", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_voltmeter", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_voltmeter", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_voltmeter", true);?></div></li>
          </ol>


       <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Gasoline capacity</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_gasoline_capacity", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_gasoline_capacity", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_gasoline_capacity", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_gasoline_capacity", true);?></div></li>

          </ol>

    

        <ol class="compare_product2" style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Wheel kit</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_wheel_kit", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_wheel_kit", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_wheel_kit", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_wheel_kit", true);?></div></li>

          </ol>

        <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Battery</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_battery", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_battery", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_battery", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_battery", true);?></div></li>

          </ol>

       <ol class="compare_product2" style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Dims</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_dims", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_dims", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_dims", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_dims", true);?></div></li>
          </ol>

       <ol class="compare_product2">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Weight</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_weight", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_weight", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_weight", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_weight", true);?></div></li>
          </ol>

        <ol class="compare_product2" style="border-bottom: 1px solid #eaeaea;background-color: #f6f6f6;">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Accessories</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_accessory", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_accessory", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_accessory", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_accessory", true);?></div></li>

          </ol>

       
        <ol class="compare_product2" style="border-bottom:2px solid gainsboro">
             <div class="li_compare_prodcut2"><div class="com_header"><b>Warranty</b></div></div>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta(get_the_id(), "card_warranty", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id1, "card_warranty", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id2, "card_warranty", true);?></div></li>
             <li class="li_compare_prodcut1232"><div class="com_header"><?php echo get_post_meta($post_id3, "card_warranty", true);?></div></li>
          </ol>


  </section> 
</div>




<!-------------------- Ipad and desktop ------------------------------>


<div class="container">
  <div class="table_container_single">
<div class="table_scroll_single">
 <h2 style="text-align:center; border-bottom:100px;" class="table_title_heading">Compare products</h2>
<table class="table table-striped">
<thead>
      <tr>
                <th class="li_compare_prodcut2"><a href="#compare-similar-items-up"><h4>[ Back to top ]</h4></a></th>
           

          <?php
               
		 $product_ids = array($currentID,$post_id1, $post_id2, $post_id3);
                foreach ($product_ids as $id ) {
		$card_model        = get_post_meta( $id, "card_model", true );
		$card_product_type = get_post_meta( $id, "card_product_type", true );
                $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($id, 'full' ));
                $certification =  get_post_meta($id, "card_certification", true);

            //   echo '<th><a href="' . get_the_permalink( $id ) . '"><img width="200px" height="auto" src="' . $imageid[0] . '"></a><br><span><a class="compare-h-title" href="'.get_the_permalink( $id ).'">' . get_the_title( $id ) . '</a></span></th>';
               echo '<th><a href="' . get_the_permalink( $id ) . '"><img width="200px" height="auto" src="' . $imageid[0] . '"></a></th>';

             
            }

    ?>

    </tr>

    <tr> 
        <th class="first_th_border_top_single"></th>
 <?php echo '<th class="second_th_border_top_single">' . get_the_title($currentID) . '</th>'; ?>
       <?php
         $product_id = array($post_id1, $post_id2, $post_id3);
        foreach ($product_id as $id ) {
               echo '<th class="first_th_border_top_single"><a class="compare-h-title" href="'.get_the_permalink( $id ).'">' . get_the_title( $id ) . '</a></th>';
            }
        ?>
    </tr>


   </thead>
   <tbody>
    <tr>

            <td  class="td_rating_border_top_single">Rating</td>
             <?php
            
		foreach($product_ids as $id){
              echo '<td class="td_rating_border_top_single"><span class="star-rating-compare"></span><span id="star_rating-'.$id.'"></span></td>';

               }
           ?>

     </tr>
    <tr>
    <td>Price</td>

     <?php
   	       foreach($product_ids as $id){

              $product1 = wc_get_product( $id ); 
              $product1=$product1->get_price();

              $base = $product1;

              if(empty($base)){
                 $content .='Hidden';
             }

             echo '<td><span class="dolar-sign-single">$</span><span class="price_single_Page"> ' .  $base . '</span></td>';    
		
             } 
      ?>

     </tr>


    <tr>

      <td>Certification</td>
     <?php
       foreach ($product_ids as $id ) {
	       $certification =  get_post_meta($id, "card_certification", true);
	       echo '<td>' . $certification . '</td>';
                
           }
     ?>
   </tr>


     <tr>

      <td>Starting watts</td>
     <?php
       foreach ($product_ids as $id ) {
	       $starting_watts = get_post_meta($id, "card_start_watts", true);

		echo '<td>' . $starting_watts . '</td>';
                
           }
      ?>
   </tr>


     <tr>

       <td>Running watts</td>
     <?php
       foreach ($product_ids as $id ) {
	       $running_watts = get_post_meta($id, "card_running_watts", true);

		echo '<td>' . $running_watts . '</td>';
                
           }
     ?>
   </tr>


      <tr>

      <td>Starting method</td>
     <?php
       foreach ($product_ids as $id ) {
	         $starting_method = get_post_meta($id, "card_starting_method", true);

		echo '<td>' . $starting_method . '</td>';
                
           }
     ?>
   
   </tr>


   <tr>

      <td>Outlet</td>
     <?php 
       foreach ($product_ids as $id ) {
	       	       $outlet = get_post_meta($id, "card_outlets", true);

		     echo '<td>' . $outlet . '</td>';
                
           }
   ?>
  </tr>


    <tr>

      <td>Gasoline run time at 1/2 load</td>
    <?php 
       foreach ($product_ids as $id ) {

	        $halfload = get_post_meta($id, "card_gas_run_half_load", true);

		echo '<td>' .  $halfload . '</td>';
                
           }
      ?>
    </tr>


    <tr>

      <td>Gasoline run time at 1/4 load</td>
    <?php
       foreach ($product_ids as $id ) {

                $one4load = get_post_meta($id, "card_gas_run_one4th_load", true);

		echo '<td>' .  $one4load . '</td>';
                
           }
       ?>
    </tr>


     <tr>

     <td>Engine size</td>
     <?php
       foreach ($product_ids as $id ) {

                 $engine_size = get_post_meta($id, "card_engine_size", true);

		echo '<td>' .  $engine_size . '</td>';
                
           }
      ?>
</tr>



    <tr>

    <td>Inverter (Y/N)</td>
    <?php 
       foreach ($product_ids as $id ) {

                $inverter = get_post_meta($id, "card_inverter", true);

		echo '<td>' .  $inverter . '</td>';
                
           }
     ?>
   </tr>


<tr>

     <td>Parallel Capacity</td>
    <?php 
       foreach ($product_ids as $id ) {

	       $paracap = get_post_meta($id, "card_parallel_capacity", true);

		echo '<td>' .  $paracap . '</td>';
                
           }
    ?>
  </tr>


      <tr>

     <td>Card Voltmeter</td>
       <?php
       foreach ($product_ids as $id ) {

                 $cardvolt = get_post_meta($id, "card_voltmeter", true);

		echo '<td>' .  $cardvolt . '</td>';
                
                
           }
     ?>
   </tr>



     <tr>

      <td>Gasoline capacity</td>

     <?php
       foreach ($product_ids as $id ) {

              $gascap = get_post_meta($id, "card_gasoline_capacity", true);

	  echo '<td>' .  $gascap . '</td>';
                      
           }
      ?>
  </tr>


   <tr>

     <td>Wheel kit</td>

     <?php
       foreach ($product_ids as $id ) {

	       $wheelkit = get_post_meta($id, "card_wheel_kit", true);

		echo '<td>' .  $wheelkit . '</td>';
                
                
           }
    ?>

 </tr>



        <tr>

     <td>Battery</td>
       <?php
       foreach ($product_ids as $id ) {

                $battery = get_post_meta($id, "card_battery", true);

	echo '<td>' .  $battery . '</td>';
                
                
           }
      ?>
 </tr>


     <tr>

       <td>Dims</td>
       <?php
       foreach ($product_ids as $id ) {

                $dims = get_post_meta($id, "card_dims", true);

		echo '<td>' .  $dims . '</td>';
                
                
           }
    ?>
</tr>




     <tr>

     <td>Weight</td>
     <?php
       foreach ($product_ids as $id ) {

                $weight = get_post_meta($id, "card_weight", true);

		echo '<td>' .  $weight . '</td>';
                
                
           }
      ?>
    </tr>


       <tr>

      <td>Accessories</td>
       <?php
       foreach ($product_ids as $id ) {

                $accessory = get_post_meta($id, "card_accessory", true);

		echo '<td>' .  $accessory . '</td>';
                
                
                
           }
   ?>
  </tr>

  <tr>

       <td>Warranty</td>
      <?php
       foreach ($product_ids as $id ) {

        $warranty = get_post_meta($id, "card_warranty", true);

      echo '<td>' .  $warranty . '</td>';
                           
           }
      ?>

    </tr>


    </tbody>
   </table>
  </div>
  </div>
</div>





</div>
 <?php
  }
 }
 } 
 new product_compare_table();