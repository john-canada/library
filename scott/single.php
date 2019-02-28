<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="post_page">
    <div class="main_blogs">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="content_post">
                        <h1><?php the_title(); ?></h1>
                        <h4 class="font_style_1"><img src="/wp-content/uploads/2018/10/Scott2.jpg" /> by Scott</h4>
                        <div class="main_post font_style_1">
                        <?php while(have_posts()):the_post(); ?>
                        	<?php the_content(); ?>
                        <?php endwhile; ?>
                        </div>    
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="sidebar_blog">
                        <div class="top_sidebar_blog">
                            <div class="infor_scott">
                                <img src="/wp-content/uploads/2018/10/Scott2.jpg" />
                                <?php the_field('content_sb', get_option('page_for_posts')) ?>
                            </div>
                            <div class="email_bar">
                                <?php echo do_shortcode('[contact-form-7 id="4245" title="Sign Up"]') ?>
                                <div class="quote_bar">
                                    <div class="onquote_bar">
                                    <?php the_field('quote_sb', get_option('page_for_posts')) ?>
                                    </div>
                                    <div class="sub_quote">
                                        <?php if(get_field('image_sb', get_option('page_for_posts'))){
                                            echo '<img src="'.get_field("image_sb", get_option("page_for_posts")).'" />';
                                            } ?>
                                        <h3><strong><?php the_field('name_sb', get_option('page_for_posts')) ?></strong> - <?php the_field('sub_name', get_option('page_for_posts')) ?></h3>    
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="second_bar">
                            <h3>Essential Resources</h3>
                            <div class="item_bar">
                                <a href="#">
                                    <h4>How to Get More Traffic(FAST!)</h4>
                                    <img src="/wp-content/uploads/2018/10/Scottpng2.png" />
                                </a>
                            </div>
                        </div>
                        <div class="post_bar recent_bar">
                            <h3>RECENT POSTS</h3>
                            <div class="on_post_bar">
                                <ul>
                                <?php
                                	$args = array( 
                                    'numberposts' => '4',
                                    'post_type'   => 'post',
                                    'post_status' =>'publish', );
                                	$recent_posts = wp_get_recent_posts( $args );
                                	foreach( $recent_posts as $recent ){
                                		echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
                                	}
                                	wp_reset_query();
                                ?>
                                </ul>
                            </div>
                        </div>
                        <div class="post_bar">
                            <h3>POPULAR ARTICLES</h3>
                            <div class="on_post_bar">
                                <?php echo do_shortcode('[wpp]') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();
