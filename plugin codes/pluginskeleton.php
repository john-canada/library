<?php
// TODO: Change the header to match your details
/**
 * Plugin Name: Plugin Skeleton
 * Description: Not a real plugin, but rather a starting point for building other plugins
 * Version: 1.0
 * Author: Aaron Overton
 * Author URI: http://www.heatherstone.com
 */

// TODO: Change the class name to something unique
class PluginSkeleton {

  // Put all your add_action, add_shortcode, add_filter functions in __construct()
  // For the callback name, use this: array($this,'<function name>')
  // <function name> is the name of the function within this class, so need not be globally unique
  // Some sample commonly used functions are included below
    public function __construct() {

  // TODO: Edit the calls here to only include the ones you want, or add more

        // Add Javascript and CSS for admin screens
        add_action('admin_enqueue_scripts', array($this,'enqueueAdmin'));

        // Add Javascript and CSS for front-end display
        add_action('wp_enqueue_scripts', array($this,'enqueue'));
        add_action('add_meta_boxes', array($this,'add_meta_box_to_admin'));
    }

    function add_meta_box_to_admin(){
        add_meta_box('compare_table_meta_box_id','current post id in compare table','firman_compare_table_meta_box_callback','product' );
    }
       
       function firman_compare_table_meta_box_callback($post){
           wp_nonce_field('save_compare_table_action','save_compare_table_nonce');
           $value = get_post_meta($post->ID,'_compare_table_value_key',true);
           echo '<label for="compare_table_meta_label_id">User email</label>';
           echo '<input type="email" name="compare_table_meta_label_input" id="compare_table_meta_label_input" value="' .esc_attr($value).'" size="25"/>';
       }
    


    /* ENQUEUE SCRIPTS AND STYLES */
    // This is an example of enqueuing a Javascript file and a CSS file for use on the editor 
    public function enqueueAdmin() {
    	// These two lines allow you to only load the files on the relevant screen, in this case, the editor for a "books" custom post type
    	$screen = get_current_screen();
    	if (!($screen->base == 'post' && $screen->post_type == 'books')) return;

    	// Actual enqueues, note the files are in the js and css folders
    	// For scripts, make sure you are including the relevant dependencies (jquery in this case)
    	wp_enqueue_script('very-descriptive-name', plugins_url('js/books-post-editor.js', __FILE__), array('jquery'), '1.0', true);
    	wp_enqueue_style('very-exciting-name', plugins_url('css/books-post-editor.css', __FILE__), null, '1.0');
    }

    // This is an example of enqueuing a JavaScript file and a CSS file for use on the front end display
    public function enqueue() {
    	// Actual enqueues, note the files are in the js and css folders
    	// For scripts, make sure you are including the relevant dependencies (jquery in this case)
    	wp_enqueue_script('descriptive-name', plugins_url('js/somefile.js', __FILE__), array('jquery'), '1.0', true);
    	wp_enqueue_style('other-descriptive-name', plugins_url('css/somefile.css', __FILE__), null, '1.0');

        // Sometimes you want to have access to data on the front end in your Javascript file
        // Getting that requires this call. Always go ahead and include ajaxurl. Any other variables,
        // add to the array.
        // Then in the Javascript file, you can refer to it like this: externalName.someVariable
        wp_localize_script( 'descriptive-name', 'externalName', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'someVariable' => 'These are my socks'
        ));

    }
}

// TODO: Replace these with a variable named appropriately and the class name above
// If you need this available beyond our initial creation, you can create it as a global
global $skeleton;

// Create an instance of our class to kick off the whole thing
$skeleton = new PluginSkeleton();

?>



