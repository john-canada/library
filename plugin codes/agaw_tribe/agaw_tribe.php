<?php if(!defined('ABSPATH')){die('You are human ');}
/*
Plugin Name: Agaw tribe
Plugin URI: https://agaw_tribe.com/
Description: Paperless Mini Library.
Author: JOHN CANADA
Version: 1.0
Author URI: https://agaw_tribe.com/
*/

class agawtribe
{
   function __construct(){
     add_action('init',array($this,'custom_post_type'));
     add_action('admin_enqueue_scripts',array($this,'enqueue'));
    
   }

   function custom_post_type(){
      $arg=array(
        'public'=>true,
        'label'=>'Books',
        'hierarchical' => false,
        'can_export' => true,
        'has_archive' => 'books',
        'taxonomies' => array( 'category','post_tag' ),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'show_ui' => true,
      );

       register_post_type('book', $arg);
   }

    function enqueue()
    {
      wp_enqueue_script('tribe-js', plugins_url('/assets/js/tribe.js',__FILE__));
      wp_enqueue_style('tribe-css', plugins_url('/assets/css/tribe.css',__FILE__));
    }

   function activate()
   {
     flush_rewrite_rules();
   }

   function deactivate()
   {
     flush_rewrite_rules();
   }
}


if(class_exists('agawtribe')){
  $AgawTribe = new agawtribe();
}

//activation
register_activation_hook('__FILE__', array('$AgawTribe','activate'));

//deactivation
register_deactivation_hook('__FILE__', array('$AgawTribe','deactivate'));