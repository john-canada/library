<?php
/*
PLUGIN NAME: DISPLAY_POST_ANYWHERE
AUTHOR: AGAW CANADA
VERSION: 2.0
*/
  if(!function_exists('display_record')){
    function display_record(){
       $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
       $arg=array(
           'post_type'=>'post',
          //'category_name'=>'news',
           'posts_per_page'=>2,
           'paged'=>$paged
       );
    $the_query=new wp_query($arg);
    
        if ( $the_query->have_posts() ) {
            echo '<ul style="list-style:none">';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            echo '<li><a href="#">'.get_the_post_thumbnail() . '</a></li>';
            echo '<li>' . get_the_title() . '</li>';
            echo '<li>' . get_the_excerpt() . '</li>';?>
            <hr>
            <?php
        }
            echo '</ul>';

            $agawlinK = 999; // need an unlikely integer
            echo paginate_links( array(
                'base' => str_replace( $agawlinK, '%#%', esc_url( get_pagenum_link( $agawlinK ) ) ),
                'format' => '?paged=%#%',
                'prev_text'          => __(' << '),
                'next_text'          => __(' >> '),
                'current' => max( 1, get_query_var('paged') ),
                'total' =>  $the_query->max_num_pages
            ) );

        wp_reset_postdata();

        } else {
            echo"no record found";
        }

        }
    }
add_shortcode('your-record-here','display_record');