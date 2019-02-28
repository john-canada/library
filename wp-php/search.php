<?php get_header();?>
<div class="container">
  <div class="row">
      <div class="col-xs-12">
          <?php if (have_posts()):
              while(have_posts()): the_post();?>

            <p><?php //the_title(); ?></p>
            <?php if(has_post_thumbnail()){?>
                <div class="featuredimage">
               <?php the_post_thumbnail('small');?>
            </div>
               <?php }?>
            Posted on <span class="date"><?php the_time('M j, Y');?></span>
            <p><?php the_excerpt(); ?></p>
            <hr>
          <?php endwhile; endif;?>
      </div>
  </div>
 </div>

<div class="col-xs-12">
<?php //post_class(); ?>
    <?php //get_sidebar(); ?>
</div>

<h2>This is search.php in child jupiter</h2>
<?php wp_footer();?>
<?php get_footer();?>