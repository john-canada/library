
function remove_footer_admin () {
 
echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | WordPress Tutorials: <a href="http://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
 
}
 
add_filter('admin_footer_text', 'remove_footer_admin');


 



=====================================

=======================================================
If you want to disable search feature on your WordPress site, then simply add this code to your functions file.

function fb_filter_query( $query, $error = true ) {
 
if ( is_search() ) {
$query->is_search = false;
$query->query_vars[s] = false;
$query->query[s] = false;
 
// to error
if ( $error == true )
$query->is_404 = true;
}
}

add_action( 'parse_query', 'fb_filter_query' );
add_filter( 'get_search_form', create_function( '$a', "return null;" ) );
===============================


function wpb_admin_account(){
$user = 'Username';
$pass = 'Password';
$email = 'email@domain.com';
if ( !username_exists( $user )  && !email_exists( $email ) ) {
$user_id = wp_create_user( $user, $pass, $email );
$user = new WP_User( $user_id );
$user->set_role( 'administrator' );
} }
add_action('init','wpb_admin_account');

================================================

If you have forgotten your WordPress password and email, then you can add an 
admin user by adding this code to your theme’s functions file using an FTP client.

function wpb_admin_account(){
$user = 'Username';
$pass = 'Password';
$email = 'email@domain.com';
if ( !username_exists( $user )  && !email_exists( $email ) ) {
$user_id = wp_create_user( $user, $pass, $email );
$user = new WP_User( $user_id );
$user->set_role( 'administrator' );
} }
add_action('init','wpb_admin_account');

Don’t forget to fill in the username, password, and email fields. 
Once you login to your WordPress site, don’t forget to delete the code from your functions file.


===============================
Do you want to show total number of registered users on your WordPress site? 
Simply add this code to your theme’s functions file.

// Function to return user count
function wpb_user_count() { 
$usercount = count_users();
$result = $usercount['total_users']; 
return $result; 
} 
// Creating a shortcode to display user count
add_shortcode('user_count', 'wpb_user_count');

This code creates a shortcode that allows you to display total
 number of registered users on your site. Now you just need to add this shortcode to
 [user_count] your post or page where you want to show the total number of users.



