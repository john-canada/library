<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

$card_model   = rwmb_meta( 'card_model' );
$card_product_type   = rwmb_meta( 'card_product_type' );
$card_title   = rwmb_meta( 'card_title' );
$term =  has_term( 'parts-accessories', 'product_cat', $product->get_id() );

//var_dump($card_model);
//var_dump($term);

if ( ! empty( $card_model ) && ! $term ) {

	echo '<h1 class="product-model-title">Model: ' . $card_model . '<br/>';
	echo '<span>' .$card_title . '</span></h1>';
	
} elseif ( !empty( $card_model ) && $term ){
	echo '<div class="row">';
	echo '<div class="col-lg-6">';
	echo '<p class="title-meta"><strong>Model: </strong>' . $card_model . '</p>';
	echo '</div>';
	echo '<div class="col-lg-6">';
	echo '<p class="title-meta"><strong>Product Type: </strong>' . $card_product_type . '</p>';
	echo '</div>';
	echo '</div>';
	if( empty($card_title)){
		the_title( '<h1 class="product-model-title">', '</h1>' );
	} else {
		echo '<h1 class="product-model-title">' . $card_title . '</h1>';
	}

} else {
	the_title( '<h1 class="product_title entry-title transparent">', '</h1>' );
}

