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

	wp_enqueue_style('handlebar-library', plugins_url('assets/css/custom-compare-table.css', __FILE__), array(), '5.84');

	wp_enqueue_script('handlebar-library', plugins_url('assets/js/handlebars-v4.0.12.js', __FILE__));

	wp_enqueue_script('handlebar-template', plugins_url('assets/js/compare_table_index.js', __FILE__), array('jquery'), '8.67.9', false);

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


class PageTemplater {



	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;

     //  protected $action=handlebar-template_my_action;

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new PageTemplater();
		}

		return self::$instance;


	}

	/**
	 * Initializes the plugin by setting filters and administration functions.     
	 */

	private function __construct() {

		$this->templates = array();

		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

			// 4.6 and older
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_project_templates' )
			);

		} else {

			// Add a filter to the wp 4.7 version attributes metabox
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' ) 
			);

		}

		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data', 
			array( $this, 'register_project_templates' ) 
		);


		// Add a filter to the template include to determine if the page has our 
		// template assigned and return it's path
		add_filter(
			'template_include', 
			array( $this, 'view_project_template') 
		);


		// Add your templates to this array.
		$this->templates = array(
			'custom-template.php' => 'compare-table-at-index',
		);

			
	} 




	/**
	 * Adds our template to the page dropdown for v4.7+
	 *
	 */
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 */
	public function register_project_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list. 
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		} 

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	} 

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {
		
		// Get global post
		global $post;

		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}

		// Return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[get_post_meta( 
			$post->ID, '_wp_page_template', true 
		)] ) ) {
			return $template; 
		} 

		$file = plugin_dir_path( __FILE__ ). 'assets/templates/' . get_post_meta( 
			$post->ID, '_wp_page_template', true
		);

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		// Return template
		return $template;

	}


}

//add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );