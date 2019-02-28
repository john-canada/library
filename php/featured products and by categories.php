<?php
/*
  template name:home page
 */

get_header();
 global $product;
?>

  <div class="primary" class="content-area">
     <main id="main" class="site-main" role="main">

     <div class="container-fluid">
     <section>
       <div class="contactform" style="text-align:center;background: TRANSPARENT;MARGIN-TOP: 150PX;">    
         <?php echo do_shortcode('[contact-form-7 id="65" title="Contact form 1"]');?>
       </div>
     </section>

     <section>
     <video autoplay muted loop id="myVideo"  style="width:100%; height:auto;margin-top:-370px">
       <source src="http://localhost/commerce/wp-content/uploads/2019/02/moving-star.mp4" type="video/mp4">
   </video>
     </section>

         <?php //echo do_shortcode('[smartslider3 slider=1]')?>

<!--carousel-->
<!--end carousel-->


    </div><!-- container-fluid -->

    <div class="container">
      <section class="social" style="text-align:center">
         <a href="https://www.twitter.com" class="fab fa-twitter"></a>
         <a href="https://www.facebook.com/jaz.balase" class="fab fa-facebook"></a>
         <a href="https://www.youtube.com" class="fab fa-youtube"></a>
         <a href="https://google.com" class="fas fa-share-square"></a>
      </section>
    </div>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
       <div class="container">
           <div class="row">
           
          <!--
           =================================
            Display post
           =================================
         -->  
       
             <div class="col-xs-12 col-sm-3">
               <?php  get_sidebar();?>
             </div><!--col-xs-12 col-sm-2-->

             <div class="col-xs-12 col-sm-9">
            
                  <div class="col-xs-12 col-sm-4"> 
                  <ul class="the-post">
                    <?php 
              
                  $include=array(
                      'include'=>'3,22,26'
                  );

                  $categories = get_categories($include);
                    $i=1;
                    foreach($categories as $category){
                        $args = array(
                            'post_type'=>'post',
                            'posts_per_page'=>'1',
                            'category__in'=>$category->term_id,
                           // 'category__not_in'=>array(1),
                          ); 

                        $args = new wp_query($args);
                          
                          if($args->have_posts()): while($args->have_posts()): $args->the_post(); ?>
                          <li>            
                            <?php $feature = wp_get_attachment_url(get_post_thumbnail_id(get_the_id()));?> 
                            <div class="featured" style="background-image:url(<?php echo $feature;?>)"></div>
                            
                      <?php 
                            $posted_on = human_time_diff(get_the_time('U'),current_time('timestamp'));
                              $categories = get_the_category();
                              $output=""; 
                              $comma="";
                              $i=1;
                              foreach($categories as $category){ $i++;
                              if($i>1){$comma=",";}
                              $output.="<a href=" . get_the_permalink() . ">".$category->name .$comma."<a/>" ;
                            }
                        ?>
                            <small>Posted on: <?php echo $posted_on ." ago ";?><?php echo "Category : " . $output;?></small>                      
                            <div class="the-title"><a href="<?php the_permalink();?>"> <?php the_title();?></a></div>
                          </li>   
                      <?php       
                          endwhile;?>
                      
                      <?php endif;
                          $i++;
                      }

                ?>
                </ul>
          </div><!-- .col-xs-12 col-sm-4 -->
    
         <!--
           =================================
           Products by categories
           =================================
         -->  

          <section class="product-categories <?php //the_ID();?>">
            <h2>Product by categories</h2>
            <!-- <ul class="ul-product-cat"> -->
                <?php
                $prod_categories = get_terms( 'product_cat', array(
                    //'type'       =>'product',
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'hide_empty' => 1
                ));?>
              <div class="row"><?php
                  foreach( $prod_categories as $prod_cat ) :
                    $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
                    $cat_thumb_url = wp_get_attachment_thumb_url( $cat_thumb_id );
                    $term_link = get_term_link( $prod_cat, 'product_cat' );
              ?>
              <div class="col-md-4">
               <!-- <li> -->
                  <a href="<?php echo $term_link; ?>"><img width="250" height="250" src="<?php echo $cat_thumb_url; ?>" alt="<?php echo $prod_cat->name; ?>" /></a>
                 <h6> <?php echo $prod_cat->name; ?> <span>( <?php echo $prod_cat->count; ?> )</span></h6>
               </div>
               <!-- </li> -->
                <?php endforeach; wp_reset_query(); ?>
            </div><!--End row-->
            <!-- </ul> -->
          </section>

         <!--
           =================================
           Featured products
           =================================
         -->  

         <h2>Featured products </h2>
          <section class="featured-product">
        
        <?php
     
            $args = array(
                'post_type' => 'product',
                'posts_per_page' =>4,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                        ),
                    ),
                );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) { ?>
              <ul class="ul-product-cat">
             <?php   $product=wc_get_product();
                while ( $loop->have_posts() ) : $loop->the_post();?>
                <li>
                    <a href="<?php the_permalink() ?>"><?php  the_post_thumbnail(array(250,250));?> </a>
                    <a href="<?php the_permalink() ?>"><?php  the_title();?> </a>
                    <span class="the-price"> <?php echo get_woocommerce_currency_symbol(); ?><b><?php  echo  $product->get_price() ; ?></b></span>
                    <?php woocommerce_template_single_add_to_cart();?> 
                </li>   
            <?php    
           endwhile;?>
           </ul>
         <?php   } else {
                echo __( 'No products found' );
            }
            wp_reset_postdata();
        ?>
         
        </section>

       </div><!--col-xs-12 col-sm-8--->
        
         </div><!--.row-->

           <!--
           =================================
             mailchimp form
           =================================
         --> 

          <div class="row">
             <div class="col-md-4"></div>
             <div class="col-md-4"></div>
             <div class="col-md-4">
               
      <!-- Begin Mailchimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="https://facebook.us7.list-manage.com/subscribe/post?u=75f792dd37db905a694648235&amp;id=9e5fbeb16c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<h2>Subscribe to our mailing list</h2>
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_75f792dd37db905a694648235_9e5fbeb16c" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->

             
             </div>
          </div><!--row for mailchimp-->

          
       </div> <!--.container -->
      </article>
     </main> 
   </div> <!--#primary .content-area -->
   <?php echo wc_get_product_category_list(the_id());?>
<?php get_footer();?>