<?PHP
function do_easy_event_list() {

	// Safety first! Bail in the event TEC is inactive/not loaded yet

	if ( ! class_exists( 'Tribe__Events__Main' ) )

		return;

		

	// Has the user paged forward, ie are they on /page-slug/page/2/?

	$paged = get_query_var( 'paged' )

		? get_query_var( 'paged' )

		: 1; 

		

	// Build our query, adopt the default number of events to show per page

	$upcoming = new WP_Query( array(

		'post_type' => Tribe__Events__Main::POSTTYPE,

		'paged'     => $paged

	) );

	

	// If we got some results, let's list 'em

	while ( $upcoming->have_posts() ) {

		$upcoming->the_post();

		$title = get_the_title();

		$date  = tribe_get_start_date();

		

		// Of course, you could and probably would expand on this

		// and add more info and better formatting

		echo "<p> $title <i>$date</i> </p>";

	}

	

	// Is Pagenavi activated? Let's use it for pagination if so

	if ( function_exists( 'wp_pagenavi' ) )

		wp_pagenavi( array( 'query' => $upcoming ) );

		

	// Clean up

	wp_reset_query();

}



// Create a new shortcode to list upcoming events, optionally

// with pagination

add_shortcode( 'easy-event-list', 'do_easy_event_list' );