<?php
/*
 *Template Name: Services Template
 */
get_header(); ?>

<div id="default_template" class="service_template">
<div class="title_about title_page">
   <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="sub_ser">
                <?php while(have_posts()):the_post(); ?>
                	<?php the_content(); ?>
                <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="sevice_sec1">
    <div class="container">
        <div class="row">
            <?php
                $args = array(
                	'post_type' => 'coach',
                	'posts_per_page' => -1,
                );
                $i=0;
                query_posts( $args );
                while ( have_posts() ) : the_post();
                $i++;
            ?>
            <div class="col-sm-6">
                <div class="service_item">
                    <div class="ser_img">
                        <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_field('icon') ?>" />
                        </a>
                    </div>
                    <div class="ser_main">
                        <h2><?php the_title(); ?></h2>
                        <div class="des_ser">
                            <?php the_field('description') ?>
                        </div>
                        <div class="url_ser">
                        <a href="<?php the_permalink(); ?>">Learn More ></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(($i%2)==0){
                
                echo '<div class="clear"></div>';
            } ?>
            <?php endwhile; wp_reset_query(); ?>
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>