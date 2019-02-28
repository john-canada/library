<article id="post-<?php the_id();?>" <?php post_class();?>>
  <?php the_title('<h2 class="entry-title">','</h2>');?>
   <?php if(has_post_thumbnail()):?>
       <div class="pull-right"> <?php the_post_thumbnail('thumbnail');?></div>
   <?php endif;?>
   <small><?php the_category();?>|<?php the_tags();?>|<?php edit_post_link();?></small>
    Posted on <span class="date"><?php the_time('M j, Y');?></span>
    <p><?php the_excerpt(); ?></p>
    <hr>
<?php //comments_template('', true); ?>
</article>