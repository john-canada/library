<?php


        /*
		
		$args = array(
			'orderby' => 'title',
			'order'   => 'DESC',
		);
		$query = new WP_Query( $args );
		
		*/

		
        //$query = new WP_Query( array( 'author' => '2,6,17,38' ) );
		$query = new WP_Query( array( 'author' => 1 ) );
		
		//$query = new WP_Query( array( 'cat' => 4 ) );
		//$query = new WP_Query( array( 'tag' => 'cooking' ) );
		
		$query = new WP_Query( array( 'category_name' => 'news' ) );
		
		//Display 3 posts per page:
		//$query = new WP_Query( array( 'posts_per_page' => 3 ) );
		
		
		//$query = new WP_Query( array( 'post_type' => 'page' ) );
		
		// The Query
		$the_query = new WP_Query( $args );

	==============================================	
		
		// The Loop
		if ( $the_query->have_posts() ) {
			echo '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo '<li>' . get_the_title() . '</li>';
			}
			echo '</ul>';
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			// no posts found
		}

======================================================
  /*
	function is_single( $post = '' ) {
		global $wp_query;
	 
		if ( ! isset( $wp_query ) ) {
			_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
			return false;
		}
	 
		return $wp_query->is_single( $post );
	}
	
	       <?php $wpdb->flush(); ?> 
			 <?php $wpdb->print_error(); ?> 
			 <?php $wpdb->show_errors(); ?> 
			 <?php $wpdb->hide_errors(); ?>
	 
	       $myrows = $wpdb->get_results( "SELECT id, name FROM mytable" );
			
			
			$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->users" );
		    echo "<p>User count is {$user_count}</p>";
			
		   $wpdb->prepare( "SELECT * FROM table WHERE ID = %d AND name = %s", $id, $name ); */
		   
		   
========================================================================
