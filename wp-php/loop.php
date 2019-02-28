

    <!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php wp_title(); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>


<div id="mini_stream">
    <ul>
<? $args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'category_name'=>'html',
);

$loop = new wp_Query($args);

while($loop->have_posts()) : $loop->the_post();
    echo '<a href="'.get_permalink().'">';
    echo get_the_post_thumbnail($post->ID, 'category-thumb');
    the_title( '<h6>', '</h6>' );
    echo '</a>';
endwhile;

wp_reset_query(); ?>
    </ul>
</div>

<!--Display latest post per category-->
<?php $arg_cat=array(
    'include'=> '1,8,9'
);
$categories=get_categotries('$arg_cat');
foreach($categories as $category):
    $args = array(
        'type'               =>'post',
        'post_per_page'      => 1,
        'category__in'       => array('1,8,9'),
        'category__not_in'   => array('10'),
        'posts_per_page' => 1
    );
    $postdata=new wp_Query($args);
    if($postdata->have_posts()): 
        while($postdata->have_posts()):
            $postdata->the_post();
            get_template_part('content','search');
        endwhile; endif;
endforeach;
?>

<!--Display post by author-->
<?php

global $current_user;   
$args = array(
    'type'          =>'post',
    'author'        =>  $current_user->ID,
    'orderby'       =>  'post_date',
    'order'         =>  'ASC',
    'posts_per_page' => 1,
    'category__in'=>array(1,9,8),
    'category__not_in'=>array(10),
    );?>

    <?php $postdata=new wp_Query($args);?>
        <?php if($postdata->have_posts()):?>
        <?php  while($postdata->have_posts()):?>
        <?php  $postdata->the_post();?>
        <div class="container">
             <?php get_template_part('content','search');?>
        </div>
<?php endwhile; endif;?>
wp_reset_postdata();

<!-- the loop -->

<?php if(have_posts()):
    while ( $query->have_posts() ) : $query->the_post(); ?>
        <h2><a href="<?php the_permalink();?>"><?php the_title();?></></h2>
          <?php if ( has_post_thumbnail()){?>
           <div class="featuredImage">
              <?php the_post_thumbnail(); ?>
              <?php set_post_thumbnail_size( 150, 150 );?>
            </div>
       <?php  }?>
       Posted on <span class="date"><?php the_time('M j, Y');?></span>
           <span class="meta-sep">|</span>
               <?php the_author_posts_link();?>
                   <span class="meta-sep">|</span>
                   <span class="comments-link"><?php comments_popup_link('Leave a comments');?></span>
               <p><?php the_excerpt('Read more');?></p> <hr>
        <?php endwhile; endif;?>

     <!--sidebar widget customize-->
     
        <div class="widget-area">
    <?php if(!dynamic_sidebar('Sidebar Widgets')):?>
       <aside id="search" class="widget">
           <?php get_search_form();?>
       </aside>
       <aside id="archives" class="widgets">
           <h5 class="widget-title">Archives</h5>
           <ul>
             <?php wp_get_archives('type=monthly&limit=12');?>  
           </ul>
       </aside>
    <?php endif;?>
</div>
<?php
/*
========================
woocommerce
========================
*/
//change label
add_filter( 'woocommerce_checkout_fields' , 'misha_labels_placeholders', 9999 );
 
function misha_labels_placeholders( $f ) {
 
	// first name can be changed with woocommerce_default_address_fields as well
	$f['billing']['billing_first_name']['label'] = 'Your mom calls you';
	$f['order']['order_comments']['placeholder'] = 'What\'s on your mind?';
 
	return $f;
 
}
//fullwidth input
add_filter( 'woocommerce_checkout_fields' , 'misha_checkout_fields_styling', 9999 );
 
function misha_checkout_fields_styling( $f ) {
 
	$f['billing']['billing_email']['class'][0] = 'form-row-wide';
	$f['billing']['billing_phone']['class'][0] = 'form-row-wide';
 
	return $f;
 
}
//change page order
add_filter( 'woocommerce_checkout_fields' , 'misha_sort_fields', 9999 );
 
function misha_sort_fields( $woo_checkout_fields_array ) {
 
	// 1 - first name
	// 2 - last name
	// 3 - phone
	// 4 - email
	// but this is an associative array and we can not sort it like a numeric array
 
	$billing = $woo_checkout_fields_array['billing'];
 
	// the most simple and obvious way to create a new array for this field group
	// but you can use array sorting techniques if you want
	$billing_new_order = array();
	$billing_new_order['billing_first_name'] = $billing['billing_first_name'];
	$billing_new_order['billing_last_name'] = $billing['billing_last_name'];
	$billing_new_order['billing_email'] = $billing['billing_email'];
	$billing_new_order['billing_phone'] = $billing['billing_phone'];
 
	$woo_checkout_fields_array['billing'] = $billing_new_order;
 
	return $woo_checkout_fields_array;
}

//optional or required
add_filter( 'woocommerce_checkout_fields' , 'misha_not_required_fields', 9999 );
 
function misha_not_required_fields( $f ) {
 
	unset( $f['billing']['billing_last_name']['required'] ); // that's it
	unset( $f['billing']['billing_phone']['required'] );
 
	// the same way you can make any field required, example:
	// $f['billing']['billing_company']['required'] = true;
 
	return $f;
}

//removing default checkout fields

add_filter( 'woocommerce_checkout_fields', 'misha_remove_fields', 9999 );
 
function misha_remove_fields( $woo_checkout_fields_array ) {
 
	// she wanted me to leave these fields in checkout
	// unset( $woo_checkout_fields_array['billing']['billing_first_name'] );
	// unset( $woo_checkout_fields_array['billing']['billing_last_name'] );
	// unset( $woo_checkout_fields_array['billing']['billing_phone'] );
	// unset( $woo_checkout_fields_array['billing']['billing_email'] );
	// unset( $woo_checkout_fields_array['order']['order_comments'] );
 
	// and to remove the fields below
	unset( $woo_checkout_fields_array['billing']['billing_company'] );
	unset( $woo_checkout_fields_array['billing']['billing_country'] );
	unset( $woo_checkout_fields_array['billing']['billing_address_1'] );
	unset( $woo_checkout_fields_array['billing']['billing_address_2'] );
	unset( $woo_checkout_fields_array['billing']['billing_city'] );
	unset( $woo_checkout_fields_array['billing']['billing_state'] );
	unset( $woo_checkout_fields_array['billing']['billing_postcode'] );
 
	return $woo_checkout_fields_array;
}
// default

add_filter( 'woocommerce_default_address_fields' , 'misha_disable_address_fields_validation' );
 
function misha_disable_address_fields_validation( $address_fields_array ) {
 
	unset( $address_fields_array['state']['validate']);
	unset( $address_fields_array['postcode']['validate']);
	// you can also hook first_name and last_name, company, country, city, address_1 and address_2
 
	return $address_fields_array;
 
}

add_filter( 'woocommerce_checkout_fields', 'misha_no_phone_validation' );
 
function misha_no_phone_validation( $woo_checkout_fields_array ) {
	unset( $woo_checkout_fields_array['billing']['billing_phone']['validate'] );
	return $woo_checkout_fields_array;
}

// add field

add_action( 'woocommerce_after_checkout_billing_form', 'misha_select_field' );
add_action( 'woocommerce_after_order_notes', 'misha_subscribe_checkbox' );
 
// save fields to order meta
add_action( 'woocommerce_checkout_update_order_meta', 'misha_save_what_we_added' );
 
// select
function misha_select_field( $checkout ){
 
	// you can also add some custom HTML here
 
	woocommerce_form_field( 'contactmethod', array(
		'type'          => 'select', // text, textarea, select, radio, checkbox, password, about custom validation a little later
		'required'	=> true, // actually this parameter just adds "*" to the field
		'class'         => array('misha-field', 'form-row-wide'), // array only, read more about classes and styling in the previous step
		'label'         => 'Preferred contact method',
		'label_class'   => 'misha-label', // sometimes you need to customize labels, both string and arrays are supported
		'options'	=> array( // options for <select> or <input type="radio" />
			''		=> 'Please select', // empty values means that field is not selected
			'By phone'	=> 'By phone', // 'value'=>'Name'
			'By email'	=> 'By email'
			)
		), $checkout->get_value( 'contactmethod' ) );
 
	// you can also add some custom HTML here
 
}
 
// checkbox
function misha_subscribe_checkbox( $checkout ) {
 
	woocommerce_form_field( 'subscribed', array(
		'type'	=> 'checkbox',
		'class'	=> array('misha-field form-row-wide'),
		'label'	=> '&nbsp;Subscribe to our newsletter.',
		), $checkout->get_value( 'subscribed' ) );
 
}
 
// save field values
function misha_save_what_we_added( $order_id ){
 
	if( !empty( $_POST['contactmethod'] ) )
		update_post_meta( $order_id, 'contactmethod', sanitize_text_field( $_POST['contactmethod'] ) );
 
 
	if( !empty( $_POST['subscribed'] ) && $_POST['subscribed'] == 1 )
		update_post_meta( $order_id, 'subscribed', 1 );
 
}

add_action('woocommerce_checkout_process', 'misha_check_if_selected');
 
function misha_check_if_selected() {
 
	// you can add any custom validations here
	if ( empty( $_POST['contactmethod'] ) )
		wc_add_notice( 'Please select your preferred contact method.', 'error' );
 
}