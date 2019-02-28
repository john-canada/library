<?php if(!defined('ABSPATH')){ die(" You are silly human! ");}
/*
 * Template Name: compare table
 * Description: Custom page template
 */
get_header();




?>


<?php
   global $product;

   session_start();

   //clearstatcache();

   var_dump(explode(',', $_COOKIE['compare_data_ids']) );

   if(isset($_SESSION["datum1"])){

        $data1=$_SESSION["datum1"];
        $data1=intval($data1);
 }


  if(isset($_SESSION["datum2"])){

       $data2=$_SESSION["datum2"];
      $data2=intval($data2);

}


 if(isset($_SESSION["datum3"])){
    $data3=$_SESSION["datum3"];
    $data3=intval($data3);

 }



//var_dump($_SESSION);


 $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($data1), 'full' );
 $featureImage1=$imageid[0];

 $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($data2), 'full' );
  $featureImage2=$imageid[0];

if($data3){


 $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($data3), 'full' );
  $featureImage3=$imageid[0];

}


$product1 = wc_get_product( $data1 );
$product1->get_price();

$product2 = wc_get_product( $data2 );
$product2->get_price();

  if($data3){
     $product3 = wc_get_product( $data3 );
    $product3->get_price();

  $starting_watts1 = get_post_meta($data1, 'card_start_watts');
  $starting_watts2 = get_post_meta($data2, 'card_start_watts');
//  $starting_watts2 = get_post_meta($data2, 'card_start_watts', true);


$staring_watt = get_post_meta($data1, "card_start_watts", true);


require_once( ABSPATH . 'wp-admin/includes/template.php' );

//get average rating

$rating1 = get_post_meta( $data1, '_wc_average_rating', true );
$rating2 = get_post_meta( $data2, '_wc_average_rating', true );
$rating3 = get_post_meta( $data3, '_wc_average_rating', true );

//echo $rating1;

$product = wc_get_product( $data1 );
//$rating_count = $product->get_rating_count();
//$average = $product->get_average_rating();

//echo wc_get_rating_html( $average, $rating_count);


 $star_rating = array(
     'rating' => 5, //numeric value default 0
     'type' => 'rating',//accetable values % default rating
     'number' => 1234, //submitted rating
     'p'     => $data1
  );

 //wp_star_rating( $star_rating );




// Get an instance of the WC_Product Object (from a product ID)
//$product = wc_get_product( $data1);

// The product rating count (number of reviews by rating )
//$rating_count = $product->get_rating_counts(); // Multidimensional array

// The product average rating (or how many stars this product has)
//$average_rating = $product->get_average_rating();

// Testing Output
//echo '<p>Rating average: '.$average_rating.' stars</p>';



?>

<div class="container">

      <section style="margin-top:60px">
         <ol class="compare_product">
                 <div class="li_compare_prodcut"><h4>Compare Products</h4></div>
                 <li class="li_compare_prodcut123"><p><span class="model_number_ab">Model # <?php echo get_post_meta($data1, "card_model", true);?></span><br><span><?php echo get_post_meta($data1, "card_product_type", true);?></p></span><?php echo '<a href="'. get_the_permalink($data1) .'"><div id="col31_img_container"></div></a>';?></li>
                 <li class="li_compare_prodcut123"><p><span class="model_number_ab">Model # <?php echo get_post_meta($data2, "card_model", true);?></span><br><span><?php echo get_post_meta($data2, "card_product_type", true);?></p></span><?php echo '<a href="'. get_the_permalink($data2) .'"><div id="col32_img_container"></div></a>';?></p></li>
                <li class="li_compare_prodcut123"><p><span class="model_number_ab">Model # <?php echo get_post_meta($data3, "card_model", true);?></span><br><span><?php echo get_post_meta($data3, "card_product_type", true);?></p></span><?php echo '<a href="'. get_the_permalink($data3) .'"><div id="col33_img_container"></div></a>';?></p></li>
            </ol>




       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Certification</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_certification", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_certification", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_certification", true);?></div></li>
          </ol>


          <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Starting Watts</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_start_watts", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_start_watts", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_start_watts", true);?></div></li>
          </ol>


          <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Running Watts</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_running_watts", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_running_watts", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_running_watts", true);?></div></li>
          </ol>


         <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Starting method</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_starting_method", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_starting_method", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_starting_method", true);?></div></li>
          </ol>


         <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Outlets</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_outlets", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_outlets", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_outlets", true);?></div></li>

          </ol>



       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Gasoline run time at 1/2 load</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_gas_run_half_load", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_gas_run_half_load", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_gas_run_half_load", true);?></div></li>

          </ol>

       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Gasoline run time at 1/4 load</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_gas_run_one4th_load", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_gas_run_one4th_load", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_gas_run_one4th_load", true);?></div></li>
          </ol>
<div class="display_none" style="display:none">
        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Engine size</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_engine_size", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_engine_size", true);?></div></li>
            <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_engine_size", true);?></div></li>

          </ol>


       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Inverter</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_inverter", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_inverter", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_inverter", true);?></div></li>
          </ol>


       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Parallel Capacity</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_parallel_capacity", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_parallel_capacity", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_parallel_capacity", true);?></div></li>

          </ol>


        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Voltmeter</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_voltmeter", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_voltmeter", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_voltmeter", true);?></div></li>
          </ol>


       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Gasoline capacity</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_gasoline_capacity", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_gasoline_capacity", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_gasoline_capacity", true);?></div></li>

          </ol>



        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Wheel kit</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_wheel_kit", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_wheel_kit", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_wheel_kit", true);?></div></li>

          </ol>

        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Battery</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_battery", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_battery", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_battery", true);?></div></li>

          </ol>

       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Dims</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_dims", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_dims", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_dims", true);?></div></li>
          </ol>

       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Weight</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_weight", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_weight", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_weight", true);?></div></li>
          </ol>

        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Accessories</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_accessory", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_accessory", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_accessory", true);?></div></li>

          </ol>


        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Warranty</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_warranty", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_warranty", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data3, "card_warranty", true);?></div></li>
          </ol>


    </div>




   <div class="display_specification"><h3>+ Show all specifications</h3></div>
   <div class="display_specification_comp"><h4><i>When comparing portable generators or inverters:</i></h4></div><br/>


<ol class="genMeasured">
   <li>Run time measured at 50% load for open frame generators and 25% load for inverter generators.</li>
   <li>There is no industry standard for testing sound level of a generator. Firman tests under its own conditions to determine the published sound level as a means of comparing one Firman generator to another. Measurements are taken at an average distance of 7m (23 ft.).</li>
</ol>

 </section>

</div>

 <script id="col3_1" type="text/x-handlebars-template">

             <img width="200px" height="auto" src="{{x}}">

  </script>


<script id="col3_2" type="text/x-handlebars-template">

             <img width="200px" height="auto" src="{{y}}">

  </script>

<script id="col3_3" type="text/x-handlebars-template">

             <img width="200px" height="auto" src="{{z}}">

  </script>



 <script type="text/javascript">

       var col3_1 = document.getElementById('col3_1').innerHTML;

             var template31 = Handlebars.compile(col3_1);

              var data31 = template31({x: <?php echo json_encode($featureImage1);?>});

             document.getElementById('col31_img_container').innerHTML=data31;

         var col3_2 = document.getElementById('col3_2').innerHTML;

             var template32 = Handlebars.compile(col3_2);

              var data32 = template32({y: <?php echo json_encode($featureImage2);?>});

             document.getElementById('col32_img_container').innerHTML=data32;

         var col3_3 = document.getElementById('col3_3').innerHTML;

             var template33 = Handlebars.compile(col3_3);

              var data33 = template33({z: <?php echo json_encode($featureImage3);?>});

             document.getElementById('col33_img_container').innerHTML=data33;


 </script>


<?php

} else {  // two column product

//var_dump($featureImage1);

 $star_rating = array(
     'rating' => 5, //numeric value default 0
     'type' => 'rating',//accetable values % default rating
     'number' => 1234, //submitted rating
     'p'     => $data1
  );

 //wp_star_rating( $star_rating );

//gdrts_posts_render_rating();
?>
<?php // wc_get_template( 'single-product/rating.php' ); ?>



<div class="container">

      <section style="margin-top:60px">
           <ol class="compare_product">
                 <div class="li_compare_prodcut"><h4>Compare Products</h4></div>
                 <li class="li_compare_prodcut123"><p><span class="model_number_ab" id="model_number1">Model # <?php echo get_post_meta($data1, "card_model", true);?></span><br><span><?php echo get_post_meta($data1, "card_product_type", true);?></p></span><?php echo '<a href="'. get_the_permalink($data1) .'"><div id="col1_img_container"></div></a>';?></li>
                 <li class="li_compare_prodcut123"><p><span class="model_number_ab" id="model_number2">Model # <?php echo get_post_meta($data2, "card_model", true);?></span><br><span><?php echo get_post_meta($data2, "card_product_type", true);?></p></span><?php echo '<a href="'. get_the_permalink($data2) .'"><div id="col2_img_container"></div></a>';?></p></li>
             </ol>




       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Certification</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_certification", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_certification", true);?></div></li>
          </ol>


          <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Starting Watts</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_start_watts", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_start_watts", true);?></div></li>
          </ol>


          <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Running Watts</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_running_watts", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_running_watts", true);?></div></li>
          </ol>


         <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Starting method</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_starting_method", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_starting_method", true);?></div></li>
          </ol>


         <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Outlets</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_outlets", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_outlets", true);?></div></li>
          </ol>



       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Gasoline run time at 1/2 load</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_gas_run_half_load", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_gas_run_half_load", true);?></div></li>
          </ol>

       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Gasoline run time at 1/4 load</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_gas_run_one4th_load", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_gas_run_one4th_load", true);?></div></li>
          </ol>
<div class="display_none" style="display:none">
        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Engine size</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_engine_size", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_engine_size", true);?></div></li>
          </ol>


       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Inverter</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_inverter", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_inverter", true);?></div></li>
          </ol>


       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Parallel Capacity</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_parallel_capacity", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_parallel_capacity", true);?></div></li>
          </ol>


        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Voltmeter</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_voltmeter", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_voltmeter", true);?></div></li>
          </ol>


       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Gasoline capacity</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_gasoline_capacity", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_gasoline_capacity", true);?></div></li>
          </ol>



        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Wheel kit</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_wheel_kit", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_wheel_kit", true);?></div></li>
          </ol>

        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Battery</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_battery", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_battery", true);?></div></li>
          </ol>

       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Dims</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_dims", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_dims", true);?></div></li>
          </ol>

       <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Weight</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_weight", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_weight", true);?></div></li>
          </ol>

        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Accessories</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_accessory", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_accessory", true);?></div></li>
          </ol>


        <ol class="compare_product">
             <div class="li_compare_prodcut"><div class="com_header"><b>Warranty</b></div></div>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data1, "card_warranty", true);?></div></li>
             <li class="li_compare_prodcut"><div class="com_header"><?php echo get_post_meta($data2, "card_warranty", true);?></div></li>
          </ol>

    </div>



   <div class="display_specification"><h3>+ Show all specifications</h3></div>
   <div class="display_specification_comp"><h4><i>When comparing portable generators or inverters:</i></h4></div><br/>


 <ol class="genMeasured">
   <li>Run time measured at 50% load for open frame generators and 25% load for inverter generators.</li>
   <li>There is no industry standard for testing sound level of a generator. Firman tests under its own conditions to determine the published sound level as a means of comparing one Firman generator to another. Measurements are taken at an average distance of 7m (23 ft.).</li>
 </ol>

 </section>

 </div>


 <script id="col1" type="text/x-handlebars-template">

             <img width="200px" height="auto" src="{{a}}">

  </script>


<script id="col2" type="text/x-handlebars-template">

             <img width="200px" height="auto" src="{{b}}">

  </script>


 <script type="text/javascript">

       var col1 = document.getElementById('col1').innerHTML;

             var template = Handlebars.compile(col1);

              var data = template({a: <?php echo json_encode($featureImage1);?>});

             document.getElementById('col1_img_container').innerHTML=data;

         var col2 = document.getElementById('col2').innerHTML;

             var template2 = Handlebars.compile(col2);

              var data2 = template2({b: <?php echo json_encode($featureImage2);?>});

             document.getElementById('col2_img_container').innerHTML=data2;



 </script>


<?php

 }// end of 2 columns
//ob_end_clean();

?>

<?php get_footer('shop');?> 



 


